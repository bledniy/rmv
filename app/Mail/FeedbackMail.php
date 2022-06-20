<?php declare(strict_types=1);

namespace App\Mail;

use App\DataContainers\Feedback\FeedbackMailData;
use App\DataContainers\Mail\MailAdminConfigDataInterface;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class FeedbackMail extends Mailable
{
    use Queueable, SerializesModels;

    private $feedback;

    private $translator;

    public function __construct(FeedbackMailData $feedback, MailAdminConfigDataInterface $config)
    {
        $config->fillFromMailable($this);
        $this->feedback = $feedback;
    }

    public function build(): self
    {
        $this->subject(sprintf('Заявка на обратную связь | %s', $this->feedback->getTypeEnum()->getTitle()));
        if ($this->feedback->getFiles()) {
            foreach ($this->feedback->getFiles() as $file) {
                $this->attach(
                    storageDisk()->path($file->getPath()),
                    ['as' => $file->getName()]
                );
            }
        }

        return $this->view('mail.feedback.feedback')->with(['feedback' => $this->feedback]);
    }
}
