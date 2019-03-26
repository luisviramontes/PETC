<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CentroTrabajo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('centro_trabajo', function (Blueprint $table) {
            $table->increments('id_centro_trabajo');
            $table->string('cct');
            $table->string('nombre_escuela');
            $table->string('domicilio');
            $table->string('localidad');
            $table->string('municipio');
            $table->integer('region');
            $table->string('captura');
            //$table->foreign('id_director')->references('id_personal')->on('personal');
            $table->integer('telefono')->nullable();
            $table->string('email')->nullable();
            $table->string('ciclo_escolar');
            $table->string('entrego_carta');
            $table->string('alimentacion');
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
        Schema::drop('centros_tabla');
    }
}