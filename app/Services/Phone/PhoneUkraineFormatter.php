<?php

namespace App\Services\Phone;

use Illuminate\Support\Str;

class PhoneUkraineFormatter
{
    public static function formatPhone(string $phone): string
    {
        $phone = extractDigits($phone);
        if (!$phone) {
            return $phone;
        }

        $code = '+380';
        $fullLength = 13;
        $subStrLimit = $fullLength - Str::length($phone);
        if ($subStrLimit) {
            if (Str::contains(Str::substr($phone, 0, $subStrLimit), '00')) {
                $phone = Str::replaceFirst('00', '0', $phone);
            }
            $prefix = Str::substr($code, 0, $subStrLimit);
            $phone = $prefix . $phone;
        }

        return $phone;
    }


}