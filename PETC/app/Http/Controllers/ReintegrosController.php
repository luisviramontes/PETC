<?php

namespace petc\Http\Controllers;

use Illuminate\Http\Request;

use petc\Http\Requests;
use petc\Http\Controllers\Controller;

use DB;
use petc\CapturaModel;
use petc\DirectorioRegionalModel;
use petc\ReintegrosModel;
use Maatwebsite\Excel\Facades\Excel;
use PHPExcel_Worksheet_Drawing;
use Validator;
use \Milon\Barcode\DNS1D;
use \Milon\Barcode\DNS2D;
use petc\Http\Requests\ReintegrosRequest;


class ReintegrosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      if($request)
      {
       $query=trim($request->GET('searchText'));
       $reintegros = DB::table('reintegros')
       ->join('centro_trabajo','reintegros.id_centro_trabajo', '=', 'centro_trabajo.id' ) //cct
       ->join('captura','reintegros.id_captura', '=', 'captura.id' ) //nombre, sostenimiento, categoria
       ->join('directorio_regional','reintegros.id_directorio_regional', '=', 'directorio_regional.id' ) //director_regional,sostenimiento
       ->join('ciclo_escolar','reintegros.id_ciclo_escolar', '=', 'ciclo_escolar.id' ) //ciclo
       ->join('region','reintegros.id_region', '=', 'region.id' ) //region

       ->select('reintegros.id as id','reintegros.id_centro_trabajo','reintegros.id_captura','reintegros.id_directorio_regional','reintegros.id_ciclo_escolar'
       ,'reintegros.num_dias','reintegros.total','reintegros.n_oficio','reintegros.motivo','reintegros.estado'
       ,'reintegros.captura','reintegros.created_at'
       ,'centro_trabajo.cct'
       ,'captura.nombre','captura.categoria'
       ,'directorio_regional.director_regional','directorio_regional.id_region'
       ,'ciclo_escolar.ciclo')

       ->where('reintegros.total','LIKE','%'.$query.'%')
       ->orwhere('reintegros.n_oficio','LIKE','%'.$query.'%')
       ->orwhere('reintegros.motivo','LIKE','%'.$query.'%')
       ->orwhere('reintegros.estado','LIKE','%'.$query.'%')
       ->orwhere('centro_trabajo.cct','LIKE','%'.$query.'%')
       ->orwhere('captura.nombre','LIKE','%'.$query.'%')
       ->orwhere('directorio_regional.director_regional','LIKE','%'.$query.'%')
       ->paginate(24);
       //print_r($listas);
      return view('nomina.reintegros.index',["reintegros"=>$reintegros,"searchText"=>$query]);

    }
}
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $cct= DB::table('centro_trabajo')->get();
      $captura= DB::table('captura')->get();
      $directorio_regional=DB::table('directorio_regional')->get();
      $tabla= DB::table('tabulador_pagos')->get();
      return view("nomina.reintegros.create",["directorio_regional"=>$directorio_regional,"captura"=>$captura,"cct"=>$cct,"tabla"=>$tabla]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $reintegros= new ReintegrosModel;

      $id_cap=$request->get('id_captura');
      //$first=head($id_cct);
      $name=explode("_",$id_cap);
      $reintegros -> id_captura = $name[2];

      $reintegros -> id_centro_trabajo = $request ->id_centro_trabajo;

      $reintegros -> id_directorio_regional = $request ->id_directorio_regional;

      $id_ciclo=$request->get('id_ciclo_escolar');
      //$first=head($id_cct);
      $ciclo=explode("_",$id_ciclo);
      $reintegros -> id_ciclo_escolar = $ciclo[4];

      $reintegros -> num_dias = $request ->num_dias;
      //$reintegros -> categoria = $request ->categoria;
      $reintegros -> total = $request ->total;
      $reintegros -> n_oficio = $request ->n_oficio;
      $reintegros -> motivo = $request ->motivo;

      $reintegros -> estado = "ACTIVO";
      $reintegros -> captura = "ADMINISTRADOR";


      if($reintegros->save()){

        return redirect('/reintegros');

      }else {
      return false;
      }
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

    public function traerpersonal(Request $request,$cct)
      {
        $personal= CapturaModel::
        select('id','categoria','nombre','sostenimiento', 'estado')
        ->where('id_cct_etc','=',$cct)->where('estado','=','ACTIVO')
        ->get();

        return response()->json(
          $personal->toArray());
}

public function traerdire(Request $request,$dire)
  {
    $director= DirectorioRegionalModel::select('id','director_regional', 'estado')
    ->where('id_region','=',$dire)->where('estado','=','ACTIVO')
    ->get();

    return response()->json(
      $director->toArray());
}



}
