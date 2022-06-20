<?php

namespace App\Models;

use App\Scopes\SortOrderScope;
use App\Traits\Models\ImageAttributeTrait;

class Image extends Model
{
    use ImageAttributeTrait;

    const DEFAULT_WIDTH = 250;
    const DEFAULT_HEIGHT = 250;

    public $fillable = [
        'imageable_type',
        'imageable_id',
        'active',
        'name',
        'image',
        'sort',
        'created_at',
        'updated_at',
    ];

    /**
     * Get all of the owning imageable models.
     */
    public function imageable()
    {
        return $this->morphTo();
    }

    public static function boot()
    {
        parent::boot();

        static::addGlobalScope(new SortOrderScope);
    }
}
