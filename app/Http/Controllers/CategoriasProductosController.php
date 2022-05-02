<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Categorias;

class CategoriasProductosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $datos['categorias']=Categorias::where('status',1)->get(); 
         return view('pages.categorias.index',compact('datos'));
      
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
  public function store(Request $request)
 
    {

          // Obtengo el ID del usuario si es que se está editando
      $CategoriaID = $request->id;
        // // Hago uso del método updateOrCreate
      $categoria = Categorias::updateOrCreate(
        //     // Si hay un id, lo igualo con el que traigo en el request y Laravel interpreta que será un update
          ['id' => $CategoriaID],
        //     // Mando todos los datos que se van a actualizar/insertar en la BD
          ['descripcion' => $request->descripcion]);
        // //Finalmente, vuelvo a traer el usuario que edité
      $data['categoria']=Categorias::where('id',$CategoriaID)->get();
        // // Y vuelvo a mandar todo en formato json
      return response()->json($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // //
         $datos['categoria']=Categorias::findOrFail($id);
         return response()->json($datos);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function status($id)
    {
         Categorias::where('id',$id)->update(['status'=>0]);
         $Categorias=Categorias::where('id',$id)->get();
        if (!empty($Categorias)){
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
    

