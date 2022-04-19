<?php

namespace App\Http\Controllers\Admin\Meta;

use App\Http\Controllers\Admin\AdminController;
use App\Http\Requests\Admin\RedirectRequest;
use App\Models\Redirect;
use App\Traits\Authorizable;
use Illuminate\Support\Facades\Artisan;
use View;

class RedirectController extends AdminController
{
    use Authorizable;

    protected $key = 'redirects';

    protected $routeKey = 'admin.redirects';

    protected $permissionKey = 'redirect';

    protected $name = 'Перенаправления';

    public function __construct()
    {
        parent::__construct();
        $this->addBreadCrumb($this->name, $this->resourceRoute('index'));
        $this->shareViewModuleData();
        View::share('codes', Redirect::getCodes());
    }

    public function index()
    {
        $this->setTitle($this->name);
        $vars['list'] = Redirect::query()->latest()->paginate();
        $data['content'] = view('admin.redirects.index', $vars);

        return $this->main($data);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $data['content'] = view('admin.redirects.create');

        return $this->main($data);
    }

    public function store(RedirectRequest $request, Redirect $redirect)
    {
        $input = $request->all();
        if ($redirect->fillExisting($input)->save()) {
            $this->setSuccessStore();
        }
        if ($request->has('createOpen')) {
            return redirect($this->resourceRoute('edit', $redirect->getKey()))->with($this->getResponseMessage());
        }

        return redirect($this->resourceRoute('index'))->with($this->getResponseMessage());
    }

    /**
     * @param Redirect $redirect
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Redirect $redirect)
    {
        $edit = $redirect;
        $title = $this->titleEdit($edit, 'url');
        $this->setTitle($title)->addBreadCrumb($title);
        $data['content'] = view('admin.redirects.edit', compact('edit'));

        return $this->main($data);
    }

    public function update(RedirectRequest $request, Redirect $redirect)
    {
        $input = $request->except('_token');
        $redirect->fillExisting($input);
        if ($redirect->save()) {
            $this->setSuccessUpdate();
        }
        if ($request->has('saveClose')) {
            return redirect($this->resourceRoute('index'))->with($this->getResponseMessage());
        }

        return redirect()->back()->with($this->getResponseMessage());
    }

    public function destroy(Redirect $redirect)
    {
        if ($redirect->delete()) {
            $this->setSuccessDestroy();
        }

        return redirect($this->resourceRoute('index'))->with($this->getResponseMessage());
    }

    public function toLower()
    {
        Artisan::call('url:remove-upper');

        return redirect($this->resourceRoute('index'))->with('success', 'Ссылки успешно переведены в нижний регистр!');
    }
}
