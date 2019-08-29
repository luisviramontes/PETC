<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class BajasContrato extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bajas_contrato', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_captura')->unsigned();
            $table->foreign('id_captura')->references('id')->on('captura');
            $table->integer('id_alta')->unsigned()->nullable();
            $table->foreign('id_alta')->references('id')->on('captura');           
            $table->integer('id_cct_etc')->unsigned ()->nullable();
            $table->foreign('id_cct_etc')->references('id')->on('centro_trabajo');
            $table->date('fecha_baja');
            $table->string('documentacion_entregada');
            $table->string('observaciones')->nullable();
            $table->string('estado');
            $table->string('captura');
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
        Schema::drop('bajas_contrato');
    }
}
