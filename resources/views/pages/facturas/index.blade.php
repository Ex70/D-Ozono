@extends('layout.master')

@push('plugin-styles')
  <link href="{{ asset('assets/plugins/datatables-net/dataTables.bootstrap4.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" />
@endpush

@section('content')
<nav class="page-breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Administración</a></li>
    <li class="breadcrumb-item active" aria-current="page">Facturas</li>
  </ol>
</nav>

<div class="row">
  <div class="col-md-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
       <div class="row">
          <div class="col-6">
            <h6 class="card-title">Facturas</h6>
          </div>
          <div class="col-6">
            <a href="javascript:void(0)" class="btn btn-success mb-2" id="crear-factura" style="float: right;">Agregar Factura</a>
          </div>
        </div>
        <div class="table-responsive">
          <table id="dataTableExample" class="table">
                 <thead>
                     <tr>
                        <th>#</th>
                        <th>cliente</th>
                        <th>rfc</th>
                        <th>razon social </th>
                        <th>cfdi</th>
                        <th>calle</th>
                        <th>numero interior</th>
                        <th>numero exterior</th>
                        <th>colonia</th>
                        <th>codigo postal</th>
                        <th>municipio</th>
                        <th>estado</th>
                        <th> Acciones </th> 
                        <th>
                        <a href="{{url('/facturas/restablecer')}}">ver registros Eliminados</a>
                        </th>
                    </tr>
                </thead>
                <tbody id="facturas-crud">
                    @foreach($datos['facturas'] as $factura)
                    <tr id="factura_id_{{$factura->id}}">
                        <td>{{$factura->id}}</td>
                        <td>{{$factura->clientes->nombre}}</td>
                        <td>{{$factura->rfc}}</td>
                        <td>{{$factura->razon_social}}</td>
                        <td>{{$factura->cfdi}}</td>
                        <td>{{$factura->calle}}</td>
                        <td>{{$factura->numero_interior}}</td>
                        <td>{{$factura->numero_exterior}}</td>
                        <td>{{$factura->colonia}}</td>
                        <td>{{$factura->codigo_postal}}</td>
                        <td>{{$factura->municipio}}</td>
                        <td>{{$factura->estado}}</td>
                        <td>  
                        <a id="editar-factura" data-id="{{$factura->id}}" type="button" class="btn btn-outline-dark" data-bs-toggle="modal">Editar</a>                
                        <button class="btn btn-danger" onclick="deleteConfirmation({{$factura->id}})">Eliminar</button>  
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
        <h4 class="modal-title w-100 font-weight-bold" id="facturaModal"></h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
      </div>
      <div class="modal-body">
        <div class="col-lg-12 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <form class="cmxform" id="facturaForm" name="facturaForm">
                <input type="hidden" name="id" id="id">
                  <fieldset>
                    <div class="mb-3">
                      <label for="exampleFormControlSelect1" class="form-label">Cliente</label>
                      <select class="form-select" id="exampleFormControlSelect1" name="id_cliente">
                        <option selected disabled>Seleccione Cliente</option>
                        @foreach($datos['clientes'] as $cliente)
                          <option value="{{$cliente->id}}">{{$cliente->nombre}}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="mb-3">
                      <label for="rfc" class="form-label">RFC</label>
                      <input id="rfc" class="form-control" name="rfc" type="text" required>
                    </div>
                    <div class="mb-3">
                      <label for="razon_social" class="form-label">RAZON SOCIAL</label>
                      <input id="razon_social" class="form-control" name="razon_social" type="text" required>
                    </div>
                    <div class="mb-3">
                      <label for="cfdi" class="form-label">CFDI</label>
                      <input id="cfdi" class="form-control" name="cfdi" type="text" required>
                    </div>
                    <div class="mb-3">
                        <label for="calle" class="form-label">CALLE</label>
                        <input id="calle" class="form-control" name="calle" type="text" required>
                    </div>
                    <div class="mb-3">
                        <label for="numero_interior" class="form-label">NÚMERO INTERIOR</label>
                        <input id="numero_interior" class="form-control" name="numero_interior" type="text" required>
                    </div>
                     <div class="mb-3">
                        <label for="numero_exterior" class="form-label">NÚMERO EXTERIOR</label>
                        <input id="numero_exterior" class="form-control" name="numero_exterior" type="text" required>
                    </div>
                    <div class="mb-3">
                        <label for="colonia" class="form-label">COLONIA</label>
                        <input id="colonia" class="form-control" name="colonia" type="text" required>
                    </div>
                    <div class="mb-3">
                        <label for="codigo_postal" class="form-label">CODIGO POSTAL</label>
                        <input id="codigo_postal" class="form-control" name="codigo_postal" type="text" required>
                    </div>
                    <div class="mb-3">
                        <label for="municipio" class="form-label">MUNICIPIO</label>
                        <input id="municipio" class="form-control" name="municipio" type="text" required>
                    </div>
                    <div class="mb-3">
                        <label for="estado" class="form-label">ESTADO</label>
                        <input id="estado" class="form-control" name="estado" type="text" required>
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
      $('#crear-factura').click(function (){
      $('#btn-save').val("crearFactura");
      $('#facturaForm').trigger("reset");
      $('#facturaModal').html("Agregar Factura");
      $('#ajax-crud-modal').modal('show');
      });
      $('body').on('click','#editar-factura', function () {
        var factura_id = $(this).data('id');
        $.get('facturas/'+factura_id+'/edit', function (data) {
          $('#facturaModal').html("Editar Factura");
          $('#btn-save').val("editar-factura");
          $('#ajax-crud-modal').modal('show');
          $('#id').val(data.factura.id);
          $('#exampleFormControlSelect1').val(data.factura.id_cliente).change();
          $('#rfc').val(data.factura.rfc);
          $('#razon_social').val(data.factura.razon_social);
          $('#cfdi').val(data.factura.cfdi);
          $('#calle').val(data.factura.calle);
          $('#numero_interior').val(data.factura.numero_interior);
          $('#numero_exterior').val(data.factura.numero_exterior);
          $('#colonia').val(data.factura.colonia);
          $('#codigo_postal').val(data.factura.codigo_postal);
          $('#municipio').val(data.factura.municipio);
          $('#estado').val(data.factura.estado);      
        })
      });

       $('body').on('click', '#btn-save', function () {
        var actionType = $('#btn-save').val();
        $('#btn-save').html('Guardando...');
        $.ajax({
          data: $('#facturaForm').serialize(),
          type: "POST",
          url: "{{url('/facturas')}}",
          dataType: 'json',
          success:function (data) {
            var post = '<tr id="factura_id_' + data.factura.id + '"><td>' + data.factura.id + '</td><td>'+ data.factura.id_cliente+ '</td><td>' + data.factura.rfc + '</td><td>' + data.factura.razon_social + '</td><td>' + data.factura.cfdi + '</td><td>' + data.factura.calle + '</td><td>'+ data.factura.numero_interior + '</td><td>'+ data.factura.numero_exterior + '</td><td>'+ data.factura.colonia + '</td><td>'+ data.factura.codigo_postal + '</td><td>'+ data.factura.municipio + '</td><td>'+ data.factura.estado + '</td>';
            post += '<td><a href="javascript:void(0)" id="editar-factura" data-id="' + data.factura.id + '" class="btn btn-info">Edit</a></td>';
            post += '<td><a href="javascript:void(0)" id="delete-post" data-id="' + data.factura.id + '" class="btn btn-danger delete-post">Delete</a></td></tr>';
             //alert("Llegaste");
            if (actionType == "crearFactura") {
              $('#facturas-crud').prepend(post);
            } else {
              $("#factura_id_" + data.factura.id).replaceWith(post);
            }
            $('#facturaForm').trigger("reset");
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
          url: "{{url('/facturas')}}/" + id,
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














