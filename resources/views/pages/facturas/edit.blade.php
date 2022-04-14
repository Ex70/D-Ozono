<form action="{{url('/facturas/'.$factura->id)}}" method="post" >
  @csrf
  {{method_field('PATCH')}}

<label for="RFC">RFC</label>
<input type = "text" name="rfc" value="{{isset ($factura->rfc)?$factura->rfc:''}}" id="rfc">
<br>

<label for="razon_social">Razon Social</label>
<input type = "text" name="razon_social" value="{{isset ($factura->razon_social)?$factura->razon_social:''}}" id="razon_social">
<br>

<label for="cfdi">CFDI</label>
<input type = "text" name="cfdi" value="{{isset ($factura->cfdi)?$factura->cfdi:''}}" id="cfdi">
<br>

<label for="calle">Calle</label>
<input type = "text" name="calle" value="{{isset ($factura->calle)?$factura->calle:''}}" id="calle">
<br>

<label for="numero_interior">Numero Interior</label>
<input type = "text" name="numero_interior" value="{{isset ($factura->numero_interior)?$factura->numero_interior:''}}" id="numero_interior">
<br>

<label for="numero_exterior">Numero Exterior </label>
<input type = "text" name="numero_exterior" value="{{isset ($factura->numero_exterior)?$factura->numero_exterior:''}}" id="numero_exterior">
<br>

<label for="colonia">Colonia</label>
<input type = "text" name="colonia" value="{{isset ($factura->colonia)?$factura->colonia:''}}" id="colonia">
<br>

<label for="codigo_postal">Codigo Postal</label>
<input type = "text" name="codigo_postal" value="{{isset ($factura->codigo_postal)?$factura->codigo_postal:''}}" id="codigo_postal">
<br>

<label for="municipio">Municipio</label>
<input type = "text" name="municipio" value="{{isset ($factura->municipio)?$factura->municipio:''}}" id="municipio">
<br>

<label for="estado">Estado</label>
<input type = "text" name="estado" value="{{isset ($factura->estado)?$factura->estado:''}}" id="estado">
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