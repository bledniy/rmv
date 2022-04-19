<?php

namespace App\Models;


use App\Observers\Admin\PermissionObserver;


class Permission extends \Spatie\Permission\Models\Permission
{
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->setAttribute('guard_name', 'admin');
    }

    public function getNameForRead()
    {
        return $this->getAttribute('display_name');
    }

    //
    public static function boot()
    {
        parent::boot();

        static::observe(PermissionObserver::class);
    }

    public static function getList()
    {
        $permissions = Permission::orderBy(\DB::raw('IF(`name` = "view_index", 1, 0)'))->orderBy('group')->get()->groupBy('group');

        return $permissions;
    }
}
