<?php

namespace petc\Http\Controllers;

use Illuminate\Http\Request;

use petc\Http\Requests;
use petc\Http\Controllers\Controller;


use petc\RechazosEstModel;

use DB;

use Maatwebsite\Excel\Facades\Excel;
use PHPExcel_Worksheet_Drawing;
use Validator;
use \Milon\Barcode\DNS1D;
use \Milon\Barcode\DNS2D;
use petc\Http\Requests\RechazosEstRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Collection as Collection;
class RechazosEstController extends Controller
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
       $rechazos = DB::table('rechazosest')
       ->where('nomemp','LIKE','%'.$query.'%')
       ->orwhere('rfcemp','LIKE','%'.$query.'%')
       ->orwhere('numemp','LIKE','%'.$query.'%')
       ->orwhere('per','LIKE','%'.$query.'%')
       ->orwhere('qna_pago','LIKE','%'.$query.'%')
       ->orwhere('ded','LIKE','%'.$query.'%')

       ->paginate(10);

      return view('nomina.rechazos_est.index',["rechazos"=>$rechazos,"searchText"=>$query]);
    }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

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

     Excel::create('rechazosest', function($excel) {
         $excel->sheet('Excel sheet', function($sheet) {

           $tabla = RechazosEstModel::select('numemp','rfcemp','nomemp','per','ded','exp_6','qna_pago','created_at')
           //->where('directorio_regional')
           ->get();
             $sheet->fromArray($tabla);
             $sheet->row(1,['NUMERO EMPLEADO','RFC','NOMBRE EMPLEADO','PER','DED','EXP 6','QUINCENA PAGO','FECHA DE CAPTURA']);
             $sheet->setOrientation('landscape');
         });
     })->export('xls');
    }

    public function invoice($id){
        $rechazo= DB::table('rechazosest')->get();
      //    $directorio_regional= DB::table('tabulador_pagos')->where('ciclo','=',$id)->first();
         //$material   = AlmacenMaterial:: findOrFail($id);
        //$customPaper = array(0,0,567.00,283.80);
        $date = date('Y-m-d');
        $invoice = "2222";
       // print_r($materiales);
        $view =  \View::make('nomina.rechazos_est.invoice', compact('date', 'invoice','rechazo'))->render();
        //->setPaper($customPaper, 'landscape');
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        return $pdf->stream('invoice');
    }


}
