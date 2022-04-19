<?php

namespace App\Traits\Models\User;

use App\Models\User\SocialProvider;
use App\Traits\Models\BelongsToLanguage;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait UserRelationTrait
{
    use BelongsToLanguage;

    public function socialProviders(): HasMany
    {
        return $this->hasMany(SocialProvider::class);
    }


}
