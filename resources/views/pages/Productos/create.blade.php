<form action="{{url('/productos')}}" method="POST" enctype="multipart/form-data">
    @csrf
 <label for="id_cotizacion"># cotizacion</label>
    <input type="text" name="id_cotizacion" id="idcotizacion" value={{$idcotizacion}}>
    <br>

    <label for="Nombre">Producto</label>
        
     <select name="id_catalogo_producto" id="catalogoproducto">
        @foreach($catalogos as $catalogo)
        <option value="{{$catalogo->id}}">{{$catalogo->descripcion}}</option>
        @endforeach
    </select>    
    <br>
    <label for="Nombre">Subtotal</label>
    <input type="text" name="subtotal" id="subtotal" value="{{old('subtotal')}}">
      @if($errors->has('subtotal'))
        <span for="input-subtotal">{{ $errors->first('subtotal')}}</span>
       @endif
    <br>
    <label for="Nombre">Cantidad</label>
     <input type="text" name="cantidad" id="cantidad" value="{{old('cantidad')}}">
      @if($errors->has('cantidad'))
        <span for="input-cantidad">{{ $errors->first('cantidad')}}</span>
      @endif
    <br>
   
    <br>
    <input type="submit" value="Enviar">
</form>