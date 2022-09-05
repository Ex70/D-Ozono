<?php

namespace App\Support;

use App\Models\Cotizacion;
use App\Models\Direccion;
use App\Models\Producto;
// use Barryvdh\DomPDF\Facade as DomPDF;
// use SimpleSoftwareIO\QrCode\Facades\QrCode;
// use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Response;
use PDF;

class Invoice {
	/**
	 * Collection of products to show in the invoice view
	 *
	 * @return \Illuminate\Support\Collection
	 */
	public static function products() {
		return collect([
			new Product('Web design', 500.45, 1),
			new Product('Hosting (three months)', 1500.48, 3),
			new Product('Domain name (site-a.test, site-b.test)', 50.32, 2),
			new Product('Community management (April 2021)', 20.00, 1),
		]);
	}

	/**
	 * Get the total sum of all products inside the invoice
	 *
	 * @return float
	 */
	public static function total(): float {
		return self::products()->sum(function (Product $product) {
			return $product->total();
		});
	}

	/**
	 * Generate the invoice QR code
	 *
	 * @return string
	 */
	// public static function qrCode() {
	// 	$code = QrCode::format('png')->size(150)->generate('invoice-unique-code');

	// 	return base64_encode($code);
	// }

	/**
	 * Attributes passes to view
	 *
	 * @param boolean $inBackground
	 * @return array
	 */
	public static function attributes($inBackground = false,$id): array
	{
		// dd($datos['cotizacion']);
		
        $datos['cotizacion'] = Cotizacion::where('id',$id)->with('clientes')->get();
        // dd($datos['cotizacion']);
        $datos['productos'] = Producto::where('id_cotizacion',$id)->with('catalogos')->get();
        $datos['suma']=Producto::where('id_cotizacion',$id)->sum('subtotal');
        $datos['direccion'] = Direccion::where('id_cliente',$datos['cotizacion'][0]['id_cliente'])->first();
		$datos['inBackground'] = $inBackground;
		// dd($datos['cotizacion']);
		return $datos;
			// 'products' => $datos['productos'],
			// 'cotizacion' => $datos['cotizacion'],
			// 'suma' => $datos['suma'],
			// 'direccion' => $datos['direccion'],
			// // 'qrCode' => self::qrCode(),
			// 'inBackground' => $inBackground,
		
	}

	/**
	 * Generate PDF object
	 *
	 * @param boolean $inBackground
	 * @return PDF
	 */
	public static function generatePdf($inBackground = false, $id = 10) {
		$datos['cotizacion'] = Cotizacion::where('id',$id)->with('clientes')->get();
        // dd($datos['cotizacion']);
        $datos['productos'] = Producto::where('id_cotizacion',$id)->with('catalogos')->get();
        $datos['suma']=Producto::where('id_cotizacion',$id)->sum('subtotal');
        $datos['direccion'] = Direccion::where('id_cliente',$datos['cotizacion'][0]['id_cliente'])->first();
		$datos['inBackground'] = $inBackground;
		set_time_limit(0);
		return PDF::loadView('pages.cotizaciones.mantenimiento', compact('datos'));
		// $pdf = PDF::loadView('pages.cotizaciones.mantenimiento', compact('datos'))->render();
	}

	/**
	 * Force the download of the PDF file
	 *
	 * @return Response
	 */
	public static function download(): Response{
		$filename = self::filename();

		return self::generatePdf(true)->download($filename);
	}

	/**
	 * Output the PDF as a string
	 *
	 * @return string
	 */
	public static function outputAsBinary(): string {
		return self::generatePdf(true)->output();
	}

	/**
	 * Generate a unique string to be used as filename
	 *
	 * @return string
	 */
	public static function filename() {
		return 'invoice_' . now()->timestamp . '.pdf';
	}
}
