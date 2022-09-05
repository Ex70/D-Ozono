<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cotizacion extends Model
{

    use HasFactory;
     protected $table= 'cotizaciones';
     protected $fillable = [
        'tipo',
        'fecha',
        'tipo_pago',
        'tiempo_entrega',
        'vigencia',
        'garantia',
        'condiciones',
        'total',
        'descuento',
        'descuento_especial',
        'status',
        'id_cliente'
    ];
    protected $hidden = [
        'remember_token',
     ];

     public function clientes()
     {
         return $this->belongsTo(Cliente::class,'id_cliente');
     }

}
