<?php

namespace App\Models\Page;


use App\Models\ModelLang;

class PageLang extends ModelLang
{

    protected $primaryKey = ['page_id', 'language_id'];

    public function page()
    {
        return $this->belongsTo(Page::class);
    }

}
