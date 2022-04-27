<?php

namespace App\Models\Department;

use App\Models\ModelLang;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DepartmentLang extends ModelLang
{

    protected $primaryKey = ['department_id', 'language_id'];

    protected $guarded = [];

    public function departments(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }
}
