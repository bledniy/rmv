<?php

namespace App\Models\News;

use App\Models\ModelLang;

class NewsLang extends ModelLang
{

    protected $primaryKey = ['news_id', 'language_id'];

    protected $guarded = [];

    public function news()
    {
        return $this->belongsTo(News::class);
    }
}
