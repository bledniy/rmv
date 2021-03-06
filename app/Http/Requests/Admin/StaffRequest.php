<?php declare(strict_types=1);

namespace App\Http\Requests\Admin;

use App\Contracts\Requests\RequestParameterModelable;
use App\Helpers\Validation\ValidationMaxLengthHelper;
use App\Http\Requests\AbstractRequest;
use App\Traits\Requests\Helpers\GetActionModel;

class StaffRequest extends AbstractRequest implements RequestParameterModelable
{
    use GetActionModel;

    protected $toBooleans = ['active'];

    protected $requestKey = 'staff';

    public function rules()
    {
        $rules = [
            'name' => ['required', 'max:255'],
            'description' => ['max:' . ValidationMaxLengthHelper::TEXT],
            'active' => ['nullable'],
            'email' => ['nullable', 'string'],
            'phone' => ['nullable', 'string'],
            'department_id' => ['nullable', 'exists:departments,id'],
            'faculty_id' => ['nullable', 'exists:faculties,id'],
            'type' => ['nullable', 'string'],
            'sort' => ['nullable'],
            'image' => [$this->getImageRule()],
        ];

        return $rules;
    }

}
