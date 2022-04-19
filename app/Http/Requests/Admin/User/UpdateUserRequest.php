<?php

namespace App\Http\Requests\Admin\User;

use App\Contracts\Requests\RequestParameterModelable;
use App\Http\Requests\AbstractRequest;
use App\Models\User;
use App\Traits\Requests\Helpers\GetActionModel;

class UpdateUserRequest extends AbstractRequest implements RequestParameterModelable
{
    protected $toIntegers = ['balance'];
    use GetActionModel;

    protected $requestKey = 'user';

    public function rules()
    {
        $phone = $this->getRegisterPhoneRule();
        if ($this->isActionUpdate() && $user = $this->getActionModel()) {
            /** @var  $user User */
            $phone['unique'] .= ',' . $user->id;
        }

        return array_merge(
            ['phone' => $phone],
            $this->getPersonal()
        );

    }

    protected function mergeRequestValues()
    {
        $this->mergeFormatPhone();
    }

}
