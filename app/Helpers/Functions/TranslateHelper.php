<?php

use App\Models\Translate\Translate;

if (!function_exists('getTranslate')) {
    function getTranslate($key, $defaultText = null, $languageId = null)
    {
//			\App\Helpers\Sidebar\PageUsedTranslateHelper::addTranslate($key);
        return Translate::getTranslate($key, false, $languageId) ?? $defaultText ?? $key;
    }
}
if (!function_exists('translateFormat')) {
    function translateFormat($key, array $values, $languageId = null)
    {
        /** @var $translate Translate */
        $translate = Translate::getTranslate($key, true, $languageId);
        if ($translate instanceof Translate) {
            return str_replace(array_keys($values), array_values($values), $translate->value);
        }

        return '';
    }
}
if (!function_exists('translateYesNo')) {
    function translateYesNo($condition)
    {
        return $condition ? getTranslate('global.yes') : getTranslate('global.no');
    }
}