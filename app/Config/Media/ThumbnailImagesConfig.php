<?php

namespace App\Config\Media;

class ThumbnailImagesConfig
{
    public static function getSizesByKey(string $module): array
    {
        $key = $module;
        $defaultWidth = \Config::get($key . '.thumbnail.width', \Config::get('images.default.width'));
        $defaultHeight = \Config::get($key . '.thumbnail.height', \Config::get('images.default.height'));

        return [
            getSetting($key . '.image.width', $defaultWidth),
            getSetting($key . '.image.height', $defaultHeight),
        ];
    }
}