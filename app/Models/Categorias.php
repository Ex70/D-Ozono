<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

 class Categorias extends Model
{
    use HasFactory;
    
     protected $table = 'categorias_productos';
     protected $fillable =[
         'descripcion',
         'status',
    ];

    protected $hidden = [
         'remember_token',
    ];


}