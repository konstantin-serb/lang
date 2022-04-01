<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\PhraseController;
use App\Http\Controllers\LearnController;
use App\Http\Controllers\DictionaryController;



Route::get('/', [\App\Http\Controllers\HomeController::class, 'startPage']);


Auth::routes();

Route::middleware('auth')->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::resource('language', LanguageController::class);

    Route::resource('section', SectionController::class);
    Route::get('/section/{section}/{language}/create/new', [SectionController::class, 'createSection'])->name('section.create.sec');
    Route::get('/section/{section}/delete', [SectionController::class, 'delete'])->name('section.delete');

    Route::resource('phrase', PhraseController::class);
    Route::get('/phrase/{section}/create', [PhraseController::class, 'createPhrase'])->name('phrase.create.phrase');
    Route::get('/phrase/{phrase}/delete', [PhraseController::class, 'delete'])->name('phrase.delete');
    Route::get('/phrase/{section}/deleteAll', [PhraseController::class, 'deleteAll'])->name('phrase.deleteAll');
    Route::delete('/phrase/{section}/destroyAll', [PhraseController::class, 'destroyAll'])->name('phrase.destroyAll');

    Route::get('/learn/nullable/{section}', [LearnController::class, 'getNullable'])->name('learn.nullable');
    Route::get('/learn/{string}/{sections?}', [LearnController::class, 'learn'])->name('learn');
    Route::get('/read/{string}/{sections?}', [LearnController::class, 'read'])->name('read');
    Route::post('/learn/check', [LearnController::class, 'checkPhraseAjax']);
    Route::post('/learn/read', [LearnController::class, 'readPhraseAjax']);
    Route::post('/learn/changeComplexity', [LearnController::class, 'changeComplexity']);
    Route::post('/learn/commutator', [LearnController::class, 'learnCommutator'])->name('learn.commutator');

    Route::get('/dictionary/enter', [DictionaryController::class, 'enterToDictionary'])->name('dictionary.enter');
    Route::get('/dictionary/{language_id}/all', [DictionaryController::class, 'allDictionary'])->name('dictionary.all');
    Route::get('/dictionary/{phrase}/add', [DictionaryController::class, 'addPhrase'])->name('dictionary.add.phrase');
    Route::get('/dictionary/view/{word}', [DictionaryController::class, 'view'])->name('dictionary.view');
    Route::get('/dictionary/delete/{word}', [DictionaryController::class, 'delete'])->name('dictionary.delete');
    Route::delete('/dictionary/delete', [DictionaryController::class, 'destroy'])->name('dictionary.destroy');
    Route::post('/dictionary/check', [DictionaryController::class, 'changeStatus']);
    Route::get('/dictionary/{language_id}', [DictionaryController::class, 'index'])->name('dictionary');

});

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
