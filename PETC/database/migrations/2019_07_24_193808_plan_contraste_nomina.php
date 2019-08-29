<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PlanContrasteNomina extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plan_contraste_nomina', function (Blueprint $table) {
            $table->increments('id'); 
            $table->integer('id_cct_etc')->unsigned ();
            $table->foreign('id_cct_etc')->references('id')->on('centro_trabajo');
            $table->integer('total_directores');
            $table->integer('total_docentes');
            $table->integer('total_intendentes');
            $table->double('monto_directores');
            $table->double('monto_docentes');
            $table->double('monto_intendentes');
            $table->double('deducciones_directores')->nullable();
            $table->double('deducciones_docentes')->nullable();
            $table->double('deducciones_intendentes')->nullable();
            $table->integer('id_ciclo')->unsigned()->nullable();
            $table->foreign('id_ciclo')->references('id')->on('ciclo_escolar');
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
        Schema::drop('plan_contraste_nomina');
    }
}
