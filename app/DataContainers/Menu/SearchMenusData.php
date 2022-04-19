<?php declare(strict_types=1);

namespace App\DataContainers\Menu;

final class SearchMenusData
{
    /**
     * @var bool|null
     */
    private $active;

    /**
     * @var array<int>
     */
    private $groups = [];

    public static function create(): self
    {
        return new self;
    }

    public function hasActive(): bool
    {
        return null !== $this->active;
    }

    public function getActive(): ?bool
    {
        return $this->active;
    }

    public function setActive(?bool $active): self
    {
        $this->active = $active;

        return $this;
    }

    public function getGroups(): array
    {
        return $this->groups;
    }

    public function setGroups(array $groups): void
    {
        $this->groups = $groups;
    }

    public function addGroup(int $group): self
    {
        $this->groups[] = $group;

        return $this;
    }

    public function __toString(): string
    {
        return json_encode(get_object_vars($this));
    }
}