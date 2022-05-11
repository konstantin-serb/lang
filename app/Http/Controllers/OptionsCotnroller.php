<?php

namespace App\Http\Controllers;

use App\Models\Language;
use App\Models\Options;
use Illuminate\Http\Request;

class OptionsCotnroller extends Controller
{
    public function changeDefaultLanguage(Request $request)
    {
        $validated = $request->validate([
            'language_id' => 'required|integer',
            'page' => 'required|string',
        ]);
        $options = Options::getOptions();
        $options->default_language_id = $validated['language_id'];

        $options->save();

        if($validated['page'] == 'home') {
            return redirect()->route('home');
        }

        if($validated['page'] == 'favorite') {
            return redirect()->route('favorite');
        }

    }
}
