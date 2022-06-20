<?php

namespace App\Repositories;

use App\Builders\Model\TemporaryBuilder;
use App\Models\Temporary;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class TemporaryRepository extends AbstractRepository
{

    public function model()
    {
        return Temporary::class;
    }

    public function findByKey(string $key): ?Temporary
    {
        return $this->where('key', $key)->first();
    }

    public function getBuilder($key = null): TemporaryBuilder
    {
        return (new TemporaryBuilder($this))->setKey($key);
    }

    protected function expiredQuery()
    {
        return $this->model = $this->model->where('created_at', '<', DB::raw(' SUBDATE(NOW(), INTERVAL 1 week) '));
    }

    public function deleteExpired()
    {
        return $this->expiredQuery()
            ->where('deletable', 1)
            ->delete()
            ;
    }

    /**
     * @param $type
     * @return Collection | Temporary[]
     */
    public function getExpiredListByType($type): Collection
    {
        return $this->expiredQuery()
            ->where('type', $type)
            ->get()
            ;
    }
}