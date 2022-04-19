<?php


namespace App\Helpers\Date\YearName;


use App\Helpers\Date\DateNamesHelpers\NumbersExtractor;

class YearNameHelper
{

    /**
     * @var NumbersExtractor
     */
    private $numbersExtractor;

    public function __construct(NumbersExtractor $numbersExtractor)
    {
        $this->numbersExtractor = $numbersExtractor;
    }

    public function getNameByYear(int $year): string
    {
        $year = $this->numbersExtractor->extractTenth($year);
        $year = $this->numbersExtractor->getForMatch($year);

        return trans_choice('date.years', $year);
    }

}