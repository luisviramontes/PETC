<?php

use Illuminate\Database\Seeder;

class DirectorioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('directorio_regional')->insert([
          'id_region' => '1',
          'nombre_enlace' => 'IRMA ESTELA NAVA DELGADO',
          'telefono' => '4921031514',
          'ext1_enlace' => '3205',
          'ext2_enlace' => '',
          'correo_enlace' => '',
          'director_regional' => 'PROFR. VICTOR MANUEL CABRAL VERA',
          'telefono_director' => '4921069401',
          'financiero_regional' => 'NO SE ENCUENTRA REGISTRO',
          'telefono_regional' => '',
          'ext_reg_1' => '7310',
          'ext_reg_2' => '7315',
          'estado' => 'ACTIVO',
          'captura' => 'ADMINISTRADOR',
          'created_at' => '0000-00-00 00:00:00',
          'updated_at' => '0000-00-00 00:00:00'
          ]);
        
        DB::table('directorio_regional')->insert([
           'id_region' => '2',
          'nombre_enlace' => 'ROSA MARÍA ENRIQUEZ SANDOVAL',
          'telefono' => '492 150 3884',
          'ext1_enlace' => '9222250',
          'ext2_enlace' => '',
          'correo_enlace' => '',
          'director_regional' => 'PROFR. INÉS GERARDO PANIAGUA MARTÍNEZ',
          'telefono_director' => '492 942 0364',
          'financiero_regional' => 'PROFRA. MARÍA VICTORIA TORRES FLORES',
          'telefono_regional' => '92 2 22 50',
          'ext_reg_1' => '7311',
          'ext_reg_2' => '7312',
          'estado' => 'ACTIVO',
          'captura' => 'ADMINISTRADOR',
          'created_at' => '0000-00-00 00:00:00',
          'updated_at' => '0000-00-00 00:00:00'
          ]);
        DB::table('directorio_regional')->insert([
           'id_region' => '3',
          'nombre_enlace' => 'ISAIAS CEJAS PALOMO ',
          'telefono' => '4931066673',
          'ext1_enlace' => '7250',
          'ext2_enlace' => '',
          'correo_enlace' => 'cepibalcones@gmail.com',
          'director_regional' => 'PROFRA. ELIZABETH VEGA ÁVILA',
          'telefono_director' => '492 146 37 85 ',
          'financiero_regional' => 'LIC. PATRICIA BARRIENTOS LÓPEZ',
          'telefono_regional' => '93 3 98 16',
          'ext_reg_1' => '7240',
          'ext_reg_2' => '7245',
          'estado' => 'ACTIVO',
          'captura' => 'ADMINISTRADOR',
          'created_at' => '0000-00-00 00:00:00',
          'updated_at' => '0000-00-00 00:00:00'
          ]);
        DB::table('directorio_regional')->insert([
           'id_region' => '4',
          'nombre_enlace' => 'MTRA. MARIA ELENA',
          'telefono' => '493 9493704',
          'ext1_enlace' => '7241',
          'ext2_enlace' => '9230444',
          'correo_enlace' => '',
          'director_regional' => 'PROFR. ROSA MARÍA MAGDALENA VELÁSQUEZ SALAS',
          'telefono_director' => '493 100 8894',
          'financiero_regional' => 'PROFRA. MARÍA ELENA HERNÁNDEZ PAVÓN',
          'telefono_regional' => '493 949 38 04',
          'ext_reg_1' => '7241',
          'ext_reg_2' => '',
          'estado' => 'ACTIVO',
          'captura' => 'ADMINISTRADOR',
          'created_at' => '0000-00-00 00:00:00',
          'updated_at' => '0000-00-00 00:00:00'
          ]);
        DB::table('directorio_regional')->insert([
           'id_region' => '5',
          'nombre_enlace' => 'JOSE CRUZ GARCIA GONZALEZ',
          'telefono' => '4671037578',
          'ext1_enlace' => '7130',
          'ext2_enlace' => '',
          'correo_enlace' => 'ggjc111288@hotmail.com',
          'director_regional' => 'PROFR. FRANCISCO JAVIER JIMÉNEZ ESPITIA',
          'telefono_director' => '467 100 7813',
          'financiero_regional' => 'PROFR. OCTAVIO ROBLES BAÑUELOS',
          'telefono_regional' => '463 101 04 98',
          'ext_reg_1' => '7130',
          'ext_reg_2' => '',
          'estado' => 'ACTIVO',
          'captura' => 'ADMINISTRADOR',
          'created_at' => '0000-00-00 00:00:00',
          'updated_at' => '0000-00-00 00:00:00'
          ]);
        DB::table('directorio_regional')->insert([
           'id_region' => '6',
          'nombre_enlace' => 'ROBERTO GONZALEZ GARCIA ',
          'telefono' => '463 106 25 86',
          'ext1_enlace' => '7131',
          'ext2_enlace' => '',
          'correo_enlace' => '',
          'director_regional' => 'PROFR. FRANCISCO VÁZQUEZ SANDOVAL',
          'telefono_director' => '463 955 3357',
          'financiero_regional' => 'ING. ROBERTO GONZÁLEZ GARCÍA',
          'telefono_regional' => '463 106 25 86',
          'ext_reg_1' => '7131',
          'ext_reg_2' => '',
          'estado' => 'ACTIVO',
          'captura' => 'ADMINISTRADOR',
          'created_at' => '0000-00-00 00:00:00',
          'updated_at' => '0000-00-00 00:00:00'
          ]);
        DB::table('directorio_regional')->insert([
           'id_region' => '7',
          'nombre_enlace' => 'ANA ROSA CORREA MARQUEZ ',
          'telefono' => '437 479 77 95',
          'ext1_enlace' => '7180',
          'ext2_enlace' => '',
          'correo_enlace' => 'financieros04federal@hotmail.com',
          'director_regional' => 'PROFR. MARTIN RAMIRO RIVAS HERRERA',
          'telefono_director' => '437 954 1233',
          'financiero_regional' => 'L.C. ANA ROSA CORREA MÁRQUEZ',
          'telefono_regional' => '437 479 77 95',
          'ext_reg_1' => '7180',
          'ext_reg_2' => '',
          'estado' => 'ACTIVO',
          'captura' => 'ADMINISTRADOR',
          'created_at' => '0000-00-00 00:00:00',
          'updated_at' => '0000-00-00 00:00:00'
          ]);
        DB::table('directorio_regional')->insert([
           'id_region' => '8',
          'nombre_enlace' => 'LUCIA SANDOVAL SANDOVAL',
          'telefono' => '437 100 94 80 ',
          'ext1_enlace' => '7181',
          'ext2_enlace' => '',
          'correo_enlace' => '',
          'director_regional' => 'PROFR. TANIA YAHAIRA LUNA SANTANA',
          'telefono_director' => '331 081 0078',
          'financiero_regional' => 'ING. JULIO ANDRES HARO NÚÑEZ',
          'telefono_regional' => '437 95 4 13 56',
          'ext_reg_1' => '7181',
          'ext_reg_2' => '',
          'estado' => 'ACTIVO',
          'captura' => 'ADMINISTRADOR',
          'created_at' => '0000-00-00 00:00:00',
          'updated_at' => '0000-00-00 00:00:00'
          ]);
        DB::table('directorio_regional')->insert([
           'id_region' => '9',
          'nombre_enlace' => 'JUANA ESTRADA CASTAÑEDA',
          'telefono' => '498 109 15 97 ',
          'ext1_enlace' => '7290',
          'ext2_enlace' => '',
          'correo_enlace' => '',
          'director_regional' => 'PROFR. JUAN DE DIOS LANDEROS ALVARADO',
          'telefono_director' => '498 100 7234',
          'financiero_regional' => 'PROFRA. JUANA ESTRADA CASTAÑEDA',
          'telefono_regional' => '498 109 15 97',
          'ext_reg_1' => '7290',
          'ext_reg_2' => '7296',
          'estado' => 'ACTIVO',
          'captura' => 'ADMINISTRADOR',
          'created_at' => '0000-00-00 00:00:00',
          'updated_at' => '0000-00-00 00:00:00'
          ]);
        DB::table('directorio_regional')->insert([
           'id_region' => '10',
          'nombre_enlace' => 'MISAEL MARES ESTRADA',
          'telefono' => '498 110 3837',
          'ext1_enlace' => '7291',
          'ext2_enlace' => '7292',
          'correo_enlace' => '',
          'director_regional' => 'PROFR. MARTÍN MARTÍNEZ CUEVAS',
          'telefono_director' => '',
          'financiero_regional' => 'PROFR. MISAEL MARES ESTRADA',
          'telefono_regional' => '498 110 38 37',
          'ext_reg_1' => '7294',
          'ext_reg_2' => '',
          'estado' => 'ACTIVO',
          'captura' => 'ADMINISTRADOR',
          'created_at' => '0000-00-00 00:00:00',
          'updated_at' => '0000-00-00 00:00:00'
          ]);
        DB::table('directorio_regional')->insert([
           'id_region' => '11',
          'nombre_enlace' => 'JOSE ALFREDO CARRANZA MEDINA',
          'telefono' => '844 146 26 80',
          'ext1_enlace' => '7435',
          'ext2_enlace' => '7434',
          'correo_enlace' => '',
          'director_regional' => 'PROFR. HORACIO ALVARADO PEREZ',
          'telefono_director' => '842 103 0041',
          'financiero_regional' => 'C.P. MARÍA LUISA MAGALLÁN MERCADO',
          'telefono_regional' => ' 01 842 424 04 86',
          'ext_reg_1' => '7430',
          'ext_reg_2' => '7435',
          'estado' => 'ACTIVO',
          'captura' => 'ADMINISTRADOR',
          'created_at' => '0000-00-00 00:00:00',
          'updated_at' => '0000-00-00 00:00:00'
          ]);
        DB::table('directorio_regional')->insert([
           'id_region' => '12',
          'nombre_enlace' => 'NADYA MARTINEZ TOVAR',
          'telefono' => '8444643232',
          'ext1_enlace' => '7431',
          'ext2_enlace' => '7432',
          'correo_enlace' => '',
          'director_regional' => 'PROFRA. MA. DORA ELIA PINALES LÓPEZ ',
          'telefono_director' => '492 109 2329',
          'financiero_regional' => 'NO SE ENCUENTRA REGISTRO',
          'telefono_regional' => '',
          'ext_reg_1' => '7432',
          'ext_reg_2' => '',
          'estado' => 'ACTIVO',
          'captura' => 'ADMINISTRADOR',
          'created_at' => '0000-00-00 00:00:00',
          'updated_at' => '0000-00-00 00:00:00'
          ]);
        DB::table('directorio_regional')->insert([
           'id_region' => '13',
          'nombre_enlace' => 'SILVIA DELGADO MORALES',
          'telefono' => '496 101 3922',
          'ext1_enlace' => '7070',
          'ext2_enlace' => '7075',
          'correo_enlace' => '',
          'director_regional' => 'PROFR. ALFONZO CONTRERAS HERNÁNDEZ',
          'telefono_director' => '4961375667',
          'financiero_regional' => 'LIC. JOSÉ FREDDY CARDONA ORTÍZ',
          'telefono_regional' => '496 119 54 72',
          'ext_reg_1' => '7070',
          'ext_reg_2' => '7075',
          'estado' => 'ACTIVO',
          'captura' => 'ADMINISTRADOR',
          'created_at' => '0000-00-00 00:00:00',
          'updated_at' => '0000-00-00 00:00:00'
          ]);
        DB::table('directorio_regional')->insert([
           'id_region' => '14',
          'nombre_enlace' => 'ANNE ELIZABETH VELEZ HERNANDEZ',
          'telefono' => '496 117 48 33',
          'ext1_enlace' => '7073',
          'ext2_enlace' => '',
          'correo_enlace' => '',
          'director_regional' => 'PROFRA. MA. DE LA LUZ GALLEGOS TORRES',
          'telefono_director' => '496 101 8464',
          'financiero_regional' => 'NO SE ENCUENTRA REGISTRO',
          'telefono_regional' => '',
          'ext_reg_1' => '7073',
          'ext_reg_2' => '',
          'estado' => 'ACTIVO',
          'captura' => 'ADMINISTRADOR',
          'created_at' => '0000-00-00 00:00:00',
          'updated_at' => '0000-00-00 00:00:00'
          ]);
        DB::table('directorio_regional')->insert([
          'id_region' => '15',
          'nombre_enlace' => 'MARIA MIRIAM ORTIZ ESCOBEDO',
          'telefono' => '494 103 66 25 ',
          'ext1_enlace' => '7220',
          'ext2_enlace' => '',
          'correo_enlace' => '',
          'director_regional' => 'PROFRA. MA. GUADALUPE CABRAL ROSALES',
          'telefono_director' => '494 103 3323',
          'financiero_regional' => 'L.C. MA. CONCEPCIÓN DÍAZ TREJO',
          'telefono_regional' => '494 942 75 59',
          'ext_reg_1' => '7224',
          'ext_reg_2' => '',
          'estado' => 'ACTIVO',
          'captura' => 'ADMINISTRADOR',
          'created_at' => '0000-00-00 00:00:00',
          'updated_at' => '0000-00-00 00:00:00'
          ]);
        DB::table('directorio_regional')->insert([
           'id_region' => '16',
          'nombre_enlace' => 'MARIA ANTONIA MARQUEZ',
          'telefono' => '494 116 10 60 ',
          'ext1_enlace' => '7221',
          'ext2_enlace' => '',
          'correo_enlace' => 'maryanto11@hotmail.com',
          'director_regional' => 'PROFRA. EVA VERÓNICA HERNÁNDEZ MARQUEZ',
          'telefono_director' => '494 943 0245',
          'financiero_regional' => 'L.C. IRMA HERNÁNDEZ MÁRQUEZ',
          'telefono_regional' => '494 112 28 87 ',
          'ext_reg_1' => '7221',
          'ext_reg_2' => '',
          'estado' => 'ACTIVO',
          'captura' => 'ADMINISTRADOR',
          'created_at' => '0000-00-00 00:00:00',
          'updated_at' => '0000-00-00 00:00:00'
          ]);
        DB::table('directorio_regional')->insert([
           'id_region' => '17',
          'nombre_enlace' => 'HUGO LEON RANGEL ELIAS',
          'telefono' => '496 122 13 19 ',
          'ext1_enlace' => '3400',
          'ext2_enlace' => '3425',
          'correo_enlace' => '',
          'director_regional' => 'PROFR. LUIS MIGUEL SANDOVAL GARCÍA ',
          'telefono_director' => '496 104 4567',
          'financiero_regional' => 'L.C. MARINA MARTÍNEZ AGUILAR',
          'telefono_regional' => '496 962 02 98',
          'ext_reg_1' => '7000',
          'ext_reg_2' => '7001',
          'estado' => 'ACTIVO',
          'captura' => 'ADMINISTRADOR',
          'created_at' => '0000-00-00 00:00:00',
          'updated_at' => '0000-00-00 00:00:00'
          ]);
        DB::table('directorio_regional')->insert([
          'id_region' => '18',
          'nombre_enlace' => 'PAOLA RIOS SANCHEZ',
          'telefono' => '',
          'ext1_enlace' => '7005',
          'ext2_enlace' => '7006',
          'correo_enlace' => '',
          'director_regional' => 'PROFRA. LUZ ADRIANA AGUILAR HURTADO',
          'telefono_director' => '',
          'financiero_regional' => 'NO SE ENCUENTRA REGISTRO',
          'telefono_regional' => '',
          'ext_reg_1' => '7005',
          'ext_reg_2' => '7006',
          'estado' => 'ACTIVO',
          'captura' => 'ADMINISTRADOR',
          'created_at' => '0000-00-00 00:00:00',
          'updated_at' => '0000-00-00 00:00:00'
          ]);
        DB::table('directorio_regional')->insert([
           'id_region' => '19',
          'nombre_enlace' => 'LETICIA PLANCARTE MARTINEZ',
          'telefono' => '492 106 95 15',
          'ext1_enlace' => '7050',
          'ext2_enlace' => '7054',
          'correo_enlace' => '',
          'director_regional' => 'PROFR. ERASMO CARDONA RODRÍGUEZ',
          'telefono_director' => '492 106 7330',
          'financiero_regional' => 'LIC. YADIRA LARA DÍAZ',
          'telefono_regional' => '',
          'ext_reg_1' => '7050',
          'ext_reg_2' => '',
          'estado' => 'ACTIVO',
          'captura' => 'ADMINISTRADOR',
          'created_at' => '0000-00-00 00:00:00',
          'updated_at' => '0000-00-00 00:00:00'
          ]);
        DB::table('directorio_regional')->insert([
          'id_region' => '20',
          'nombre_enlace' => 'ADRIÁN MIKHAIL VELÁZQUEZ GARCÍA',
          'telefono' => '492 949 1279',
          'ext1_enlace' => '7051',
          'ext2_enlace' => '7052',
          'correo_enlace' => '',
          'director_regional' => 'PROFR. VLADIMIR JUÁREZ DÁVILA',
          'telefono_director' => '492 544 4473',
          'financiero_regional' => 'L.C. JUAN JOSÉ AYALA IBARRA',
          'telefono_regional' => '',
          'ext_reg_1' => '7055',
          'ext_reg_2' => '',
          'estado' => 'ACTIVO',
          'captura' => 'ADMINISTRADOR',
          'created_at' => '0000-00-00 00:00:00',
          'updated_at' => '0000-00-00 00:00:00'
          ]);
        DB::table('directorio_regional')->insert([
           'id_region' => '21',
          'nombre_enlace' => 'OSCAR MANUEL SANTOYO CASTAÑEDA',
          'telefono' => '4331030435',
          'ext1_enlace' => '7271',
          'ext2_enlace' => '',
          'correo_enlace' => '',
          'director_regional' => 'PROFRA. LEONOR ESPINOZA GALLARDO',
          'telefono_director' => '433 103 37 55',
          'financiero_regional' => 'PROFR. JUAN CARLOS JUAREZ CANALES',
          'telefono_regional' => '433 100 42 95',
          'ext_reg_1' => '7271',
          'ext_reg_2' => '',
          'estado' => 'ACTIVO',
          'captura' => 'ADMINISTRADOR',
          'created_at' => '0000-00-00 00:00:00',
          'updated_at' => '0000-00-00 00:00:00'
          ]);
        DB::table('directorio_regional')->insert([
           'id_region' => '22',
          'nombre_enlace' => 'ROSA MA GOMEZ CORTES',
          'telefono' => '433 105 94 15',
          'ext1_enlace' => '7270',
          'ext2_enlace' => '',
          'correo_enlace' => '',
          'director_regional' => 'PROFRA. MA. ESTHER IBARRA LONGORIA',
          'telefono_director' => '',
          'financiero_regional' => 'NO SE ENCUENTRA REGISTRO',
          'telefono_regional' => '',
          'ext_reg_1' => '7270',
          'ext_reg_2' => '',
          'estado' => 'ACTIVO',
          'captura' => 'ADMINISTRADOR',
          'created_at' => '0000-00-00 00:00:00',
          'updated_at' => '0000-00-00 00:00:00'
          ]);
        DB::table('directorio_regional')->insert([
           'id_region' => '23',
          'nombre_enlace' => 'MA. GUADALUPE PEREZ VILLALOBOS',
          'telefono' => '346 700 93 53',
          'ext1_enlace' => '7090',
          'ext2_enlace' => '',
          'correo_enlace' => '',
          'director_regional' => 'PROFR. FRANCISCO JAVIER AGUIRRE DURÁN',
          'telefono_director' => '346 102 8974',
          'financiero_regional' => 'PROFRA. JUANA GARCÍA NUNGARAY',
          'telefono_regional' => '',
          'ext_reg_1' => '7090',
          'ext_reg_2' => '7101',
          'estado' => 'ACTIVO',
          'captura' => 'ADMINISTRADOR',
          'created_at' => '0000-00-00 00:00:00',
          'updated_at' => '0000-00-00 00:00:00'
          ]);
        DB::table('directorio_regional')->insert([
           'id_region' => '24',
          'nombre_enlace' => 'MA. GUADALUPE PEREZ VILLALOBOS',
          'telefono' => '346 700 93 53',
          'ext1_enlace' => '7092',
          'ext2_enlace' => '',
          'correo_enlace' => '',
          'director_regional' => 'PROFR. FRANCISCO JAVIER AGUIRRE DURÁN',
          'telefono_director' => '346 102 8974',
          'financiero_regional' => 'PROFRA. JUANA GARCÍA NUNGARAY',
          'telefono_regional' => '',
          'ext_reg_1' => '7101',
          'ext_reg_2' => '7090',
          'estado' => 'ACTIVO',
          'captura' => 'ADMINISTRADOR',
          'created_at' => '0000-00-00 00:00:00',
          'updated_at' => '0000-00-00 00:00:00'
          ]);
        DB::table('directorio_regional')->insert([
           'id_region' => '25',
          'nombre_enlace' => 'MAYRA YANETH HERNANDEZ RODELA',
          'telefono' => '457 107 27 93',
          'ext1_enlace' => '7210',
          'ext2_enlace' => '',
          'correo_enlace' => '',
          'director_regional' => 'PROFR. FEDERICO BETANCOURT CORTES',
          'telefono_director' => '4571041171',
          'financiero_regional' => 'MAGDA KARINA HERRERA AGUIRRE',
          'telefono_regional' => '457 104 07 88',
          'ext_reg_1' => '7103',
          'ext_reg_2' => '',
          'estado' => 'ACTIVO',
          'captura' => 'ADMINISTRADOR',
          'created_at' => '0000-00-00 00:00:00',
          'updated_at' => '0000-00-00 00:00:00'
          ]);

        //
    }
}
