<?php declare(strict_types=1);

namespace App\Models\Feedback;

use App\Enum\FeedbackTypeEnum;
use App\Models\Model;
use App\Services\Phone\PhoneUkraineFormatter;

class Feedback extends Model
{
    protected $guarded = ['id'];

    protected $casts = [
        'data' => 'array',
        'files' => 'array',
    ];

    public function setFiles(array $files): Feedback
    {
        $this->setAttribute('files', $files);

        return $this;
    }

    public function getName()
    {
        return $this->getAttribute('name');
    }

    public function getMessage()
    {
        return $this->getAttribute('message');
    }

    public function getPhone()
    {
        return $this->getAttribute('phone');
    }

    public function getPhoneDisplay(): string
    {
        return extractDigits(PhoneUkraineFormatter::formatPhone($this->getAttribute('phone')));
    }

    public function getTypeEnum(): FeedbackTypeEnum
    {
        return new FeedbackTypeEnum((string)$this->getAttribute('type'));
    }

    public function getFiles(): array
    {
        return (array)$this->files;
    }

    public function getData()
    {
        return (array)$this->data;
    }
}
