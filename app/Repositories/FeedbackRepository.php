<?php

namespace App\Repositories;

use App\Criteria\Feedback\FeedbackFilterCriteria;
use App\DataContainers\Admin\Feedback\SearchDataContainer;
use App\Models\Feedback\Feedback;

/**
 * Class FeedbackRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class FeedbackRepository extends AbstractRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Feedback::class;
    }

    public function addAdminCriteriaToQuery()
    {

    }

    public function getListAdmin(?SearchDataContainer $searchDataContainer = null)
    {
        $this->addAdminCriteriaToQuery();

        if ($searchDataContainer) {
            $this->applyFilter($searchDataContainer);
        }

        return $this->latest()->paginate();
    }

    public function applyFilter(SearchDataContainer $searchDataContainer): self
    {
        $this->pushCriteria($this->app->make(FeedbackFilterCriteria::class, compact('searchDataContainer')));

        return $this;
    }


}
