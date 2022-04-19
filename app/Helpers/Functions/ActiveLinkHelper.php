<?php

use Illuminate\Support\Facades\Request;

if (!function_exists('isMenuActive')) {
    function isMenuActive($url)
    {
        $lang = getCurrentLocaleCode();
        $langUrl = $lang . '/' . $url;

        return (
            Request::is($url) ||
            Request::is($url . '/*') ||
            Request::is($langUrl) ||
            Request::is($langUrl . '/*')
        );
    }
}

if (!function_exists('isAdminMenuActive')) {
    function isAdminMenuActive($url)
    {
        $url = 'admin/' . $url;

        return isMenuActive($url);
    }
}

if (!function_exists('isMenuActiveByUrl')) {
    function isMenuActiveByUrl($menuUrl)
    {
        $menuUrl = getNonLocaledUrl($menuUrl);
        $url = url()->current();
        if ($url === $menuUrl) {
            return true;
        }

        return (\Illuminate\Support\Str::startsWith($url, $menuUrl));
    }
}