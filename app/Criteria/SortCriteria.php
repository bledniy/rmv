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
class SortCriteria implements CriteriaInterface
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
        $model = $model->orderBy('sort')->orderByDesc('id');

        return $model;
    }
}
