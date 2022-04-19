<?php

namespace App\Traits;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

trait Authorizable
{
    private $abilities = [
        'index' => 'view',
        'edit' => 'edit',
        'show' => 'view',
        'update' => 'edit',
        'create' => 'add',
        'store' => 'add',
        'destroy' => 'delete',
    ];


    public function callAction($method, $parameters)
    {
        if ($this->abilityExists($method) && $ability = $this->getAbility($method)) {
            $this->authorizeForUser(Auth::guard('admin')->user(), $ability);
        }

        return parent::callAction($method, $parameters);
    }

    public function getAbility($method): ?string
    {
        if (property_exists($this, 'permissionKey') && $this->permissionKey) {
            $permissionKey = $this->permissionKey;
        } elseif (property_exists($this, 'key') && $this->key) {
            $permissionKey = $this->key;
        } else {
            $routeName = explode('.', \Request::route()->getName());
            $parts = array_filter($routeName, static function ($name) {
                return $name !== 'admin';
            });
            $permissionKey = reset($parts);
        }
        $action = Arr::get($this->getAbilities(), $method);

        return $action ? implode('_', [$action, $permissionKey]) : null;
    }

    private function getAbilities(): array
    {
        return $this->abilities;
    }

    public function extendAbilities($abilities): void
    {
        $abilities = Arr::wrap($abilities);
        $this->abilities = array_merge($abilities, $this->abilities);
    }

    public function replaceAbilities($abilities): void
    {
        $abilities = Arr::wrap($abilities);
        $this->abilities = array_merge($this->abilities, $abilities);
    }

    public function removeAbilities($abilities): void
    {
        $abilities = Arr::wrap($abilities);
        foreach ($abilities as $key => $ability) {
            Arr::forget($this->abilities, $key);
        }
    }

    public function abilityExists($method): bool
    {
        return array_key_exists($method, $this->getAbilities());
    }
}