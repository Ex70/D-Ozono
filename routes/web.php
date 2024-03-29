<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\PermisoController;
use App\Http\Controllers\UserAuthController;
use App\Http\Controllers\UsuariosController;
use App\Http\Controllers\CategoriasProductosController;
use App\Http\Controllers\CatalogosProductosController;
use App\Http\Controllers\FacturasController;
use App\Http\Controllers\DireccionesController;
use App\Http\Controllers\ClientesController;
use App\Http\Controllers\CotizacionesController;
use App\Http\Controllers\ProductosController;
use App\Http\Controllers\ReceiptController;
use App\Http\Controllers\ShowInvoiceController;
use App\Http\Controllers\DownloadInvoiceController;
use App\Http\Controllers\MediosCaptacionController;
use App\Http\Controllers\ProspectosController;
use App\Http\Controllers\VendedorController;

Route::get('/', function () {
    return view('pages.cotizaciones.seleccion');
});

// Auth::routes();

Route::get('/', [UserAuthController::class, 'index'])
    ->name('user.home');
    // ->middleware('auth:web');
Route::get('/login', [UserAuthController::class, 'login'])
    ->name('user.login');
Route::post('/login', [UserAuthController::class, 'handleLogin'])
    ->name('user.handleLogin');
Route::get('/logout', [UserAuthController::class, 'index'])
    ->name('user.logout');

Route::get('/billReciept',[ReceiptController::class,'index']);
Route::get('/getPrice/{id}',[ReceiptController::class,'getPrice']);
// Route::get('/billReciept','RecieptController@index');
// Route::get('/getPrice/{id}', 'RecieptController@getPrice'); // for get city list


Route::get('admin/', [AdminAuthController::class, 'index'])
    ->name('admin.home')
    ->middleware('auth:webadmin');
    Route::get('admin/login', [AdminAuthController::class, 'login'])
    ->name('admin.login');
    Route::post('admin/login', [AdminAuthController::class, 'handleLogin'])
    ->name('admin.handleLogin');
    Route::get('admin/logout', [AdminAuthController::class, 'index'])
    ->name('admin.logout');

Route::get('/permisos',[PermisoController::class, 'index']);
Route::get('/usuarios1',[UsuariosController::class, 'index']);

// CATEGORÍAS DE PRODUCTO
Route::get('/categoriaproductos',[CategoriasProductosController::class, 'index']);
Route::post('categoriaproductos/{id}',[CategoriasProductosController::class, 'status']);
Route::get('categoriaproductos/{id}/edit',[CategoriasProductosController::class, 'edit']);
Route::post('/categoriaproductos',[CategoriasProductosController::class, 'store']);

// MEDIOS DE CAPTACIÓN
Route::get('/medioscaptacion',[MediosCaptacionController::class, 'index']);
Route::post('medioscaptacion/{id}',[MediosCaptacionController::class, 'status']);
Route::get('medioscaptacion/{id}/edit',[MediosCaptacionController::class, 'edit']);
Route::post('/medioscaptacion',[MediosCaptacionController::class, 'store']);

// VENDEDORES
Route::get('/vendedores',[VendedorController::class, 'index']);
Route::post('vendedores/{id}',[VendedorController::class, 'status']);
Route::get('vendedores/{id}/edit',[VendedorController::class, 'edit']);
Route::post('/vendedores',[VendedorController::class, 'store']);

Route::get('/catalogos',[CatalogosProductosController::class, 'index']);
Route::get('/facturas',[FacturasController::class, 'index']);
Route::get('/direcciones',[DireccionesController::class, 'index']);
Route::get('/clientes',[ClientesController::class, 'index']);
// ->middleware('auth:web');
Route::get('/clientesajax',[ClientesController::class, 'dataAjax']);
Route::post('clientes/{id}',[ClientesController::class, 'status']);
Route::get('/prospectos',[ProspectosController::class, 'index']);
Route::get('/prospectosajax',[ProspectosController::class, 'dataAjax']);
Route::post('prospectos/{id}',[ProspectosController::class, 'status']);
Route::post('cotizaciones/{id}',[CotizacionesController::class, 'status']);
Route::post('facturas/{id}',[FacturasController::class, 'status']);
Route::post('permisos/{id}',[PermisoController::class, 'status']);
Route::post('productos/{id}',[ProductosController::class, 'status']);
Route::post('catalogos/{id}',[CatalogosProductosController::class, 'status']);
Route::post('direcciones/{id}',[DireccionesController::class, 'status']);
Route::post('usuarios1/{id}',[UsuariosController::class, 'status']);
Route::get('/cotizaciones',[CotizacionesController::class, 'index']); //error
// Route::get('/cotizaciones/crear',[CotizacionesController::class, 'index']); //error
Route::get('/cotizaciones/crear', function () {
    return view('pages.cotizaciones.seleccion');
});
Route::get('/productos',[ProductosController::class, 'index']);

Route::get('/usuario/{id}/edit',[UsuariosController::class, 'edit']);
Route::get('facturas/{id}/edit',[FacturasController::class, 'edit']);
Route::get('catalogos/{id}/edit',[CatalogosProductosController::class, 'edit']);
Route::get('permisos/{id}/edit',[PermisoController::class, 'edit']);
Route::get('clientes/{id}/edit',[ClientesController::class, 'edit']);
Route::get('clientes/{id}/datos',[ClientesController::class, 'datosCliente']);
Route::get('prospectos/{id}/edit',[ProspectosController::class, 'edit']);
Route::get('prospectos/{id}/datos',[ProspectosController::class, 'datosCliente']);
Route::get('direcciones/{id}/edit',[DireccionesController::class, 'edit']);
Route::get('cotizaciones/{id}/edit',[CotizacionesController::class, 'edit']);
Route::get('productos/{id}/edit',[ProductosController::class, 'edit']);
// Route::get('cotizacion/{id}',[CotizacionesController::class, 'mantenimiento']);
Route::get('cotizaciones/crear-mantenimiento',[CotizacionesController::class, 'mantenimientonuevo']);
Route::get('cotizaciones/crear-venta',[CotizacionesController::class, 'ventanueva']);
Route::get('cotizaciones/crear-renta',[CotizacionesController::class, 'rentanueva']);
Route::get('cotizaciones/generarPDF',[CotizacionesController::class, 'generarPDF']);
Route::get('cotizacion/{id}',[ShowInvoiceController::class, 'attributes']);
Route::get('invoice/download', [DownloadInvoiceController::class,'index'])->name('invoice.download');

Route::post('/usuarios1',[UsuariosController::class, 'store']);
Route::post('/facturas',[FacturasController::class, 'store']);
Route::post('/catalogos',[CatalogosProductosController::class, 'store']);
Route::post('/permisos',[PermisoController::class, 'store']);
Route::post('/clientes',[ClientesController::class, 'store']);
Route::post('/prospectos',[ProspectosController::class, 'store']);
Route::post('/direcciones',[DireccionesController::class, 'store']);
Route::post('/productos',[ProductosController::class, 'store']);
Route::post('/cotizaciones',[CotizacionesController::class, 'store']);
Route::post('/ingresarProductosCotizacion',[ProductosController::class, 'ingresarProductos']);
// Route::prefix('usuario')->as('usuario.')->group(function() {
//     Route::get('/', 'Home\UsuariosHomeController@index')->name('home');
//     Route::namespace('Auth\Login')->group(function() {
//         Route::get('login', 'UsuariosController@showLoginForm')->name('login');
//         Route::post('login', 'UsuariosController@login')->name('login');
//         Route::post('logout', 'UsuariosController@logout')->name('logout');
//     });
//  });

// Route::group(['prefix' => 'layout'], function(){
//     Route::get('master', function () { return view('pages.layout.master'); });
// });

Route::group(['prefix' => 'email'], function(){
    Route::get('inbox', function () { return view('pages.email.inbox'); });
    Route::get('read', function () { return view('pages.email.read'); });
    Route::get('compose', function () { return view('pages.email.compose'); });
});

Route::group(['prefix' => 'apps'], function(){
    Route::get('chat', function () { return view('pages.apps.chat'); });
    Route::get('calendar', function () { return view('pages.apps.calendar'); });
});

Route::group(['prefix' => 'ui-components'], function(){
    Route::get('accordion', function () { return view('pages.ui-components.accordion'); });
    Route::get('alerts', function () { return view('pages.ui-components.alerts'); });
    Route::get('badges', function () { return view('pages.ui-components.badges'); });
    Route::get('breadcrumbs', function () { return view('pages.ui-components.breadcrumbs'); });
    Route::get('buttons', function () { return view('pages.ui-components.buttons'); });
    Route::get('button-group', function () { return view('pages.ui-components.button-group'); });
    Route::get('cards', function () { return view('pages.ui-components.cards'); });
    Route::get('carousel', function () { return view('pages.ui-components.carousel'); });
    Route::get('collapse', function () { return view('pages.ui-components.collapse'); });
    Route::get('dropdowns', function () { return view('pages.ui-components.dropdowns'); });
    Route::get('list-group', function () { return view('pages.ui-components.list-group'); });
    Route::get('media-object', function () { return view('pages.ui-components.media-object'); });
    Route::get('modal', function () { return view('pages.ui-components.modal'); });
    Route::get('navs', function () { return view('pages.ui-components.navs'); });
    Route::get('navbar', function () { return view('pages.ui-components.navbar'); });
    Route::get('pagination', function () { return view('pages.ui-components.pagination'); });
    Route::get('popovers', function () { return view('pages.ui-components.popovers'); });
    Route::get('progress', function () { return view('pages.ui-components.progress'); });
    Route::get('scrollbar', function () { return view('pages.ui-components.scrollbar'); });
    Route::get('scrollspy', function () { return view('pages.ui-components.scrollspy'); });
    Route::get('spinners', function () { return view('pages.ui-components.spinners'); });
    Route::get('tabs', function () { return view('pages.ui-components.tabs'); });
    Route::get('tooltips', function () { return view('pages.ui-components.tooltips'); });
});

Route::group(['prefix' => 'advanced-ui'], function(){
    Route::get('cropper', function () { return view('pages.advanced-ui.cropper'); });
    Route::get('owl-carousel', function () { return view('pages.advanced-ui.owl-carousel'); });
    Route::get('sweet-alert', function () { return view('pages.advanced-ui.sweet-alert'); });
});

Route::group(['prefix' => 'forms'], function(){
    Route::get('basic-elements', function () { return view('pages.forms.basic-elements'); });
    Route::get('advanced-elements', function () { return view('pages.forms.advanced-elements'); });
    Route::get('editors', function () { return view('pages.forms.editors'); });
    Route::get('wizard', function () { return view('pages.forms.wizard'); });
});

Route::group(['prefix' => 'charts'], function(){
    Route::get('apex', function () { return view('pages.charts.apex'); });
    Route::get('chartjs', function () { return view('pages.charts.chartjs'); });
    Route::get('flot', function () { return view('pages.charts.flot'); });
    Route::get('morrisjs', function () { return view('pages.charts.morrisjs'); });
    Route::get('peity', function () { return view('pages.charts.peity'); });
    Route::get('sparkline', function () { return view('pages.charts.sparkline'); });
});

Route::group(['prefix' => 'tables'], function(){
    Route::get('basic-tables', function () { return view('pages.tables.basic-tables'); });
    Route::get('data-table', function () { return view('pages.tables.data-table'); });
});

Route::group(['prefix' => 'icons'], function(){
    Route::get('feather-icons', function () { return view('pages.icons.feather-icons'); });
    Route::get('flag-icons', function () { return view('pages.icons.flag-icons'); });
    Route::get('mdi-icons', function () { return view('pages.icons.mdi-icons'); });
});

Route::group(['prefix' => 'general'], function(){
    Route::get('blank-page', function () { return view('pages.general.blank-page'); });
    Route::get('faq', function () { return view('pages.general.faq'); });
    Route::get('invoice', function () { return view('pages.general.invoice'); });
    Route::get('mantenimiento', function () { return view('pages.cotizaciones.mantenimiento'); });
    Route::get('profile', function () { return view('pages.general.profile'); });
    Route::get('pricing', function () { return view('pages.general.pricing'); });
    Route::get('timeline', function () { return view('pages.general.timeline'); });
});

Route::group(['prefix' => 'auth'], function(){
    Route::get('login', function () { return view('pages.auth.login'); });
    Route::get('register', function () { return view('pages.auth.register'); });
});

Route::group(['prefix' => 'error'], function(){
    Route::get('404', function () { return view('pages.error.404'); });
    Route::get('500', function () { return view('pages.error.500'); });
});

Route::group(['prefix' => 'ejemplos'], function(){
    Route::get('crud-form', function () { return view('pages.ejemplos.crud-form'); });
    Route::get('login', function () { return view('pages.ejemplos.login'); });
    Route::get('register', function () { return view('pages.ejemplos.register'); });
});

Route::get('/clear-cache', function() {
    Artisan::call('cache:clear');
    return "Cache is cleared";
});

// 404 for undefined routes
Route::any('/{page?}',function(){
    return View::make('pages.error.404');
})->where('page','.*');

Route::get('/token', function () {
    return csrf_token(); 
});