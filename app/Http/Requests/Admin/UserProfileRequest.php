<?php declare(strict_types=1);

namespace App\Http\Requests\Admin;

use App\Http\Requests\AbstractRequest;
use App\Traits\Requests\User\IsPasswordWasSend;
use Illuminate\Validation\Rule;
use LaravelLocalization;

class UserProfileRequest extends AbstractRequest
{
    use IsPasswordWasSend;

    public function rules(): array
    {
        $localesIn = array_keys(LaravelLocalization::getSupportedLocales());
        $rules = [
            'name' => ['required', 'min:2', 'alpha_num'],
            'locale' => ['required', Rule::in($localesIn)],
        ];
        if ($this->isPasswordsWasSend()) {
            $rules += [
                'password' => ['required', 'min:6'],
                'password_new' => ['required', 'confirmed', 'min:6', 'different:password'],
                'password_new_confirmation' => ['required', 'min:6'],
            ];
        }

        return $rules;
    }

}
