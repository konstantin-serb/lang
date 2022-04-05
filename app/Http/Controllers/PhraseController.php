<?php

namespace App\Http\Controllers;

use App\Http\Requests\PhraseAddRequest;
use App\Http\Requests\PhraseUpdateRequest;
use App\Models\Dictionary;
use App\Models\Options;
use App\Models\phrases\Phrase;
use App\Models\Section;
use App\Models\Statistics;
use Illuminate\Http\Request;

class PhraseController extends Controller
{
    public function createPhrase($section_id)
    {
        $section = Section::getOne($section_id);
        $phrases = Phrase::getPhrasesForSection($section_id);

        return view('phrases.create', compact('section', 'phrases'));
    }


    public function store(PhraseAddRequest $request)
    {
        $model = Phrase::getModel();
        $model->fill($request->all());
        $model->user_id = auth()->id();
        $model->status = 1;
        $section = Section::where('id', $model->section_id)->first();
        $model->language_id = $section->language_id;
        if($model->save()){

            $statistics = Statistics::firstOrNew(['user_id' => auth()->id(),
                'language_id' => $section->language_id,
                'date' => date('Y-m-d')]);
            $statistics->created = $statistics->created + 1;
            $statistics->save();
            DictionaryController::addPhrase($model->phrase, $request->section_id);
            return redirect()->route('phrase.create.phrase', ['section' => $request->section_id]);
        }

    }



    public function edit($id)
    {
        $phrase = Phrase::getOne($id);
        $language_id = $phrase->language_id;
        return view('phrases.edit', compact('phrase', 'language_id'));
    }


    public function update(PhraseUpdateRequest $request, $id)
    {
        $phrase = Phrase::getOne($id);
        $phrase->fill($request->all());
        $phrase->save();

        DictionaryController::addPhrase($phrase->phrase, $phrase->section_id);
        return redirect()->route('phrase.create.phrase', ['section' => $phrase->section_id]);
    }


    public function delete($id)
    {
        $phrase = Phrase::getOne($id);
        return view('phrases.delete', compact('phrase'));
    }


    public function destroy($id)
    {
        $phrase = Phrase::getOne($id);

        // Запись в статистику
        $statistics = Statistics::firstOrNew(['user_id' => auth()->id(),
            'language_id' => $phrase->language_id,
            'date' => date('Y-m-d', strtotime($phrase->created_at))]);
        $statistics->created = $statistics->created - 1;
        $statistics->save();

        //Удаление фразы
        $phrase->delete();

        return redirect()->route('phrase.create.phrase', ['section' => $phrase->section_id]);
    }


    public function deleteAll($section_id)
    {
        $section = Section::getOne($section_id);

        return view('phrases.deleteAll', compact('section'));
    }


    public function destroyAll($section_id)
    {
        $phrases = Phrase::getPhrasesForSection($section_id);
        foreach($phrases as $phrase)
        {
            $statistics = Statistics::firstOrNew(['user_id' => auth()->id(),
                'language_id' => $phrase->language_id,
                'date' => date('Y-m-d', strtotime($phrase->created_at))]);
            $statistics->created = $statistics->created - 1;
            $statistics->save();

            $phrase->delete();
        }
        return redirect()->route('phrase.create.phrase', ['section' => $section_id]);
    }
}
