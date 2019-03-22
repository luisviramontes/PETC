<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CatPuesto extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cat_puesto', function (Blueprint $table) {
            $table->increments('idcat_puesto');
            $table->string('cv_ur');
            $table->string('entidad');
            $table->string('ccp');
            $table->string('nom_prog');
            $table->string('cat_puesto');
            $table->string('des_puesto');
            $table->string('categoria');
            $table->string('tipo_puesto');
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
        Schema::drop('cat_puesto');
    }
}
