<?php

if (!function_exists('assetFileExists')) {
    function assetFileExists($filePath)
    {
        return file_exists(public_path('/' . $filePath));
    }
}
if (!function_exists('assetFilemtime')) {
    function assetFilemtime($filePath)
    {
        if (!assetFileExists($filePath)) {
            return time();
        }

        return filemtime(public_path('/' . $filePath));
    }
}
if (!function_exists('assetVersioned')) {
    function assetVersioned($asset_path): string
    {
        if (assetFileExists($asset_path)) {
            return asset($asset_path) . '?v=' . assetFilemtime($asset_path);
        }

        return '';
    }
}
if (!function_exists('assetGetContent')) {
    function assetGetContent($asset_path): string
    {
        if (assetFileExists($asset_path)) {
            return file_get_contents(public_path($asset_path));
        }

        return '';
    }
}
