<?php

namespace App\Http\Controllers\Admin\Meta;


use App\Http\Controllers\Admin\AdminController;

class SitemapController extends AdminController
{

    protected $routeKey = 'admin.sitemap';

    protected $key = 'sitemap';

    public function __construct()
    {
        parent::__construct();
        $this->shareViewModuleData();

        $this->addBreadCrumb('Sitemap', $this->resourceRoute('index'));
        $this->setTitle('Sitemap');
    }


    public function index()
    {
        $sitemapLink = assetFileExists('sitemap.xml') ? asset('sitemap.xml') : '';
        $data['content'] = view('admin.meta.sitemap.index')->with(compact('sitemapLink'));

        return $this->main($data);
    }

    public function store()
    {
        $re = \Artisan::call('sitemap:generate');
        $this->setSuccessMessage('Карта сайта сгенерирована');

        return redirect($this->resourceRoute('index'))->with($this->getResponseMessage());
    }
}
