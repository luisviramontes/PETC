<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DirectorCCT extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    { 
        Schema::create('Director_CCT', function (Blueprint $table) { 
        $table->increments('id');
         $table->integer('id_captura')->unsigned()->nullable();
         $table->foreign('id_captura')->references('id')->on('captura');  
         $table->date('fecha_inicio');
         $table->date('fecha_baja');
         $table->string('documentacion_entregada')->nullable();
         $table->string('observaciones')->nullable();
         $table->string('captura');
         $table->string('estado');
         $table->integer('id_ciclo')->unsigned ();
         $table->foreign('id_ciclo')->references('id')->on('ciclo_escolar');
         $table->integer('id_cct_etc')->unsigned ();
         $table->foreign('id_cct_etc')->references('id')->on('centro_trabajo');
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
        Schema::drop('Director_CCT');
    }
}
