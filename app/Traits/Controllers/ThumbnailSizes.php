<?php
/**
 * Created by PhpStorm.
 * User: qwerty
 * Date: 29.06.2019
 * Time: 8:55
 */

namespace App\Traits\Controllers;

use App\Models\Image;

/**
 * Trait ThumbnailSizes
 * @package App\Traits\Controllers
 * @property mixed $thumbnailWidth
 * @property mixed $thumbnailHeight
 */
trait ThumbnailSizes
{

    private function getThumbnailSizes()
    {
        $defaultWidth = $this->thumbnailWidth ?? Image::DEFAULT_WIDTH;
        $defaultHeight = $this->thumbnailHeight ?? Image::DEFAULT_HEIGHT;

        return [
            getSetting($this->key . '.image.width', $defaultWidth),
            getSetting($this->key . '.image.height', $defaultHeight),
        ];
    }
}