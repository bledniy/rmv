<?php

namespace App\Traits\Models;


use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait BelongsToUser
{
    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return User | null
     */
    public function getUser()
    {
        return $this->user;
    }
}
