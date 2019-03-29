<?php

namespace petc\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use petc\Http\Requests;

use petc\Http\Controllers\Controller;
use petc\TabuladorPagosModel;

use DB;
use Maatwebsite\Excel\Facades\Excel;
use PHPExcel_Worksheet_Drawing;
use Validator; 
use \Milon\Barcode\DNS1D;
use \Milon\Barcode\DNS2D;
use petc\Http\Requests\TablaDePagosRequest;

class TabuladorPagosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(request $request)
    {
       $ciclos=DB::table('ciclo_escolar')->get();
       if($request)
       {
        $aux=$request->get('searchText');

        $query=trim($request->GET('searchText'));
        $tabla_2= DB::table('tabulador_pagos')->where('ciclo','=',$aux)->first();
        if(is_null($tabla_2)){
           $tabla_2= DB::table('tabulador_pagos')->where('ciclo','=','2018-2019')->first();
       }

       $tabla_pagos= DB::table('tabulador_pagos')->where('ciclo','LIKE','%'.$query.'%')->paginate(4);
       return view('nomina.tabulador_pagos.index',["tabla_pagos"=>$tabla_pagos,"searchText"=>$query,'ciclos'=> $ciclos,"tabla_2"=>$tabla_2]);
        //
   }}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $ciclos=DB::table('ciclo_escolar')->get();

        return view('nomina.tabulador_pagos.create', ['ciclos'=> $ciclos]);
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TablaDePagosRequest $formulario)
    {         
        $validator = Validator::make(
            $formulario->all(), 
            $formulario->rules(),
            $formulario->messages());
        if ($validator->valid()){

            if ($formulario->ajax()){
              return response()->json(["valid" => true], 200);
          }
          else{ 
            $tabla= new TabuladorPagosModel;

            $tabla->pago_director=$formulario->get('pago_director');
            $tabla->pago_docente=$formulario->get('pago_docente');
            $tabla->pago_intendente=$formulario->get('pago_intendente');
            $tabla->capturo="ADMINISTRADOR";
            $tabla->ciclo=$formulario->get('ciclo');
            $tabla->save();
            return Redirect::to('tabulador_pagos');
        //
        }
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
        $ciclos=DB::table('ciclo_escolar')->get();
        $pago=TabuladorPagosModel::findOrFail($id);
        return view("nomina.tabulador_pagos.edit",["pago"=>$pago,"ciclos"=>$ciclos]);
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
      $pago=TabuladorPagosModel::findOrFail($id);
      $pago->pago_director=$request->get('pago_director');
      $pago->pago_docente=$request->get('pago_docente');
      $pago->pago_intendente=$request->get('pago_intendente');
      $pago->capturo="ADMINISTRADOR";
      $pago->ciclo=$request->get('ciclo');
      $pago->update();
      return Redirect::to('tabulador_pagos');
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
       $pago=TabuladorPagosModel::findOrFail($id);
       $pago->delete();
       return Redirect::to('tabulador_pagos');

        //
   }

   public function invoice($id){ 
    $tabla_2= DB::table('tabulador_pagos')->where('ciclo','=',$id)->first();
    $tabla= DB::table('tabulador_pagos')->where('ciclo','=',$id)->get();
    $pago= DB::table('tabulador_pagos')->where('ciclo','=',$id)->first();
         //$material   = AlmacenMaterial:: findOrFail($id);
    $date = date('Y-m-d');
    $invoice = "2222";
       // print_r($materiales);    
    $view =  \View::make('nomina.tabulador_pagos.invoice', compact('date', 'invoice','tabla','tabla_2','pago'))->render();
    $pdf = \App::make('dompdf.wrapper');
    $pdf->setPaper('mediaA4', 'portrait');
    $pdf->loadHTML($view);
    return $pdf->stream('invoice');
}

public function excel(Request $request)
{        

    Excel::create('tabulador_pagos', function($excel) {
        $excel->sheet('Excel sheet', function($sheet) {
                //otra opción -> $products = Product::select('name')->get();
            $tabla = TabuladorPagosModel::select('pago_director','pago_docente','pago_intendente','capturo','ciclo')
            ->get();          
            $sheet->fromArray($tabla);
            $sheet->row(1,['PAGO DIRECTOR','PAGO DOCENTE' ,'PAGO INTENDENTE','CAPTURA','CICLO ESCOLAR']);
            $sheet->setOrientation('landscape');
        });
    })->export('xls');
}

    public function calculadora()
    {
    $ciclos=DB::table('ciclo_escolar')->get();
   $tabla= DB::table('tabulador_pagos')->get();
        return view("nomina.tabulador_pagos.calculadora",["tabla"=>$tabla,"ciclos"=>$ciclos]);
        //
   }
}
