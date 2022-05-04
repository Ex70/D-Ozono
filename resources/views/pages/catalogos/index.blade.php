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
            <h6 class="card-title">Catalogos</h6>
          </div>
          <div class="col-6">
            <a href="javascript:void(0)" class="btn btn-success mb-2" id="crear-catalogo" style="float: right;">Agregar producto</a>
          </div>
        </div>

        <div class="table-responsive">
          <table id="dataTableExample" class="table">
            <thead>
              <tr>
                <th>ID</th>
                <th>CATEGORIA</th>
                <th>DESCRIPCION</th>
                <th>CLAVE</th>
                <th>PRECIO UNIDAD</th>
                <th>GARANTIA</th>
                <th>ACCIONES</th>
              </tr>
            </thead>
            <tbody id="catalogos-crud">
              @foreach($datos['catalogos'] as $catalogo)
                <tr id="catalogo_id_{{$catalogo->id}}">
                  <td>{{$catalogo->id}}</td>
                  <td>{{$catalogo->categorias->descripcion}}</td>
                  <td>{{$catalogo->descripcion}}</td>
                  <td>{{$catalogo->clave}}</td>
                  <td>{{$catalogo->precio_unitario}}</td>
                  <td>{{$catalogo->garantia}}</td>
                  <td>
                      
                    <a id="editar-catalogo" data-id="{{$catalogo->id}}" type="button" class="btn btn-outline-dark" data-bs-toggle="modal">Editar</a>
                    <button class="btn btn-danger" onclick="deleteConfirmation({{$catalogo->id}})">Eliminar</button>
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
        <h4 class="modal-title w-100 font-weight-bold" id="catalogoModal"></h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
      </div>
      <div class="modal-body">
        <div class="col-lg-12 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <form class="cmxform" id="catalogoForm" name="catalogoForm">
                <input type="hidden" name="id" id="id">
                  <fieldset>
                    <div class="mb-3">
                      <label for="exampleFormControlSelect1" class="form-label">Categoria</label>
                      <select class="form-select" id="exampleFormControlSelect1" name="id_categoria_producto">
                        <option selected disabled >Seleccione categoria</option>
                        @foreach($datos['categorias'] as $categoria)
                          <option value="{{$categoria->id}}">{{$categoria->descripcion}}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="mb-3">
                      <label for="descripcion" class="form-label">Descripcion</label>
                      <input id="descripcion" class="form-control" name="descripcion" type="text" >
                    </div>
                    <div class="mb-3">
                      <label for="clave" class="form-label">Clave</label>
                      <input id="clave" class="form-control" name="clave" type="text" >
                    </div>
                    <div class="mb-3">
                        <label for="precio_unitario class="form-label">Precio Unidad</label>
                        <input id="precio-unidad" class="form-control" name="precio_unitario" type="text" >
                    </div>
                        <div class="mb-3">
                        <label for="garantia" class="form-label">Garantia</label>
                        <input id="garantia" class="form-control" name="garantia" type="text" >
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
          //alert("Catalogo agregado");
          Location.reload()
        }
      });
      $(function() {
        $("#catalogoForm").validate({
          rules: {
            id_categoria_producto: {
              required: true,
              
            },
            descripcion: {
              required: true,
              maxlength: 255
            },
            clave: {
              required: true,
              maxlength: 255
            },
            precio_unitario: {
              required: true
            },
            garantia: {
              required: true,
            }
          },
          messages: {
            id_categoria_producto: {
              required: "Por favor, seleccione una categoria",
            },
            descripcion: {
              required: "Por favor, introduzca una descripcion",
              maxlength: "la descripcion no debe exceder los 255 caracteres"
            },
            clave: {
              required: "Por favor, introduzca una clave",
              maxlength: "la Clave no debe exceder los 255 caracteres"
            },
            precio_unitario: {
              required: "Por favor, introduzca precio unitario",
            },
            garantia: "Por favor, introduzca la garantia del producto",
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
        $('#crear-catalogo').click(function () {
        $('#btn-save').val("crearCatalogo");
        $('#catalogoForm').trigger("reset");
        $('#catalogoModal').html("Agregar Producto");
        $('#ajax-crud-modal').modal('show');
      });
      $('body').on('click', '#editar-catalogo', function () {
        var catalogo_id = $(this).data('id');
        $.get('catalogos/'+catalogo_id+'/edit', function (data) {
          $('#catalogoModal').html("Editar Producto");
          $('#btn-save').val("editar-catalogo");
          $('#ajax-crud-modal').modal('show');
          $('#id').val(data.catalogo.id);
          $('#exampleFormControlSelect1').val(data.catalogo.id_categoria_producto).change();
          $('#descripcion').val(data.catalogo.descripcion);
          $('#clave').val(data.catalogo.clave);
          $('#precio-unidad').val(data.catalogo.precio_unitario);
          $('#garantia').val(data.catalogo.garantia);
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
      //         }'
      //     });
      // });

      $('body').on('click', '#btn-save', function () {
        var actionType = $('#btn-save').val();
        $('#btn-save').html('Guardando...');
        $.ajax({
          data: $('#catalogoForm').serialize(),
          type: "POST",
          url: "{{url('/catalogos') }}",
          dataType: 'json',
          success:function (data) {
            var post = '<tr id="categoria_id_' + data.catalogo.id + '"><td>' + data.catalogo.id + '</td><td>' + data.catalogo.id_categoria_producto + '</td><td>' + data.catalogo.descripcion + '</td><td>' + data.catalogo.clave + '</td><td>' + data.catalogo.precio_unitario + '</td><td>' + data.catalogo.garantia + '</td>';
            post += '<td><a href="javascript:void(0)" id="editar-catalogo" data-id="' + data.catalogo.id + '" class="btn btn-info">Edit</a></td>';
            post += '<td><a href="javascript:void(0)" id="delete-post" data-id="' + data.catalogo.id + '" class="btn btn-danger delete-post">Delete</a></td></tr>';
            //alert("Llegaste");
            if (actionType == "crearCatalogo") {
              $('#catalogos-crud').prepend(post);
            } else {
              $("#catalogos_id_" + data.catalogo.id).replaceWith(post);
            }
            $('#catalogoForm').trigger("reset");
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
          url: "{{url('/catalogos')}}/" + id,
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