<?php

namespace App\Repositories;

use App\Criteria\ActiveCriteria;
use App\Criteria\PublishedAtCriteria;
use App\DataContainers\Document\SearchDataContainer;
use App\Models\Language;
use App\Models\Model;
use App\Models\ModelLang;
use App\Models\Document\Document;
use App\Models\Document\DocumentLang;
use App\Traits\Repositories\RebuildNextAndPrev;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Prettus\Repository\Exceptions\RepositoryException;

/**
 * Class DocumentRepository.
 */
class DocumentRepository extends AbstractRepository
{
	use RebuildNextAndPrev;

	/**
	 * @return string
	 *  Return the model
	 */
	public function model()
	{
		return Document::class;
	}

	public function modelLang()
	{
		return DocumentLang::class;
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

	private function fillForCreate(Document $news, Language $language, array $attributes)
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
		$this->pushCriteria($this->app->make(ActiveCriteria::class)->setTable('documents'));
		$this->pushCriteria($this->app->make(PublishedAtCriteria::class)->setTable('documents'));
		$this->applyCriteria()->resetCriteria();

		return $this;
	}

	public function getListForAdmin(): LengthAwarePaginator
	{
		/** @var  $list */
		$list = Document::with('lang')->orderBy('published_at', 'desc')->paginate();

		return $list;
	}

	/**
	 * @param $id
	 * @return \App\Models\Document\Document
	 */
	public function findForEdit($id): Document
	{
		return $this->with('lang')->findOrFail($id);
	}

	public function findByUrl(string $url): Document
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
	 * @return Collection|Document[]
	 */
	public function getForNotification(): Collection
	{
		$this->addPublicCriteriaToQuery();
		$this->where('is_notified', false);

		return $this->get();
	}

	/**
	 * @return Collection|Document[]
	 * @throws RepositoryException
	 */
	public function getOneDocumentWithJoinedLanguages(int $newsId): Collection
	{
		$this->model = $this->initBuilder();
		$this->model = $this->joinLangs($this->model, 'inner');
		$this->whereKey($newsId);

		return $this->get();
	}

}
