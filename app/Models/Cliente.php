<?php

namespace App\Models;

use App\Models\Direccion;
use App\Models\Factura;
use App\Models\Cotizacion;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
   use HasFactory;
   
   protected $fillable = [
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

   public function facturas(){
      return $this->hasMany(Factura::class,'id');
   }

   public function direcciones(){
      return $this->hasMany(Direccion::class,'id');
   }

   public function cotizaciones(){
      return $this->hasMany(Cotizacion::class,'id');
   }
}
