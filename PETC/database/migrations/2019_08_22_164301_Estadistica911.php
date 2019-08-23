<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Estadistica911 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Estadistica911', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('total_alumnos');
            $table->integer('total_ninas');
            $table->integer('total_ninos');
            $table->integer('total_grupos');
            $table->integer('total_grados');
            $table->integer('total_directores');
            $table->integer('total_docentes');
            $table->integer('total_fisica');
            $table->integer('total_usaer');
            $table->integer('total_artistica');
            $table->integer('total_intendentes');
            $table->integer('id_centro_trabajo')->unsigned();
            $table->foreign('id_centro_trabajo')->references('id')->on('centro_trabajo');
            $table->integer('id_ciclo')->unsigned ();
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
        Schema::drop('Estadistica911');
    }
}
