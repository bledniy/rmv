<?php declare(strict_types=1);

namespace App\Http\Controllers\Admin;

class IndexController extends AdminController
{
    public function index()
    {
        $this->setTitle(__('modules._.dashboard'));
        $charts = collect([]);
        //todo add widgets from dealok

        $with = compact(array_keys(get_defined_vars()));
        $data['content'] = view('admin.index.dashboard')->with($with);

        return $this->main($data);
    }

    public function clearCache()
    {
        $this->setMessage('Cache Cleared!')->setStatus(true);
        \Artisan::call('cache:clear');

        return redirect()->back()->with($this->getResponseMessage());
    }

    public function clearView()
    {
        \Artisan::call('view:clear');
        $this->setMessage('Cache views cleared!')->setStatus(true);

        return redirect()->back()->with($this->getResponseMessage());
    }

    /**
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function storageLink()
    {
        $this->authorize('superadmin');
        \Artisan::call('storage:link');

        return redirect()->back()->with($this->getResponseMessage());
    }

    public function getCounters()
    {
        return [];
    }

}
