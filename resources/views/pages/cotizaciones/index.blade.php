@extends('layout.master')

@push('plugin-styles')
  <link href="{{ asset('assets/plugins/datatables-net/dataTables.bootstrap4.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet" />
@endpush

@section('content')
<nav class="page-breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Administración</a></li>
    <li class="breadcrumb-item active" aria-current="page">Cotizaciones</li>
  </ol>
</nav>

<div class="row">
  <div class="col-md-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <div class="row">
          <div class="col-6">
              <h6 class="card-title">Cotizaciones</h6>
          </div>
          <div class="col-6">
            <a href="javascript:void(0)" class="btn btn-success mb-2" id="crear-cotizacion" style="float: right;">Agregar Cotizacion</a>
          </div>
        </div>
        <div class="table-responsive">
          <table id="dataTableExample" class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>CLIENTE</th>
                    <th>TIPO</th>
                    <th>FECHA</th>
                    <th>NOTAS</th>
                    <th>TIPO PAGO</th>
                    <th>TIEMPO ENTREGA</th>
                    <th>VIGENCIA</th>
                    <th>CONDICIONES</th>
                    <th>TOTAL</th>
                    <th>DESCUENTO</th>
                    <th>DESCUENTO ESPECIAL</th>
                    <th>ACCIONES</th>
                </tr>
            </thead>
            <tbody id="cotizaciones-crud">
              @foreach($datos['cotizaciones'] as $cotizacion)
                <tr id="cotizacion_id_{{$cotizacion->id}}">
                    <td>{{$cotizacion->id}}</td>
                    <td>{{$cotizacion->clientes->nombre}}</td>
                    <td>{{$cotizacion->tipo}}</td>
                    <td>{{$cotizacion->fecha}}</td>
                    <td>{{$cotizacion->notas}}</td>
                    <td>{{$cotizacion->tipo_pago}}</td>
                    <td>{{$cotizacion->tiempo_entrega}}</td>
                    <td>{{$cotizacion->vigencia}}</td>
                    <td>{{$cotizacion->condiciones}}</td>
                    <td>{{$cotizacion->total}}</td>
                    <td>{{$cotizacion->descuento}}</td>
                    <td>{{$cotizacion->descuento_especial}}</td>    
                    <td>       
                        <a id="editar-cotizacion" data-id="{{$cotizacion->id}}" type="button" class="btn btn-outline-dark" data-bs-toggle="modal">Editar</a>
                        <button class="btn btn-outline-danger" onclick="deleteConfirmation({{$cotizacion->id}})">Eliminar</button>              
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
        <h4 class="modal-title w-100 font-weight-bold" id="cotizacionModal"></h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
      </div>
      <div class="modal-body">
        <div class="col-lg-12 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <form class="cmxform" id="cotizacionForm" name="cotizacionForm">
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
                         <label for="tipo" class="form-label">Tipo</label>
                         <input id="tipo" class="form-control" name="tipo" type="text" required>
                    </div>
                    <div class="mb-3">
                        <label for="fecha" class="form-label">Fecha</label>
                        <input id="fecha" class="form-control" name="fecha" type="text" required>
                    </div>
                    {{-- <div class="input-group date datepicker" id="datePickerExample">
                      <input type="text" class="form-control" id="fecha" name="fecha">
                      <span class="input-group-text input-group-addon"><i data-feather="calendar"></i></span>
                    </div> --}}
                     <div class="mb-3">
                         <label for="notas" class="form-label">Notas</label>
                         <input id="notas" class="form-control" name="notas" type="text" required>
                     </div>
                      <div class="mb-3">
                         <label for="tipo_pago" class="form-label">Tipo de pago </label>
                         <input id="tipo_pago" class="form-control" name="tipo_pago" type="text" required>
                     </div>
                      <div class="mb-3">
                         <label for="tiempo_entrega" class="form-label">Tiempo de entrega </label>
                         <input id="tiempo_entrega" class="form-control" name="tiempo_entrega" type="text" required>
                     </div>
                      <div class="mb-3">
                         <label for="vigencia" class="form-label">Vigencia</label>
                         <input id="vigencia" class="form-control" name="vigencia" type="text" required>
                      </div>
                        <div class="mb-3">
                         <label for="condiciones" class="form-label">Condiciones</label>
                         <input id="condiciones" class="form-control" name="condiciones" type="text" required>
                     </div>
                      <div class="mb-3">
                         <label for="total" class="form-label">Total</label>
                         <input id="total" class="form-control" name="total" type="text" required>
                      </div>
                      <div class="mb-3">
                          <label for="descuento" class="form-label">Notas</label>
                         <input id="descuento" class="form-control" name="descuento" type="text" required>
                     </div>
                      <div class="mb-3">
                         <label for="descuento_especial" class="form-label">Descuento Especial</label>
                         <input id="descuento_especial" class="form-control" name="descuento_especial" type="text" required>
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
    <script src="{{ asset('assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>

@endpush

@push('custom-scripts')
    <script src="{{ asset('assets/js/data-table.js') }}"></script>
    <script src="{{ asset('assets/js/sweet-alert.js') }}"></script>
    <script src="{{ asset('assets/js/form-validation.js') }}"></script>
    
  <script src="{{ asset('assets/js/datepicker.js') }}"></script>


      <script>
    $(document).ready(function () {
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
        $('#crear-cotizacion').click(function () {
        $('#btn-save').val("crearCotizacion");
        $('#cotizacionForm').trigger("reset");
        $('#cotizacionModal').html("crear una Cotizacion");
        $('#ajax-crud-modal').modal('show');
      });
      $('body').on('click', '#editar-cotizacion', function () {
        var cotizacion_id = $(this).data('id');
        $.get('cotizaciones/'+cotizacion_id+'/edit', function (data) {
          $('#cotizacionModal').html("Editar Cotizacion");
          $('#btn-save').val("editar-cotizacion");
          $('#ajax-crud-modal').modal('show');
          $('#id').val(data.cotizacion.id);
          $('#exampleFormControlSelect1').val(data.cotizacion.id_cliente).change();
          $('#tipo').val(data.cotizacion.tipo);
          $('#fecha').val(data.cotizacion.fecha);
          $('#notas').val(data.cotizacion.notas);
          $('#tipo_pago').val(data.cotizacion.tipo_pago);
          $('#tiempo_entrega').val(data.cotizacion.tiempo_entrega);
          $('#vigencia').val(data.cotizacion.vigencia);
          $('#condiciones').val(data.cotizacion.condiciones);
          $('#total').val(data.cotizacion.total);
          $('#descuento').val(data.cotizacion.descuento);
          $('#descuento_especial').val(data.cotizacion.descuento_especial);
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
         data: $('#cotizacionForm').serialize(),
          type: "POST",
          url: "{{url('/cotizaciones') }}",
          dataType: 'json',
            success:function (data) {
            var post = '<tr id="cotizacion_id_' + data.cotizacion.id + '"><td>' + data.cotizacion.id+ '</td><td>' + data.cotizacion.id_cliente +'</td><td>' + data.cotizacion.tipo + '</td><td>' + data.cotizacion.fecha + '</td><td>' + data.cotizacion.notas + '</td><td>' + data.cotizacion.tipo_pago + '</td><td>' + data.cotizacion.tiempo_entrega+ '</td><td>' + data.cotizacion.vigencia+ '</td><td>' + data.cotizacion.condiciones+ '</td><td>' + data.cotizacion.total+ '</td><td>' + data.cotizacion.descuento+ '</td><td>' + data.cotizacion.descuento_especial + '</td>';
            post += '<td><a href="javascript:void(0)" id="editar-cotizacion" data-id="' + data.cotizacion.id + '" class="btn btn-info">Edit</a></td>';
            post += '<td><a href="javascript:void(0)" id="delete-post" data-id="' + data.usuario.id + '" class="btn btn-danger delete-post">Delete</a></td></tr>';
             alert("Llegaste");
            if (actionType == "crearCotizacion") {
              $('#cotizaciones-crud').prepend(post);
            } else {
              $("#cotizacion_id_" + data.cotizacion.id).replaceWith(post);
            }
            $('#cotizacionForm').trigger("reset");
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
          url: "{{url('/cotizaciones')}}/" + id,
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


                        