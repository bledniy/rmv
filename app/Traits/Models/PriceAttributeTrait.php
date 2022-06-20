<?php

namespace App\Traits\Models;
trait PriceAttributeTrait
{
    public function setPriceAttribute($price)
    {
        $column = 'price';
        $price = (float)$price;
        $price = (int)($price * 100);
        $this->attributes[$column] = $price;

        return $this;
    }

    public function getPriceAttribute()
    {
        $column = 'price';
        $price = (float)(\Arr::get($this->attributes, $column) / 100);

        return $price;
    }
}