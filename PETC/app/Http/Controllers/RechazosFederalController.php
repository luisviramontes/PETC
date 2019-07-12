<?php

namespace petc\Http\Controllers;

use Illuminate\Http\Request;

use petc\Http\Requests;
use petc\Http\Controllers\Controller;


use petc\RechazosFederalModel;

use DB;
use petc\CapturaModel;
use Maatwebsite\Excel\Facades\Excel;
use PHPExcel_Worksheet_Drawing;
use Validator;
use \Milon\Barcode\DNS1D;
use \Milon\Barcode\DNS2D;
use petc\Http\Requests\RechazosFederalRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Collection as Collection;
class RechazosFederalController extends Controller
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
    public function index(Request $request)
    {
      if($request)
      {
       $query=trim($request->GET('searchText'));
       $rechazos = DB::table('rechazosfed')
       ->where('num_cheque','LIKE','%'.$query.'%')
       ->orwhere('udc','LIKE','%'.$query.'%')
       ->orwhere('rfc','LIKE','%'.$query.'%')
       ->orwhere('curp','LIKE','%'.$query.'%')
       ->orwhere('nombre','LIKE','%'.$query.'%')
       ->orwhere('ct','LIKE','%'.$query.'%')
       ->orwhere('importe','LIKE','%'.$query.'%')
       ->paginate(10);

      return view('nomina.rechazos_fed.index',["rechazos"=>$rechazos,"searchText"=>$query]);
    }
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


    ////////////exel////////////////

    public function excel(Request $request)
    {

     Excel::create('rechazosfed', function($excel) {
         $excel->sheet('Excel sheet', function($sheet) {

           $tabla = RechazosFederalModel::select('num_cheque','udc','rfc','curp','nombre','ct','importe','qna_pago','created_at')
           //->where('directorio_regional')
           ->get();
             $sheet->fromArray($tabla);
             $sheet->row(1,['NUMERO CHEQUE','UDC','RFC','CURP','NOMBRE','CT','IMPORTE','QUINCENA PAGO','FECHA DE CAPTURA']);
             $sheet->setOrientation('landscape');
         });
     })->export('xls');
    }

    public function invoice($id){
        $rechazo= DB::table('rechazosfed')->get();
      //    $directorio_regional= DB::table('tabulador_pagos')->where('ciclo','=',$id)->first();
         //$material   = AlmacenMaterial:: findOrFail($id);
        //$customPaper = array(0,0,567.00,283.80);
        $date = date('Y-m-d');
        $invoice = "2222";
       // print_r($materiales);
        $view =  \View::make('nomina.rechazos_fed.invoice', compact('date', 'invoice','rechazo'))->render();
        //->setPaper($customPaper, 'landscape');
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        return $pdf->stream('invoice');
    }




}
