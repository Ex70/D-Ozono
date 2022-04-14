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
         'estado'];

     public function clientes()
    {
        return $this ->hasMany(Clientes::class,'id');
    }

}
