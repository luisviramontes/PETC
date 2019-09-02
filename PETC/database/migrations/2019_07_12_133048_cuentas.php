<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Cuentas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cuentas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->string('num_cuenta');
            $table->string('clave_in');
            $table->string('secretaria');
            $table->integer('id_banco')->unsigned();
            $table->foreign('id_banco')->references('id')->on('bancos');
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
        Schema::drop('cuentas');
    }
}
