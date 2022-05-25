<?php

namespace Database\Seeders;

use App\Enum\ContentTypeEnum;
use App\Models\Admin\Admin;
use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
	private $actions = [
		'view',
		'add',
		'edit',
		'delete',
	];

	public function run()
	{
// Reset cached roles and permissions
//		app(\Spatie\Permission\PermissionRegistrar::class)->forgetCachedPermissions();

// create permissions

		$permissions = $this->getExistsPermissions();
		foreach ($permissions as $permission) {
			(new Permission(['name' => $permission]))->save();
		}

// create roles and assign created permissions
		$roleWriter = Role::create(['name' => 'writer']);
//		$roleWriter->givePermissionTo('edit_articles', 'view_articles');

// or may be done by chaining
		$roleModerator = Role::create(['name' => 'moderator'])->givePermissionTo($this->getRolesModerator());
		if (config('permission.admin_id') and $moderator = Admin::find(config('permission.admin_id'))) {
			$moderator->assignRole($roleModerator);
		}
		$roleModerator = Role::create(['name' => 'tester'])->givePermissionTo($this->getRolesModerator());

		$role = Role::create(['name' => 'admin'])->givePermissionTo(Permission::all());
		if (config('permission.super_admin_id')) {
			Admin::find(config('permission.super_admin_id'))->assignRole($role);
		}
	}

	/**
	 * @return array
	 */
	private function getRolesModerator(): array
    {
		$permissions = [];
		$permissions = array_merge($permissions, $this->_getPermissionModify('settings'));
//		$permissions = array_merge($permissions, $this->_getPermissionCrud('translate'));
		$permissions = array_merge($permissions, $this->_getPermissionCrud('menu'));
		$permissions = array_merge($permissions, $this->_getPermissionCrud('meta'));
		$permissions = array_merge($permissions, $this->_getPermissionCrud('news'));
        $permissions = array_merge($permissions, $this->_getPermissionCrud('departments'));
        $permissions = array_merge($permissions, $this->_getPermissionCrud('faculties'));
//        $permissions = array_merge($permissions, $this->_getPermissionCrud(ContentTypeEnum::BRAND));
//        $permissions = array_merge($permissions, $this->_getPermissionCrud('sliders'));
		//
		$permissions = array_merge($permissions, $this->_getPermission('feedback', ['view', 'delete']));
		$permissions = array_merge($permissions, $this->_getPermission('index', 'view'));

		return $permissions;
	}

	private function getExistsPermissions()
	{
		$permissions = [];
		$permissions[] = 'view_index';
		$create = [
			'users',
			'roles',
			'settings',
			'menu',
			'meta',
			'translate',
			'pages',
			'redirect',
			'feedback',
			'news',
			//
            'sliders',
            'faculties',
            'departments',
            'staffs'
		];

		foreach ($create as $entity) {
			foreach ($this->_getPermissionCrud($entity) as $perm) {
				$permissions[] = $perm;
			}
		}

		return $permissions;
	}

	private function _getPermission($entity, $permissions)
	{
		$res = [];
		foreach ((array)$permissions as $permission) {
			$res[] = $permission . '_' . $entity;
		}
		return $res;
	}

	private function _getPermissionCrud($entity, $except = [])
	{
		$perms = $this->actions;
		if ($except = (array)$except) {
			$perms = array_diff($perms, $except);
		}
		return $this->_getPermission($entity, $perms);
	}

	private function _getPermissionModify($entity)
	{
		$perms = [
			'view',
			'edit',
		];
		return $this->_getPermission($entity, $perms);
	}
	private function _getPermissionView($entity)
	{
		$perms = [
			'view',
		];
		return $this->_getPermission($entity, $perms);
	}
}
