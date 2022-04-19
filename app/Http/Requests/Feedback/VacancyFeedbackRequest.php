<?php declare(strict_types=1);

namespace App\Http\Requests\Feedback;

use App\Http\Requests\AbstractRequest;
use App\Rules\Feedback\FeedbackThrottle;
use App\Rules\Uploads\NotDangerExecutable;

class VacancyFeedbackRequest extends AbstractRequest
{
    protected $fillableFields = ['ip', 'data', 'type'];

    protected $exceptFromFillable = ['files'];

    public function rules(): array
    {
        return [
            'vacancy_id' => ['required', 'exists:contents,id'],
            'name' => array_merge($this->getRuleNullableChar(), [app(FeedbackThrottle::class)]),
            'message' => array_merge($this->getRuleNullableChar(), ['max' => 'max:2000']),
            'phone' => $this->getBasePhoneRule(),
            'files.*' => array_merge($this->getFilesRule(['max']), [app(NotDangerExecutable::class)]),
        ];
    }

    protected function mergeRequestValues()
    {
        try {
            if ($this->has('files')) {
                $files = array_filter($this->file('files'), 'is_file');
                $this->merge(['files' => $files]);
            }
        } catch (\Throwable $e) {
        }
        $this->merge([
            'ip' => $this->ip(),
            'data' => ['vacancy_id' => $this->get('vacancy_id')]
        ]);
    }
}
