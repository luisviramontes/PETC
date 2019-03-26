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
            $table->string('qnas_reintegrar');
            $table->integer('dias_reintegrar');
            $table->string('motivo');
            $table->double('total_de_reintegro');
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
