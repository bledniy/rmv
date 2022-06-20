<?php

namespace App\Traits;

use \Illuminate\Database\Eloquent\Builder;

trait EloquentScopes
{
    public function scopeWhereLike(Builder $query, $column, $value)
    {
        return $query->where($column, 'like', '%' . $value . '%');
    }

    /**
     * @param Builder $query
     * @param $column
     * @param $value
     * @return Builder
     */
    public function scopeOrWhereLike(Builder $query, $column, $value)
    {
        return $query->orWhere($column, 'like', '%' . $value . '%');
    }

}
