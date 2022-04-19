<?php

namespace App\Criteria\Feedback;

use App\DataContainers\Admin\Feedback\SearchDataContainer;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class ActiveCriteria.
 *
 * @package namespace App\Criteria;
 */
class FeedbackFilterCriteria implements CriteriaInterface
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
     * @param string | Model|Builder $model
     * @param RepositoryInterface $repository
     *
     * @return mixed
     */
    public function apply($model, RepositoryInterface $repository)
    {
        if ($search = $this->searchDataContainer->getSearch()) {
            $model = $model->where(function (Builder $builder) use ($search) {
                $builder
                    ->whereLike('phone', $search)
                    ->orWhereLike('email', $search)
                    ->orWhereLike('message', $search)
                ;
            });
        }
        if ($type = $this->searchDataContainer->getType()) {
            $model = $model->where('type', $type);
        }

        return $model;
    }
}
