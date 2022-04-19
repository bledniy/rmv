<?php


namespace App\Traits\Models;


trait PrevNextAttributes
{

    public function setPrevIdAttribute($value): void
    {
        $this->attributes['prev_id'] = $value;
    }

    public function setNextIdAttribute($value): void
    {
        $this->attributes['next_id'] = $value;
    }

}