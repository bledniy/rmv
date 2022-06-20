<?php declare(strict_types=1);

namespace App\Http\Controllers\Admin\Admin;

use App\DataContainers\Admin\Admin\SearchDataContainer;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Requests\Admin\UserProfileRequest;
use App\Models\Admin\Admin;
use App\Repositories\AdminRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use LaravelLocalization;

class AdminProfileController extends AdminController
{
    private $repository;

    /**
     * @var SearchDataContainer
     */

    public function __construct(AdminRepository $repository)
    {
        parent::__construct();
        $this->name = __('modules.users.title');
        $this->addBreadCrumb(__('modules.users.title'), $this->resourceRoute('index'));
        $this->shareViewModuleData();
    }

    public function profile()
    {
        $locales = LaravelLocalization::getSupportedLocales();
        $this->dropLastBreadCrumb();
        $title = __('modules.users.profile.title');
        $this->addBreadCrumb($title)->setTitle($title);
        $data['content'] = view('admin.admin.profile', [
            'user' => Auth::guard('admin')->user(),
            'locales' => $locales,
        ]);

        return $this->main($data);
    }

    public function profileUpdate(UserProfileRequest $request)
    {
        /** @var $admin Admin */
        $admin = Auth::guard('admin')->user();
        if ($request->isPasswordsWasSend()) {
            $passwordsMatches = Hash::check($request->get('password'), $admin->password);
            if ($passwordsMatches) {
                $admin->password = Hash::make($request->get('password_new'));
            } else {
                $this->setMessage(__('user.invalid-current-password'));

                return back()->with($this->getResponseMessage())->withInput($request->input());
            }
        }
        $this->setSuccessUpdate();
        $data = $request->only([
            'locale',
            'name',
        ]);
        $admin->fillExisting($data)->save();

        return redirect()->back()->with($this->getResponseMessage());
    }

}
