<?php

namespace App\Http\Controllers;

use App\Http\Requests\LearnCommutatorRequest;
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

        if($task == 1) {
            return view('learn.learn', compact('section', 'array', 'compl'));
        } else {
            return view('learn.read', compact('section', 'array', 'compl'));
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

//---------------------------------ajax---------------------------
    public function checkPhraseAjax(Request $request)
    {
        $phrase = Phrase::getOne($request->id);
        if ($phrase->phrase === $request->value) {
            $phrase->count = $phrase->count + 1;
            $statistics = Statistics::firstOrNew(['user_id' => auth()->id(), 'date' => date('Y-m-d')]);
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

        $statistics = Statistics::firstOrNew(['user_id' => auth()->id(), 'date' => date('Y-m-d')]);
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
















