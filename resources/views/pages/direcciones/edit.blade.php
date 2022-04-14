<form action="{{url('/direcciones/'.$direccion->id.'/update')}}" method="POST" enctype="multipart/form-data">
    @csrf
    {{method_field('PATCH')}}

<label for="calle">Calle</label>
<input type = "text" name="calle" value="{{$direccion->calle}}" id="calle">
<br>

<label for="numero_interior">Numero Interior</label>
<input type = "text" name="numero_interior" value="{{$direccion->numero_interior}}" id="numero_interior">
<br>

<label for="numero_exterior">Numero Exterior </label>
<input type = "text" name="numero_exterior" value="{{$direccion->numero_exterior}}" id="numero_exterior">
<br>

<label for="colonia">Colonia</label>
<input type = "text" name="colonia" value="{{$direccion->colonia}}" id="colonia">
<br>

<label for="codigo_postal">Codigo Postal</label>
<input type = "text" name="codigo_postal" value="{{$direccion->codigo_postal}}" id="codigo_postal">
<br>

<label for="municipio">Municipio</label>
<input type = "text" name="municipio" value="{{$direccion->municipio}}" id="municipio">
<br>

<label for="estado">Estado</label>
<input type = "text" name="estado" value="{{$direccion->estado}}" id="estado">
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