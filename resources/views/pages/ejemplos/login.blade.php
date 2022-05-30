@extends('layout.master2')

@section('content')
<div class="page-content d-flex align-items-center justify-content-center">

  <div class="row w-100 mx-0 auth-page">
    <div class="col-md-8 col-xl-6 mx-auto">
      <div class="card">
        <div class="row">
          <div class="col-md-4 pe-md-0">
            <div class="auth-side-wrapper" style="background-image: url({{ url('https://via.placeholder.com/219x452') }})">

            </div>
          </div>
          <div class="col-md-8 ps-md-0">
            <div class="auth-form-wrapper px-4 py-5">
              <a href="#" class="noble-ui-logo d-block mb-2">D'Ozono <span>Purificadores</span></a>
              <h5 class="text-muted fw-normal mb-4">¡Bienvenido de nuevo! Loguéate en tu cuenta.</h5>
              <form class="forms-sample" action="{{route('user.handleLogin')}}" method="POST">
                @csrf
                <div class="mb-3">
                  <label for="userEmail" class="form-label">Usuario</label>
                  <input type="text" class="form-control" name="email" id="userEmail" placeholder="Usuario">
                </div>
                <div class="mb-3">
                  <label for="userPassword" class="form-label">Contraseña</label>
                  <input type="password" class="form-control" name="password" id="userPassword" autocomplete="current-password" placeholder="Contraseña">
                </div>
                <div>
                  <button type="submit" class="btn btn-primary me-2 mb-2 mb-md-0">Iniciar Sesión</button>
                  {{-- <button type="button" class="btn btn-outline-primary btn-icon-text mb-2 mb-md-0">
                    <i class="btn-icon-prepend" data-feather="twitter"></i>
                    Login with twitter
                  </button> --}}
                </div>
              </form>
              <a href="{{ url('/auth/register') }}" class="d-block mt-3 text-muted">¿No eres usuario? Registrar</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

</div>
@endsection