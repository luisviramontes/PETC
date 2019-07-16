<?php

namespace petc\Http\Controllers;
use petc\RechazosFederalModel;
use petc\RechazosEstModel;
use Illuminate\Http\Request;

use petc\Http\Requests;
use petc\Http\Controllers\Controller;


use petc\RechazoCapModel;

use DB;
use petc\CapturaModel;
use Maatwebsite\Excel\Facades\Excel;
use PHPExcel_Worksheet_Drawing;
use Validator;
use \Milon\Barcode\DNS1D;
use \Milon\Barcode\DNS2D;
use petc\Http\Requests\RechazoCapRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Collection as Collection;
class RechazoCapController extends Controller
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
      $tipo_usuario = Auth::user()->tipo_usuario;
      if($tipo_usuario <> "2" || $tipo_usuario=="5"){
       return view('permisos');

      }else{
      if($request)
      {
       $query=trim($request->GET('searchText'));
       $cap_rechazo = DB::table('cap_rechazo')


       ->where('qna','LIKE','%'.$query.'%')
       ->orwhere('sostenimiento','LIKE','%'.$query.'%')
       ->orwhere('tipo','LIKE','%'.$query.'%')
       ->orwhere('estado','LIKE','%'.$query.'%')
       ->paginate(24);
      }


      return view('nomina.cap_rechazo.index',["cap_rechazo" => $cap_rechazo,"searchText"=>$query]);
    }}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {    
            $tipo_usuario = Auth::user()->tipo_usuario;
      if($tipo_usuario <> "2" || $tipo_usuario=="5"){
       return view('permisos');

      }else{
        $quincena= DB::table('tabla_pagos')->get();

          return view("nomina.cap_rechazo.create",["quincena"=>$quincena]);
    }}

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
              $tipo_usuario = Auth::user()->tipo_usuario;
      if($tipo_usuario <> "2" || $tipo_usuario=="5"){
       return view('permisos');

      }else{
      $user = Auth::user()->name;
      $rechazo = new RechazoCapModel;
      $rechazo -> qna = $request ->qna;
      $rechazo -> sostenimiento = $request ->sostenimiento;
      $rechazo -> tipo = $request ->tipo;
      $rechazo -> estado ="ACTIVO";
      $rechazo ->  captura=$user;

      $sostenimiento = $rechazo->sostenimiento;
      if($sostenimiento  == "ESTATAL") {

        /////////////////////////////

        $path = $request->file->getRealPath();
        $data = Excel::load($path)->get();


            foreach ($data as $key => $value) {
                $arr[] = [
                  'numemp' => $value->numemp,
                  'rfcemp' => $value->rfcemp,
                  'nomemp' => $value->nomemp,
                  'per' => $value->per,
                  'ded' => $value->ded,
                  'exp_6' => $value->exp_6,
                  'qna_pago' => $value->qna_pago,
                  'created_at' => $value->created_at,

                ];
            }

            if(!empty($arr)){
                DB::table('rechazosest')->insert($arr);

            }

          ///////////////////////////////////////////////77
      }else{

        $path = $request->file->getRealPath();
        $data = Excel::load($path)->get();


            foreach ($data as $key => $value) {
                $arr[] = [
                  'num_cheque' => $value->num_cheque,
                  'udc' => $value->udc,
                  'rfc' => $value->rfc,
                  'curp' => $value->curp,
                  'nombre' => $value->nombre,
                  'ct' => $value->ct,
                  'importe' => $value->importe,
                  'qna_pago' => $value->qna_pago,
                  'created_at' => $value->created_at,

                ];
            }

            if(!empty($arr)){
                DB::table('rechazosfed')->insert($arr);

            }


      }




      if($rechazo->save()){

        return redirect('cap_rechazo');

      }else {
      return false;
      }
    }}

    public function invoice($id){
        $rechazo= DB::table('cap_rechazo')->get();
      //    $directorio_regional= DB::table('tabulador_pagos')->where('ciclo','=',$id)->first();
         //$material   = AlmacenMaterial:: findOrFail($id);
        //$customPaper = array(0,0,567.00,283.80);
        $date = date('Y-m-d');
        $invoice = "2222";
       // print_r($materiales);
        $view =  \View::make('nomina.cap_rechazo.invoice', compact('date', 'invoice','rechazo'))->render();
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
              $tipo_usuario = Auth::user()->tipo_usuario;
      if($tipo_usuario <> "2" || $tipo_usuario=="5"){
       return view('permisos');

      }else{
        $rechazo=RechazoCapModel::findOrFail($id);
        $quincena= DB::table('tabla_pagos')->get();

        return view("nomina.cap_rechazo.edit",[ "rechazo"=>$rechazo,"quincena"=>$quincena]);
    }}

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
              $tipo_usuario = Auth::user()->tipo_usuario;
      if($tipo_usuario <> "2" || $tipo_usuario=="5"){
       return view('permisos');

      }else{
        $rechazo=RechazoCapModel::findOrFail($id);

        $rechazo -> qna = $request ->qna;
        $rechazo -> sostenimiento = $request ->sostenimiento;
        $rechazo -> tipo = $request ->tipo;
        $rechazo -> estado ="ACTIVO";
        $rechazo ->  captura=$user;

        $sostenimiento = $rechazo->sostenimiento;
        if($sostenimiento  == "ESTATAL") {

          /////////////////////////////

          $path = $request->file->getRealPath();
          $data = Excel::load($path)->get();


              foreach ($data as $key => $value) {
                  $arr[] = [
                    'numemp' => $value->numemp,
                    'rfcemp' => $value->rfcemp,
                    'nomemp' => $value->nomemp,
                    'per' => $value->per,
                    'ded' => $value->ded,
                    'exp_6' => $value->exp_6,
                    'qna_pago' => $value->qna_pago,
                    'created_at' => $value->created_at,

                  ];
              }

              if(!empty($arr)){
                  DB::table('rechazosest')->insert($arr);

              }

            ///////////////////////////////////////////////77
        }else{

          $path = $request->file->getRealPath();
          $data = Excel::load($path)->get();


              foreach ($data as $key => $value) {
                  $arr[] = [
                    'num_cheque' => $value->num_cheque,
                    'udc' => $value->udc,
                    'rfc' => $value->rfc,
                    'curp' => $value->curp,
                    'nombre' => $value->nombre,
                    'ct' => $value->ct,
                    'importe' => $value->importe,
                    'qna_pago' => $value->qna_pago,
                    'created_at' => $value->created_at,

                  ];
              }

              if(!empty($arr)){
                  DB::table('rechazosfed')->insert($arr);

              }


        }




        if($rechazo->save()){

          return redirect('cap_rechazo');

        }else {
        return false;
        }
    }}
    /////////////////////////////////////////////////////////////////////////////////////////////

    public function validar_quincena($qna,$sostenimiento,$tipo)
    {
     $rechazo = RechazoCapModel::select('qna','sostenimiento','tipo','estado')
     ->where('qna',"=" ,$qna)
     ->where('sostenimiento', "=" ,$sostenimiento)
     ->where('tipo', "=" ,$tipo)
     ->where('estado', "=" ,"INACTIVO")
     ->get();
         return response()->json(
           $rechazo->toArray());

    }

    public function validar_quincenaExis($qna,$sostenimiento,$tipo)
    {
     $rechazo = RechazoCapModel::select('qna','sostenimiento','tipo','estado')
     ->where('qna',"=" ,$qna)
     ->where('sostenimiento', "=" ,$sostenimiento)
     ->where('tipo', "=" ,$tipo)
     ->where('estado', "=" ,"ACTIVO")
     ->get();
         return response()->json(
           $rechazo->toArray());

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
              $tipo_usuario = Auth::user()->tipo_usuario;
      if($tipo_usuario <> "2" || $tipo_usuario=="5"){
       return view('permisos');

      }else{
      $rechazo=RechazoCapModel::findOrFail($id);
      $rechazo->estado="INACTIVO";
      $rechazo->captura=$user;
      $rechazo->update();

      $qna =  $rechazo->qna;

      $sostenimiento = $rechazo->sostenimiento;

      if($sostenimiento  == "FEDERAL") {
      RechazosFederalModel::where('qna_pago', $qna)->delete();

    }else if($sostenimiento  == "ESTATAL"){
      RechazosEstModel::where('qna_pago', $qna)->delete();
      }
      $rechazo->update();
      return redirect('cap_rechazo');
    }}

    ////////////exel////////////////

    public function excel(Request $request)
    {

     Excel::create('cap_rechazo', function($excel) {
         $excel->sheet('Excel sheet', function($sheet) {

           $tabla = RechazoCapModel::select('qna','sostenimiento','tipo','estado','captura','created_at')
           //->where('directorio_regional')
           ->get();
             $sheet->fromArray($tabla);
             $sheet->row(1,['QUINCENA','SOSTENIMIENTO','TIPO','ESTADO','CAPTURA','FECHA DE CAPTURA']);
             $sheet->setOrientation('landscape');
         });
     })->export('xls');
    }



}
