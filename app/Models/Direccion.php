<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Direccion extends Model
{
    use HasFactory;
     protected $table= 'direcciones';
     protected $fillable =[
         'calle',
         'numero_interior',
         'numero_exterior',
         'colonia',
         'codigo_postal',
         'municipio',
         'estado',
        'id_cliente'];
    protected $hidden =[
         'remember_token'
    ];

     public function clientes()
    {
        return $this ->belongsTo(Cliente::class,'id_cliente');
    }

}
