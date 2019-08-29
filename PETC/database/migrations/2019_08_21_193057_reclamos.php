<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Reclamos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reclamos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_captura')->unsigned();
            $table->foreign('id_captura')->references('id')->on('captura');
            $table->integer('id_ciclo')->unsigned();
            $table->foreign('id_ciclo')->references('id')->on('ciclo_escolar');
            $table->integer('total_dias'); 
            $table->string('motivo');
            $table->date('periodo_inicial');
            $table->date('periodo_final');
            $table->string('total_reclamo');
            $table->string('observaciones')->nullable();
            $table->string('estado');
            $table->string('captura');
            $table->string('oficio');
            $table->integer('id_oficio')->unsigned();
            $table->foreign('id_oficio')->references('id')->on('OficiosEmitidos');
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
        Schema::drop('reclamos');
    }
}
