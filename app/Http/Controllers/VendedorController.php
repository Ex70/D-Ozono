<?php

namespace App\Http\Controllers;

use App\Models\Vendedor;
use Illuminate\Http\Request;

class VendedorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $vendedores = Vendedor::where('status',1)->get();
        return view('pages.vendedores.index',compact('vendedores'));
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
        $vendedorID = $request->id;
        $vendedor = Vendedor::updateOrCreate(
            ['id' => $vendedorID],
            ['nombre' => $request->nombre,
            'telefono' => $request->telefono,
            'correo' => $request->correo]);
        $vendedorID = $vendedor->id;
        $data=Vendedor::where('id',$vendedorID)->get();
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
    public function edit($id){
        $datos['vendedor']=Vendedor::findOrFail($id);
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

    public function status($id){
        Vendedor::where('id',$id)->update(['status'=>0]);
        $vendedor=Vendedor::where('id',$id)->get();
        if (!empty($vendedor)){
            $success = true;
            $message = "Vendedor eliminado exitosamente";
        }else{
            $success = true;
            $message = "Vendedor no eliminado";
        }
        return response () -> json([
            'success'=> $success,
            'message'=> $message,
        ]);
    }
}
