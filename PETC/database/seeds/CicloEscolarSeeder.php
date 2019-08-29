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
    		'inicio_ciclo' => '2018-08-20',
    		'fin_ciclo' => '2019-07-08',
        'estado' => 'ACTIVO',
    		'capturo' => 'ADMINISTRADOR',
    		'created_at' => '0000-00-00 00:00:00',
    		'updated_at' => '0000-00-00 00:00:00'
    		]);

                DB::table('ciclo_escolar')->insert([
            'ciclo' => '2019-2020',
            'dias_habiles' => '195',
            'inicio_ciclo' => '2019-08-26',
            'fin_ciclo' => '2020-07-06',
        'estado' => 'ACTIVO',
            'capturo' => 'ADMINISTRADOR',
            'created_at' => '0000-00-00 00:00:00',
            'updated_at' => '0000-00-00 00:00:00'
            ]);
        //
    }
}
