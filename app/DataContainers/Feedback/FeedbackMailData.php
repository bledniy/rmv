<?php declare(strict_types=1);

namespace App\DataContainers\Feedback;

use App\Enum\FeedbackTypeEnum;
use App\Models\Feedback\Feedback;

final class FeedbackMailData
{
    /**
     * @var FeedbackTypeEnum
     */
    private $typeEnum;

    private $name = '';

    private $message = '';

    private $phone = '';

    /**
     * @var FeedbackFileData[]
     */
    private $files = [];

    public static function createFromEntity(Feedback $feedback): self
    {
        $self = new self;
        $self->typeEnum = $feedback->getTypeEnum();
        $self->name = $feedback->getName();
        $self->message = $feedback->getMessage();
        $self->phone = $feedback->getPhoneDisplay();
        if ($feedback->getFiles()) {
            foreach ($feedback->getFiles() as $fileName => $file) {
                if (storageFileExists($file)) {
                    $self->files[] = FeedbackFileData::create($file, $fileName);
                }
            }
        }

        return $self;
    }

    public function getTypeEnum(): FeedbackTypeEnum
    {
        return $this->typeEnum;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    public function getPhone(): string
    {
        return $this->phone;
    }

    /**
     * @return FeedbackFileData[]
     */
    public function getFiles(): array
    {
        return $this->files;
    }


}