<?php

namespace App\Repositories;

use App\Models\Staff\Staff;
use App\Models\Staff\StaffLang;
use App\Models\Language;
use App\Models\Model;
use App\Models\ModelLang;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * Class StaffRepository.
 */
class StaffRepository extends AbstractRepository
{
	/**
	 * @return string
	 *  Return the model
	 */
	public function model()
	{
		return Staff::class;
	}

	public function modelLang()
	{
		return StaffLang::class;
	}

	public function create(array $attributes)
	{
		$res = ($entity = $this->makeModel())->fillExisting($attributes)->save();
		if (!$res) {
			return null;
		}
		$this->fillForCreate($entity, $this->getCurrentLanguage(), $attributes);

		return $entity;
	}

	private function fillForCreate(Staff $facultie, Language $language, array $attributes): void
    {
		$attributes[$facultie->getForeignKey()] = $facultie->getKey();
		$attributes[$language->getForeignKey()] = $language->getKey();
		$entityLang = $this->makeModelLang();
		$entityLang->fillExisting($attributes)->save();
	}

	public function update(array $attributes, $id)
	{
		$isModel = ($id instanceof Model);
		$model = ($isModel) ? $id : $this->find($id);
		$model->fillExisting($attributes)->save();
		/** @var  $entityLang ModelLang */
		if (!$entityLang = $model->lang) {
			$this->fillForCreate($model, $this->getCurrentLanguage(), $attributes);
		} else {
			$entityLang->fillExisting($attributes)->save();
		}

		return $model;
	}

	public function getListForAdmin(): LengthAwarePaginator
	{
		/** @var  $list */
		$list = Staff::with('lang')->paginate();

		return $list;
	}

    /**
     * @param $id
     * @return Staff
     */
	public function findForEdit($id): Staff
	{
		return $this->with('lang')->findOrFail($id);
	}

}
