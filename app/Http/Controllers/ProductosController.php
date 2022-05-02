<?php

namespace App\Http\Controllers;
use App\Models\Producto;
use App\Models\Catalogo;
use App\Models\Cotizacion;
use Illuminate\Http\Request;

class ProductosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
           $datos['productos'] = Producto::where('status',1)->with('catalogos','cotizaciones')->get();
           $datos['catalogos'] = Catalogo::all(); 
           $datos['cotizaciones']=Cotizacion::all();
           return view('pages.productos.index',compact('datos'));

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
        $productoID=$request->id;
        $producto = Producto:: updateOrCreate(
            ['id'=>$productoID],
            ['id_cotizacion'=>$request->id_cotizacion,'id_catalogo_producto'=>$request->id_catalogo_producto,'subtotal'=>$request->subtotal,'cantidad'=>$request->cantidad]);
        $data['producto']=Producto::where('id',$productoID)->with('catalogos','cotizaciones')->get();
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
        $datos['producto']=Producto::findOrFail($id);
        $datos['catalogos']=Catalogo::all();
        $datos['cotizacion']=Cotizacion::all();
        return response ()->json($datos);
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
         Producto::where('id',$id)->update(['status'=>0]);
         $productos=Producto::where('id',$id)->get();
        if (!empty($productos)){
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
