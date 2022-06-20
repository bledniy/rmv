<?php declare(strict_types=1);

namespace App\Listeners\Feedback;

use App\DataContainers\Feedback\FeedbackMailData;
use App\Events\Feedback\FeedbackCreated;
use App\Mail\FeedbackMail;
use Illuminate\Support\Facades\Mail;
use Psr\Log\LoggerInterface;

class NotifyAdminFeedbackListener
{
    private $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function handle(FeedbackCreated $event): void
    {
        try {
            Mail::queue(
                app(FeedbackMail::class, ['feedback' => FeedbackMailData::createFromEntity($event->getFeedback())])
            );
        } catch (\Throwable $e) {
            $this->logger->error($e);
        }
    }
}
