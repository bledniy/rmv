<?php
/**
 * Created by PhpStorm.
 * User: aljajazva
 * Date: 2019-06-20
 * Time: 12:57
 */

namespace App\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class SortOrderScope implements Scope
{
    public function apply(Builder $builder, Model $model)
    {
        $builder->orderBy('sort')->orderByDesc('id');
    }
}