<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CapRechazo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cap_rechazo', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('qna');
          $table->string('sostenimiento');
          $table->string('tipo');
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
        Schema::drop('cap_rechazo');
    }
}
