<?php declare(strict_types=1);

namespace App\DataContainers\Feedback;

final class FeedbackFileData
{
    private $path;

    private $name;

    private function __construct() {}

    public static function create(string $path, string $name): self
    {
        $self = new self();
        $self->path = $path;
        $self->name = $name;

        return $self;
    }

    public function getPath()
    {
        return $this->path;
    }

    public function getName()
    {
        return $this->name;
    }



}