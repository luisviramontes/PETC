<?php

namespace petc\Http\Controllers;

use Illuminate\Http\Request;

use petc\Http\Requests;
use petc\Http\Controllers\Controller;
use petc\ReclamosModel;
use petc\DiasMesModel;
use petc\TabuladorPagosModel;
use petc\OficiosEmitidosModel;
use petc\TablaPagosModel;

use DB;

use Maatwebsite\Excel\Facades\Excel;
use PHPExcel_Worksheet_Drawing;
use Validator;
use \Milon\Barcode\DNS1D;
use \Milon\Barcode\DNS2D;

class ReclamosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(request $request,$id) 
    {





  }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() 
    { 
      $pagos=DB::table('tabla_pagos')->get();
      $genero=DB::table('directoriointerno')->where('estado','=','ACTIVO')->get();
      $dirigido=DB::table('directorioexterno')->where('estado','=','ACTIVO')->get();
      $ciclos=DB::table('ciclo_escolar')->get();
      $captura=DB::table('captura')->join('centro_trabajo','centro_trabajo.id','=','captura.id_cct_etc')->where('captura.estado','=','ACTIVO')->where('captura.pagos_registrados','=','0')->select('captura.id','captura.rfc','captura.fecha_inicio','captura.fecha_termino','captura.nombre','captura.categoria','centro_trabajo.nombre_escuela','centro_trabajo.cct')->get();
      return view('nomina.reclamos.create', ['dirigido'=>$dirigido,'captura'=> $captura,'ciclos'=>$ciclos,'genero'=>$genero,'pagos'=>$pagos]);
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
      $date = $request->get('fecha');
      $ciclo_aux=$request->get('ciclo_escolar');

      $oficio=$request->get('oficio');
      $name2 = explode("/",$oficio);
      $oficio_a=$name2[3];
      $name3 = explode(".-",$oficio_a);
      $oficio_aux=$name3[1];

      $motivo=$request->get('motivo');
      $observaciones=$request->get('observaciones');
      $qna=$request->get('pagos');
        $year_aux = substr($qna, 0, -2);  // devuelve "abcde" 201818
        $qna_aux = substr($qna, 4, 5);  // devuelve "abcde" 201818

        //QUIEN GENERO EL OFICIO
        $genero_aux=$request->get('genero');
        //$first = head($genero_aux);
        $name = explode("_",$genero_aux);
        $genero=$name[0];
        $id_genero=$name[1];

        //A QUIEN VA DIRIGIDO EL OFICIO
        $dirigido_aux=$request->get('dirigido_a');
        $name4 = explode("_",$dirigido_aux);
        $dirigido_puesto=$name4[0];
        $dirigido_nombrec=$name4[1];
        $id_dirigido=$name4[2];
        $dirigido_lic=$name4[3];

        //VO BO
        $visto_bueno_aux = $request->get('visto_bueno');
        $first5 = head($visto_bueno_aux);
        $name5 = explode(",",$first5);
        $cuenta_visto_aux= count($name5);
        $cuenta_visto=$cuenta_visto_aux/4;

        if($cuenta_visto == 1){
          $name_vo_1=$name5;
        }else{
         $name_vo_1=$name5;
       }


        //CCP
       $copia_aux = $request->get('c_copia');
       $first6 = head($copia_aux);
       $name6 = explode(",",$first6);
       $cuenta_copia= count($name6);
       $cuenta_copia_t=$cuenta_copia/5;
       


       $ciclo=DB::table('ciclo_escolar')->where('ciclo','=',$ciclo_aux)->first();
       $elementos= $request->get('totale');
       $x=0;
       $producto = $request->get('codigo2');
       $first = head($producto);
       $name = explode(",",$first);

       $ofico_emite= new OficiosEmitidosModel;
       $ofico_emite->num_oficio=$oficio_aux;
       $ofico_emite->id_dirigido=$id_dirigido;
       $ofico_emite->asunto="Solicitud de Pago";
       $ofico_emite->referencia="Nomina PETC";
       $ofico_emite->salida=$date;
       $ofico_emite->id_elabora=$id_genero;
       $ofico_emite->observaciones=$observaciones;
       $ofico_emite->estado="PENDIENTE";
       $ofico_emite->captura="ADMINISTRADOR";
       $ofico_emite->id_ciclo=$ciclo->id;
       $ofico_emite->save();



       for ($i=0; $i < $elementos ; $i++) {
        $reclamo = new ReclamosModel; 
        $reclamo->id_captura=$name[$x];
        $x=$x+1;

        $reclamo->id_ciclo=$ciclo->id;
        $reclamo->total_dias=$name[$x];
        $reclamo->observaciones=$observaciones;
        $reclamo->oficio=$oficio;
        $reclamo->motivo=$motivo;
        $reclamo->estado="ACTIVO";
        $reclamo->captura="ADMINISTRADOR";


        $x=$x+1;
        $reclamo->periodo_inicial=$name[$x];
        $x=$x+1;
        $reclamo->periodo_final=$name[$x];
        $x=$x+1;
        $reclamo->total_reclamo=$name[$x];
        $x=$x+1;
        $reclamo->save();
            # code...
      }
      $reclamos=ReclamosModel::join('captura','captura.id','=','reclamos.id_captura')->join('centro_trabajo','centro_trabajo.id','=','captura.id_cct_etc')->select('captura.categoria','captura.nombre','captura.rfc','centro_trabajo.cct','reclamos.*')->where('oficio','=',$oficio)->where('reclamos.estado','=','ACTIVO')->where('reclamos.id_ciclo','=',$ciclo->id)->get();
      $cuenta=count($reclamos);

      $view =  \View::make('nomina.reclamos.invoice', compact('cuenta_copia_t','cuenta_copia','name6','name_vo_1','dirigido_puesto','dirigido_nombrec','dirigido_lic','cuenta','reclamos','motivo','date','oficio','qna_aux','year_aux','genero'))->render();
        //->setPaper($customPaper, 'landscape');
      $pdf = \App::make('dompdf.wrapper');
      $pdf->loadHTML($view);
      return $pdf->stream('invoice.pdf');
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

    public function valida_reclamos($dia, $mes, $year){

      $dia=intval($dia);

      if($mes == 1){
        $mes_aux="ENERO";
      }elseif ($mes == 2) {
        $mes_aux="FEBRERO";
      }elseif ($mes == 3) {
        $mes_aux="MARZO";
      }elseif ($mes == 4) {
        $mes_aux="ABRIL";
      }elseif ($mes == 5) {
        $mes_aux="MAYO";
      }elseif ($mes == 6) {
        $mes_aux="JUNIO";
      }elseif ($mes == 7) {
        $mes_aux="JULIO";
      }elseif ($mes == 8) {
        $mes_aux="AGOSTO";
      }elseif ($mes ==9) {
        $mes_aux="SEPRIEMBRE";
      }elseif ($mes == 10) {
        $mes_aux="OCTUBRE";
      }elseif ($mes == 11) {
        $mes_aux="NOVIEMBRE";
      }elseif ($mes == 12) {
        $mes_aux="DICIEMBRE";
      }


      $dia= DiasMesModel::
      select('id','tipo_dia')
      ->where('dia','=',$dia)->where('mes','=',$mes_aux)->where('año','=',$year)->where('tipo_dia','=','HABIL')
      ->get(); 

      return response()->json(
        $dia->toArray());
    }


    public function calcular_reclamo($dias, $categoria, $ciclo){ 

      if($categoria == "DOCENTE"){
        $monto=TabuladorPagosModel::select('pago_docente')->where('ciclo','=',$ciclo)->first(); 
        $monto2= $monto->pago_docente * $dias;

      }elseif($categoria == "DIRECTOR"){
        $monto=TabuladorPagosModel::select('pago_director')->where('ciclo','=',$ciclo)->first(); 
        $monto2= $monto->pago_director * $dias;


      }elseif($categoria == "INTENDENTE"){
        $monto=TabuladorPagosModel::select('pago_intendente')->where('ciclo','=',$ciclo)->first(); 
        $monto2= $monto->pago_intendente * $dias;


      }elseif($categoria == "USAER"){
        $monto=TabuladorPagosModel::select('pago_docente')->where('ciclo','=',$ciclo)->first(); 
        $monto2= $monto->pago_docente * $dias;


      }elseif($categoria == "EDUCACION FISICA"){
        $monto=TabuladorPagosModel::select('pago_docente')->where('ciclo','=',$ciclo)->first(); 
        $monto2= $monto->pago_docente * $dias;

      }

      return response()->json(
        $monto2);

    }

    public function buscar_qnas($ciclo_aux){
      $ciclo=DB::table('ciclo_escolar')->where('ciclo','=',$ciclo_aux)->first();

      $qnas= TablaPagosModel::
      select('qna')
      ->where('id_ciclo','=',$ciclo->id)
      ->get(); 
      return response()->json(
        $qnas);
    }

    public function excel(Request $request, $aux)
    {

     Excel::create('REGISTRO DE INASISTENCIAS', function($excel) use($aux) {
       $excel->sheet('Excel sheet', function($sheet) use($aux) {
         $personal = InasistenciasModel::join('ciclo_escolar as ciclo_ina','ciclo_ina.id','=','inasistencias.id_ciclo')->join('captura','captura.id','=','inasistencias.id_captura')->join('centro_trabajo', 'centro_trabajo.id', '=','inasistencias.id_cct_etc')->join('region', 'region.id', '=','centro_trabajo.id_region')->select('centro_trabajo.nombre_escuela','region.region','captura.sostenimiento','inasistencias.dia','inasistencias.mes','ciclo_ina.ciclo','inasistencias.observaciones','inasistencias.estado','inasistencias.fecha_aplica')->where('ciclo_ina.id','=',$aux)->get();
         $sheet->fromArray($personal);
         $sheet->row(1,['ID','NOMBRE','RFC','TELEFONO','CCT','NOMBRE ESCUELA','REGION','SOSTENIMIENTO','FECHA DE INASISTENCIA','MES','CICLO ESCOLAR','OBSERVACIONES','ESTADO','QNA QUE SE APLICO']);
         $sheet->setOrientation('landscape');
       });
     })->export('xls');
   }


 }
