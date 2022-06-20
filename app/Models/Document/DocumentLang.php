<?php

namespace App\Models\Document;

use App\Models\ModelLang;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DocumentLang extends ModelLang
{

    protected $primaryKey = ['document_id', 'language_id'];

    protected $guarded = [];

    public function document(): BelongsTo
    {
        return $this->belongsTo(Document::class);
    }
}
