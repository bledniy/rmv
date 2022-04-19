<?php declare(strict_types=1);

namespace App\Models;

use App\Traits\EloquentMultipleForeignKeyUpdate;
use App\Traits\Models\BelongsToLanguage;

class ModelLang extends Model
{
    use BelongsToLanguage;

    use EloquentMultipleForeignKeyUpdate;

    protected $guarded = ['id'];

    public $incrementing = false;

    public $timestamps = false;

}



