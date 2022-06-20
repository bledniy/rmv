<?php

namespace App\Helpers\Media;

use App\Models\Admin\Photo;

class ImageMeta
{
    private $ext;

    private $width = \App\Models\Image::DEFAULT_WIDTH;

    private $height = \App\Models\Image::DEFAULT_HEIGHT;

    private $fileName = '';

    public function __construct()
    {
        $this->reset();
    }

    public function reset(): void
    {
        $this->setExtension(Photo::DEFAULT_EXT);
    }

    public function setExtension(string $ext): self
    {
        $this->ext = $ext;

        return $this;
    }

    public function getExtension(): string
    {
        return $this->ext;
    }

    public function setWidth(int $width): self
    {
        $this->width = $width;

        return $this;
    }

    public function getWidth(): int
    {
        return $this->width;
    }

    public function setHeight(int $height): self
    {
        $this->height = $height;

        return $this;
    }

    public function getHeight(): int
    {
        return $this->height;
    }

    public function setFileName(string $fileName): self
    {
        $this->fileName = $fileName;

        return $this;
    }

    public function getFileName(): string
    {
        return $this->fileName;
    }

    public function getFilenameHashed(): string
    {
        return md5($this->getFileName() ?: (time() + mt_rand()));
    }

    public function getFileNameWithExtension(): string
    {
        return $this->getFileName() . '.' . $this->getExtension();
    }

    public function getFileNameHashedWithExtension(): string
    {
        return $this->getFileName() . '.' . $this->getExtension();
    }

}