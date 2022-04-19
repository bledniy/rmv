<?php


namespace App\Widgets\Chart;


use App\Contracts\Widgets\Charts\ChartsContract;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;

abstract class BaseChart implements ChartsContract
{

    /** @var array */
    protected $options = [];

    /** @var LaravelChart */
    protected $chart;

    public function __construct(array $options = [])
    {
        $this->addOptions($options);
    }

    public function addOptions(array $options): void
    {
        $this->options = $options;
    }

    abstract public function handle(): LaravelChart;

    public function chart(): LaravelChart
    {
        if (!$this->chart) {
            $this->chart = $this->handle();
        }

        return $this->chart;
    }

    protected function mergeOptions(array $options, array $overrideOptions = [])
    {
        return array_merge($options, $overrideOptions);
    }
}