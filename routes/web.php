<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\PhraseController;
use App\Http\Controllers\LearnController;
use App\Http\Controllers\DictionaryController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\OptionsCotnroller;
use App\Http\Controllers\StatisticController;



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
    Route::post('/learn/mix', [LearnController::class, 'learningMixPrepare']);
    Route::post('/learn/search', [LearnController::class, 'searchPhrases'])->name('learn.searchPhrase');
    Route::get('/learn/mixPhrases/{word}/{conditions}/{ids}', [LearnController::class, 'learnMix'])->name('learn/mixPhrases');
    Route::get('/learn/mixTrain/{conditions}/{ids}', [LearnController::class, 'learnMixTrain'])->name('learn/mixTrain');
    Route::post('/learn/changeComplexity', [LearnController::class, 'changeComplexity']);
    Route::post('/learn/commutator', [LearnController::class, 'learnCommutator'])->name('learn.commutator');
    Route::get('/train', [LearnController::class, 'trainIndex'])->name('train.index');

    Route::get('/dictionary/enter', [DictionaryController::class, 'enterToDictionary'])->name('dictionary.enter');
    Route::get('/dictionary/{language_id}/all', [DictionaryController::class, 'allDictionary'])->name('dictionary.all');
    Route::get('/dictionary/{phrase}/add', [DictionaryController::class, 'addPhrase'])->name('dictionary.add.phrase');
    Route::get('/dictionary/view/{word}', [DictionaryController::class, 'view'])->name('dictionary.view');
    Route::get('/dictionary/delete/{word}', [DictionaryController::class, 'delete'])->name('dictionary.delete');
    Route::delete('/dictionary/delete', [DictionaryController::class, 'destroy'])->name('dictionary.destroy');
    Route::post('/dictionary/check', [DictionaryController::class, 'changeStatus']);
    Route::get('/dictionary/{language_id}', [DictionaryController::class, 'index'])->name('dictionary');

    Route::post('/options/changeDefaultLanguage', [OptionsCotnroller::class, 'changeDefaultLanguage'])->name('options.changeLanguageDefault');

    Route::get('/search/by_word/{language_id}/{word}', [SearchController::class, 'searchByWord'])->name('search.by_word');
    Route::get('/search/by_word', [SearchController::class, 'searchPhrase'])->name('search.by_phrase');

    Route::get('/statistic', [StatisticController::class, 'index'])->name('statistic');
    Route::get('/add-words/{language_id}', [StatisticController::class, 'addingWords'])->name('stat.add.words');


    Route::get('/temp', [StatisticController::class, 'temp']);

});

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
