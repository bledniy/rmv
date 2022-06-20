<?php

namespace App\Helpers\Media;

use Intervention\Image\Image;
use Intervention\Image\ImageManagerStatic;
use Psr\Http\Message\StreamInterface;

class ImageThumbnail
{
    private $imageMeta;

    public function __construct(?ImageMeta $imageMeta = null)
    {
        $this->imageMeta = $imageMeta;
    }

    private function getImageMeta(): ImageMeta
    {
        return $this->imageMeta;
    }

    public function setImageMeta(ImageMeta $imageMeta): self
    {
        $this->imageMeta = $imageMeta;

        return $this;
    }

    /**
     * @param Image $image
     * @param $width
     * @param $height
     * @return Image
     */
    public function thumbnailImage(Image $image, int $width, int $height): Image
    {
        $image->fit($width, $height);

        return $image;
    }

    public function makeThumbnail(string $imagePath): StreamInterface
    {
        $width = $this->getImageMeta()->getWidth();
        $height = $this->getImageMeta()->getHeight();
        $image = $this->thumbnailImage($this->createImage($imagePath), $width, $height);

        return $image->stream($this->getImageMeta()->getExtension());
    }

    protected function createImage(string $image): Image
    {
        return ImageManagerStatic::make($image);
    }


}