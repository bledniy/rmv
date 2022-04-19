<?php


namespace App\Traits\Controllers;

use App\Helpers\Miscellaneous\Breadcrumbs as BreadcrumbsService;

trait Breadcrumbs
{
    public function addBreadCrumb($breadName, $breadUrl = '')
    {
        BreadcrumbsService::addBreadCrumb($breadName, $breadUrl);

        return $this;
    }

    public function dropLastBreadCrumb()
    {
        BreadcrumbsService::dropLastBreadCrumb();
    }

    public function dropAllBreadCrumbs()
    {
        BreadcrumbsService::dropAllBreadCrumbs();
    }

    /**
     * @param bool $name
     * @return mixed
     */
    public function getBreadCrumbs($name = false)
    {
        return BreadcrumbsService::getBreadCrumbs($name);
    }
}