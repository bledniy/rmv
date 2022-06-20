<?php declare(strict_types=1);

namespace App\Http\Middleware;

class AdminAuthenticated extends Authenticate
{
    protected function redirectTo($request): string
    {
        return route('admin.login');
    }
}
