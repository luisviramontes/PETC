<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DatosCentroTrabajo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('datos_centro_trabajo', function (Blueprint $table) {
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
            $table->date('fecha_ingreso');
            $table->date('fecha_baja');
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
        Schema::drop('datos_centro_trabajo');
    }
}
