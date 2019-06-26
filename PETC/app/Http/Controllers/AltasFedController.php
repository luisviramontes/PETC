<?php

namespace petc\Http\Controllers;

use Illuminate\Http\Request;

use petc\Http\Requests;
use petc\Http\Controllers\Controller;

use petc\AltasContratoModel;
use petc\CapturaModel;

use DB;
use Maatwebsite\Excel\Facades\Excel;
use PHPExcel_Worksheet_Drawing;
use Validator;
use \Milon\Barcode\DNS1D;
use \Milon\Barcode\DNS2D;

class AltasFedController extends Controller
{
    /** 
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */ 
    public function index(request $request){
     if($request)
     {
       // $aux=$request->get('searchText');
      $query=trim($request->GET('searchText'));

      $contador= DB::table('altas_contrato')->join('captura','captura.id','=','altas_contrato.id_captura')->where('altas_contrato.estado','=','PENDIENTE')->where('captura.sostenimiento','=','FEDERAL')->count(); 

      if ($query == ""){ 
        $personal= DB::table('altas_contrato')->join('captura','captura.id','=','altas_contrato.id_captura')->join('cat_puesto','cat_puesto.id','=','altas_contrato.clave')->join('centro_trabajo', 'centro_trabajo.id', '=','altas_contrato.id_cct_etc')->select('centro_trabajo.id_region','centro_trabajo.id_localidades','centro_trabajo.id_municipios')->join('region', 'region.id', '=','centro_trabajo.id_region')->join('localidades', 'localidades.id', '=','centro_trabajo.id_localidades')->join('municipios', 'municipios.id', '=','centro_trabajo.id_municipios')->join('ciclo_escolar', 'ciclo_escolar.id', '=','altas_contrato.id_ciclo')->select('captura.*','captura.id as idcaptura','altas_contrato.*','cat_puesto.cat_puesto','centro_trabajo.cct','centro_trabajo.nombre_escuela','ciclo_escolar.ciclo','region.region','municipios.municipio','localidades.nom_loc')->where('captura.sostenimiento','=','FEDERAL')->orderBy('altas_contrato.estado','desc')->whereNull('altas_contrato.id_baja')->paginate(30);


         $personal2= DB::table('altas_contrato')->join('captura','captura.id','=','altas_contrato.id_captura')->join('cat_puesto','cat_puesto.id','=','altas_contrato.clave')->join('centro_trabajo', 'centro_trabajo.id', '=','altas_contrato.id_cct_etc')->select('centro_trabajo.id_region','centro_trabajo.id_localidades','centro_trabajo.id_municipios')->join('region', 'region.id', '=','centro_trabajo.id_region')->join('localidades', 'localidades.id', '=','centro_trabajo.id_localidades')->join('municipios', 'municipios.id', '=','centro_trabajo.id_municipios')->join('ciclo_escolar', 'ciclo_escolar.id', '=','altas_contrato.id_ciclo')->join('captura as captura2','captura2.id','=','altas_contrato.id_baja')->select('captura.*','captura.id as idcaptura','altas_contrato.*','cat_puesto.cat_puesto','centro_trabajo.cct','centro_trabajo.nombre_escuela','ciclo_escolar.ciclo','region.region','municipios.municipio','localidades.nom_loc','captura2.nombre as nombre_baja','captura2.rfc as rfc_baja')->where('captura2.nombre','!=',' ')->where('captura.sostenimiento','=','FEDERAL')->orderBy('altas_contrato.estado','desc')->paginate(30);



      }else{
        $personal= DB::table('altas_contrato')->join('captura','captura.id','=','altas_contrato.id_captura')->join('cat_puesto','cat_puesto.id','=','altas_contrato.clave')->join('centro_trabajo', 'centro_trabajo.id', '=','altas_contrato.id_cct_etc')->select('centro_trabajo.id_region','centro_trabajo.id_localidades','centro_trabajo.id_municipios')->join('region', 'region.id', '=','centro_trabajo.id_region')->join('localidades', 'localidades.id', '=','centro_trabajo.id_localidades')->join('municipios', 'municipios.id', '=','centro_trabajo.id_municipios')->join('ciclo_escolar', 'ciclo_escolar.id', '=','altas_contrato.id_ciclo')->select('captura.*','captura.id as idcaptura','altas_contrato.*','cat_puesto.cat_puesto','centro_trabajo.cct','centro_trabajo.nombre_escuela','ciclo_escolar.ciclo','region.region','municipios.municipio','localidades.nom_loc')->where('altas_contrato.id_baja','=','')->where('captura.rfc','LIKE','%'.$query.'%')->orwhere('captura.nombre','LIKE','%'.$query.'%')->orwhere('centro_trabajo.cct','LIKE','%'.$query.'%')->orderBy('altas_contrato.estado','desc')->where('captura.sostenimiento','=','FEDERAL')->whereNull('altas_contrato.id_baja')->paginate(30);

         $personal2= DB::table('altas_contrato')->join('captura','captura.id','=','altas_contrato.id_captura')->join('cat_puesto','cat_puesto.id','=','altas_contrato.clave')->join('centro_trabajo', 'centro_trabajo.id', '=','altas_contrato.id_cct_etc')->select('centro_trabajo.id_region','centro_trabajo.id_localidades','centro_trabajo.id_municipios')->join('region', 'region.id', '=','centro_trabajo.id_region')->join('localidades', 'localidades.id', '=','centro_trabajo.id_localidades')->join('municipios', 'municipios.id', '=','centro_trabajo.id_municipios')->join('ciclo_escolar', 'ciclo_escolar.id', '=','altas_contrato.id_ciclo')->join('captura as captura2','captura2.id','=','altas_contrato.id_baja')->select('captura.*','captura.id as idcaptura','altas_contrato.*','cat_puesto.cat_puesto','centro_trabajo.cct','centro_trabajo.nombre_escuela','ciclo_escolar.ciclo','region.region','municipios.municipio','localidades.nom_loc','captura2.nombre as nombre_baja','captura2.rfc as rfc_baja')->where('captura2.nombre','!=',' ')->where('captura.rfc','LIKE','%'.$query.'%')->orwhere('captura.nombre','LIKE','%'.$query.'%')->orwhere('captura2.nombre','LIKE','%'.$query.'%')->orwhere('centro_trabajo.cct','LIKE','%'.$query.'%')->orderBy('altas_contrato.estado','desc')->where('captura.sostenimiento','=','FEDERAL')->paginate(30);


      }    


      return view('nomina.altas.federal.index',["personal"=>$personal,"contador"=>$contador,"searchText"=>$query,"personal2"=>$personal2]);
      //print_r($personal);
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
      $captura=DB::table('captura')->get();

      return view('nomina.altas.federal.create', ['claves'=> $claves,'cct'=>$cct,'ciclos'=>$ciclos,'captura'=>$captura]);
        //
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

      $personal= DB::table('altas_contrato')->join('captura','captura.id','=','altas_contrato.id_captura')->join('cat_puesto','cat_puesto.id','=','altas_contrato.clave')->join('centro_trabajo', 'centro_trabajo.id', '=','altas_contrato.id_cct_etc')->select('centro_trabajo.id_region','centro_trabajo.id_localidades','centro_trabajo.id_municipios')->join('region', 'region.id', '=','centro_trabajo.id_region')->join('localidades', 'localidades.id', '=','centro_trabajo.id_localidades')->join('municipios', 'municipios.id', '=','centro_trabajo.id_municipios')->join('ciclo_escolar', 'ciclo_escolar.id', '=','altas_contrato.id_ciclo')->select('captura.*','altas_contrato.*','cat_puesto.cat_puesto','centro_trabajo.cct','centro_trabajo.nombre_escuela','ciclo_escolar.ciclo','region.region','municipios.municipio','localidades.nom_loc')->where('altas_contrato.id','=',$id)->first();

      return view('nomina.altas.federal.edit', ['claves'=> $claves,'cct'=>$cct,'ciclos'=>$ciclos,'personal'=>$personal]);

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
      $aux=$request->get('clave');
      $name = explode("_",$aux);

      $datos=AltasContratoModel::findOrFail($id);
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
      $datos->update();

      $tabla=CapturaModel::findOrFail($datos->id_captura);
      $tabla->id_cct_etc=$request->get('cct');
      $tabla->clave=$name[0];
      $tabla->categoria=$request->get('puesto');
      $tabla->fecha_inicio=$request->get('fechai');
      $tabla->fecha_termino=$request->get('fechaf');
      $tabla->documentacion_entregada=$request->get('doc');
      $tabla->observaciones=$request->get('observaciones');
      $tabla->captura="ADMINISTRADOR";
      $tabla->id_ciclo=$request->get('ciclo_escolar'); 
      $tabla->tipo_movimiento=$datos->tipo_movimiento;
      $tabla->cct_2=$request->get('cct_2');
      $tabla->num_escuelas=$request->get('num_escuelas');
      $tabla->dias_trabajados=$request->get('diassemana');
      $tabla->update();


      return redirect('altasfed');
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
      $altas=AltasContratoModel::findOrFail($id);
      $altas->estado="PENDIENTE";
      $altas->captura="ADMINISTRADOR";
      $altas->update();
      return redirect('altasfed');
        //
    }

    public function activar($id)
    { 
      $altas=AltasContratoModel::findOrFail($id);
      $altas->estado="RESUELTO";
      $altas->captura="ADMINISTRADOR";
      $altas->update();
      return redirect('altasfed');
        //
    }

    public function excel(Request $request)
    {
     Excel::create('ALTAS FEDERALES', function($excel) {
       $excel->sheet('Excel sheet', function($sheet) {
         $personal = AltasContratoModel::join('captura','captura.id','=','altas_contrato.id_captura')->join('cat_puesto','cat_puesto.id','=','altas_contrato.clave')->join('centro_trabajo', 'centro_trabajo.id', '=','altas_contrato.id_cct_etc')->join('region', 'region.id', '=','centro_trabajo.id_region')->join('ciclo_escolar', 'ciclo_escolar.id', '=','altas_contrato.id_ciclo')->select('altas_contrato.id','captura.nombre','captura.rfc','captura.fecha_inicio','captura.fecha_termino','centro_trabajo.cct','centro_trabajo.nombre_escuela','captura.categoria','cat_puesto.cat_puesto','region.region','captura.sostenimiento','captura.telefono','captura.email','captura.num_escuelas','captura.observaciones','altas_contrato.estado','ciclo_escolar.ciclo')->where('altas_contrato.estado','=','PENDIENTE')->where('captura.sostenimiento','=','FEDERAL')->get();
         $sheet->fromArray($personal);
         $sheet->row(1,['ID','NOMBRE','RFC','FECHA DE INICIO','FECHA DE TERMINO','CCT','NOMBRE ESCUELA','CATEGORIA','CLAVE','REGION','SOSTENIMIENTO','TELEFONO','EMAIL','NUM DE ESCUELAS ETC','OBSERVACIONES','ESTADO ALTA','CICLO ESCOLAR']);
         $sheet->setOrientation('landscape');
       });
     })->export('xls');
   }





 }
