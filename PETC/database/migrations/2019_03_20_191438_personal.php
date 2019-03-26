<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Personal extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Personal', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->string('rfc')->index();
            $table->integer('telefono');
            $table->string('email');
            $table->string('cct');
            $table->integer('clave')->unsigned();
            $table->foreign('clave')->references('id')->on('cat_puesto');
            $table->string('sostenimiento');
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
        Schema::drop('personal_tabla');
    }
}
