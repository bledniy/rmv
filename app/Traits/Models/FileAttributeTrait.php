<?php declare(strict_types=1);

namespace App\Traits\Models;

use Illuminate\Support\Arr;

trait FileAttributeTrait
{
    public function setFile($name): self
    {
        if (is_string($name)) {
            $column = 'file';
            $this->attributes[$column] = $name;
        }

        return $this;
    }

    public function getFile()
    {
        $column = 'file';

        return Arr::get($this->attributes, $column);
    }


}