<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CapacitacionesMigrate extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Capacitaciones', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre_capacitacion')->nullable();
            $table->string('dirigido')->nullable();
            $table->string('lugar')->nullable();
            $table->date('dia')->nullable();
            $table->string('hora')->nullable();
            $table->string('imparte')->nullable();
            $table->string('area')->nullable();
            $table->string('motivo')->nullable();
            $table->string('descripcion')->nullable();

            $table->integer('id_ciclo')->unsigned();
            $table->foreign('id_ciclo')->references('id')->on('ciclo_escolar');
            $table->string('estado')->nullable();
            $table->string('captura')->nullable();
            $table->string('archivo')->nullable();
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
        Schema::drop('Capacitaciones');
    }
}
