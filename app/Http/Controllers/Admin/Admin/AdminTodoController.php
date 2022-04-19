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

class AdminTodoController extends AbstractAdminController
{
    use Authorizable;

    protected $routeKey = 'admin.todo';

    protected $permissionKey = 'todo';

    protected $key = 'todo';

    public function __construct()
    {
        parent::__construct();
        $this->addBreadCrumb(__('modules.users.title'), $this->resourceRoute('index'));
        $this->shareViewModuleData();

        $this->setTitle('TODO');
    }

    public function index()
    {
        $data['content'] = view('admin.admin.todo.todo');

        return $this->main($data);
    }

}
