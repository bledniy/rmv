<?php

namespace App\Helpers\Date\HoursName;


use App\Helpers\Date\DateNamesHelpers\NumbersExtractor;

class HoursNameHelper
{

    private $numbersExtractor;

    public function __construct(NumbersExtractor $numbersExtractor)
    {
        $this->numbersExtractor = $numbersExtractor;
    }

    public function getNameByHour(int $hour): string
    {
        if ($hour > 24) {
            $hour = $this->numbersExtractor->extractTenth($hour);
            $hour = $this->numbersExtractor->getForMatch($hour);
        }

        return trans_choice('date.hours', $hour);
    }

}