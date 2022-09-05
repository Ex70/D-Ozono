<?php

namespace App\Http\Controllers;

use App\Models\Prospecto;
use Illuminate\Http\Request;

class ProspectosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $prospectos = Prospecto::where('status',1)->get();
        return view('pages.prospectos.index',compact('prospectos'));
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
        $prospectoID = $request->id;
        $prospecto =Prospecto::updateOrCreate(
            ['id'=> $prospectoID],
            ['nombre'=> $request->nombre, 'telefono'=>$request->telefono,'celular'=>$request->celular,'correo'=>$request->correo,'tipo'=>$request->tipo,'ubicacion'=>$request->ubicacion,'medio_captacion'=>$request->medio_captacion]);
        $prospectoID = $prospecto->id;
        $data=Prospecto::where('id',$prospectoID)->get();
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
        $datos['prospecto']=Prospecto::findOrFail($id);
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
    public function status($id)
    {
        Prospecto::where('id',$id)->update(['status'=>0]);
        $prospectos=Prospecto::where('id',$id)->get();
        if (!empty($prospectos)){
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

    public function dataAjax(Request $request){
        $data = [];
        if($request->has('q')){
            $search = $request->q;
            $data =Prospecto::select("id","nombre")
                ->where('nombre','LIKE',"%$search%")
                ->get();
        }
        return response()->json($data);
    }

    public function datosCliente($id){
        //
        // $datos['productos'] = Producto::where('id_cotizacion',1)->with('catalogos')->get();
        $datos['prospecto']=Prospecto::where('id',$id)->with('direcciones')->get();
        // dd($datos);
        return response()->json($datos);
    }
}
