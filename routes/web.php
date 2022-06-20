<?php

use App\Enum\ContentTypeEnum;
use App\Http\Controllers\ContactsController;
use App\Http\Controllers\CooperationController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\FacultyController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\PrezudiaController;

Route::group(['prefix' => LaravelLocalization::setLocale(), 'middleware' => ['localizationRedirect'],], static function () {

    Route::get('/', [HomeController::class, 'home'])->name('home');
    Route::get('/contacts', [ContactsController::class, 'index'])->name('contacts');
    Route::get('/faculty/{id}', [FacultyController::class, 'show'])->name('faculty.show');
    Route::get('/department/{id}', [DepartmentController::class, 'show'])->name('department.show');
    Route::get('/'.ContentTypeEnum::COOPERATION, [CooperationController::class, 'index'])->name('cooperation.index');
    Route::get('/prezudiya', [PrezudiaController::class, 'show'])->name('prezudia.show');

    Route::get('/documents', [DocumentController::class, 'index'])->name('documents.index');
    Route::get('/news', [NewsController::class, 'index'])->name('news.index');
    Route::get('/news/{id}', [NewsController::class, 'show'])->name('news.show');
//    Route::get('/news/{news}/modal', [NewsController::class, 'showModalRendered'])->name('news.show.modal');

});
