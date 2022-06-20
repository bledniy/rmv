<?php declare(strict_types=1);

namespace App\View\Components\Layout;

use App\DataContainers\Menu\SearchMenusData;
use App\Enum\MenuGroupEnum;
use App\Models\Menu;
use App\Repositories\MenuRepository;
use App\View\Traits\CacheableComponent;
use Illuminate\View\Component;
use function view;

class MenuItems extends Component
{
    protected $cacheKey = Menu::PUBLIC_MENUS_CACHE_KEY;

    private $menuRepository;

    private $data;

    use CacheableComponent;

    public function __construct(MenuRepository $menuRepository, SearchMenusData $data)
    {
        $this->menuRepository = $menuRepository;
        $this->data = $data;
    }

    public function render()
    {
        if ($this->hasCached()) {
            return $this->getCached();
        }
        $this->data->setActive(true)->addGroup(MenuGroupEnum::MAIN_MENU);
        $menus = $this->menuRepository->getNestedMenus($this->data);
        $view = view('components.layout.public.menu-items')->with('menus', $menus)->render();
        $this->addToCached($view);

        return $view;
    }
}
