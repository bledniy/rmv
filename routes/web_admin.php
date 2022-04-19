<?php

use App\Enum\ContentTypeEnum;
use App\Http\Controllers\Admin\Admin\AdminProfileController;
use App\Http\Controllers\Admin\Admin\AdminTodoController;
use App\Http\Controllers\Admin\AdminMenuController;
use App\Http\Controllers\Admin\AjaxController;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\Content\BrandsController;
use App\Http\Controllers\Admin\Content\VacancyController;
use App\Http\Controllers\Admin\Feedback\FeedbackController;
use App\Http\Controllers\Admin\IndexController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\Meta\MetaController;
use App\Http\Controllers\Admin\Meta\RedirectController;
use App\Http\Controllers\Admin\Meta\RobotController;
use App\Http\Controllers\Admin\Meta\SitemapController;
use App\Http\Controllers\Admin\News\NewsController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\PhotosController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\Slider\SliderController;
use App\Http\Controllers\Admin\Staff\LogViewController;
use App\Http\Controllers\Admin\TranslateController;
use App\Http\Controllers\Admin\User\UserController;

Route::group(['prefix' => 'admin'], static function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [LoginController::class, 'login']);
    Route::post('/logout', [LoginController::class, 'logout'])->name('admin.logout');
});
Route::group(['prefix' => LaravelLocalization::setLocale(), 'middleware' => ['localizationRedirect'],], static function () {
    Route::middleware(['auth-admin:admin', 'bindings'])
        ->prefix('admin')
        ->group(function () {
            Route::get('/todo', [AdminTodoController::class, 'index'])->name('admin.todo.index');
            Route::get('/', [IndexController::class, 'index'])->name('admin.index');
            Route::resource('users', UserController::class, ['as' => 'admin']);
            Route::post('/users/sign-super-admin', [UserController::class, 'signSuperAdmin'])->name('sign-super-admin');
            Route::group(['prefix' => 'profile',], static function () {
                Route::get('/', [AdminProfileController::class, 'profile'])->name('admin.profile');
                Route::post('/', [AdminProfileController::class, 'profileUpdate'])->name('admin.profile.update');
            });

            Route::resources([
                'translate' => TranslateController::class,
                'settings' => SettingController::class,
            ]);
//  Contents
            Route::resources([
                ContentTypeEnum::BRAND => BrandsController::class,
                ContentTypeEnum::VACANCY => VacancyController::class,
            ], ['as' => 'admin', 'except' => ['show'],]);

            Route::resources([
                'roles' => RoleController::class,
                'menu' => MenuController::class,
                'admin-menus' => AdminMenuController::class,
                'news' => NewsController::class,
                'pages' => PageController::class,
            ], ['as' => 'admin', 'except' => ['show']]
            );

            Route::post('/menu/nesting', [MenuController::class, 'nesting'])->name('admin.menu.nesting');
            Route::post('/admin-menus/nesting', [AdminMenuController::class, 'nesting'])->name('admin.admin-menus.nesting');
            Route::patch('/admin-menus/save/all', [AdminMenuController::class, 'updateAll'])->name('admin-menus.updateAll');
// Slider
            Route::resource('sliders', SliderController::class, ['except' => ['show'], 'as' => 'admin']);
            Route::post('/sliders/item/{slider}', [SliderController::class, 'createSliderItem'])->name('admin.sliders.store-item');

            Route::get('/feedback/{type?}', [FeedbackController::class, 'index'])->name('admin.feedback.index');
            Route::match(['DELETE', 'POST'], 'feedback/{feedback}', [FeedbackController::class, 'destroy'])->name('admin.feedback.destroy');

            Route::group([], static function () {
                Route::resource('meta', MetaController::class, ['parameters' => ['meta' => 'meta'], 'as' => 'admin', 'except' => ['show']]);
                Route::resource('redirects', RedirectController::class, ['as' => 'admin', 'except' => ['show']]);
                Route::get('/robots', [RobotController::class, 'index'])->name('admin.robots.index');
                Route::put('/robots', [RobotController::class, 'update'])->name('admin.robots.update');
                Route::resource('/sitemap', SitemapController::class, ['only' => ['index', 'store'], 'as' => 'admin']);
            });

            Route::group(['prefix' => 'photos'], static function () {
                Route::post('/edit', [PhotosController::class, 'edit']);
                Route::post('/delete', [PhotosController::class, 'delete']);
                Route::match(['get', 'post'], '/get-cropper', [PhotosController::class, 'getPhotoCropper']);
            });

            Route::group(['as' => 'settings.', 'prefix' => 'settings',], static function () {
                Route::get('{id}/delete_value', [
                    'uses' => [SettingController::class, 'delete_value'],
                    'as' => 'delete_value',
                ]);
            });

            Route::group(['prefix' => 'ajax'], static function () {
                Route::post('/sort', [AjaxController::class, 'sort'])->name('sort');
                Route::post('/delete', [AjaxController::class, 'delete'])->name('delete');
            });

            Route::prefix('dashboard')
                ->group(function () {
                    Route::post('/cache/clear', [IndexController::class, 'clearCache'])->name('cache.clear');
                    Route::post('/cache/clear/view', [IndexController::class, 'clearView'])->name('cache.view');
                    Route::post('/artisan/storage-link', [IndexController::class, 'storageLink'])->name('artisan.storage.link');
                    Route::get('/counters', [IndexController::class, 'getCounters'])->name('dashboard.counters');
                })
            ;

            Route::get('logs', [LogViewController::class, 'index']);

        })
    ;
});