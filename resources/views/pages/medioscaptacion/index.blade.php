@extends('layout.master')

@push('plugin-styles')
  <link href="{{ asset('assets/plugins/datatables-net/dataTables.bootstrap4.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" />
  
@endpush

@section('content')
<nav class="page-breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Administración</a></li>
    <li class="breadcrumb-item active" aria-current="page">Medios de Captación</li>
  </ol>
</nav>

<div class="row">
  <div class="col-md-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <div class ="row">
          <div class="col-6">
            <h6 class="card-title">Medios de Captación</h6>
          </div>
          <div class="col-6">
            <a href="javascript:void(0)" class="btn btn-success mb-2" id="crear-medio" style="float: right;">Agregar medio de captación</a>
          </div>
        </div>
        <div class="table-responsive">
          <table id="dataTableExample" class="table">
            <thead>
              <tr>
                <th>#</th>
                <th>Descripcion</th>
                <th>Acciones</th>
                <th>
                  <a href="{{url('/medios/restablecer')}}">ver registros Eliminados</a>
                </th>
              </tr>
            </thead>
            <tbody id="medios-crud">
              @foreach($datos['medios'] as $medio)
                <tr id="medio_id_{{$medio->id}}">
                  <td>{{$medio->id}}</td>
                  <td>{{$medio->descripcion}}</td>
                  <td>
                    <a id="editarMedio" data-id="{{$medio->id}}" type="button" class="btn btn-outline-dark" data-bs-toggle="modal">Editar</a>
                    <a id="borrar-medio" data-id="{{$medio->id}}" type="button" class="btn btn-danger">Eliminar</a>
                    {{-- <button class="btn btn-danger" onclick="deleteConfirmation({{$categoria->id}})">Eliminar</button> --}}
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
        <h4 class="modal-title w-100 font-weight-bold" id="medioModal"></h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
      </div>
      <div class="modal-body">
        <div class="col-lg-12 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <form class="cmxform" id="mediosForm" name="mediosForm">
                <input type="hidden" name="id" id="id" >
                  <fieldset>
                    <div class="mb-3">
                      <label for="name" class="form-label">Descripcion</label>
                      <input id="descripcion" class="form-control" name="descripcion" type="text">
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
  <script src="{{ asset('assets/js/form-validation.js') }}"></script>

  <script>
    $(function() {
      'use strict';
      $.validator.setDefaults({
        submitHandler: function() {
        }
      });
      $(function() {
        $("#mediosForm").validate({
          rules: {
            descripcion: {
              required: true,
              maxlength: 255
            }
          },
          messages: {
            descripcion: {
              required: "Por favor, introduzca una descripcion",
              maxlength: "la descripcion no debe exceder los 255 caracteres"
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
      $('#crear-medio').click(function(){
        $('#btn-save').val("crearMedio");
        $('#mediosForm').trigger("reset");
        $('#medioModal').html("Agregar medio de captación");
        $('#ajax-crud-modal').modal('show');
      });
      $('body').on('click', '#editarMedio', function () {
        var medio_id = $(this).data('id');
        $.get('medioscaptacion/'+medio_id+'/edit', function (data) {
          $('#medioModal').html("Editar Medio de Captación");
          $('#btn-save').val("editarMedio");
          $('#ajax-crud-modal').modal('show');
          $('#id').val(data.medio.id);
          $('#descripcion').val(data.medio.descripcion);
        })
      });
      $('body').on('click','#btn-save', function(){
        var actionType = $('#btn-save').val();
        $('#btn-save').html('Guardando...');
        $.ajax({
          data: $('#mediosForm').serialize(),
          type: "POST",
          url: "{{url('/medioscaptacion') }}",
          dataType: 'json',
          success:function (data) {
            var post = '<tr id="medio_id_' + data[0].id + '"><td>' + data[0].id + '</td><td>' + data[0].descripcion + '</td>';
            post += '<td><a href="javascript:void(0)" id="editarMedio" data-id="' + data[0].id + '" class="btn btn-outline-dark">Editar</a>';
            post += '<a href="javascript:void(0)" id="borrar-medio" data-id="' + data[0].id + '" class="btn btn-danger delete-post">Eliminar</a></td></tr>';
            if (actionType == "crearMedio") {
              $('#medios-crud').append(post);
            } else {
              $("#medio_id_" + data[0].id).replaceWith(post);
            }
            $('#mediosForm').trigger("reset");
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
    $('body').on('click', '#borrar-medio', function () {
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
              url: "{{url('/medioscaptacion')}}/" + id,
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
  </script>
@endpush