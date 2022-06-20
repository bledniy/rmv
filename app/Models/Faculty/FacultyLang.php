<?php

namespace App\Models\Faculty;

use App\Models\ModelLang;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FacultyLang extends ModelLang
{

    protected $primaryKey = ['faculty_id', 'language_id'];

    protected $guarded = [];

    public function faculties(): BelongsTo
    {
        return $this->belongsTo(Faculty::class);
    }
}
