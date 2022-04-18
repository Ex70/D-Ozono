<?php

namespace App\Http\Controllers;

use App\Models\Permiso;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Symfony\Component\HttpFoundation\Response;

class UsuariosController extends Controller
{
    public function __construct(){
        // $this->middleware('auth:usuario');
    }

    // public function index(){
    //     return view('layout/master');
    // }

    public function index(){
        $datos['usuarios'] = Usuario::where('status',1)->with('permisos')->get();
        $datos['permisos'] = Permiso::all();
        return view('pages.ejemplos.usuarios',compact('datos'));
    }

    public function create(){
        //
    }

    public function store(Request $request){
        // Obtengo el ID del usuario si es que se está editando
        $usuarioID = $request->id;
        // Hago uso del método updateOrCreate
        $usuario = Usuario::updateOrCreate(
            // Si hay un id, lo igualo con el que traigo en el request y Laravel interpreta que será un update
            ['id' => $usuarioID],
            // Mando todos los datos que se van a actualizar/insertar en la BD
            ['nombre' => $request->nombre, 'correo' => $request->correo, 'usuario' => $request->usuario, 'password' => $request->password, 'id_permiso' => $request->id_permiso]);
        //Finalmente, vuelvo a traer el usuario que edité
        $data['usuario']=Usuario::where('id',$usuarioID)->with('permisos')->get();
        // Y vuelvo a mandar todo en formato json
        return response()->json($data);
    }

    public function show($id){
        //
    }

    public function edit($id){
        // Busco al usuario que se va a editar
        $datos['usuario']=Usuario::findOrFail($id);
        // Y mando todos los permisos para cargar el select del formulario
        $datos['permisos'] = Permiso::all();
        // Devuelvo el resultado en formato JSON para que lo pueda leer el método AJAX
        return response()->json($datos);
    }

    public function update(Request $request, $id){
        //
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
