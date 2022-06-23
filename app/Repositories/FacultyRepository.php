<?php

namespace App\Repositories;

use App\Models\Faculty\Faculty;
use App\Models\Faculty\FacultyLang;
use App\Models\Language;
use App\Models\Model;
use App\Models\ModelLang;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * Class FacultyRepository.
 */
class FacultyRepository extends AbstractRepository
{

	/**
	 * @return string
	 *  Return the model
	 */
	public function model(): string
    {
		return Faculty::class;
	}

	public function modelLang(): string
    {
		return FacultyLang::class;
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

	private function fillForCreate(Faculty $facultie, Language $language, array $attributes)
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
		$list = Faculty::with('lang')->orderBy('sort')->paginate();

		return $list;
	}

    /**
     * @param $id
     * @return Faculty
     */
	public function findForEdit($id): Faculty
	{
		return $this->with('lang')->findOrFail($id);
	}

}
