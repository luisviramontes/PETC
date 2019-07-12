<?php

namespace petc\Http\Controllers;

use Illuminate\Http\Request;

use petc\Http\Requests;
use petc\Http\Controllers\Controller;
use petc\BajasContratoModel;
use petc\CapturaModel;

use DB;
use Maatwebsite\Excel\Facades\Excel;
use PHPExcel_Worksheet_Drawing;
use Validator;
use \Milon\Barcode\DNS1D;
use \Milon\Barcode\DNS2D;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Collection as Collection;

class BajasFedController extends Controller
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
    public function index(request $request){
     if($request)
     {
       // $aux=$request->get('searchText');  
      $query=trim($request->GET('searchText')); 
      $contador= DB::table('bajas_contrato')->join('captura','captura.id','=','bajas_contrato.id_captura')->where('bajas_contrato.estado','=','PENDIENTE')->where('captura.sostenimiento','=','FEDERAL')->count();

      if ($query == ""){
        $personal= DB::table('bajas_contrato')->join('captura','captura.id','=','bajas_contrato.id_captura')->join('cat_puesto','cat_puesto.id','=','captura.clave')->join('centro_trabajo', 'centro_trabajo.id', '=','bajas_contrato.id_cct_etc')->join('region', 'region.id', '=','centro_trabajo.id_region')->join('localidades', 'localidades.id', '=','centro_trabajo.id_localidades')->join('municipios', 'municipios.id', '=','centro_trabajo.id_municipios')->join('ciclo_escolar', 'ciclo_escolar.id', '=','bajas_contrato.id_ciclo')->select('captura.*','captura.id as idcaptura','bajas_contrato.*','cat_puesto.cat_puesto','centro_trabajo.cct','centro_trabajo.nombre_escuela','ciclo_escolar.ciclo','region.region','municipios.municipio','localidades.nom_loc')->where('captura.sostenimiento','=','FEDERAL')->whereNull('bajas_contrato.id_alta')->orderBy('bajas_contrato.estado','desc')->paginate(30);

        $personal2= DB::table('bajas_contrato')->join('captura','captura.id','=','bajas_contrato.id_captura')->join('cat_puesto','cat_puesto.id','=','captura.clave')->join('centro_trabajo', 'centro_trabajo.id', '=','bajas_contrato.id_cct_etc')->select('centro_trabajo.id_region','centro_trabajo.id_localidades','centro_trabajo.id_municipios')->join('region', 'region.id', '=','centro_trabajo.id_region')->join('localidades', 'localidades.id', '=','centro_trabajo.id_localidades')->join('municipios', 'municipios.id', '=','centro_trabajo.id_municipios')->join('ciclo_escolar', 'ciclo_escolar.id', '=','bajas_contrato.id_ciclo')->join('captura as captura2','captura2.id','=','bajas_contrato.id_alta')->select('captura.*','captura.id as idcaptura','bajas_contrato.*','cat_puesto.cat_puesto','centro_trabajo.cct','centro_trabajo.nombre_escuela','ciclo_escolar.ciclo','region.region','municipios.municipio','localidades.nom_loc','captura2.nombre as nombre_alta','captura2.rfc as rfc_alta')->where('captura2.nombre','!=',' ')->where('captura.sostenimiento','=','FEDERAL')->orderBy('bajas_contrato.estado','desc')->whereNotNull('bajas_contrato.id_alta')->paginate(30);

      }else{

        $personal= DB::table('bajas_contrato')->join('captura','captura.id','=','bajas_contrato.id_captura')->join('cat_puesto','cat_puesto.id','=','captura.clave')->join('centro_trabajo', 'centro_trabajo.id', '=','bajas_contrato.id_cct_etc')->join('region', 'region.id', '=','centro_trabajo.id_region')->join('localidades', 'localidades.id', '=','centro_trabajo.id_localidades')->join('municipios', 'municipios.id', '=','centro_trabajo.id_municipios')->join('ciclo_escolar', 'ciclo_escolar.id', '=','bajas_contrato.id_ciclo')->select('captura.*','captura.id as idcaptura','bajas_contrato.*','cat_puesto.cat_puesto','centro_trabajo.cct','centro_trabajo.nombre_escuela','ciclo_escolar.ciclo','region.region','municipios.municipio','localidades.nom_loc')->where('captura.rfc','LIKE','%'.$query.'%')->orwhere('captura.nombre','LIKE','%'.$query.'%')->orderBy('bajas_contrato.estado','desc')->where('captura.sostenimiento','=','FEDERAL')->paginate(30);

        $personal2= DB::table('bajas_contrato')->join('captura','captura.id','=','bajas_contrato.id_captura')->join('cat_puesto','cat_puesto.id','=','captura.clave')->join('centro_trabajo', 'centro_trabajo.id', '=','bajas_contrato.id_cct_etc')->select('centro_trabajo.id_region','centro_trabajo.id_localidades','centro_trabajo.id_municipios')->join('region', 'region.id', '=','centro_trabajo.id_region')->join('localidades', 'localidades.id', '=','centro_trabajo.id_localidades')->join('municipios', 'municipios.id', '=','centro_trabajo.id_municipios')->join('ciclo_escolar', 'ciclo_escolar.id', '=','bajas_contrato.id_ciclo')->join('captura as captura2','captura2.id','=','bajas_contrato.id_alta')->select('captura.*','captura.id as idcaptura','bajas_contrato.*','cat_puesto.cat_puesto','centro_trabajo.cct','centro_trabajo.nombre_escuela','ciclo_escolar.ciclo','region.region','municipios.municipio','localidades.nom_loc','captura2.nombre as nombre_alta','captura2.rfc as rfc_alta')->where('captura2.nombre','!=',' ')->where('captura.rfc','LIKE','%'.$query.'%')->orwhere('captura.nombre','LIKE','%'.$query.'%')->orwhere('captura2.nombre','LIKE','%'.$query.'%')->orwhere('centro_trabajo.cct','LIKE','%'.$query.'%')->orderBy('bajas_contrato.estado','desc')->where('captura.sostenimiento','=','FEDERAL')->paginate(30);



      }   

      return view('nomina.bajas.federal.index',["personal"=>$personal,"personal2"=>$personal2,"contador"=>$contador,"searchText"=>$query]);
        // return view('nomina.tabla_pagos.index',['tabla_pagos' => $tabla_pagos,'ciclos'=> $ciclos]);
        //
    }}
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
      $claves=DB::table('cat_puesto')->get();
      $cct=DB::table('centro_trabajo')->get();
      $ciclos=DB::table('ciclo_escolar')->get();

      $personal= DB::table('bajas_contrato')->join('captura','captura.id','=','bajas_contrato.id_captura')->join('cat_puesto','cat_puesto.id','=','captura.clave')->join('centro_trabajo', 'centro_trabajo.id', '=','bajas_contrato.id_cct_etc')->select('centro_trabajo.id_region','centro_trabajo.id_localidades','centro_trabajo.id_municipios')->join('region', 'region.id', '=','centro_trabajo.id_region')->join('localidades', 'localidades.id', '=','centro_trabajo.id_localidades')->join('municipios', 'municipios.id', '=','centro_trabajo.id_municipios')->join('ciclo_escolar', 'ciclo_escolar.id', '=','bajas_contrato.id_ciclo')->select('captura.*','bajas_contrato.*','cat_puesto.cat_puesto','centro_trabajo.cct','centro_trabajo.nombre_escuela','ciclo_escolar.ciclo','region.region','municipios.municipio','localidades.nom_loc')->where('bajas_contrato.id','=',$id)->first();

      return view('nomina.bajas.federal.edit', ['claves'=> $claves,'cct'=>$cct,'ciclos'=>$ciclos,'personal'=>$personal]);
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
      $user = Auth::user()->name;
     // $aux=$request->get('clave');
      //$name = explode("_",$aux);

      $datos=BajasContratoModel::findOrFail($id);
      //$datos->id_alta=$request->get('docente_cubrir');
      $datos->fecha_baja=$request->get('fechaf');
      $datos->documentacion_entregada=$request->get('doc');
      $datos->observaciones=$request->get('observaciones');
      $datos->captura=$user;
      $datos->estado="PENDIENTE";
      //$datos->clave=$name[0];
      $datos->id_cct_etc=$request->get('cct');
      //$datos->categoria=$request->get('puesto');
      $datos->id_ciclo=$request->get('ciclo_escolar');  
      $datos->update();


     $tabla=CapturaModel::findOrFail($datos->id_captura);
     $tabla->fecha_termino=$request->get('fechaf');
     $tabla->documentacion_entregada=$request->get('doc');
     $tabla->observaciones=$request->get('observaciones');
     $tabla->captura=$user;
     $tabla->id_ciclo=$request->get('ciclo_escolar'); 
     $tabla->id_cct_etc=$request->get('cct'); 
     $tabla->tipo_movimiento="BAJA";
     $tabla->cct_2=$request->get('cct_2');
     $tabla->num_escuelas=$request->get('num_escuelas');
     $tabla->dias_trabajados=$request->get('diassemana');
     $tabla->update();


      return redirect('bajasfed');
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
      $user = Auth::user()->name;
      $bajas=BajasContratoModel::findOrFail($id);
      $bajas->estado="PENDIENTE";
      $bajas->captura=$user;
      $bajas->update();
      return redirect('bajasfed');
        //
    }

    public function activar($id)
    { 
      $user = Auth::user()->name;
      $bajas=BajasContratoModel::findOrFail($id);
      $bajas->estado="RESUELTO";
      $bajas->captura=$user;
      $bajas->update();
      return redirect('bajasfed');
        //
    }

    public function excel(Request $request)
    {
     Excel::create('BAJAS FEDERAL', function($excel) {
       $excel->sheet('Excel sheet', function($sheet) {
         $personal = BajasContratoModel::join('captura','captura.id','=','bajas_contrato.id_captura')->join('cat_puesto','cat_puesto.id','=','captura.clave')->join('centro_trabajo', 'centro_trabajo.id', '=','bajas_contrato.id_cct_etc')->join('region', 'region.id', '=','centro_trabajo.id_region')->join('ciclo_escolar', 'ciclo_escolar.id', '=','bajas_contrato.id_ciclo')->select('bajas_contrato.id','captura.nombre','captura.rfc','captura.fecha_inicio','captura.fecha_termino','centro_trabajo.cct','centro_trabajo.nombre_escuela','captura.categoria','cat_puesto.cat_puesto','region.region','captura.sostenimiento','captura.telefono','captura.email','captura.num_escuelas','captura.observaciones','bajas_contrato.estado','ciclo_escolar.ciclo')->where('bajas_contrato.estado','=','PENDIENTE')->where('captura.sostenimiento','=','FEDERAL')->get();
         $sheet->fromArray($personal);
         $sheet->row(1,['ID','NOMBRE','RFC','FECHA DE INICIO','FECHA DE TERMINO','CCT','NOMBRE ESCUELA','CATEGORIA','CLAVE','REGION','SOSTENIMIENTO','TELEFONO','EMAIL','NUM DE ESCUELAS ETC','OBSERVACIONES','ESTADO ALTA','CICLO ESCOLAR']);
         $sheet->setOrientation('landscape');
       });
     })->export('xls');
   }

 }
