<?php declare(strict_types=1);

namespace App\Listeners\View\Compose;

class MainViewListener
{
    private static $isLoaded = false;

    public function handle($event)
    {
        if (!$this->supports()) {
            return;
        }
        self::$isLoaded = true;

//		$with = compact(array_keys(get_defined_vars()));
//		\view()->share($with);
    }

    private function supports(): bool
    {
        if (app()->runningInConsole()) {
            return false;
        }
        if (self::$isLoaded) {
            return false;
        }

        return true;
    }
}
