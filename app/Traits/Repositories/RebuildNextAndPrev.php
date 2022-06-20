<?php

namespace App\Traits\Repositories;

use App\Contracts\Models\HasNextPrevAttributes;
use App\Models\Model;
use Illuminate\Support\Collection;

trait RebuildNextAndPrev
{
    public function rebuildNextPrev(): void
    {
        $list = $this->getAllForNextPrev();
        /** @var  $model HasNextPrevAttributes | Model */
        /** @var  $next Model */
        /** @var  $prev Model */
        foreach ($list as $index => $model) {
            if (!classImplementsInterface($model, HasNextPrevAttributes::class)) {
                continue;
            }
            $prevId = ($prev = $list->get($index + 1)) ? $prev->getKey() : null;
            $model->setPrevIdAttribute($prevId);
            $nextId = ($next = $list->get($index - 1)) ? $next->getKey() : null;
            $model->setNextIdAttribute($nextId);

            $model->save();
        }
    }

    public function getAllForNextPrev(): Collection
    {
        return $this->all();
    }

}