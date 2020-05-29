<?php

namespace App\Http\Controllers;

use App\User;

class HomeController extends Controller
{
    public function index () {
        $users = User::whereNotIn('id', [ auth()->id() ])->get();

        return view('home')->with(compact('users'));
    }
}
