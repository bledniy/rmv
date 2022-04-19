<?php

use App\Models\Admin\Admin;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;


if (!function_exists('getCurrentLocaleCode')) {
    function getCurrentLocaleCode()
    {
        return LaravelLocalization::getCurrentLocale();
    }
}

if (!function_exists('isAdmin')) {
    function isAdmin()
    {
        static $isAdmin = null;
        if ($isAdmin === null) {
            /** @var  $user Admin */
            $user = Auth::guard('admin')->user();
            $isAdmin = ($user and $user->isAdmin());
        }

        return $isAdmin;
    }
}
if (!function_exists('isSuperAdmin')) {
    function isSuperAdmin()
    {
        static $result;
        if ($result === null) {
            /** @var $user Admin */
            $user = Auth::guard('admin')->user();
            $result = $user ? (bool)$user->isSuperAdmin() : false;
        }

        return $result;
    }

}

if (!function_exists('getDefaultLang')) {
    function getDefaultLang($column = 'id')
    {
        $lang = \App\Models\Language::default()->first();

        return $column ? Arr::get($lang, $column) : $lang;
    }
}
if (!function_exists('getCurrentLangId')) {
    function getCurrentLangId(): int
    {
        return (int)(\App\Helpers\LanguageHelper::getLanguageId() ?? getDefaultLang());
    }
}

if (!function_exists('normalizePath')) {
    function normalizePath($path)
    {
        $replace = [
            '\\' => '/',
            '\\\\' => '/',
        ];

        return str_replace(array_keys($replace), array_values($replace), $path);
    }
}
if (!function_exists('classImplementsInterface')) {
    function classImplementsInterface($class, $interface): bool
    {
        $interfaces = class_implements($class);

        return Arr::has($interfaces, $interface);
    }
}
if (!function_exists('getMeta')) {
    function getMeta()
    {
        return \App\Models\Meta::getMetaData() ?? \App\Models\Meta::getDefaultMeta();
    }
}
if (!function_exists('showMeta')) {
    function showMeta($value, $field = 'h1')
    {
        $meta = Arr::get(getMeta(), $field, $value);

        return $meta ?: $value;
    }
}


if (!function_exists('isJson')) {
    function isJson($str)
    {
        if (!is_string($str)) {
            return false;
        }

        \json_decode($str, true);
        if (\json_last_error()) {
            return false;
        }

        return true;
    }
}
if (!function_exists('getCurrencyIcon')) {
    function getCurrencyIcon()
    {
        return getSetting('global.currency');
    }
}

function replaceLettersSearchRuEn(string $string)
{
    $replace = [
        'ф' => 'a',
        'и' => 'b',
        'с' => 'c',
        'в' => 'd',
        'у' => 'e',
        'а' => 'f',
        'п' => 'g',
        'р' => 'h',
        'ш' => 'i',
        'о' => 'j',
        'л' => 'k',
        'д' => 'l',
        'ь' => 'm',
        'т' => 'n',
        'щ' => 'o',
        'з' => 'p',
        'й' => 'q',
        'к' => 'r',
        'ы' => 's',
        'е' => 't',
        'г' => 'u',
        'м' => 'v',
        'ц' => 'w',
        'ч' => 'x',
        'н' => 'y',
        'я' => 'z',
    ];

    return str_replace(array_keys($replace), array_values($replace), $string);
}

function routeKey(string $module, string $action = 'index')
{
    return implode('.', [routeKeys($module), $action]);
}


if (!function_exists('is_base64')) {
    function is_base64(string $str)
    {
        if (!is_string($str)) {
            return false;
        }

        return base64_encode(base64_decode($str)) === str_replace(["\n", "\r"], '', $str);
    }
}

function remakeInputKeyDotted($name)
{
    $replace = [
        ']' => '',
        '[' => '.',
    ];

    return str_replace(array_keys($replace), array_values($replace), $name);
}

function inputNamesManager(\App\Models\Model $model)
{
    return new \App\Helpers\Miscellaneous\InputNamesManager($model);
}

function CRUDLinkByModel(\Illuminate\Database\Eloquent\Model $model)
{
    return new \App\Helpers\Route\CRUDLinkByModel($model);
}

function titleFromInputName(string $name)
{
    return Str::title(str_replace('_', ' ', $name));
}
