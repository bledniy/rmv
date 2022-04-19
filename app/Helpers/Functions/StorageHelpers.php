<?php

use App\Helpers\StorageHelper;

if (!function_exists('getStorageFilePath')) {
    function getStorageFilePath($filePath, $disk = null)
    {
        return StorageHelper::filePath($filePath, $disk);
    }
}
if (!function_exists('storageFileExists')) {
    function storageFileExists($filePath, $disk = null)
    {
        return StorageHelper::fileExists($filePath, $disk);
    }
}
if (!function_exists('storageFilemtime')) {
    function storageFilemtime($filePath, $disk = null)
    {
        return StorageHelper::lastModified($filePath, $disk);
    }
}
if (!function_exists('storageDelete')) {
    function storageDelete($filePath, $disk = null)
    {
        return StorageHelper::delete($filePath, $disk);
    }
}
if (!function_exists('storageDisk')) {
    function storageDisk($disk = null)
    {
        return \Storage::disk($disk);
    }
}
