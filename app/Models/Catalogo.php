<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;



class Catalogo extends Model
{
    use HasFactory;
    protected $table ='catalogo_productos';
     protected $fillable =[
    'id_categoria_producto', 
     'descripcion',
     'clave',
     'precio_unitario',
     'garantia',
     'status'    
    ];
    
     protected $hidden = [
         'remember_token',
    ];

public function categorias(){
        //Un categoria tiene muchos productos 
        return $this->belongsTo(Categorias::class,'id_categoria_producto');
    }


}
