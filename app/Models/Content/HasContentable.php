<?php declare(strict_types=1);

namespace App\Models\Content;

interface HasContentable
{
    public function content(): \Illuminate\Database\Eloquent\Relations\MorphMany;
}