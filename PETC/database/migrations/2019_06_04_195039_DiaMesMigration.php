<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DiaMesMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dia_mes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('mes');
            $table->string('dia');
            $table->string('dia_semana');
            $table->string('l_semana');
            $table->string('año');
            $table->string('ciclo');
            $table->string('tipo_dia');
            $table->string('captura');
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
        Schema::drop('dia_mes');
    }
}
