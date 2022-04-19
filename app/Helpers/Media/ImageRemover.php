<?php


namespace App\Helpers\Media;


class ImageRemover
{

    /**
     * @param $imagePath - related path - without storage path
     * @param null $disk
     */
    public function removeImage($imagePath, $disk = null): void
    {
        if (!$imagePath) {
            return;
        }
        if (storageFileExists($imagePath, $disk)) {
            storageDelete($imagePath, $disk);
        }
        if (storageFileExists(imgPathOriginal($imagePath), $disk)) {
            storageDelete(imgPathOriginal($imagePath), $disk);
        }
    }

}