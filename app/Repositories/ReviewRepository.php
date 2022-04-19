<?php

namespace App\Repositories;

use App\Criteria\ActiveCriteria;
use App\Criteria\IsPublishedCriteria;
use App\Models\Order\Order;
use App\Models\Order\Review;
use App\Models\User;
use App\Platform\Contract\UserTypeContract;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;


class ReviewRepository extends AbstractRepository
{

    public const PER_PAGE = 5;

    public function paginate($limit = null, $columns = ['*'], $method = "paginate")
    {
        $limit = $limit ?: self::PER_PAGE;

        return parent::paginate($limit, $columns, $method);
    }

    public function model()
    {
        return Review::class;
    }

    public function addPublicCriteriaToQuery(): self
    {
        $this->pushCriteria($this->app->make(IsPublishedCriteria::class)->setTable('reviews'));
        $this->addActiveCriteria();

        return $this;
    }

    public function addActiveCriteria()
    {
        $this->pushCriteria($this->app->make(ActiveCriteria::class)->setTable('reviews'));
        $this->applyCriteria()->resetCriteria();

        return $this;
    }

    protected function criteriaByIsOnlyPublished(bool $onlyPublished): self
    {
        if ($onlyPublished) {
            $this->addPublicCriteriaToQuery();
        } else {
            $this->addActiveCriteria();
        }

        return $this;
    }

    public function addAdminCriteriaToQuery()
    {
    }

    public function getListAdmin()
    {
        $this->addAdminCriteriaToQuery();

        return $this->paginate();
    }

    public function getListPublic()
    {
        $this->addPublicCriteriaToQuery();

        return $this->get();
    }

    public function aboutPerformerQuery(Authenticatable $user): Builder
    {
        return $this
            ->where('reviews.to_id', $user->getAuthIdentifier())
            ->where('reviews.about', UserTypeContract::TYPE_PERFORMER)
            ;
    }

    public function fromPerformerQuery(Authenticatable $user): Builder
    {
        return $this
            ->where('reviews.from_id', $user->getAuthIdentifier())
            ->where('reviews.about', UserTypeContract::TYPE_CUSTOMER)
            ;
    }

    public function aboutCustomerQuery(Authenticatable $user): Builder
    {
        return $this
            ->where('reviews.to_id', $user->getAuthIdentifier())
            ->where('reviews.about', UserTypeContract::TYPE_CUSTOMER)
            ;
    }

    public function fromCustomerQuery(Authenticatable $user): Builder
    {
        return $this
            ->where('reviews.from_id', $user->getAuthIdentifier())
            ->where('reviews.about', UserTypeContract::TYPE_PERFORMER)
            ;
    }

    public function getOneAboutPerformer(Order $order, User $performer, bool $onlyPublished = true): ?Review
    {
        $this->criteriaByIsOnlyPublished($onlyPublished);
        /** @var  $reviews */
        $this->whereModel($order);
        $this->aboutPerformerQuery($performer);

        return $this->first();
    }

    public function getOneFromPerformer(Order $order, User $performer, bool $onlyPublished = true): ?Review
    {
        $this->criteriaByIsOnlyPublished($onlyPublished);
        $this->whereModel($order);
        $this->fromPerformerQuery($performer);

        return $this->first();
    }

    public function getOneAboutCustomer(Order $order, User $customer, bool $onlyPublished = true): ?Review
    {
        $this->criteriaByIsOnlyPublished($onlyPublished);
        /** @var  $reviews */
        $this->whereModel($order);
        $this->aboutCustomerQuery($customer);

        return $this->first();
    }

    public function getOneFromCustomer(Order $order, User $customer, bool $onlyPublished = true): ?Review
    {
        $this->criteriaByIsOnlyPublished($onlyPublished);
        $this->whereModel($order);
        $this->fromCustomerQuery($customer);

        return $this->first();
    }

    /**
     * @param User $performer
     * @return Collection | Review[]
     */
    public function getAboutPerformer(User $performer): Collection
    {
        $this->addPublicCriteriaToQuery();
        $this->aboutPerformerQuery($performer);

        return $this->get();
    }

    public function getAboutPerformerPaginated(User $performer): LengthAwarePaginator
    {
        $this->addPublicCriteriaToQuery();
        $this->aboutPerformerQuery($performer);

        return $this->paginate();
    }

    public function getAboutCustomerPaginated(User $customer): LengthAwarePaginator
    {
        $this->addPublicCriteriaToQuery();
        $this->aboutCustomerQuery($customer);

        return $this->paginate();
    }

    /**
     * @param User $customer
     * @return Collection | Review[]
     */
    public function getAboutCustomer(User $customer): Collection
    {
        $this->addPublicCriteriaToQuery();
        $this->aboutCustomerQuery($customer);

        return $this->get();
    }

    public function findUnpublishedReviewsToClosedDeals(): Collection
    {
        return $this->model
            ->leftJoin('orders', 'orders.id', 'reviews.order_id')
            ->where('reviews.is_published', 0)
            ->whereNull('reviews.published_at')
            ->where('reviews.active', 1)
            ->where('orders.is_closed', 1)
            ->where('orders.closes_at', '<=', now()->addDays(config('deals.reviews.days_to_publish')))
            ->get('reviews.*')
            ;
    }
}

