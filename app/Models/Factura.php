<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Factura extends Model
{
    use HasFactory;
     protected $table= 'facturas';
     protected $fillable =['rfc','razon_social','cfdi','calle','numero_interior','numero_exterior','colonia','codigo_postal','municipio','estado'];
}
