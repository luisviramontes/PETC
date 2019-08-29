<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Municipios extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('municipios', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_region')->unsigned();
            $table->foreign('id_region')->references('id')->on('region');
            $table->string('municipio');
            $table->string('cabecera');
            $table->string('fecha_creacion');
            $table->string('poblacion');
            $table->integer('area_km');
            $table->string('estado');   
            $table->string('capturo');   
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
        Schema::drop('municipios');
    }
}
