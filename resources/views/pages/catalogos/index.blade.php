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
                                <th>ID</th>
                                <th>CATEGORIA</th>
                                <th>DESCRIPCION</th>
                                <th>CLAVE</th>
                                <th>PRECIO UNIDAD</th>
                                <th>GARANTIA</th>
                                <th>ACCIONES</th>
                            </thead>
                            <tbody>
                                @foreach($catalogos as $catalogo)
                                <tr>
                                    <td>{{$catalogo->id}}</td>
                                    <td>{{$catalogo->id_categoria_producto}}</td>
                                    <td>{{$catalogo->descripcion}}</td>
                                    <td>{{$catalogo->clave}}</td>
                                    <td>{{$catalogo->precio_unitario}}</td>
                                    <td>{{$catalogo->garantia}}</td>

                                    <td>
                                        <a href="{{url('/catalogo/'.$catalogo->id.'/edit')}}">Editar</a>
                                        <a href="{{url('/catalogo/'.$catalogo->id.'/status')}}">Eliminar</a>
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