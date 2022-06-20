<?php


namespace App\Helpers\Date\MonthName;


use App\Helpers\Date\DateNamesHelpers\NumbersExtractor;

class MonthNameHelper
{

    /**
     * @var NumbersExtractor
     */
    private $numbersExtractor;

    public function __construct(NumbersExtractor $numbersExtractor)
    {
        $this->numbersExtractor = $numbersExtractor;
    }

    public function getNameByMonth(int $month): string
    {
        $month = $this->numbersExtractor->extractTenth($month);
        $month = $this->numbersExtractor->getForMatch($month);

        return trans_choice('date.months', $month);
    }

}