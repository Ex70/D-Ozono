<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UsuariosHomeController extends Controller
{
    public function __construct(){
        $this->middleware('auth:usuario');
    }

    public function index(){
        return view('pages.pruebas.crud-form');
    }
}
