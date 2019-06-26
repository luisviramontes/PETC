<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Rechazosest extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rechazosest', function (Blueprint $table) {
            $table->increments('id');
            $table->string('numemp');
            $table->string('rfcemp');
            $table->string('nomemp');
            $table->integer('per');
            $table->double('ded');
            $table->integer('exp_6');
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
        Schema::drop('rechazosest');
    }
}
