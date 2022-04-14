<form action="{{url('/clientes/'.$clientes->id.'/update')}}" method="POST" enctype="multipart/form-data">
    @csrf
    {{method_field('PATCH')}}
    <label for="Nombre">Nombre</label>
    <input type="text" name="nombre" id="nombre" value="{{$clientes->nombre}}">
    <br>
    <label for="Nombre">Telefono</label>
    <input type="text" name="telefono" id="telefono" value="{{$clientes->telefono}}">
    <br>
    <label for="Nombre">Celular</label>
    <input type="text" name="celular" id="celular" value="{{$clientes->celular}}">
    <br>
    <label for="Nombre">Correo</label>
    <input type="text" name="correo" id="correo" value="{{$clientes->correo}}">
    <br>
    <label for="Nombre">Tipo</label>
    <input type="text" name="tipo" id="tipo" value="{{$clientes->tipo}}">
    <br>
    <label for="Nombre">Ubicacion</label>
    <input type="text" name="ubicacion" id="ubicacion" value="{{$clientes->ubicacion}}">
    <br>
    <label for="Nombre">Medio de captacion</label>
    <input type="text" name="medio_captacion" id="medio_captacion" value="{{$clientes->medio_captacion}}">
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