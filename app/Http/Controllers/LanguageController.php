<?php

namespace App\Http\Controllers;

use App\Http\Requests\LanguageRequest;
use App\Models\Language;
use App\Models\Options;
use App\Models\Section;
use Illuminate\Http\Request;

class LanguageController extends Controller
{
    public function index()
    {
        $languages = Language::getAll();

        return view('language.index', compact('languages'));
    }


    public function create()
    {
        return view('language.create');
    }


    public function store(LanguageRequest $request)
    {
        $language = new Language($request->all());
        $language->user_id = auth()->id();
        if($language->save()) {
            $options = Options::firstOrNew(['user_id' => auth()->id()]);
            if(!$options->default_language_id) {
                $options->default_language_id = $language->id;
                $options->save();
            }

            return redirect()->route('language.index');
        }

    }


    public function show($id)
    {
        $language = Language::getOne($id);
        $sections = Section::getAllRoot($id);

        return view('language.view', compact('language', 'sections'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        dd(__METHOD__);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        dd(__METHOD__);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        dd(__METHOD__);
    }
}
