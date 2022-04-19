<?php


namespace App\Traits\Models\Relations;


use App\Models\User;

trait DeletedByUser
{
    public function deletedBy()
    {
        return $this->belongsTo(User::class, 'deleted_by');
    }
}
