<form action="{{url('/catalogo')}}" method="POST" enctype="multipart/form-data">
    @csrf
    <label for="Nombre">Categoria</label>
    {{-- Creación de un select, para mostrar todos los permisos en opciones desplegables --}}
    <select name="id_categoria_producto" id="Catalogo">
        @foreach($categorias as $categoria)
        {{-- Valor id, texto a mostrar, la descripción --}}
        <option value="{{$categoria->id}}">{{$categoria->descripcion}}</option>
        @endforeach
    </select>
    <br>
    <label for="Nombre">Descripcion</label>
    <input type="text" name="descripcion" id="descripcion">
    <br>
    <label for="Nombre">Clave</label>
    <input type="text" name="clave" id="clave">
    <br>
    <label for="Nombre">Precio Unidad</label>
    <input type="text" name="precio_unidad" id="precio">
    <br>
    <label for="Nombre">Garantia</label>
    <input type="text" name="garantia" id="garantia">

    <br>
    
    {{-- <input type="text" name="id_permiso" id="id_permiso"> --}}
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