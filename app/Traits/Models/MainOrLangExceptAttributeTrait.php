<?php

namespace App\Traits\Models;


trait MainOrLangExceptAttributeTrait
{

    /**
     * @param string $column
     * @return mixed|string
     */
    public function getExceptAttribute()
    {
        $column = 'excerpt';

        return $this->getLangColumn($column);
    }

}