<?php declare(strict_types=1);

namespace App\Repositories;

use App\DataContainers\Menu\SearchMenusData;
use App\Models\Menu;
use App\Models\MenuLang;
use App\Scopes\SortOrderScope;

class MenuRepository extends AbstractRepository
{
    /**
     * @inheritDoc
     */
    public function model()
    {
        return Menu::class;
    }

    public function create(array $attributes):Menu
    {
        return parent::create($attributes);
    }

    public function modelLang()
    {
        return MenuLang::class;
    }

    protected function initScopes()
    {
        Menu::initScopesPublic();
    }

    public function getNestedMenus(SearchMenusData $data)
    {
        $this->initScopes();
        $menus = Menu::where('parent_id', 0)
            ->with(['lang', 'allMenus'])
            ->withGlobalScope('sort', new SortOrderScope)
        ;
        if ($data->getGroups()){
            $menus->whereIn('group', $data->getGroups());
        }

        return $menus->get();
    }
}
