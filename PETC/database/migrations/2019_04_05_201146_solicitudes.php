<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Solicitudes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('solicitudes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('entrego_acta');
            $table->string('solicitud_inco');
            $table->string('nombre_escuela');
            $table->integer('id_cct')->unsigned();
            $table->foreign('id_cct')->references('id')->on('centro_trabajo');
            $table->integer('id_ciclo')->unsigned();
            $table->foreign('id_ciclo')->references('id')->on('ciclo_escolar');
            $table->integer('id_municipio')->unsigned();
            $table->foreign('id_municipio')->references('id')->on('municipios');
            $table->integer('id_localidad')->unsigned();
            $table->foreign('id_localidad')->references('id')->on('localidades');
            $table->string('domicilio');
            $table->string('nivel');
            $table->string('pnpsvd');
            $table->string('cnh');
            $table->string('carta_compromiso');
            $table->string('acta_constitutiva_cte');
            $table->string('acta_cps');
            $table->string('acta_ctcs');
            $table->string('tramite_estado');
            $table->string('estado');
            $table->string('captura');
            $table->date('fecha_recepcion');
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
        Schema::drop('solicitudes');
    }
}
