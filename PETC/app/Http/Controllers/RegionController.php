<?php

namespace petc\Http\Controllers;

use Illuminate\Http\Request;

use petc\Http\Requests;
use petc\Http\Controllers\Controller;


use petc\RegionModel;

use DB;

use Maatwebsite\Excel\Facades\Excel;
use PHPExcel_Worksheet_Drawing;
use Validator;
use \Milon\Barcode\DNS1D;
use \Milon\Barcode\DNS2D;
use petc\Http\Requests\RegionRequest;


class RegionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(request $request)
    {
      ///////////////////buscar////////////////////////7
      if($request)
      {
       $query=trim($request->GET('searchText'));
       $regiones = DB::table('region')
       ->where('region','LIKE','%'.$query.'%')
       ->orwhere('sostenimiento','LIKE','%'.$query.'%')
       ->paginate(24);
      }
       return view('nomina.region.index',["regiones"=>$regiones ,"searchText"=>$query]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("nomina.region.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RegionRequest $formulario)
    {
      $validator = Validator::make(
      $formulario->all(),
      $formulario->rules(),
      $formulario->messages());

      if ($formulario->ajax()){
        return response()->json(["valid" => true], 200);
      }
      else{
      $region= new RegionModel;
      $region -> region = $formulario ->region;
      $region -> sostenimiento = $formulario ->sostenimiento;
      $region -> capturo="ADMINISTRADOR";

      if($region->save()){

        return redirect('/region');

      }else {
      return view('region.index');
      }
    }
  }

    //convertir y descargar pdf

    public function invoice($id){
        $regiones= DB::table('region')->get();
      //    $directorio_regional= DB::table('tabulador_pagos')->where('ciclo','=',$id)->first();
         //$material   = AlmacenMaterial:: findOrFail($id);
        //$customPaper = array(0,0,567.00,283.80);
        $date = date('Y-m-d');
        $invoice = "2222";
       // print_r($materiales);
        $view =  \View::make('nomina.region.invoice', compact('date', 'invoice','regiones'))->render();
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
      $regiones = RegionModel::find($id);
      return view("nomina.region.edit",["regiones"=>$regiones]);
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
      $regiones = RegionModel::find($id);
      //asignamos nuevos valores
      $regiones -> region = $request ->region;
      $regiones -> sostenimiento = $request ->sostenimiento;
      $regiones -> capturo="ADMINISTRADOR";
      //guardar
      if($regiones->save()){

        return redirect('/region');

      }else {
      return view('region.index');
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
      RegionModel::destroy($id);
      return redirect('/region');
    }

    ////////////exel////////////////

    public function excel(Request $request)
    {

     Excel::create('region', function($excel) {
         $excel->sheet('Excel sheet', function($sheet) {
                 //otra opción -> $products = Product::select('name')->get();
             $tabla = RegionModel::select('region','sostenimiento')
             //->where('directorio_regional')
             ->get();
             $sheet->fromArray($tabla);
             $sheet->row(1,['REGION','SOSTENIMIENTO']);
             $sheet->setOrientation('landscape');
         });
     })->export('xls');
 }
}
