<?php

namespace App\Listeners\Admin\Image;

use App\Events\Admin\Image\PathReplacedEvent;
use App\Helpers\Media\ImageRemover;

class PathReplacedListener
{
    /**
     * @var ImageRemover
     */
    private $imageRemover;

    /**
     * Create the event listener.
     *
     * @param ImageRemover $imageRemover
     */
    public function __construct(ImageRemover $imageRemover)
    {
        //
        $this->imageRemover = $imageRemover;
    }

    /**
     * Handle the event.
     *
     * @param PathReplacedEvent $event
     * @return void
     */
    public function handle(PathReplacedEvent $event): void
    {
        $model = $event->getModel();
        if ($model->isDirty('image')) {
            $image = $model->getOriginal('image');
            if ($image === $model->getAttribute('image')) {
                return;
            }
            if (storageFileExists($image)) {
                $this->imageRemover->removeImage($image);
            }
        }
    }
}
