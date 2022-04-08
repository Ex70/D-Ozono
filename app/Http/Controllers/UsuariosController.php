<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UsuariosController extends Controller
{
    public function __construct(){
        $this->middleware('auth:usuario');
    }

    public function index(){
        return view('layout/master');
    }
}
