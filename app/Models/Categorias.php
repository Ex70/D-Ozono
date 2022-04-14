<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

    class Categorias extends Model
{
    use HasFactory;
     protected $table= 'categorias_productos';
     protected $fillable =['descripcion'];

 public function catalogo()
    {
        //Una categoria  va asignada a muchos catalogos 
        return $this->hasMany(Catalogo::class,'id');
    }

}