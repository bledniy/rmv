<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\ResponseHelper;
use App\Http\Requests\AjaxActiveRequest;
use App\Models\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class AjaxController extends AdminController
{
    /**
     * @param Request $request
     *
     * @return array|\Illuminate\Http\RedirectResponse
     * Включить/выключить запись в переданной таблице
     */
    public function active(Request $request)
    {
        $this->setMessage(__('Запись не найдена'));
        if ($request->has('table') && $request->has('id')) {
            $table = $request->get('table');
            $id = $request->get('id');
            /** @var Model $model */
            $model = Model::getModelByTable($table);
            if ($model) {
                $record = $model->find($id);
            }
            if (($active = $record->active) !== null) {
                $active = (int)!$active;
                $record->setAttribute('active', $active);
                if ($record->save()) {
                    $this->setFailUpdate();
                    try {
                        $this->setSuccessMessage(__('Активность записи обновлена'));
                    } catch (\Exception $e) {
                        $data[ResponseHelper::MESSAGE_KEY] = $e->getMessage();
                    }
                }
            }
        }

        return $data;
    }

    /**
     * @param Request $request
     *
     * @return array
     */
    public function sort(Request $request)
    {
        $this->setMessage('Переданы не все нужные данные');
        $table = $request->table;
        $sortItems = json_decode($request->sort);
        $primary = $request->get('primary_key') ?? 'id';
        if ($table and $sortItems) {
            try {
                if (Schema::hasColumn($table, 'sort')) {
                    foreach ($sortItems as $position => $id) {
                        \DB::table($table)->where($primary, $id)->update(['sort' => $position]);
                    }
                    $this->setStatus(true)->setMessage(__('actions.sort-updated'));
                }
            } catch (\Exception $e) {
                $this->setMessage($e->getMessage());
            }
        }

        return $this->getResponseMessageForJson();
    }

    /**
     * @param AjaxActiveRequest $request
     * @return array
     * @throws \Exception
     */
    public function delete(AjaxActiveRequest $request)
    {
        $this->setMessage('Этой записи (больше) не существует');
        $table = $request->get('table');
        $id = $request->get('id');
        $model = Model::getModelByTable($table);
        if ($model) {
            /** @var $model Model */
            try {
                if (($entity = $model->find($id)) && $entity->delete()) {
                    $this->setSuccessDestroy();
                }
            } catch (\Exception $e) {

            }
        }

        return $request->expectsJson() ? $this->getResponseMessageForJson() : $this->getResponseMessage();
    }
}
