<?php


namespace App\Helpers\Date\DateNamesHelpers;


use Illuminate\Support\Str;

class RangeGenerator
{
    public function generate(array $range): array
    {
        $matches = [];
        foreach ($range as $num => $match) {
            if (Str::contains($num, '-')) {
                foreach (range(...explode('-', $num)) as $item) {
                    $matches[(int)$item] = $match;
                }
                continue;
            }
            $matches[(int)$num] = $match;
        }

        return $matches;
    }
}