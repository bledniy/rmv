<?php declare(strict_types=1);

namespace App\Observers\Admin;

use App\Models\Permission;

class PermissionObserver
{

    public function creating(Permission $permission)
    {
        if (!$permission->getAttribute('group')) {
            $groups = explode('_', $permission->getAttribute('name'));
            $group = array_pop($groups);
            $permission->setAttribute('group', $group);
        }
        if (!$permission->getAttribute('display_name')) {
            $name = str_replace('_', ' ', $permission->getAttribute('name'));
            $name = ucwords($name);
            $permission->setAttribute('display_name', $name);
        }
    }

}
