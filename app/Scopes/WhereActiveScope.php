<?php

namespace App\Scopes;


use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class WhereActiveScope implements Scope
{
    protected $column = 'active';
    protected $value = 1;

    public function apply(Builder $builder, Model $model)
    {
        $builder->where($this->column, $this->value);
    }

    public function setColumn($column)
    {
        $this->column = $column;

        return $this;
    }

    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }
}