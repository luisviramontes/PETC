<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        $this->call(TablaPagosSeeder::class);
        $this->call(TabuladorPagosSeeder::class);
         $this->call(CicloEscolarSeeder::class);

        // $this->call(UserTableSeeder::class);

        Model::reguard();
    }
}
