<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ExtencionContrato extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('extencion_contrato', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_captura')->unsigned();
            $table->foreign('id_captura')->references('id')->on('captura');
            $table->date('fecha_inicio');
            $table->date('fecha_baja');
            $table->integer('clave')->unsigned();
            $table->foreign('clave')->references('id')->on('cat_puesto');            
            $table->integer('id_cct_etc')->unsigned ();
            $table->foreign('id_cct_etc')->references('id')->on('centro_trabajo');
            $table->string('categoria');
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
        Schema::drop('extencion_contrato');
    }
}
