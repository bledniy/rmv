<?php


namespace App\Repositories\Admin;

use App\Contracts\HasMenuContent;
use App\Models\Admin\AdminMenu;
use App\Repositories\AbstractRepository;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class AdminMenuRepository extends AbstractRepository
{

    private $cacheKey = 'admin.menu.nested';

    private $activeMenus = [];

    public function model()
    {
        return AdminMenu::class;
    }

    public function dropMenuCache(): bool
    {
        return Cache::forget($this->cacheKey);
    }

    private function getMenuFromCache()
    {
        if (!$menus = Cache::get($this->cacheKey)) {
            $menus = (AdminMenu::with(['childrens' => function ($q) {
                $q->where('active', 1);
            },
            ])
                ->where('active', 1)
                ->where('parent_id', 0)
                ->get());
            $menus = $this->checkMenuValid($menus);
            $menus = $this->getMenuSubContent($menus);
            $this->addParentLink($menus);
            Cache::set($this->cacheKey, $menus);
        }

        return $menus;
    }

    private function getCachedMenuByUser(): Collection
    {
        $user = Auth::guard('admin')->user();
        $cacheKey = $this->cacheKey . '.user.' . $user->id;
        if ((!$menus = Cache::get($cacheKey))) {
            $menus = $this->getMenuFromCache();
            $menus = $this->checkMenuAccess($menus);
            Cache::set($cacheKey, $menus);
        }

        return $menus;
    }

    public function getNestedMenu(): Collection
    {
        /** @var $menus Collection */
        $menus = $this->getCachedMenuByUser();
        $this->detectCurrentMenu($menus);

        return $menus;
    }

    private function addParentLink(Collection $menus, ?AdminMenu $parent = null)
    {
        $menus->map(function (AdminMenu $menu) use ($parent) {
            $menu->setRelation('parent', $parent);
            if ($menu->childrens->isNotEmpty()) {
                $this->addParentLink($menu->childrens, $menu);
            }
        });
    }

    private function detectCurrentMenu(Collection $menus)
    {
        $this->checkForCurrentMenu($menus);
        if ($this->activeMenus) {
            $this->matchActiveMenu($this->activeMenus);
        }
    }

    private function matchActiveMenu(array $array)
    {
        $menus = Collection::wrap($array);
        $menus = $menus->sortByDesc(static function (AdminMenu $item) {
            return mb_strlen($item->getUrlWithPrefix());
        });
        if ($activeMenu = $menus->first()) {
            $this->activateCurrentMenu($activeMenu);
        }
    }

    private function activateCurrentMenu($menu)
    {
        $menu->current = 1;
        $this->setActiveChainParentsForCurrentMenu($menu);
    }

    private function checkForCurrentMenu(Collection $menus)
    {
        $menus->map(function (AdminMenu $menu) {
            if (isMenuActiveByUrl($menu->getUrlWithPrefix())) {
                $this->addActiveMenu($menu);
            }
            if ($menu->childrens->isNotEmpty()) {
                $this->checkForCurrentMenu($menu->childrens);
            }

            return $menu;
        });
    }

    private function setActiveChainParentsForCurrentMenu(AdminMenu $menu)
    {
        /** @var  $parent AdminMenu */
        if ($parent = $menu->parent) {
            $parent->setAttribute('show', true);
            if ($parent->parent) {
                $this->setActiveChainParentsForCurrentMenu($parent);
            }
        }
    }

    private function checkMenuValid(Collection $menus)
    {
        /** @var  $menu AdminMenu */
        foreach ($menus as $num => $menu) {
            $valid = 1;
            if (!$menu->getUrlWithPrefix()) {
                $valid = 0;
            }

            if (!$valid) {
                $menus->forget($num);
                continue;
            }

            if ($menu->childrens->isNotEmpty()) {
                $menu->setRelation('childrens', $this->checkMenuValid($menu->childrens));
            }
        }

        return $menus;
    }

    private function checkMenuAccess(Collection $menus)
    {
        $menus = $menus->filter(static function ($menu) {
            try {
                if (!$menu->gate_rule) {
                    return true;
                }

                return \Gate::allows($menu->gate_rule);
            } catch (\Exception $e) {
                return false;
            }
        });

        return $menus;
    }

    private function getMenuSubContent(Collection $menus): Collection
    {
        $menus = $menus->map(function ($menu) {
            $menu->content = $this->getMenuContentProvider($menu);
            if ($menu->childrens->isNotEmpty()) {
                $menu->childrens = $this->getMenuSubContent($menu->childrens);
            }

            return $menu;
        });

        return $menus;
    }

    private function getMenuContentProvider(AdminMenu $menu)
    {
        $content = '';
        if ($menu->content_provider) {
            $class = $menu->content_provider;
            try {
                $interface = HasMenuContent::class;
                if (class_exists($class) && classImplementsInterface($class, $interface)) {
                    /** @var  $instance HasMenuContent */
                    $instance = app($class);
                    $content = $instance->getMenuContent();
                }
            } catch (\Error $e) {
                //
            }
        }

        return $content;
    }

    private function addActiveMenu(AdminMenu $menu)
    {
        $this->activeMenus[] = $menu;
    }
}
