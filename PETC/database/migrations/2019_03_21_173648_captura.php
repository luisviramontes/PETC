<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Captura extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('captura', function (Blueprint $table) {
            $table->increments('id_captura');
            $table->integer('id_personal')->unsigned();
            $table->foreign('id_personal')->references('id_personal')->on('personal');
            $table->integer('id_cct_etc')->unsigned ();
            $table->foreign('id_cct_etc')->references('id_centro_trabajo')->on('centro_trabajo');
            $table->string('sostenimiento');
            $table->string('categoria');
            $table->string('estado');
            $table->string('pagos_registrados');
            $table->string('qna_actual');
            $table->date('fecha_inicio');
            $table->date('fecha_termino');
            $table->string('dias_trabajados');
            $table->string('cct_2')->nullable();
            $table->string('documentacion_entregada');
            $table->string('observaciones')->nullable();
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
        Schema::drop('captura');
    }
}
