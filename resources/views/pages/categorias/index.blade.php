@extends('layout.master')

@push('plugin-styles')
  <link href="{{ asset('assets/plugins/datatables-net/dataTables.bootstrap4.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" />
  
@endpush

@section('content')
<nav class="page-breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Administración</a></li>
    <li class="breadcrumb-item active" aria-current="page">Categorias</li>
  </ol>
</nav>

<div class="row">
  <div class="col-md-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <div class ="row">
          <div class="col-6">
            <h6 class="card-title">Categorias</h6>
          </div>
          <div class="col-6">
            <a href="javascript:void(0)" class="btn btn-success mb-2" id="crear-categoria" style="float: right;">Agregar categoria</a>
          </div>
        </div>
        <div class="table-responsive">
          <table id="dataTableExample" class="table">
            
            <thead>
               <tr>
                 <th>#</th>
                 <th>Descripcion</th>
                 <th> Acciones </th> 
                  <th>
                        <a href="{{url('/categorias/restablecer')}}">ver registros Eliminados</a>
                  </th>
                </tr>
            </thead>
            <tbody id="categorias-crud">
                @foreach($datos['categorias'] as $categoria)
                <tr id="categoria_id_{{$categoria->id}}">
                <td>{{$categoria->id}}</td>
                <td>{{$categoria->descripcion}}</td>
                <td>
                
                <a id="editar-categoria" data-id="{{$categoria->id}}" type="button" class="btn btn-outline-dark" data-bs-toggle="modal">Editar</a>
                <button class="btn btn-danger" onclick="deleteConfirmation({{$categoria->id}})">Eliminar</button>    
                
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
        <h4 class="modal-title w-100 font-weight-bold" id="categoriaModal"></h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
      </div>
      <div class="modal-body">
        <div class="col-lg-12 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <form class="cmxform" id="categoriaForm" name="categoriaForm">
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
          //alert("Catalogo agregado");
          Location.reload()
        }
      });
      $(function() {
        $("#categoriaForm").validate({
            descripcion: {
              required: true,
              maxlength: 255
            },
            
          messages: {
           
            descripcion: {
              required: "Por favor, introduzca una descripcion",
              maxlength: "la descripcion no debe exceder los 255 caracteres"
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
            url: "{{url('/categoriaproductos')}}/" + id,
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

  <script>
    $(document).ready(function () {
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
       $('#crear-categoria').click(function(){
       $('#btn-save').val("crearCategoria");
       $('#categoriaForm').trigger("reset");
       $('#categoriaModal').html("Agregar Categoria");
       $('#ajax-crud-modal').modal('show');
       });

       $('body').on('click', '#editar-categoria', function () {
        var categoria_id = $(this).data('id');
        //alert(categoria_id);
        $.get('categoriaproductos/'+categoria_id+'/edit', function (data) {
          $('#categoriaModal').html("Editar Categoria");
          $('#btn-save').val("editar-categoria");
          $('#ajax-crud-modal').modal('show');
          $('#id').val(data.categoria.id);
          $('#descripcion').val(data.categoria.descripcion);
        })
      });

       $('body').on('click','#btn-save', function(){
         var actionType = $('#btn-save').val();
         $('#btn-save').html('Guardando...');
         $.ajax({
          data: $('#categoriaForm').serialize(),
          type: "POST",
          url: "{{url('/categoriaproductos') }}",
          dataType: 'json',
          success:function (data) {
            var post = '<tr id="categoria_id_' + data.categoria.id + '"><td>' + data.categoria.id + '</td><td>' + data.categoria.descripcion + '</td>';
            post += '<td><a href="javascript:void(0)" id="editar-categoria" data-id="' + data.categoria.id + '" class="btn btn-info">Edit</a></td>';
            post += '<td><a href="javascript:void(0)" id="delete-post" data-id="' + data.categoria.id + '" class="btn btn-danger delete-post">Delete</a></td></tr>';
            
            if (actionType == "crearCategoria") {
              $('#categoria-crud').prepend(post);
            } else {
              $("#categoria_id_" + data.categoria.id).replaceWith(post);
            }
            $('#categoriaForm').trigger("reset");
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
