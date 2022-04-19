<?php declare(strict_types=1);

namespace App\Traits\Models;

use Illuminate\Support\Arr;

trait ImageAttributeTrait
{
    public function setImage($name): self
    {
        if (is_string($name)) {
            $column = 'image';
            $this->attributes[$column] = $name;
        }

        return $this;
    }

    public function getImage()
    {
        $column = 'image';

        return Arr::get($this->attributes, $column);
    }


}