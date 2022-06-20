<?php

namespace App\Traits\Models;


use App\Models\Category\Category;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait BelongsToCategory
{
    /**
     * @return BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * @return Category
     */
    public function getCategory()
    {
        return $this->category;
    }
}
