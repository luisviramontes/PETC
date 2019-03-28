<?php

namespace petc\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use petc\Http\Requests;

use petc\Http\Controllers\Controller;
use petc\TablaPagosModel;

use DB;
use Maatwebsite\Excel\Facades\Excel;
use PHPExcel_Worksheet_Drawing;
use Validator;
use \Milon\Barcode\DNS1D;
use \Milon\Barcode\DNS2D;

class TablaPagosController extends Controller
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
        $tabla_2= DB::table('tabla_pagos')->where('ciclo','=',$aux)->first();
        if(is_null($tabla_2)){
         $tabla_2= DB::table('tabla_pagos')->where('ciclo','=','2018-2019')->first();
        }

        $tabla_pagos= DB::table('tabla_pagos')->where('ciclo','LIKE','%'.$query.'%')->paginate(24);
        return view('nomina.tabla_pagos.index',["tabla_pagos"=>$tabla_pagos,"searchText"=>$query,'ciclos'=> $ciclos,"tabla_2"=>$tabla_2]);
        // return view('nomina.tabla_pagos.index',['tabla_pagos' => $tabla_pagos,'ciclos'=> $ciclos]);
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

        return view('nomina.tabla_pagos.create', ['ciclos'=> $ciclos]);
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
        $tabla= new TablaPagosModel;
        $tabla->qna=$request->get('qna');
        $tabla->dias=$request->get('dias');
        $tabla->pago_director=$request->get('pago_director');
        $tabla->pago_docente=$request->get('pago_docente');
        $tabla->pago_intendente=$request->get('pago_intendente');
        $tabla->captura="ADMINISTRADOR";
        $tabla->ciclo=$request->get('ciclo');
        $tabla->save();
        return Redirect::to('tabla_pagos');

        //
    }

    public function invoice($id){
        $tabla_2= DB::table('tabla_pagos')->where('ciclo','=',$id)->first();
        $tabla= DB::table('tabla_pagos')->where('ciclo','=',$id)->get();
        $pago= DB::table('tabulador_pagos')->where('ciclo','=',$id)->first();
         //$material   = AlmacenMaterial:: findOrFail($id);
        $date = date('Y-m-d');
        $invoice = "2222";
       // print_r($materiales);
        $view =  \View::make('nomina.tabla_pagos.invoice', compact('date', 'invoice','tabla','tabla_2','pago'))->render();
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
        $ciclos=DB::table('ciclo_escolar')->get();
        $pago=TablaPagosModel::findOrFail($id);
        return view("nomina.tabla_pagos.edit",["pago"=>$pago,"ciclos"=>$ciclos]);
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
        $pago=TablaPagosModel::findOrFail($id);
        $pago->qna=$request->get('qna');
        $pago->dias=$request->get('dias');
        $pago->pago_director=$request->get('pago_director');
        $pago->pago_docente=$request->get('pago_docente');
        $pago->pago_intendente=$request->get('pago_intendente');
        $pago->captura="ADMINISTRADOR";
        $pago->ciclo=$request->get('ciclo');
        $pago->update();
        return Redirect::to('tabla_pagos');
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
       $pago=TablaPagosModel::findOrFail($id);
       $pago->delete();
       return Redirect::to('tabla_pagos');

        //
   }


   public function excel(Request $request)
   {

    Excel::create('tabla_pagos', function($excel) {
        $excel->sheet('Excel sheet', function($sheet) {
                //otra opción -> $products = Product::select('name')->get();
            $tabla = TablaPagosModel::select('qna','dias','pago_director','pago_docente','pago_intendente','captura','ciclo')
            ->where('ciclo','2018-2019')
            ->get();
            $sheet->fromArray($tabla);
            $sheet->row(1,['QNA','DIAS','PAGO DIRECTOR','PAGO DOCENTE' ,'PAGO INTENDENTE','CAPTURA','CICLO ESCOLAR']);
            $sheet->setOrientation('landscape');
        });
    })->export('xls');
}
}
