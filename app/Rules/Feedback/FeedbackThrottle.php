<?php declare(strict_types=1);

namespace App\Rules\Feedback;

use App\Repositories\FeedbackRepository;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Http\Request;

class FeedbackThrottle implements Rule
{
    private $request;

    private $repository;

    public function __construct(Request $request, FeedbackRepository $repository)
    {
        $this->request = $request;
        $this->repository = $repository;
    }

    public function passes($attribute, $value): bool
    {
        if (isLocalEnv()){
            return true;
        }
        $ip = $this->request->ip();

        return !$this->repository->where('ip', $ip)->where('created_at', '>', now()->subMinute())->count();
    }

    public function message(): string
    {
        return getTranslate('feedback.throttle-message');
    }
}
