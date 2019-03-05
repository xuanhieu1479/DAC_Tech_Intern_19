<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class loginController extends Controller
{
    public function showLogin() {
        return view('login');
    }

    public function doLogin(Request $request) {
        return view('home', ['user_name' => $request->input('user_name')]);
    }
}
