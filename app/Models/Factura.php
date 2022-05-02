<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Factura extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'rfc',
        'id_cliente',
        'razon_social',
        'cfdi',
        'calle',
        'numero_interior',
        'numero_exterior',
        'colonia',
        'codigo_postal',
        'municipio',
        'estado',
    ];
    protected $hidden = [
       'remember_token',
    ];        

    public function clientes()
    {
       return $this->belongsTo(Cliente::class,'id_cliente');
    }
}
