<?php

namespace App\Config\Media;

use Intervention\Image\Image;
use Intervention\Image\ImageManagerStatic;

class ImageWatermarkConfig
{
    /**
     * @var
     */
    protected $path;

    /**
     * @var Image
     */
    private $watermarkImage;

    /**
     * @var string
     */
    private $position = 'center';

    public function __construct()
    {
        $this->setWatermarkImagePath(\Config::get('images.watermark.path'));
        $this->setWatermarkPosition(\Config::get('images.watermark.position'));
    }

    public function getWatermarkImagePath(): string
    {
        return $this->path;
    }

    public function setWatermarkImagePath(string $path): self
    {
        $this->path = $path;

        return $this;
    }

    public function getWatermarkImage(): Image
    {
        if (null === $this->watermarkImage) {
            $this->watermarkImage = $this->buildImage($this->path);
        }

        return $this->watermarkImage;
    }

    public function setWatermarkPosition(string $position): self
    {
        $this->position = $position;

        return $this;
    }

    public function getWatermarkPosition(): string
    {
        return $this->position;
    }

    private function buildImage(string $path): Image
    {
        return ImageManagerStatic::make($path);
    }
}