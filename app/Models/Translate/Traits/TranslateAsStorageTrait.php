<?php

namespace App\Models\Translate\Traits;

use App\Models\Translate\TranslateLang;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Support\Arr;

trait TranslateAsStorageTrait
{
    /** @see \App\Models\Translate\Translate */

    private static $translates;

    public static function getTranslate($key, $asObject = false, $languageId = null)
    {
        $languageId = $languageId ?? getCurrentLangId();

        return $asObject
            ? static::getTranslates($languageId, $key)
            : Arr::get(static::getTranslates($languageId, $key), 'value');
    }

    public static function getTranslates($langId, $key = false)
    {

        static::loadTranslatesOfLanguageIfNotLoaded($langId);

        if (!$key) {
            return Arr::get(static::$translates, $langId);
        }
        if (!static::isExistsTranslateByLangAndKey($langId, $key)) {
            return null;
        }

        return static::getTranslateByTranslateByLangAndKey($langId, $key);

    }

    private static function loadTranslatesOfLanguageIfNotLoaded($languageKey): void
    {
        $langModel = app(TranslateLang::class);
        if (!Arr::has(static::$translates, $languageKey)) {
            $translates = static::leftJoin($langModel->getTable(), function (JoinClause $q) use ($langModel, $languageKey) {
                return $q->on($langModel->translate()->getForeignKeyName(), 'id')
                    ->on('language_id', '=', \DB::raw($languageKey))
                    ;
            })->get()->keyBy('key')
            ;
            Arr::set(static::$translates, $languageKey, $translates);
        }
    }

    private static function isExistsTranslateByLangAndKey($langId, $key): bool
    {
        if (!(self::$translates[$langId] ?? false)) {
            return false;
        }

        return (bool)(self::$translates[$langId][$key] ?? false);
    }

    private static function getTranslateByTranslateByLangAndKey($langId, $key): ?self
    {
        return (!self::isExistsTranslateByLangAndKey($langId, $key)) ? null : self::$translates[$langId][$key];
    }

}