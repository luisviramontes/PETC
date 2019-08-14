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
            $table->increments('id');
            $table->string('cct')->unique();
            $table->string('nombre_escuela');
            $table->string('domicilio');
            //$table->string('localidad');
            //$table->string('municipio');
            //$table->integer('region');
            $table->integer('id_region')->unsigned();
            $table->foreign('id_region')->references('id')->on('region');
            $table->integer('id_localidades')->unsigned();
            $table->foreign('id_localidades')->references('id')->on('localidades');
            $table->integer('id_municipios')->unsigned();
            $table->foreign('id_municipios')->references('id')->on('municipios');
            //$table->string('sostenimiento');
            $table->string('captura');
            //$table->foreign('id_director')->references('id_personal')->on('personal');
            $table->integer('telefono')->nullable();
            $table->string('email')->nullable();
            $table->string('ciclo_escolar');
            $table->string('entrego_carta');
            $table->string('alimentacion');
            $table->string('tipo_organizacion');
            $table->string('nivel');
            $table->string('estado');
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
