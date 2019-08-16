<?php

use Illuminate\Database\Seeder;

class TabuladorPagosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::table('tabulador_pagos')->insert([
    		'pago_director' => '230', 
    		'pago_docente' => '200', 
    		'pago_intendente' => '50', 
    		'ciclo' => '2018-2019', 
    		'capturo' => 'ADMINISTRADOR', 
    		'created_at' => '0000-00-00 00:00:00', 
    		'updated_at' => '0000-00-00 00:00:00',
    		]);

            DB::table('tabulador_pagos')->insert([
            'pago_director' => '230', 
            'pago_docente' => '200', 
            'pago_intendente' => '50', 
            'ciclo' => '2019-2020', 
            'capturo' => 'ADMINISTRADOR', 
            'created_at' => '0000-00-00 00:00:00', 
            'updated_at' => '0000-00-00 00:00:00',
            ]);
        //
    }
}
