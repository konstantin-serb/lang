<?php

namespace App\Http\Controllers;

use App\Http\Requests\SectionAddRequest;
use App\Http\Requests\SectionEditRequest;
use App\Models\Language;
use App\Models\Section;
use Illuminate\Http\Request;

class SectionController extends Controller
{

    public function index()
    {
        dd(__METHOD__);
    }


    public function createSection($section, Language $language)
    {
        $parent_id = $section;
        return view('section.create', compact('language', 'parent_id'));
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
        return view('section.view', compact('section'));
    }


    public function edit($id)
    {
        $section = Section::getOne($id);

        return view('section.edit', compact('section'));
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
        dd(__METHOD__);
        $section = Section::getOne($id);

        return view('section.delete', compact('section'));
    }


    public function destroy($id)
    {
        dd(__METHOD__);
    }
}
