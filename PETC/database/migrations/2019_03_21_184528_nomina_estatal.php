<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class NominaEstatal extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nomina_estatal', function (Blueprint $table) {
            $table->increments('id__nomina_estatal');
            $table->integer('bco');
            $table->integer('num_cheque');
            $table->integer('num_empleado');
            $table->foreign('rfc')->references('rfc')->on('personal');
            $table->string('nombre');
            $table->string('cve');
            $table->string('plaza');
            $table->string('contrato');
            $table->string('cct');
            $table->integer('region');
            $table->double('perc');
            $table->double('ded');
            $table->double('neto');
            $table->string('qna_ini');
            $table->string('qna_fin');
            $table->string('qna_pago');
            $table->string('ciclo_escolar');
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
        Schema::drop('nomina_estatal');
    }
}
