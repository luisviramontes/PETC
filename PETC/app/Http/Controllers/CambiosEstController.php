<?php

namespace petc\Http\Controllers;

use Illuminate\Http\Request;

use petc\Http\Requests;
use petc\Http\Controllers\Controller;

use petc\CambiosCctModel;
use petc\CapturaModel;


use DB;
use Maatwebsite\Excel\Facades\Excel;
use PHPExcel_Worksheet_Drawing;
use Validator;
use \Milon\Barcode\DNS1D;
use \Milon\Barcode\DNS2D; 

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Collection as Collection;
class CambiosEstController extends Controller
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

          $contador= DB::table('cambios_cct')->join('captura','captura.id','=','cambios_cct.id_captura')->where('cambios_cct.estado','=','PENDIENTE')->where('captura.sostenimiento','=','ESTATAL')->count(); 

          if ($query == ""){
              $personal = DB::table('cambios_cct')->join('captura','captura.id','=','cambios_cct.id_captura')->join('cat_puesto','cat_puesto.id','=','cambios_cct.clave')->join('centro_trabajo', 'centro_trabajo.id', '=','cambios_cct.id_cct_anterior')->select('centro_trabajo.id_region','centro_trabajo.id_localidades','centro_trabajo.id_municipios')->join('region', 'region.id', '=','centro_trabajo.id_region')->join('localidades', 'localidades.id', '=','centro_trabajo.id_localidades')->join('municipios', 'municipios.id', '=','centro_trabajo.id_municipios')->join('ciclo_escolar', 'ciclo_escolar.id', '=','cambios_cct.id_ciclo')->join('centro_trabajo as ct2', 'ct2.id', '=','cambios_cct.id_cct_nuevo')->select('ct2.id_region','ct2.id_localidades','ct2.id_municipios')->join('region as reg2', 'reg2.id', '=','ct2.id_region')->join('localidades as loc2', 'loc2.id', '=','ct2.id_localidades')->join('municipios as mun2', 'mun2.id', '=','ct2.id_municipios')->select('captura.*','captura.id as idcaptura','cambios_cct.*','cat_puesto.cat_puesto','centro_trabajo.cct','ct2.cct as cct2','centro_trabajo.nombre_escuela','ct2.nombre_escuela as nombre_escuela2','ciclo_escolar.ciclo','region.region','reg2.region as region2','municipios.municipio','mun2.municipio as municipio2','localidades.nom_loc','loc2.nom_loc as nom_loc2')->where('captura.sostenimiento','=','ESTATAL')->orderBy('cambios_cct.estado','desc')->paginate(30);

          }else{
              $personal= DB::table('cambios_cct')->join('captura','captura.id','=','cambios_cct.id_captura')->join('cat_puesto','cat_puesto.id','=','cambios_cct.clave')->join('centro_trabajo', 'centro_trabajo.id', '=','cambios_cct.id_cct_anterior')->select('centro_trabajo.id_region','centro_trabajo.id_localidades','centro_trabajo.id_municipios')->join('region', 'region.id', '=','centro_trabajo.id_region')->join('localidades', 'localidades.id', '=','centro_trabajo.id_localidades')->join('municipios', 'municipios.id', '=','centro_trabajo.id_municipios')->join('ciclo_escolar', 'ciclo_escolar.id', '=','cambios_cct.id_ciclo')->join('centro_trabajo as ct2', 'ct2.id', '=','cambios_cct.id_cct_nuevo')->select('ct2.id_region','ct2.id_localidades','ct2.id_municipios')->join('region as reg2', 'reg2.id', '=','ct2.id_region')->join('localidades as loc2', 'loc2.id', '=','ct2.id_localidades')->join('municipios as mun2', 'mun2.id', '=','ct2.id_municipios')->select('captura.*','captura.id as idcaptura','cambios_cct.*','cat_puesto.cat_puesto','centro_trabajo.cct','ct2.cct as cct2','centro_trabajo.nombre_escuela','ct2.nombre_escuela as nombre_escuela2','ciclo_escolar.ciclo','region.region','reg2.region as region2','municipios.municipio','mun2.municipio as municipio2','localidades.nom_loc','loc2.nom_loc as nom_loc2')->where('captura.rfc','LIKE','%'.$query.'%')->orwhere('captura.nombre','LIKE','%'.$query.'%')->orderBy('cambios_cct.estado','desc')->where('captura.sostenimiento','=','ESTATAL')->paginate(30);
          }    


          return view('nomina.cambios.cambios_cct.estatal.index',["personal"=>$personal,"contador"=>$contador,"searchText"=>$query]);
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

      $personal= DB::table('cambios_cct')->join('captura','captura.id','=','cambios_cct.id_captura')->select('captura.nombre','captura.rfc','captura.telefono','captura.email','captura.num_escuelas','captura.cct_2','captura.sostenimiento','captura.dias_trabajados','cambios_cct.*')->where('cambios_cct.id','=',$id)->first();

      return view('nomina.cambios.cambios_cct.estatal.edit', ['claves'=> $claves,'cct'=>$cct,'ciclos'=>$ciclos,'personal'=>$personal]);
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
        $aux=$request->get('clave');
        $name = explode("_",$aux);

        $datos=CambiosCctModel::findOrFail($id);
        $datos->id_cct_nuevo= $request->get('cct_nuevo');
        //$datos->id_cct_anterior=$request->get('cct'); 
        $datos->clave=$name[0];
        $datos->categoria=$request->get('puesto');
        $datos->fecha_inicio=$request->get('fechai');
        $datos->fecha_baja=$request->get('fechaf');

        $datos->documentacion_entregada=$request->get('doc');
        $datos->observaciones=$request->get('observaciones');
        $datos->captura=$user;
        $datos->estado="PENDIENTE";
        $datos->id_ciclo=$request->get('ciclo_escolar'); 
        $datos->update();

        $tabla=CapturaModel::findOrFail($datos->id_captura);
        $tabla->id_cct_etc=$request->get('cct_nuevo');
        $tabla->clave=$name[0];
        $tabla->categoria=$request->get('puesto');
        $tabla->fecha_inicio=$request->get('fechai');
        $tabla->fecha_termino=$request->get('fechaf');
        $tabla->documentacion_entregada=$request->get('doc');
        $tabla->observaciones=$request->get('observaciones');
        $tabla->captura=$user;
        $tabla->id_ciclo=$request->get('ciclo_escolar'); 
        $tabla->tipo_movimiento="CAMBIOCCT";
        $tabla->cct_2=$request->get('cct_2');
        $tabla->num_escuelas=$request->get('num_escuelas');
        $tabla->dias_trabajados=$request->get('diassemana');

        $tabla->update();

        return redirect('cambios_cct_est');
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
         $altas=CambiosCctModel::findOrFail($id);
      $altas->estado="PENDIENTE";
      $altas->captura=$user;
      $altas->update();
      return redirect('cambios_cct_est');
        //
    }

    public function activar($id)
    { 
      $user = Auth::user()->name;
      $altas=CambiosCctModel::findOrFail($id);
      $altas->estado="RESUELTO";
      $altas->captura=$user;
      $altas->update();
      return redirect('cambios_cct_est');
        //
  }

  public function excel(Request $request)
  {
     Excel::create('CAMBIOS DE CTE ESTATALES', function($excel) {
         $excel->sheet('Excel sheet', function($sheet) {
           $personal = CambiosCctModel::join('captura','captura.id','=','cambios_cct.id_captura')->join('cat_puesto','cat_puesto.id','=','cambios_cct.clave')->join('centro_trabajo', 'centro_trabajo.id', '=','cambios_cct.id_cct_nuevo')->join('region', 'region.id', '=','centro_trabajo.id_region')->join('ciclo_escolar', 'ciclo_escolar.id', '=','cambios_cct.id_ciclo')->join('centro_trabajo as ct2', 'ct2.id', '=','cambios_cct.id_cct_anterior')->join('region as reg2', 'reg2.id', '=','ct2.id_region')->select('cambios_cct.id','captura.nombre','captura.rfc','captura.fecha_inicio','captura.fecha_termino','centro_trabajo.cct','centro_trabajo.nombre_escuela','captura.categoria','cat_puesto.cat_puesto','region.region','captura.sostenimiento','ct2.cct as cct2','ct2.nombre_escuela as nombre_escuela2','reg2.region as region2','captura.telefono','captura.email','captura.num_escuelas','captura.observaciones','cambios_cct.estado','ciclo_escolar.ciclo')->where('captura.sostenimiento','=','ESTATAL')->get();
           $sheet->fromArray($personal);
           $sheet->row(1,['ID','NOMBRE','RFC','FECHA DE INICIO','FECHA DE TERMINO','CCT NUEVO','NOMBRE ESCUELA','CATEGORIA','CLAVE','REGION','SOSTENIMIENTO','CCT ANTERIOR','NOMBRE ESCUELA','REGION','TELEFONO','EMAIL','NUM DE ESCUELAS ETC','OBSERVACIONES','ESTADO CAMBIO','CICLO ESCOLAR']);
           $sheet->setOrientation('landscape');
       });
     })->export('xls');
 }
}
