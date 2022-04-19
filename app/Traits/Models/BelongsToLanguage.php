<?php declare(strict_types=1);

namespace App\Traits\Models;

use App\Models\Language;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait BelongsToLanguage
{
    /**
     * @return BelongsTo
     */
    public function language(): BelongsTo
    {
        return $this->belongsTo(Language::class, 'language_id', 'id');
    }

    public function associateWithLanguage(Language $language): Model
    {
        return $this->language()->associate($language);
    }
}