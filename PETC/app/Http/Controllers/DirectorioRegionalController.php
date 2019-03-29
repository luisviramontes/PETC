<?php

namespace petc\Http\Controllers;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use petc\Http\Requests;
use petc\Http\Controllers\Controller;

use petc\DirectorioRegionalModel;

use DB;

use Maatwebsite\Excel\Facades\Excel;
use PHPExcel_Worksheet_Drawing;
use Validator;
use \Milon\Barcode\DNS1D;
use \Milon\Barcode\DNS2D;


class DirectorioRegionalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      $region = $request->get('region');

    $sostenimiento = $request->get('sostenimiento');

    $nombre_enlace = $request->get('nombre_enlace');

    $directorio_regional = DirectorioRegionalModel::orderBy('id', 'DESC')
                ->region($region)
               ->sostenimiento($sostenimiento)
                //->nombre_enlace($nombre_enlace)
              ->paginate(24);
    return view('nomina.directorio_regional.index',['directorio_regional' => $directorio_regional);

    }








    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

      return view("nomina.directorio_regional.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $directorio= new DirectorioRegionalModel;
      $directorio -> region = $request ->region;
      $directorio -> sostenimiento = $request ->sostenimiento;
      $directorio -> nombre_enlace=$request ->nombre_enlace;
      $directorio -> telefono=$request->telefono;
      $directorio -> ext1_enlace=$request ->ext1_enlace;
      $directorio -> ext2_enlace=$request ->ext2_enlace;
      $directorio -> correo_enlace=$request ->correo_enlace;
      $directorio -> director_regional=$request ->director_regional;
      $directorio -> telefono_director=$request ->telefono_director;
      $directorio -> financiero_regional=$request ->financiero_regional;
      $directorio -> telefono_regional=$request ->telefono_regional;
      $directorio -> ext_reg_1=$request ->ext_reg_1;
      $directorio -> ext_reg_2=$request ->ext_reg_2;
      $directorio -> captura="Administrador";





      if($directorio->save()){

        return redirect('/directorio_regional');

      }else {
      return view('director_regional.index');
      }

    }

    //convertir y descargar pdf

    public function invoice($id){
        $directorio_regional= DB::table('directorio_regional')->get();
      //    $directorio_regional= DB::table('tabulador_pagos')->where('ciclo','=',$id)->first();
         //$material   = AlmacenMaterial:: findOrFail($id);
        //$customPaper = array(0,0,567.00,283.80);
        $date = date('Y-m-d');
        $invoice = "2222";
       // print_r($materiales);
        $view =  \View::make('nomina.directorio_regional.invoice', compact('date', 'invoice','directorio_regional'))->render();
        //->setPaper($customPaper, 'landscape');
        $pdf = \App::make('dompdf.wrapper');
        $pdf->setPaper('A4', 'portrait');
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

      $directorio = DirectorioRegionalModel::find($id);
      return view("nomina.directorio_regional.edit",["directorio"=>$directorio]);
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

        $directorio = DirectorioRegionalModel::find($id);
        //asignamos nuevos valores
        $directorio -> region = $request ->region;
        $directorio -> sostenimiento = $request ->sostenimiento;
        $directorio -> nombre_enlace=$request ->nombre_enlace;
        $directorio -> telefono=$request->telefono;
        $directorio -> ext1_enlace=$request ->ext1_enlace;
        $directorio -> ext2_enlace=$request ->ext2_enlace;
        $directorio -> correo_enlace=$request ->correo_enlace;
        $directorio -> director_regional=$request ->director_regional;
        $directorio -> telefono_director=$request ->telefono_director;
        $directorio -> financiero_regional=$request ->financiero_regional;
        $directorio -> telefono_regional=$request ->telefono_regional;
        $directorio -> ext_reg_1=$request ->ext_reg_1;
        $directorio -> ext_reg_2=$request ->ext_reg_2;
        $directorio -> captura="Administrador";
        //guardar
        if($directorio->save()){

          return redirect('/directorio_regional');

        }else {
        return view('director_regional.index');
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
      DirectorioRegionalModel::destroy($id);
      return redirect('/directorio_regional');
    }

    ////////////exel////////////////

    public function excel(Request $request)
    {

     Excel::create('directorio_regional', function($excel) {
         $excel->sheet('Excel sheet', function($sheet) {
                 //otra opción -> $products = Product::select('name')->get();
             $tabla = DirectorioRegionalModel::select('region','sostenimiento','nombre_enlace','telefono','ext1_enlace','ext2_enlace','correo_enlace','director_regional','telefono_director','financiero_regional','telefono_regional','ext_reg_1','ext_reg_2')
             //->where('directorio_regional')
             ->get();
             $sheet->fromArray($tabla);
             $sheet->row(1,['REGION','SOSTENIMIENTO','NOMBRE DE ENLACE','TELEFONO','EXTENCION 1 ENLACE' ,'EXTENCION 2 ENLACE','CORREO ENLACE','DIRECTOR REGIONAL','TELEFONO DIRECTOR','FINANCIOERO REGIONAL','TELEFONO REGIONAL','EXTENCION REGIONAL 1','EXTENCION REGIONAL 2']);
             $sheet->setOrientation('landscape');
         });
     })->export('xls');
 }

}
