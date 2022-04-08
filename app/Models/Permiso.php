<?php

namespace App\Models;

use App\Models\Usuario;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permiso extends Model
{
    use HasFactory;

    //Definición de tabla a la cuál consultar
    // protected $table = 'permisos';

    //Definición de los atributos que serán manipulables en la BD
    protected $fillable = [
        'descripcion',
        'status',
    ];

    //Función (tabla a relacionar)
    public function usuarios()
    {
        //Un permiso tiene muchos usuarios
        return $this->hasMany(Usuario::class,'id');
    }
}
