<?php

namespace App\Widgets;

abstract class AbstractWidget
{
    public function __construct()
    {

    }

    abstract public function renderWidget();

}