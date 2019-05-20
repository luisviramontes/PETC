<?php

namespace petc\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use petc\Http\Requests;

use petc\Http\Controllers\Controller;
use petc\CapturaModel;
use petc\AltasContratoModel;
use petc\BajasContratoModel;
use petc\ExtencionContratoModel;

use DB;
use Maatwebsite\Excel\Facades\Excel;
use PHPExcel_Worksheet_Drawing;
use Validator;
use \Milon\Barcode\DNS1D;
use \Milon\Barcode\DNS2D;
use petc\Http\Requests\CapturaRequest;

class CapturaController extends Controller
{ 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(request $request)
    {

     if($request)
     {
       // $aux=$request->get('searchText');
      $query=trim($request->GET('searchText')); 


      $personal= DB::table('captura')->join('cat_puesto','cat_puesto.id','=','captura.clave')->join('centro_trabajo', 'centro_trabajo.id', '=','captura.id_cct_etc')->select('centro_trabajo.id_region','centro_trabajo.id_localidades','centro_trabajo.id_municipios')->join('region', 'region.id', '=','centro_trabajo.id_region')->join('localidades', 'localidades.id', '=','centro_trabajo.id_localidades')->join('municipios', 'municipios.id', '=','centro_trabajo.id_municipios')->join('ciclo_escolar', 'ciclo_escolar.id', '=','captura.id_ciclo')->select('captura.*','cat_puesto.cat_puesto','centro_trabajo.cct','centro_trabajo.nombre_escuela','ciclo_escolar.ciclo','region.region','municipios.municipio','localidades.nom_loc')->where('captura.estado','=','ACTIVO')->where('captura.rfc','LIKE','%'.$query.'%')->orwhere('captura.nombre','LIKE','%'.$query.'%')->paginate(30);

      return view('nomina.captura.index',["personal"=>$personal,"searchText"=>$query]);
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
      $claves=DB::table('cat_puesto')->get();
      $cct=DB::table('centro_trabajo')->get();
      $ciclos=DB::table('ciclo_escolar')->get();

      return view('nomina.captura.create', ['claves'=> $claves,'cct'=>$cct,'ciclos'=>$ciclos]);
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
     $tabla= new CapturaModel;
     $tabla->nombre=$request->get('nombre');
     $tabla->rfc=$request->get('rfc_input');
     $tabla->telefono=$request->get('telefono');
     $tabla->email=$request->get('email');

     $aux=$request->get('clave');

     $name = explode("_",$aux);
     $tabla->clave=$name[0];

     $tabla->id_cct_etc=$request->get('cct');
     $tabla->sostenimiento=$request->get('sostenimiento');
     $tabla->estado=$request->get('estado');
     $tabla->pagos_registrados=$request->get('pagos_registrados');
     $tabla->qna_actual=$request->get('qna_actual');
     $tabla->fecha_inicio=$request->get('fechai');
     $tabla->fecha_termino=$request->get('fechaf');
     $tabla->num_escuelas=$request->get('num_escuelas');
     $tabla->dias_trabajados=$request->get('diassemana');
     $tabla->sostenimiento=$request->get('sostenimiento');
     $tabla->categoria=$request->get('puesto');
     $tabla->pagos_registrados="0";
     $tabla->qna_actual="0";
     $tabla->cct_2=$request->get('cct_2');
     $tabla->documentacion_entregada=$request->get('doc');
     $tabla->observaciones=$request->get('observaciones');
     $tabla->captura="ADMINISTRADOR";
     $tabla->estado="ACTIVO";
     $tabla->id_ciclo=$request->get('ciclo_escolar'); 
     $tabla->tipo_movimiento=$request->get('movimiento');
     $tabla->save();
     $ultimo = CapturaModel::orderBy('id', 'desc')->first()->id;

     $mov =$request->get('movimiento'); 

     if($mov == "ALTA"){
      $datos= new AltasContratoModel;
      $datos->id_captura=$ultimo;
      $datos->id_baja=$request->get('docente_cubrir');
      $datos->fecha_inicio=$request->get('fechai');
      $datos->fecha_baja=$request->get('fechaf');
      $datos->documentacion_entregada=$request->get('doc');
      $datos->observaciones=$request->get('observaciones');
      $datos->captura="ADMINISTRADOR";
      $datos->estado="PENDIENTE";
      $datos->clave=$name[0];
      $datos->id_cct_etc=$request->get('cct'); 
      $datos->categoria=$request->get('puesto');
      $datos->id_ciclo=$request->get('ciclo_escolar');
      $datos->tipo_movimiento=$request->get('movimiento'); 
      $datos->save();
      $datos2= new BajasContratoModel;
      $datos2->id_captura=$request->get('docente_cubrir');
      $datos2->id_alta=$datos->id_captura;
      $datos2->id_cct_etc=$request->get('cct'); 
      $datos2->fecha_baja=$request->get('fechaf');
      $datos2->documentacion_entregada=$request->get('doc');
      $datos2->observaciones=$request->get('observaciones');
      $datos2->captura="ADMINISTRADOR";
      $datos2->estado="PENDIENTE";
      $datos2->id_ciclo=$request->get('ciclo_escolar'); 
      $datos2->save();
      $baja=CapturaModel::findOrFail($datos2->id_captura);
      $baja->estado="INACTIVO";
      $baja->captura="ADMINISTRADOR";
      $baja->update();


    }elseif ($mov == "INICIO") {
      $datos= new AltasContratoModel;
      $datos->id_captura=$ultimo;
      $datos->fecha_inicio=$request->get('fechai');
      $datos->fecha_baja=$request->get('fechaf');
      $datos->documentacion_entregada=$request->get('doc');
      $datos->observaciones=$request->get('observaciones');
      $datos->captura="ADMINISTRADOR";
      $datos->estado="PENDIENTE";
      $datos->clave=$name[0];
      $datos->id_cct_etc=$request->get('cct');
      $datos->categoria=$request->get('puesto');
      $datos->id_ciclo=$request->get('ciclo_escolar'); 
      $datos->tipo_movimiento=$request->get('movimiento'); 
      $datos->save();
    }else if ($mov == "NUEVO"){
      $datos= new AltasContratoModel;
      $datos->id_captura=$ultimo;
      $datos->fecha_inicio=$request->get('fechai');
      $datos->fecha_baja=$request->get('fechaf');
      $datos->documentacion_entregada=$request->get('doc');
      $datos->observaciones=$request->get('observaciones');
      $datos->captura="ADMINISTRADOR";
      $datos->estado="PENDIENTE";
      $datos->clave=$name[0];
      $datos->id_cct_etc=$request->get('cct');
      $datos->categoria=$request->get('puesto');
      $datos->id_ciclo=$request->get('ciclo_escolar'); 
      $datos->tipo_movimiento=$request->get('movimiento'); 
      $datos->save();

    }

    return Redirect::to('captura'); 
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

      $personal=CapturaModel::findOrFail($id);

      return view('nomina.captura.edit', ['claves'=> $claves,'cct'=>$cct,'ciclos'=>$ciclos,'personal'=>$personal]);


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

     $tabla=CapturaModel::findOrFail($id);
     $tabla->nombre=$request->get('nombre');
     $tabla->rfc=$request->get('rfc_input');
     $tabla->telefono=$request->get('telefono');
     $tabla->email=$request->get('email');

     $aux=$request->get('clave');

     $name = explode("_",$aux);
     $tabla->clave=$name[0];

     $tabla->id_cct_etc=$request->get('cct');
     $tabla->sostenimiento=$request->get('sostenimiento');
     $tabla->estado=$request->get('estado');
     $tabla->pagos_registrados=$request->get('pagos_registrados');
     $tabla->qna_actual=$request->get('qna_actual');
     $tabla->fecha_inicio=$request->get('fechai');
     $tabla->fecha_termino=$request->get('fechaf');
     $tabla->num_escuelas=$request->get('num_escuelas');
     $tabla->dias_trabajados=$request->get('diassemana');
     $tabla->sostenimiento=$request->get('sostenimiento');
     $tabla->categoria=$request->get('puesto');
     //$tabla->pagos_registrados="0";
     $tabla->qna_actual="0";
     $tabla->cct_2=$request->get('cct_2');
     $tabla->documentacion_entregada=$request->get('doc');
     $tabla->observaciones=$request->get('observaciones');
     $tabla->captura="ADMINISTRADOR";
     $tabla->estado="ACTIVO";
     $tabla->id_ciclo=$request->get('ciclo_escolar'); 
     $tabla->tipo_movimiento=$request->get('movimiento');
     $tabla->update();

     $mov =$request->get('movimiento'); 

     if($mov == "ALTA"){
      $datos= new AltasContratoModel;
      $datos->id_captura=$id;
      $datos->id_baja=$request->get('docente_cubrir');
      $datos->fecha_inicio=$request->get('fechai');
      $datos->fecha_baja=$request->get('fechaf');
      $datos->documentacion_entregada=$request->get('doc');
      $datos->observaciones=$request->get('observaciones');
      $datos->captura="ADMINISTRADOR";
      $datos->estado="PENDIENTE";
      $datos->clave=$name[0];
      $datos->id_cct_etc=$request->get('cct');
      $datos->categoria=$request->get('puesto');
      $datos->id_ciclo=$request->get('ciclo_escolar');
      $datos->tipo_movimiento=$request->get('movimiento');  
      $datos->save();
      $datos2= new BajasContratoModel;
      $datos2->id_captura=$request->get('docente_cubrir');
      $datos2->id_alta=$id;
      $datos2->id_cct_etc=$request->get('cct'); 
      $datos2->fecha_baja=$request->get('fechaf');
      $datos2->documentacion_entregada=$request->get('doc');
      $datos2->observaciones=$request->get('observaciones');
      $datos2->id_ciclo=$request->get('ciclo_escolar'); 
      $datos2->captura="ADMINISTRADOR";
      $datos2->estado="PENDIENTE";
      $datos2->save();
      $baja=CapturaModel::findOrFail($datos2->id_captura);
      $baja->estado="INACTIVO";
      $baja->captura="ADMINISTRADOR";
      $baja->update();


    }elseif ($mov == "INICIO") {
      $datos= new AltasContratoModel;
      $datos->id_captura=$id;
      $datos->fecha_inicio=$request->get('fechai');
      $datos->fecha_baja=$request->get('fechaf');
      $datos->documentacion_entregada=$request->get('doc');
      $datos->observaciones=$request->get('observaciones');
      $datos->captura="ADMINISTRADOR";
      $datos->estado="PENDIENTE";
      $datos->clave=$name[0];
      $datos->id_cct_etc=$request->get('cct');
      $datos->categoria=$request->get('puesto');
      $datos->id_ciclo=$request->get('ciclo_escolar');
      $datos->tipo_movimiento=$request->get('movimiento');  
      $datos->save();
    }else if ($mov == "NUEVO"){
      $datos= new AltasContratoModel;
      $datos->id_captura=$id;
      $datos->fecha_inicio=$request->get('fechai');
      $datos->fecha_baja=$request->get('fechaf');
      $datos->documentacion_entregada=$request->get('doc');
      $datos->observaciones=$request->get('observaciones');
      $datos->captura="ADMINISTRADOR";
      $datos->estado="PENDIENTE";
      $datos->clave=$name[0];
      $datos->id_cct_etc=$request->get('cct');
      $datos->categoria=$request->get('puesto');
      $datos->id_ciclo=$request->get('ciclo_escolar'); 
      $datos->tipo_movimiento=$request->get('movimiento'); 
      $datos->save();

    }
    else if ($mov == "REINCORPORACION"){
      $datos= new AltasContratoModel;
      $datos->id_captura=$id;
      $datos->fecha_inicio=$request->get('fechai');
      $datos->fecha_baja=$request->get('fechaf');
      $datos->documentacion_entregada=$request->get('doc');
      $datos->observaciones=$request->get('observaciones');
      $datos->captura="ADMINISTRADOR";
      $datos->estado="PENDIENTE";
      $datos->clave=$name[0];
      $datos->id_cct_etc=$request->get('cct');
      $datos->categoria=$request->get('puesto');
      $datos->id_ciclo=$request->get('ciclo_escolar'); 
      $datos->tipo_movimiento=$request->get('movimiento'); 
      $datos->save();

    }

    return Redirect::to('captura'); 

        //
  }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {

      $tabla=CapturaModel::findOrFail($id);
      $tabla->fecha_termino=$request->get('fecha'.$id);
      $tabla->estado= "INACTIVO";
      $tabla->captura="ADMINISTRADOR";

      $datos2= new BajasContratoModel;

      $aux=$request->get('fecha'.$id);
      $aux2=$request->get('observaciones'.$id);


      $datos2->id_captura=$id;
      $datos2->id_cct_etc=$tabla->id_cct_etc; 
      $datos2->fecha_baja=$request->get('fecha'.$id);
      $datos2->documentacion_entregada=$request->get('doc');
      $datos2->observaciones=$request->get('observaciones'.$id);
      $datos2->id_ciclo=$tabla->id_ciclo; 
      $datos2->captura="ADMINISTRADOR";
      $datos2->estado="PENDIENTE";
      $datos2->save();
      $tabla->update();
      return Redirect::to('captura'); 

        //
    }
    public function validarCaptura(Request $request,$cct,$puesto)
    {
      $personal= CapturaModel::
      select('id','rfc','nombre', 'estado')
      ->where('id_cct_etc','=',$cct)->where('categoria','=',$puesto)->where('estado','=','ACTIVO')
      ->get(); 

      return response()->json(
        $personal->toArray());
    }

    public function validarNuevo(Request $request,$cct,$puesto)
    {
      $cat=$request->get('puesto' );
      $personal= CapturaModel::join('centro_trabajo','centro_trabajo.id','=','captura.id_cct_etc')->join('datos_centro_trabajo','datos_centro_trabajo.id_centro_trabajo','=','centro_trabajo.id')->
      select('captura.id as id','captura.rfc as rfc','captura.nombre as nombre', 'captura.estado as estado','centro_trabajo.nivel as nivel','datos_centro_trabajo.total_grupos as total_grupos')
      ->where('captura.id_cct_etc','=',$cct)->where('captura.estado','=','ACTIVO')->where('captura.categoria','=',$puesto)
      ->get(); 
      return response()->json(
        $personal->toArray());
    }

    public function validarRFC($rfc)
    {
 //return Redirect::to('personal');
      $personal= CapturaModel::
      select('id','rfc','nombre', 'estado')
      ->where('rfc','=',$rfc)
      ->get(); 

      return response()->json(
        $personal->toArray());

    }

    public function activar(Request $request)
    { 
      $id =  $request->get('idCliente');

      $claves=DB::table('cat_puesto')->get();
      $cct=DB::table('centro_trabajo')->get();
      $ciclos=DB::table('ciclo_escolar')->get();

      $personal=CapturaModel::findOrFail($id);


      
      return view('nomina.captura.edit', ['claves'=> $claves,'cct'=>$cct,'ciclos'=>$ciclos,'personal'=>$personal]);
    }

    public function extender_contrato(Request $request,$id){
      $claves=DB::table('cat_puesto')->get();
      $cct=DB::table('centro_trabajo')->get();
      $ciclos=DB::table('ciclo_escolar')->get();

      $personal=CapturaModel::findOrFail($id);

      return view('nomina.captura.extender', ['claves'=> $claves,'cct'=>$cct,'ciclos'=>$ciclos,'personal'=>$personal]);

    }

    public function guardar_contrato(Request $request,$id){
     $tabla=CapturaModel::findOrFail($id);

     $aux=$request->get('clave');

     $name = explode("_",$aux);
     $tabla->clave=$name[0];

     $tabla->id_cct_etc=$request->get('cct');
     $tabla->sostenimiento=$request->get('sostenimiento');
     $tabla->estado=$request->get('estado');
     //$tabla->pagos_registrados=$request->get('pagos_registrados');
     //$tabla->qna_actual=$request->get('qna_actual');
     $tabla->fecha_inicio=$request->get('fechai');
     $tabla->fecha_termino=$request->get('fechaf');
     $tabla->num_escuelas=$request->get('num_escuelas');
     $tabla->dias_trabajados=$request->get('diassemana');
     $tabla->sostenimiento=$request->get('sostenimiento');
     $tabla->categoria=$request->get('puesto');
     //$tabla->pagos_registrados="0";
     $tabla->qna_actual="0";
     $tabla->cct_2=$request->get('cct_2');
     $tabla->documentacion_entregada=$request->get('doc');
     $tabla->observaciones=$request->get('observaciones');
     $tabla->captura="ADMINISTRADOR";
     $tabla->estado="ACTIVO";
     $tabla->id_ciclo=$request->get('ciclo_escolar'); 
     $tabla->tipo_movimiento=$request->get('movimiento');
     $tabla->update();

     $mov =$request->get('movimiento'); 

     if($mov == "ALTA"){
      $datos= new AltasContratoModel;
      $datos->id_captura=$id;
      $datos->id_baja=$request->get('docente_cubrir');
      $datos->fecha_inicio=$request->get('fechai');
      $datos->fecha_baja=$request->get('fechaf');
      $datos->documentacion_entregada=$request->get('doc');
      $datos->observaciones=$request->get('observaciones');
      $datos->captura="ADMINISTRADOR";
      $datos->estado="PENDIENTE";
      $datos->clave=$name[0];
      $datos->id_cct_etc=$request->get('cct');
      $datos->categoria=$request->get('puesto');
      $datos->id_ciclo=$request->get('ciclo_escolar');
      $datos->tipo_movimiento=$request->get('movimiento');  
      $datos->save();
      $datos2= new BajasContratoModel;
      $datos2->id_captura=$request->get('docente_cubrir');
      $datos2->id_alta=$id;
      $datos2->id_cct_etc=$request->get('cct'); 
      $datos2->fecha_baja=$request->get('fechaf');
      $datos2->documentacion_entregada=$request->get('doc');
      $datos2->observaciones=$request->get('observaciones');
      $datos2->id_ciclo=$request->get('ciclo_escolar'); 
      $datos2->captura="ADMINISTRADOR";
      $datos2->estado="PENDIENTE";
      $datos2->save();
      $baja=CapturaModel::findOrFail($datos2->id_captura);
      $baja->estado="INACTIVO";
      $baja->captura="ADMINISTRADOR";
      $baja->update();


    }elseif ($mov == "INICIO") {
      $datos= new AltasContratoModel;
      $datos->id_captura=$id;
      $datos->fecha_inicio=$request->get('fechai');
      $datos->fecha_baja=$request->get('fechaf');
      $datos->documentacion_entregada=$request->get('doc');
      $datos->observaciones=$request->get('observaciones');
      $datos->captura="ADMINISTRADOR";
      $datos->estado="PENDIENTE";
      $datos->clave=$name[0];
      $datos->id_cct_etc=$request->get('cct');
      $datos->categoria=$request->get('puesto');
      $datos->id_ciclo=$request->get('ciclo_escolar');
      $datos->tipo_movimiento=$request->get('movimiento');  
      $datos->save();
    }else if ($mov == "NUEVO"){
      $datos= new AltasContratoModel;
      $datos->id_captura=$id;
      $datos->fecha_inicio=$request->get('fechai');
      $datos->fecha_baja=$request->get('fechaf');
      $datos->documentacion_entregada=$request->get('doc');
      $datos->observaciones=$request->get('observaciones');
      $datos->captura="ADMINISTRADOR";
      $datos->estado="PENDIENTE";
      $datos->clave=$name[0];
      $datos->id_cct_etc=$request->get('cct');
      $datos->categoria=$request->get('puesto');
      $datos->id_ciclo=$request->get('ciclo_escolar'); 
      $datos->tipo_movimiento=$request->get('movimiento'); 
      $datos->save();

    }elseif ($mov == "EXTENCION") {
      $datos= new ExtencionContratoModel;
      $datos->id_captura=$id;
      $datos->fecha_inicio=$request->get('fechai');
      $datos->fecha_baja=$request->get('fechaf');
      $datos->documentacion_entregada=$request->get('doc');
      $datos->observaciones=$request->get('observaciones');
      $datos->captura="ADMINISTRADOR";
      $datos->estado="PENDIENTE";
      $datos->clave=$name[0];
      $datos->id_cct_etc=$request->get('cct');
      $datos->categoria=$request->get('puesto');
      $datos->id_ciclo=$request->get('ciclo_escolar'); 
      $datos->save();
      # code...
    }

    return Redirect::to('captura'); 

  }

  public function verInformacion($id,$ciclo){
    $nombre=DB::table('captura')->select('captura.nombre','captura.id')->where('id','=',$id)->first();
    $id_ciclo = $ciclo;
    $personal= DB::table('captura')->join('cat_puesto','cat_puesto.id','=','captura.clave')->join('centro_trabajo', 'centro_trabajo.id', '=','captura.id_cct_etc')->select('centro_trabajo.id_region','centro_trabajo.id_localidades','centro_trabajo.id_municipios')->join('region', 'region.id', '=','centro_trabajo.id_region')->join('localidades', 'localidades.id', '=','centro_trabajo.id_localidades')->join('municipios', 'municipios.id', '=','centro_trabajo.id_municipios')->join('ciclo_escolar', 'ciclo_escolar.id', '=','captura.id_ciclo')->select('captura.*','cat_puesto.cat_puesto','centro_trabajo.cct','centro_trabajo.nombre_escuela','ciclo_escolar.ciclo','region.region','municipios.municipio','localidades.nom_loc')->where('captura.id','=',$id)->where('captura.id','=',$id)->where('captura.id_ciclo','=',$ciclo)->get();


    $altas=DB::table('altas_contrato')->join('captura','captura.id','=','altas_contrato.id_baja')->join('cat_puesto','cat_puesto.id','=','altas_contrato.clave')->join('centro_trabajo', 'centro_trabajo.id', '=','altas_contrato.id_cct_etc')->select('captura.nombre','altas_contrato.*','centro_trabajo.cct','centro_trabajo.nombre_escuela','cat_puesto.cat_puesto')->where('altas_contrato.id_captura','=',$id)->where('altas_contrato.id_ciclo','=',$ciclo)->get();

    $bajas=DB::table('bajas_contrato')->join('captura','captura.id','=','bajas_contrato.id_alta')->join('centro_trabajo', 'centro_trabajo.id', '=','bajas_contrato.id_cct_etc')->select('bajas_contrato.*','captura.id','captura.rfc','captura.nombre','centro_trabajo.cct','centro_trabajo.nombre_escuela')->where('bajas_contrato.id_captura','=',$id)->where('bajas_contrato.id_ciclo','=',$ciclo)->get();

    $cambios=DB::table('cambios_cct')->join('captura','captura.id','=','cambios_cct.id_captura')->join('centro_trabajo as ct','ct.id','=','cambios_cct.id_cct_nuevo')->join('cat_puesto','cat_puesto.id','=','cambios_cct.clave')->join('centro_trabajo as ct2','ct2.id','=','cambios_cct.id_cct_anterior')->select('ct2.cct as anteriorcentro_cct','ct2.nombre_escuela as anteriorcentro_nombre_escuela','cat_puesto.cat_puesto','cambios_cct.*','ct.cct as nuevocentro_cct','ct.nombre_escuela as nuevocentro_nombre_escuela')->where('cambios_cct.id_captura','=',$id)->where('cambios_cct.id_ciclo','=',$ciclo)->get();

    $extenciones=DB::table('extencion_contrato')->join('cat_puesto as cat','cat.id','=','extencion_contrato.clave')->join('centro_trabajo', 'centro_trabajo.id', '=','extencion_contrato.id_cct_etc')->select('extencion_contrato.*','centro_trabajo.cct','centro_trabajo.nombre_escuela','cat.cat_puesto')->where('extencion_contrato.id_captura','=',$id)->where('extencion_contrato.id_ciclo','=',$ciclo)->get();

    $claves=DB::table('cat_puesto')->get();
    $cct=DB::table('centro_trabajo')->get();
    $ciclos=DB::table('ciclo_escolar')->get();

//print_r($altas);
    return view('nomina.captura.verinformacion', ['claves'=> $claves,'cct'=>$cct,'ciclos'=>$ciclos,'personal'=>$personal,'altas'=>$altas,'bajas'=>$bajas,'extenciones'=>$extenciones,'cambios'=>$cambios,'nombre'=>$nombre,'id_ciclo'=>$id_ciclo]);

  }

  public function invoice($id,$ciclo){

    $nombre_ciclo = DB::table('ciclo_escolar')->select('ciclo_escolar.ciclo')->where('ciclo_escolar.id','=',$ciclo)->first();

    $personal= DB::table('captura')->join('cat_puesto','cat_puesto.id','=','captura.clave')->join('centro_trabajo', 'centro_trabajo.id', '=','captura.id_cct_etc')->select('centro_trabajo.id_region','centro_trabajo.id_localidades','centro_trabajo.id_municipios')->join('region', 'region.id', '=','centro_trabajo.id_region')->join('localidades', 'localidades.id', '=','centro_trabajo.id_localidades')->join('municipios', 'municipios.id', '=','centro_trabajo.id_municipios')->join('ciclo_escolar', 'ciclo_escolar.id', '=','captura.id_ciclo')->select('captura.*','cat_puesto.cat_puesto','centro_trabajo.cct','centro_trabajo.nombre_escuela','ciclo_escolar.ciclo','region.region','municipios.municipio','localidades.nom_loc')->where('captura.id','=',$id)->first();

    

    $altas=DB::table('altas_contrato')->join('captura','captura.id','=','altas_contrato.id_baja')->join('cat_puesto','cat_puesto.id','=','altas_contrato.clave')->join('centro_trabajo', 'centro_trabajo.id', '=','altas_contrato.id_cct_etc')->select('altas_contrato.*','captura.id as idcaptura','captura.rfc','captura.nombre','centro_trabajo.cct','centro_trabajo.nombre_escuela','cat_puesto.cat_puesto')->where('altas_contrato.id_captura','=',$id)->where('altas_contrato.id_ciclo','=',$ciclo)->get();

    $bajas=DB::table('bajas_contrato')->join('captura','captura.id','=','bajas_contrato.id_alta')->join('centro_trabajo', 'centro_trabajo.id', '=','bajas_contrato.id_cct_etc')->select('bajas_contrato.*','captura.id','captura.rfc','captura.nombre','centro_trabajo.cct','centro_trabajo.nombre_escuela')->where('bajas_contrato.id_captura','=',$id)->where('bajas_contrato.id_ciclo','=',$ciclo)->get();

    $cambios=DB::table('cambios_cct')->join('captura','captura.id','=','cambios_cct.id_captura')->join('centro_trabajo as ct','ct.id','=','cambios_cct.id_cct_nuevo')->join('cat_puesto','cat_puesto.id','=','cambios_cct.clave')->join('centro_trabajo as ct2','ct2.id','=','cambios_cct.id_cct_anterior')->select('ct2.cct as anteriorcentro_cct','ct2.nombre_escuela as anteriorcentro_nombre_escuela','cat_puesto.cat_puesto','cambios_cct.*','ct.cct as nuevocentro_cct','ct.nombre_escuela as nuevocentro_nombre_escuela')->where('cambios_cct.id_captura','=',$id)->where('cambios_cct.id_ciclo','=',$ciclo)->get();

    $extenciones=DB::table('extencion_contrato')->join('captura','captura.id','=','extencion_contrato.id_captura')->join('cat_puesto as cat','cat.id','=','extencion_contrato.clave')->join('centro_trabajo', 'centro_trabajo.id', '=','extencion_contrato.id_cct_etc')->select('extencion_contrato.*','captura.id as cap','captura.rfc','captura.nombre','centro_trabajo.cct','centro_trabajo.nombre_escuela','cat.cat_puesto')->where('extencion_contrato.id_captura','=',$id)->where('extencion_contrato.id_ciclo','=',$ciclo)->get();

    $date = date('Y-m-d');
    $invoice = "2222";
        //print_r($);
    $view =  \View::make('nomina.captura.invoice', compact('personal','altas','bajas','extenciones','cambios','nombre_ciclo','inicio','nuevo'))->render();
        //->setPaper($customPaper, 'landscape');
    $pdf = \App::make('dompdf.wrapper');
    $pdf->loadHTML($view);
    return $pdf->stream('invoice');


  }


}
