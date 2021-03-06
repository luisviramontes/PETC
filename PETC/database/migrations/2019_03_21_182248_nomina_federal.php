<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class NominaFederal extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nomina_federal', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('region');
            $table->string('rfc');
            $table->string('nom_emp');
            $table->integer('ent_fed');
            $table->string('ct_clasif');
            $table->string('ct_id');
            $table->string('ct_sec');
            $table->string('ct_digito_ver');
            $table->integer('cod_pago');
            $table->integer('unidad');
            $table->integer('subunidad');
            $table->string('cat_puesto');
            $table->integer('horas');
            $table->integer('cons_plaza');
            $table->integer('qna_ini_01');
            $table->integer('qna_fin_01');
            $table->integer('qna_pago');
            $table->integer('num_cheque');
            $table->double('perc');
            $table->double('ded');
            $table->double('neto');
            $table->string('ciclo_escolar');
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
        Schema::drop('nomina_federal');
    }
}
