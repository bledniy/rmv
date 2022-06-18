<?php declare(strict_types=1);

namespace App\Http\Requests\Admin;

use App\Contracts\Requests\RequestParameterModelable;
use App\Helpers\Validation\ValidationMaxLengthHelper;
use App\Http\Requests\AbstractRequest;
use App\Models\News\News;
use App\Traits\Requests\Helpers\GetActionModel;

class DocumentRequest extends AbstractRequest implements RequestParameterModelable
{
    use GetActionModel;

    protected $toBooleans = ['active'];

    protected $requestKey = 'document';

    public function rules()
    {
        $rules = [
            'video' => ['nullable', 'max:255'],
            'name' => ['required', 'max:255'],
//            'url' => ['required', 'unique' => 'unique:news,url'],
            'published_at' => ['required', 'date'],
            'excerpt' => ['max:' . ValidationMaxLengthHelper::TEXT],
            'description' => ['max:' . ValidationMaxLengthHelper::TEXT],
            'file' => ['nullable'],
            'active' => ['nullable'],
        ];

//        if ($this->isActionUpdate() && $news = $this->getActionModel()) {
            /** @var  $news News */
//            $rules['url']['unique'] = 'unique:news,url,' . $news->getKey();
//        }

        return $rules;
    }


    protected function mergeRequestValues()
    {
//        $this->mergeUrlFromName();
        $this->merge([
            'published_at' => getDateCarbon($this->get('published_at')),
            'video' => $this->get('video'),
        ]);
    }
}
