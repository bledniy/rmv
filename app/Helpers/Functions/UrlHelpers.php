<?php

use Illuminate\Support\Str;

if (!function_exists('isStringUrl')) {
    function isStringUrl($string)
    {
        $http = Str::startsWith($string, 'http://');
        $https = Str::startsWith($string, 'https://');
        $double = Str::startsWith($string, '//');

        return ($http or $https or $double);
    }
}

if (!function_exists('getHost')) {
    function getHost()
    {
        return request()->getHost();
    }
}
if (!function_exists('getProtocol')) {
    function getProtocol()
    {
        return request()->isSecure() ? 'https' : 'http';
    }
}


if (!function_exists('langUrl')) {
    function langUrl($url, $locale = false): string
    {
        $localeCode = $locale ?: getCurrentLocaleCode();

        return \LaravelLocalization::getLocalizedURL($localeCode, $url, [], false);
    }
}
function frontendUrl($url): string
{
    return env('FRONT_APP_URL') . '/' . trim($url, '/');
}

if (!function_exists('getNonLocaledUrl')) {
    function getNonLocaledUrl($url = null)
    {
        if ($url === null) {
            $url = request()->getPathInfo();
        }

        return \LaravelLocalization::getNonLocalizedURL($url);
    }
}

if (!function_exists('urlWithoutPublic')) {
    function urlWithoutPublic($url)
    {
        return Str::replaceFirst('/public', '', $url);
    }
}

if (!function_exists('getUrlWithoutHost')) {
    function getUrlWithoutHost($url)
    {
        $url = urlWithoutPublic($url);

        return parse_url(getNonLocaledUrl($url), PHP_URL_PATH);
    }
}

function urlClearSlashes(string $url)
{
    return trim($url, '/');
}

if (!function_exists('isLink')) {
    function isLink($str = null)
    {
        return filter_var($str, FILTER_VALIDATE_URL);
    }
}

function urlEntityEdit(\Illuminate\Database\Eloquent\Model $model, $action = 'edit')
{
    try {
        return CRUDLinkByModel($model)->{$action}();
    } catch (\Exception $e) {
        return '';
    }
}


function routeKeys(string $module)
{
    $prepend = '';
    $keys = [
        'sitemap' => 'admin.sitemap',
        'robots' => 'admin.robots',
        'users' => 'admin.users',
        'roles' => 'admin.roles',
        'settings' => 'admin.settings',
        'translate' => 'admin.translate',
        'meta' => 'admin.meta',
        'menus' => 'admin.menu',
        //
        'pages' => 'admin.pages',
        'news' => 'admin.news',
        'feedback' => 'admin.feedback',
        'sliders' => 'admin.sliders',
        'faqs' => 'admin.faq',
        'orders' => 'admin.orders',
        'categories' => 'admin.categories',
        'products' => 'admin.products',
    ];

    return $prepend . ((string)Arr::get($keys, $module));
}

function isCartPage(): bool
{
    return Route::is('cart.index');
}