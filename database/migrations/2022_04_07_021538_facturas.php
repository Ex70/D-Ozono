<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Facturas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('facturas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_cliente')->unsigned();
            $table->string('rfc',20);
            $table->string('razon_social');
            $table->string('cfdi',4)->unique();
            $table->string('calle');
            $table->string('numero_interior',5);
            $table->string('numero_exterior',5);
            $table->string('colonia');
            $table->integer('codigo_postal');
            $table->string('municipio');
            $table->string('estado');
            $table->integer('status')->default(1);
            $table->rememberToken();
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
        Schema::dropIfExists('facturas');
    }
}
