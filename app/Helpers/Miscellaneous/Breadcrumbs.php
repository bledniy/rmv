<?php


namespace App\Helpers\Miscellaneous;


class Breadcrumbs
{
    public static $template = 'public.partials.breadcrumbs';

    protected static $breadcrumbsData = [];

    public static function addBreadCrumb($breadName, $breadUrl = '')
    {
        self::$breadcrumbsData[] = ['name' => $breadName, 'url' => $breadUrl];
    }

    public static function dropLastBreadCrumb()
    {
        if (self::$breadcrumbsData) {
            array_pop(self::$breadcrumbsData);
        }
    }

    public static function dropAllBreadCrumbs()
    {
        self::$breadcrumbsData = [];
    }

    /**
     * @param bool $name
     * @return array
     */
    public static function getBreadCrumbs($name = false)
    {
        if ($name) {
            self::addBreadCrumb($name);
        }

        return self::$breadcrumbsData;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public static function render()
    {
        return view(self::$template)->with(['breadcrumbs' => self::getBreadCrumbs()]);
    }

}