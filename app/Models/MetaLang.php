<?php

namespace App\Models;


class MetaLang extends ModelLang
{
    protected $table = 'meta_lang';

    protected $primaryKey = ['meta_id', 'language_id'];

    protected $guarded = [];

    public function meta()
    {
        return $this->belongsTo(Meta::class);
    }
}
