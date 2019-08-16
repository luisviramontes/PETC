<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DirectorioInternoMigrate extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('DirectorioInterno', function (Blueprint $table) {
            $table->increments('id');            
            $table->string('nombre');
            $table->string('abrebiatura')->nullable();
            $table->string('rfc')->nullable();
            $table->string('curp')->nullable();
            $table->date('fecha_nacimiento');
            $table->string('telefono')->nullable();
            $table->string('email')->nullable();
            $table->string('domicilio')->nullable();
            $table->string('num_seguro')->nullable();
            $table->string('lic')->nullable();
            $table->string('licenciatura')->nullable();
            $table->date('fecha_ingreso')->nullable();
            $table->date('fecha_salida')->nullable();
            $table->string('imagen')->nullable();
            $table->string('area')->nullable();
            $table->string('puesto')->nullable();
            $table->string('tipo')->nullable();
            $table->string('sueldo_mensual')->nullable();
            $table->string('deducciones')->nullable();
            $table->string('neto')->nullable();
            $table->string('capturo');
            $table->string('estado');
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
        Schema::drop('DirectorioInterno');
    }
}
