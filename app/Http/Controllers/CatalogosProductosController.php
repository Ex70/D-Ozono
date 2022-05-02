<?php

namespace App\Http\Controllers;

use App\Models\Catalogo;
use App\Models\Categorias;
use Illuminate\Http\Request;

class CatalogosProductosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
         $datos['catalogos'] = Catalogo::where('status',1)->with('categorias')->get();
         $datos['categorias']= Categorias::all();
       return view('pages.catalogos.index',compact('datos'));
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
        //
        $catalogoID = $request->id;
        $catalogo=Catalogo::updateOrcreate(
            ['id'=>$catalogoID],
            ['id_categoria_producto'=>$request->id_categoria_producto,'descripcion'=>$request->descripcion,'clave'=>$request->clave,'precio_unitario'=>$request->precio_unitario,'garantia'=>$request->garantia]);
        $data['catalogo']=Catalogo::where('id',$catalogoID)->with('categorias')->get();
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
        //
        $datos['catalogo']= Catalogo::findOrfail($id);
        $datos['categorias']= Categorias::all();
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
         Catalogo::where('id',$id)->update(['status'=>0]);
         $Catalogo=Catalogo::where('id',$id)->get();
        if (!empty($Catalogo)){
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
