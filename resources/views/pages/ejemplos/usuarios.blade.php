@extends('layout.master')

@push('plugin-styles')
  <link href="{{ asset('assets/plugins/datatables-net/dataTables.bootstrap4.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" />
@endpush

@section('content')
<nav class="page-breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Administración</a></li>
    <li class="breadcrumb-item active" aria-current="page">Usuarios</li>
  </ol>
</nav>

<div class="row">
  <div class="col-md-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <div class="row">
          <div class="col-6">
            <h6 class="card-title">Usuarios</h6>
          </div>
          <div class="col-6">
            <a href="javascript:void(0)" class="btn btn-success mb-2" id="crear-usuario" style="float: right;">Agregar usuario</a>
          </div>
        </div>
        <div class="table-responsive">
          <table id="dataTableExample" class="table">
            <thead>
              <tr>
                <th>Id</th>
                <th>Nombre</th>
                <th>Correo</th>
                <th>Usuario</th>
                <th>Permiso</th>
                <th>Acciones</th>
              </tr>
            </thead>
            <tbody id="usuarios-crud">
              @foreach ($datos['usuarios'] as $usuario)
              <tr id="usuario_id_{{$usuario->id}}">
                <td>{{$usuario->id}}</td>
                <td>{{$usuario->nombre}}</td>
                <td>{{$usuario->correo}}</td>
                <td>{{$usuario->usuario}}</td>
                <td>{{$usuario->permisos->descripcion}}</td>
                <td>
                    <!-- Botones de edición -->
                    {{-- El data-id sirve para manmdar el id a la función del formulario --}}
                    <a id="editar-usuario" data-id="{{$usuario->id}}" type="button" class="btn btn-outline-dark" data-bs-toggle="modal">Editar</a>
                    <a id="borrar-usuario" data-id="{{$usuario->id}}" type="button" class="btn btn-danger">Editar</a>
                    {{-- <button class="btn btn-danger" onclick="deleteConfirmation({{$usuario->id}})">Eliminar</button> --}}
                    {{-- <button class="btn btn-outline-danger" onclick="showSwal('passing-parameter-execute-cancel')">Eliminar</button> --}}
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

<div class="modal fade bd-example-modal-lg" id="ajax-crud-modal" tabindex="-1" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h4 class="modal-title w-100 font-weight-bold" id="usuarioModal"></h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
      </div>
      <div class="modal-body">
        <div class="col-lg-12 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <form class="cmxform" id="usuarioForm" name="usuarioForm">
                <input type="hidden" name="id" id="id">
                  <fieldset>
                    <div class="mb-3">
                      <label for="name" class="form-label">Nombre</label>
                      <input id="nombre" class="form-control" name="nombre" type="text">
                    </div>
                    <div class="mb-3">
                      <label for="email" class="form-label">Correo</label>
                      <input id="correo" class="form-control" name="correo" type="email">
                    </div>
                    <div class="mb-3">
                      <label for="name" class="form-label">Usuario</label>
                      <input id="usuario" class="form-control" name="usuario" type="text">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Contraseña</label>
                        <input id="password" class="form-control" name="password" type="password">
                    </div>
                    <div class="mb-3">
                      <label for="exampleFormControlSelect1" class="form-label">Permisos</label>
                      <select class="form-select" id="exampleFormControlSelect1" name="id_permiso">
                        <option selected disabled value="">Seleccione permiso</option>
                        @foreach($datos['permisos'] as $permiso)
                          <option value="{{$permiso->id}}">{{$permiso->descripcion}}</option>
                        @endforeach
                      </select>
                    </div>
                    <button type="submit" class="btn btn-primary" id="btn-save" value="create">Enviar</button>
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
  <script src="{{ asset('assets/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/datatables-net/jquery.dataTables.js') }}"></script>
  <script src="{{ asset('assets/plugins/datatables-net-bs4/dataTables.bootstrap4.js') }}"></script>
  <script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
@endpush

@push('custom-scripts')
  <script src="{{ asset('assets/js/data-table.js') }}"></script>
  <script src="{{ asset('assets/js/sweet-alert.js') }}"></script>

  <script>
    $(function() {
      'use strict';
      $.validator.setDefaults({
        submitHandler: function() {
          alert("Usuario agregado");
          Location.reload()
        }
      });
      $(function() {
        $("#usuarioForm").validate({
          rules: {
            nombre: {
              required: true,
              maxlength: 255
            },
            correo: {
              required: true,
              email: true
            },
            usuario: {
              required: true,
              maxlength: 255
            },
            id_permiso: {
              required: true
            },
            password: {
              required: true,
              minlength: 5
            }
          },
          messages: {
            nombre: {
              required: "Por favor, introduzca un nombre",
              maxlength: "El nombre no debe exceder los 255 caracteres"
            },
            usuario: {
              required: "Por favor, introduzca un nombre",
              maxlength: "El nombre no debe exceder los 255 caracteres"
            },
            password: {
              required: "Por favor, introduzca una contraseña",
              minlength: "Su contraseña debe tener más de 5 caracteres"
            },
            correo: "Por favor, introduzca una dirección válida de correo",
          },
          errorPlacement: function(label, element) {
            label.addClass('mt-1 tx-13 text-danger');
            label.insertAfter(element);
          },
          highlight: function(element, errorClass) {
            $(element).parent().addClass('validation-error')
            $(element).addClass('border-danger')
          }
        });
      });
    });
    $(document).ready(function () {
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
        $('#crear-usuario').click(function () {
        $('#btn-save').val("crearUsuario");
        $('#usuarioForm').trigger("reset");
        $('#usuarioModal').html("Agregar un usuario");
        $('#ajax-crud-modal').modal('show');
      });
      $('body').on('click', '#editar-usuario', function () {
        var usuario_id = $(this).data('id');
        $.get('usuario/'+usuario_id+'/edit', function (data) {
          $('#usuarioModal').html("Editar Usuario");
          $('#btn-save').val("editar-usuario");
          $('#ajax-crud-modal').modal('show');
          $('#id').val(data.usuario.id);
          $('#usuario').val(data.usuario.usuario);
          $('#correo').val(data.usuario.correo);
          $('#nombre').val(data.usuario.nombre);
          $('#password').val(data.usuario.password);
          $('#exampleFormControlSelect1').val(data.usuario.id_permiso).change();
        })
      });
      $('body').on('click', '#borrar-usuario', function () {
        var id = $(this).data("id");
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
              url: "{{url('/usuarios1')}}/" + id,
              data: {_token: CSRF_TOKEN},
              dataType: 'JSON',
              success: function (results) {
                if (results.success === true) {
                  swal.fire("!Hecho!", results.message, "success");
                  document.location.reload();
                } else {
                  swal.fire("!Error!", results.message, "error");
                }
              }
            });
          } else {
            e.dismiss;
          }
        }, function (dismiss) {
          return false;
        })
      });
      // $('body').on('click', '.delete-post', function () {
      //     var usuario_id = $(this).data("id");
      //     confirm("Are You sure want to delete !");
      //     $.ajax({
      //         type: "DELETE",
      //         url: "{{ url('ajax-posts')}}"+'/'+usuario_id,
      //         success: function (data) {
      //             $("#usuario_id_" + usuario_id).remove();
      //         },
      //         error: function (data) {
      //             console.log('Error:', data);
      //         }
      //     });
      // });

      $('body').on('click', '#btn-save', function () {
        var actionType = $('#btn-save').val();
        $('#btn-save').html('Guardando...');
        $.ajax({
          data: $('#usuarioForm').serialize(),
          type: "POST",
          url: "{{url('/usuarios1') }}",
          dataType: 'json',
          success:function (data) {
            var post = '<tr id="producto_id_' + data.producto.id + '"><td>' + data.producto.id + '</td><td>' + data.producto.id_cotizacion + '</td><td>' + data.producto.id_catalogo_producto + '</td><td>' + data.producto.subtotal + '</td><td>' + data.producto.cantidad + '</td>';
            post += '<td><a href="javascript:void(0)" id="editar-usuario" data-id="' + data.usuario.id + '" class="btn btn-info">Edit</a></td>';
            post += '<td><a href="javascript:void(0)" id="delete-post" data-id="' + data.usuario.id + '" class="btn btn-danger delete-post">Delete</a></td></tr>';
            // alert("Llegaste");
            if (actionType == "crearUsuario") {
              $('#usuarios-crud').prepend(post);
            } else {
              $("#usuario_id_" + data.usuario.id).replaceWith(post);
            }
            $('#usuarioForm').trigger("reset");
            $('#ajax-crud-modal').modal('hide');
            $('#btn-save').html('Guardar Cambios');
          },
          error: function (data) {
            console.log('Error:', data);
            $('#btn-save').html('Guardar Cambios');
          }
        })
      });
    });
  </script>
@endpush