<?php


namespace App\Helpers\Route;


use Illuminate\Database\Eloquent\Model;

class CRUDLinkByModel
{

    private $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    private function routeByModelKey(string $module): string
    {
        return routeKeys($module);
    }

    private function getModel(): Model
    {
        return $this->model;
    }

    private function getKey()
    {
        return $this->model->getKey();
    }

    private function getModelKey(): string
    {
        return $this->model->getTable();
    }

    private function isValidLinkGenerate($action): bool
    {
        if ($this->getModel()->exists && !$this->getKey()) {
            return false;
        }

        if (!$route = $this->routeKey($this->getModelKey(), $action) or !app('router')->has($route)) {
            return false;
        }

        return true;
    }

    private function isInvalidLinkGenerate($action): bool
    {
        return !$this->isValidLinkGenerate($action);
    }

    private function defaultLinkWhenInvalid(): string
    {
        return '';
    }

    private function routeKey(string $module, string $action = 'index'): string
    {
        return implode('.', [$this->routeByModelKey($module), $action]);
    }

    private function actionWithoutParameters(string $action): string
    {
        if ($this->isInvalidLinkGenerate($action)) {
            return $this->defaultLinkWhenInvalid();
        }

        return route(
            $this->routeKey($this->getModelKey(), $action)
        );
    }

    private function actionWithParameters(string $action): string
    {
        if ($this->isInvalidLinkGenerate($action)) {
            return $this->defaultLinkWhenInvalid();
        }

        return route(
            $this->routeKey($this->getModelKey(), $action)
            , $this->getKey()
        );
    }

    public function index(): string
    {
        return $this->actionWithoutParameters('index');
    }

    public function create(): string
    {
        return $this->actionWithoutParameters('create');
    }

    public function store(): string
    {
        return $this->actionWithoutParameters('store');
    }

    public function show(): string
    {
        return $this->actionWithParameters('show');
    }

    public function edit(): string
    {
        return $this->actionWithParameters('edit');
    }

    public function update(): string
    {
        return $this->actionWithParameters('update');
    }

    public function destroy(): string
    {
        return $this->actionWithParameters('destroy');
    }
}