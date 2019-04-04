<?php

namespace petc\Http\Controllers;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use petc\Http\Requests;
use petc\Http\Controllers\Controller;

use petc\ListasAsistenciaModel;

use DB;
use Maatwebsite\Excel\Facades\Excel;
use PHPExcel_Worksheet_Drawing;
use Validator;
use \Milon\Barcode\DNS1D;
use \Milon\Barcode\DNS2D;
use petc\Http\Requests\ListaAsistenciasRequest;

class ListasAsistenciasController extends Controller
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
       $query=trim($request->GET('searchText'));
       $listas = DB::table('listas_de_asistencias')
       ->join('centro_trabajo','listas_de_asistencias.id_centro_trabajo', '=', 'centro_trabajo.id' )
       ->select('centro_trabajo.id_region as id_region' )
       ->join('region','centro_trabajo.id_region', '=' ,'region.id')
     //->join('centro_trabajo','listas_de_asistencias.id', '=','centro_trabajo.id')

       ->select('listas_de_asistencias.id as id','listas_de_asistencias.id_centro_trabajo','listas_de_asistencias.mes'
       ,'listas_de_asistencias.estado','listas_de_asistencias.observaciones','listas_de_asistencias.captura',
       'centro_trabajo.nombre_escuela','centro_trabajo.cct','region.region')
       ->where('nombre_escuela','LIKE','%'.$query.'%')
       ->orwhere('cct','LIKE','%'.$query.'%')
       ->orwhere('region.region','LIKE','%'.$query.'%')
       ->paginate(10);
       //print_r($listas);
      return view('nomina.listas_asistencias.index',["listas"=>$listas,"searchText"=>$query]);
      // return view('nomina.tabla_pagos.index',['tabla_pagos' => $tabla_pagos,'ciclos'=> $ciclos]);
      //




       //$listas = ListasAsistenciaModel::orderBy('id', 'DESC')
        //                    ->paginate(24);

      //return view('nomina.listas_asistencias.index',['listas'=>$listas]);

        //
    }
}
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $escuelas=DB::table('centro_trabajo')->get();
      $cct= DB::table('centro_trabajo')->get();
      return view("nomina.listas_asistencias.create",["escuelas"=>$escuelas,"cct"=>$cct]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


      $lista= new ListasAsistenciaModel;

      $id_cct=$request->get('cct');
      //$first=head($id_cct);
      $name=explode("_",$id_cct);
      $lista -> id_centro_trabajo = $name[2];
      $lista -> mes = $request ->mes;
      $lista -> estado = "ACTIVO";
      $lista -> observaciones = $request ->observaciones;
      $lista -> captura="Administrador";

      if($lista->save()){

        return redirect('/listas_asistencias');

      }else {
      return view('listas_asistencias.create');
      }
    }

    //convertir y descargar pdf

    public function invoice($id){
        $listas= DB::table('listas_de_asistencias')
        ->join('centro_trabajo','listas_de_asistencias.id_centro_trabajo', '=', 'centro_trabajo.id' )
      //->join('centro_trabajo','listas_de_asistencias.id', '=','centro_trabajo.id'
        ->select('listas_de_asistencias.*','centro_trabajo.nombre_escuela','centro_trabajo.cct as cct','centro_trabajo.region')->get();
        //$centro_trabajo= DB::table('centro_trabajo')->where('cct','=',$id)->first();
         //$material   = AlmacenMaterial:: findOrFail($id);
        //$customPaper = array(0,0,567.00,283.80);

        $date = date('Y-m-d');
        $invoice = "2222";
        print_r($listas);
        $view =  \View::make('nomina.listas_asistencias.invoice', compact('date', 'invoice','listas'))->render();
        //->setPaper($customPaper, 'landscape');
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        return $pdf->stream('invoice');
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
      $listas = ListasAsistenciaModel::find($id);
      $escuelas=DB::table('centro_trabajo')->get();
      $cct= DB::table('centro_trabajo')->get();
      return view("nomina.listas_asistencias.edit",["listas"=>$listas,"escuelas"=>$escuelas,"cct"=>$cct]);
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

      $listas = ListasAsistenciaModel::find($id);

      $id_cct=$request->get('cct');
      //$first=head($id_cct);
      $name=explode("_",$id_cct);
      $listas -> id_centro_trabajo = $name[2];
      //$listas -> region = $request ->region;
      $listas -> mes = $request ->mes;
      //$listas -> estado = $request ->estado;
      $listas -> observaciones = $request ->observaciones;
      $listas -> captura="Administrador";

      if($listas->save()){

        return redirect('/listas_asistencias');

      }else {
      return view('listas_asistencias.index');
      }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      ListasAsistenciaModel::destroy($id);
      return redirect('/listas_asistencias');
    }

    ////////////exel////////////////

    public function excel(Request $request)
    {

     Excel::create('listas_asistencias', function($excel) {
         $excel->sheet('Excel sheet', function($sheet) {

             $tabla = ListasAsistenciaModel::join('centro_trabajo','listas_de_asistencias.id_centro_trabajo', '=', 'centro_trabajo.id')
             ->select('centro_trabajo.cct','centro_trabajo.nombre_escuela','centro_trabajo.region','listas_de_asistencias.mes'
             ,'listas_de_asistencias.estado','listas_de_asistencias.observaciones')
             ->get();
             $sheet->fromArray($tabla);
             $sheet->row(1,['CCT','NOMBRE ESCUELA','REGION','MES','ESTADO','OBSERVACIONES']);
             $sheet->setOrientation('landscape');
         });
     })->export('xls');
 }



}
