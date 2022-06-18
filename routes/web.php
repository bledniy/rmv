<?php

use App\Http\Controllers\ContactsController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\FacultyController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NewsController;

Route::group(['prefix' => LaravelLocalization::setLocale(), 'middleware' => ['localizationRedirect'],], static function () {

    Route::get('/', [HomeController::class, 'home'])->name('home');
    Route::get('/contacts', [ContactsController::class, 'index'])->name('contacts');
    Route::get('/faculty/{id}', [FacultyController::class, 'show'])->name('faculty.show');
    Route::get('/department/{id}', [DepartmentController::class, 'show'])->name('department.show');

    Route::get('/news', [NewsController::class, 'index'])->name('news.index');
    Route::get('/news/{id}', [NewsController::class, 'show'])->name('news.show');
//    Route::get('/news/{news}/modal', [NewsController::class, 'showModalRendered'])->name('news.show.modal');

});
