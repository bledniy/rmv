<?php declare(strict_types=1);

namespace App\Rules\Content;

use App\Contents\ContentFieldsDataInterface;
use App\Http\Requests\Admin\Content\DefaultContentRequest;
use App\Models\Content\Content;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Database\Eloquent\Builder;

class ContentUniqueUrl implements Rule
{
    private $fieldsData;

    private $request;

    public function __construct(
        ContentFieldsDataInterface $fieldsData,
        DefaultContentRequest $request
    )
    {
        $this->fieldsData = $fieldsData;
        $this->request = $request;
    }

    public function passes($attribute, $value): bool
    {
        $hasKey = $this->request->isActionUpdate() && $this->request->has('content_id');

        return !Content::where('type', $this->fieldsData->getFields()->getContentTypeEnum())
            ->where('url', $value)
            ->when($hasKey, function (Builder $query) {
                $query->whereKeyNot((int)$this->request->get('content_id'));
            })
            ->exists()
            ;
    }

    public function message(): string
    {
        return __('Адрес уже используется');
    }
}
