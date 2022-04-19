<?php declare(strict_types=1);

namespace App\Traits\Controllers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Route;

trait ResourceControllerHelpers
{

    protected function titleEdit(Model $model, $column = 'name', $middleText = ''): string
    {
        $prefix = __('modules._.edit') . ' ';

        return $prefix . $middleText . $model->getAttribute($column);
    }

    protected function resourceRoute(string $action, $parameters = []): string
    {
        $key = $this->routeKey ?? $this->key ?? '';
        $route = implode('.', [$key, $action]);

        return Route::has($route) ? route($route, $parameters) : route('admin.index');
    }

}
