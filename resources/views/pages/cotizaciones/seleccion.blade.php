@extends('layout.master')

@section('content')
<nav class="page-breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/">Inicio</a></li>
    {{-- <li class="breadcrumb-item active" aria-current="page">Cotizaciones</li> --}}
  </ol>
</nav>

<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-body">
        <h4 class="text-center mb-3 mt-4">Escoge un tipo de cotización</h4>
        <div class="container">
          <div class="row">
            <div class="col-md-4 stretch-card grid-margin grid-margin-md-0">
              <div class="card">
                <div class="card-body">
                  <h5 class="text-center text-uppercase mt-3 mb-4">Mantenimiento</h5>
                  <i data-feather="tool" class="text-success icon-xxl d-block mx-auto my-3"></i>
                  <div class="d-grid">
                    <a href="{{url('/cotizaciones/crear-mantenimiento')}}" class="btn btn-success mt-4">Crear cotización</a>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-4 stretch-card grid-margin grid-margin-md-0">
              <div class="card">
                <div class="card-body">
                  <h4 class="text-center text-uppercase mt-3 mb-4 fw-light">Venta</h4>
                  <i data-feather="dollar-sign" class="text-success icon-xxl d-block mx-auto my-3"></i>
                  <div class="d-grid">
                    <a href="{{url('/cotizaciones/crear-venta')}}" class="btn btn-success mt-4">Crear cotización</a>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-4 stretch-card">
              <div class="card">
                <div class="card-body">
                  <h5 class="text-center text-uppercase mt-3 mb-4">Renta</h5>
                  <i data-feather="home" class="text-success icon-xxl d-block mx-auto my-3"></i>
                  <div class="d-grid">
                    <a href="{{url('/cotizaciones/crear-renta')}}" class="btn btn-success mt-4">Crear cotización</a>
                  </div>
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection