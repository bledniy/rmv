<?php declare(strict_types=1);

namespace App\Http\Requests\Admin;

use App\Contracts\Requests\RequestParameterModelable;
use App\Helpers\Validation\ValidationMaxLengthHelper;
use App\Http\Requests\AbstractRequest;
use App\Models\News\News;
use App\Traits\Requests\Helpers\GetActionModel;

class FacultieRequest extends AbstractRequest implements RequestParameterModelable
{
    use GetActionModel;

    protected $toBooleans = ['active'];

    protected $requestKey = 'facultie';

    public function rules()
    {
        $rules = [
            'name' => ['required', 'max:255'],
            'excerpt' => ['max:' . ValidationMaxLengthHelper::TEXT],
            'description' => ['max:' . ValidationMaxLengthHelper::TEXT],
            'active' => ['nullable'],
        ];

        return $rules;
    }

}
