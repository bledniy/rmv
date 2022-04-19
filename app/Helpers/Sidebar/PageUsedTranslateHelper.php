<?php

namespace App\Helpers\Sidebar;
final class PageUsedTranslateHelper
{

    private static $usedKeys = [];

    public static function addTranslate(?string $key = null): void
    {
        if (!$key) {
            return;
        }
        static::$usedKeys[$key] = $key;
    }

    public static function isTranslateUsed(string $key): bool
    {
        return static::$usedKeys[$key] ?? false;
    }

    public static function removeUsedTranslate(string $key): void
    {
        if (!static::isTranslateUsed($key)) {
            return;
        }
        unset(static::$usedKeys[$key]);
    }

    public static function getUsedTranslatesList(): array
    {
        return static::$usedKeys;
    }
}