<?php

namespace App\Http\Controllers;

use App\Models\phrases\Phrase;
use App\Models\Section;
use Illuminate\Http\Request;

class LearnController extends Controller
{

    public function learn($section_id, $cycles = 1, $complexity = 1)
    {
        $section = Section::getOne($section_id);
        if($complexity == 1) {
            $phrases = Phrase::getPhrasesForSection($section_id, 'asc');
        }

        if($complexity == 2) {
            $phrases = Phrase::getPhrasesForSectionNoEasy($section_id, 'asc');
        }

        if($complexity == 3) {
            $phrases = Phrase::getPhrasesForSectionHard($section_id, 'asc');
        }

        $compl = false;
        if($cycles == 1 && $complexity == 1) {
            $compl = true;
        }


        $arrayAll = [];
        $num = 0;
        for($i = 0; $i < $cycles; $i++)
        {
            $collection = $phrases->shuffle();
            foreach($collection as $coll) {
                $arrayAll[$num] = $coll;
                $num++;
            }
        }

        $array = array_slice($arrayAll, 0, 1000);

        return view('learn.learn', compact('section', 'array', 'compl'));
    }

//---------------------------------ajax---------------------------
    public function checkPhraseAjax(Request $request)
    {
        $phrase = Phrase::getOne($request->id);
        if($phrase->phrase === $request->value) {
            $phrase->count = $phrase->count + 1;
            $phrase->save();
            $response = [
                'success' => true,
                'string' => (string)'<input class="my-input true" type="text" style="width: 100%; border: none" data-id="'. $phrase->id.'" value="'.$request->value.'" data-num="'.$request->key.'">',
            ];
        } else {
            $response = [
                'success' => false,
                'string' => (string)'<input class="my-input false" type="text" style="width: 100%; border: none" data-id="'. $phrase->id.'" value="'.$request->value.'" data-num="'.$request->key.'">',
            ];
        }
        return response()->json($response);
    }


    public function changeComplexity(Request $request)
    {
        $phrase = Phrase::getOne($request->id);
        $phrase->complexity = $request->type;
        $phrase->save();
        return response()->json(true);
    }




}
















