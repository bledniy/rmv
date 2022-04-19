<?php declare(strict_types=1);

namespace App\Services\Admin\Page;

final class PageShowFieldsContainer
{
    private $withImage = false;

    private $withUrl = true;

    public function isWithImage(): bool
    {
        return $this->withImage;
    }

    public function setWithImage(bool $withImage): self
    {
        $this->withImage = $withImage;

        return $this;
    }

    public function isWithUrl(): bool
    {
        return $this->withUrl;
    }

    public function setWithUrl(bool $withUrl): self
    {
        $this->withUrl = $withUrl;

        return $this;
    }
}