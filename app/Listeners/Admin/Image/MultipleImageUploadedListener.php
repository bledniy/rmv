<?php

namespace App\Listeners\Admin\Image;

use App\Events\Admin\Image\MultipleImageUploaded;
use App\Helpers\Media\ImageSaver;
use App\Helpers\Media\ImageWatermark;
use App\Models\Image;
use App\Models\Model;
use Intervention\Image\ImageManagerStatic;

class MultipleImageUploadedListener
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

    public function handle($event): void
    {
        /** @var  $event MultipleImageUploaded */
        /** @var  $imageModel Image */

        $model = $event->getModel();
        if (!($model instanceof Model)) {
            return;
        }
        if (!$this->supportsWatermarking($model)) {
            return;
        }

        foreach ($event->getImagesCollection() as $imageModel) {
            $target = imgPathOriginal($imageModel->getAttribute('image'));
            if (!storageFileExists($target)) {
                continue;
            }
            try {
                $image = ImageManagerStatic::make(\Storage::path($target));
                $image = $this->imageWatermark->applyWatermark($image);
                $this->imageSaver
                    ->setWithThumbnail($this->withThumbnails($model))
                    ->setFullImageName(imgPathOriginal($target))
                    ->saveFromImage($image)
                ;
            } catch (\Exception $e) {
            }
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
