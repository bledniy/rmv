<?php declare(strict_types=1);

namespace App\Http\Requests;

use App\Rules\Uploads\NotDangerExecutable;
use App\Services\Phone\PhoneUkraineFormatter;
use App\Traits\Requests\Helpers\IsAction;
use App\Traits\Requests\Helpers\RequestAttributesCaster;
use Illuminate\Foundation\Http\FormRequest;
use Tightenco\Collect\Support\Arr;

class AbstractRequest extends FormRequest
{
    protected $toBooleans = [];

    use RequestAttributesCaster;

    use IsAction;

    protected $fillableFields = [];

    protected $exceptFromFillable = [];

    protected $requestKey = '';

    public function authorize(): bool
    {
        return true;
    }

    /**
     * @param $fields = [ 'email' => ['required', 'email', '...'] ]
     * @param array $except = ['password', 'email', '...']
     * @return array
     */
    protected function exceptFields($fields, array $except = []): array
    {
        try {
            return array_diff_key($fields, array_flip($except));
        } catch (\Throwable $e) {
            return $fields;
        }
    }


    public function getRequestKey(): string
    {
        return $this->requestKey;
    }

    protected function prepareForValidation(): void
    {
        $this->mergeRequestValues();
        $this->mapCasts();
    }

    protected function mergeRequestValues() { }

    protected function castCheckboxes(array $checkboxes)
    {
        foreach ($checkboxes as $checkbox) {
            $this->merge([$checkbox => $this->toCheckbox($this->get($checkbox))]);
        }
    }

    protected function toCheckbox($value)
    {
        return (int)$value;
    }

    protected function mergeUrlFromName()
    {
        $this->mergeUrlFromField();
    }

    protected function mergeUrlFromTitle()
    {
        $this->mergeUrlFromField('title');
    }

    protected function mergeUrlFromField($field = 'name')
    {
        if (!$this->get('url')) {
            $this->merge(['url' => $this->get($field)]);
        }
        $this->merge([
            'url' => \Str::slug($this->get('url')),
        ]);
    }

    public function getFillableFields($except = []): array
    {
        $except = is_array($except) ? $except : func_get_args();
        $except = array_merge($this->exceptFromFillable, $except);
        $fn = static function ($key) {
            return rtrim($key, '.*');
        };
        $keys = array_merge(
            array_keys($this->exceptFields($this->rules(), $except)),
            $this->fillableFields,
        );
        $keys = array_flip($this->exceptFields(array_flip($keys), $except));
        $keys = array_unique(array_map($fn, $keys));

        return $keys;
    }

    public function addSometimesToRules(array $rules, array $exceptAdd = []): array
    {
        return $this->addRuleToAllRules($rules, 'sometimes', $exceptAdd);
    }

    public function addNullableToRules(array $rules, array $exceptAdd = []): array
    {
        return $this->addRuleToAllRules($rules, 'nullable', $exceptAdd);
    }

    public function addRuleToAllRules(array $rules, $rule, array $exceptAdd = []): array
    {
        $fn = static function (&$ruleItem, $keyRule, $exceptAdd) use ($rule) {
            if (!in_array($keyRule, $exceptAdd, true)) {
                $ruleItem = Arr::prepend($ruleItem, $rule, $rule);
            }
        };
        array_walk($rules, $fn, $exceptAdd);

        return $rules;
    }

    public function getImageRule(array $except = []): array
    {
        $fields = ['image' => 'image', 'mimes' => 'mimes:jpg,jpeg,png', 'max' => 'max:' . (4 * 1024)];

        return $this->exceptFields($fields, $except);
    }

    public function getFilesRule(array $except = []): array
    {
        $fields = [
            'nullable' => 'nullable',
            'file' => 'file',
            'not_danger' => app(NotDangerExecutable::class),
            'max' => 'max:' . (10 * 1024),
        ];

        return $this->exceptFields($fields, $except);
    }


    public function getRuleNullableChar(array $additional = []): array
    {
        return array_merge(
            ['nullable', 'max' => 'max:255', 'string'],
            $additional
        );
    }

    public function getRuleRequiredChar(): array
    {
        return ['required', 'max' => 'max:255', 'string'];
    }

    protected function getBaseEmailRule(): array
    {
        return [
            'required' => 'required', 'max' => 'max:255', 'email' => 'email:rfc,dns',
        ];
    }

    protected function patchableRules(array $rules): array
    {
        return array_filter($rules, function ($rule) {
            return $this->has($rule);
        }, ARRAY_FILTER_USE_KEY);
    }

    public function mergeFormatPhone($field = 'phone'): void
    {
        $phone = PhoneUkraineFormatter::formatPhone((string)$this->get($field));
        $this->merge([$field => $phone]);
        $all = array_merge($this->all(), [$field => $phone]);
        $this->request->replace($all);
    }

    protected function getBasePhoneRule(array $except = []): array
    {
        return $this->exceptFields(['required' => 'required', 'string', 'max' => 'max:255', 'phone' => 'phone:UA,mobile'], $except);
    }

}
