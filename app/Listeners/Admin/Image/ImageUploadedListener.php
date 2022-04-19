<?php

namespace App\Listeners\Admin\Image;

use App\Events\Admin\Image\ImageUploaded;
use App\Helpers\Debug\LoggerHelper;
use App\Helpers\Media\ImageSaver;
use App\Helpers\Media\ImageWatermark;
use App\Models\Model;
use Intervention\Image\ImageManagerStatic;

class ImageUploadedListener
{
    /**
     * @var ImageWatermark
     */
    private $imageWatermark;
    /**
     * @var ImageSaver
     */
    private $imageSaver;

    /**
     * Create the event listener.
     *
     * @param ImageWatermark $imageWatermark
     * @param ImageSaver $imageSaver
     */
    public function __construct(ImageWatermark $imageWatermark, ImageSaver $imageSaver)
    {
        $this->imageWatermark = $imageWatermark;
        $this->imageSaver = $imageSaver;
    }

    /**
     * Handle the event.
     *
     * @param object $event
     * @return void
     */
    public function handle($event): void
    {
        /** @var $event ImageUploaded */
        $model = $event->getModel();
        $target = imgPathOriginal($model->getAttribute('image'));
        if (!$this->supportsWatermarking($model)) {
            return;
        }
        if (!storageFileExists($target)) {
            return;
        }
        try {
            $image = ImageManagerStatic::make(\Storage::path($target));
            $image = $this->imageWatermark->applyWatermark($image);
            $this->imageSaver
                ->setWithThumbnail($this->withThumbnails($model))
                ->setFullImageName(imgPathOriginal($model->getAttribute('image')))
                ->saveFromImage($image)
            ;
        } catch (\Exception $e) {
            app(LoggerHelper::class)->error($e);
//            if (isLocalEnv()) {
//                d($e);
//            }
        }
    }

    private function supportsWatermarking(Model $model): bool
    {
        return true;
    }

    private function withThumbnails(Model $model): bool
    {
        return false;
    }
}
