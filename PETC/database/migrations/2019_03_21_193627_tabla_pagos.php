<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TablaPagos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tabla_pagos', function (Blueprint $table) {
            $table->increments('id_tabla_pagos');
            $table->integer('qna');
            $table->integer('dias');
            $table->double('pago_director');
            $table->double('pago_docente');
            $table->double('pago_intendente');
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
        Schema::drop('tabla_pagos');
    }
}
