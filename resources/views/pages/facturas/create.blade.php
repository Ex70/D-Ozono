formulario de creación de empleados
<form action="{{url('/facturas')}}" method="post" enctype="multipart/form-data"> 
@csrf

<label for="calle">Id Cliente</label>
<input type = "text" name="id_cliente" value="{{$idcliente}}" id="id_cliente">
<br>
<label for="RFC">RFC</label>
<input type = "text" name="rfc" value="" id="rfc">
<br>

<label for="razon_social">Razon Social</label>
<input type = "text" name="razon_social" value="" id="razon_social">
<br>

<label for="cfdi">CFDI</label>
<input type = "text" name="cfdi" value="" id="cfdi">
<br>

<label for="calle">Calle</label>
<input type = "text" name="calle" value="" id="calle">
<br>

<label for="numero_interior">Numero Interior</label>
<input type = "text" name="numero_interior" value="" id="numero_interior">
<br>

<label for="numero_exterior">Numero Exterior </label>
<input type = "text" name="numero_exterior" value="" id="numero_exterior">
<br>

<label for="colonia">Colonia</label>
<input type = "text" name="colonia" value="" id="colonia">
<br>

<label for="codigo_postal">Codigo Postal</label>
<input type = "text" name="codigo_postal" value="" id="codigo_postal">
<br>

<label for="municipio">Municipio</label>
<input type = "text" name="municipio" value="" id="municipio">
<br>

<label for="estado">Estado</label>
<input type = "text" name="estado" value="" id="estado">
<br>

<label for="Enviar">Guardar</label>
<input type = "submit" value= "enviar">
<br>
</form>

  
    @if ($errors->any())
         <div class="alert alert-danger">
            <ul>
              @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
            @endforeach
             </ul>
        </div>
    @endif