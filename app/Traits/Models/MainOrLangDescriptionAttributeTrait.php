<?php

namespace App\Traits\Models;


trait MainOrLangDescriptionAttributeTrait
{

    /**
     * @param string $column
     * @return mixed|string
     */
    public function getDescriptionAttribute()
    {
        $column = 'description';

        return $this->getLangColumn($column);
    }

}