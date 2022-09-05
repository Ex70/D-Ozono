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
use PDF;

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
        $datos['cotizaciones'] = Cotizacion::where('status',1)->whereNotNull('id_cliente')->with('clientes')->get();
        $datos['clientes'] = Cliente::all();
        // dd($datos['cotizaciones'][0]['clientes']['nombre']);
        return view('pages.cotizaciones.index',compact('datos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
    }

    public function store(Request $request){
        $cotizacionID= $request->id;
        $cotizacion =Cotizacion::updateOrCreate(
            ['id'=>$cotizacionID],
            ['id_cliente'=>$request->id_cliente,
            'tipo'=>$request->tipo,
            'fecha'=>$request->fecha,
            'tipo_pago'=>$request->tipo_pago,
            'tiempo_entrega'=>$request->tiempo_entrega,
            'vigencia'=>$request->vigencia,
            'garantia'=>$request->garantia,
            'condiciones'=>$request->condiciones,
            'total'=>$request->total,
            'descuento'=>$request->descuento,
            'descuento_especial'=>$request->descuento_especial]
        );
        $data = Cotizacion::where('id',$cotizacionID)->with('clientes')->get();
        Producto::where('id_cotizacion',$cotizacionID)->update(['status' => 1]);
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
        $datos['cotizacion'] = Cotizacion::where('id',$id)->with('clientes')->get();
        // dd($datos['cotizacion']);
        $datos['productos'] = Producto::where('id_cotizacion',$id)->with('catalogos')->get();
        $datos['suma']=Producto::where('id_cotizacion',$id)->sum('subtotal');
        $datos['direccion'] = Direccion::where('id_cliente',$datos['cotizacion'][0]['id_cliente'])->first();
        // dd ($datos);
        // view()->share('productos', $productos);
        // $pdf = PDF::loadView('pages.cotizaciones.mantenimiento', compact('datos'))->setOptions(['defaultFont' => 'sans-serif']);
        // return $pdf->download('archivo-pdf.pdf');
        return view('pages.cotizaciones.mantenimiento',compact('datos'));
    }

    public function generarPDF(){
        $datos['cotizacion'] = Cotizacion::where('id',1)->with('clientes')->get();
        $datos['productos'] = Producto::where('id_cotizacion',1)->with('catalogos')->get();
        $datos['suma']=Producto::where('id_cotizacion',1)->sum('subtotal');
        $datos['direccion'] = Direccion::where('id_cliente',1)->first();
        $datos['inBackground'] = true;
		set_time_limit(0);
        // dd ($datos);
        // view()->share('productos', $productos);
        // $pdf = PDF::loadView('pages.cotizaciones.mantenimiento', compact('datos'))->setOptions(['defaultFont' => 'sans-serif']);
        $pdf = PDF::loadView('pages.cotizaciones.mantenimiento', compact('datos'))->render();
        return $pdf->download('archivo-pdf.pdf');
        // return view('pages.cotizaciones.mantenimiento',compact('datos'));
    }

    public function mantenimientonuevo(){
        $ultimoID = (Cotizacion::latest('id')->first()->id)+1;
        $cotizacion =Cotizacion::updateOrCreate(
            ['id'=>$ultimoID]
        );
        $datos['productos'] = Catalogo::where('id_categoria_producto',2)->get();
        $datos['folio'] = $ultimoID;
        return view('pages.cotizaciones.editar',compact('datos'));
    }

    public function ventanueva(){
        $ultimoID = (Cotizacion::latest('id')->first()->id)+1;
        $cotizacion =Cotizacion::updateOrCreate(
            ['id'=>$ultimoID]
        );
        $datos['productos'] = Catalogo::where('id_categoria_producto',1)->get();
        $datos['folio'] = $ultimoID;
        return view('pages.cotizaciones.venta',compact('datos'));
    }

    public function rentanueva(){
        $ultimoID = (Cotizacion::latest('id')->first()->id)+1;
        $cotizacion =Cotizacion::updateOrCreate(
            ['id'=>$ultimoID]
        );
        $datos['productos'] = Catalogo::where('id_categoria_producto',3)->get();
        $datos['folio'] = $ultimoID;
        return view('pages.cotizaciones.renta',compact('datos'));
    }
}
