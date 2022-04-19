<?php


namespace App\Helpers\Media;


use App\Config\Media\ImageWatermarkConfig;
use Intervention\Image\Constraint;
use Intervention\Image\Image;

class ImageWatermark
{
    /**
     * @var ImageWatermarkConfig
     */
    private $imageWatermarkConfig;


    public function __construct(ImageWatermarkConfig $imageWatermarkConfig)
    {
        $this->imageWatermarkConfig = $imageWatermarkConfig;
    }

    public function getImageWatermarkConfig(): ImageWatermarkConfig
    {
        return $this->imageWatermarkConfig;
    }

    public function applyWatermark(Image $target): Image
    {
        $watermark = $this->getImageWatermarkConfig()->getWatermarkImage();
        $imageWidth = $target->width();
        $watermarkWidth = $watermark->width();

        if ($watermarkWidth > $imageWidth) {
            $watermark->resize($imageWidth, null, static function (Constraint $constraint) {
                $constraint->aspectRatio();
            });
        }
        $target->insert($watermark, $this->getImageWatermarkConfig()->getWatermarkPosition());

        return $target;
    }
}