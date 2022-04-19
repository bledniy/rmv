<?php

namespace App\Http\Requests\Admin;

use App\Contracts\Requests\RequestParameterModelable;
use App\Enum\MenuGroupEnum;
use App\Http\Requests\AbstractRequest;
use Illuminate\Validation\Rule;

class MenuRequest extends AbstractRequest implements RequestParameterModelable
{
    protected $toBooleans = ['active'];

    public function rules(): array
    {
        $rules = [
            'name' => ['required'],
            'url' => ['required'],
            'group' => ['required', Rule::in(MenuGroupEnum::$enums)]
//            'parent_id' => ['required', 'exists:menus,id'],
        ];

        return $rules;
    }

    protected function mergeRequestValues()
    {
        $this->mergeUrlFromName();
        $this->merge([
            'parent_id' => (int)$this->get('parent_id'),
        ]);
    }
}
