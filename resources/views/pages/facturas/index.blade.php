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
                            <th>rfc</th>
                            <th>razon social </th>
                            <th>cfdi</th>
                            <th>calle</th>
                            <th>numero interior</th>
                            <th>numero exterior</th>
                            <th>colonia</th>
                            <th>codigo postal</th>
                            <th>municipio</th>
                            <th>estado</th>
                            <th> Acciones </th> 
                            <th>
                                <a href="{{url('/facturas/restablecer')}}">ver registros Eliminados</a>
                            </th>

                    </tr>
                </thead>
                <tbody>
                    @foreach($facturas as $factura)
                    <tr>
                        <td>{{$factura->id}}</td>
                        <td>{{$factura->rfc}}</td>
                        <td>{{$factura->razon_social}}</td>
                        <td>{{$factura->cfdi}}</td>
                        <td>{{$factura->calle}}</td>
                        <td>{{$factura->numero_interior}}</td>
                        <td>{{$factura->numero_exterior}}</td>
                        <td>{{$factura->colonia}}</td>
                        <td>{{$factura->codigo_postal}}</td>
                        <td>{{$factura->municipio}}</td>
                        <td>{{$factura->estado}}</td>
                        <td>                
                        <a href="{{url('/facturas/'. $factura->id.'/edit')}}"class="btn btn-outline-dark" role="button">Editar</a>
                        <a href="{{url('/facturas/'. $factura->id.'/status')}}"class="btn btn-outline-danger" role="button">Borrar</a>
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














