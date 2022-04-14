@extends('layout.master')

@push('plugin-styles')
  <link href="{{ asset('assets/plugins/datatables-net/dataTables.bootstrap4.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" />
 
  @endpush

@section('content')
<nav class="page-breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Administración</a></li>
    <li class="breadcrumb-item active" aria-current="page">Permisos</li>
  </ol>
</nav>

<div class="row">
  <div class="col-md-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h6 class="card-title">Permisos</h6>
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
                        <button class="btn btn-outline-danger" onclick="showSwal('passing-parameter-execute-cancel')">Eliminar</button>
                       
                         <form action="{{url('/clientes/'.$cliente->id)}}"  class="formulario-eliminar" method="post">
                          @csrf
                          {{method_field('DELETE')}}
                          <input type="submit" onclick="" class="btn btn-outline-danger" value="Borrar">
                           </form>
                        
                        
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

@if (session('eliminar')== 'ok')
  <script>
        Swal.fire(
       'Deleted!',
       'Your file has been deleted.',
       'success'
       )
  </script>
@endif


<script>

$('.formulario-eliminar').submit(function(e){
  e.preventDefault();

  Swal.fire({
  title: 'Are you sure?',
  text: "You won't be able to revert this!",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes, delete it!'
}).then((result) => {
  if (result.value) {
  this.submit();
    // 
  }
})

});
  
</script>

  

@endpush



