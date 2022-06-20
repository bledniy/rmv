<?php declare(strict_types=1);

namespace App\DataContainers\Mail;

use Illuminate\Contracts\Mail\Mailable;

interface MailAdminConfigDataInterface
{
    public function getEmailTo(): ?string;

    public function getNameTo(): ?string;

    public function fillFromMailable(Mailable $mailable): void;
}