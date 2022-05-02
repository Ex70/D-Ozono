<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_cotizacion',
        'id_catalogo_producto',
        'subtotal',
        'cantidad',
        'status',
    ];

    protected $hidden =[
        'remember_token'
    ];

    public function cotizaciones(){
        return $this->belongsTo(Cotizacion::class,'id_cotizacion');
    }

    public function catalogos(){
        return $this->belongsTo(Catalogo:: class,'id_catalogo_producto');

    }

}
