<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserAuthController extends Controller
{
    public function index()
    {
        return view('pages.cotizaciones.seleccion');
    }

    public function login()
    {
        return view('pages.ejemplos.login');
    }

    public function handleLogin(Request $req)
    {
        // dd($req->all());
        if(Auth::attempt($req->only(['email', 'password'])))
        {
            return redirect()->route('user.home');
        }

        return redirect()->back()->with('error', 'Invalid Credentials');
    }

    public function logout()
    {
        Auth::logout();

        return redirect()
            ->route('user.login');
    }

}