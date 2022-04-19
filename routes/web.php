<?php

use App\Http\Controllers\ContactsController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\VacancyController;

Route::group(['prefix' => LaravelLocalization::setLocale(), 'middleware' => ['localizationRedirect'],], static function () {

    Route::get('/', [HomeController::class, 'home'])->name('home');
    Route::get('/contacts', [ContactsController::class, 'index'])->name('contacts');
    Route::get('/vacancy', [VacancyController::class, 'index'])->name('vacancy');

    Route::get('/news', [NewsController::class, 'index'])->name('news.index');
    Route::get('/news/load-more', [NewsController::class, 'loadMore'])->name('news.load-more');
    Route::get('/news/{news}/modal', [NewsController::class, 'showModalRendered'])->name('news.show.modal');

    Route::post('/feedback', [FeedbackController::class, 'default'])->name('feedback.default');
    Route::post('/feedback/vacancy', [FeedbackController::class, 'vacancy'])->name('feedback.vacancy');

});
