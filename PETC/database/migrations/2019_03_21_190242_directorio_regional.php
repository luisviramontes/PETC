<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DirectorioRegional extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('directorio_regional', function (Blueprint $table) {
            $table->increments('id'); 
            //$table->integer('region');
            //$table->string('sostenimiento');
            $table->integer('id_region')->unsigned();
            $table->foreign('id_region')->references('id')->on('region');            
            $table->string('nombre_enlace');
            $table->integer('telefono')->nullable();
            $table->integer('ext1_enlace')->nullable();
            $table->integer('ext2_enlace')->nullable();
            $table->string('correo_enlace')->nullable();
            $table->string('director_regional');
            $table->integer('telefono_director')->nullable();
            $table->string('financiero_regional');
            $table->integer('telefono_regional')->nullable();
            $table->integer('ext_reg_1')->nullable();
            $table->integer('ext_reg_2')->nullable();
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
        Schema::drop('directorio_regional');
    }
}
