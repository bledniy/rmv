<?php
/**
 * Created by PhpStorm.
 * User: aljajazva
 * Date: 2019-04-10
 * Time: 16:39
 */

namespace App\Helpers;


class StorageHelper
{
    public static function fileExists($filename, $disk = null)
    {
        return \Storage::disk($disk)->exists($filename);
    }

    public static function filePath($filename, $disk = null)
    {
        return \Storage::disk($disk)->url($filename);
    }

    public static function delete($filename, $disk = null)
    {
        if (self::fileExists($filename, $disk)) {
            return \Storage::disk($disk)->delete($filename);
        }

        return false;
    }

    public static function lastModified($filename, $disk = null)
    {
        if (!self::fileExists($filename)) {
            return '';
        }

        return \Storage::disk($disk)->lastModified($filename);
    }
}