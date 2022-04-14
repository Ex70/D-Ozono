<form action="{{url('/productos/'.$producto->id.'/update')}}" method="POST" enctype="multipart/form-data">
    @csrf
    {{method_field('PATCH')}}

    
    <label for="id_cotizacion"># cotizacion</label>
    <input type="text" name="id_cotizacion" id="idcotizacion" value="{{$producto->id_cotizacion}}">
    <br>

    <label for="Nombre">Producto</label>
        
     <select name="id_catalogo_producto" id="catalogoproducto">
        @foreach($catalogos as $catalogo)
        <option value="{{$catalogo->id}}" {{$producto->id_catalogo_producto == $catalogo->id ? 'selected' : ''}}>{{$catalogo->descripcion}}</option>
        @endforeach
    </select> 
    
    <br>
    <label for="Nombre">Subtotal</label>
    <input type="text" name="subtotal" id="subtotal" value="{{$producto->subtotal}}">
    <br>
    <label for="Nombre">Cantidad</label>
     <input type="text" name="cantidad" id="cantidad" value="{{$producto->cantidad}}">
    <br>
   
    <br>
    <input type="submit" value="Enviar">
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