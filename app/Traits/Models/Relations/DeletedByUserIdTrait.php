<?php


namespace App\Traits\Models\Relations;


use App\Models\Model;
use App\Models\Staff\DeletedBy;

trait DeletedByUserIdTrait
{
    public function deletable(): \Illuminate\Database\Eloquent\Relations\MorphOne
    {
        /** @var $this Model */
        return $this->morphOne(DeletedBy::class, 'deletable');
    }

}