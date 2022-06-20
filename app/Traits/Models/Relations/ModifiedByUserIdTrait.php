<?php


namespace App\Traits\Models\Relations;


use App\Models\Model;
use App\Models\Staff\ModifiedBy;

trait ModifiedByUserIdTrait
{
    public function modifiable(): \Illuminate\Database\Eloquent\Relations\MorphOne
    {
        /** @var $this Model */
        return $this->morphOne(ModifiedBy::class, 'modifiable');
    }

}