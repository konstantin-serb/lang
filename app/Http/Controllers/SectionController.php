<?php

namespace App\Http\Controllers;

use App\Http\Requests\SectionAddRequest;
use App\Http\Requests\SectionEditRequest;
use App\Models\Language;
use App\Models\phrases\Phrase;
use App\Models\Section;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    public function createSection($section, Language $language)
    {
        $currentSection = Section::getOne($section);
        $parent_id = $section;
        return view('section.create', compact('language', 'parent_id', 'currentSection'));
    }


    public function store(SectionAddRequest $request)
    {
        $section = new Section($request->all());
        $section->user_id = auth()->id();
        if($request->parent_id == 0) {
            $section->parent_id = null;
        }
        $section->save();
        if(!$request->parent_id) {
            return redirect()->route('language.show', ['language' => $request->language_id]);
        } else {
            return redirect()->route('section.show', ['section' => $request->parent_id]);
        }
    }


    public function show($id)
    {
        $section = Section::getOne($id);
        $phrases = Phrase::getPhrasesForSectionSingle($section->id, 'asc');
        $phrased = $phrases->sortBy('id');
        return view('section.view', compact('section', 'phrases'));
    }


    public function edit($id)
    {
        $section = Section::getOne($id);
        $allSections = Section::getAllRoot($section->language_id);

        return view('section.edit', compact('section', 'allSections'));
    }


    public function update(SectionEditRequest $request, $id)
    {
        $section = Section::getOne($id);
        $section->fill($request->all());

        $section->save();
        return redirect()->route('section.show', ['section' => $section->id]);
    }


    public function delete($id)
    {
        $section = Section::getOne($id);

        return view('section.delete', compact('section'));
    }


    public function deleteCheck($section_id)
    {
        $model = Phrase::getModel();
        $phrases = $model->where('user_id', auth()->id())
            ->where('section_id', '=', $section_id)
            ->get();
        if(!$phrases->isEmpty()) {
            foreach($phrases as $phrase):
                $phrase->status = 0;
                $phrase->save();
            endforeach;
        }
        return redirect()->route('section.show', ['section' => $section_id]);
    }


    public function addCheck($section_id)
    {
        $model = Phrase::getModel();
        $phrases = $model->where('user_id', auth()->id())
            ->where('section_id', '=', $section_id)
            ->get();
        if(!$phrases->isEmpty()) {
            foreach($phrases as $phrase):
                $phrase->status = 1;
                $phrase->save();
            endforeach;
        }
        return redirect()->route('section.show', ['section' => $section_id]);
    }


    public function destroy($id)
    {
        dd(__METHOD__);
    }
}
