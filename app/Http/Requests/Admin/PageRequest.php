<?php declare(strict_types=1);

namespace App\Http\Requests\Admin;

use App\Contracts\Requests\RequestParameterModelable;
use App\Helpers\Validation\ValidationMaxLengthHelper;
use App\Http\Requests\AbstractRequest;
use App\Models\Page\Page;
use App\Traits\Requests\Helpers\GetActionModel;

class PageRequest extends AbstractRequest implements RequestParameterModelable
{
    use GetActionModel;

    protected $toBooleans = ['active'];

    protected $requestKey = 'page';

    public function rules(): array
    {
        //add url
        $rules =  [
            'name' => ['required', 'max:' . ValidationMaxLengthHelper::CHAR],
            'description' => ['max:' . ValidationMaxLengthHelper::MEDIUMTEXT],
            'excerpt' => ['max:' . ValidationMaxLengthHelper::TEXT],
            'image' => $this->getImageRule(),
            'url' => ['unique' =>'unique:pages,url']
        ];
        if ($this->isActionUpdate() && ($page = $this->getActionModel()) && is_a($page, Page::class)){
            $rules['url']['unique'] .= ','. $page->getKey();
        }
        return $rules;
    }

    protected function mergeRequestValues(): void
    {
        $this->mergeUrlFromTitle();
    }
}
