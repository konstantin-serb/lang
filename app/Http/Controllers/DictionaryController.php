<?php

namespace App\Http\Controllers;

use App\Models\Dictionary;
use App\Models\Language;
use App\Models\phrases\Phrase;
use App\Models\Section;
use App\Models\Statistics;
use Illuminate\Http\Request;
use function PHPUnit\Framework\isEmpty;

class DictionaryController extends Controller
{
    public static function enterToDictionary()
    {
        $user_id = auth()->id();
        $model = Phrase::getModel();

        $phrases = $model::where('user_id', $user_id)
            ->get();

        foreach ($phrases as $phrase) {
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
//        dump($array);
        foreach ($array as $phr) {
            $word = mb_strtolower($phr);
//            dump($word);
            $lastLitera = mb_substr($word, -1);
            $firstLitera = mb_substr($word, 0, 1);
//            dd($firstLitera);
            if ($lastLitera == '?' || $lastLitera == ',' || $lastLitera == '.' || $lastLitera == ';' || $lastLitera == '!'
                || $lastLitera == ':' || $lastLitera == '!' || $lastLitera == '-' || $lastLitera == ')' || $lastLitera == '('
                || $lastLitera == '/' || $lastLitera == '|') {
                $word = mb_substr($word, 0, -1);
            }

            if ($firstLitera == '(' || $firstLitera == '?' || $firstLitera == ',' || $firstLitera == '.' || $firstLitera == ';' || $firstLitera == '!'
                || $firstLitera == ':' || $firstLitera == '!' || $firstLitera == '-' || $firstLitera == ')' || $firstLitera == '/' || $firstLitera == '|') {
                $word = substr($word, 1);
            }

            if(!empty(trim($word))) {
                $check = Dictionary::where('user_id', '=', $user_id)->
                where('language_id', '=', $language_id)->
                where('word', '=', $word)->first();

                $dictionary = Dictionary::firstOrNew(['user_id' => $user_id, 'language_id' => $language_id, 'word' => $word]);
                if (!$check) {
                    $dictionary->status = 1;

                    //добавляем запись в статистику
                    if(isset($phrase->created_at)) {
                        $date = date('Y-m-d', strtotime($phrase->created_at));
                    } else {
                        $date = date('Y-m-d', time());
                    }

                    $statistic = Statistics::firstOrNew(['user_id' => $user_id, 'language_id' => $language_id, 'date' => $date]);
                    $statistic->words++;
                    $statistic->save();
                }
                $dictionary->save();
            }
        }
        return true;
    }

    public function index($language_id)
    {
//        $string = '  dfvds ';
//        dd(!empty(trim($string)), $string);
        $wordsToday = Dictionary::getWordsToday($language_id);
        $language = Language::getOne($language_id);

        return view('dictionary.index', compact('wordsToday', 'language'));
    }


    public function allDictionary($language_id)
    {
        $dictionary = Dictionary::getAll($language_id);
        $countWordsCheck = Dictionary::getAllForLanguage($language_id);
        $language = Language::getOne($language_id);
        return view('dictionary.all-dictionary', compact('dictionary', 'language', 'countWordsCheck'));
    }


    public function view($word_id)
    {
        $word = Dictionary::getOne($word_id);
        $language = Language::getOne($word->language_id);
        return view('dictionary.view', compact('word', 'language'));
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

        Statistics::minusWordsCalculate($word);

        return redirect()->route('dictionary', ['language_id' => $language_id]);
    }


    public function changeStatus(Request $request)
    {
        $word = Dictionary::getOne($request->id);
        if ($word->status == 1) {
            $word->status = 0;
            Statistics::minusWordsCalculate($word);
        } elseif ($word->status == 0) {
            $word->status = 1;
            Statistics::plusWordsCalculate($word);
        }

        $word->save();



        return $word->status;
    }


}
















