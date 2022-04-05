<?php

namespace App\Http\Controllers;

use App\Models\Dictionary;
use App\Models\Language;
use App\Models\Options;
use App\Models\phrases\Phrase;
use App\Models\Section;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function index()
    {
        $options = Options::firstOrCreate(['user_id' => auth()->id()]);
        $sectionsLear = null;
        $sectionsRead = null;
        $phrases = null;
        if($options->last_sections_learn) {
            $sectionsLear = Section::getSections($options->last_sections_learn);
        }

        if($options->last_sections_read) {
            $sectionsRead = Section::getSections($options->last_sections_read);
        }

        if($options->phrases){
            $phrases = Phrase::getPhrasesForHomePage($options->phrases);
        }

        $languageDefault = Options::getDefaultLanguage();
        $languages = Language::getAll();

        return view('home', compact('languages', 'languageDefault', 'options', 'sectionsLear', 'sectionsRead', 'phrases'));
    }


    public function startPage()
    {
        $color = sprintf('#%02X%02X%02X', rand(0, 255), rand(0, 255), rand(0, 255));

        return view('home.start-page', compact('color'));
    }
}




















