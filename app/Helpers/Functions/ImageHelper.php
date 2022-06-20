<?php

use Illuminate\Support\Str;

function imgPathOriginal($pathToImage)
{
    return Str::replaceLast('_s.', '.', (string)$pathToImage);
}

function imgPathThumbnail($pathToImage)
{
    return Str::replaceLast('.', '_s.', (string)$pathToImage);
}


if (!function_exists('getPathToImage')) {
    function getPathToImage(?string $src = null, $default = 'svg/header-logo.svg', $disk = null): ?string
    {
        if (isExternalFile($src)) {
            return $src;
        }
        if (storageFileExists($src, $disk)) {
            return getStorageFilePath($src, $disk);
        }
        if (assetFileExists($src)) {
            return asset($src);
        }

        return asset($default);
    }
}

if (!function_exists('isExternalFile')) {
    function isExternalFile($src)
    {
        return isStringUrl($src);
    }
}