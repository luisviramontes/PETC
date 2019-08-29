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
            $table->increments('id');
            $table->integer('id_captura')->unsigned();
            $table->foreign('id_captura')->references('id')->on('captura');
            $table->integer('id_cct_anterior')->unsigned();
            $table->foreign('id_cct_anterior')->references('id')->on('centro_trabajo');
            $table->integer('id_cct_nuevo')->unsigned();
            $table->foreign('id_cct_nuevo')->references('id')->on('centro_trabajo');
            $table->integer('clave')->unsigned();
            $table->foreign('clave')->references('id')->on('cat_puesto');     
            $table->string('categoria');
            $table->date('fecha_inicio');
            $table->date('fecha_baja');
            $table->string('documentacion_entregada');
            $table->string('observaciones')->nullable();
            $table->string('captura');
            $table->string('estado');
            $table->integer('id_ciclo')->unsigned ();
            $table->foreign('id_ciclo')->references('id')->on('ciclo_escolar');
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
