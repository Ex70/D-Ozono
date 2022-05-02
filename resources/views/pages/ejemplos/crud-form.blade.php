@extends('layout.master')

@push('plugin-styles')
  <link href="{{ asset('assets/plugins/datatables-net/dataTables.bootstrap4.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" />

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
        <div class="row">
          <div class="col-6">
            <h6 class="card-title">Permisos</h6>
          </div>
          <div class="col-6">
            <a href="javascript:void(0)" class="btn btn-success mb-2" id="crear-permiso" style="float: right;">Agregar Permiso</a>
          </div>
        </div>
        <div class="table-responsive">
          <table id="dataTableExample" class="table">
            <thead>
              <tr>
                <th>Id</th>
                <th>Descripción</th>
                <th>Acciones</th>
              </tr>
            </thead>
            <tbody id="permisos-crud">
              @foreach ($permisos as $permiso)
              <tr id="permisos_id_{{$permiso->id}}">
                <td>{{$permiso->id}}</td>
                <td>{{$permiso->descripcion}}</td>
                <td>
                  <a id="editar-permiso" data-id="{{$permiso->id}}" type="button" class="btn btn-outline-dark" data-bs-toggle="modal">Editar</a>
                  <button class="btn btn-danger" onclick="deleteConfirmation({{$permiso->id}})">Eliminar</button>
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
        <h4 class="modal-title w-100 font-weight-bold" id="permisoModal"></h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
      </div>
      <div class="modal-body">
        <div class="col-lg-12 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <form class="cmxform" id="permisoForm" name="permisoForm">
                <input type="hidden" name="id" id="id">
                  <fieldset>
                    <div class="mb-3">
                      <label for="descripcion" class="form-label">Descripcion</label>
                      <input id="descripcion" class="form-control" name="descripcion" type="text" required>
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

@endpush

@push('custom-scripts')
  <script src="{{ asset('assets/js/data-table.js') }}"></script>
  <script src="{{ asset('assets/js/sweet-alert.js') }}"></script>
  
  <script>
    $(document).ready(function () {
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
        $('#crear-permiso').click(function () {
        $('#btn-save').val("crearPermiso");
        $('#permisoForm').trigger("reset");
        $('#permisoModal').html("Agregar Permiso");
        $('#ajax-crud-modal').modal('show');
      });
      $('body').on('click', '#editar-permiso', function () {
        var permiso_id = $(this).data('id');
        $.get('permisos/'+permiso_id+'/edit', function (data) {
          $('#permisoModal').html("Editar Permiso");
          $('#btn-save').val("editar-permiso");
          $('#ajax-crud-modal').modal('show');
          $('#id').val(data.permiso.id);
          $('#descripcion').val(data.permiso.descripcion);
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
          data: $('#permisoForm').serialize(),
          type: "POST",
          url: "{{url('/permisos') }}",
          dataType: 'json',
          success:function (data) {
            var post = '<tr id="permiso_id_' + data.permiso.id + '"><td>' + data.permiso.id + '</td><td>' + data.permiso.descripcion + '</td>';
            post += '<td><a href="javascript:void(0)" id="editar-permiso" data-id="' + data.permiso.id + '" class="btn btn-info">Edit</a></td>';
            post += '<td><a href="javascript:void(0)" id="delete-post" data-id="' + data.usuario.id + '" class="btn btn-danger delete-post">Delete</a></td></tr>';
            // alert("Llegaste");
            if (actionType == "crearPermiso") {
              $('#permisos-crud').prepend(post);
            } else {
              $("#permisos_id_" + data.permiso.id).replaceWith(post);
            }
            $('#permisoForm').trigger("reset");
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
          url: "{{url('/permisos')}}/" + id,
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