<?php


namespace App\Contracts\Widgets\Charts;


use LaravelDaily\LaravelCharts\Classes\LaravelChart;

interface ChartsContract
{
    public function chart(): LaravelChart;

    public function addOptions(array $options);
}