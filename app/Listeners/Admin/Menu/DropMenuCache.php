<?php declare(strict_types=1);

namespace App\Listeners\Admin\Menu;

use App\Events\Admin\MenusChanged;
use App\Models\Menu;
use App\Repositories\MenuRepository;

class DropMenuCache
{
    private $menuRepository;

    public function __construct(MenuRepository $menuRepository)
    {
        $this->menuRepository = $menuRepository;
    }

    public function handle(MenusChanged $event)
    {
        $cacheKey = Menu::PUBLIC_MENUS_CACHE_KEY;
        \Cache::forget($cacheKey);
        try {
            $this->menuRepository->getMenus();
        } catch (\Exception $exception) {

        }
    }
}
