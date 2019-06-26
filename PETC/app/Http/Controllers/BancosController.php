<?php

namespace petc\Http\Controllers;

use Illuminate\Http\Request;

use petc\Http\Requests;
use petc\Http\Controllers\Controller;

use petc\BancosModel;

use DB;

use Maatwebsite\Excel\Facades\Excel;
use PHPExcel_Worksheet_Drawing;
use Validator;
use \Milon\Barcode\DNS1D;
use \Milon\Barcode\DNS2D;
use petc\Http\Requests\BancosRequest;

class BancosController extends Controller
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
       $bancos = DB::table('bancos')
       ->where('nombre_banco','LIKE','%'.$query.'%')
       ->orwhere('operacion','LIKE','%'.$query.'%')
       ->orwhere('descripcion','LIKE','%'.$query.'%')
       ->orwhere('estado','LIKE','%'.$query.'%')
       ->paginate(10);

      return view('nomina.bancos.index',["bancos"=>$bancos,"searchText"=>$query]);
    }
  }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view("nomina.bancos.create");

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $banco = new BancosModel;
        $banco -> nombre_banco = $request ->nombre_banco;
        $banco -> operacion = $request ->operacion;
        $banco -> descripcion = $request ->descripcion;
        $banco -> estado = "ACTIVO";
        $banco -> captura = "ADMINISTRADOR";
        if($banco->save()){

          return redirect('bancos');

        }else {
        return false;
        }
    }

    public function invoice($id){
        $bancos= DB::table('bancos')->get();
      //    $directorio_regional= DB::table('tabulador_pagos')->where('ciclo','=',$id)->first();
         //$material   = AlmacenMaterial:: findOrFail($id);
        //$customPaper = array(0,0,567.00,283.80);
        $date = date('Y-m-d');
        $invoice = "2222";
       // print_r($materiales);
        $view =  \View::make('nomina.bancos.invoice', compact('date', 'invoice','bancos'))->render();
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
      $bancos = BancosModel::find($id);
      return view("nomina.bancos.edit",["bancos"=>$bancos]);
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
        $banco = BancosModel::find($id);
        $banco -> nombre_banco = $request ->nombre_banco;
        $banco -> operacion = $request ->operacion;
        $banco -> descripcion = $request ->descripcion;
        $banco -> estado = "ACTIVO";
        $banco -> captura = "ADMINISTRADOR";
        if($banco->save()){

          return redirect('bancos');

        }else {
        return false;
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
      $banco=BancosModel::findOrFail($id);
      $banco->estado="INACTIVO";
      $banco->captura="ADMINISTRADOR";
      $banco->update();
        return redirect('bancos');
    }

    ////////////exel////////////////

    public function excel(Request $request)
    {

     Excel::create('bancos', function($excel) {
         $excel->sheet('Excel sheet', function($sheet) {
                 //otra opción -> $products = Product::select('name')->get();
             $tabla = BancosModel::select('nombre_banco','operacion','descripcion','estado','created_at')
             //->where('directorio_regional')
             ->get();
             $sheet->fromArray($tabla);
             $sheet->row(1,['NOMBRE BANCO','OPERACION','DESCRIPCION','ESTADO','Fecha de Registro']);
             $sheet->setOrientation('landscape');
         });
     })->export('xls');
 }



}
