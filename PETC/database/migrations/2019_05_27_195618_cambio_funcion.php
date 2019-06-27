<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CambioFuncion extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cambio_funcion', function (Blueprint $table) {
         $table->increments('id');
         $table->integer('id_captura')->unsigned();
         $table->foreign('id_captura')->references('id')->on('captura');
         $table->string('categoria_anterior');
         $table->string('categoria_nueva');
         $table->integer('clave')->unsigned();
         $table->foreign('clave')->references('id')->on('cat_puesto');     
         $table->date('fecha_inicio');
         $table->date('fecha_baja');
         $table->string('documentacion_entregada');
         $table->string('observaciones')->nullable();
         $table->string('captura');
         $table->string('estado');
         $table->integer('id_ciclo')->unsigned ();
         $table->foreign('id_ciclo')->references('id')->on('ciclo_escolar');
         $table->integer('id_cct_etc')->unsigned ();
         $table->foreign('id_cct_etc')->references('id')->on('centro_trabajo');
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
        Schema::drop('cambio_funcion');
    }
}
