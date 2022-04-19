<?php declare(strict_types=1);

namespace App\Http\Controllers\Admin\Admin;

use App\DataContainers\Admin\Admin\SearchDataContainer;
use App\Http\Controllers\Admin\AdminController as AbstractAdminController;
use App\Http\Requests\Admin\User\UpdateUserRequest;
use App\Http\Requests\Admin\UserProfileRequest;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use App\Repositories\UserRepository;
use App\Traits\Authorizable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends AbstractAdminController
{
    use Authorizable;

    protected $routeKey = 'admin.users';

    protected $permissionKey = 'users';

    protected $key = 'users';

    protected $name;
    /**
     * @var UserRepository
     */
    private $repository;
    /**
     * @var SearchDataContainer
     */
    private $searchDataContainer;

    public function __construct(UserRepository $repository, SearchDataContainer $searchDataContainer)
    {
        parent::__construct();
        $this->name = __('modules.users.title');
        $this->addBreadCrumb(__('modules.users.title'), $this->resourceRoute('index'));
        $this->shareViewModuleData();
        $this->repository = $repository;

        $searchDataContainer->setIsSuperAdmin(isSuperAdmin());
        $this->searchDataContainer = $searchDataContainer;
    }

    public function index(Request $request)
    {
        $title = $this->name;
        $this->setTitle($title);
        if ($search = (string)$request->get('search')) {
            $this->searchDataContainer->setSearch($search);
        }

        $result = $this->repository->getListAdmin($this->searchDataContainer);
        $data['content'] = view('admin.user.index', compact('result', 'search'));

        return $this->main($data);
    }

    public function create(User $user)
    {
        $title = __('form.create');
        $this->setTitle($title)->addBreadCrumb($title);
        $roles = Role::pluck('name', 'id');
        $data['content'] = view('admin.user.create', compact('roles'));

        return $this->main($data);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'bail|required|min:2',
            'email' => 'nullable|email|unique:users',
            'password' => 'required|min:6',
        ]);
        $this->setSuccessStore();
        $request->merge(['password' => Hash::make($request->get('password'))]);
        // Create the user
        $input = $request->except('roles', 'permissions');
        $input['active'] = (int)$request->get('active');

        if (($user = new User)->fillExisting($input)->save()) {
            $this->syncPermissions($request, $user);
        }
        if ($request->has('createOpen')) {
            return redirect($this->resourceRoute('edit', $user->id))->with($this->getResponseMessage());
        }

        return redirect($this->resourceRoute('index'))->with($this->getResponseMessage());
    }

    public function edit($id)
    {
        $edit = $this->repository->applyFilter($this->searchDataContainer)->find($id);
        $title = $this->titleEdit($edit);
        $this->addBreadCrumb($title)->setTitle($title);
        $roles = Role::pluck('name', 'id');
        $permissions = Permission::getList();
        $data['content'] = view('admin.user.edit', compact('edit', 'roles', 'permissions'));

        return $this->main($data);
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $this->setSuccessUpdate();
        // Get the user
        $user = $this->repository->applyFilter($this->searchDataContainer)->find($user->id);
        // Update user
        $input = $request->except('roles', 'permissions', 'password');
        $user->fillExisting($input);
        if ($request->get('password')) {
            $user->password = bcrypt($request->get('password'));
        }
        $this->syncPermissions($request, $user);
        if ($user->save()) {
            $this->setSuccessUpdate();
        }

        if ($request->has('saveClose')) {
            return redirect($this->resourceRoute('index'))->with($this->getResponseMessage());
        }

        return redirect()->back()->with($this->getResponseMessage());
    }


    private function syncPermissions(Request $request, $user)
    {
        // Get the submitted roles
        $roles = $request->get('roles', []);
        $permissions = $request->get('permissions', []);
        // Get the roles
        $roles = Role::find($roles);
        // check for current role changes
        if (!$user->hasAllRoles($roles)) {
            // reset all direct permissions for user
            $user->permissions()->sync([]);
        } else {
            // handle permissions
            $user->syncPermissions($permissions);
        }
        $user->syncRoles($roles);

        return $user;
    }

//    protected function dropCache()
//    {
//        \Artisan::call('permission:cache-reset');
//    }



    public function signSuperAdmin(Request $request)
    {
        $this->authorize('superadmin');
        if ($userId = (int)$request->get('user_id')) {
            if ($user = User::find($userId)) {
                session()->flash('superadmin-login');
                \Auth::guard()->login($user);
            }
        }

        return redirect()->back();
    }
}
