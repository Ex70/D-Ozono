@extends('layout.master')

@push('plugin-styles')
  <link href="{{ asset('assets/plugins/datatables-net/dataTables.bootstrap4.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" />
 
  @endpush

@section('content')
<nav class="page-breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Administración</a></li>
    <li class="breadcrumb-item active" aria-current="page">Clientes</li>
  </ol>
</nav>

<div class="row">
  <div class="col-md-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h6 class="card-title">Clientes</h6>
        {{-- <p class="text-muted mb-3">Read the <a href="https://datatables.net/" target="_blank"> Official DataTables Documentation </a>for a full list of instructions and other options.</p> --}}
        <div class="table-responsive">
          <table id="dataTableExample" class="table">
            <thead>
                <tr>
                   <th>ID</th>
                   <th>NOMBRE</th>
                   <th>TELEFONO</th>
                   <th>CELULAR</th>
                   <th>CORREO</th>
                   <th>TIPO</th>
                   <th>UBICACION</th>
                   <th>MEDIO CAPTACION</th>
                   <th>ACCIONES</th>
                  <th>
                        <a href="{{url('/clientes/restablecer')}}">ver registros Eliminados</a>
                  </th>
                </tr>
            </thead>
           <tbody>
                 @foreach($clientes as $cliente)
                    <tr>
                        <td>{{$cliente->id}}</td>
                        <td>{{$cliente->nombre}}</td>
                        <td>{{$cliente->telefono}}</td>
                        <td>{{$cliente->celular}}</td> 
                        <td>{{$cliente->correo}}</td>
                        <td>{{$cliente->tipo}}</td>
                        <td>{{$cliente->ubicacion}}</td>
                        <td>{{$cliente->medio_captacion}}</td>
                        <td>
                          
                        
                        <button type="button" class="btn btn-outline-dark" data-bs-toggle="modal" data-bs-target=".bd-example-modal-lg">Editar</button>
                        <button class="btn btn-danger" onclick="deleteConfirmation({{$cliente->id}})">Eliminar</button>
                         
                        
                        
                        </td>
                        <td>
                            <a href="{{url('/clientes/'.$cliente->id.'/createadress')}}">Agregar nueva direccion</a>
                             <a href="{{url('/clientes/'.$cliente->id.'/consult')}}">Consultar Direccion</a>
                        </td>
                        <td>
                             <a href="{{url('/clientes/'.$cliente->id.'/createfactura')}}">Agregar nueva factura</a>
                             <a href="{{url('/clientes/'.$cliente->id.'/consultfactura')}}">Consultar facturas</a>                
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
          url: "{{url('/clientes')}}/" + id,
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


