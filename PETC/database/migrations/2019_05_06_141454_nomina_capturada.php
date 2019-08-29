<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class NominaCapturada extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nomina_capturada', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('qna');
            $table->integer('id_ciclo')->unsigned()->nullable();
            $table->foreign('id_ciclo')->references('id')->on('ciclo_escolar');
            $table->string('sostenimiento');
            $table->string('estado');
            $table->string('tipo');
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
        Schema::drop('nomina_capturada');
    }
}
