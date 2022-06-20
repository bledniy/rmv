<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin\AdminMenu;
use App\Models\Menu;
use App\Repositories\Admin\AdminMenuRepository;
use App\Services\Admin\Nestable\DefaultNestableService;
use App\Traits\Authorizable;
use App\Traits\Controllers\SaveImageTrait;
use App\Traits\Controllers\ThumbnailSizes;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;

class AdminMenuController extends AdminController
{
    use Authorizable;
    use SaveImageTrait;
    use ThumbnailSizes;

    protected $thumbnailWidth = false;
    protected $thumbnailHeight = false;

    private $name = 'Admin menu';

    protected $permissionKey = 'admin-menus';

    protected $routeKey = 'admin.admin-menus';

    protected $key = 'admin-menus';

    public function __construct()
    {
        parent::__construct();
        $this->addBreadCrumb($this->name, $this->resourceRoute('index'));
        $this->shareViewModuleData();
    }

    public function index(AdminMenu $adminMenu, Request $request)
    {
        if ($request->has('seed')) {
            $this->setSuccessMessage('Данные обновлены');
            // todo move to service with dto
            if ($request->has('truncate')) {
                Artisan::call('backup:run');
                $this->setSuccessMessage('Данные удалены и добавлены заново');
                DB::table($adminMenu->getTable())->truncate();
            }
            seedByClass('AdminMenuSeeder');

            return redirect($this->resourceRoute('index'))->with($this->getResponseMessage());
        }
        $this->setTitle($this->name);

        $vars['list'] = AdminMenu::with('childrens')->where('parent_id', 0)->get();
        $data['content'] = view('admin.admin-menus.index', $vars);

        return $this->main($data);
    }

    /**
     * @param Request $request
     * @param AdminMenuRepository $adminMenuRepository
     * @return RedirectResponse|Redirector
     */
    public function updateAll(Request $request, AdminMenuRepository $adminMenuRepository)
    {
        $this->setFailUpdate();
        $adminMenuRepository->dropMenuCache();
        /** @var  $menus Collection */
        $menus = $adminMenuRepository->all();
        if ($menus->isNotEmpty()) {
            /** @var  $menu AdminMenu */
            foreach ($menus as $menu) {
                $inputManager = inputNamesManager($menu);
                $input = $request->input($inputManager->getNameInputRequest());
                if (!$input) {
                    continue;
                }
                $input['active'] = $request->input($inputManager->getNameInputRequestByKey('active'), 0);
                $menu->fillExisting($input)->save();
            }
            $this->setSuccessUpdate();
        }

        return redirect()->back()->with($this->getResponseMessage());
    }

    /**
     * @param AdminMenu $admin_menu
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(AdminMenu $admin_menu)
    {
        $vars['edit'] = $admin_menu;
        $title = $this->titleEdit($admin_menu);
        $this->addBreadCrumb($title)->setTitle($title);
        $data['content'] = view('admin.admin-menus.edit')->with($vars);

        return $this->main($data);
    }

    /**
     * @param Request $request
     * @param AdminMenu $admin_menu
     * @param AdminMenuRepository $adminMenuRepository
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, AdminMenu $admin_menu, AdminMenuRepository $adminMenuRepository)
    {
        $adminMenuRepository->dropMenuCache();
        //
        $input = $request->except('_token');

        $admin_menu->fillExisting($input);
        if ($admin_menu->save()) {
            $this->setSuccessUpdate();
            $this->saveImage($request, $admin_menu);
            $adminMenuRepository->dropMenuCache();
        }
        if ($request->has('saveClose')) {
            return redirect($this->resourceRoute('index'))->with($this->getResponseMessage());
        }

        return redirect()->back()->with($this->getResponseMessage());

    }

    /**
     * @param AdminMenu $admin_menu
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function create(AdminMenu $admin_menu)
    {
        $attrs = [
            'url' => '/admin/',
            'gate_rule' => 'view_',
            'active' => 1,
        ];
        $admin_menu->fillExisting($attrs);

        if ($admin_menu->save()) {
            $this->setSuccessStore();
        }

        return redirect($this->resourceRoute('index'))->with($this->getResponseMessage());
    }

    public function nesting(Request $request)
    {
        app(DefaultNestableService::class, ['modelClassName' => AdminMenu::class])->nestable($request->get('menus'));
        $this->fireEvents()->setSuccessUpdate();

        return $this->getResponseMessageForJson();
    }

    protected function fireEvents(): self
    {
        //todo fire event for cache clear
        Artisan::call('cache:clear');

        return $this;
    }


    /**
     * @param AdminMenu $admin_menu
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Exception
     */
    public function destroy(AdminMenu $admin_menu)
    {
        if ($admin_menu->delete()) {
            $this->setSuccessDestroy();
        }

        return redirect($this->resourceRoute('index'))->with($this->getResponseMessage());
    }

}
