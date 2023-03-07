<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function userlist()
    {
        $users = User::role('USER')->paginate(10);
        return Inertia::render('Admin/user/List',['users'=>$users]);
    }
}
