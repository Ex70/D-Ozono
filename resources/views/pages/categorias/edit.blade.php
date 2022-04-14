editar categorias
<form action="{{url('/categorias/'.$categoria->id)}}" method="post" >
  @csrf
  {{method_field('PATCH')}}
@include('categorias.form')
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