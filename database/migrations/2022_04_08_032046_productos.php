<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Productos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_cotizacion')->unsigned();
            $table->integer('id_catalogo_producto')->unsigned();
            $table->decimal('subtotal',10,2);
            $table->integer('cantidad');
            $table->integer('status')->default(1);
            $table->timestamps();
            $table->foreign('id_cotizacion')->references('id')->on('cotizaciones');
            $table->foreign('id_catalogo_producto')->references('id')->on('catalogo_productos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('productos');
    }
}
