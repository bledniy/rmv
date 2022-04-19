<?php

namespace App\Traits\Models\Localization;

trait RedirectLangColumn
{

    public function getAttribute($key)
    {
        if (!array_key_exists($key, $this->attributes) && in_array($key, $this->langColumns ?? [], true)) {
            return $this->getLangColumn($key);
        }

        return parent::getAttribute($key);
    }
}