<?php declare(strict_types=1);

namespace App\Services\Menu;

use App\DataContainers\Menu\MenuGroupData;
use App\DataContainers\Menu\SearchMenusData;
use App\Enum\MenuGroupEnum;
use App\Repositories\MenuRepository;

final class MenusService implements MenusServiceInterface
{
    private $menuRepository;

    public function __construct(MenuRepository $menuRepository)
    {
        $this->menuRepository = $menuRepository;
    }

    public function getAllMenus(): array
    {
        $menus = [];
        $enums = MenuGroupEnum::getEnums();
        foreach ($enums as $enum) {
            $menus[$enum->getKey()] = $this->getMenus($enum);
        }

        return $menus;
    }

    public function getMenus(MenuGroupEnum $groupEnum): MenuGroupData
    {
        $menus = $this->menuRepository->getNestedMenus(SearchMenusData::create()->addGroup($groupEnum->getKey()));

        return MenuGroupData::create($groupEnum, $menus);
    }
}