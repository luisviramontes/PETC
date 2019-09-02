<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class QuejasMigrate extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quejas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_centro_trabajo')->unsigned();
            $table->foreign('id_centro_trabajo')->references('id')->on('centro_trabajo');
            $table->integer('id_ciclo')->unsigned();
            $table->foreign('id_ciclo')->references('id')->on('ciclo_escolar');
            $table->string('nombre_d');
            $table->string('telefono_')->nullable();
            $table->string('ocupacion')->nullable();
            $table->string('nombre_q')->nullable();
            $table->string('puesto_q')->nullable();
            $table->string('motivo')->nullable();
            $table->string('descripcion')->nullable();
            $table->date('fecha')->nullable();
            $table->string('estado')->nullable();
            $table->string('captura')->nullable();
             $table->string('archivo')->nullable();
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
        Schema::drop('quejas');
    }
}
