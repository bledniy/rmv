<?php

namespace App\Traits;

trait Builder
{
    protected $builderData = [];

    public function clearBuilderData()
    {
        $this->builderData = [];

        return $this;
    }

    public function getData($key, $default = null)
    {
        return \Arr::get($this->builderData, $key, $default);

    }

    public function setData($key, $value)
    {
        \Arr::set($this->builderData, $key, $value);

        return $this;
    }

}