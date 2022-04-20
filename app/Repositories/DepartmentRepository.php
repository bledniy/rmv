<?php

namespace App\Repositories;

use App\Criteria\ActiveCriteria;
use App\Criteria\PublishedAtCriteria;
use App\Models\Department\Department;
use App\Models\Language;
use App\Models\Model;
use App\Models\ModelLang;
use App\Models\Department\DepartmentLang;
use App\Traits\Repositories\RebuildNextAndPrev;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Prettus\Repository\Exceptions\RepositoryException;

/**
 * Class DepartmentRepository.
 */
class DepartmentRepository extends AbstractRepository
{
	use RebuildNextAndPrev;

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

	public function addPublicCriteriaToQuery(): self
	{
		$this->pushCriteria($this->app->make(ActiveCriteria::class)->setTable('news'));
		$this->pushCriteria($this->app->make(PublishedAtCriteria::class)->setTable('news'));
		$this->applyCriteria()->resetCriteria();

		return $this;
	}

	public function getListForAdmin(): LengthAwarePaginator
	{
		/** @var  $list */
		$list = Department::with('lang')->orderBy('published_at', 'desc')->paginate();

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

	public function findByUrl(string $url): Department
	{
		return $this->addPublicCriteriaToQuery()
			->where('url', $url)->with(['lang', 'nextNew.lang', 'nextNew.nextNew.lang', 'category.lang'])
			->firstOrFail()
		;
	}

	public function getListPublic(SearchDataContainer $dataContainer): LengthAwarePaginator
	{
		$this->addPublicCriteriaToQuery();
		$this->model = $this->joinLang(null, 'inner');
		if ($search = $dataContainer->getSearch()) {
			$this
				->whereLike('url', $search)
				->orWhereLike('name', $search)
				->orWhereLike('title', $search)
			;
		}
		if ($dataContainer->getCategories()) {
			$this->whereIn('news_category_id', $dataContainer->getCategories());
		}
		$this->whereNotNull('language_id')
			->orderBy('published_at', 'desc')
		;

		return $this->paginate($dataContainer->getOnPage());
	}

	public function getAllForNextPrev(): Collection
	{
		$this->pushCriteria($this->app->make(ActiveCriteria::class)->setTable('news'));

		return $this->orderByDesc('published_at')->get();
	}

	/**
	 * @return Collection|Department[]
	 */
	public function getForNotification(): Collection
	{
		$this->addPublicCriteriaToQuery();
		$this->where('is_notified', false);

		return $this->get();
	}

	/**
	 * @return Collection|Department[]
	 * @throws RepositoryException
	 */
	public function getOneDepartmentWithJoinedLanguages(int $newsId): Collection
	{
		$this->model = $this->initBuilder();
		$this->model = $this->joinLangs($this->model, 'inner');
		$this->whereKey($newsId);

		return $this->get();
	}

}
