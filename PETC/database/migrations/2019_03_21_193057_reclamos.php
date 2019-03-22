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
            $table->increments('id_reclamos');
            $table->foreign('id_captura')->references('id_captura')->on('captura');
            $table->string('qnas_reclamo');
            $table->integer('dias_reclamo');
            $table->date('periodo_inicial');
            $table->date('periodo_final');
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
        Schema::drop('reclamos');
    }
}
