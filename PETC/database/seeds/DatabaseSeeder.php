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
<<<<<<< HEAD
        
        $this->call(DirectorioExternoSeeder::class);
=======

>>>>>>> 7907baf0578c9ad597decf187c3304b1f4cdaf65
        $this->call(TabuladorPagosSeeder::class);
        $this->call(CicloEscolarSeeder::class);
        $this->call(RegionSeeder::class);
        $this->call(CatPuestoSeeder::class);
        $this->call(MunicipiosSeeder::class);
        $this->call(LocalidadesSeeder::class);
        $this->call(CentrosTrabajoSeeder::class);
        $this->call(DatosCentroTrabajoSeeder::class);
        $this->call(dia_mes_seeder::class);

        $this->call(TablaPagosSeeder::class);
      //  $this->call(CapturaSeeder::class);
      //  $this->call(Captura2Seeder::class);
      //  $this->call(Director_CCTSeeder::class);
        $this->call(DirectorioSeeder::class);
        $this->call(DirectorioInternoSeeder::class);

        


        // $this->call(UserTableSeeder::class);

        Model::reguard();
    }
}
