<?php

namespace App\Http\Controllers;

use App\User;

class HomeController extends Controller
{
    public function index () {
        $users = User::all();

        return view('home')->with(compact('users'));
    }
}
