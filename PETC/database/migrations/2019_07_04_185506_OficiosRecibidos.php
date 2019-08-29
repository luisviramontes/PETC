<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class OficiosRecibidos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('OficiosRecibidos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('num_oficio')->unique();
            $table->string('nombre_oficio')->unique()->nullable();
            //$table->integer('id_dirigido')->unsigned()->nullable();
            //$table->foreign('id_dirigido')->references('id')->on('DirectorioExterno');
            $table->string('remitente');
            $table->string('asunto');
            $table->string('referencia')->nullable();
            $table->date('fecha_entrada');
            $table->date('fecha_respuesta')->nullable();
            $table->integer('id_contesta')->unsigned()->nullable();
            $table->foreign('id_contesta')->references('id')->on('directoriointerno');
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
        Schema::drop('OficiosRecibidos');
    }
}
