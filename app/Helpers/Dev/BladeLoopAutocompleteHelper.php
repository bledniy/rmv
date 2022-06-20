<?php declare(strict_types=1);

namespace App\Helpers\Dev;

abstract class BladeLoopAutocompleteHelper
{
    public $iteration = 1;
    public $index = 0;
    public $remaining = 0;
    public $count = 1;
    /**
     * @var null|self
     */
    public $parent = null;
    public $first = true;
    public $last = true;
    public $even = true;
    public $odd = false;
    public $depth = 1;

}