<?php


namespace App\Models\Page\Traits;

use App\Models\Page\Page;
use Illuminate\Support\Arr;

/** @see Page */
trait PageHelpers
{

    public function getPageOption(string $option)
    {
        return Arr::get($this->getAttribute('options'), $option, []);
    }
}