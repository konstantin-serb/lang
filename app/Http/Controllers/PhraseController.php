<?php

namespace App\Http\Controllers;

use App\Http\Requests\PhraseAddRequest;
use App\Models\phrases\Phrase;
use App\Models\Section;
use Illuminate\Http\Request;

class PhraseController extends Controller
{

    public function index()
    {
        dd(__METHOD__);
    }


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
        if($model->save())
        {
            return redirect()->route('phrase.create.phrase', ['section' => $request->section_id]);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        dd(__METHOD__);
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
