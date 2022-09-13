@extends('layout.master')

@push('plugin-styles')
  <link href="{{ asset('assets/plugins/datatables-net/dataTables.bootstrap4.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" />
@endpush

@section('content')
<nav class="page-breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Administración</a></li>
    <li class="breadcrumb-item active" aria-current="page">Vendedores</li>
  </ol>
</nav>

<div class="row">
  <div class="col-md-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <div class="row">
          <div class="col-6">
            <h6 class="card-title">Vendedores</h6>
          </div>
          <div class="col-6">
            <a href="javascript:void(0)" class="btn btn-success mb-2" id="crear-vendedor" style="float: right;">Agregar vendedor</a>
          </div>
        </div>
        <div class="table-responsive">
          <table id="dataTableExample" class="table">
            <thead>
                <tr>
                  <th>ID</th>
                  <th>NOMBRE</th>
                  <th>TELEFONO</th>
                  <th>CORREO</th>
                  <th>ACCIONES</th>
                  <th>
                    <a href="{{url('/vendedores/restablecer')}}">Ver registros eliminados</a>
                  </th>
                </tr>
            </thead>
            <tbody id="vendedores-crud">
              @foreach($vendedores as $vendedor)
                <tr id="vendedor_id_{{$vendedor->id}}">
                  <td>{{$vendedor->id}}</td>
                  <td>{{$vendedor->nombre}}</td>
                  <td>{{$vendedor->telefono}}</td>
                  <td>{{$vendedor->correo}}</td>
                  <td>
                    <a id="editar-vendedor" data-id="{{$vendedor->id}}" type="button" class="btn btn-outline-dark" data-bs-toggle="modal">Editar</a>
                    <a id="borrar-vendedor" data-id="{{$vendedor->id}}" type="button" class="btn btn-danger">Eliminar</a>
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
        <h4 class="modal-title w-100 font-weight-bold" id="vendedorModal"></h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
      </div>
      <div class="modal-body">
        <div class="col-lg-12 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <form class="cmxform" id="vendedorForm" name="vendedorForm">
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
                      <label for="email" class="form-label">Correo</label>
                      <input id="correo" class="form-control" name="correo" type="email">
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
      $('#vendedorForm').validate({
        rules:{
          nombre: {
            required: true,
            maxlength: 255
          },
          correo: {
            required: true,
            email: true
          }
        },
        messages: {
          nombre: {
            required: "Por favor, introduzca un nombre",
            maxlength: "El nombre no debe exceder los 255 caracteres"
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
        $('#crear-vendedor').click(function () {
        $('#btn-save').val("crerVendedor");
        $('#vendedorForm').trigger("reset");
        $('#vendedorModal').html("Agregar un vendedor");
        $('#ajax-crud-modal').modal('show');
      });
      $('body').on('click', '#editar-vendedor', function () {
        var vendedor_id = $(this).data('id');
        $.get('vendedores/'+vendedor_id+'/edit', function (data) {
          $('#vendedorModal').html("Editar Vendedor");
          $('#btn-save').val("editar-vendedor");
          $('#ajax-crud-modal').modal('show');
          $('#id').val(data.vendedor.id);
          $('#nombre').val(data.vendedor.nombre);
          $('#telefono').val(data.vendedor.telefono);
          $('#correo').val(data.vendedor.correo);
        })
      });
      $('body').on('click', '#borrar-vendedor', function () {
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
              url: "{{url('/vendedores')}}/" + id,
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
          data: $('#vendedorForm').serialize(),
          type: "POST",
          url: "{{url('/vendedores') }}",
          dataType: 'json',
          success:function (data) {
            var post = '<tr id="vendedor_id_' + data[0].id + '"><td>' + data[0].id + '</td><td>' + data[0].nombre + '</td><td>' + data[0].telefono + '</td><td>' + data[0].correo + '</td>';
            post += '<td><a href="javascript:void(0)" id="editar-vendedor" data-id="' + data[0].id + '" class="btn btn-outline-dark">Editar</a> ';
            post += '<a href="javascript:void(0)" id="borrar-vendedor" data-id="' + data[0].id + '" class="btn btn-danger delete-post">Eliminar</a></td></tr>';
            //alert("Llegaste");
            if (actionType == "crerVendedor") {
              $('#vendedores-crud').append(post);
            } else {
              $("#vendedor_id_" + data[0].id).replaceWith(post);
            }
            $('#vendedorForm').trigger("reset");
            $('#id').val("");
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


