<?php declare(strict_types=1);

namespace Database\Seeders;

use App\Enum\MenuGroupEnum;
use App\Events\Admin\MenusChanged;
use App\Models\Menu;
use App\Repositories\MenuRepository;
use Illuminate\Support\Arr;

class MenuTableSeeder extends AbstractSeeder
{
    private $menuRepository;

    public function __construct(MenuRepository $menuRepository)
    {
        $this->reguard();
        $this->menuRepository = $menuRepository;
    }

    public function run(): void
    {
        $menuGroups = [
            MenuGroupEnum::MAIN_MENU => [
                ['name' => 'Головна', 'url' => '/'],
                ['name' => 'Склад ради'],
                ['name' => 'Виддили'],
                ['name' => 'Документи'],
                ['name' => 'Новости', 'url' => 'news'],
                ['name' => 'Контакти', 'url' => 'contacts'],
            ],
        ];
        foreach ($menuGroups as $group => $menus) {
            if (!$menus) {
                continue;
            }
            foreach ($menus as $sort => $item) {
                $item['group'] = $group;
                $item['sort'] = $sort;
                $menu = $this->menuRepository->create($item);
                if (!$menu || !$menu instanceof Menu) {
                    continue;
                }
                if (Arr::has($item, 'childrens')) {
                    foreach (Arr::get($item, 'childrens') as $itemChild) {
                        $itemChild['parent_id'] = $menu->id;
                        $itemChild['group'] = $group;
                        $this->menuRepository->create($itemChild);
                    }
                }
            }
        }

        event(new MenusChanged);
    }

    private function arrayReverseRecursive($arr): array
    {
        foreach ($arr as $key => $val) {
            if (is_array($val)) {
                $arr[$key] = $this->arrayReverseRecursive($val);
            }
        }

        return array_reverse($arr);
    }
}
