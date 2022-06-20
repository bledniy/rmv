<?php

namespace App\Criteria\User;

use App\DataContainers\Admin\User\SearchDataContainer;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class ActiveCriteria.
 *
 * @package namespace App\Criteria;
 */
class UserFilterCriteria implements CriteriaInterface
{
    /**
     * @var SearchDataContainer
     */
    private $searchDataContainer;

    public function __construct(SearchDataContainer $searchDataContainer)
    {
        $this->searchDataContainer = $searchDataContainer;
    }

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
        if ($search = $this->searchDataContainer->getSearch()) {
            $model = $model->where(function (Builder $builder) use ($search) {
                $builder->whereLike('name', $search)
                    ->orWhereLike('email', $search)
                ;
            });
        }

        return $model;
    }
}
