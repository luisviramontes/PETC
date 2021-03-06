<?php

namespace petc\Http\Controllers;

use Illuminate\Http\Request;

use petc\Http\Requests;
use petc\Http\Controllers\Controller; 


use DB;
use Maatwebsite\Excel\Facades\Excel;
use PHPExcel_Worksheet_Drawing;
use Validator;
use \Milon\Barcode\DNS1D;
use \Milon\Barcode\DNS2D; 
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Collection as Collection;

class ConsultaPagosController extends Controller
{ 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query=trim($request->GET('cct2'));
        $query2=trim($request->GET('ciclo_escolar'));
        $query3=trim($request->GET('sostenimiento'));
        $query4=trim($request->GET('rfc_input'));

        $ciclos=DB::table('ciclo_escolar')->get();
        $cct=DB::table('centro_trabajo')->where('estado','=','ACTIVO')->get();

        $captura=DB::table('captura')->where('rfc','=',$query4)->where('id_cct_etc','=',$query)->where('pagos_registrados','=','1')->where('sostenimiento','=',$query3)->get();
        if(count($captura) > 0){
          if($query3 == "FEDERAL"){
             $nomina_federal = DB::table('nomina_federal')
             ->where('ciclo_escolar','=',$query2)
             ->where('rfc','=',$query4)
             ->get();

         }else{
           $nomina_federal = DB::table('nomina_estatal')
           ->where('ciclo_escolar','=',$query2)
           ->where('rfc','=',$query4)->get();
       }
       return view('nomina.consulta_pagos.index',["cct"=>$cct,"ciclos"=>$ciclos,"nomina_federal" => $nomina_federal,"cct2"=>$query,"ciclo_escolar"=>$query2,"sostenimiento"=>$query3,"rfc_input"=>$query4]);

   }else{
      if($query3 == "FEDERAL"){
         $nomina_federal = DB::table('nomina_federal')
         ->where('ciclo_escolar','=',$query2)
         ->where('rfc','=','NO VALIDO')
         ->get();

     }else{
       $nomina_federal = DB::table('nomina_estatal')
       ->where('ciclo_escolar','=',$query2)
       ->where('rfc','=','NO VALIDO')->get();
   }
   return view('nomina.consulta_pagos.index',["cct"=>$cct,"ciclos"=>$ciclos,"nomina_federal" => $nomina_federal,"cct2"=>$query,"ciclo_escolar"=>$query2,"sostenimiento"=>$query3,"rfc_input"=>$query4]);

}


}

public function invoice($rfc,$ciclo,$qna,$sostenimiento){

   $personal= DB::table('captura')
   ->join('cat_puesto','cat_puesto.id','=','captura.clave')->join('centro_trabajo', 'centro_trabajo.id', '=','captura.id_cct_etc')
   ->select('centro_trabajo.id_region','centro_trabajo.id_localidades','centro_trabajo.id_municipios')
   ->join('region', 'region.id', '=','centro_trabajo.id_region')->join('localidades', 'localidades.id', '=','centro_trabajo.id_localidades')
   ->join('municipios', 'municipios.id', '=','centro_trabajo.id_municipios')->join('ciclo_escolar', 'ciclo_escolar.id', '=','captura.id_ciclo')
   ->select('captura.*','cat_puesto.cat_puesto','centro_trabajo.cct','centro_trabajo.nombre_escuela','ciclo_escolar.ciclo','region.region','municipios.municipio','localidades.nom_loc')
   ->where('captura.rfc','=',$rfc)->first();


   if($sostenimiento == "FEDERAL"){
     $nomina = DB::table('nomina_federal')
     ->where('ciclo_escolar','=',$ciclo)
     ->where('rfc','=',$rfc)
     ->where('qna_pago','=',$qna)
     ->first();

 }else{
   $nomina = DB::table('nomina_estatal')
   ->where('ciclo_escolar','=',$ciclo)
   ->where('rfc','=',$rfc)
   ->where('qna_pago','=',$qna)
   ->first();
}


$date = date('Y-m-d');
$invoice = "2222";
        //print_r($);
$view =  \View::make('nomina.consulta_pagos.invoice', compact('nomina','personal','sostenimiento'))->render();
        //->setPaper($customPaper, 'landscape');
$pdf = \App::make('dompdf.wrapper');
$pdf->loadHTML($view);
return $pdf->stream('invoice');


}

        //


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    } 

    public function capacitaciones_public(){
       $capacitaciones= DB::table('capacitaciones')
       ->join('ciclo_escolar', 'ciclo_escolar.id', '=','capacitaciones.id_ciclo')
       ->select('capacitaciones.*','ciclo_escolar.ciclo')
       ->paginate(40);
       return view('academica.capacitaciones.capacitaciones',["capacitaciones"=>$capacitaciones]);
   }

   public function avisos_publicos(){
       $avisos= DB::table('avisos')
       ->join('ciclo_escolar', 'ciclo_escolar.id', '=','avisos.id_ciclo')
       ->select('avisos.*','ciclo_escolar.ciclo')
       ->paginate(40);
       return view('administrativa.avisos.avisos',["avisos"=>$avisos]);
   }

   public function actividad_publica(){


    $actividad= DB::table('actividad')
    ->join('ciclo_escolar', 'ciclo_escolar.id', '=','actividad.id_ciclo')
    ->select('actividad.*','ciclo_escolar.ciclo')
    ->get();


    return view('administrativa.actividad.actividades',["actividad"=>$actividad]);
}

public function actividad_publica_f(){

    $actividades=array();

    $fecha = date('Y-m-d');
    $mes_ant_2 = strtotime ( '-2 month' , strtotime ( $fecha ) ) ;
    $mes_ant_2 = date ( 'Y-m-d' , $mes_ant_2 );

    $mes_ant = strtotime ( '-1 month' , strtotime ( $fecha ) ) ;
    $mes_ant = date ( 'Y-m-d' , $mes_ant );

    $semana_a = strtotime ( '- 1 week' , strtotime ( $fecha ) ) ;
    $semana_a = date ( 'Y-m-d' , $semana_a );




    $actividad= DB::table('actividad')
    ->join('ciclo_escolar', 'ciclo_escolar.id', '=','actividad.id_ciclo')
    ->select('actividad.*','ciclo_escolar.ciclo')
    ->where('actividad.fecha','>',$mes_ant_2)
    ->get();

    for ($i=0; $i < count($actividad) ; $i++) {
        $fecha_aux= $actividad[$i]->fecha;


        if($fecha_aux >= $mes_ant_2){
            if($fecha_aux >= $mes_ant){
                if($fecha_aux >= $semana_a){
                    if($fecha_aux == $hoy){                      
                      $data3=['nombre_actividad'=>$actividad[$i]->nombre_actividad,'lugar'=>$actividad[$i]->lugar,'fecha'=>$actividad[$i]->fecha,'area'=>$actividad[$i]->area,'motivo'=>$actividad[$i]->motivo,'descripcion'=>$actividad[$i]->descripcion,'ciclo'=>$actividad[$i]->ciclo,'tipo'=>"all ultimes mes semana  hoy","archivo"=>$actividad[$i]->archivo];
                  }else{
                   $data3=['nombre_actividad'=>$actividad[$i]->nombre_actividad,'lugar'=>$actividad[$i]->lugar,'fecha'=>$actividad[$i]->fecha,'area'=>$actividad[$i]->area,'motivo'=>$actividad[$i]->motivo,'descripcion'=>$actividad[$i]->descripcion,'ciclo'=>$actividad[$i]->ciclo,'tipo'=>"all ultimes mes semana","archivo"=>$actividad[$i]->archivo];
               }


           }else{
            $data3=['nombre_actividad'=>$actividad[$i]->nombre_actividad,'lugar'=>$actividad[$i]->lugar,'fecha'=>$actividad[$i]->fecha,'area'=>$actividad[$i]->area,'motivo'=>$actividad[$i]->motivo,'descripcion'=>$actividad[$i]->descripcion,'ciclo'=>$actividad[$i]->ciclo,'tipo'=>"all ultimes mes","archivo"=>$actividad[$i]->archivo];
        }
    }else{
     $data3=['nombre_actividad'=>$actividad[$i]->nombre_actividad,'lugar'=>$actividad[$i]->lugar,'fecha'=>$actividad[$i]->fecha,'area'=>$actividad[$i]->area,'motivo'=>$actividad[$i]->motivo,'descripcion'=>$actividad[$i]->descripcion,'ciclo'=>$actividad[$i]->ciclo,'tipo'=>"all ultimes ","archivo"=>$actividad[$i]->archivo];
}      # code...
}

array_push($actividades, $data3);
}
return ($actividades);

}

}