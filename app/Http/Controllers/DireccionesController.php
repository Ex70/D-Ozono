<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Direccion;
use Illuminate\Http\Request;

class DireccionesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $datos['direcciones']=Direccion::where('status',1)->with('clientes')->get();
        $datos['clientes']=Cliente::all();
        return view('pages.direcciones.index',compact('datos'));
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
        if(empty($request->numero_interior)){
            $num_interior = '';
        }else{
            $num_interior = $request->numero_interior;
        }
        $direccionID = $request->id;
        $direccion = Direccion::updateOrCreate(
            ['id'=>$direccionID],
            ['id_cliente'=>$request->id_cliente,'calle'=>$request->calle,'numero_interior'=>$num_interior,'numero_exterior'=>$request->numero_exterior,'colonia'=>$request->colonia,'codigo_postal'=>$request->codigo_postal,'municipio'=>$request->municipio,'estado'=>$request->estado]);
        $direccionID = $direccion->id;
        $data= Direccion::where('id',$direccionID)->with('clientes')->get();
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
        $datos['direccion']=Direccion::findOrFail($id);
        $datos['clientes']=Cliente::all();
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
         Direccion::where('id',$id)->update(['status'=>0]);
         $direccion=Direccion::where('id',$id)->get();
        if (!empty($direccion)){
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
