<?php declare(strict_types=1);

namespace App\Providers;

use App\Contents\AbstractContentFieldsList;
use App\Contents\ContentFieldsDataInterface;
use App\Contents\ContentFieldsList;
use App\Contents\ContentRequestInterface;
use App\Contents\DefaultContentFieldsData;
use App\DataContainers\Mail\MailAdminConfigData;
use App\DataContainers\Mail\MailAdminConfigDataInterface;
use App\Http\Requests\Admin\Content\DefaultContentRequest;
use App\Services\Menu\MenusService;
use App\Services\Menu\MenusServiceInterface;
use App\Services\Seo\ApiMetaRequestUrlRewriter;
use App\Services\Seo\SeoUrlRewriterInterface;
use Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Carbon::setLocale(config('app.locale'));
        Schema::defaultStringLength(191);
        $this->registerDev();
        $this->registerBind();
    }

    public function boot(): void
    {
        Paginator::useBootstrap();
    }

    private function registerDev(): void
    {
        if ($this->app->environment() === 'local') {
            $this->app->register(IdeHelperServiceProvider::class);
        }
    }

    private function registerBind(): void
    {
        $this->app->bind(MenusServiceInterface::class, MenusService::class);
        $this->app->bind(SeoUrlRewriterInterface::class, ApiMetaRequestUrlRewriter::class);
        $this->app->bind(MailAdminConfigDataInterface::class, function () {
            return new MailAdminConfigData(getSetting('email.contact-email'), config('mail.name_admin'));
        });
        $this->app->bind(AbstractContentFieldsList::class, ContentFieldsList::class);
        $this->app->bind(ContentFieldsDataInterface::class, DefaultContentFieldsData::class);
        $this->app->bind(ContentRequestInterface::class, DefaultContentRequest::class);
    }

}
