<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Language;
use App\Models\Statistics;
use App\Models\Time;
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
        $latsVisit = Time::getLastVisit($user->id);
        $allUserTime = Time::getHMS(Time::allTimeOnSite($id));
        $languages = Language::getAllByUser($id);

        return view('admin.users.view', compact('user', 'latsVisit', 'allUserTime', 'languages'));
    }
}
