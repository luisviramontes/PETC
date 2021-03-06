<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Fortalecimiento extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fortalecimiento', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_cct')->unsigned();
            $table->foreign('id_cct')->references('id')->on('centro_trabajo');
            $table->string('monto_forta');
            $table->integer('id_ciclo')->unsigned();
            $table->foreign('id_ciclo')->references('id')->on('ciclo_escolar');
         //   $table->double('monto_forta');
          //  $table->string('ciclo_escolar');
           // $table->integer('id_ciclo')->unsigned();
            //$table->foreign('id_ciclo')->references('id')->on('ciclo_escolar');
            //$table->double('monto_forta');
            $table->string('ciclo_escolar')->nullable();
            $table->string('estado');
            $table->string('observaciones')->nullable();
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
        Schema::drop('fortalecimiento');
    }
}
