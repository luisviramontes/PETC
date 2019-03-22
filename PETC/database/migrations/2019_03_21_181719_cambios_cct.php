<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CambiosCct extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cambios_cct', function (Blueprint $table) {
            $table->increments('id_cambios_cct');
            $table->integer('id_captura')->unsigned();

            $table->foreign('id_captura')->references('id_captura')->on('captura');
            $table->date('fecha_cambio');
            $table->string('documentacion_entregada');
            $table->string('observaciones')->nullable();
            $table->string('captura');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('cambios_cct');
    }
}
