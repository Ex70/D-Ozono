<form action="{{url('/cotizacion/'.$cotizacion->id.'/update')}}" method="POST" enctype="multipart/form-data">
    @csrf
    {{method_field('PATCH')}}
     <label for="Nombre">Cliente</label>
    
     <select name="id_cliente" >
        @foreach($clientes as $cliente)
       <option value="{{$cliente->id}}"{{$cotizacion->id_cliente==$cliente->id ? 'selected' : ''}}>{{$cliente->nombre}}</option>  
       @endforeach
    </select>
    </br>
    <label for="Nombre">Tipo</label>
    <input type="text" name="tipo" id="tipo" value="{{$cotizacion->tipo}}">
    <br>
    <label for="Nombre">Fecha</label>
    <input type="text" name="Fecha" id="Fecha" value="{{$cotizacion->fecha}}">
    <br>
    <label for="Nombre">Notas</label>
    <input type="text" name="notas" id="notas" value="{{$cotizacion->notas}}">
    <br>
    <label for="Nombre">Tipo Pago</label>
    <input type="text" name="tipo_pago" id="tipo_pago" value="{{$cotizacion->tipo_pago}}">
    <br>
    <label for="Nombre">Tiempo Entrega</label>
    <input type="text" name="tiempo_entrega" id="tiempo_entrega" value="{{$cotizacion->tiempo_entrega}}">
    <br>
    <label for="Nombre">Vigencia</label>
    <input type="text" name="vigencia" id="vigencia" value="{{$cotizacion->vigencia}}">
    <br>
    <label for="Nombre">Condiciones</label>
    <input type="text" name="condiciones" id="condiciones" value="{{$cotizacion->condiciones}}">
    <br>
    <label for="Nombre">Total</label>
    <input type="text" name="total" id="total" value="{{$cotizacion->total}}">
    <br>
    <label for="Nombre">Descuento</label>
    <input type="text" name="descuento" id="descuento" value="{{$cotizacion->descuento}}">
    <br>
    <label for="Nombre">Descuento Especial</label>
    <input type="text" name="descuento_especial" id="descuento" value="{{$cotizacion->descuento_especial}}">
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