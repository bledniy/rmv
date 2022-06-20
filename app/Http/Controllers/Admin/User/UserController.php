<?php declare(strict_types=1);

namespace App\Http\Controllers\Admin\User;

use App\DataContainers\Admin\User\SearchDataContainer;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Requests\Admin\User\UpdateUserRequest;
use App\Models\User;
use App\Repositories\UserRepository;
use App\Traits\Authorizable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends AdminController
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
        $with = compact(array_keys(get_defined_vars()));
        $data['content'] = view('admin.user.index')->with($with);

        return $this->main($data);
    }

    public function create()
    {
        $title = __('form.create');
        $this->setTitle($title)->addBreadCrumb($title);
        $data['content'] = view('admin.user.create');

        return $this->main($data);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => ['bail', 'required', 'min:2'],
            'email' => ['nullable', 'email', 'unique:users'],
            'password' => ['required', 'min:6'],
        ]);
        $this->setSuccessStore();
        $request->merge(['password' => Hash::make($request->get('password'))]);
        // Create the user
        $input = $request->except('roles', 'permissions');
        $input['active'] = (int)$request->get('active');
        $input['balance'] = (int)$request->get('balance');

        if ($user = $this->repository->create($input)) {
            $this->setSuccessStore();
        }
        if ($request->has('createOpen')) {
            return redirect($this->resourceRoute('edit', $user->id))->with($this->getResponseMessage());
        }

        return redirect($this->resourceRoute('index'))->with($this->getResponseMessage());
    }

    public function edit($id)
    {
        $user = $edit = $this->repository->applyFilter($this->searchDataContainer)->find($id);
        $title = $this->titleEdit($edit);
        $this->addBreadCrumb($title)->setTitle($title);
        $with = compact(array_keys(get_defined_vars()));
        $data['content'] = view('admin.user.edit')->with($with);

        return $this->main($data);
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $this->setSuccessUpdate();
        $user = $this->repository->applyFilter($this->searchDataContainer)->find($user->id);
        $input = $request->except('password');
        $user->fillExisting($input);
        if ($request->get('password')) {
            $user->password = bcrypt($request->get('password'));
        }
        if ($user->save()) {
            $this->setSuccessUpdate();
        }

        if ($request->has('saveClose')) {
            return redirect($this->resourceRoute('index'))->with($this->getResponseMessage());
        }

        return redirect()->back()->with($this->getResponseMessage());
    }


    public function destroy($id)
    {
        $this->setFailMessage('User not deleted');
        if ($this->repository->applyFilter($this->searchDataContainer)->find($id)->delete()) {
            $this->setSuccessMessage('User has been deleted');
        }

        return redirect()->back()->with($this->getResponseMessage());
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function signSuperAdmin(Request $request)
    {
        $this->authorize('superadmin');
        if (($userId = (int)$request->get('user_id')) && $user = User::find($userId)) {
            session()->flash('superadmin-login');
            \Auth::guard('user')->login($user);
        }

        return redirect()->back();
    }
}
