<?php

namespace App\Helpers\Date\SecondsName;


use App\Helpers\Date\DateNamesHelpers\NumbersExtractor;

class SecondsNameHelper
{
    /**
     * @var NumbersExtractor
     */
    private $numbersExtractor;

    public function __construct(NumbersExtractor $numbersExtractor)
    {
        $this->numbersExtractor = $numbersExtractor;
    }

    public function getNameBySeconds(int $seconds): string
    {
        $seconds = $this->numbersExtractor->extractTenth($seconds);
        $seconds = $this->numbersExtractor->getForMatch($seconds);

        return trans_choice('date.seconds', $seconds);
    }
}