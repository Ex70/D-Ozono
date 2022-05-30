<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Model;
//use Illuminate\Foundation\Auth\User as Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Usuario extends Authenticatable
{
    use HasFactory;
    protected $guarded = ['id'];

    protected $fillable = [
        'nombre',
        'correo',
        'usuario',
        'password',
        'id_permiso',
        'status',
    ];

    protected $hidden = [
        'remember_token',
    ];

    public function getAuthPassword(){
        return $this->password;
    }

    public function permisos(){
        //Un usuario tiene un solo permiso
        return $this->belongsTo(Permiso::class,'id_permiso');
    }
}
