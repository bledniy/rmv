<?php declare(strict_types=1);

namespace App\Events\Admin;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MenusChanged
{
    use Dispatchable, SerializesModels;

    public function __construct()
    {
    }

}
