<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        // $users = User::paginate(20);
        $users = User::with('roles')->get();
        return view('dashboard')->with('users', $users);
    }
}
