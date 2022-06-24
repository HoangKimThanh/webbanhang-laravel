<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login()
    {
        return view('pages.login');
    }

    public function auth(Request $request)
    {
        $credentials = $request->only(['email', 'password']);

        if (Auth::guard('web')->attempt($credentials)) {
            return view('pages.user.profile');
        } else {
            return redirect()->back()->withInput();
        }
    }
}
