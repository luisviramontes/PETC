<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Bancos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bancos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre_banco');
            $table->integer('operacion');
            $table->string('descripcion');
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
        Schema::drop('bancos');
    }
}
