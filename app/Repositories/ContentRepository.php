<?php

namespace App\Repositories;

use App\Criteria\ActiveCriteria;
use App\Criteria\SortCriteria;
use App\Helpers\Debug\LoggerHelper;
use App\Models\Content\Content;
use App\Models\Content\ContentLang;
use App\Models\Content\HasContentable;
use App\Models\Model;
use Illuminate\Database\Eloquent\Builder;


class ContentRepository extends AbstractRepository
{

    public function model(): string
    {
        return Content::class;
    }

    public function modelLang(): string
    {
        return ContentLang::class;
    }

    public function create(array $attributes):Content
    {
        return parent::create($attributes);
    }

    public function findTyped($id, $type): Content
    {
        return Content::where('type', $type)->whereKey($id)->firstOrFail();
    }

    public function addPublicCriteriaToQuery(): self
    {
        $this->pushCriteria($this->app->make(SortCriteria::class));
        $this->pushCriteria($this->app->make(ActiveCriteria::class));

        return $this;
    }

    public function addAdminCriteriaToQuery()
    {
        $this->pushCriteria($this->app->make(SortCriteria::class));
    }

    public function createMorphed(Model $morphTo, $attributes)
    {
        try {
            $attributes['contentable_type'] = get_class($morphTo);
            $attributes['contentable_id'] = $morphTo->getKey();

            return $this->create($attributes);
        } catch (\Exception $e) {
            app(LoggerHelper::class)->error($e);
        }

        return null;
    }

    public function getListPublicByType(string $type)
    {
        $this->addPublicCriteriaToQuery()->applyCriteria();
        $this->model->with('lang')
            ->whereNull('contentable_type')
            ->whereNull('contentable_id')
            ->where('type', $type);

        return $this->get();
    }

    public function getListPublicByModel(HasContentable $model, $type = null)
    {
        /** @var Builder $query */
        $this->model = $query = $model->content();
        $this->addPublicCriteriaToQuery()->applyCriteria();

        if ($type) {
            $query->where('type', $type);
        }

        return $this->get();
    }

}

