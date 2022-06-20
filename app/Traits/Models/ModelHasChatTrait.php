<?php declare(strict_types=1);

namespace App\Traits\Models;

use App\Models\Chat\Chat;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait ModelHasChatTrait
{
    public function chat(): MorphMany
    {
        return $this->morphMany(Chat::class, 'chatable');
    }

}
