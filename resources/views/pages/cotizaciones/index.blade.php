@extends('layout.master')

@push('plugin-styles')
  <link href="{{ asset('assets/plugins/datatables-net/dataTables.bootstrap4.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" />
@endpush

@section('content')
<nav class="page-breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Administración</a></li>
    <li class="breadcrumb-item active" aria-current="page">Cotizaciones</li>
  </ol>
</nav>

<div class="row">
  <div class="col-md-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h6 class="card-title">Cotizaciones</h6>
        {{-- <p class="text-muted mb-3">Read the <a href="https://datatables.net/" target="_blank"> Official DataTables Documentation </a>for a full list of instructions and other options.</p> --}}
        <div class="table-responsive">
          <table id="dataTableExample" class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>CLIENTE</th>
                    <th>TIPO</th>
                    <th>FECHA</th>
                    <th>NOTAS</th>
                    <th>TIPO PAGO</th>
                    <th>TIEMPO ENTREGA</th>
                    <th>VIGENCIA</th>
                    <th>CONDICIONES</th>
                    <th>TOTAL</th>
                    <th>DESCUENTO</th>
                    <th>DESCUENTO ESPECIAL</th>
                    <th>ACCIONES</th>
                </tr>
            </thead>
            <tbody>
                                @foreach($cotizaciones as $cotizacion)
                                <tr>
                                    <td>{{$cotizacion->id}}</td>
                                    <td>{{$cotizacion->id_cliente}}</td>
                                    <td>{{$cotizacion->tipo}}</td>
                                    <td>{{$cotizacion->fecha}}</td> 
                                    <td>{{$cotizacion->notas}}</td>
                                    <td>{{$cotizacion->tipo_pago}}</td>
                                    <td>{{$cotizacion->tiempo_entrega}}</td>
                                    <td>{{$cotizacion->vigencia}}</td>
                                    <td>{{$cotizacion->condiciones}}</td>
                                    <td>{{$cotizacion->total}}</td>
                                    <td>{{$cotizacion->descuento}}</td>
                                    <td>{{$cotizacion->descuento_especial}}</td>    
                                    <td>        
                                        <button type="button" class="btn btn-outline-dark" data-bs-toggle="modal" data-bs-target=".bd-example-modal-lg">Editar</button>                        
                                        <button class="btn btn-outline-danger" onclick="deleteConfirmation({{$cotizacion->id}})">Eliminar</button>
                    
                                        
                                        <a href="{{url('/cotizacion/'.$cotizacion->id.'/agregarproducto')}}">Agregar producto</a>
                                        <a href="{{url('/cotizacion/'.$cotizacion->id.'/consult')}}">Consultar Productos</a>
                                    </td>
                                </tr>
                                @endforeach
            </tbody>
         </table>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade bd-example-modal-lg" tabindex="-1" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h4 class="modal-title w-100 font-weight-bold">Sign in</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
                {{-- <button type="button" class="btn-close" data-dismiss="modal" aria-label="btn-close"> --}}
                    {{-- <span aria-hidden="true">&times;</span> --}}
                </button>
            </div>
            <div class="modal-body">
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Form Validation</h4>
                            <p class="text-muted mb-3">Read the <a href="https://jqueryvalidation.org/" target="_blank"> Official jQuery Validation Documentation </a>for a full list of instructions and other options.</p>
                            <form class="cmxform" id="signupForm" method="get" action="#">
                                <fieldset>
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Name</label>
                                        <input id="name" class="form-control" name="name" type="text">
                                    </div>
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input id="email" class="form-control" name="email" type="email">
                                    </div>
                                    <div class="mb-3">
                                        <label for="password" class="form-label">Password</label>
                                        <input id="password" class="form-control" name="password" type="password">
                                    </div>
                                    <div class="mb-3">
                                        <label for="confirm_password" class="form-label">Confirm password</label>
                                        <input id="confirm_password" class="form-control" name="confirm_password" type="password">
                                    </div>
                                    <input class="btn btn-primary" type="submit" value="Submit">
                                </fieldset>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('plugin-scripts')
    <script src="{{ asset('assets/plugins/datatables-net/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-net-bs4/dataTables.bootstrap4.js') }}"></script>
    <script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
@endpush

@push('custom-scripts')
    <script src="{{ asset('assets/js/data-table.js') }}"></script>
      <script type="text/javascript">
  function deleteConfirmation(id) {
    swal.fire({
    title: "¿Eliminar?",
    text: "!Favor de confirmar!",
    type: "warning",
    showCancelButton: !0,
    confirmButtonText: "Si, Eliminar!",
    cancelButtonText: "No, cancelar!",
    reverseButtons: !0
    }).then(function (e) {
       if (e.value === true) {
       var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

       $.ajax({
          type: 'POST',
          url: "{{url('/cotizaciones')}}/" + id,
          data: {_token: CSRF_TOKEN},
          dataType: 'JSON',
    
          success: function (results) {
            if (results.success === true) {
               // alert("funciono");
                swal.fire("!Hecho!", results.message, "success");
                document.location.reload();
              
            } 
            else {
                //alert("no funciono");
                swal.fire("!Error!", results.message, "error");
            }
            
          }
        });
      } 
       else {
          e.dismiss;
       }
      }, function (dismiss) {
         return false;
      }
      )
}
</script>
    
@endpush


                        