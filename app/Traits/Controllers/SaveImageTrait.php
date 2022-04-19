<?php

namespace App\Traits\Controllers;

use App\Config\Media\ThumbnailImagesConfig;
use App\Events\Admin\Image\ImagePathReplacedEvent;
use App\Events\Admin\Image\ImageUploaded;
use App\Helpers\Media\ImageSaver;
use App\Models\Model;
use Illuminate\Http\Request;

/**
 * Trait SaveImageTrait
 * @package App\Traits\Controllers
 */
trait SaveImageTrait
{
    protected function saveImage(Request $request, Model $model, $requestKey = 'image'): string
    {
        $imagePath = '';
        if ($request->hasFile($requestKey)) {
            $imageSaver = new ImageSaver($request, $requestKey);
            $imageSaver->setFolderName($model->getTable())->withFileName(md5($requestKey . $model->getKey()));
            if (property_exists($this, 'withThumbnails') && !$this->withThumbnails) {
                $imageSaver->setWithThumbnail(false);
            } else if (($sizes = array_filter(ThumbnailImagesConfig::getSizesByKey($model->getTable()),
                    'is_numeric')) && (count($sizes) === 2)) {
                $imageSaver->setThumbnailSizes(...$sizes);
            }

            $imagePath = $imageSaver->saveFromRequest();
            $inputKey = getLastFromExploded($requestKey);
            $model->setAttribute($inputKey, $imagePath);
            event(new ImagePathReplacedEvent($model));
            $model->save();

            event(new ImageUploaded($model, $request));
        }

        return $imagePath;
    }
}
