<?php

namespace App\Console\Commands;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

class AuthPermissionCommand extends Command
{
    protected $signature = 'auth:permission {name} {--R|remove}';

    protected $argumentName;

    public function handle()
    {
        $permissions = $this->generatePermissions();

        // check if its remove
        if ($is_remove = $this->option('remove')) {
            // remove permission
            if (Permission::where('name', 'LIKE', '%' . $this->getNameArgument())->delete()) {
                $this->warn('Permissions ' . implode(', ', $permissions) . ' deleted.');
            } else {
                $this->warn('No permissions for ' . $this->getNameArgument() . ' found!');
            }

        } else {
            // create permissions
            foreach ($permissions as $permission) {
                Permission::firstOrCreate(['name' => $permission]);
            }

            $this->info('Permissions ' . implode(', ', $permissions) . ' created.');
        }

        // sync role for admin
        if ($role = Role::where('name', 'Admin')->first()) {
            $role->syncPermissions(Permission::all());
            $this->info('Admin permissions');
        }

        return 1;
    }

    private function generatePermissions()
    {
        $abilities = ['view', 'add', 'edit', 'delete'];
        $name = $this->getNameArgument();

        return array_map(function ($val) use ($name) {
            return $val . '_' . $name;
        }, $abilities);
    }

    private function getNameArgument()
    {
        if (!is_null($this->argumentName)) {
            return $this->argumentName;
        }

        $name = Str::lower($this->argument('name'));
        $plural = Str::plural($name);

        if (($plural !== $name) && !$this->confirm('Permission recommended to be plural, are you sure want use non plural permission?')) {
            $name = $plural;
        }
        $this->argumentName = $name;

        return $name;
    }
}
