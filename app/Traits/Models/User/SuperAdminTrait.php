<?php

namespace App\Traits\Models\User;


use App\Models\User;

trait SuperAdminTrait
{

//
//	public function scopeNotSuperAdmin($query)
//	{
//		$id = config('permission.super_admin_id');
//		return $query->where('id', '!=', $id);
//	}

    public function isSuperAdmin(): bool
    {
        return (int)$this->id === (int)config('permission.super_admin_id');
    }

    public function isAdmin(): bool
    {
        static $isAdmin = null;
        if ($isAdmin === null) {
            /** @var  $user User */
            $isAdmin = ($this->hasAnyRole(\App\Models\Role::getAllRoles()));
        }

        return $isAdmin;
    }
}