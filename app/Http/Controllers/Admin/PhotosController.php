<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PhotosController extends AdminController
{
    public function delete(Request $request, Photo $photo)
    {
        $this->setMessage('Переданны не все обязательные данные');
        $photoId = $request->get('id', false);
        $table = $request->get('table', false);
        $primaryId = $request->get('primary_id', false);
        if ($photoId and \Schema::hasTable($table)) {
            $isDeleted = $photo->deletePhoto($photoId, $table, $primaryId);
            if ($isDeleted) {
                $this->setSuccessDestroy();
            }
        }

        return $this->getResponseMessageForJson();
    }

    public function edit(Request $request)
    {
        $this->setFailMessage('Изображение не было отредактировано, произошла ошибка');
        $table = $request->get('table');
        ($photo = new Photo)
            ->setData('image', $request->get('base64'))
            ->setData('table', $request->get('table'))
            ->setData('id', $request->get('id'))
        ;
        $photo->setData('directory', $request->get('directory', $table));
        if ($request->has('primary_id')) {
            $imagePath = $photo
                ->setData('primary_id', $request->get('primary_id'))
                ->saveAdditionalImageFromBase64()
            ;
        } else {
            $imagePath = $photo
                ->saveImageFromBase64();
        }
        if ($imagePath !== false) {
            $res['image'] = getPathToImage($imagePath);
            $photo->updateImagePath($request, $imagePath);
            $this->setSuccessMessage('Изображение успешно отредактировано');
        }

        return $this->getResponseMessageForJson();
    }

    public function getPhotoCropper(Request $request)
    {
        $this->setMessage("Фото недоступно для редактирования");
        $data = [];
        if ($request->has(['table', 'id'])) {
            if (!\Schema::hasTable($request->get('table')) or !$request->get('id')) {
                return $this->getResponseMessageForJson();
            }
            $table = $request->get('table');
            $item = (array)DB::table($table)->where('id', $request->get('id'))->first();
            if ($item) {
                $vars['image'] = $item;
                $vars['directory'] = $request->get('directory', $table);
                $vars['photo_table'] = $request->get('table');
                if ($request->has('primary_id')) {
                    $vars['primary_id'] = $request->get('primary_id');
                }
                $data['content'] = view('admin.editPhotos', $vars)->render();
            }
        }

        return $data;
    }
}
