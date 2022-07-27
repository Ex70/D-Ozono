<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Redirect,Response;

class ReceiptController extends Controller {
    public function index(){
        $data['orders'] = DB::table('catalogo_productos')->get();
        return view("bill",$data);
    }

    public function getPrice(){
        $getPrice = $_GET['id'];
        $price  = DB::table('catalogo_productos')->where('id', $getPrice)->get();
        return Response::json($price);
    }
}
