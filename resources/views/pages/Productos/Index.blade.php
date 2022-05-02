@extends('layout.master')

@push('plugin-styles')
  <link href="{{ asset('assets/plugins/datatables-net/dataTables.bootstrap4.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" />
  
  @endpush

@section('content')
<nav class="page-breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Administración</a></li>
    <li class="breadcrumb-item active" aria-current="page">Productos</li>
  </ol>
</nav>

<div class="row">
  <div class="col-md-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
       <div class="row">
          <div class="col-6">
             <h6 class="card-title">Productos</h6>
          </div>
          <div class="col-6">
            <a href="javascript:void(0)" class="btn btn-success mb-2" id="crear-producto" style="float: right;">Agregar producto</a>
          </div>
        </div>
        <div class="table-responsive">
          <table id="dataTableExample" class="table">
                 <thead>
                     <tr>
                         <th>#</th>
                         <th>COTIZACION</th>
                         <th>CATALOGO PRODUCTO</th>
                         <th>SUBTOTAL</th>
                         <th>CANTIDAD</th>
                         <th>ACCIONES</th>
                         <th> 
                            <a href="{{url('/productos/restablecer')}}">Ver productos Eliminados</a>
                         </th>
                    </tr>
                </thead>
                 <tbody id="productos-crud">
                    @foreach($datos['productos'] as $producto)
                    <tr id="producto_id_{{$producto->id}}">
                        <td>{{$producto->id}}</td>
                        <td>{{$producto->cotizaciones->id}}</td>
                        <td>{{$producto->catalogos->descripcion}}</td>
                        <td>{{$producto->subtotal}}</td>
                        <td>{{$producto->cantidad}}</td>
                        <td>
                            <a id="editar-producto" data-id="{{$producto->id}}" type="button" class="btn btn-outline-dark" data-bs-toggle="modal">Editar</a>
                            <button class="btn btn-danger" onclick="deleteConfirmation({{$producto->id}})">Eliminar</button>
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
        <h4 class="modal-title w-100 font-weight-bold" id="productoModal"></h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
      </div>
      <div class="modal-body">
        <div class="col-lg-12 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <form class="cmxform" id="productoForm" name="productoForm">
                <input type="hidden" name="id" id="id">
                
                 <input type="hidden" name="id_cotizacion" id="id_cotizacion" value="1">

                  <fieldset>
                     <div class="mb-3">
                      <label for="exampleFormControlSelect1" class="form-label"> Productos</label>
                      <select class="form-select" id="exampleFormControlSelect1" name="id_catalogo_producto">
                        <option selected disabled>Seleccione Producto</option>
                        @foreach($datos['catalogos'] as $catalogo)
                          <option value="{{$catalogo->id}}">{{$catalogo->descripcion}}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="mb-3">
                      <label for="subtotal" class="form-label">Subtotal</label>
                      <input id="subtotal" class="form-control" name="subtotal" type="text" required>
                    </div>
                     <div class="mb-3">
                      <label for="cantidad" class="form-label">Cantidad</label>
                      <input id="cantidad" class="form-control" name="cantidad" type="text" required>
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
    $(document).ready(function () {
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
        $('#crear-producto').click(function () {
        $('#btn-save').val("crearProducto");
        $('#productoForm').trigger("reset");
        $('#productoModal').html("Agregar un producto");
        $('#ajax-crud-modal').modal('show');
      });
      $('body').on('click', '#editar-producto', function () {
        var producto_id = $(this).data('id');
        $.get('productos/'+producto_id+'/edit', function (data) {
          $('#productoModal').html("Editar Producto");
          $('#btn-save').val("editar-producto");
          $('#ajax-crud-modal').modal('show');
          $('#id').val(data.producto.id);
          $('#id_cotizacion').val(data.producto.id_cotizacion);
          $('#exampleFormControlSelect1').val(data.producto.id_catalogo_producto).change();
          $('#subtotal').val(data.producto.subtotal);
          $('#cantidad').val(data.producto.cantidad);
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
          data: $('#productoForm').serialize(),
          type: "POST",
          url: "{{url('/productos') }}",
          dataType: 'json',
                   success:function (data) {
            var post = '<tr id="producto_id_' + data.producto.id + '"><td>' + data.producto.id + '</td><td>' + data.producto.id_cotizacion + '</td><td>' + data.producto.id_catalogo_producto + '</td><td>' + data.producto.subtotal + '</td><td>' + data.producto.cantidad + '</td>';
            post += '<td><a href="javascript:void(0)" id="editar-producto" data-id="' + data.producto.id + '" class="btn btn-info">Edit</a></td>';
            post += '<td><a href="javascript:void(0)" id="delete-post" data-id="' + data.producto.id + '" class="btn btn-danger delete-post">Delete</a></td></tr>';
            // alert("Llegaste");
            if (actionType == "crearProducto") {
              $('#productos-crud').prepend(post);
            } else {
              $("#productos_id_" + data.productos.id).replaceWith(post);
            }
            $('#productoForm').trigger("reset");
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
          url: "{{url('/productos')}}/" + id,
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