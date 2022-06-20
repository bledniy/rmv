<?php
/**
 * Created by PhpStorm.
 * User: aljajazva
 * Date: 2019-05-27
 * Time: 15:36
 */

namespace App\Helpers;


class LanguageHelper
{

    protected static $lang;

    public static function setLanguageId(int $lang): void
    {
        static::$lang = $lang;
    }

    public static function getLanguageId()
    {
        return static::$lang;
    }

}