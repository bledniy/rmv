<?php

use Illuminate\Support\Carbon;

if (!function_exists('getDateCarbon')) {
    function getDateCarbon($date, $format = 'Y-m-d H:i:s'): Carbon
    {
        if (isDateValid($date)) {
            return Carbon::parse($date);
        }

        return Carbon::parse(now()->format($format));
    }
}

function getDateCarbonIfValid($date = null): ?Carbon
{
    if (!isDateValid($date)) {
        return null;
    }

    return getDateCarbon($date);
}

function getDateFormatted($date): string
{
    $date = getDateCarbonIfValid($date);
    if (!$date) {
        return '';
    }

    return $date->formatLocalized('%d %B %Y, в %R');
}

if (!function_exists('isDateValid')) {
    function isDateValid($date): bool
    {
        if (!$date) {
            return false;
        }
        try {
            Carbon::parse($date);
        } catch (\Exception $e) {
            return false;
        }

        return true;
    }
}


if (!function_exists('dateFrom')) {
    function dateFrom($date): Carbon
    {
        $date = getDateCarbon($date);

        return Carbon::parse($date->format('Y-m-d H:i:s'));
    }
}
if (!function_exists('dateTo')) {
    function dateTo($date): Carbon
    {
        $date = getDateCarbon($date);

        return Carbon::parse($date->format('Y-m-d 23:59:59'));
    }

}


/**
 * @param Carbon $dateFrom
 * @param Carbon $dateTo
 * @param string $format
 * @return array
 */
if (!function_exists('generateDaysByDateRange')) {
    function generateDaysByDateRange(Carbon $dateFrom, Carbon $dateTo, $format = 'Y-m-d'): array
    {
        $days = [$dateFrom->format($format)];
        $dateFromCopy = clone $dateFrom;
        while ($dateFromCopy <= $dateTo) {
            $dateFromCopy = $dateFromCopy->addDay();
            $pickupString = $dateFromCopy;
            $days[] = $pickupString->format($format);
        }

        return $days;
    }
}

function isNightModeEnabled()
{
    $nowH = (int)now()->format('H');
    if ($nowH >= 21) {
        return true;
    }

    return ($nowH < 6);
}

function getNightMode()
{
    return (isSuperAdmin() && isNightModeEnabled()) ? 'night-mode' : '';
}


