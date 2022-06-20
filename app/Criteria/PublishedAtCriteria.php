<?php

namespace App\Criteria;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class ActiveCriteria.
 *
 * @package namespace App\Criteria;
 */
class PublishedAtCriteria implements CriteriaInterface
{
    private $table;

    private $column = 'published_at';

    /**
     * Apply criteria in query repository
     *
     * @param string | Model $model
     * @param RepositoryInterface $repository
     *
     * @return mixed
     */
    public function apply($model, RepositoryInterface $repository)
    {
        $model = $model->where($this->table ? implode('.', [$this->table, $this->column]) : $this->column, '<=', now());

        return $model;
    }

    public function setTable($table): self
    {
        $this->table = $table;

        return $this;
    }
}
