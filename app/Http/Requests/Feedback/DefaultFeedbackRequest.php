<?php declare(strict_types=1);

namespace App\Http\Requests\Feedback;

use App\Http\Requests\AbstractRequest;
use App\Rules\Feedback\FeedbackThrottle;

class DefaultFeedbackRequest extends AbstractRequest
{
    protected $fillableFields = ['ip', 'type'];

    protected $exceptFromFillable = ['files'];

    public function rules(): array
    {
        return [
            'name' => array_merge($this->getRuleNullableChar(), [app(FeedbackThrottle::class)]),
            'message' => array_merge($this->getRuleNullableChar(), ['max' =>'max:2000']),
            'phone' => $this->getBasePhoneRule(),
        ];
    }

    protected function mergeRequestValues()
    {
        $this->merge(['ip' => $this->ip()]);
    }
}
