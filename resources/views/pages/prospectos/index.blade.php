@extends('layout.master')

@push('plugin-styles')
  <link href="{{ asset('assets/plugins/datatables-net/dataTables.bootstrap4.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" />
@endpush

@section('content')
<nav class="page-breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Administración</a></li>
    <li class="breadcrumb-item active" aria-current="page">Prospectos</li>
  </ol>
</nav>

<div class="row">
  <div class="col-md-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <div class="row">
          <div class="col-6">
            <h6 class="card-title">Prospectos</h6>
          </div>
          <div class="col-6">
            <a href="javascript:void(0)" class="btn btn-success mb-2" id="crear-prospecto" style="float: right;">Agregar prospecto</a>
          </div>
        </div>
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
                    <a href="{{url('/prospectos/restablecer')}}">Ver registros eliminados</a>
                  </th>
                </tr>
            </thead>
            <tbody id="prospectos-crud">
              @foreach($prospectos as $prospecto)
                <tr id="prospecto_id_{{$prospecto->id}}">
                  <td>{{$prospecto->id}}</td>
                  <td>{{$prospecto->nombre}}</td>
                  <td>{{$prospecto->telefono}}</td>
                  <td>{{$prospecto->celular}}</td>
                  <td>{{$prospecto->correo}}</td>
                  <td>{{$prospecto->tipo}}</td>
                  <td>{{$prospecto->ubicacion}}</td>
                  <td>{{$prospecto->medio_captacion}}</td>
                  <td>
                    <a id="editar-prospecto" data-id="{{$prospecto->id}}" type="button" class="btn btn-outline-dark" data-bs-toggle="modal">Editar</a>
                    <a id="borrar-prospecto" data-id="{{$prospecto->id}}" type="button" class="btn btn-danger">Eliminar</a>
                      {{-- <a id="editar-prospecto" data-id="{{$cliente->id}}" type="button" class="btn btn-outline-dark" data-bs-toggle="modal">Editar</a>
                      <button class="btn btn-danger" onclick="deleteConfirmation({{$cliente->id}})">Eliminar</button> --}}
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
        <h4 class="modal-title w-100 font-weight-bold" id="prospectoModal"></h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
      </div>
      <div class="modal-body">
        <div class="col-lg-12 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <form class="cmxform" id="prospectoForm" name="prospectoForm">
                <input type="hidden" name="id" id="id">
                  <fieldset>
                    <div class="mb-3">
                      <label for="nombre" class="form-label">Nombre</label>
                      <input id="nombre" class="form-control" name="nombre" type="text">
                    </div>
                    <div class="mb-3">
                      <label for="telefono" class="form-label">Telefono</label>
                      <input id="telefono" class="form-control" name="telefono" type="text">
                    </div>
                    <div class="mb-3">
                      <label for="celular" class="form-label">Celular</label>
                      <input id="celular" class="form-control" name="celular" type="text">
                    </div>
                    <div class="mb-3">
                      <label for="email" class="form-label">Correo</label>
                      <input id="correo" class="form-control" name="correo" type="email">
                    </div>
                    <div class="mb-3">
                      <label for="tipo" class="form-label">Tipo</label>
                      <input id="tipo" class="form-control" name="tipo" type="text">
                    </div>
                    <div class="mb-3">
                        <label for="ubicacion" class="form-label">Ubicación</label>
                        <input id="ubicacion" class="form-control" name="ubicacion" type="text">
                    </div>
                    <div class="mb-3">
                        <label for="medio-captacion" class="form-label">Medio Captacion</label>
                        <input id="medio-captacion" class="form-control" name="medio_captacion" type="text">
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
  <script src="{{ asset('assets/plugins/datatables-net/jquery.dataTables.js') }}"></script>
  <script src="{{ asset('assets/plugins/datatables-net-bs4/dataTables.bootstrap4.js') }}"></script>
  <script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
@endpush

@push('custom-scripts')
  <script src="{{ asset('assets/js/data-table.js') }}"></script>
  <script src="{{ asset('assets/js/sweet-alert.js') }}"></script>
  {{-- <script src="{{ asset('assets/js/form-validation.js') }}"></script> --}}
  <script>
    $(function() {
      'use strict';
      $.validator.setDefaults({
        submitHandler: function() {
          // alert("Usuario agregado");
        }
      });
      $('#prospectoForm').validate({
        rules:{
          nombre: {
            required: true,
            maxlength: 255
          },
          correo: {
            required: true,
            email: true
          },
          tipo: {
            required: true,
            maxlength: 255
          },
          ubicacion: {
            required: true,
            maxlength: 255
          }
        },
        messages: {
          nombre: {
            required: "Por favor, introduzca un nombre",
            maxlength: "El nombre no debe exceder los 255 caracteres"
          },
          tipo: {
            required: "Por favor, introduzca un tipo",
            maxlength: "El tipo no debe exceder los 255 caracteres"
          },
          ubicacion: {
            required: "Por favor, introduzca una ubicación",
            maxlength: "La ubicación no debe exceder los 255 caracteres"
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
  </script>

  <script>
    $(document).ready(function () {
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
        $('#crear-prospecto').click(function () {
        $('#btn-save').val("crearProspecto");
        $('#prospectoForm').trigger("reset");
        $('#prospectoModal').html("Agregar un prospecto");
        $('#ajax-crud-modal').modal('show');
      });
      $('body').on('click', '#editar-prospecto', function () {
        var prospecto_id = $(this).data('id');
        $.get('../prospectos/'+prospecto_id+'/edit', function (data) {
          $('#prospectoModal').html("Editar Prospecto");
          $('#btn-save').val("editar-prospecto");
          $('#ajax-crud-modal').modal('show');
          $('#id').val(data.prospecto.id);
          $('#nombre').val(data.prospecto.nombre);
          $('#telefono').val(data.prospecto.telefono);
          $('#celular').val(data.prospecto.celular);
          $('#correo').val(data.prospecto.correo);
          $('#tipo').val(data.prospecto.tipo);
          $('#ubicacion').val(data.prospecto.ubicacion);
          $('#medio-captacion').val(data.prospecto.medio_captacion);
        })
      });
      $('body').on('click', '#borrar-prospecto', function () {
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
              url: "{{url('/prospectos')}}/" + id,
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

      $('body').on('click', '#btn-save', function () {
        var actionType = $('#btn-save').val();
        $('#btn-save').html('Guardando...');
        $.ajax({
          data: $('#prospectoForm').serialize(),
          type: "POST",
          url: "{{url('/prospectos') }}",
          dataType: 'json',
          success:function (data) {
            var post = '<tr id="prospecto_id_' + data[0].id + '"><td>' + data[0].id + '</td><td>' + data[0].nombre + '</td><td>' + data[0].telefono + '</td><td>' + data[0].celular + '</td><td>' + data[0].correo + '</td><td>'+ data[0].tipo + '</td><td>'+ data[0].ubicacion + '</td><td>'+ data[0].medio_captacion + '</td>';
            post += '<td><a href="javascript:void(0)" id="editar-prospecto" data-id="' + data[0].id + '" class="btn btn-outline-dark">Editar</a> ';
            post += '<a href="javascript:void(0)" id="borrar-prospecto" data-id="' + data[0].id + '" class="btn btn-danger delete-post">Eliminar</a></td></tr>';
            //alert("Llegaste");
            if (actionType == "crearProspecto") {
              $('#prospectos-crud').append(post);
            } else {
              $("#prospecto_id_" + data[0].id).replaceWith(post);
            }
            $('#prospectoForm').trigger("reset");
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


