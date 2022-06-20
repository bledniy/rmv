<?php declare(strict_types=1);

namespace App\Services\Menu;

use App\DataContainers\Menu\MenuGroupData;
use App\Enum\MenuGroupEnum;

interface MenusServiceInterface
{
    /**
     * @return array<MenuGroupData>
     */
    public function getAllMenus(): array;

    public function getMenus(MenuGroupEnum $groupEnum): MenuGroupData;
}