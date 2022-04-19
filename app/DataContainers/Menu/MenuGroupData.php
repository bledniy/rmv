<?php declare(strict_types=1);

namespace App\DataContainers\Menu;

use App\Enum\MenuGroupEnum;
use App\Models\Menu;
use Illuminate\Support\Collection;
use InvalidArgumentException;

final class MenuGroupData
{
    /**
     * @var MenuGroupEnum
     */
    private $groupEnum;

    /**
     * @var Collection|array<Menu>
     */
    private $menus;

    private function __construct() { }

    public static function create(MenuGroupEnum $groupEnum, $menus): self
    {
        if (!(is_a($menus, Collection::class) || is_array($menus))) {
            throw new InvalidArgumentException(sprintf('array or collection of menus must be provided, %s given', gettype($menus)));
        }
        $self = new self;
        $self->groupEnum = $groupEnum;
        $self->menus = $menus;

        return $self;
    }

    public function getGroupEnum(): MenuGroupEnum
    {
        return $this->groupEnum;
    }

    /**
     * @return Menu[]|Collection
     */
    public function getMenus()
    {
        return $this->menus;
    }

}