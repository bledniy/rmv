<?php declare(strict_types=1);

namespace App\Traits\Requests\User;

trait IsPasswordWasSend
{
    public function isPasswordsWasSend(array $except = []): bool
    {
        $passwords = $this->only(['password', 'password_new', 'password_new_confirmation']);
        $passwords = $this->exceptFields($passwords, $except);
        $passwordWasSend = array_filter(array_filter($passwords, 'strlen'));

        return (bool)$passwordWasSend;
    }

    public function isOnlyNewPasswordsWasSend(): bool
    {
        return $this->isPasswordsWasSend(['password']);
    }
}
