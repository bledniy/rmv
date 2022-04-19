<?php

namespace App\Helpers\Sidebar;
final class PageUsedSettingsHelper
{

    private static $usedKeys = [];

    public static function addSetting(?string $settingsKey = null): void
    {
        if (!$settingsKey) {
            return;
        }
        static::$usedKeys[$settingsKey] = $settingsKey;
    }

    public static function isSettingUsed(string $settingsKey): bool
    {
        return static::$usedKeys[$settingsKey] ?? false;
    }

    public static function removeUsedSetting(string $settingsKey): void
    {
        if (!static::isSettingUsed($settingsKey)) {
            return;
        }
        unset(static::$usedKeys[$settingsKey]);
    }

    public static function getUsedSettingsList(): array
    {
        return static::$usedKeys;
    }
}