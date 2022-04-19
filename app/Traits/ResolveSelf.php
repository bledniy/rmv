<?php

namespace App\Traits;

trait ResolveSelf
{
    public static function resolveSelf(): self
    {
        return resolve(self::class);
    }
}