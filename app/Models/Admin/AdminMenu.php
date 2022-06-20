<?php

namespace App\Models\Admin;

use App\Models\Model;
use App\Scopes\SortOrderScope;
use App\Traits\Models\ImageAttributeTrait;
use App\Traits\Models\NameAttributeTrait;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class AdminMenu extends Model
{
    use NameAttributeTrait;

    protected $guarded = [
        'id',
    ];

    public function isAnchor(): bool
    {
        return Str::startsWith($this->url, '#');
    }

    public static function boot(): void
    {
        parent::boot();

        self::addGlobalScope(new SortOrderScope);
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(__CLASS__, 'parent_id', 'id');
    }

    public function childrens(): HasMany
    {
        return $this->hasMany(__CLASS__, 'parent_id', 'id');
    }

    public function getUrlWithPrefix(): string
    {
        if ($this->isAnchor()) {
            return (string)$this->url;
        }

        return sprintf('/%s/%s', \Config::get('app.admin-url', 'admin'), trim($this->url, '/'));
    }
}
