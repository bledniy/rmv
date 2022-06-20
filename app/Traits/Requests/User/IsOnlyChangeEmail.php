<?php


namespace App\Traits\Requests\User;

/**
 * Trait IsPasswordWasSend
 * @package App\Traits\Requests\User
 * applies to Illuminate\Http\Request
 */
trait IsOnlyChangeEmail
{

    /**
     * @return bool
     */
    public function isOnlyChangeEmail(): bool
    {
        $changesPassword = $this->isPasswordsWasSend();
        $isEmailWasChanged = $this->isEmailWasChanged();
        $oldPasswordWasSend = $this->isCurrentPasswordsWasSend();

        return ($changesPassword and $isEmailWasChanged and $oldPasswordWasSend);
    }

    /**
     * @return bool
     */
    public function isEmailWasChanged(): bool
    {
        return ($this->get('email') !== $this->getUser()->getAttribute('email'));
    }
}
