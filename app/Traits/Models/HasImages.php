<?php

namespace App\Traits\Models;

use App\Models\Image;
use Illuminate\Support\Collection;

trait HasImages
{
    /**
     * @return mixed
     */
    public function images()
    {
        return $this->morphMany('App\Models\Image', 'imageable');
    }

    /**
     * @return Collection | Image[]
     */
    public function getImages(): Collection
    {
        return $this->images;
    }

}