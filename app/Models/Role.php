<?php

namespace App\Models;


use Psr\SimpleCache\InvalidArgumentException;

class Role extends \Spatie\Permission\Models\Role
{

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->setAttribute('guard_name', 'admin');
    }

    public static function getAllRoles()
    {
        $cacheKey = '';
        if (!$cache = \Cache::get($cacheKey)) {
            $cache = self::all();
            try {
                \Cache::set($cacheKey, $cache);
            } catch (InvalidArgumentException $e) {
            }
        }

        return $cache;
    }
}
