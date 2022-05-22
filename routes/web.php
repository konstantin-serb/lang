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
use App\Http\Controllers\FavoriteController;





Route::middleware('set_locale')->group(function() {
    Auth::routes();

    Route::get('/', [\App\Http\Controllers\HomeController::class, 'startPage']);
    Route::get('/help', [\App\Http\Controllers\HelpController::class, 'index'])->name('help');
    Route::get('/help/part/{part}', [\App\Http\Controllers\HelpController::class, 'parts'])->name('help.part');

    Route::middleware('auth')->group(function () {
        Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

        Route::resource('language', LanguageController::class);

        Route::resource('section', SectionController::class);
        Route::get('/section/{section}/{language}/create/new', [SectionController::class, 'createSection'])->name('section.create.sec');
        Route::get('/section/{section}/delete', [SectionController::class, 'delete'])->name('section.delete');
        Route::get('/section/{section}/check', [SectionController::class, 'deleteCheck'])->name('section.deleteCheck');
        Route::get('/section/{section}/add-check', [SectionController::class, 'addCheck'])->name('section.addCheck');

        Route::resource('phrase', PhraseController::class);
        Route::get('/phrase/{section}/create', [PhraseController::class, 'createPhrase'])->name('phrase.create.phrase');
        Route::get('/phrase/{phrase}/delete', [PhraseController::class, 'delete'])->name('phrase.delete');
        Route::get('/phrase/{section}/deleteAll', [PhraseController::class, 'deleteAll'])->name('phrase.deleteAll');
        Route::post('/phrase/changeStatus', [PhraseController::class, 'changeStatus']);
        Route::post('/phrase/change-ajax', [PhraseController::class, 'changePhraseAjax']);
        Route::post('/phrase/change-favorite-ajax', [PhraseController::class, 'changeFavoriteAjax']);
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
        Route::get('/options/index', [OptionsCotnroller::class, 'index'])->name('options');
        Route::get('/options/change-password', [OptionsCotnroller::class, 'changePassword'])->name('options.changePassword');
        Route::put('/update-password', [OptionsCotnroller::class, 'updatePassword'])->name('password.update');
        Route::get('/options/change-name-and-email', [OptionsCotnroller::class, 'changeNameAndEmail'])->name('name.change');
        Route::get('/options/change-email', [OptionsCotnroller::class, 'changeEmail'])->name('email.change');
        Route::put('/update-email', [OptionsCotnroller::class, 'updateEmail'])->name('email.update');
        Route::put('/update-name', [OptionsCotnroller::class, 'updateName'])->name('name.update');

        Route::get('/search/by_word/{language_id}/{word}', [SearchController::class, 'searchByWord'])->name('search.by_word');
        Route::get('/search/by_word', [SearchController::class, 'searchPhrase'])->name('search.by_phrase');

        Route::get('/statistic', [StatisticController::class, 'index'])->name('statistic');
        Route::get('/statistic/diagram/{language_id}/{type}', [StatisticController::class, 'getDiagramType1'])->name('statistic.diagram1');
        Route::get('/statistic/diagram2/{language_id}/{type}', [StatisticController::class, 'getDiagramType2'])->name('statistic.diagram2');
        Route::get('/statistic/diagram-small/{language_id}/{type}/{period}/{startAdd?}', [StatisticController::class, 'getDiagramSmall'])->name('statistic.diagram.small');
        Route::get('/statistic/diagram-time/{language_id}/{period}/{startAdd?}', [StatisticController::class, 'getDiagramTime'])->name('statistic.diagram.time');
        Route::get('/add-words/{language_id}', [StatisticController::class, 'addingWords'])->name('stat.add.words');

        Route::get('/favorite', [FavoriteController::class, 'index'])->name('favorite');
        Route::get('/favorite-language/{language_id}', [FavoriteController::class, 'indexLanguages'])->name('favorite.language');
        Route::get('/favorite/clear/{language_id}', [FavoriteController::class, 'clearFavorite'])->name('favorite.clear');

//    Route::get('/temp', [StatisticController::class, 'temp']);

        Route::middleware('admin')->group(function () {
            Route::get('/admin', [\App\Http\Controllers\Admin\AdminController::class, 'index'])->name('admin');
            Route::get('/admin/user', [\App\Http\Controllers\Admin\UserController::class, 'index'])->name('admin.user');
            Route::get('/admin/user/{user}', [\App\Http\Controllers\Admin\UserController::class, 'view'])->name('admin.user.view');
        });

    });

    Route::get('/home/check-lang/{id}', [App\Http\Controllers\HomeController::class, 'checkLanguage'])->name('home.checkLang');

});



