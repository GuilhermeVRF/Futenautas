<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class LoginController extends Controller
{
    public function index(){
        return view('user.login');
    }

    public function authenticate(Request $request) : RedirectResponse{
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if(Auth::guard('admins')->attempt($credentials)){
            $request->session()->regenerate();

            return Redirect::route('admin-menu');
        }

        if(Auth::attempt($credentials)){
            $request->session()->regenerate();

            return Redirect::route('user.menu');
        }

        return back()->withErrors([
            'email' => 'O e-mail informado não está cadastrado!',
        ])->onlyInput('email');
    }
}
