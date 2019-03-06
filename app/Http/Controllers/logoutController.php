<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class logoutController extends Controller
{
    public function doLogout(Request $request) {
        Auth::logout();
        return redirect('/');
    }
}
