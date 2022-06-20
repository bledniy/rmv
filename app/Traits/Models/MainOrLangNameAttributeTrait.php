<?php

namespace App\Traits\Models;


trait MainOrLangNameAttributeTrait
{

    /**
     * @param string $column
     * @return mixed|string
     */
    public function getNameAttribute()
    {
        $column = 'name';

        return $this->getLangColumn($column);
    }

}