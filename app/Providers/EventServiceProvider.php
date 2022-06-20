<?php declare(strict_types=1);

namespace App\Providers;

use App\Events\Admin\MenusChanged;
use App\Events\Feedback\FeedbackCreated;
use App\Listeners\Admin\Menu\DropMenuCache;
use App\Listeners\Admin\User\OnUserAuth;
use App\Listeners\Feedback\NotifyAdminFeedbackListener;
use App\Listeners\View\Compose\AdminLanguagesListener;
use App\Listeners\View\Compose\MainViewListener;
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

/**
 * Class EventServiceProvider
 * @package App\Providers
 * @see OrderWasMakedListener
 */
class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [],
        Login::class => [
            OnUserAuth::class,
        ],
        MenusChanged::class => [
            DropMenuCache::class,
        ],
        \App\Events\Admin\Image\ImageUploaded::class => [
//            \App\Listeners\Admin\Image\ImageUploadedListener::class,
        ],
        \App\Events\Admin\Image\MultipleImageUploaded::class => [
//            \App\Listeners\Admin\Image\MultipleImageUploadedListener::class,
        ],
        FeedbackCreated::class => [
            NotifyAdminFeedbackListener::class
        ],

        'creating: admin.langlist' => [
            AdminLanguagesListener::class,
        ],
        'creating: *' => [
            MainViewListener::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
    }
}
