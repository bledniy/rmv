<?php


namespace App\Helpers\User\View;


use Illuminate\Support\Str;

class PhoneDisplay
{
    public static function display(string $phone): string
    {
        $pos = mb_strlen('+38');
        $sub = Str::substr($phone, $pos, 3);
        $phone = Str::replaceFirst($sub, sprintf(' (%s) ', $sub), $phone);
        $insert = [-4, -2];
        foreach ($insert as $pos) {
            $sub = Str::substr($phone, $pos);
            $phone = Str::replaceLast($sub, sprintf(' %s', $sub), $phone);
        }

        return $phone;
    }

}