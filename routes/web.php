<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\PhraseController;



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

    Route::resource('phrase', PhraseController::class);
    Route::get('/phrase/{section}/create', [PhraseController::class, 'createPhrase'])->name('phrase.create.phrase');
});

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
