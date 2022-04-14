<form action="{{url('/cotizacion')}}" method="POST" enctype="multipart/form-data">
    @csrf

     <label for="Nombre">Cliente</label>
    {{-- Creación de un select, para mostrar todos los permisos en opciones desplegables --}}
    <select name="id_cliente" >
        @foreach($clientes as $cliente)
        {{-- Valor id, texto a mostrar, la descripción --}}
        <option value="{{$cliente->id}}">{{$cliente->nombre}}</option>
        @endforeach
    </select>
    </br>
    <label for="Nombre">Tipo</label>
    <input type="text" name="tipo" id="tipo">
    <br>
    <label for="Nombre">Fecha</label>
    <input type="text" name="Fecha" id="Fecha">
    <br>
    <label for="Nombre">Notas</label>
    <input type="text" name="notas" id="notas">
    <br>
    <label for="Nombre">Tipo Pago</label>
    <input type="text" name="tipo_pago" id="tipo_pago">
    <br>
    <label for="Nombre">Tiempo Entrega</label>
    <input type="text" name="tiempo_entrega" id="tiempo_entrega">
    <br>
    <label for="Nombre">Vigencia</label>
    <input type="text" name="vigencia" id="vigencia">
    <br>
    <label for="Nombre">Condiciones</label>
    <input type="text" name="condiciones" id="condiciones">
    <br>
    <label for="Nombre">Total</label>
    <input type="text" name="total" id="total">
    <br>
    <label for="Nombre">Descuento</label>
    <input type="text" name="descuento" id="descuento">
    <br>
    <label for="Nombre">Descuento Especial</label>
    <input type="text" name="descuento_especial" id="descuento">
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