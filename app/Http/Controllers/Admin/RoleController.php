<?php

namespace App\Http\Controllers\Admin;

use App\Models\Permission;
use App\Models\Role;
use App\Traits\Authorizable;
use Illuminate\Http\Request;

class RoleController extends AdminController
{
    use Authorizable;

    protected $name = 'Роли';

    protected $routeKey = 'admin.roles';

    protected $permissionKey = 'roles';

    protected $key = 'roles';

    public function __construct()
    {
        parent::__construct();
        $this->name = __('modules.roles.title');
        $this->addBreadCrumb(__('modules.users.title'), route(routeKey('users')));
        $this->addBreadCrumb($this->name, $this->resourceRoute('index'));
        $this->shareViewModuleData();
    }

    public function index()
    {
        $this->setTitle($this->name);
        $roles = Role::all();
        $permissions = Permission::getList();
        $data['content'] = view('admin.role.index', compact('roles', 'permissions'));

        return $this->main($data);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $this->validate($request, ['name' => 'required|unique:roles']);

        if (Role::create($request->only('name'))) {
            $this->setSuccessStore();
        }

        return redirect()->back()->with($this->getResponseMessage());
    }

    public function update(Request $request, $id)
    {
        if ($role = Role::findOrFail($id)) {
            // admin role has everything
            if ($role->name === 'Admin') {
                $role->syncPermissions(Permission::all());

                return redirect()->route('roles.index');
            }

            $permissions = $request->get('permissions', []);
            $role->syncPermissions($permissions);
            $this->setSuccessMessage($role->name . ' permissions has been updated.');
        } else {
            $this->setMessage('Role with id ' . $id . ' note found.');
        }

        return redirect($this->resourceRoute('index'));
    }
}
