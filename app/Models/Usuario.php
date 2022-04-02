<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Model;

class Usuario extends Model
{
    protected $guarded = ['id'];

    protected $hidden = [
        'password','remember_token',
    ];

    public function getAuthPassword(){
        return $this->password;
    }
}
