<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;
use App\Support\Invoice;
use App\Models\Cotizacion;
use App\Models\Direccion;
use App\Models\Producto;
use Barryvdh\DomPDF\Facade as DomPDF;
// use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Response;

class ShowInvoiceController
{
    public function __invoke()
    {
        return view('pages.cotizaciones.mantenimiento', Invoice::attributes());
    }

    
    public static function attributes($id, $inBackground = false)
	{
        $datos['cotizacion'] = Cotizacion::where('id',$id)->with('clientes')->get();
        // dd($datos['cotizacion']);
        $datos['productos'] = Producto::where('id_cotizacion',$id)->with('catalogos')->get();
        $datos['suma']=Producto::where('id_cotizacion',$id)->sum('subtotal');
        $datos['direccion'] = Direccion::where('id_cliente',$datos['cotizacion'][0]['id_cliente'])->first();
        $datos['inBackground'] = $inBackground;
        return view('pages.cotizaciones.mantenimiento',compact('datos'));
		// return [
		// 	'products' => $datos['productos'],
		// 	'cotizacion' => $datos['cotizacion'],
		// 	'suma' => $datos['suma'],
		// 	'direccion' => $datos['direccion'],
		// 	// 'qrCode' => self::qrCode(),
		// 	'inBackground' => $inBackground,
		// ];
	}
}
