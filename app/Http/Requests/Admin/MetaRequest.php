<?php declare(strict_types=1);

namespace App\Http\Requests\Admin;

use App\Contracts\Requests\RequestParameterModelable;
use App\Helpers\Validation\ValidationMaxLengthHelper;
use App\Http\Requests\AbstractRequest;
use App\Models\Meta;
use App\Services\Seo\SeoUrlRewriterInterface;
use App\Traits\Requests\Helpers\GetActionModel;

class MetaRequest extends AbstractRequest implements RequestParameterModelable
{

    protected $requestKey = 'meta';
    protected $toBooleans = ['active'];
    use GetActionModel;


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'h1' => ['max:255'],
            'title' => ['max:255'],
            'keywords' => ['max:500'],
            'description' => ['max:1000'],
            'url' => ['max:160', 'unique:meta,url'],
            'header' => ['max:' . ValidationMaxLengthHelper::TEXT],
            'footer' => ['max:' . ValidationMaxLengthHelper::TEXT],
            'text_top_' => ['max:' . ValidationMaxLengthHelper::TEXT],
            'text_text_bottom' => ['max:' . ValidationMaxLengthHelper::MEDIUMTEXT],
        ];
        /** @var $meta Meta */
        if ($this->isActionUpdate() and $meta = $this->getActionModel()) {
            unset($rules['url']);
        }

        return $rules;
    }

    protected function mergeRequestValues()
    {
        if ($this->isActionUpdate()) {
            return;
        }
        $url = $this->get('url');
        $requestUrlRewriter = app(SeoUrlRewriterInterface::class);
        if ($requestUrlRewriter->supportsRewrite($url)) {
            $url = $requestUrlRewriter->rewrite($url);
        } else {
            $url = Meta::makeUrlClear($this->get('url'));
        }
        $this->merge(['url' => $url]);

        $this->request->replace(array_merge($this->all(), ['url' => $url]));
    }
}
