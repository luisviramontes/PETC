<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class OficiosEmitidos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('OficiosEmitidos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('num_oficio')->unique();
            $table->string('nombre_oficio')->unique();
            $table->integer('id_respuesta')->unsigned()->nullable();
            $table->foreign('id_respuesta')->references('id')->on('OficiosRecibidos');
            $table->integer('id_dirigido')->unsigned()->nullable();
            $table->foreign('id_dirigido')->references('id')->on('DirectorioExterno');
            $table->string('asunto');
            $table->string('referencia')->nullable();
            $table->date('salida');
            $table->integer('id_elabora')->unsigned()->nullable();
            $table->foreign('id_elabora')->references('id')->on('directoriointerno'); 
            $table->string('observaciones')->nullable();
            $table->string('archivo')->nullable();
            $table->string('estado');
            $table->string('captura');
            $table->integer('id_ciclo')->unsigned()->nullable();
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
        Schema::drop('OficiosEmitidos');
    }
}
