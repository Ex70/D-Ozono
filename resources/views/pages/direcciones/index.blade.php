@extends('layout.master')

@push('plugin-styles')
  <link href="{{ asset('assets/plugins/datatables-net/dataTables.bootstrap4.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" />
@endpush

@section('content')
<nav class="page-breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Administración</a></li>
    <li class="breadcrumb-item active" aria-current="page">Direcciones</li>
  </ol>
</nav>

<div class="row">
  <div class="col-md-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <div class="row">
          <div class="col-6">
            <h6 class="card-title">Direcciones</h6>
          </div>
          <div class="col-6">
            <a href="javascript:void(0)" class="btn btn-success mb-2" id="crear-direccion" style="float: right;">Agregar direccion</a>
          </div>
        </div>
        <div class="table-responsive">
          <table id="dataTableExample" class="table">
            <thead>
              <tr>
                <th>#</th>
                <th>CLIENTE</th>
                <th>CALLE</th>
                <th>NÚMERO INTERIOR</th>
                <th>NÚMERO EXTERIOR</th>
                <th>COLONIA</th>
                <th>CÓDIGO POSTAL</th>
                <th>MUNICIPIO</th>
                <th>ESTADO</th>
                <th>ACCIONES</th> 
                <th>
                    <a href="{{url('/direcciones/restablecer')}}">ver registros Eliminados</a>
                </th>
              </tr>
            </thead>
            <tbody id="direcciones-crud">
                @foreach($datos['direcciones'] as $direccion)
                <tr id="direccion_id_{{$direccion->id}}">
                    <td>{{$direccion->id}}</td>
                    <td>{{$direccion->clientes->nombre}}</td>
                    <td>{{$direccion->calle}}</td>
                    <td>{{$direccion->numero_interior}}</td>
                    <td>{{$direccion->numero_exterior}}</td>
                    <td>{{$direccion->colonia}}</td>
                    <td>{{$direccion->codigo_postal}}</td>
                    <td>{{$direccion->municipio}}</td>
                    <td>{{$direccion->estado}}</td>
                    <td>
                      <a id="editar-direccion" data-id="{{$direccion->id}}" type="button" class="btn btn-outline-dark" data-bs-toggle="modal">Editar</a>
                      <a id="borrar-direccion" data-id="{{$direccion->id}}" type="button" class="btn btn-danger">Eliminar</a>
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
        <h4 class="modal-title w-100 font-weight-bold" id="direccionModal"></h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
      </div>
      <div class="modal-body">
        <div class="col-lg-12 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <form class="cmxform" id="direccionForm" name="direccionForm">
                <input type="hidden" name="id" id="id">
                  <fieldset>
                    <div class="mb-3">
                      <label for="exampleFormControlSelect1" class="form-label">Clientes</label>
                      <select class="form-select" id="exampleFormControlSelect1" name="id_cliente">
                        <option selected disabled>Seleccione cliente</option>
                        @foreach($datos['clientes'] as $cliente)
                          <option value="{{$cliente->id}}">{{$cliente->nombre}}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="mb-3">
                      <label for="calle" class="form-label">Calle</label>
                      <input id="calle" class="form-control" name="calle" type="text">
                    </div>
                    <div class="mb-3">
                      <label for="numero_interior" class="form-label">Numero Interior</label>
                      <input id="numero_interior" class="form-control" name="numero_interior" type="text">
                    </div>
                    <div class="mb-3">
                      <label for="numero_exterior" class="form-label">Numero Exterior</label>
                      <input id="numero_exterior" class="form-control" name="numero_exterior" type="text">
                    </div>
                    <div class="mb-3">
                      <label for="colonia" class="form-label">Colonia</label>
                      <input id="colonia" class="form-control" name="colonia" type="text">
                    </div>
                    <div class="mb-3">
                      <label for="codigo_postal" class="form-label">Codigo Postal</label>
                      <input id="codigo_postal" class="form-control" name="codigo_postal" type="text">
                    </div>
                    <div class="mb-3">
                      <label for="municipio" class="form-label">Municipio</label>
                      <input id="municipio" class="form-control" name="municipio" type="text">
                    </div>
                    <div class="mb-3">
                      <label for="estado" class="form-label">Estado</label>
                      <input id="estado" class="form-control" name="estado" type="text">
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
          // alert("Usuario agregado");
        }
      });
      $(function() {
        $("#direccionForm").validate({
          rules: {
            id_cliente: {
              required: true
            },
            calle: {
              required: true,
              maxlength: 255
            },
            numero_exterior: {
              required: true
            },
            colonia: {
              required: true,
              maxlength: 255
            },
            codigo_postal: {
              required: true,
              minlength: 5
            },
            estado: {
              required: true,
              maxlength: 255
            },
            municipio: {
              required: true,
              maxlength: 255
            }
          },
          messages: {
            calle: {
              required: "Por favor, introduzca una calle",
              maxlength: "El nombre de la calle no debe exceder los 255 caracteres"
            },
            colonia: {
              required: "Por favor, introduzca una colonia",
              maxlength: "El nombre de la colonia no debe exceder los 255 caracteres"
            },
            numero_exterior: {
              required: "Por favor, introduzca un número exterior"
            },
            id_cliente: {
              required: "Por favor, seleccione un cliente"
            },
            codigo_postal: {
              required: "Por favor, introduzca un código postal",
              minlength: "Su contraseña debe tener más de 4 caracteres"
            },
            municipio: {
              required: "Por favor, introduzca un municipio",
              maxlength: "El nombre del municipio no debe exceder los 255 caracteres"
            },
            estado: {
              required: "Por favor, introduzca un estado",
              maxlength: "El nombre del estado no debe exceder los 255 caracteres"
            },
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
        $('#crear-direccion').click(function () {
        $('#btn-save').val("crearDireccion");
        $('#direccionForm').trigger("reset");
        $('#direccionModal').html("Agregar una direccion");
        $('#ajax-crud-modal').modal('show');
      });
      $('body').on('click', '#editar-direccion', function () {
        var direccion_id = $(this).data('id');
        $.get('direcciones/'+direccion_id+'/edit', function (data) {
          $('#direccionModal').html("Editar Direccion");
          $('#btn-save').val("editar-direccion");
          $('#ajax-crud-modal').modal('show');
          $('#id').val(data.direccion.id);
          $('#exampleFormControlSelect1').val(data.direccion.id_cliente).change();
          $('#calle').val(data.direccion.calle);
          $('#numero_interior').val(data.direccion.numero_interior);
          $('#numero_exterior').val(data.direccion.numero_exterior);
          $('#colonia').val(data.direccion.colonia);
          $('#codigo_postal').val(data.direccion.codigo_postal);
          $('#municipio').val(data.direccion.municipio);
          $('#estado').val(data.direccion.estado);
        })
      });
      $('body').on('click', '#borrar-direccion', function () {
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
              url: "{{url('/direcciones')}}/" + id,
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
          data: $('#direccionForm').serialize(),
          type: "POST",
          url: "{{url('/direcciones') }}",
          dataType: 'json',
          success:function (data) {
            var post = '<tr id="direccion_id_' + data[0].id + '"><td>' + data[0].id + '</td><td>' + data[0].clientes.nombre + '</td><td>' + data[0].calle + '</td><td>' + data[0].numero_interior + '</td><td>' + data[0].numero_exterior + '</td><td>'+ data[0].colonia+ '</td><td>'+ data[0].codigo_postal + '</td><td>'+ data[0].municipio + '</td><td>'+ data[0].estado + '/td';
            post += '<td><a href="javascript:void(0)" id="editar-direccion" data-id="' + data[0].id + '" class="btn btn-outline-dark">Editar</a> ';
            post += '<a href="javascript:void(0)" id="borrar-direccion" data-id="' + data[0].id + '" class="btn btn-danger delete-post">Eliminar</a></td></tr>';
            // alert("Llegaste");
            if (actionType == "crearDireccion") {
              $('#direcciones-crud').append(post);
            } else {
              $("#direccion_id_" + data[0].id).replaceWith(post);
            }
            $('#direccionForm').trigger("reset");
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