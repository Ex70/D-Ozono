<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CatalogoProductos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('catalogo_productos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_categoria_producto')->unsigned();
            $table->string('descripcion')->unique();
            $table->string('clave',50);
            $table->decimal('precio_unitario',10,2);
            $table->string('garantia',50);
            $table->integer('status')->default(1);
            $table->timestamps();
            $table->foreign('id_categoria_producto')->references('id')->on('categorias_productos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('catalogo_productos');
    }
}
