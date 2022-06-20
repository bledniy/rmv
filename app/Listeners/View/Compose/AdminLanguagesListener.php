<?php declare(strict_types=1);

namespace App\Listeners\View\Compose;

use App\Models\Language;
use Illuminate\View\View;

class AdminLanguagesListener
{

    public function handle(View $view)
    {
        $view->with(['languages' => Language::all()]);
    }
}
