<?php

namespace App\Traits\Models;


trait UrlAttributeTrait
{
    /**
     * @param $url
     * @return UrlAttributeTrait
     */
    public function setUrlAttribute($url): self
    {
        $url = \Str::slug($url);
        $column = 'url';
        $this->attributes[$column] = $url;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getUrlAttribute()
    {
        $column = 'url';
        $name = \Arr::get($this->attributes, $column);

        return $name;
    }

}