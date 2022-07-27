@extends('layout.master')

@push('plugin-styles')
  <link href="{{ asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet" />
@endpush

@section('content')
<nav class="page-breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Cotización</a></li>
    <li class="breadcrumb-item active" aria-current="page">Mantenimiento</li>
  </ol>
</nav>

<div class="row" id="hello">
  <div class="col-md-12">
    <div class="card">
      <div class="card-body">
        <div class="container-fluid d-flex justify-content-between">
          <div class="col-lg-4 ps-0">
            <div class="row">
              <img src="{{url('assets/images/logo.png')}}" class="img-fluid" alt="logo-d.ozono">
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label text-muted">Cliente:</label>
                <div class="col-sm-9">
                  <select class="itemName form-control" name="itemName"></select>
                </div>
                <p id="nombreCliente"><br>, <br> , .</p>
              </div>
            {{-- <h5 class="mt-5 mb-2 text-muted" id="cliente">CLIENTE : <select class="itemName form-control" name="itemName"></select>
            </h5>
            <p id="nombreCliente"><br>, <br> , .</p> --}}
          </div>
          <div class="col-lg-4 pe-0" id="datosCotizacion">
              <h4 class="fw-bold text-uppercase text-end mt-4 mb-2">Folio</h4>
              <script>var folio = "{{$datos['folio']->id}}";</script>
              <h6 class="text-end mb-5 pb-4">{{$datos['folio']->id}}</h6>
              <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Fecha:</label>
                <div class="col-sm-9">
                  <div class="input-group date datepicker" id="datePickerExample">
                    <input type="text" class="form-control" id="fecha" data-date-format="yyyy-mm-dd">
                    <span class="input-group-text input-group-addon"><i data-feather="calendar"></i></span>
                  </div>
                </div>
              </div>
              <input type="hidden" id="tipo" value="Mantenimiento">
            {{-- <h6 class="mb-0 mt-3 text-end fw-normal mb-2"><span class="text-muted">Fecha :</span><div class="input-group date datepicker" id="datePickerExample">
              <input type="text" class="form-control">
              <span class="input-group-text input-group-addon"><i data-feather="calendar"></i></span>
            </div></h6> --}}
            <div class="row mb-3">
              <label for="exampleInputUsername2" class="col-sm-4 col-form-label">Vigencia</label>
              <div class="col-sm-8">
                <input id="vigencia" class="form-control" name="vigencia" type="text">
              </div>
            </div>
            {{-- <h6 class="text-end fw-normal mb-2"><span class="text-muted">Vigencia :</span><input id="vigencia" class="form-control" name="vigenica" type="text"></h6> --}}
            <div class="row mb-3">
              <label for="exampleInputUsername2" class="col-sm-4 col-form-label">Forma de Pago</label>
              <div class="col-sm-8">
                <input id="tipo_pago" class="form-control" name="tipo_pago" type="text">
              </div>
            </div>
            {{-- <h6 class="text-end fw-normal mb-2"><span class="text-muted">Forma de Pago :</span><input id="tipo_pago" class="form-control" name="tipo_pago" type="text"></h6> --}}
            <div class="row mb-3">
              <label for="exampleInputUsername2" class="col-sm-4 col-form-label">Tiempo de Entrega</label>
              <div class="col-sm-8">
                <input id="tiempo_entrega" class="form-control" name="tiempo_entrega" type="text">
              </div>
            </div>
            {{-- <h6 class="text-end fw-normal mb-2"><span class="text-muted">Tiempo de Entrega :</span><input id="tiempo_entrega" class="form-control" name="tiempo_entrega" type="text"></h6> --}}
          </div>
        </div>
        <div class="container-fluid mt-5 d-flex justify-content-center w-100">
          <div class="table-responsive w-100">
            <a href="javascript:void(0)" class="btn btn-success mb-2" id="crear-cliente">Agregar productos</a>
              {{-- <table class="table table-bordered"> --}}
                <table class="table table-bordered" id="receipt_bill" class="table">
                  <input type="hidden" value="">
                <thead>
                  <tr>
                      <th>#</th>
                      <th>Descripción</th>
                      <th class="text-end">Cantidad</th>
                      <th class="text-end">Costo Unitario</th>
                      <th class="text-end">Importe</th>
                    </tr>
                </thead>
                <tbody id="new" ></tbody>
              </table>
            </div>
        </div>
        <div class="container-fluid mt-5 w-100">
          <div class="row">
            <div class="col-md-6 ms-auto">
                <div class="table-responsive">
                  <table class="table">
                      <tbody>
                        <tr>
                          <td>Sub Total</td>
                          <td class="text-end" id="subTotal">$ 0.00</td>
                        </tr>
                        <tr>
                          <td>IVA (16%)</td>
                          <td class="text-end" id="taxAmount">$ 0.00</td>
                        </tr>
                        <tr class="bg-light">
                          <td class="text-bold-800">Total</td>
                          <td class="text-bold-800 text-end" id="totalPayment"> $ 0.00</td>
                        </tr>
                      </tbody>
                  </table>
                </div>
            </div>
          </div>
        </div>
        <div class="container-fluid w-100" id="submit">
          <a href="javascript:;" class="btn btn-primary float-end mt-4 ms-2"><i data-feather="send" class="me-3 icon-md"></i>Crear</a>
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
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <div class="row">
                <table class="table" style="background-color:#e0e0e0;" >
                  <thead>
                      <tr>
                          {{-- <th>No.</th> --}}
                          <th>Producto</th>
                          <th style="width: 31%">Cantidad</th>
                          <th>Precio</th>
                      </tr>
                  </thead>
                  <tbody>
                      <tr>
                          {{-- <td scope="row">1</td> --}}
                          <td style="width:60%">
                          <select name="vegitable" id="vegitable"  class="form-control">
                              @foreach($datos['productos'] as $row )
                                  <option id={{$row->id}} value="{{$row->descripcion}}" class="vegitable custom-select">
                                      {{$row->descripcion}}
                                  </option>
                              @endforeach
                          </select>
                      </td>
                      <td style="width:1%">
                          <input type="number" id="qty" min="1" value="1" class="form-control">
                      </td>
                      <td>
                          <h5 class="mt-1" id="price" ></h5>
                      </td>
                      <td><button id="add" class="btn btn-success">Agregar</button></td>
                      </tr>
                      <tr>
                      </tr>
                  </tbody>
              </table>
              </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>
@endsection


@push('plugin-scripts')
  <script src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
@endpush

@push('custom-scripts')
<script src="{{ asset('assets/js/select2.js') }}"></script>
<script src="{{ asset('assets/js/datepicker.js') }}"></script>

<script>
  function agregarProducto(row = null){
    var id = document.getElementById("exampleFormControlSelect1").value;
    $('#ajax-crud-modal').modal('hide');
    alert(id);
    $.ajax({
      data: $('#catalogoForm').serialize(),
      type: "POST",
      url: "{{url('/catalogos') }}",
      dataType: 'json',
      success:function (data) {
        var post = '<tr id="categoria_id_' + data[0].id + '"><td>' + data[0].id + '</td><td>' + data[0].id_categoria_producto + '</td><td>' + data[0].categorias.descripcion + '</td><td>' + data[0].clave + '</td><td>' + data[0].precio_unitario + '</td><td>' + data[0].garantia + '</td>';
        post += '<td><a href="javascript:void(0)" id="editar-catalogo" data-id="' + data[0].id + '" class="btn btn-outline-dark">Editar</a>';
        post += '<a href="javascript:void(0)" id="borrar-catalogo" data-id="' + data[0].id + '" class="btn btn-danger delete-post">Eliminar</a></td></tr>';
        $('#catalogos-crud').append(post);
        $('#ajax-crud-modal').modal('hide');
      },
      error: function (data) {
        console.log('Error:', data);
        $('#btn-save').html('Guardar Cambios');
      }
    });
  }
  $(document).ready(function () {
    $('#crear-cliente').click(function () {
      $('#clienteModal').html("Escoja un producto");
      $('#ajax-crud-modal').modal('show');
    });
    $('.itemName').select2({
      placeholder: 'Escriba nombre de cliente',
      ajax: {
        url: '/clientesajax',
        dataType: 'json',
        delay: 250,
        processResults: function (data) {
          return {
            results:  $.map(data, function (item) {
                  return {
                      text: item.nombre,
                      id: item.id
                  }
              })
          };
        },
        cache: true
      }
    });
    $('.itemName').change(function(){
      var value = $(this).val();
      // alert(value);
        $.get('../clientes/'+value+'/datos', function (data) {
          var post = '<input type="hidden" name="id_cliente" id="id_cliente" value="'+value+'"><p id="nombreCliente">'+data['cliente'][0].nombre+'<br>'+data['cliente'][0]['direcciones'][0].calle+', '+data['cliente'][0]['direcciones'][0].colonia+'<br>'+data['cliente'][0]['direcciones'][0].municipio+' , '+data['cliente'][0]['direcciones'][0].estado+'.</p>';
          $('#nombreCliente').replaceWith(post);
        });
    });

    $('#vegitable').change(function() {
      var ids =   $(this).find(':selected')[0].id;
      $.ajax({
        type:'GET',
        url:'/getPrice/{id}',
        data:{id:ids},
        dataType:'json',
        success:function(data){
          $.each(data, function(key, resp){
            $('#price').text(resp.precio_unitario);
          });
        }
      });
    });
    $('#submit').on('click',function(){
      var folio = document.getElementById("datosCotizacion").getElementsByTagName("h6")[0].textContent;
      var id_cliente = $("#id_cliente").val();
      var tipo = $("#tipo").val();
      var fecha = $('#fecha').val();
      var tipo_pago = $("#tipo_pago").val();
      var tiempo_entrega = $("#tiempo_entrega").val();
      var vigencia =  $("#vigencia").val();
      var total =  $("#totalPayment").text();
      var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
      // var total = 0;
      $.ajax({
        data: {
          _token: CSRF_TOKEN,
          'id': folio,
          'id_cliente': id_cliente,
          'tipo': tipo,
          'fecha': fecha,
          'tipo_pago': tipo_pago,
          'tiempo_entrega': tiempo_entrega,
          'vigencia': vigencia,
          'total': total
        },
        type: "POST",
        url: "{{url('/cotizaciones') }}",
        dataType: 'json',
        success:function (data) {
        },
        error: function (data) {
          console.log('Error:', data);
          $('#btn-save').html('Guardar Cambios');
        }
      });
    });

    var count = 1;
    $('#add').on('click',function(){
        var name = $("#vegitable").val();
        var id = $('#vegitable option:selected').attr("id");
        var qty = $('#qty').val();
        var id_cotizacion = document.getElementById("datosCotizacion").getElementsByTagName("h6")[0].textContent;
        var price = $('#price').text();
        var totalProducto =  price*qty;
        if(qty == 0){
            var erroMsg =  '<span class="alert alert-danger ml-5">Minimum Qty should be 1 or More than 1</span>';
            $('#errorMsg').html(erroMsg).fadeOut(9000);
        }else{
          var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
          $.ajax({
            data: {
              _token: CSRF_TOKEN,
              'id_cotizacion': id_cotizacion,
              'id_catalogo_producto': id,
              'subtotal': totalProducto,
              'cantidad': qty
            },
            // data: $('#catalogoForm').serialize(),
            type: "POST",
            url: "{{url('/ingresarProductosCotizacion') }}",
            dataType: 'json',
            success:function (data) {
            },
            error: function (data) {
              console.log('Error:', data);
              $('#btn-save').html('Guardar Cambios');
            }
          });
            billFunction();
        }

        $('#ajax-crud-modal').modal('hide');
        function billFunction(){
            var total = 0.00;
            $("#receipt_bill").each(function () {
            var total =  price*qty;
            var subTotal = 0.00;
            subTotal += total;
            var table =   '<tr><td>'+ count +'</td><td>'+ name + '</td><td>' + qty + '</td><td>' + price + '</td><td><strong><input type="hidden" id="total" value="'+total+'">' +total+ '</strong></td></tr>';
            $('#new').append(table)
            // Código para subtotal de productos
            var total = 0;
            $('tbody tr td strong:last-child').each(function() {
                var value = $('#total', this).val();
                if (!isNaN(value)) {
                    total += Number(value);
                }
            });
            $('#subTotal').text(total);
            var Tax = (total * 16) / 100;
            $('#taxAmount').text(Tax.toFixed(2));
            var Subtotal = $('#subTotal').text();
            var taxAmount = $('#taxAmount').text();
            var totalPayment = parseFloat(Subtotal) + parseFloat(taxAmount);
            $('#totalPayment').text(totalPayment.toFixed(2)); // Showing using ID
        });
        count++;
        }
    });
  });
</script>

@endpush