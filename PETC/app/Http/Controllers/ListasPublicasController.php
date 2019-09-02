<?php

namespace petc\Http\Controllers;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use petc\Http\Requests;
use petc\Http\Controllers\Controller;

use petc\ListasAsistenciaModel;
use petc\CentroTrabajoModel;
use petc\CapturaModel;
use petc\DiasMesModel;


use DB;
use Maatwebsite\Excel\Facades\Excel;
use PHPExcel_Worksheet_Drawing;
use Validator;
use \Milon\Barcode\DNS1D;
use \Milon\Barcode\DNS2D;
use petc\Http\Requests\ListaAsistenciasRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Collection as Collection;
class ListasPublicasController extends Controller
{ 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(request $request)
    {
        $cct=DB::table('centro_trabajo')->get();
        $ciclos=DB::table('ciclo_escolar')->get();


        $query=trim($request->GET('cct2'));
        $query2=trim($request->GET('ciclo_escolar'));


        $listas = DB::table('listas_de_asistencias')
        ->join('centro_trabajo','listas_de_asistencias.id_centro_trabajo', '=', 'centro_trabajo.id' )
        ->join('region','centro_trabajo.id_region', '=' ,'region.id')
        ->join('ciclo_escolar','listas_de_asistencias.id_ciclo', '=','ciclo_escolar.id')
        ->select('listas_de_asistencias.id as id','listas_de_asistencias.id_centro_trabajo','listas_de_asistencias.mes'
         ,'listas_de_asistencias.estado','listas_de_asistencias.observaciones','listas_de_asistencias.captura','centro_trabajo.id as id_centro',
         'centro_trabajo.nombre_escuela','centro_trabajo.cct','region.region','region.sostenimiento','ciclo_escolar.id as id_ciclo_c','ciclo_escolar.ciclo','listas_de_asistencias.created_at','listas_de_asistencias.updated_at')
        ->where('listas_de_asistencias.id_ciclo','=',$query2)
        ->where('listas_de_asistencias.id_centro_trabajo','=',$query)
        ->get();



        return view('nomina.listas_asistencias.consulta',["cct"=>$cct,"ciclos"=>$ciclos,"listas" => $listas,"cct2"=>$query,"ciclo_escolar"=>$query2]);
        //
    }

    public function generar_pdf_listas(Request $request,$cct,$ciclo,$mes){

       $centros= CentroTrabajoModel::join('directorio_regional','directorio_regional.id_region','=','centro_trabajo.id_region')->join('director_cct','director_cct.id_cct_etc','=','centro_trabajo.id')->join('captura','captura.id','=','director_cct.id_captura')->select('centro_trabajo.id','captura.nombre','centro_trabajo.cct','centro_trabajo.nombre_escuela','directorio_regional.director_regional','directorio_regional.nombre_enlace')->where('centro_trabajo.estado','=','ACTIVO')->where('centro_trabajo.id','=',$cct)->orderBy('centro_trabajo.id','desc')->get();
       $ciclo_aux=DB::table('ciclo_escolar')->where('id','=',$ciclo)->first()->ciclo;

       $captura=CapturaModel::join('centro_trabajo','centro_trabajo.id','=','captura.id_cct_etc')->select('captura.nombre','captura.rfc','captura.categoria','captura.id_cct_etc')->where('centro_trabajo.id','=',$cct)->where('captura.estado','=','ACTIVO')->orderBy('centro_trabajo.id','desc')->get();

   $dias=DiasMesModel::select('l_semana','dia')->where('mes','=',$mes)->where('tipo_dia','=','HABIL')->where('ciclo','=',$ciclo_aux)->get();
  //print_r($meses);
      $mes_aux = $mes;
   $cuenta=count($centros);
   $cuenta_dias=count($dias);
   $captura_n=count($captura);
   $pdf=$request->get('pdf');


     $view =  \View::make('nomina.listas_asistencias.invoice_consulta', compact('captura_n','captura','ciclo_aux','centros','dias','mes_aux','cuenta','cuenta_dias'))->render();
        //->setPaper($customPaper, 'landscape');
   $pdf = \App::make('dompdf.wrapper');
   $pdf->loadHTML($view);
   return $pdf->stream('invoice_listas.pdf');
 }

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
}
