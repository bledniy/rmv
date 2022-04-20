<?php

namespace App\Models\Facultie;

use App\Models\ModelLang;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FacultieLang extends ModelLang
{

    protected $primaryKey = ['news_id', 'language_id'];

    protected $guarded = [];

    public function faculties(): BelongsTo
    {
        return $this->belongsTo(Facultie::class);
    }
}
