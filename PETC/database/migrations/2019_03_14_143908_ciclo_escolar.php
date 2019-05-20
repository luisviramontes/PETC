<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CicloEscolar extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ciclo_escolar', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ciclo');
            $table->integer('dias_habiles');
            $table->date('inicio_ciclo');
            $table->date('fin_ciclo');
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
        Schema::drop('ciclo_escolar');
    }
}
