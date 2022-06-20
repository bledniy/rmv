<?php

namespace App\Traits\Models\User;

trait UserGetterTrait
{

    public function getPhone($field = 'phone'): string
    {
        return (string)$this->getAttribute($field);
    }

    public function getEmail($field = 'email'): string
    {
        return (string)$this->getAttribute($field);
    }

    public function getPhoneDisplay($field = 'phone'): string
    {
        return extractDigits($this->getAttribute($field));
    }

}
