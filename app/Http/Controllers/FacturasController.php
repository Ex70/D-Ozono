<?php

namespace App\Http\Controllers;

use App\Models\Factura;
use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Symfony\Component\HttpFoundation\Response;

class FacturasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datos['facturas']= Factura::where('status',1)->with('clientes')->get();
        $datos['clientes']= Cliente::all();
        return view('pages.facturas.index',compact('datos'));
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
        $facturaID=$request->id;
        $factura = Factura::updateOrCreate(
            ['id'=>$facturaID],
            ['id_cliente' =>$request->id_cliente,'rfc' =>$request->rfc,'razon_social'=>$request->razon_social,'cfdi'=>$request->cfdi,'calle'=>$request->calle,'numero_interior'=>$request->numero_interior,'numero_exterior'=>$request->numero_exterior,'colonia'=>$request->colonia,'codigo_postal'=>$request->codigo_postal,'municipio'=>$request->municipio,'estado'=>$request->estado]);
        $data['factura']=Factura::where('id',$facturaID)->with('clientes')->get();
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
        $datos['factura']=Factura::findOrFail($id);
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
         Factura::where('id',$id)->update(['status'=>0]);
         $factura=Factura::where('id',$id)->get();
        if (!empty($factura)){
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
