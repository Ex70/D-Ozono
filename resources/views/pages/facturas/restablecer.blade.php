<table class="table table-light">
    <thead class="thead-light">
        <tr>
            <th>#</th>
             <th>rfc</th>
             <th>razon social </th>
             <th>cfdi</th>
             <th>calle</th>
             <th>numero interior</th>
             <th>numero exterior</th>
             <th>colonia</th>
             <th>codigo postal</th>
             <th>municipio</th>
             <th>estado</th>
             <th> Acciones </th> 
            

        </tr>
    </thead>
    <tbody>
        @foreach($facturas as $factura)
        <tr>
            <td>{{$factura->id}}</td>
            <td>{{$factura->rfc}}</td>
            <td>{{$factura->razon_social}}</td>
            <td>{{$factura->cfdi}}</td>
            <td>{{$factura->calle}}</td>
            <td>{{$factura->numero_interior}}</td>
            <td>{{$factura->numero_exterior}}</td>
            <td>{{$factura->colonia}}</td>
            <td>{{$factura->codigo_postal}}</td>
            <td>{{$factura->municipio}}</td>
            <td>{{$factura->estado}}</td>
          
        </tr>
    @endforeach
    </tbody>
</table>