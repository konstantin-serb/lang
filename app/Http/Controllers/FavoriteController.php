<?php

namespace App\Http\Controllers;

use App\Models\Language;
use App\Models\Options;
use App\Models\phrases\Phrase;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    public function index()
    {
        $languageDefault = Options::getDefaultLanguage();

        $phrases = Phrase::getFavorite($languageDefault->id);
        $language = Language::getOne($languageDefault->id);

        return view('favorite.index', compact('phrases','language'));
    }


    public function clearFavorite($language_id)
    {
        $result = Phrase::clearFavorite($language_id);
        return redirect()->route('favorite');
    }
}
