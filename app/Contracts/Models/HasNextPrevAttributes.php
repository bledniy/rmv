<?php


namespace App\Contracts\Models;


interface HasNextPrevAttributes
{
    public function setPrevIdAttribute($value);

    public function setNextIdAttribute($value);
}