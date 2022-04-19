<?php declare(strict_types=1);

namespace App\Traits\Requests\Helpers;

use Illuminate\Support\Str;

trait IsAction
{
    public function isActionUpdate(): bool
    {
        return in_array($this->getMethod(), [
            'PUT', 'PATCH',
        ]);
    }

    public function isActionStore(): bool
    {
        return Str::upper($this->getMethod()) === 'POST';
    }

    public function isActionDelete(): bool
    {
        return Str::upper($this->getMethod()) === 'DELETE';
    }
}
