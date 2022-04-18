<?php

namespace App\Http\Controllers;

use App\Models\Permiso;
use App\Models\Usuario;
use Illuminate\Http\Request;

class UsuariosController extends Controller
{
    public function __construct(){
        // $this->middleware('auth:usuario');
    }

    // public function index(){
    //     return view('layout/master');
    // }

    public function index(){
        // $permisos = Permiso::where('status',1)->get();
        $usuarios = Usuario::where('status',1)->get();
        return view('pages.ejemplos.usuarios',compact('usuarios'));
        // return view('welcome',compact('usuarios'));
    }

    public function create(){
        $datos['permisos'] = Permiso::all();
        return view('usuarios.create',$datos);
    }

    public function store(Request $request){
        $datosUsuario = request()->except('_token');
        Usuario::insert($datosUsuario);
        return response()->json($datosUsuario);
    }

    public function show($id){
        //
    }

    public function edit($id){
        $datos['usuario']=Usuario::findOrFail($id);
        $datos['permisos'] = Permiso::all();
        return view('usuarios.edit',$datos);
    }

    public function update(Request $request, $id){
        $datosUsuario=request()->except('_token','_method');
        Usuario::where('id',$id)->update($datosUsuario);
        $usuarios = Usuario::all();
        return view('welcome',compact('usuarios'));
    }

    public function destroy($id){
        //
    }

   
      public function status($id)
    {
         Usuario::where('id',$id)->update(['status'=>0]);
         $usuario=Usuario::where('id',$id)->get();
        if (!empty($usuario)){
            $success = true;
            $message = "Registo eliminado exitosamente";
        }else{
            $success = true;
            $message = "Rgistro no eliminado";
        }

        return response () -> json([
            'success'=> $success,
            'message'=> $message,
        ]);

    }
}
