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
            $table->increments('id');
            $table->string('nombre');
            $table->string('rfc')->index();
            $table->integer('telefono')->nullable();
            $table->string('email')->nullable();
            //$table->string('cct'); 
            $table->integer('clave')->unsigned();
            $table->foreign('clave')->references('id')->on('cat_puesto');            
            $table->integer('id_cct_etc')->unsigned ();
            $table->foreign('id_cct_etc')->references('id')->on('centro_trabajo');
            $table->string('sostenimiento');
            $table->string('categoria');
            $table->string('estado');
            $table->string('pagos_registrados');
            $table->string('qna_actual');
            $table->date('fecha_inicio');
            $table->date('fecha_termino');
            $table->string('dias_trabajados')->nullable();
            $table->integer('num_escuelas')->nullable();
            $table->string('cct_2')->nullable();
            $table->string('documentacion_entregada')->nullable();
            $table->string('observaciones')->nullable();
            $table->integer('id_ciclo')->unsigned ();
            $table->foreign('id_ciclo')->references('id')->on('ciclo_escolar');
            $table->string('captura');
            $table->string('tipo_movimiento');
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
