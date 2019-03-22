<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Peronal extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personal', function (Blueprint $table) {
            $table->increments('id_personal');
            $table->string('nombre');
            $table->string('rfc');
            $table->integer('telefono');
            $table->string('email');
            $table->string('cct');
            $table->foreign('clave')->references('idcat_puesto')->on('cat_puesto');
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
