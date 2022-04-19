<?php declare(strict_types=1);

namespace App\Http\Requests\Admin\Content;

use App\Contents\ContentFieldsDataInterface;
use App\Contents\ContentFieldsTypeInterface;
use App\Contents\ContentRequestInterface;
use App\Helpers\Validation\ValidationMaxLengthHelper;
use App\Http\Requests\AbstractRequest;
use App\Rules\Content\ContentUniqueUrl;

class DefaultContentRequest extends AbstractRequest implements ContentRequestInterface
{
    private $fieldsData;

    protected $exceptFromFillable = ['content_id'];

    public function __construct(ContentFieldsDataInterface $fieldsData)
    {
        parent::__construct();
        $this->fieldsData = $fieldsData;
        if ($this->fieldsData->getFields()->hasActive()) {
            $this->toBooleans[] = ContentFieldsTypeInterface::ACTIVE;
        }
    }

    public function rules(): array
    {
        $rules = [
            ContentFieldsTypeInterface::NAME => $this->getRuleNullableChar(),
            ContentFieldsTypeInterface::TITLE => $this->getRuleNullableChar(),
            ContentFieldsTypeInterface::DESCRIPTION => ['nullable', 'string', 'max:' . ValidationMaxLengthHelper::TEXT],
            ContentFieldsTypeInterface::EXCERPT => ['nullable', 'string', 'max:' . ValidationMaxLengthHelper::TEXT],
            ContentFieldsTypeInterface::IMAGE => ['nullable', 'image'],
            ContentFieldsTypeInterface::ADDITIONAL_IMAGE => ['nullable', 'image'],
            ContentFieldsTypeInterface::URL => array_merge($this->getRuleRequiredChar(),
                [app(ContentUniqueUrl::class, ['request' => $this])]),
        ];

        $rules = array_filter($rules, function ($value, $key) {
            return in_array($key, $this->fieldsData->getFields()->getFieldsList(), true);
        }, ARRAY_FILTER_USE_BOTH);

        foreach ($rules as $field => $fieldRules) {
            if ($this->fieldsData->hasCustomValidationRules($field)) {
                $rules[$field] = $this->fieldsData->getCustomValidationRules($field);
            }
        }
        if ($this->fieldsData->getAdditionalCustomValidationRules()) {
            $rules = array_merge($rules, $this->fieldsData->getAdditionalCustomValidationRules());
        }

        if ($this->isActionUpdate()){
            $rules['content_id'] = ['required', 'exists:contents,id'];
        }

        return $rules;
    }

    public function getRequest(): AbstractRequest
    {
        return $this;
    }
}
