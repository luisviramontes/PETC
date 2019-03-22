<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ExtencionContrato extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('extencion_contrato', function (Blueprint $table) {
            $table->increments('id_extencion_contrato');
            $table->foreign('id_captura')->references('id_captura')->on('captura');
            $table->date('fecha_inicial');
            $table->date('fecha_final');
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
        Schema::drop('extencion_contrato');
    }
}
