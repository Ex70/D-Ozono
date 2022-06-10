@extends('layout.master')

@section('content')
<nav class="page-breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Cotización</a></li>
    <li class="breadcrumb-item active" aria-current="page">Mantenimiento</li>
  </ol>
</nav>

<div class="row" id="hello">
  <div class="col-md-12">
    <div class="card">
      <div class="card-body">
        <div class="container-fluid d-flex justify-content-between">
          <div class="col-lg-4 ps-0">
            <div>
              <img src="{{url('assets/images/logo.png')}}" alt="logo-d.ozono" style="width:350px;height:200px;">
            </div>
            {{-- <a href="#" class="noble-ui-logo d-block mt-3">Noble<span>UI</span></a>
            <p class="mt-1 mb-1"><b>NobleUI Themes</b></p>
            <p>108,<br> Great Russell St,<br>London, WC1B 3NA.</p> --}}
            <h5 class="mt-5 mb-2 text-muted" id="cliente">CLIENTEs : 
              <a href="javascript:void(0)" class="btn btn-success mb-2" id="crear-direccion">+</a>
            </h5>
            <p>{{$datos['cotizacion'][0]['clientes']->nombre}}<br>{{$datos['direccion']->calle}}, {{$datos['direccion']->colonia}}<br> {{$datos['direccion']->municipio}}, {{$datos['direccion']->estado}}.</p>
          </div>
          <div class="col-lg-4 pe-0">
            {{-- <div style="width: 350px;height:200px;"> --}}
              <h4 class="fw-bold text-uppercase text-end mt-4 mb-2">Folio</h4>
              <h6 class="text-end mb-5 pb-4">{{$datos['cotizacion'][0]->id}}</h6>
            {{-- </div> --}}
            {{-- <p class="text-end mb-1">Balance Due</p>
            <h4 class="text-end fw-normal">$ 72,420.00</h4> --}}
            <h6 class="mb-0 mt-3 text-end fw-normal mb-2"><span class="text-muted">Fecha :</span>{{$datos['cotizacion'][0]->fecha}}</h6>
            <h6 class="text-end fw-normal mb-2"><span class="text-muted">Vigencia :</span> {{$datos['cotizacion'][0]->vigencia}}</h6>
            <h6 class="text-end fw-normal mb-2"><span class="text-muted">Forma de Pago :</span> {{$datos['cotizacion'][0]->tipo_pago}}</h6>
            <h6 class="text-end fw-normal mb-2"><span class="text-muted">Tiempo de Entrega :</span> {{$datos['cotizacion'][0]->tiempo_entrega}}</h6>
          </div>
        </div>
        <div class="container-fluid mt-5 d-flex justify-content-center w-100">
          <div class="table-responsive w-100">
              <table class="table table-bordered">
                <thead>
                  <tr>
                      <th>#</th>
                      <th>Descripción</th>
                      <th class="text-end">Cantidad</th>
                      <th class="text-end">Costo Unitario</th>
                      <th class="text-end">Importe</th>
                    </tr>
                </thead>
                <tbody id="productos-tabla">
                  @foreach($datos['productos'] as $producto)
                    <tr id="producto_id_{{$producto->id}}">
                      <td class="text-end">{{$producto->id}}</td>
                      <td class="text-end">{{$producto['catalogos']->descripcion}}</td>
                      <td class="text-end">{{$producto->cantidad}}</td>
                      <td class="text-end">{{$producto['catalogos']->precio_unitario}}</td>
                      <td class="text-end">{{$producto->subtotal}}</td>
                      {{-- {{$suma = $suma+$producto->subtotal}} --}}
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
        </div>
        <div class="container-fluid mt-5 w-100">
          <div class="row">
            <div class="col-md-6 ms-auto">
                <div class="table-responsive">
                  <table class="table">
                      <tbody>
                        <tr>
                          <td>Sub Total</td>
                          <td class="text-end">$ {{$datos['suma']}}</td>
                        </tr>
                        <tr>
                          <td>IVA (16%)</td>
                          <td class="text-end">$ {{number_format($datos['suma']*.16,2)}}</td>
                        </tr>
                        <tr class="bg-light">
                          <td class="text-bold-800">Total</td>
                          <td class="text-bold-800 text-end">$ {{number_format($datos['suma']*1.16,2)}}</td>
                        </tr>
                      </tbody>
                  </table>
                </div>
            </div>
          </div>
        </div>
        <div class="container-fluid w-100">
          <a href="javascript:;" class="btn btn-primary float-end mt-4 ms-2"><i data-feather="send" class="me-3 icon-md"></i>Send Invoice</a>
          <a href="javascript:;" onclick="imprimir()" class="btn btn-outline-primary float-end mt-4"><i data-feather="printer" class="me-2 icon-md"></i>Print</a>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

<script>
  function imprimir(){
    var print_div = document.getElementById("hello");
    var print_area = window.open();
    print_area.document.write(print_div.innerHTML);
    print_area.document.close();
    print_area.focus();
    print_area.print();
    print_area.close();
  }
</script>