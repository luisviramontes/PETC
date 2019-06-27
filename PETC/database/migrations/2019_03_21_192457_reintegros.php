<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Reintegros extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reintegros', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_captura')->unsigned();
            $table->foreign('id_captura')->references('id')->on('captura');
            $table->integer('id_centro_trabajo')->unsigned();
            $table->foreign('id_centro_trabajo')->references('id')->on('centro_trabajo');
            $table->integer('id_directorio_regional')->unsigned();
            $table->foreign('id_directorio_regional')->references('id')->on('directorio_regional');
            $table->integer('id_ciclo_escolar')->unsigned();
            $table->foreign('id_ciclo_escolar')->references('id')->on('ciclo_escolar');
            $table->integer('num_dias');
            $table->string('categoria');
            $table->integer('total');
            $table->string('n_oficio');
            $table->string('motivo');
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
        Schema::drop('reintegros');
    }
}
