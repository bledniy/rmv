<?php declare(strict_types=1);

namespace App\DataContainers\Mail;

use Illuminate\Contracts\Mail\Mailable;

final class MailAdminConfigData implements MailAdminConfigDataInterface
{
    /**
     * @var string|null
     */
    private $emailTo;
    /**
     * @var string|null
     */
    private $nameTo;

    public function __construct(?string $emailTo, ?string $nameTo)
    {
        $this->emailTo = $emailTo;
        $this->nameTo = $nameTo;
    }

    public function getEmailTo(): ?string
    {
        return $this->emailTo;
    }

    public function getNameTo(): ?string
    {
        return $this->nameTo;
    }

    public function fillFromMailable(Mailable $mailable): void
    {
        $mailable->to($this->getEmailTo(), $this->getNameTo());
    }
}