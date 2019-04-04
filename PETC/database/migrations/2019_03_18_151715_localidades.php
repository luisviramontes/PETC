<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Localidades extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('localidades', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_municipio')->unsigned();
            $table->foreign('id_municipio')->references('id')->on('municipios'); 
            $table->string('nom_loc')->nullable();
            $table->string('longitud')->nullable(); 
            $table->string('latitud')->nullable(); 
            $table->string('altitud')->nullable(); 
            $table->string('pobtot')->nullable(); 
            $table->string('pobmas')->nullable(); 
            $table->string('pobfem')->nullable(); 
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
        Schema::drop('localidades');
    }
}
