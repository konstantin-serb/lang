<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HelpController extends Controller
{
    public function index()
    {
        return view('help.index');
    }


    public function parts($part)
    {
        $way = "help." . $part;
        return view($way);
    }
}
