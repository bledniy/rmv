<?php


namespace App\Traits\Requests\User;

/**
 * Trait IsPasswordWasSend
 * @package App\Traits\Requests\User
 * applies to Illuminate\Http\Request
 */
trait IsCurrentPasswordWasSend
{
    /**
     * @return bool
     */
    public function isCurrentPasswordsWasSend(): bool
    {
        $currentPassword = $this->get('password');

        return (boolean)$currentPassword;
    }
}
