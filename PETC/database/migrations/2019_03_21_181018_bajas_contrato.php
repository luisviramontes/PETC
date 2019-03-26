<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class BajasContrato extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bajas_contrato', function (Blueprint $table) {
            $table->increments('id');
             $table->integer('id_captura')->unsigned();
            $table->foreign('id_captura')->references('id')->on('captura');
            $table->date('fecha_baja');
            $table->string('documentacion_entregada');
            $table->string('observaciones')->nullable();
            $table->string('estado');
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
        Schema::drop('bajas_contrato');
    }
}
