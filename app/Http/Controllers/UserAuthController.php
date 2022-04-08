<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserAuthController extends Controller
{
    public function index(){
        return view('user.home');
    }

    public function login(){
        return view('pages.ejemplos.login');
    }

    public function handleLogin(Request $req){
        if(Auth::attempt(
            $req->only(['usuario', 'password'])
        ))
        {
            return redirect()->intended('/');
        }

        return redirect()
            ->back()
            ->with('error', 'Invalid Credentials');
    }

    public function logout()
    {
        Auth::logout();

        return redirect()
            ->route('pages.ejemplos.login');
    }
}
