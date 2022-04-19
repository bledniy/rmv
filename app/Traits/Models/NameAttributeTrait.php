<?php

namespace App\Traits\Models;


trait NameAttributeTrait
{
    /**
     * @param $name
     * @return NameAttributeTrait
     */
    public function setName($name): self
    {
        $column = 'name';
        $this->attributes[$column] = $name;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        $column = 'name';
        $name = \Arr::get($this->attributes, $column);

        return $name;
    }

}