<?php

namespace App\Http\Requests\Admin;

use App\Contracts\Requests\RequestParameterModelable;
use App\Http\Requests\AbstractRequest;
use App\Models\Redirect;
use App\Traits\Requests\Helpers\GetActionModel;
use Illuminate\Support\Str;

class RedirectRequest extends AbstractRequest implements RequestParameterModelable
{
    protected $requestKey = 'redirect';

    protected $toBooleans = ['active'];

    use GetActionModel;

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $codes = array_keys(Redirect::getCodes());
        $rules = [
            'from' => ['required', 'unique' => 'unique:redirects,from', 'max:160', 'different:to'],
            'to' => ['required', 'unique' => 'unique:redirects,to', 'max:160'],
            'code' => ['required', 'in:' . implode(',', $codes)],
        ];

        /** @var $redirects Redirect */
        if ($this->isActionUpdate() and $redirects = $this->getActionModel()) {
            $rules['from']['unique'] = 'unique:redirects,from,' . $redirects->getKey();
            $rules['to']['unique'] = 'unique:redirects,to,' . $redirects->getKey();
        }

        return $rules;
    }

    protected function mergeRequestValues()
    {
        $from = parse_url(getNonLocaledUrl(Str::lower($this->get('from'))), PHP_URL_PATH);
        $to = parse_url(getNonLocaledUrl(Str::lower($this->get('to'))), PHP_URL_PATH);
        $this->merge([
            'from' => $from,
            'to' => $to,
        ]);
    }
}
