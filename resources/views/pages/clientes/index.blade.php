@extends('layout.master')

@push('plugin-styles')
  <link href="{{ asset('assets/plugins/datatables-net/dataTables.bootstrap4.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" />
 
  @endpush

@section('content')
<nav class="page-breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Administración</a></li>
    <li class="breadcrumb-item active" aria-current="page">Clientes</li>
  </ol>
</nav>

<div class="row">
  <div class="col-md-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <div class="row">
          <div class="col-6">
             <h6 class="card-title">Clientes</h6>
          </div>
          <div class="col-6">
            <a href="javascript:void(0)" class="btn btn-success mb-2" id="crear-cliente" style="float: right;">Agregar cliente</a>
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
                        <a href="{{url('/clientes/restablecer')}}">ver registros Eliminados</a>
                  </th>
                </tr>
            </thead>
           <tbody id="clientes-crud">
                 @foreach($clientes as $cliente)
                    <tr id="cliente_id_{{$cliente->id}}">
                        <td>{{$cliente->id}}</td>
                        <td>{{$cliente->nombre}}</td>
                        <td>{{$cliente->telefono}}</td>
                        <td>{{$cliente->celular}}</td> 
                        <td>{{$cliente->correo}}</td>
                        <td>{{$cliente->tipo}}</td>
                        <td>{{$cliente->ubicacion}}</td>
                        <td>{{$cliente->medio_captacion}}</td>
                        <td>
                            <a id="editar-cliente" data-id="{{$cliente->id}}" type="button" class="btn btn-outline-dark" data-bs-toggle="modal">Editar</a>
                            <button class="btn btn-danger" onclick="deleteConfirmation({{$cliente->id}})">Eliminar</button>
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
        <h4 class="modal-title w-100 font-weight-bold" id="clienteModal"></h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
      </div>
      <div class="modal-body">
        <div class="col-lg-12 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <form class="cmxform" id="clienteForm" name="clienteForm">
                <input type="hidden" name="id" id="id">
                  <fieldset>
                    <div class="mb-3">
                      <label for="nombre" class="form-label">Nombre</label>
                      <input id="nombre" class="form-control" name="nombre" type="text" required>
                    </div>
                    <div class="mb-3">
                      <label for="telefono" class="form-label">Telefono</label>
                      <input id="telefono" class="form-control" name="telefono" type="text" required>
                    </div>
                    <div class="mb-3">
                      <label for="celular" class="form-label">Celular</label>
                      <input id="celular" class="form-control" name="celular" type="text" required>
                    </div>
                    <div class="mb-3">
                      <label for="email" class="form-label">Correo</label>
                      <input id="correo" class="form-control" name="correo" type="email" required>
                    </div>
                    <div class="mb-3">
                      <label for="tipo" class="form-label">Tipo</label>
                      <input id="tipo" class="form-control" name="tipo" type="text" required>
                    </div>
                    <div class="mb-3">
                        <label for="ubicacion" class="form-label">Ubicación</label>
                        <input id="ubicacion" class="form-control" name="ubicacion" type="text" required>
                    </div>
                    <div class="mb-3">
                        <label for="medio-captacion" class="form-label">Medio Captacion</label>
                        <input id="medio-captacion" class="form-control" name="medio_captacion" type="text"required>
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
   $('#clienteForm').validate()    
  </script>

 
  
  <script>
    $(document).ready(function () {
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
        $('#crear-cliente').click(function () {
        $('#btn-save').val("crearCliente");
        $('#clienteForm').trigger("reset");
        $('#clienteModal').html("Agregar un cliente");
        $('#ajax-crud-modal').modal('show');
      });
      $('body').on('click', '#editar-cliente', function () {
        var cliente_id = $(this).data('id');
        $.get('clientes/'+cliente_id+'/edit', function (data) {
          $('#clienteModal').html("Editar Usuario");
          $('#btn-save').val("editar-cliente");
          $('#ajax-crud-modal').modal('show');
          $('#id').val(data.cliente.id);
          $('#nombre').val(data.cliente.nombre);
          $('#telefono').val(data.cliente.telefono);
          $('#celular').val(data.cliente.celular);
          $('#correo').val(data.cliente.correo);
          $('#tipo').val(data.cliente.tipo);
          $('#ubicacion').val(data.cliente.ubicacion);
          $('#medio-captacion').val(data.cliente.medio_captacion);
          
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
          data: $('#clienteForm').serialize(),
          type: "POST",
          url: "{{url('/clientes') }}",
          dataType: 'json',
           success:function (data) {
            var post = '<tr id="cliente_id_' + data.cliente.id + '"><td>' + data.cliente.id + '</td><td>' + data.cliente.nombre + '</td><td>' + data.cliente.telefono + '</td><td>' + data.cliente.celular + '</td><td>' + data.cliente.correo + '</td><td>'+ data.cliente.tipo + '</td><td>'+ data.cliente.ubicacion + '</td><td>'+ data.cliente.medio_captacion + '</td>';
            post += '<td><a href="javascript:void(0)" id="editar-usuario" data-id="' + data.cliente.id + '" class="btn btn-info">Edit</a></td>';
            post += '<td><a href="javascript:void(0)" id="delete-post" data-id="' + data.cliente.id + '" class="btn btn-danger delete-post">Delete</a></td></tr>';
            //alert("Llegaste");
            if (actionType == "crearCliente") {
              $('#clientes-crud').prepend(post);
            } else {
              $("#cliente_id_" + data.cliente.id).replaceWith(post);
            }
            $('#clienteForm').trigger("reset");
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
 
 
 
 
 
 
 <script type="text/javascript">
    function deleteConfirmation(id) {
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
          url: "{{url('/clientes')}}/" + id,
          data: {_token: CSRF_TOKEN},
          dataType: 'JSON',
    
          success: function (results) {
            if (results.success === true) {
               // alert("funciono");
                swal.fire("!Hecho!", results.message, "success");
                document.location.reload();
              
            } 
            else {
                //alert("no funciono");
                swal.fire("!Error!", results.message, "error");
            }
            
          }
        });
      } 
       else {
          e.dismiss;
       }
      }, function (dismiss) {
         return false;
      }
      )
   }
  </script>
@endpush


