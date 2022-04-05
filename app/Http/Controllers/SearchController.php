<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchRequest;
use App\Models\Language;
use App\Models\Section;
use Illuminate\Http\Request;
use App\Models\phrases\Phrase;

class SearchController extends Controller
{
    public function searchByWord($language_id, $word)
    {
        $model = Phrase::getModel();
        $phrases = $model->where('language_id', '=', $language_id)
            ->where('phrase', 'LIKE', "%$word%")
            ->orderBy('phrase')
            ->limit(500)
            ->get();

        $language = Language::getOne($language_id);
        return view('search.by_word', compact('phrases', 'language', 'word'));
    }

    public function searchPhrase(Request $request)
    {
        $validated = $request->validate([
            'word' => 'required|min:3|max:30|string',
            'language_id' => 'required|integer'
        ]);

        $language_id = $validated['language_id'];
        $word = $validated['word'];

        $model = Phrase::getModel();
        $phrases = $model->where('language_id', '=', $language_id)
            ->where('phrase', 'LIKE', "%$word%")
            ->orderBy('phrase')
            ->limit(500)
            ->get();

        $language = Language::getOne($language_id);
        return view('search.by_word', compact('phrases', 'language', 'word'));
    }
}
