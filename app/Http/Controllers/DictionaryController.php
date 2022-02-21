<?php

namespace App\Http\Controllers;

use App\Models\Dictionary;
use App\Models\Language;
use App\Models\phrases\Phrase;
use App\Models\Section;
use Illuminate\Http\Request;

class DictionaryController extends Controller
{
    public static function enterToDictionary()
    {
        $user_id = auth()->id();
        $model = Phrase::getModel();

        $phrases = $model::where('user_id', $user_id)
            ->get();

        foreach($phrases as $phrase) {
            $language_id = $phrase->section->language_id;
            $result = self::addWords($phrase->phrase, $user_id, $language_id);
        }

        return 'yes';
    }


    public static function addPhrase($phrase, $section_id)
    {
        $section = Section::getOne($section_id);
        $language_id = $section->language_id;
        $user_id = auth()->id();
        self::addWords($phrase, $user_id, $language_id);
        return true;
    }


    private function addWords($phrase, $user_id, $language_id)
    {

        $array = explode(' ', $phrase);
        foreach($array as $phr) {
            $word = mb_strtolower($phr);
            $lastLitera = mb_substr($word, -1);
            $firstLitera = $word[0];
            if($lastLitera == '?' || $lastLitera == ',' || $lastLitera == '.' || $lastLitera == ';' || $lastLitera == '!'
                || $lastLitera == ':' || $lastLitera == '!' || $lastLitera == '-' || $lastLitera == ')' || $lastLitera == '('
                || $lastLitera == '/' || $lastLitera == '|') {
                $word = mb_substr($word, 0, -1);
            }

            if($firstLitera == '(' || $firstLitera == '?' || $firstLitera == ',' || $firstLitera == '.' || $firstLitera == ';' || $firstLitera == '!'
                || $firstLitera == ':' || $firstLitera == '!' || $firstLitera == '-' || $firstLitera == ')' || $firstLitera == '/' || $firstLitera == '|') {
                $word = substr($word, 1);
            }

            $check = Dictionary::where('user_id', '=', $user_id)->
                where('language_id', '=', $language_id)->
                where('word', '=', $word)->first();
            $dictionary = Dictionary::firstOrNew(['user_id' => $user_id, 'language_id' => $language_id, 'word' => $word]);
            if(!$check) {
                $dictionary->status = 1;
            }

            $dictionary->save();
        }
        return true;
    }

    public function index($language_id)
    {
        $wordsToday = Dictionary::getWordsToday($language_id);
        $language = Language::getOne($language_id);

        return view('dictionary.index', compact('wordsToday', 'language'));
    }


    public function allDictionary($language_id)
    {
        $dictionary = Dictionary::getAll();
        $countWordsCheck = Dictionary::getAllForLanguage($language_id);
        $language = Language::getOne($language_id);
        return view('dictionary.all-dictionary', compact('dictionary', 'language', 'countWordsCheck'));
    }


    public function view($word_id)
    {
        $word = Dictionary::getOne($word_id);

        return view('dictionary.view', compact('word'));
    }


    public function delete($id)
    {
        $word = Dictionary::getOne($id);

        return view('dictionary.delete', compact('word'));
    }


    public function destroy(Request $request)
    {
        $word = Dictionary::getOne($request->id);
        $language_id = $word->language_id;
        $word->delete();
        return redirect()->route('dictionary', ['language_id' => $language_id]);
    }


    public function changeStatus(Request $request)
    {
        $word = Dictionary::getOne($request->id);
        if($word->status == 1) {
            $word->status = 0;
        }

        elseif($word->status == 0) {
            $word->status = 1;
        }

        $word->save();
        return $word->status;
    }


}
















