<?php

namespace petc\Http\Controllers;

use Illuminate\Http\Request;

use petc\Http\Requests;
use petc\Http\Controllers\Controller;

use petc\CambiosFuncionModel;
use petc\CapturaModel;


use DB;
use Maatwebsite\Excel\Facades\Excel;
use PHPExcel_Worksheet_Drawing;
use Validator;
use \Milon\Barcode\DNS1D;
use \Milon\Barcode\DNS2D; 


class CambiosFunFedController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(request $request) {
        if($request)
        {
       // $aux=$request->get('searchText');
          $query=trim($request->GET('searchText'));

          $contador= DB::table('cambio_funcion')->join('captura','captura.id','=','cambio_funcion.id_captura')->where('cambio_funcion.estado','=','PENDIENTE')->where('captura.sostenimiento','=','FEDERAL')->count(); 

          if ($query == ""){
              $personal = DB::table('cambio_funcion')->join('captura','captura.id','=','cambio_funcion.id_captura')->join('cat_puesto','cat_puesto.id','=','cambio_funcion.clave')->join('centro_trabajo', 'centro_trabajo.id', '=','cambio_funcion.id_cct_etc')->select('centro_trabajo.id_region','centro_trabajo.id_localidades','centro_trabajo.id_municipios')->join('region', 'region.id', '=','centro_trabajo.id_region')->join('localidades', 'localidades.id', '=','centro_trabajo.id_localidades')->join('municipios', 'municipios.id', '=','centro_trabajo.id_municipios')->join('ciclo_escolar', 'ciclo_escolar.id', '=','cambio_funcion.id_ciclo')->select('captura.rfc','captura.nombre','captura.telefono','region.sostenimiento','captura.email','captura.fecha_termino','captura.fecha_inicio','captura.pagos_registrados','captura.qna_actual','captura.dias_trabajados','captura.tipo_movimiento','captura.cct_2','captura.id as idcaptura','cambio_funcion.*','cat_puesto.cat_puesto','centro_trabajo.cct','centro_trabajo.nombre_escuela','ciclo_escolar.ciclo','region.region','municipios.municipio','localidades.nom_loc')->where('captura.sostenimiento','=','FEDERAL')->orderBy('cambio_funcion.estado','desc')->paginate(30);

          }else{
           $personal = DB::table('cambio_funcion')->join('captura','captura.id','=','cambio_funcion.id_captura')->join('cat_puesto','cat_puesto.id','=','cambio_funcion.clave')->join('centro_trabajo', 'centro_trabajo.id', '=','cambio_funcion.id_cct_etc')->select('centro_trabajo.id_region','centro_trabajo.id_localidades','centro_trabajo.id_municipios')->join('region', 'region.id', '=','centro_trabajo.id_region')->join('localidades', 'localidades.id', '=','centro_trabajo.id_localidades')->join('municipios', 'municipios.id', '=','centro_trabajo.id_municipios')->join('ciclo_escolar', 'ciclo_escolar.id', '=','cambio_funcion.id_ciclo')->select('captura.rfc','captura.nombre','captura.telefono','region.sostenimiento','captura.email','captura.fecha_termino','captura.fecha_inicio','captura.pagos_registrados','captura.qna_actual','captura.dias_trabajados','captura.tipo_movimiento','captura.cct_2','captura.id as idcaptura','cambio_funcion.*','cat_puesto.cat_puesto','centro_trabajo.cct','centro_trabajo.nombre_escuela','ciclo_escolar.ciclo','region.region','municipios.municipio','localidades.nom_loc')->where('captura.rfc','LIKE','%'.$query.'%')->orwhere('captura.nombre','LIKE','%'.$query.'%')->orderBy('cambio_funcion.estado','desc')->where('captura.sostenimiento','=','FEDERAL')->paginate(30);
       }    


       return view('nomina.cambios.cambios_funcion.federal.index',["personal"=>$personal,"contador"=>$contador,"searchText"=>$query]);
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

      $personal= DB::table('cambio_funcion')->join('captura','captura.id','=','cambio_funcion.id_captura')->select('captura.nombre','captura.rfc','captura.telefono','captura.email','captura.num_escuelas','captura.cct_2','captura.sostenimiento','captura.dias_trabajados','captura.categoria','cambio_funcion.*')->where('cambio_funcion.id','=',$id)->first();

        return view('nomina.cambios.cambios_funcion.federal.edit', ['claves'=> $claves,'cct'=>$cct,'ciclos'=>$ciclos,'personal'=>$personal]);
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

     $datos=CambiosFuncionModel::findOrFail($id);
     $datos->categoria_nueva=$request->get('puesto');
        //$datos->id_cct_nuevo= $request->get('cct_nuevo');
     $datos->id_cct_etc=$request->get('cct'); 
     $datos->clave=$name[0];
     $datos->fecha_inicio=$request->get('fechai');
     $datos->fecha_baja=$request->get('fechaf');

     $datos->documentacion_entregada=$request->get('doc');
     $datos->observaciones=$request->get('observaciones');
     $datos->captura="ADMINISTRADOR";
     $datos->estado="PENDIENTE";
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
     $tabla->tipo_movimiento="CAMBIOFUNCION";
     $tabla->cct_2=$request->get('cct_2');
     $tabla->num_escuelas=$request->get('num_escuelas');
     $tabla->dias_trabajados=$request->get('diassemana');

     $tabla->update();

     return redirect('cambios_funcion_fed');
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
           $altas=CambiosFuncionModel::findOrFail($id);
      $altas->estado="PENDIENTE";
      $altas->captura="ADMINISTRADOR";
      $altas->update();
      return redirect('cambios_funcion_fed');
        //
    }
 
      public function activar($id)
    { 
      $altas=CambiosFuncionModel::findOrFail($id);
      $altas->estado="RESUELTO";
      $altas->captura="ADMINISTRADOR";
      $altas->update();
      return redirect('cambios_funcion_fed');
        //
  }

    public function excel(Request $request)
  {
     Excel::create('CAMBIOS DE FUNCIONES FEDERALES', function($excel) {
         $excel->sheet('Excel sheet', function($sheet) {
           $personal = CambiosFuncionModel::join('captura','captura.id','=','cambio_funcion.id_captura')->join('cat_puesto','cat_puesto.id','=','cambio_funcion.clave')->join('centro_trabajo', 'centro_trabajo.id', '=','cambio_funcion.id_cct_etc')->join('region', 'region.id', '=','centro_trabajo.id_region')->join('ciclo_escolar', 'ciclo_escolar.id', '=','cambio_funcion.id_ciclo')->select('cambio_funcion.id','captura.rfc','captura.nombre','captura.telefono','centro_trabajo.cct','centro_trabajo.nombre_escuela','region.region','region.sostenimiento','captura.fecha_inicio','captura.fecha_termino','cambio_funcion.categoria_anterior','cambio_funcion.categoria_nueva','cat_puesto.cat_puesto','cambio_funcion.observaciones','cambio_funcion.estado','ciclo_escolar.ciclo')->where('captura.sostenimiento','=','FEDERAL')->get();
           $sheet->fromArray($personal);
           $sheet->row(1,['ID','RFC','NOMBRE','TELEFONO','CCT','NOMBRE ESCUELA','REGION','SOSTENIMIENTO','FECHA DE INICIO','FECHA DE TERMINO','CATEGORIA ANTERIOR','CATEGORIA NUEVA','CLAVE','OBSERVACIONES','ESTADO','CICLO ESCOLAR']);
           $sheet->setOrientation('landscape');
       });
     })->export('xls');
 }
}
