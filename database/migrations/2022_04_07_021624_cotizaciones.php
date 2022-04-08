<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Cotizaciones extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cotizaciones', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_cliente')->unsigned();
            $table->string('tipo',50);
            $table->date('fecha');
            $table->text('notas');
            $table->string('tipo_pago',50);
            $table->string('tiempo_entrega',50);
            $table->string('vigencia',50);
            $table->text('condiciones');
            $table->decimal('total',10,2);
            $table->integer('descuento');
            $table->integer('descuento_especial');
            $table->integer('status')->default(1);
            $table->timestamps();
            $table->foreign('id_cliente')->references('id')->on('clientes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cotizaciones');
    }
}
