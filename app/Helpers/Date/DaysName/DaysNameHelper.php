<?php

namespace App\Helpers\Date\DaysName;


use App\Helpers\Date\DateNamesHelpers\NumbersExtractor;

class DaysNameHelper
{
    /**
     * @var NumbersExtractor
     */
    private $numbersExtractor;

    public function __construct(NumbersExtractor $numbersExtractor)
    {
        $this->numbersExtractor = $numbersExtractor;
    }

    public function getNameByDay(int $day): string
    {
        if (0 !== $day) {
            $day = $this->numbersExtractor->extractTenth($day);
            $day = $this->numbersExtractor->getForMatch($day);
        }

        return trans_choice('date.days', $day);
    }
}