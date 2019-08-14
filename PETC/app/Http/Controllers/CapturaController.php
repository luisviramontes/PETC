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
use petc\CentroTrabajoModel;
use petc\RegionModel;
use petc\CambiosCctModel;
use petc\CambiosFuncionModel;
use petc\Director_CCTModel;
use petc\PlanContasteNominaModel;


use DB;
use Maatwebsite\Excel\Facades\Excel;
use PHPExcel_Worksheet_Drawing;
use Validator;
use \Milon\Barcode\DNS1D;
use \Milon\Barcode\DNS2D;
use petc\Http\Requests\CapturaRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Collection as Collection;

class CapturaController extends Controller
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
    public function index(request $request)
    {
      $tipo_usuario = Auth::user()->tipo_usuario;
      if($tipo_usuario <> "2" || $tipo_usuario=="5"){
       return view('permisos');

     }else{

       if($request)
       {
       // $aux=$request->get('searchText');
        $query=trim($request->GET('searchText'));


        $personal= DB::table('captura')
        ->join('cat_puesto','cat_puesto.id','=','captura.clave')
        ->join('centro_trabajo', 'centro_trabajo.id', '=','captura.id_cct_etc')
        ->select('centro_trabajo.id_region','centro_trabajo.id_localidades','centro_trabajo.id_municipios')
        ->join('region', 'region.id', '=','centro_trabajo.id_region')
        ->join('localidades', 'localidades.id', '=','centro_trabajo.id_localidades')
        ->join('municipios', 'municipios.id', '=','centro_trabajo.id_municipios')
        ->join('ciclo_escolar', 'ciclo_escolar.id', '=','captura.id_ciclo')

        ->select('captura.*','cat_puesto.cat_puesto'
          ,'centro_trabajo.cct','centro_trabajo.nombre_escuela'
          ,'ciclo_escolar.ciclo'
          ,'region.region'
          ,'municipios.municipio'
          ,'localidades.nom_loc')

        ->where('captura.nombre','LIKE','%'.$query.'%')
        ->orwhere('captura.rfc','LIKE','%'.$query.'%')
        ->orwhere('centro_trabajo.nombre_escuela','LIKE','%'.$query.'%')
        ->orwhere('centro_trabajo.cct','LIKE','%'.$query.'%')
        ->paginate(40);

        return view('nomina.captura.index',["personal"=>$personal,"searchText"=>$query]);
        // return view('nomina.tabla_pagos.index',['tabla_pagos' => $tabla_pagos,'ciclos'=> $ciclos]);
        //
      }}}

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
      $ciclos=DB::table('ciclo_escolar')->get();

      return view('nomina.captura.create', ['claves'=> $claves,'cct'=>$cct,'ciclos'=>$ciclos]);
        //
    }}

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
      $tabla= new CapturaModel;
      $tabla->nombre=$request->get('nombre');
      $tabla->rfc=$request->get('rfc_input');
      $tabla->telefono=$request->get('telefono');
      $tabla->email=$request->get('email');

      $aux=$request->get('clave');

      $name = explode("_",$aux);
      $tabla->clave=$name[0];

      $tabla->id_cct_etc=$request->get('cct');
      $centro=CentroTrabajoModel::findOrFail($tabla->id_cct_etc);
      $region=RegionModel::findOrFail($centro->id_region);
      $tabla->sostenimiento=$region->sostenimiento;

      $tabla->estado=$request->get('estado');
     //$tabla->pagos_registrados=$request->get('pagos_registrados');
      $tabla->qna_actual=$request->get('qna_actual');
      $tabla->fecha_inicio=$request->get('fechai');
      $tabla->fecha_termino=$request->get('fechaf');
      $tabla->num_escuelas=$request->get('num_escuelas');
      $tabla->dias_trabajados=$request->get('diassemana');
     //$tabla->sostenimiento=$request->get('sostenimiento');
      $tabla->categoria=$request->get('puesto');
      $tabla->pagos_registrados="0";
      $tabla->qna_actual="0";
      $tabla->cct_2=$request->get('cct_2');
      $tabla->documentacion_entregada=$request->get('doc');
      $tabla->observaciones=$request->get('observaciones');
      $tabla->captura=$user;
      $tabla->estado="ACTIVO";
      $tabla->id_ciclo=$request->get('ciclo_escolar');
      $tabla->tipo_movimiento=$request->get('movimiento');
      $tabla->save();
      $ultimo = CapturaModel::orderBy('id', 'desc')->first()->id;

      $mov =$request->get('movimiento');
      $cat=$request->get('puesto');
      $cct_aux=$request->get('cct');

      if($cat == "DIRECTOR"){
        $id_aux_cct=$request->get('cct');
        $id_aux=DB::table('Director_CCT')->where('id_cct_etc','=',$id_aux_cct)->first();
        $Direcor_CCT=Director_CCTModel::findOrFail($id_aux->id);
        $Direcor_CCT->id_captura=$ultimo;
        $Direcor_CCT->fecha_inicio=$request->get('fechai');
        $Direcor_CCT->fecha_baja=$request->get('fechaf');
        $Direcor_CCT->documentacion_entregada=$request->get('doc');
        $Direcor_CCT->documentacion_entregada=$request->get('doc');
        $Direcor_CCT->captura=$user;
        $Direcor_CCT->estado="ACTIVO";
        $Direcor_CCT->id_ciclo=$request->get('ciclo_escolar');
        $Direcor_CCT->id_cct_etc=$request->get('cct');
        $Direcor_CCT->update();
      }


      if($mov == "ALTA"){
        $datos= new AltasContratoModel;
        $datos->id_captura=$ultimo;
        $datos->id_baja=$request->get('docente_cubrir');
        $datos->fecha_inicio=$request->get('fechai');
        $datos->fecha_baja=$request->get('fechaf');
        $datos->documentacion_entregada=$request->get('doc');
        $datos->observaciones=$request->get('observaciones');
        $datos->captura=$user;
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
        $datos2->captura=$user;
        $datos2->estado="PENDIENTE";
        $datos2->id_ciclo=$request->get('ciclo_escolar');
        $datos2->save();
        $baja=CapturaModel::findOrFail($datos2->id_captura);
        $baja->fecha_termino=$request->get('fechaf');
        $baja->documentacion_entregada=$request->get('doc');
        $baja->tipo_movimiento="BAJA";
        $baja->estado="INACTIVO";
        $baja->captura=$user;
        $baja->update();


      }elseif ($mov == "INICIO") {
        $datos= new AltasContratoModel;
        $datos->id_captura=$ultimo;
        $datos->fecha_inicio=$request->get('fechai');
        $datos->fecha_baja=$request->get('fechaf');
        $datos->documentacion_entregada=$request->get('doc');
        $datos->observaciones=$request->get('observaciones');
        $datos->captura=$user;
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
        $datos->captura=$user;
        $datos->estado="PENDIENTE";
        $datos->clave=$name[0];
        $datos->id_cct_etc=$request->get('cct');
        $datos->categoria=$request->get('puesto');
        $datos->id_ciclo=$request->get('ciclo_escolar');
        $datos->tipo_movimiento=$request->get('movimiento');
        $datos->save();

      }

      if($cat == "DIRECTOR" && $mov="INICIO" || $mov == "NUEVO"){
        $id_plan=DB::table('plan_contraste_nomina')->where('id_cct_etc','=',$cct_aux)->first()->id;
        $plan=PlanContasteNominaModel::findOrFail($id_plan);
        $plan->total_directores=$plan->total_directores+1;
        $plan->update();
      }elseif($cat == "DOCENTE" || $cat == "USAER" || $cat == "EDUCACION FISICA" && $mov="INICIO" || $mov == "NUEVO"){
       $id_plan=DB::table('plan_contraste_nomina')->where('id_cct_etc','=',$cct_aux)->first()->id;
       $plan=PlanContasteNominaModel::findOrFail($id_plan);
       $plan->total_docentes=$plan->total_docentes+1;
       $plan->update();
     }elseif($cat == "INTENDENTE" && $mov="INICIO" || $mov == "NUEVO"){
       $id_plan=DB::table('plan_contraste_nomina')->where('id_cct_etc','=',$cct_aux)->first()->id;
       $plan=PlanContasteNominaModel::findOrFail($id_plan);
       $plan->total_intendentes=$plan->total_intendentes+1;
       $plan->update();

     }

     //return Redirect::to('captura');
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

      $personal=CapturaModel::findOrFail($id);

      return view('nomina.captura.edit', ['claves'=> $claves,'cct'=>$cct,'ciclos'=>$ciclos,'personal'=>$personal]);


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
      $tabla=CapturaModel::findOrFail($id);
      $tabla->nombre=$request->get('nombre');
      $tabla->rfc=$request->get('rfc_input');
      $tabla->telefono=$request->get('telefono');
      $tabla->email=$request->get('email');
     //$tabla->id_cct_etc=$request->get('cct');

      $aux=$request->get('clave');

      $name = explode("_",$aux);
      $tabla->clave=$name[0];

      $mov =$request->get('movimiento');

      $CCTAUX= $request->get('cct');
      $centro=CentroTrabajoModel::findOrFail($CCTAUX);
      $region=RegionModel::findOrFail($centro->id_region);
      $tabla->sostenimiento=$region->sostenimiento;

     //$tabla->sostenimiento=$request->get('sostenimiento');
      $tabla->estado=$request->get('estado');
    // $tabla->pagos_registrados=$request->get('pagos_registrados');
      $tabla->qna_actual=$request->get('qna_actual');
      $tabla->fecha_inicio=$request->get('fechai');
      $tabla->fecha_termino=$request->get('fechaf');
      $tabla->num_escuelas=$request->get('num_escuelas');
      $tabla->dias_trabajados=$request->get('diassemana');
     //$tabla->sostenimiento=$request->get('sostenimiento');
      $tabla->categoria=$request->get('puesto');
     //$tabla->pagos_registrados="0";
      //$tabla->qna_actual="0";
      $tabla->cct_2=$request->get('cct_2');
      $tabla->documentacion_entregada=$request->get('doc');
      $tabla->observaciones=$request->get('observaciones');
      $tabla->captura=$user;
      $tabla->estado="ACTIVO";
      $tabla->id_ciclo=$request->get('ciclo_escolar');
      $tabla->tipo_movimiento=$request->get('movimiento');

      $mov =$request->get('movimiento');
      $cat=$request->get('puesto');
      $cct_aux=$request->get('cct');

      if($cat == "DIRECTOR"){
        $id_aux_cct=$request->get('cct');
        $id_aux2=DB::table('Director_CCT')->where('id_cct_etc','=',$id_aux_cct)->first();
        $Direcor_CCT=Director_CCTModel::findOrFail($id_aux2->id);
        $Direcor_CCT->id_captura=$id;
        $Direcor_CCT->fecha_inicio=$request->get('fechai');
        $Direcor_CCT->fecha_baja=$request->get('fechaf');
        $Direcor_CCT->documentacion_entregada=$request->get('doc');
        $Direcor_CCT->captura=$user;
        $Direcor_CCT->estado="ACTIVO";
        $Direcor_CCT->id_ciclo=$request->get('ciclo_escolar');
        $Direcor_CCT->id_cct_etc=$request->get('cct');
        $Direcor_CCT->update();
      }


      if($mov == "ALTA"){
        $datos= new AltasContratoModel;
        $datos->id_captura=$id;
        $datos->id_baja=$request->get('docente_cubrir');
        $datos->fecha_inicio=$request->get('fechai');
        $datos->fecha_baja=$request->get('fechaf');
        $datos->documentacion_entregada=$request->get('doc');
        $datos->observaciones=$request->get('observaciones');
        $datos->captura=$user;
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
        $datos2->captura=$user;
        $datos2->estado="PENDIENTE";
        $datos2->save();
        $baja=CapturaModel::findOrFail($datos2->id_captura);
        $baja->fecha_termino=$request->get('fechaf');
        $baja->documentacion_entregada=$request->get('doc');
        $baja->tipo_movimiento="BAJA";
        $baja->estado="INACTIVO";
        $baja->captura=$user;
        $baja->update();


      }elseif ($mov == "INICIO") {
        $datos= new AltasContratoModel;
        $datos->id_captura=$id;
        $datos->fecha_inicio=$request->get('fechai');
        $datos->fecha_baja=$request->get('fechaf');
        $datos->documentacion_entregada=$request->get('doc');
        $datos->observaciones=$request->get('observaciones');
        $datos->captura=$user;
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
        $datos->captura=$user;
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
        $datos->captura=$user;
        $datos->estado="PENDIENTE";
        $datos->clave=$name[0];
        $datos->id_cct_etc=$request->get('cct');
        $datos->categoria=$request->get('puesto');
        $datos->id_ciclo=$request->get('ciclo_escolar');
        $datos->tipo_movimiento=$request->get('movimiento');
        $datos->save();

      }  else if ($mov == "CAMBIOCCT"){
        $datos= new CambiosCctModel;
        $datos->id_captura=$id;
        $tabla2=CapturaModel::findOrFail($id);
        $datos->id_cct_anterior=$tabla2->id_cct_etc;
        $datos->id_cct_nuevo= $request->get('cct_nuevo');
        $datos->clave=$name[0];
        $datos->categoria=$request->get('puesto');
        $datos->fecha_inicio=$request->get('fechai');
        $datos->fecha_baja=$request->get('fechaf');

        $datos->documentacion_entregada=$request->get('doc');
        $datos->observaciones=$request->get('observaciones');
        $datos->captura=$user;
        $datos->estado="PENDIENTE";
        $datos->id_ciclo=$request->get('ciclo_escolar');
        $datos->save();

      } else if ($mov == "CAMBIOFUNCION"){
        $datos= new CambiosFuncionModel;
        $datos->id_captura=$id;
        $tabla2=CapturaModel::findOrFail($id);
        $datos->categoria_anterior=$tabla2->categoria;
        $datos->categoria_nueva= $request->get('puesto');
        $datos->clave=$name[0];
        $datos->fecha_inicio=$request->get('fechai');
        $datos->fecha_baja=$request->get('fechaf');
        $datos->documentacion_entregada=$request->get('doc');
        $datos->observaciones=$request->get('observaciones');
        $datos->captura=$user;
        $datos->estado="PENDIENTE";
        $datos->id_cct_etc=$request->get('cct');
        $datos->id_ciclo=$request->get('ciclo_escolar');
        $datos->save();

      }
      if($mov == "CAMBIOCCT"){
       $tabla->id_cct_etc=$request->get('cct_nuevo');
     }else{
       $tabla->id_cct_etc=$request->get('cct');
     }


     if($cat == "DIRECTOR" && $mov="INICIO" || $mov == "NUEVO"){
      $id_plan=DB::table('plan_contraste_nomina')->where('id_cct_etc','=',$cct_aux)->first()->id;
      $plan=PlanContasteNominaModel::findOrFail($id_plan);
      $plan->total_directores=$plan->total_directores+1;
      $plan->update();
    }elseif($cat == "DOCENTE" || $cat == "USAER" || $cat == "EDUCACION FISICA" && $mov="INICIO" || $mov == "NUEVO"){
     $id_plan=DB::table('plan_contraste_nomina')->where('id_cct_etc','=',$cct_aux)->first()->id;
     $plan=PlanContasteNominaModel::findOrFail($id_plan);
     $plan->total_docentes=$plan->total_docentes+1;
     $plan->update();
   }elseif($cat == "INTENDENTE" && $mov="INICIO" || $mov == "NUEVO"){
     $id_plan=DB::table('plan_contraste_nomina')->where('id_cct_etc','=',$cct_aux)->first()->id;
     $plan=PlanContasteNominaModel::findOrFail($id_plan);
     $plan->total_intendentes=$plan->total_intendentes+1;
     $plan->update();

   }



   $tabla->update();

   return Redirect::to('captura');

        //
 }}

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

      $tabla=CapturaModel::findOrFail($id);
      $tabla->fecha_termino=$request->get('fecha'.$id);
      $tabla->estado= "INACTIVO";
      $tabla->captura=$user;

      $datos2= new BajasContratoModel;

      $aux=$request->get('fecha'.$id);
      $aux2=$request->get('observaciones'.$id);


      $datos2->id_captura=$id;
      $datos2->id_cct_etc=$tabla->id_cct_etc;
      $datos2->fecha_baja=$request->get('fecha'.$id);
      $datos2->documentacion_entregada=$request->get('doc');
      $datos2->observaciones=$request->get('observaciones'.$id);
      $datos2->id_ciclo=$tabla->id_ciclo;
      $datos2->captura=$user;
      $datos2->estado="PENDIENTE";
      $datos2->save();
      $tabla->update();


      return Redirect::to('captura');

        //
    }}
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
      $tipo_usuario = Auth::user()->tipo_usuario;
      if($tipo_usuario <> "2" || $tipo_usuario=="5"){
       return view('permisos');

     }else{
      $user = Auth::user()->name;
      $tabla=CapturaModel::findOrFail($id);

      $aux=$request->get('clave');

      $name = explode("_",$aux);
      $tabla->clave=$name[0];

      $tabla->id_cct_etc=$request->get('cct');
      $centro=CentroTrabajoModel::findOrFail($tabla->id_cct_etc);
      $region=RegionModel::findOrFail($centro->id_region);
      $tabla->sostenimiento=$region->sostenimiento;

     //$tabla->sostenimiento=$request->get('sostenimiento');
      $tabla->estado=$request->get('estado');
     //$tabla->pagos_registrados=$request->get('pagos_registrados');
     //$tabla->qna_actual=$request->get('qna_actual');
      $tabla->fecha_inicio=$request->get('fechai');
      $tabla->fecha_termino=$request->get('fechaf');
      $tabla->num_escuelas=$request->get('num_escuelas');
      $tabla->dias_trabajados=$request->get('diassemana');
     //$tabla->sostenimiento=$request->get('sostenimiento');
      $tabla->categoria=$request->get('puesto');
     //$tabla->pagos_registrados="0";
     // $tabla->qna_actual="0";
      $tabla->cct_2=$request->get('cct_2');
      $tabla->documentacion_entregada=$request->get('doc');
      $tabla->observaciones=$request->get('observaciones');
      $tabla->captura=$user;
      $tabla->estado="ACTIVO";
      $tabla->id_ciclo=$request->get('ciclo_escolar');
      $tabla->tipo_movimiento=$request->get('movimiento');
      $tabla->update();

      $mov =$request->get('movimiento');
      $cat=$request->get('puesto');

      if($cat == "DIRECTOR"){
        $id_aux_cct=$request->get('cct');
        $id_aux=DB::table('Director_CCT')->where('id_cct_etc','=',$id_aux_cct)->first();
        $Direcor_CCT=Director_CCTModel::findOrFail($id_aux->id);
        $Direcor_CCT->id_captura=$id;
        $Direcor_CCT->fecha_inicio=$request->get('fechai');
        $Direcor_CCT->fecha_baja=$request->get('fechaf');
        $Direcor_CCT->documentacion_entregada=$request->get('doc');
        $Direcor_CCT->documentacion_entregada=$request->get('doc');
        $Direcor_CCT->captura=$user;
        $Direcor_CCT->estado="ACTIVO";
        $Direcor_CCT->id_ciclo=$request->get('ciclo_escolar');
        $Direcor_CCT->id_cct_etc=$request->get('cct');
        $Direcor_CCT->update();
      }


      if($mov == "ALTA"){
        $datos= new AltasContratoModel;
        $datos->id_captura=$id;
        $datos->id_baja=$request->get('docente_cubrir');
        $datos->fecha_inicio=$request->get('fechai');
        $datos->fecha_baja=$request->get('fechaf');
        $datos->documentacion_entregada=$request->get('doc');
        $datos->observaciones=$request->get('observaciones');
        $datos->captura=$user;
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
        $datos2->captura=$user;
        $datos2->estado="PENDIENTE";
        $datos2->save();
        $baja=CapturaModel::findOrFail($datos2->id_captura);
        $baja->fecha_termino=$request->get('fechaf');
        $baja->documentacion_entregada=$request->get('doc');
        $baja->tipo_movimiento="BAJA";
        $baja->estado="INACTIVO";
        $baja->captura=$user;
        $baja->update();

      }elseif ($mov == "INICIO") {
        $datos= new AltasContratoModel;
        $datos->id_captura=$id;
        $datos->fecha_inicio=$request->get('fechai');
        $datos->fecha_baja=$request->get('fechaf');
        $datos->documentacion_entregada=$request->get('doc');
        $datos->observaciones=$request->get('observaciones');
        $datos->captura=$user;
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
        $datos->captura=$user;
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
        $datos->captura=$user;
        $datos->estado="PENDIENTE";
        $datos->clave=$name[0];
        $datos->id_cct_etc=$request->get('cct');
        $datos->categoria=$request->get('puesto');
        $datos->id_ciclo=$request->get('ciclo_escolar');
        $datos->save();
      # code...
      }

      return Redirect::to('captura');

    }}

    public function verInformacion($id,$ciclo){
      $total_ina=DB::table('inasistencias')->where('inasistencias.id_captura','=',$id)->where('inasistencias.id_ciclo','=',$ciclo)->count();

      $nombre=DB::table('captura')->select('captura.nombre','captura.id')->where('id','=',$id)->first();
      $id_ciclo = $ciclo;
      $personal= DB::table('captura')->join('cat_puesto','cat_puesto.id','=','captura.clave')->join('centro_trabajo', 'centro_trabajo.id', '=','captura.id_cct_etc')->select('centro_trabajo.id_region','centro_trabajo.id_localidades','centro_trabajo.id_municipios')->join('region', 'region.id', '=','centro_trabajo.id_region')->join('localidades', 'localidades.id', '=','centro_trabajo.id_localidades')->join('municipios', 'municipios.id', '=','centro_trabajo.id_municipios')->join('ciclo_escolar', 'ciclo_escolar.id', '=','captura.id_ciclo')->select('captura.*','cat_puesto.cat_puesto','centro_trabajo.cct','centro_trabajo.nombre_escuela','ciclo_escolar.ciclo','region.region','municipios.municipio','localidades.nom_loc')->where('captura.id','=',$id)->where('captura.id','=',$id)->where('captura.id_ciclo','=',$ciclo)->get();


      $altas=DB::table('altas_contrato')->join('cat_puesto','cat_puesto.id','=','altas_contrato.clave')->join('centro_trabajo', 'centro_trabajo.id', '=','altas_contrato.id_cct_etc')->select('altas_contrato.*','centro_trabajo.cct','centro_trabajo.nombre_escuela','cat_puesto.cat_puesto')->where('altas_contrato.id_captura','=',$id)->where('altas_contrato.id_ciclo','=',$ciclo)->whereNull('altas_contrato.id_baja')->get();

      $altas2= DB::table('altas_contrato')->join('captura','captura.id','=','altas_contrato.id_captura')->join('cat_puesto','cat_puesto.id','=','altas_contrato.clave')->join('centro_trabajo', 'centro_trabajo.id', '=','altas_contrato.id_cct_etc')->join('captura as captura2','captura2.id','=','altas_contrato.id_baja')->select('altas_contrato.*','captura.id as idcaptura','captura.rfc','captura.nombre','centro_trabajo.cct','centro_trabajo.nombre_escuela','cat_puesto.cat_puesto','captura2.nombre as nombre_baja','captura2.rfc as rfc_baja')->where('captura2.nombre','!=',' ')->where('altas_contrato.id_captura','=',$id)->where('altas_contrato.id_ciclo','=',$ciclo)->whereNotNull('altas_contrato.id_baja')->paginate(30);


      $bajas=DB::table('bajas_contrato')->join('centro_trabajo', 'centro_trabajo.id', '=','bajas_contrato.id_cct_etc')->select('bajas_contrato.*','centro_trabajo.cct','centro_trabajo.nombre_escuela')->where('bajas_contrato.id_captura','=',$id)->where('bajas_contrato.id_ciclo','=',$ciclo)->whereNull('bajas_contrato.id_alta')->get();

      $bajas2=DB::table('bajas_contrato')->join('captura','captura.id','=','bajas_contrato.id_alta')->join('centro_trabajo', 'centro_trabajo.id', '=','bajas_contrato.id_cct_etc')->join('captura as captura2','captura2.id','=','bajas_contrato.id_alta')->select('bajas_contrato.*','captura.id','captura.rfc','captura.nombre','centro_trabajo.cct','centro_trabajo.nombre_escuela','captura2.nombre as nombre_baja','captura2.rfc as rfc_baja')->where('bajas_contrato.id_captura','=',$id)->where('bajas_contrato.id_ciclo','=',$ciclo)->whereNotNull('bajas_contrato.id_alta')->get();

      $cambios=DB::table('cambios_cct')->join('captura','captura.id','=','cambios_cct.id_captura')->join('centro_trabajo as ct','ct.id','=','cambios_cct.id_cct_nuevo')->join('cat_puesto','cat_puesto.id','=','cambios_cct.clave')->join('centro_trabajo as ct2','ct2.id','=','cambios_cct.id_cct_anterior')->select('ct2.cct as anteriorcentro_cct','ct2.nombre_escuela as anteriorcentro_nombre_escuela','cat_puesto.cat_puesto','cambios_cct.*','ct.cct as nuevocentro_cct','ct.nombre_escuela as nuevocentro_nombre_escuela')->where('cambios_cct.id_captura','=',$id)->where('cambios_cct.id_ciclo','=',$ciclo)->get();

      $cambiosfun=DB::table('cambio_funcion')->join('captura','captura.id','=','cambio_funcion.id_captura')->join('centro_trabajo as ct','ct.id','=','cambio_funcion.id_cct_etc')->join('cat_puesto','cat_puesto.id','=','cambio_funcion.clave')->select('cat_puesto.cat_puesto','cambio_funcion.*','ct.nombre_escuela','ct.cct')->where('cambio_funcion.id_captura','=',$id)->where('cambio_funcion.id_ciclo','=',$ciclo)->get();


      $extenciones=DB::table('extencion_contrato')->join('cat_puesto as cat','cat.id','=','extencion_contrato.clave')->join('centro_trabajo', 'centro_trabajo.id', '=','extencion_contrato.id_cct_etc')->select('extencion_contrato.*','centro_trabajo.cct','centro_trabajo.nombre_escuela','cat.cat_puesto')->where('extencion_contrato.id_captura','=',$id)->where('extencion_contrato.id_ciclo','=',$ciclo)->get();

      $claves=DB::table('cat_puesto')->get();
      $cct=DB::table('centro_trabajo')->get();
      $ciclos=DB::table('ciclo_escolar')->get();

      $inasistencias= DB::table('inasistencias')->join('ciclo_escolar as ciclo_ina','ciclo_ina.id','=','inasistencias.id_ciclo')->join('centro_trabajo as centro_ina', 'centro_ina.id', '=','inasistencias.id_cct_etc')->select('inasistencias.*','inasistencias.observaciones as observaciones_ina','ciclo_ina.ciclo as ciclo_ina','centro_ina.nombre_escuela as nombre_escuela_ina','centro_ina.cct as cct_ina','inasistencias.estado as estado_ina')->where('inasistencias.id_captura','=',$id)->where('inasistencias.id_ciclo','=',$ciclo)->get();

//print_r($altas);
      return view('nomina.captura.verinformacion', ['claves'=> $claves,'cct'=>$cct,'ciclos'=>$ciclos,'personal'=>$personal,'altas'=>$altas,'bajas'=>$bajas,'extenciones'=>$extenciones,'cambios'=>$cambios,'nombre'=>$nombre,'id_ciclo'=>$id_ciclo,'altas2'=>$altas2,'bajas2'=>$bajas2,'cambiosfun'=>$cambiosfun,'total_ina'=>$total_ina,'inasistencias'=>$inasistencias]);

    }

    public function invoice($id,$ciclo){

      $nombre_ciclo = DB::table('ciclo_escolar')->select('ciclo_escolar.ciclo')->where('ciclo_escolar.id','=',$ciclo)->first();

      $personal= DB::table('captura')
      ->join('cat_puesto','cat_puesto.id','=','captura.clave')->join('centro_trabajo', 'centro_trabajo.id', '=','captura.id_cct_etc')
      ->select('centro_trabajo.id_region','centro_trabajo.id_localidades','centro_trabajo.id_municipios')
      ->join('region', 'region.id', '=','centro_trabajo.id_region')->join('localidades', 'localidades.id', '=','centro_trabajo.id_localidades')
      ->join('municipios', 'municipios.id', '=','centro_trabajo.id_municipios')->join('ciclo_escolar', 'ciclo_escolar.id', '=','captura.id_ciclo')
      ->select('captura.*','cat_puesto.cat_puesto','centro_trabajo.cct','centro_trabajo.nombre_escuela','ciclo_escolar.ciclo','region.region','municipios.municipio','localidades.nom_loc')
      ->where('captura.id','=',$id)->first();


      $altas=DB::table('altas_contrato')
      ->join('cat_puesto','cat_puesto.id','=','altas_contrato.clave')
      ->join('centro_trabajo', 'centro_trabajo.id', '=','altas_contrato.id_cct_etc')
      ->select('altas_contrato.*','centro_trabajo.cct','centro_trabajo.nombre_escuela','cat_puesto.cat_puesto')
      ->where('altas_contrato.id_captura','=',$id)->where('altas_contrato.id_ciclo','=',$ciclo)
      ->whereNull('altas_contrato.id_baja')->get();

      $altas2= DB::table('altas_contrato')
      ->join('captura','captura.id','=','altas_contrato.id_captura')
      ->join('cat_puesto','cat_puesto.id','=','altas_contrato.clave')
      ->join('centro_trabajo', 'centro_trabajo.id', '=','altas_contrato.id_cct_etc')
      ->join('captura as captura2','captura2.id','=','altas_contrato.id_baja')
      ->select('altas_contrato.*','captura.id as idcaptura','captura.rfc','captura.nombre','centro_trabajo.cct','centro_trabajo.nombre_escuela','cat_puesto.cat_puesto','captura2.nombre as nombre_baja','captura2.rfc as rfc_baja')
      ->where('captura2.nombre','!=',' ')->where('altas_contrato.id_captura','=',$id)
      ->where('altas_contrato.id_ciclo','=',$ciclo)->whereNotNull('altas_contrato.id_baja')
      ->paginate(30);



      $bajas=DB::table('bajas_contrato')
      ->join('captura','captura.id','=','bajas_contrato.id_alta')
      ->join('centro_trabajo', 'centro_trabajo.id', '=','bajas_contrato.id_cct_etc')
      ->select('bajas_contrato.*','captura.id','captura.rfc','captura.nombre','centro_trabajo.cct','centro_trabajo.nombre_escuela')
      ->where('bajas_contrato.id_captura','=',$id)->where('bajas_contrato.id_ciclo','=',$ciclo)->get();

      $bajas2=DB::table('bajas_contrato')
      ->join('captura','captura.id','=','bajas_contrato.id_alta')
      ->join('centro_trabajo', 'centro_trabajo.id', '=','bajas_contrato.id_cct_etc')
      ->join('captura as captura2','captura2.id','=','bajas_contrato.id_alta')
      ->select('bajas_contrato.*','captura.id','captura.rfc','captura.nombre','centro_trabajo.cct','centro_trabajo.nombre_escuela','captura2.nombre as nombre_baja','captura2.rfc as rfc_baja')
      ->where('bajas_contrato.id_captura','=',$id)
      ->where('bajas_contrato.id_ciclo','=',$ciclo)
      ->whereNotNull('bajas_contrato.id_alta')
      ->get();

      $cambios=DB::table('cambios_cct')
      ->join('captura','captura.id','=','cambios_cct.id_captura')
      ->join('centro_trabajo as ct','ct.id','=','cambios_cct.id_cct_nuevo')
      ->join('cat_puesto','cat_puesto.id','=','cambios_cct.clave')
      ->join('centro_trabajo as ct2','ct2.id','=','cambios_cct.id_cct_anterior')
      ->select('ct2.cct as anteriorcentro_cct','ct2.nombre_escuela as anteriorcentro_nombre_escuela','cat_puesto.cat_puesto','cambios_cct.*','ct.cct as nuevocentro_cct','ct.nombre_escuela as nuevocentro_nombre_escuela')
      ->where('cambios_cct.id_captura','=',$id)
      ->where('cambios_cct.id_ciclo','=',$ciclo)->get();

      $extenciones=DB::table('extencion_contrato')
      ->join('captura','captura.id','=','extencion_contrato.id_captura')
      ->join('cat_puesto as cat','cat.id','=','extencion_contrato.clave')
      ->join('centro_trabajo', 'centro_trabajo.id', '=','extencion_contrato.id_cct_etc')
      ->select('extencion_contrato.*','captura.id as cap','captura.rfc','captura.nombre','centro_trabajo.cct','centro_trabajo.nombre_escuela','cat.cat_puesto')
      ->where('extencion_contrato.id_captura','=',$id)
      ->where('extencion_contrato.id_ciclo','=',$ciclo)->get();


      $cambiosfun=DB::table('cambio_funcion')
      ->join('captura','captura.id','=','cambio_funcion.id_captura')
      ->join('centro_trabajo as ct','ct.id','=','cambio_funcion.id_cct_etc')
      ->join('cat_puesto','cat_puesto.id','=','cambio_funcion.clave')
      ->select('cat_puesto.cat_puesto','cambio_funcion.*','ct.nombre_escuela','ct.cct')
      ->where('cambio_funcion.id_captura','=',$id)
      ->where('cambio_funcion.id_ciclo','=',$ciclo)->get();

      $inasistencias= DB::table('inasistencias')
      ->join('ciclo_escolar as ciclo_ina','ciclo_ina.id','=','inasistencias.id_ciclo')
      ->join('centro_trabajo as centro_ina', 'centro_ina.id', '=','inasistencias.id_cct_etc')
      ->select('inasistencias.*','inasistencias.observaciones as observaciones_ina','ciclo_ina.ciclo as ciclo_ina','centro_ina.nombre_escuela as nombre_escuela_ina','centro_ina.cct as cct_ina','inasistencias.estado as estado_ina')
      ->where('inasistencias.id_captura','=',$id)
      ->where('inasistencias.id_ciclo','=',$ciclo)->get();

      $date = date('Y-m-d');
      $invoice = "2222";
        //print_r($);
      $view =  \View::make('nomina.captura.invoice', compact('altas2','bajas2','cambiosfun','personal','altas','bajas','extenciones','cambios','nombre_ciclo','inasistencias'))->render();
        //->setPaper($customPaper, 'landscape');
      $pdf = \App::make('dompdf.wrapper');
      $pdf->loadHTML($view);
      return $pdf->stream('invoice');


    }

    public function ver_capturas(){
     $ciclos=DB::table('ciclo_escolar')->get();
     $regiones=DB::table('region')->where('estado','=','ACTIVO')->get();
     $escuelas=DB::table('centro_trabajo')->get();
     return view('nomina.captura.ver_capturas', ['ciclos'=>$ciclos,'regiones'=>$regiones,'escuelas'=>$escuelas,]);

   }


   public function busca_dias_captura($ciclo){

     $captura=DB::table('captura')->where('captura.id_ciclo','=',$ciclo)->where('captura.estado','=','ACTIVO')->select('captura.categoria','captura.sostenimiento')->get();

     $captura=DB::table('captura')
     ->where('captura.id_ciclo','=',$ciclo)
     ->where('captura.estado','=',"ACTIVO")
     ->select('captura.categoria','captura.sostenimiento','captura.pagos_registrados','captura.qna_actual')->get();
     return response()->json(
       $captura);

   }

   public function busca_dias_captura_region($region,$ciclo){
     if ($region == "todas") {
       $captura=DB::table('captura')->join('centro_trabajo','centro_trabajo.id','=','captura.id_cct_etc')
       ->join('region','region.id','=','centro_trabajo.id_region')

       ->where('captura.id_ciclo','=',$ciclo)->where('captura.estado','=','ACTIVO')

       //->where('captura.id_cct_etc','=',$cct)
       ->where('captura.id_ciclo','=',$ciclo)
       ->where('captura.estado','=',"ACTIVO")
       ->select('region.region','region.sostenimiento','reclamos.total_dias','reclamos.total_reclamo','reclamos.estado','captura.categoria','captura.pagos_registrados','captura.qna_actual')->get();
         # code...
     }else{
       $captura=DB::table('captura')->join('centro_trabajo','centro_trabajo.id','=','captura.id_cct_etc')
       ->join('region','region.id','=','centro_trabajo.id_region')
       ->where('centro_trabajo.id_region','=',$region)

       ->where('captura.id_ciclo','=',$ciclo)->where('captura.estado','=','ACTIVO')
       ->select('region.region','region.sostenimiento','captura.categoria','captura.pagos_registrados','captura.qna_actual')->get();

       //->where('captura.id_ciclo','=',$ciclo)
       //->where('captura.estado','=',"ACTIVO")
       //->where('captura.id_cct_etc','=',$cct)
       //->select('region.region','region.sostenimiento','captura.categoria','captura.pagos_registrados','captura.qna_actual','centro_trabajo.nombre_escuela')->get();
     }
     return response()->json(
       $captura);

   }

   public function traerescuelas(Request $request,$esc)
   {
     $escuelas= CentroTrabajoModel::select('id','nombre_escuela','cct', 'estado')
     ->where('id_region','=',$esc)->where('estado','=','ACTIVO')
     ->get();

     return response()->json(
       $escuelas->toArray());
   }

   public function busca_captura_esc($region,$cct){
     if ($region == "todas") {
       $captura=DB::table('captura')
       ->join('centro_trabajo','centro_trabajo.id','=','captura.id_cct_etc')
       ->where('captura.id_cct_etc','=',$cct)
       ->where('captura.estado','=',"ACTIVO")
       ->select('captura.categoria','captura.pagos_registrados','captura.qna_actual','centro_trabajo.nombre_escuela')->get();
         # code...
     }else{
       $captura=DB::table('captura')
       ->join('centro_trabajo','centro_trabajo.id','=','captura.id_cct_etc')
       ->where('centro_trabajo.id_region','=',$region)
       ->where('captura.id_cct_etc','=',$cct)
       ->where('captura.estado','=',"ACTIVO")
       ->select('captura.categoria','captura.pagos_registrados','captura.qna_actual','centro_trabajo.nombre_escuela')->get();
     }
     return response()->json(
       $captura);

   }

   public function busca_captura_ciclo($ciclo){


     $captura= CapturaModel::select('id','estado')
     ->where('id_ciclo','=',$ciclo)
     ->get();

     return response()->json(
      $captura->toArray());
   }


   public function excel(Request $request)
   {

     Excel::create('excel', function($excel) {
       $excel->sheet('Excel sheet', function($sheet) {
                   //otra opción -> $products = Product::select('name')->get();
         $tabla = CapturaModel::join('cat_puesto','cat_puesto.id','=','captura.clave')
         ->join('centro_trabajo', 'centro_trabajo.id', '=','captura.id_cct_etc')
         ->join('region', 'region.id', '=','centro_trabajo.id_region')
         ->join('localidades', 'localidades.id', '=','centro_trabajo.id_localidades')
         ->join('municipios', 'municipios.id', '=','centro_trabajo.id_municipios')
         ->join('ciclo_escolar', 'ciclo_escolar.id', '=','captura.id_ciclo')

         ->select('centro_trabajo.cct','centro_trabajo.nombre_escuela','municipios.municipio','localidades.nom_loc'
           ,'centro_trabajo.domicilio','region.region','region.sostenimiento'
           ,'captura.nombre','captura.telefono','captura.email','captura.rfc'
           ,'cat_puesto.cat_puesto'
           ,'ciclo_escolar.ciclo'
           )
         ->get();
         $sheet->fromArray($tabla);
         $sheet->row(1,['CCT','NOMBRE ESCUELA','MUNICIPIO','LOCALIDAD' ,'DOMICILIO','REGION','SOSTENIMIENTO','NOMBRE','TELEFONO','EMAIL','RFC','CATEGORIA PUESTO','CICLO ESCOLAR']);
         $sheet->setOrientation('landscape');
       });
     })->export('xls');
   }





   public function excel2(Request $request, $aux)
   {

     Excel::create('REGISTRO DE LISTAS DE ASISTENCIA', function($excel) use($aux) {
       $excel->sheet('Excel sheet', function($sheet) use($aux) {
         $tabla = CapturaModel::join('cat_puesto','cat_puesto.id','=','captura.clave')
         ->join('centro_trabajo', 'centro_trabajo.id', '=','captura.id_cct_etc')
         ->join('region', 'region.id', '=','centro_trabajo.id_region')
         ->join('localidades', 'localidades.id', '=','centro_trabajo.id_localidades')
         ->join('municipios', 'municipios.id', '=','centro_trabajo.id_municipios')
         ->join('ciclo_escolar', 'ciclo_escolar.id', '=','captura.id_ciclo')

         ->select('centro_trabajo.cct','centro_trabajo.nombre_escuela','municipios.municipio','localidades.nom_loc'
           ,'centro_trabajo.domicilio','region.region','region.sostenimiento'
           ,'captura.nombre','captura.telefono','captura.email','captura.rfc'
           ,'cat_puesto.cat_puesto'
           ,'ciclo_escolar.ciclo')
         ->where('id_ciclo','=',$aux)
         ->get();
         $sheet->fromArray($tabla);
         $sheet->row(1,['CCT','NOMBRE ESCUELA','MUNICIPIO','LOCALIDAD' ,'DOMICILIO','REGION','SOSTENIMIENTO','NOMBRE','TELEFONO','EMAIL','RFC','CATEGORIA PUESTO','CICLO ESCOLAR']);
         $sheet->setOrientation('landscape');
       });
     })->export('xls');
   }

   public function invoice1($id){



     $personal= DB::table('captura')
     ->join('centro_trabajo', 'centro_trabajo.id', '=','captura.id_cct_etc')
     ->join('ciclo_escolar', 'ciclo_escolar.id', '=','captura.id_ciclo')
     ->select('captura.*','ciclo_escolar.ciclo','centro_trabajo.cct')->where('captura.id_ciclo','=',$id)->get();

     $date = date('Y-m-d');
     $invoice = "2222";
     //print_r($);
     $view =  \View::make('nomina.captura.invoice1', compact('date', 'invoice','personal'))->render();
     //->setPaper($customPaper, 'landscape');
     $pdf = \App::make('dompdf.wrapper');
     $pdf->loadHTML($view);
     return $pdf->stream('invoice');


   }

 }
