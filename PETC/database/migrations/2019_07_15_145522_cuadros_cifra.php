<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CuadrosCifra extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cuadros_cifra', function (Blueprint $table) {
            $table->increments('id'); 
            $table->integer('id_qna')->unsigned()->nullable();
            $table->foreign('id_qna')->references('id')->on('tabla_pagos');
            $table->string('sostenimiento');
            $table->string('categoria'); 
            $table->integer('total_reclamos');
            $table->double('total_deducciones');
            $table->double('total_liquido'); 
            $table->double('total_percepciones');
            $table->integer('id_ciclo')->unsigned()->nullable();
            $table->foreign('id_ciclo')->references('id')->on('ciclo_escolar');
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
        Schema::drop('cuadros_cifra');
    }
}
