<?php

namespace App\Traits\Models;


trait DatesFromToAttributes
{

    /**
     * @param $from
     * @return $this
     */
    public function setDateFromAttribute($from): self
    {
        $this->attributes['date_from'] = $from;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDateFromAttribute()
    {
        return \Arr::get($this->attributes, 'date_from');
    }

    /**
     * @param $to
     * @return $this
     */
    public function setDateToAttribute($to): self
    {
        $this->attributes['date_to'] = $to;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDateToAttribute()
    {
        return \Arr::get($this->attributes, 'date_to');
    }

}