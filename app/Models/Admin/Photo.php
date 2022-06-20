<?php

namespace App\Models\Admin;

use App\Contracts\HasImagesContract;
use App\Helpers\Media\ImageRemover;
use App\Helpers\Media\ImageSaver;
use App\Http\Libs;
use App\Models\Model;
use App\Traits\Builder;
use DB;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Schema;

/**
 * App\Models\Admin\Photo
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Model active($active = 1)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin\Photo newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin\Photo newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Model orWhereLike($column, $value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin\Photo query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Model whereLike($column, $value)
 * @mixin \Eloquent
 */
class Photo extends Model
{
    use Builder;

    public const DEFAULT_EXT = 'jpg';


    public function setImage($image)
    {
        return $this->setData('image', $image);
    }


    public function saveImageFromBase64($cols = 250, $rows = 250): string
    {
        $base64 = $this->getData('image');
        $directory = $this->getData('directory');
        $id = md5($this->getData('id'));

        $imageSaver = new ImageSaver;

        return $imageSaver->setFolderName($directory)
            ->setThumbnailSizes($cols, $rows)
            ->withFileName($id)
            ->saveFromBase64($base64)
            ;
    }

    /**
     * @return bool
     * Метод является оберткой для saveImageFromBase64, и в общем то пока не имеет смысла в своем существовании
     */
    public function saveAdditionalImageFromBase64()
    {
        $photo = $this->getData('image');
        $table = $this->getData('table');
        $directory = $this->getData('directory', $table);
        $primary_id = $this->getData('primary_id');
        if (!$photo)
            return false;
        $directory .= '/' . $primary_id;
        $this->setData('directory', $directory);

        return $this->saveImageFromBase64();
    }

    /**
     * @param HasImagesContract $belongToModel
     * @param Request $request
     * @param string $requestKey
     * @return Collection
     */
    public function saveAdditionPhotos(HasImagesContract $belongToModel, Request $request, $requestKey = 'images'): Collection
    {
        $images = collect([]);
        if (!$request->hasFile($requestKey)) {
            return $images;
        }
        /** @var $image UploadedFile */
        /** @var $imageModel \App\Models\Image */
        /** @var $belongToModel \App\Models\Model */
        $imageSaver = new ImageSaver;
        $imageSaver->setFolderName($belongToModel->getTable() . DIRECTORY_SEPARATOR . $belongToModel->getKey());
        foreach ($request->file($requestKey) as $index => $image) {
            $photoName = (string)$image->getClientOriginalName();
            $imageModel = $belongToModel->images()->create(['name' => $photoName,]);
            if ($imageModel) {
                $photoPath = $imageSaver->saveFromUploadedFile($image);
                $imageModel->setAttribute('image', $photoPath);
                $imageModel->save();
                $images->push($imageModel);
            }
        }
        $this->clearBuilderData();

        return $images;
    }

    public function deletePhoto($id, $table, $deleteFromDatabase = false)
    {
        if (!\Schema::hasTable($table)) {
            return false;
        }
        $photo = DB::table($table)->where('id', (int)$id)->first();
        $column = 'image';

        if ($photo && $column) {
            $path = Arr::get((array)$photo, $column);
            $this->deleteImageStorage($path);
            // Delete record if that additional image
            $query = DB::table($table)->where('id', $id);
            $deleteFromDatabase ? $query->delete() : $query->update([$column => '']);

            return true;
        }

        return false;
    }

    public function updateImagePath(Request $request, $imagePath): void
    {
        $column = 'image';
        $table = $request->get('table');
        $id = $request->get('id');
        $columnId = 'id';
        if (Schema::hasTable($table) and Schema::hasColumn($table, $column)) {
            if ($id and $record = DB::table($table)->where($columnId, $id)->first()) {
                DB::table($table)->where($columnId, $id)->update([$column => $imagePath]);
                if ($oldPhoto = $record->$column and imgPathOriginal($oldPhoto) !== imgPathOriginal($imagePath)) {
                    $this->deleteImageStorage($oldPhoto);
                }
            }
        }
    }

    public function deleteImageStorage($imagePath): void
    {
        static $imageRemover;
        if (null === $imageRemover) {
            $imageRemover = new ImageRemover;
        }
        $imageRemover->removeImage($imagePath);
    }
}

