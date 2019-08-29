<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DirectorioExterno extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('DirectorioExterno', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre')->nullable();
            $table->string('apellido1')->nullable();
            $table->string('apellido2')->nullable();
            $table->string('nombre_c')->nullable();
            $table->string('a_n')->nullable();
            $table->string('lic')->nullable();
            $table->string('puesto')->nullable();
            $table->string('direccion')->nullable();
            $table->string('a_d')->nullable();
            $table->string('correo')->nullable();
            $table->string('ext')->nullable();
            $table->string('captura')->nullable();
            $table->string('estado')->nullable();
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
        Schema::drop('DirectorioExterno');
    }
}
