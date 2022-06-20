<?php

namespace App\Traits\Models;


trait TitleAttributeTrait
{
    public function setTitleAttribute($name)
    {
        $column = 'title';
        $this->attributes[$column] = $name;

        return $this;
    }

    public function getTitleAttribute()
    {
        $column = 'title';
        $name = \Arr::get($this->attributes, $column);

        return $name;
    }

}