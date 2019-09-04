<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AvisosMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Avisos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre_aviso')->nullable();
            $table->string('dirigido')->nullable();
            $table->date('fecha_emite')->nullable();
            $table->string('area')->nullable();
            $table->string('motivo')->nullable();
            $table->string('descripcion')->nullable();
            $table->integer('id_ciclo')->unsigned();
            $table->foreign('id_ciclo')->references('id')->on('ciclo_escolar');
            $table->string('estado')->nullable();
            $table->string('captura')->nullable();
            $table->string('archivo')->nullable();
            $table->string('imagen')->nullable();
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
        Schema::drop('Avisos');
    }
}
