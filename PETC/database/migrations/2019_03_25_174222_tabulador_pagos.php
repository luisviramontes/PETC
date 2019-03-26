<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TabuladorPagos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tabulador_pagos', function (Blueprint $table) {
            $table->increments('id_tabulador');
            $table->double('pago_director');
            $table->double('pago_docente');
            $table->double('pago_intendente');
            $table->string('ciclo');
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
        Schema::drop('tabulador_pagos');
    }
}
