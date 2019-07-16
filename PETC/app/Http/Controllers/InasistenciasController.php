<?php

namespace petc\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use petc\Http\Requests;

use petc\Http\Controllers\Controller;

use petc\CapturaModel;
use petc\ListasAsistenciaModel;
use petc\DiasMesModel;
use petc\InasistenciasModel;
use petc\CentroTrabajoModel;


use DB;
use Maatwebsite\Excel\Facades\Excel;
use PHPExcel_Worksheet_Drawing;
use Validator;
use \Milon\Barcode\DNS1D;
use \Milon\Barcode\DNS2D;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Collection as Collection;

class InasistenciasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
      $this->middleware('auth');
    }
    public function index(request $request,$id){ 
      $tipo_usuario = Auth::user()->tipo_usuario;
      if($tipo_usuario <> "2" || $tipo_usuario=="5"){
       return view('permisos');

     }else{
      if($request)
      {
       // $aux=$request->get('searchText');
        $query=trim($request->GET('searchText'));
        $qnas=DB::table('tabla_pagos')->where('id_ciclo','=',$id)->get();
        $ciclos=DB::table('ciclo_escolar')->get();

        $contador= DB::table('inasistencias')->where('inasistencias.estado','=','PENDIENTE')->where('inasistencias.id_ciclo','=',$id)->count(); 

        if ($query == ""){ 
          $personal= DB::table('inasistencias')->join('ciclo_escolar as ciclo_ina','ciclo_ina.id','=','inasistencias.id_ciclo')->join('captura','captura.id','=','inasistencias.id_captura')->join('cat_puesto','cat_puesto.id','=','captura.clave')->join('centro_trabajo', 'centro_trabajo.id', '=','captura.id_cct_etc')->select('centro_trabajo.id_region','centro_trabajo.id_localidades','centro_trabajo.id_municipios')->join('region', 'region.id', '=','centro_trabajo.id_region')->join('localidades', 'localidades.id', '=','centro_trabajo.id_localidades')->join('municipios', 'municipios.id', '=','centro_trabajo.id_municipios')->join('ciclo_escolar', 'ciclo_escolar.id', '=','captura.id_ciclo')->select('captura.*','captura.id as idcaptura','inasistencias.*','inasistencias.observaciones as observaciones_ina','ciclo_ina.ciclo as ciclo_ina','cat_puesto.cat_puesto','centro_trabajo.cct','centro_trabajo.nombre_escuela','ciclo_escolar.ciclo','region.region','municipios.municipio','localidades.nom_loc')->orderBy('inasistencias.estado','desc')->where('inasistencias.id_ciclo','=',$id)->paginate(30);
        }else{
          $personal= DB::table('inasistencias')->where('inasistencias.id_ciclo','=',$id)->join('ciclo_escolar as ciclo_ina','ciclo_ina.id','=','inasistencias.id_ciclo')->join('captura','captura.id','=','inasistencias.id_captura')->join('cat_puesto','cat_puesto.id','=','captura.clave')->join('centro_trabajo', 'centro_trabajo.id', '=','captura.id_cct_etc')->select('centro_trabajo.id_region','centro_trabajo.id_localidades','centro_trabajo.id_municipios')->join('region', 'region.id', '=','centro_trabajo.id_region')->join('localidades', 'localidades.id', '=','centro_trabajo.id_localidades')->join('municipios', 'municipios.id', '=','centro_trabajo.id_municipios')->join('ciclo_escolar', 'ciclo_escolar.id', '=','captura.id_ciclo')->select('captura.*','ciclo_ina.ciclo as ciclo_ina','captura.id as idcaptura','inasistencias.*','inasistencias.observaciones as observaciones_ina','cat_puesto.cat_puesto','centro_trabajo.cct','centro_trabajo.nombre_escuela','ciclo_escolar.ciclo','region.region','municipios.municipio','localidades.nom_loc')->orderBy('inasistencias.estado','desc')->where('captura.rfc','LIKE','%'.$query.'%')->orwhere('captura.nombre','LIKE','%'.$query.'%')->orwhere('centro_trabajo.cct','LIKE','%'.$query.'%')->paginate(30);
        }}
        return view('nomina.inasistencias.index',["qnas"=>$qnas,"personal"=>$personal,"contador"=>$contador,"searchText"=>$query,"ciclos"=>$ciclos,"id"=>$id]);

        //
      }}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $tipo_usuario = Auth::user()->tipo_usuario;
      if($tipo_usuario <> "2" || $tipo_usuario=="5"){
       return view('permisos');

     }else{
      $claves=DB::table('cat_puesto')->get();
      $cct=DB::table('centro_trabajo')->get();
      $captura=DB::table('captura')->get();
      $ciclos=DB::table('ciclo_escolar')->get();

      return view('nomina.inasistencias.create', ['claves'=> $claves,'cct'=>$cct,'ciclos'=>$ciclos]);

        //
    }}

    public function validarLista($cct,$mes,$ciclo){ 
      $ciclo=DB::table('ciclo_escolar')->where('ciclo','=',$ciclo)->first();

      $personal= ListasAsistenciaModel::
      select('id','estado')
      ->where('id_centro_trabajo','=',$cct)->where('mes','=',$mes)->where('id_ciclo','=',$ciclo->id)
      ->get(); 

      return response()->json(
        $personal->toArray());
    }

    public function validarLista2($cct,$mes,$ciclo){ 
      $personal= ListasAsistenciaModel::
      select('id','estado')
      ->where('id_centro_trabajo','=',$cct)->where('mes','=',$mes)->where('id_ciclo','=',$ciclo)
      ->get(); 

      return response()->json(
        $personal->toArray());
    }

    public function BuscaPersonal($cct){
      $personal= CapturaModel::
      select('captura.id','captura.nombre','captura.rfc','captura.categoria','captura.estado')
      ->where('captura.id_cct_etc','=',$cct)->where('captura.estado','=','ACTIVO')
      ->get(); 

      return response()->json(
        $personal->toArray());
    }

    public function BuscaDias($mes,$ciclo){
      $personal= DiasMesModel::
      select('id','dia','l_semana')
      ->where('mes','=',$mes)->where('ciclo','=',$ciclo)->where('tipo_dia','=','HABIL')
      ->get(); 

      return response()->json(
        $personal->toArray());
    }

    public function BuscaFaltas($mes,$ciclo){
      $personal= DiasMesModel::
      select('id','dia','l_semana')
      ->where('mes','=',$mes)->where('ciclo','=',$ciclo)->where('tipo_dia','=','HABIL')
      ->get(); 

      return response()->json(
        $personal->toArray());
    }

    public function BuscaInasistencias($cct,$ciclo,$mes){
     $ciclo=DB::table('ciclo_escolar')->where('ciclo','=',$ciclo)->first();

     $personal= InasistenciasModel::select('observaciones','fecha_aplica','estado','mes','dia','id_captura')
     ->where('id_cct_etc','=',$cct)->where('id_ciclo','=',$ciclo->id)->where('mes','=',$mes)
     ->get(); 

     return response()->json(
      $personal->toArray());
   }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $tipo_usuario = Auth::user()->tipo_usuario;
      if($tipo_usuario <> "2" || $tipo_usuario=="5"){
       return view('permisos');

     }else{
      $user = Auth::user()->name;

      $inasistencias=$request->get('inasistencias');
      $first = head($inasistencias);
      $name = explode(",",$first); 
      $x= count($name);
      for ($i=0; $i < $x ; $i++) { 
        $tabla= new InasistenciasModel;
            //$first2 = head($name[$i]);
        $name2 = explode("-",$name[$i]); 
            //print_r($name2[0]);   
        $tabla->id_captura=$name2[0]; 
        $tabla->mes=$request->get('mes');

        $ciclo=$request->get('ciclo_escolar');
        $ciclo_e= DB::table('ciclo_escolar')->where('ciclo_escolar.ciclo','=',$ciclo)->select('ciclo_escolar.id')->first();
        $tabla->id_ciclo=$ciclo_e->id;

        $cct=$request->get('cct');
        $name3 = explode("_",$cct); 
        $tabla->id_cct_etc=$name3[2];
        $tabla->dia=$name2[2];
        $tabla->estado="PENDIENTE";
        $tabla->observaciones=$request->get('observaciones');
        $tabla->captura=$user;
        $tabla->save();
            # code...
      }



      $tabla2= new ListasAsistenciaModel;
      $tabla2->id_centro_trabajo=$tabla->id_cct_etc;
      $tabla2->mes=$request->get('mes');
      $tabla2->id_ciclo=$tabla->id_ciclo;
      $tabla2->estado="ACTIVO";
      $tabla2->observaciones=$request->get('observaciones');
      $tabla2->captura=$user;
      $tabla2->save();
      return Redirect::to('inasistencias2/1'); 
        //

    }}

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
      $tipo_usuario = Auth::user()->tipo_usuario;
      if($tipo_usuario <> "2" || $tipo_usuario=="5"){
       return view('permisos');

     }else{
      $claves=DB::table('cat_puesto')->get();
      $cct=DB::table('centro_trabajo')->get();
      $ciclos=DB::table('ciclo_escolar')->get();

      
      $inasistencias=InasistenciasModel::findOrFail($id);

      $personal= DB::table('inasistencias')->where('inasistencias.id','=',$id)->join('centro_trabajo','centro_trabajo.id','=','inasistencias.id_cct_etc')->join('captura','captura.id','=','inasistencias.id_captura')->select('captura.id as id_captura','captura.nombre as nombre','captura.categoria','captura.rfc as rfc','centro_trabajo.nombre_escuela','inasistencias.*')->first();


      $aux=$inasistencias->id_captura;
     // $personal=CapturaModel::findOrFail($aux);

      

      return view('nomina.inasistencias.edit', ['claves'=> $claves,'cct'=>$cct,'ciclos'=>$ciclos,'personal'=>$personal]);
        //
    }}

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      $tipo_usuario = Auth::user()->tipo_usuario;
      if($tipo_usuario <> "2" || $tipo_usuario=="5"){
       return view('permisos');

     }else{
      $user = Auth::user()->name;

      $inasistencias=$request->get('inasistencias');
      $first = head($inasistencias);
      $name = explode(",",$first); 
      $x= count($name);


      for ($i=0; $i < $x ; $i++) { 
        if($i == 0){
          $inasistencias=InasistenciasModel::findOrFail($id);
        }else{
          $inasistencias= new InasistenciasModel;
        }
        $inasistencias->id_captura=$request->get('personal');
            //$first2 = head($name[$i]);
        $name2 = explode("-",$name[$i]); 
            //print_r($name2[0]);   -
        $inasistencias->id_captura=$name2[0]; 
        $inasistencias->mes=$request->get('mes');

        $ciclo=$request->get('ciclo_escolar');
        $ciclo_e= DB::table('ciclo_escolar')->where('ciclo_escolar.ciclo','=',$ciclo)->select('ciclo_escolar.id')->first();
        $inasistencias->id_ciclo=$ciclo_e->id;
        $cct=$request->get('cct');
        print_r($cct);
        $name3 = explode("_",$cct);
        print_r($name3); 
        $inasistencias->id_cct_etc=$name3[2];
        $inasistencias->dia=$name2[2];
        $inasistencias->estado="PENDIENTE";
        $inasistencias->observaciones=$request->get('observaciones');
        $inasistencias->captura=$user;

        if($i == 0){
          $inasistencias->update();
        }else{
          $inasistencias->save();
        }


        //
      } return Redirect::to('inasistencias2/1');}}

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
      $tipo_usuario = Auth::user()->tipo_usuario;
      if($tipo_usuario <> "2" || $tipo_usuario=="5"){
       return view('permisos');

     }else{
      $user = Auth::user()->name;
      $tabla=InasistenciasModel::findOrFail($id);
      $tabla->estado= "APLICADA";
      $tabla->captura=$user;
      $tabla->fecha_aplica=$request->get('qna'.$id);
      $tabla->update();

      return Redirect::to('inasistencias2/1'); 

        //
    }}

    public function inactivar($id)
    {
      $tipo_usuario = Auth::user()->tipo_usuario;
      if($tipo_usuario <> "2" || $tipo_usuario=="5"){
       return view('permisos');

     }else{
      $tabla=InasistenciasModel::findOrFail($id);
      $tabla->delete();

      return Redirect::to('inasistencias2/1'); 

        //
    }}

    public function verInformacion($id,$ciclo)
    {
      $nombre=DB::table('captura')->select('captura.nombre','captura.id')->where('id','=',$id)->first();
      $ciclos=DB::table('ciclo_escolar')->get();
      $personal= DB::table('captura')->join('cat_puesto','cat_puesto.id','=','captura.clave')->join('centro_trabajo', 'centro_trabajo.id', '=','captura.id_cct_etc')->select('centro_trabajo.id_region','centro_trabajo.id_localidades','centro_trabajo.id_municipios')->join('region', 'region.id', '=','centro_trabajo.id_region')->join('localidades', 'localidades.id', '=','centro_trabajo.id_localidades')->join('municipios', 'municipios.id', '=','centro_trabajo.id_municipios')->join('ciclo_escolar', 'ciclo_escolar.id', '=','captura.id_ciclo')->select('captura.*','captura.id as idcaptura','cat_puesto.cat_puesto','centro_trabajo.cct','centro_trabajo.nombre_escuela','ciclo_escolar.ciclo','region.region','municipios.municipio','localidades.nom_loc')->where('captura.id','=',$id)->where('captura.id_ciclo','=',$ciclo)->get();

      $inasistencias= DB::table('inasistencias')->join('ciclo_escolar as ciclo_ina','ciclo_ina.id','=','inasistencias.id_ciclo')->join('centro_trabajo as centro_ina', 'centro_ina.id', '=','inasistencias.id_cct_etc')->select('inasistencias.*','inasistencias.observaciones as observaciones_ina','ciclo_ina.ciclo as ciclo_ina','centro_ina.nombre_escuela as nombre_escuela_ina','centro_ina.cct as cct_ina','inasistencias.estado as estado_ina')->where('inasistencias.id_captura','=',$id)->where('inasistencias.id_ciclo','=',$ciclo)->get();

      $total_ina=DB::table('inasistencias')->where('inasistencias.id_captura','=',$id)->where('inasistencias.id_ciclo','=',$ciclo)->count();


      $ciclo_aux=$ciclo;

      return view('nomina.inasistencias.verinformacion', ['personal'=>$personal,'ciclos'=>$ciclos,'nombre'=>$nombre,'ciclo_aux'=>$ciclo_aux,'inasistencias'=>$inasistencias,'total_ina'=>$total_ina]); 

        //
    }

    public function invoice($id,$ciclo){
      $nombre_ciclo = DB::table('ciclo_escolar')->select('ciclo_escolar.ciclo')->where('ciclo_escolar.id','=',$ciclo)->first();

      $personal= DB::table('captura')->join('cat_puesto','cat_puesto.id','=','captura.clave')->join('centro_trabajo', 'centro_trabajo.id', '=','captura.id_cct_etc')->select('centro_trabajo.id_region','centro_trabajo.id_localidades','centro_trabajo.id_municipios')->join('region', 'region.id', '=','centro_trabajo.id_region')->join('localidades', 'localidades.id', '=','centro_trabajo.id_localidades')->join('municipios', 'municipios.id', '=','centro_trabajo.id_municipios')->join('ciclo_escolar', 'ciclo_escolar.id', '=','captura.id_ciclo')->select('captura.*','cat_puesto.cat_puesto','centro_trabajo.cct','centro_trabajo.nombre_escuela','ciclo_escolar.ciclo','region.region','municipios.municipio','localidades.nom_loc')->where('captura.id','=',$id)->first();

      $inasistencias= DB::table('inasistencias')->join('ciclo_escolar as ciclo_ina','ciclo_ina.id','=','inasistencias.id_ciclo')->join('centro_trabajo as centro_ina', 'centro_ina.id', '=','inasistencias.id_cct_etc')->select('inasistencias.*','inasistencias.observaciones as observaciones_ina','ciclo_ina.ciclo as ciclo_ina','centro_ina.nombre_escuela as nombre_escuela_ina','centro_ina.cct as cct_ina','inasistencias.estado as estado_ina')->where('inasistencias.id_captura','=',$id)->where('inasistencias.id_ciclo','=',$ciclo)->get();

      $total_ina=DB::table('inasistencias')->where('inasistencias.id_captura','=',$id)->where('inasistencias.id_ciclo','=',$ciclo)->count();

      $view =  \View::make('nomina.inasistencias.invoice', compact('personal','inasistencias','nombre_ciclo'))->render();
        //->setPaper($customPaper, 'landscape');
      $pdf = \App::make('dompdf.wrapper');
      $pdf->loadHTML($view);
      return $pdf->stream('invoice');

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

   public function excel2(Request $request, $id,$ciclo)
   {
     Excel::create('REGISTRO DE INASISTENCIAS POR EMPLEADO', function($excel)use($ciclo,$id)  {
       $excel->sheet('Excel sheet', function($sheet )use($ciclo,$id) {
         $personal = InasistenciasModel::join('ciclo_escolar as ciclo_ina','ciclo_ina.id','=','inasistencias.id_ciclo')->join('captura','captura.id','=','inasistencias.id_captura')->join('centro_trabajo', 'centro_trabajo.id', '=','inasistencias.id_cct_etc')->join('region', 'region.id', '=','centro_trabajo.id_region')->select('centro_trabajo.nombre_escuela','region.region','captura.sostenimiento','inasistencias.dia','inasistencias.mes','ciclo_ina.ciclo','inasistencias.observaciones','inasistencias.estado','inasistencias.fecha_aplica')->where('ciclo_ina.id','=',$ciclo)->where('captura.id','=',$id)->get();
         $sheet->fromArray($personal);
         $sheet->row(1,['ID','NOMBRE','RFC','TELEFONO','CCT','NOMBRE ESCUELA','REGION','SOSTENIMIENTO','FECHA DE INASISTENCIA','MES','CICLO ESCOLAR','OBSERVACIONES','ESTADO','QNA QUE SE APLICO']);
         $sheet->setOrientation('landscape');
       });
     })->export('xls');
   }

   public function excel3(Request $request, $id,$ciclo)
   {
     Excel::create('REGISTRO DE INASISTENCIAS POR CCT', function($excel)use($ciclo,$id)  {
       $excel->sheet('Excel sheet', function($sheet )use($ciclo,$id) {
         $personal = InasistenciasModel::join('ciclo_escolar as ciclo_ina','ciclo_ina.id','=','inasistencias.id_ciclo')->join('captura','captura.id','=','inasistencias.id_captura')->join('centro_trabajo', 'centro_trabajo.id', '=','inasistencias.id_cct_etc')->join('region', 'region.id', '=','centro_trabajo.id_region')->select('centro_trabajo.nombre_escuela','region.region','captura.sostenimiento','inasistencias.dia','inasistencias.mes','ciclo_ina.ciclo','inasistencias.observaciones','inasistencias.estado','inasistencias.fecha_aplica')->where('ciclo_ina.id','=',$ciclo)->where('inasistencias.id_cct_etc','=',$id)->get();
         $sheet->fromArray($personal);
         $sheet->row(1,['ID','NOMBRE','RFC','TELEFONO','CCT','NOMBRE ESCUELA','REGION','SOSTENIMIENTO','FECHA DE INASISTENCIA','MES','CICLO ESCOLAR','OBSERVACIONES','ESTADO','QNA QUE SE APLICO']);
         $sheet->setOrientation('landscape');
       });
     })->export('xls');
   }

   public function generar_listas()
   {
    $cct=DB::table('centro_trabajo')->get();
    $ciclos=DB::table('ciclo_escolar')->get();
    $region=DB::table('region')->get();

    return view('nomina.listas_asistencias.generar', ['cct'=>$cct,'ciclos'=>$ciclos,'region'=>$region]);  

  }

  public function generar_pdf_listas(Request $request){
     $user = Auth::user()->name;

    $mes=$request->get('mes');
    $ciclo_aux=$request->get('ciclo_escolar');
    $ciclo=DB::table('ciclo_escolar')->where('ciclo','=',$ciclo_aux)->first();

    $todos=$request->get('option1');
    $region=$request->get('region');
    $escuelas=$request->get('option2');
    $cct=$request->get('cct');

    if ($todos == "1") {
      $centros= CentroTrabajoModel::join('centro_trabajo.id','directorio_regional','directorio_regional.id_region','=','centro_trabajo.id_region')->join('director_cct','director_cct.id_cct_etc','=','centro_trabajo.id')->join('captura','captura.id','=','director_cct.id_captura')->select('captura.nombre','centro_trabajo.cct','centro_trabajo.nombre_escuela','directorio_regional.director_regional','directorio_regional.nombre_enlace')->where('centro_trabajo.estado','=','ACTIVO')->orderBy('centro_trabajo.id','desc')->get();
      $cuenta_centro=count($centros);
      for ($i=0; $i < $cuenta_centro; $i++) { 

      $lista= new ListasAsistenciaModel;
      $lista ->id_centro_trabajo = $centros[$i]->id;
      $lista ->mes = $mes;
      $lista ->estado = "PENDIENTE";
      $lista ->observaciones = $request ->observaciones;
      $lista ->captura=$user;
      $lista ->id_ciclo=$ciclo->id;
      $lista->save();
        # code...
      }

      $captura=CapturaModel::select('captura.nombre','captura.rfc','captura.categoria','captura.id_cct_etc')->where('estado','=','ACTIVO')->orderBy('id_cct_etc','desc')->get();
      # code...
    }else{
      if($escuelas == "1"){
        $centros= CentroTrabajoModel::join('directorio_regional','directorio_regional.id_region','=','centro_trabajo.id_region')->join('director_cct','director_cct.id_cct_etc','=','centro_trabajo.id')->join('captura','captura.id','=','director_cct.id_captura')->select('centro_trabajo.id','captura.nombre','centro_trabajo.cct','centro_trabajo.nombre_escuela','directorio_regional.director_regional','directorio_regional.nombre_enlace')->where('centro_trabajo.estado','=','ACTIVO')->where('centro_trabajo.id_region','=',$region)->orderBy('centro_trabajo.id','desc')->get();

        $captura=CapturaModel::join('centro_trabajo','centro_trabajo.id','=','captura.id_cct_etc')->select('captura.nombre','captura.rfc','captura.categoria','captura.id_cct_etc')->where('centro_trabajo.id_region','=',$region)->where('captura.estado','=','ACTIVO')->orderBy('centro_trabajo.id','desc')->get();

         $cuenta_centro=count($centros);
      for ($i=0; $i < $cuenta_centro; $i++) { 

      $lista= new ListasAsistenciaModel;
      $lista ->id_centro_trabajo = $centros[$i]->id;
      $lista ->mes = $mes;
      $lista ->estado = "PENDIENTE";
      $lista ->observaciones = $request ->observaciones;
      $lista ->captura=$user;
      $lista ->id_ciclo=$ciclo->id;
      $lista->save();
        # code...
      }

        
      }else{
       $centros= CentroTrabajoModel::join('directorio_regional','directorio_regional.id_region','=','centro_trabajo.id_region')->join('director_cct','director_cct.id_cct_etc','=','centro_trabajo.id')->join('captura','captura.id','=','director_cct.id_captura')->select('centro_trabajo.id','captura.nombre','centro_trabajo.cct','centro_trabajo.nombre_escuela','directorio_regional.director_regional','directorio_regional.nombre_enlace')->where('centro_trabajo.estado','=','ACTIVO')->where('centro_trabajo.id','=',$cct)->orderBy('centro_trabajo.id','desc')->get();

       $captura=CapturaModel::join('centro_trabajo','centro_trabajo.id','=','captura.id_cct_etc')->select('captura.nombre','captura.rfc','captura.categoria','captura.id_cct_etc')->where('centro_trabajo.id','=',$cct)->where('captura.estado','=','ACTIVO')->orderBy('centro_trabajo.id','desc')->get();

        $cuenta_centro=count($centros);
      for ($i=0; $i < $cuenta_centro; $i++) { 

      $lista= new ListasAsistenciaModel;
      $lista ->id_centro_trabajo = $centros[$i]->id;
      $lista ->mes = $mes;
      $lista ->estado = "PENDIENTE";
      $lista ->observaciones = $request ->observaciones;
      $lista ->captura=$user;
      $lista ->id_ciclo=$ciclo->id;
      $lista->save();
        # code...
      }

     }
   }
   $mes_aux = $mes;
   $dias=DiasMesModel::select('l_semana','dia')->where('mes','=',$mes)->where('tipo_dia','=','HABIL')->where('ciclo','=',$ciclo_aux)->get();
  //print_r($meses);
   $cuenta=count($centros);
   $cuenta_dias=count($dias);
   $captura_n=count($captura);

   $view =  \View::make('nomina.listas_asistencias.invoice_listas', compact('captura_n','captura','ciclo_aux','centros','dias','mes_aux','cuenta','cuenta_dias'))->render();
        //->setPaper($customPaper, 'landscape');
   $pdf = \App::make('dompdf.wrapper');
   $pdf->loadHTML($view);
   return $pdf->stream('invoice_listas.pdf');



 }

 public function busca_escuelas_region($id_region){


   $centro= CentroTrabajoModel::select('id','cct','nombre_escuela')
   ->where('id_region','=',$id_region)->where('estado','=','ACTIVO')
   ->get(); 

   return response()->json(
    $centro->toArray());
 }

}
