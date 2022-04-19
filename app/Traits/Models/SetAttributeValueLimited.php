<?php


namespace App\Traits\Models;

trait SetAttributeValueLimited
{
    public function setAttributeWithLimit($value, $limit = 255, $attribute = 'value')
    {
        $value = \Str::limit($value, $limit);
        \Arr::set($this->attributes, $attribute, $value);

        return $this;
    }
}
