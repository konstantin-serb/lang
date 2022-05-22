<?php

namespace App\Http\Controllers;

use App\Models\Language;
use App\Models\Options;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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

        if($validated['page'] == 'options') {
            return redirect()->route('options');
        }

    }


    public function index()
    {
        $languages = Language::getAll();
        $languageDefault = Options::getDefaultLanguage();

        return view('options.index', compact('languages', 'languageDefault'));
    }


    public function changePassword()
    {
        return view('options.change-password');
    }


    public function updatePassword(Request $request)
    {
        $user = User::getOne(auth()->id());
        $request->validate( [
            'passwordOld' => 'required|min:3|max:20',
            'password' => 'required|min:3|max:20|confirmed'
        ] );

        if( ! Hash::check( $request->passwordOld, $user->password ) ) {
            return back()
                ->with('passwordOld', 'Старый пароль введен не правильно!');
        }

        $user->update([
            'password' => Hash::make($request->password)
        ]);

        return redirect()->route('options.changePassword')
            ->with('messageSuccess', __('messages.options.pass_changed') );
    }


    public function changeNameAndEmail()
    {
        $user = User::getOne(auth()->id());
        return view('options.change-name', compact('user'));
    }


    public function updateName(Request $request)
    {
        $user = User::getOne(auth()->id());
        $request->validate([
            'name' => 'required|string|max:20',
        ]);

        $user->update([
            'name' => $request->name,
        ]);

        return redirect()->route('options')
            ->with('messageSuccess', __('messages.options.name_changed') );
    }


    public function changeEmail()
    {
        $user = User::getOne(auth()->id());
        return view('options.change-email', compact('user'));
    }


    public function updateEmail(Request $request)
    {
        $user = User::getOne(auth()->id());
        $request->validate([
            'email' => 'required|string|email|max:255|unique:users',
        ]);

        $user->update([
            'email' => $request->email,
        ]);

        return redirect()->route('options')
            ->with('messageSuccessEmail', __('messages.options.email_changed') );
    }
}
