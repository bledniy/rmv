<?php declare(strict_types=1);

namespace App\Services\Admin\Nestable;

use App\Models\Menu;

class DefaultNestableService
{
    /**
     * @var string
     */
    private $modelClassName;

    public function __construct(string $modelClassName)
    {
        if (!class_exists($modelClassName)) {
            throw new \InvalidArgumentException('must be provided model class');
        }
        $this->modelClassName = $modelClassName;
    }

    public function nestable(array $menus, $parent_id = 0)
    {
        $lastJsonModel = json_encode($menus);
        $cacheKey = 'nested.order.' . md5($this->modelClassName . $lastJsonModel);
        if (!\Cache::get($cacheKey) || $lastJsonModel !== \Cache::get($cacheKey)) {
            $this->_nestable($menus, $parent_id);
        }
        \Cache::set($cacheKey, $lastJsonModel);
    }

    private function _nestable(array $menus, $parent_id = 0)
    {
        foreach ($menus as $num => $nestableItem) {
            if ($findMenu = $this->modelClassName::find(\Arr::get($nestableItem, 'id'))) {
                $data = [
                    'sort' => $num,
                    'parent_id' => (int)$parent_id,
                ];
                $findMenu->fillExisting($data)->save();
                if (isset($nestableItem['children'])) {
                    $this->_nestable($nestableItem['children'], $nestableItem['id']);
                }
            }
        }
    }

}