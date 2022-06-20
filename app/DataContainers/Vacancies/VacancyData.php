<?php declare(strict_types=1);

namespace App\DataContainers\Vacancies;

use App\Models\Content\Content;

final class VacancyData
{
    private $name = '';

    private $description = '';

    private $id = 0;

    public static function createFromContent(Content $content): self
    {
        $self = new self;
        $self->setName($content->getName())->setDescription($content->getDescription())->setId($content->getKey());
        return $self;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): VacancyData
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): VacancyData
    {
        $this->description = $description;

        return $this;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): VacancyData
    {
        $this->id = $id;

        return $this;
    }


}