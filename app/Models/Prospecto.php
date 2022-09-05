<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prospecto extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'nombre',
        'telefono',
        'celular',
        'correo',
        'tipo',
        'ubicacion',
        'medio_captacion',
        'status'
    ];

    protected $hidden = [
        'remember_token',
    ];
}
