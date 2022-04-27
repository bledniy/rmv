<?php

namespace App\Repositories;

use App\Models\Department\Department;
use App\Models\Language;
use App\Models\Model;
use App\Models\ModelLang;
use App\Models\Department\DepartmentLang;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * Class DepartmentRepository.
 */
class DepartmentRepository extends AbstractRepository
{
	/**
	 * @return string
	 *  Return the model
	 */
	public function model()
	{
		return Department::class;
	}

	public function modelLang()
	{
		return DepartmentLang::class;
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

	private function fillForCreate(Department $news, Language $language, array $attributes)
	{
		$attributes[$news->getForeignKey()] = $news->getKey();
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
		$list = Department::with('lang')->paginate();

		return $list;
	}

	/**
	 * @param $id
	 * @return Department
	 */
	public function findForEdit($id): Department
	{
		return $this->with('lang')->findOrFail($id);
	}

}
