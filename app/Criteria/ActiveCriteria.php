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
class ActiveCriteria implements CriteriaInterface
{
    private $table;

    private $column = 'active';

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
        $model = $model->where($this->table ? implode('.', [$this->table, $this->column]) : $this->column, 1);

        return $model;
    }

    /**
     * @param mixed $table
     * @return ActiveCriteria
     */
    public function setTable($table)
    {
        $this->table = $table;

        return $this;
    }
}
