<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PagosImprocedentes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pagos_improcedentes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('region');
            $table->string('rfc');
            $table->string('nom_emp');
            $table->integer('qna_ini');
            $table->integer('qna_fin');
            $table->integer('qna_pago');
            $table->integer('num_cheque');
            $table->double('perc');
            $table->double('ded');
            $table->double('neto');
            $table->string('observaciones')->nullable();
            $table->string('estado');
            $table->integer('id_ciclo')->unsigned()->nullable();
            $table->foreign('id_ciclo')->references('id')->on('ciclo_escolar');
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
        Schema::drop('pagos_improcedentes');
    }
}
