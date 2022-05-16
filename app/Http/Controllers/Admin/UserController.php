<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::getAll();
        return view('admin.users.index', compact('users'));
    }


    public function view($id)
    {
        $user = User::getOne($id);

        return view('admin.users.view', compact('user'));
    }
}
