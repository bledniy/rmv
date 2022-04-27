<?php

namespace App\Models\Staff;

use App\Models\ModelLang;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StaffLang extends ModelLang
{

    protected $primaryKey = ['department_id', 'language_id'];

    protected $guarded = [];

    public function staffs(): BelongsTo
    {
        return $this->belongsTo(Staff::class);
    }
}
