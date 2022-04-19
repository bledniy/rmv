<?php

use App\Models\Setting;
use Illuminate\Support\Arr;

if (!function_exists('getSetting')) {
    function getSetting($key, $default = null)
    {
        \App\Helpers\Sidebar\PageUsedSettingsHelper::addSetting($key);

        return Setting::getSetting($key) ?? $default;
    }
}

function settingsEditIfAdmin(string $key): string
{
    if (!isAdmin()){
        return '';
    }
    return editLinkAdmin(route('settings.index') . '?search=' . $key);
}

if (!function_exists('getSettingIfProd')) {
    function getSettingIfProd($key, $default = null)
    {
        if (isLocalEnv()) {
            return '';
        }
        \App\Helpers\Sidebar\PageUsedSettingsHelper::addSetting($key);

        return getSetting($key, $default);
    }
}

if (!function_exists('setting')) {
    function setting($key, $asValue = false)
    {
        \App\Helpers\Sidebar\PageUsedSettingsHelper::addSetting($key);

        return Setting::getSetting($key, $asValue);
    }
}

function displayUsedSetting($key)
{
    return getSetting($key);
}

if (!function_exists('settingExistedFiles')) {
    function settingExistedFiles($key = null)
    {
        $files = collect([]);
        $value = Arr::get(setting($key), 'value');
        if ($value && isJson($value)) {
            $files = collect(\json_decode($value, true))->filter(function ($setting) {
                return storageFileExists($setting['download_link'] ?? '');
            });
        }

        return $files;
    }
}

if (!function_exists('settingExistedFile')) {
    function settingExistedFile($key = null)
    {
        $files = settingExistedFiles($key);
        if ($files->isEmpty()) {
            return null;
        }

        return $files->first();
    }
}

if (!function_exists('settingFileFilesystemPath')) {
    function settingFileFilesystemPath($key = null): string
    {
        $file = settingExistedFile($key);
        if (!$file || !Arr::has($file, 'download_link')) {
            return '';
        }

        return storageDisk()->path(Arr::get($file, 'download_link'));
    }
}

if (!function_exists('settingFile')) {
    function settingFile($key = null)
    {
        $files = settingExistedFiles($key);
        if ($files->isEmpty()) {
            return '';
        }
        $first = $files->first();

        return getStorageFilePath($first['download_link'] ?? '');
    }
}

if (!function_exists('settingFiles')) {
    function settingFiles($key): \Illuminate\Support\Collection
    {
        $files = settingExistedFiles($key);
        if ($files->isEmpty()) {
            return $files;
        }

        return $files->map(function ($item) {
            $item['original'] = $item;
            $link = getStorageFilePath(Arr::get($item, 'download_link'));
            Arr::set($item, 'download_link', $link);

            return $item;
        });
    }
}