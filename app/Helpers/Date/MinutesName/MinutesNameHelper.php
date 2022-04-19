<?php

namespace App\Helpers\Date\MinutesName;


use App\Helpers\Date\DateNamesHelpers\NumbersExtractor;

class MinutesNameHelper
{
    /**
     * @var NumbersExtractor
     */
    private $numbersExtractor;

    public function __construct(NumbersExtractor $numbersExtractor)
    {
        $this->numbersExtractor = $numbersExtractor;
    }

    public function getNameByMinutes(int $minutes): string
    {
        $minutes = $this->numbersExtractor->extractTenth($minutes);
        $minutes = $this->numbersExtractor->getForMatch($minutes);

        return trans_choice('date.minutes', $minutes);
    }
}