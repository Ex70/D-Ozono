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
  public function store(Request $request){
      $CategoriaID = $request->id;
      $categoria = Categorias::updateOrCreate(
          ['id' => $CategoriaID],
          ['descripcion' => $request->descripcion]);
      $CategoriaID = $categoria->id;
      $data=Categorias::where('id',$CategoriaID)->get();
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
    

