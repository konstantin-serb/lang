<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\SectionController;



Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::middleware('auth')->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::resource('language', LanguageController::class);
    Route::resource('section', SectionController::class);
    Route::get('/section/{section}/{language}/create/new', [SectionController::class, 'createSection'])->name('section.create.sec');
    Route::get('/section/{section}/delete', [SectionController::class, 'delete'])->name('section.delete');
});

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
