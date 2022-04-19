<?php

namespace App\Criteria;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class SortCriteria.
 *
 * @package namespace App\Criteria;
 */
class SortNameCriteria implements CriteriaInterface
{
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
        $model = $model->orderBy('name');

        return $model;
    }
}
