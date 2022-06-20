<?php


namespace App\Helpers\Date\DateNamesHelpers;


use Illuminate\Support\Str;

class NumbersExtractor
{
    private $withExcludeTeen = true;

    private $excludeTeen = [
        11, 12, 13, 14,
    ];

    public function extractTenth(int $number): int
    {
        if ($number < 100) {
            return $number;
        }

        return (int)Str::substr($number, -2);
    }


    public function getForMatch(int $number): int
    {
        if ($this->withExcludeTeen && in_array($number, $this->excludeTeen, true)) {
            return $number;
        }

        return $this->main($number);
    }

    private function main(int $number): int
    {
        $op = 10;
        $del = (int)floor($number / $op);
        if ($del) {
            $number -= ($del * $op);
        }
        if ($number === 0) {
            $number = $op;
        }

        return $number;
    }

    /**
     * @param bool $withExcludeTeen
     * @return NumbersExtractor
     */
    public function setWithExcludeTeen(bool $withExcludeTeen): self
    {
        $this->withExcludeTeen = $withExcludeTeen;

        return $this;
    }

    /**
     * @param int[] $excludeTeen
     * @return NumbersExtractor
     */
    public function setExcludeTeen(array $excludeTeen): self
    {
        $this->excludeTeen = $excludeTeen;

        return $this;
    }

    public function addExcludeTeen(int $exclude): self
    {
        $this->excludeTeen[] = $exclude;

        return $this;
    }
}