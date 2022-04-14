@extends('layout.master')

@push('plugin-styles')
  <link href="{{ asset('assets/plugins/datatables-net/dataTables.bootstrap4.css') }}" rel="stylesheet" />
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
                         <th>#</th>
                         <th>COTIZACION</th>
                         <th>CATALOGO PRODUCTO</th>
                         <th>SUBTOTAL</th>
                         <th>CANTIDAD</th>
                         <th>ACCIONES</th>
                         <th> 
                            <a href="{{url('/productos/restablecer')}}">Ver productos Eliminados</a>
                         </th>
                    </tr>
                </thead>
                 <tbody>
                    @foreach($productos as $producto)
                    <tr>
                        <td>{{$producto->id}}</td>
                        <td>{{$producto->id_cotizacion}}</td>
                        <td>$producto->catalogo->descripcion</td>
                        <td>{{$producto->subtotal}}</td>
                        <td>{{$producto->cantidad}}</td>
                        <td>
                            <a href="{{url('/productos/'.$producto->id.'/edit')}}"class="btn btn-outline-dark" role="button">Editar</a>
                            <a href="{{url('/productos/'.$producto->id.'/status')}}"class="btn btn-outline-danger" role="button">Eliminar</a>
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
@endpush

@push('custom-scripts')
  <script src="{{ asset('assets/js/data-table.js') }}"></script>
@endpush