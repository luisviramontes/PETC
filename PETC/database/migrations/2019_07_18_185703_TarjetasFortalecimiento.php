<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TarjetasFortalecimiento extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('TarjetasFortalecimiento', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_fortalecimiento')->unsigned()->nullable();
            $table->foreign('id_fortalecimiento')->references('id')->on('fortalecimiento');
            $table->string('TSL')->nullable();
            $table->integer('num_tarjeta')->unique();
            $table->string('producto')->nullable();
            $table->string('empresa')->nullable();
            $table->string('observaciones')->nullable();
            $table->string('captura')->nullable();
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
        Schema::drop('TarjetasFortalecimiento');
    }
}
