<?php


namespace App\Models\Admin\Traits;


use App\Traits\Models\Relations\DeletedByUserIdTrait;
use App\Traits\Models\Relations\ModifiedByUserIdTrait;

trait AdminRelationsTrait
{
    use ModifiedByUserIdTrait, DeletedByUserIdTrait;
}