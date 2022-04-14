crear categorias

<form action="{{url('/categorias')}}" method="post" enctype="multipart/form-data"> 
@csrf
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