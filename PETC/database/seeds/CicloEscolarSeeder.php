<?php

use Illuminate\Database\Seeder;

class CicloEscolarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::table('ciclo_escolar')->insert([
    		'ciclo' => '2018-2019', 
    		'dias_habiles' => '195', 
    		'inicio_ciclo' => '2018-20-08', 
    		'fin_ciclo' => '2019-8-07', 
    		'capturo' => 'ADMINISTRADOR', 
    		'created_at' => '0000-00-00 00:00:00', 
    		'updated_at' => '0000-00-00 00:00:00'
    		]);
        //
    }
}
