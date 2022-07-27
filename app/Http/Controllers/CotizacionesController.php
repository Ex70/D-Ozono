<?php

namespace App\Http\Controllers;

use App\Models\Catalogo;
use App\Models\Categorias;
use App\Models\Cotizacion;
use App\Models\Cliente;
use App\Models\Direccion;
use App\Models\Producto;
use CatalogoProductos;
use Illuminate\Http\Request;

class CotizacionesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $datos['cotizaciones'] = Cotizacion::where('status',1)->with('clientes')->get();
        $datos['clientes'] = Cliente::all();
        return view('pages.cotizaciones.index',compact('datos'));
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
    // public function store(Request $request)
    // {
    //     //
    //     $cotizacionID= $request->id;
    //     $cotizacion =Cotizacion::updateOrCreate(
    //         ['id'=>$cotizacionID],
    //         ['id_cliente'=>$request->id_cliente,
    //         'tipo'=>$request->tipo,
    //         'fecha'=>$request->fecha,
    //         'notas'=>$request->notas,
    //         'tipo_pago'=>$request->tipo_pago,
    //         'tiempo_entrega'=>$request->tiempo_entrega,
    //         'vigencia'=>$request->vigencia,
    //         'condiciones'=>$request->condiciones,
    //         'total'=>$request->total,
    //         'descuento'=>$request->descuento,
    //         'descuento_especial'=>$request->descuento_especial]
    //     );
    //     $data['cotizacion']=Cotizacion::where('id',$cotizacionID)->with('clientes')->get();
    //     return response()->json($data);
    // }

    public function store(Request $request)
    {
        //
        $cotizacionID= $request->id;
        $cotizacion =Cotizacion::updateOrCreate(
            ['id'=>$cotizacionID],
            ['id_cliente'=>$request->id_cliente,
            'tipo'=>$request->tipo,
            'fecha'=>$request->fecha,
            'notas'=>$request->notas,
            'tipo_pago'=>$request->tipo_pago,
            'tiempo_entrega'=>$request->tiempo_entrega,
            'vigencia'=>$request->vigencia,
            'condiciones'=>$request->condiciones,
            'total'=>$request->total,
            'descuento'=>$request->descuento,
            'descuento_especial'=>$request->descuento_especial]
        );
        $data['cotizacion']=Cotizacion::where('id',$cotizacionID)->with('clientes')->get();
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
        $datos['cotizacion']=Cotizacion::findOrFail($id);
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

    public function status($id){
        Cotizacion::where('id',$id)->update(['status'=>0]);
        $cotizacion=Cotizacion::where('id',$id)->get();
        if (!empty($cotizacion)){
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

    public function mantenimiento($id){
        $datos['cotizacion'] = Cotizacion::where('id',1)->with('clientes')->get();
        $datos['productos'] = Producto::where('id_cotizacion',1)->with('catalogos')->get();
        $datos['suma']=Producto::where('id_cotizacion',1)->sum('subtotal');
        $datos['direccion'] = Direccion::where('id_cliente',1)->first();
        // dd ($datos);
        return view('pages.cotizaciones.mantenimiento',compact('datos'));
    }

    public function mantenimientonuevo(){
        // $datos['cotizacion'] = Cotizacion::where('id',1)->with('clientes')->get();
        // $datos['productos'] = Producto::where('id_cotizacion',1)->with('catalogos')->get();
        // $datos['suma']=Producto::where('id_cotizacion',1)->sum('subtotal');
        // $datos['direccion'] = Direccion::where('id_cliente',1)->first();
        // dd ($datos);
        $datos['productos'] = Catalogo::where('id_categoria_producto',2)->get();
        $datos['folio'] = Cotizacion::latest('id')->first();
        return view('pages.cotizaciones.editar',compact('datos'));
    }
}
