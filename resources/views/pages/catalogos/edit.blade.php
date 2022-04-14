<form action="{{url('/catalogo/'.$catalogo->id.'/update')}}" method="POST" enctype="multipart/form-data">
    @csrf
    {{method_field('PATCH')}}
        
    <label for="Nombre">Categoria</label>
    <select name="id_categoria_producto" id="Categoria">
        @foreach($categorias as $categoria)
        <option value="{{$categoria->id}}" {{$categoria->id_categoria_producto == $categoria->id ? 'selected' : ''}}>{{$categoria->descripcion}}</option>
        @endforeach
     </select>
    <br>
    <label for="Nombre">Descripcion</label>
    <input type="text" name="descripcion" id="descripcion" value="{{$catalogo->descripcion}}">
    <br>
    <label for="Nombre">Clave</label>
    <input type="text" name="clave" id="clave" value="{{$catalogo->clave}}">
    <br>
    <label for="Nombre">Precio Unidad</label>
    <input type="text" name="precio_unidad" id="precio" value="{{$catalogo->precio_unidad}}">
    <br>
    <label for="Nombre">Garantia</label>
    <input type="text" name="garantia" id="garantia" value="{{$catalogo->garantia}}">
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