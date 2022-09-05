<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateProspectosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prospectos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->string('telefono',10);
            $table->string('celular',10);
            $table->string('correo')->unique();
            $table->string('tipo');
            $table->string('ubicacion');
            $table->string('medio_captacion')->nullable();
            $table->integer('status')->default(1);
            $table->timestamps();
        });
        DB::update("ALTER TABLE prospectos AUTO_INCREMENT = 10001;");

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('prospectos');
    }
}
