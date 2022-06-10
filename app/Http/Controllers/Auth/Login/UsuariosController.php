<?php

namespace App\Http\Controllers\Auth\Login;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\LoginController as DefaultLoginController;

class UsuariosController extends DefaultLoginController
{
    protected $redirectTo = '/usuario/home';
    public function __construct()
    {
        $this->middleware('guest:usuario')->except('logout');
    }
    public function showLoginForm()
    {
        return view('pages.ejemplos.login');
    }
    public function username()
    {
        return 'email';
    }
    protected function guard()
    {
        return Auth::guard('usuario');
    }
}
