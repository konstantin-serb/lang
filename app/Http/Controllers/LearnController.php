<?php

namespace App\Http\Controllers;

use App\Http\Requests\LearnCommutatorRequest;
use App\Models\Language;
use App\Models\Options;
use App\Models\phrases\Phrase;
use App\Models\Section;
use App\Models\Statistics;
use Illuminate\Http\Request;

class LearnController extends Controller
{

    public function learn($string, $sections = null)
    {
        $options = explode(',', $string);
        if ($sections) {
            $sections_id = explode(',', $sections);
        } else {
            $sections_id = $options[0];
        }
        $section = Section::getOne($options[0]);
        $cycles = $options[1];
        $complexity = $options[2];
        $sort = $options[3];
        $limit = $options[4];
        $task = $options[5];

        $phrases = Phrase::getPhrases($sections_id, $complexity);

        $compl = false;
        if ($cycles == 1) {
            $compl = true;
        }

        $arrayAll = [];
        $num = 0;
        for ($i = 0; $i < $cycles; $i++) {
            if ($sort == 'mix') {
                $collection = $phrases->shuffle();
            } elseif ($sort == 'in_order') {
                $collection = $phrases;
            }

            foreach ($collection as $coll) {
                $arrayAll[$num] = $coll;
                $num++;
            }
        }

        $array = array_slice($arrayAll, 0, $limit);
        $array = collect($array);

        if ($sort == 'mix') {
            $array = $array->shuffle();
        }

        Options::setLearnHistory($sections_id, $task);


        if ($task == 1) {
            return view('learn.learn', compact('section', 'array', 'compl'));
        } else {
            return view('learn.read', compact('section', 'array', 'compl'));
        }

    }


    public function learnMix($word, $conditions, $ids)
    {
        $options = explode(',', $conditions);

        $cycles = $options[0];
        $complexity = $options[1];
        $sort = $options[2];
        $limit = $options[4];
        $task = $options[3];

        $ids = mb_substr($ids, 0, -1, 'UTF-8');
        $ids = explode(',', $ids);

        $phrases = Phrase::getPhrasesMix($ids);

        $phrasesAll = [];

        if ($complexity == 1) {
            $phrasesAll = $phrases;
        }

        if ($complexity == 2) {
            $i = 0;
            foreach ($phrases as $phrase) {
                if ($phrase->complexity == 1) {
                    $phrasesAll[$i] = $phrase;
                    $i++;
                }
            }
        }

        if ($complexity == 3) {
            $i = 0;
            foreach ($phrases as $phrase) {
                if ($phrase->complexity == 2) {
                    $phrasesAll[$i] = $phrase;
                    $i++;
                }
            }
        }

        if ($complexity == 4) {
            $i = 0;
            foreach ($phrases as $phrase) {
                if ($phrase->complexity == 3) {
                    $phrasesAll[$i] = $phrase;
                    $i++;
                }
            }
        }

        if ($complexity == 5) {
            $i = 0;
            foreach ($phrases as $phrase) {
                if ($phrase->complexity == 3 || $phrase->complexity == 2) {
                    $phrasesAll[$i] = $phrase;
                    $i++;
                }
            }
        }

        $collect = collect($phrasesAll);

        $arrayAll = [];
        $num = 0;
        for ($i = 0; $i < $cycles; $i++) {
            if ($sort == 2) {
                $collection = $collect->shuffle();
            } elseif ($sort == 1) {
                $collection = $collect;
            }

            foreach ($collection as $coll) {
                $arrayAll[$num] = $coll;
                $num++;
            }
        }

        $array = array_slice($arrayAll, 0, $limit);

        $endCollection = collect($array);

        $language = Language::getOne($phrases[0]->language_id);

        $compl = false;
        if ($cycles == 1) {
            $compl = true;
        }


        if ($task == 1) {
            return view('learn.learn-mix', compact('endCollection', 'language', 'compl', 'word'));
        } else {
            return view('learn.read-mix', compact('endCollection', 'language', 'compl', 'word'));
        }

    }


    public function learnMixTrain($conditions, $ids)
    {
        $options = explode(',', $conditions);
        $cycles = $options[0];
        $task = $options[1];
        $limit = $options[2];

        $ids = mb_substr($ids, 0, -1, 'UTF-8');
        $ids = explode(',', $ids);

        $phrases = Phrase::getPhrasesMix($ids);
        $phrasesAll = $phrases;

        $collect = collect($phrasesAll);

        $arrayAll = [];
        $num = 0;
        for ($i = 0; $i < $cycles; $i++) {
            $collection = $collect->shuffle();
            foreach ($collection as $coll) {
                $arrayAll[$num] = $coll;
                $num++;
            }
        }
        $array = array_slice($arrayAll, 0, $limit);
        $endCollection = collect($array);
        $endCollection = $endCollection->shuffle();
        $language = Language::getOne($phrases[0]->language_id);

        $compl = false;
        if ($cycles == 1) {
            $compl = true;
        }

        if ($task == 1) {
            return view('learn.train-mix', compact('endCollection', 'language', 'compl'));
        } else {
            return view('learn.train-read', compact('endCollection', 'language', 'compl'));
        }

    }


    public function getNullable($section_id)
    {
        $section = Section::getOne($section_id);
        $language_id = $section->language_id;

        $limit = 200;
        $cycles = 1;
        $compl = true;
        $phrases = Phrase::getNullable();

        $arrayAll = [];
        $num = 0;
        for ($i = 0; $i < $cycles; $i++) {

            $collection = $phrases->shuffle();

            foreach ($collection as $coll) {
                if ($coll->section->language_id == $language_id) {
                    $arrayAll[$num] = $coll;
                    $num++;
                }
            }
        }

        $array = array_slice($arrayAll, 0, $limit);
        return view('learn.learn', compact('section', 'array', 'compl'));
    }


    public function learnCommutator(LearnCommutatorRequest $request)
    {
        if (isset($request->sections)) {
            $sections = implode(',', $request->sections);
        } else {
            $sections = null;
        }

        if ($request->sort == 1) {
            $sort = 'in_order';
        } else {
            $sort = 'mix';
        }

        $options = [
            'section' => $request->section,
            'cycles' => $request->cycles,
            'complexity' => $request->complexity,
            'sort' => $sort,
            'limit' => $request->limit,
            'task' => $request->task,
        ];
        $string = implode(',', $options);

        return redirect()->route('learn', ['string' => $string, 'sections' => $sections]);
    }


    public function trainIndex()
    {
        $languageDefault = Options::getDefaultLanguage();
        $languages = Language::getAll();
        $statistics = Statistics::getStatisticToday();

        return view('learn.train-index', compact('languageDefault', 'languages', 'statistics'));
    }


    public function searchPhrases(Request $request)
    {
        $task = $request->task;
        $phrases = Phrase::getPhrasesForSearch($request->all());
        $language = Language::getOne($request->language_id);

        return view('learn.search', compact('phrases', 'task', 'language'));
    }

//---------------------------------ajax---------------------------
    public function checkPhraseAjax(Request $request)
    {
        $phrase = Phrase::getOne($request->id);
        if ($phrase->phrase === $request->value) {
            $phrase->count = $phrase->count + 1;
            $statistics = Statistics::firstOrNew(['user_id' => auth()->id(),
                'language_id' => $phrase->language_id,
                'date' => date('Y-m-d')]);
            $statistics->repeated = $statistics->repeated + 1;
            $statistics->save();
            $phrase->save();
            $response = [
                'success' => true,
                'string' => (string)'<input class="my-input true" type="text" style="width: 100%; border: none" data-id="' . $phrase->id . '" value="' . $request->value . '" data-num="' . $request->key . '">',
            ];
        } else {
            $response = [
                'success' => false,
                'string' => (string)'<input class="my-input false" type="text" style="width: 100%; border: none" data-id="' . $phrase->id . '" value="' . $request->value . '" data-num="' . $request->key . '">',
            ];
        }
        return response()->json($response);
    }


    public function readPhraseAjax(Request $request)
    {
        $phrase = Phrase::getOne($request->id);
        $phrase->reading++;
        $phrase->save();

        $statistics = Statistics::firstOrNew(['user_id' => auth()->id(),
            'language_id' => $phrase->language_id,
            'date' => date('Y-m-d')]);
        $statistics->readed++;
        $statistics->save();
    }


    public function changeComplexity(Request $request)
    {
        $phrase = Phrase::getOne($request->id);
        $phrase->complexity = $request->type;
        $phrase->save();
        return response()->json(true);
    }


}
















