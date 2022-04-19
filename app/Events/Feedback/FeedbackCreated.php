<?php declare(strict_types=1);

namespace App\Events\Feedback;

use App\Models\Feedback\Feedback;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class FeedbackCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @var Feedback
     */
    private $feedback;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Feedback $feedback)
    {
        $this->feedback = $feedback;
    }

    /**
     * @return Feedback
     */
    public function getFeedback(): Feedback
    {
        return $this->feedback;
    }
}
