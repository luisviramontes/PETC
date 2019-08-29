<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Rechazosfed extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rechazosfed', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('num_cheque');
            $table->integer('udc');
            $table->string('rfc');
            $table->string('curp');
            $table->string('nombre');
            $table->string('ct');
            $table->double('importe');
            $table->integer('qna_pago')->nullable();
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
        Schema::drop('rechazosfed');
    }
}
