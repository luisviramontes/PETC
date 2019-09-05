<?php

namespace petc\Http\Controllers;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use petc\Http\Requests;
use petc\Http\Controllers\Controller;

use petc\CuadrosCifraModel;

use DB;

use Maatwebsite\Excel\Facades\Excel;
use PHPExcel_Worksheet_Drawing;
use Validator;
use \Milon\Barcode\DNS1D;
use \Milon\Barcode\DNS2D;
use petc\Http\Requests\CicloEscolarRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Collection as Collection;

class CuadroCifrasController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    { 

       $tipo_usuario = Auth::user()->tipo_usuario;
       if($tipo_usuario <> "1" && $tipo_usuario <> "2"  && $tipo_usuario <> "3" && $tipo_usuario <> "4" &&    $tipo_usuario <> "5" && $tipo_usuario <> "6"){
         return view('permisos');

     }else{
      if($request)
      {
       // $aux=$request->get('searchText');

         $query2=trim($request->GET('ciclo_escolar2'));

         $ciclos=DB::table('ciclo_escolar')->get();

         $cuadro=DB::table('cuadros_cifra')->where('cuadros_cifra.id_ciclo','=',$query2)->join('ciclo_escolar','ciclo_escolar.id','=','cuadros_cifra.id_ciclo')->join('tabla_pagos','tabla_pagos.id','=','cuadros_cifra.id_qna')->select('cuadros_cifra.*','ciclo_escolar.ciclo','tabla_pagos.dias','tabla_pagos.qna','pago_director','pago_docente','pago_intendente')->paginate(40);

         return view('nomina.cuadros_cifras.index',["ciclos"=>$ciclos,"cuadro" => $cuadro,"ciclo_escolar2"=>$query2]);
     }
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
        $tipo_usuario = Auth::user()->tipo_usuario;
        if($tipo_usuario <> "2" || $tipo_usuario=="5"){
         return view('permisos');

     }else{
        $ciclos=DB::table('ciclo_escolar')->get();
        $cuadro=DB::table('cuadros_cifra')->where('cuadros_cifra.id','=',$id)->join('ciclo_escolar','ciclo_escolar.id','=','cuadros_cifra.id_ciclo')->join('tabla_pagos','tabla_pagos.id','=','cuadros_cifra.id_qna')->select('cuadros_cifra.*','ciclo_escolar.ciclo','tabla_pagos.dias','tabla_pagos.qna','pago_director','pago_docente','pago_intendente')->first() ;
        return view("nomina.cuadros_cifras.edit",["cuadro"=>$cuadro,"ciclos"=>$ciclos]);
        //
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
        $cuadro=CuadrosCifraModel::findOrFail($id);
        $cuadro->total_reclamos=$request->get('total');
        $cuadro->total_deducciones=$request->get('deducciones');
        $cuadro->total_liquido=$request->get('liquido');
        $cuadro->total_percepciones=$request->get('percepc');
        $cuadro->save();
        return redirect('cuadros_cifras'.'?ciclo_escolar2=2');

    }
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
      $tipo_usuario = Auth::user()->tipo_usuario;
      if($tipo_usuario <> "2" || $tipo_usuario=="5"){
         return view('permisos');

     }else{
        $cuadro=CuadrosCifraModel::findOrFail($id);
        $cuadro->delete();
        return redirect('cuadros_cifras'.'?ciclo_escolar2=2');


    }
        //
}

public function excel(Request $request, $aux)
{

 Excel::create('CUADROS DE CIFRAS', function($excel) use($aux) {
   $excel->sheet('Excel sheet', function($sheet) use($aux) {
     $personal = CuadrosCifraModel::join('ciclo_escolar','ciclo_escolar.id','=','cuadros_cifra.id_ciclo')->join('tabla_pagos','tabla_pagos.id','=','cuadros_cifra.id_qna')->where('cuadros_cifra.id_ciclo','=',$aux)->select('tabla_pagos.qna','cuadros_cifra.categoria','cuadros_cifra.total_reclamos','cuadros_cifra.total_percepciones','cuadros_cifra.total_deducciones','cuadros_cifra.total_liquido','ciclo_escolar.ciclo','cuadros_cifra.captura')->get();
     $sheet->fromArray($personal);
     $sheet->row(1,['QNA','CATEGORIA','TOTAL REGISTROS','PERCEPCIONES','TOTAL DEDUCCIONES','TOTAL LIQUIDO','CICLO ESCOLAR','CAPTURA']);
     $sheet->setOrientation('landscape');
 });
})->export('xls');
}


public function invoice($id){

    $cuadro=DB::table('cuadros_cifra')->where('cuadros_cifra.id_ciclo','=',$id)->join('ciclo_escolar','ciclo_escolar.id','=','cuadros_cifra.id_ciclo')->join('tabla_pagos','tabla_pagos.id','=','cuadros_cifra.id_qna')->select('cuadros_cifra.*','ciclo_escolar.ciclo','tabla_pagos.dias','tabla_pagos.qna','pago_director','pago_docente','pago_intendente')->get() ;



      //    $directorio_regional= DB::table('tabulador_pagos')->where('ciclo','=',$id)->first();
         //$material   = AlmacenMaterial:: findOrFail($id);
        //$customPaper = array(0,0,567.00,283.80);
    $date = date('Y-m-d');
    $invoice = "2222";
       // print_r($materiales);
    $view =  \View::make('nomina.cuadros_cifras.invoice', compact('date', 'invoice','cuadro'))->render();
        //->setPaper($customPaper, 'landscape');
    $pdf = \App::make('dompdf.wrapper');
    $pdf->loadHTML($view);
    return $pdf->stream('invoice');
}


}