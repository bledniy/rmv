<?php

namespace App\Models\Content;

use App\Models\ModelLang;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ContentLang extends ModelLang
{

    protected $fillable = [
        'content_id',
        'language_id',
        'name',
        'title',
        'except',
        'description',
    ];

    protected $primaryKey = ['content_id', 'language_id'];

    public function content(): BelongsTo
    {
        return $this->belongsTo(Content::class);
    }
}
