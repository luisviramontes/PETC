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


        $this->call(DirectorioExternoSeeder::class);

        $this->call(TabuladorPagosSeeder::class);
        $this->call(CicloEscolarSeeder::class);
        $this->call(RegionSeeder::class);
        $this->call(CatPuestoSeeder::class);
        $this->call(MunicipiosSeeder::class);
        $this->call(LocalidadesSeeder::class);
<<<<<<< HEAD
        $this->call(CentrosTrabajoSeeder::class);
=======
        
        $this->call(CentrosTrabajoSeeder::class);
        
>>>>>>> 1510048037f11b21a768c373fc06d89c3f5ed623
        $this->call(DatosCentroTrabajoSeeder::class);
        $this->call(dia_mes_seeder::class);
        $this->call(TablaPagosSeeder::class);
        $this->call(CapturaSeeder::class);
        $this->call(Captura2Seeder::class);
        $this->call(Director_CCTSeeder::class);
<<<<<<< HEAD
        $this->call(DirectorioSeeder::class);
=======
     
        $this->call(DirectorioSeeder::class);
   
>>>>>>> 1510048037f11b21a768c373fc06d89c3f5ed623
        $this->call(DirectorioInternoSeeder::class);
        $this->call(Plan_Contraste_NominaSeeder::class);



        // $this->call(UserTableSeeder::class);

        Model::reguard();
    }
}
 