<?php

namespace App\Http\Controllers;

use App\Models\Dictionary;
use App\Models\Language;
use App\Models\Options;
use App\Models\phrases\Phrase;
use App\Models\Section;
use App\Models\Statistics;
use App\Models\Time;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class HomeController extends Controller
{

    public function index()
    {
        $options = Options::firstOrCreate(['user_id' => auth()->id()]);
        $statistics = Statistics::getStatisticToday();

        $sectionsLear = null;
        $sectionsRead = null;
        $sectionsAdd = null;
        $phrases = null;
        if($options->last_sections_learn) {
            $sectionsLear = Section::getSections($options->last_sections_learn);
        }

        if($options->last_sections_read) {
            $sectionsRead = Section::getSections($options->last_sections_read);
        }

        if($options->last_section_add) {
            $sectionsAdd = Section::getSections($options->last_section_add);
        }

        if($options->phrases){
            $phrases = Phrase::getPhrasesForHomePage($options->phrases);
        }

        $languageDefault = Options::getDefaultLanguage();
        $languages = Language::getAll();

        return view('home', compact('languages',
            'languageDefault', 'options', 'sectionsLear', 'sectionsRead', 'sectionsAdd', 'phrases', 'statistics'));
    }


    public function startPage()
    {
        $color = sprintf('#%02X%02X%02X', rand(0, 255), rand(0, 255), rand(0, 255));

        return view('home.start-page', compact('color'));
    }


    public function checkLanguage($id)
    {
        if(auth()->id()) {
            $options = Options::firstOrCreate(['user_id' => auth()->id()]);
            $options->lang = $id;
            $options->save();
        }

        session(['locale' => $id]);
        App::setLocale($id);
        $currentLocale = App::getLocale();
//        dd(session('locale'), $currentLocale);
        return redirect()->back();
    }
}




















