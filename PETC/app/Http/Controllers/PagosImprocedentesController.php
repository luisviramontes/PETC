<?php

namespace petc\Http\Controllers;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use petc\Http\Requests;
use petc\Http\Controllers\Controller;

use petc\PagosImprocedentesModel;

use DB;

use Maatwebsite\Excel\Facades\Excel;
use PHPExcel_Worksheet_Drawing;
use Validator;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Collection as Collection;

class PagosImprocedentesController extends Controller
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
     if($tipo_usuario <> "2" || $tipo_usuario=="5"){
       return view('permisos');

   }else{
     $query=trim($request->GET('searchText'));
    $query2=trim($request->GET('ciclo_escolar2'));

    $ciclos=DB::table('ciclo_escolar')->get();

    $pagos=DB::table('pagos_improcedentes')->where('pagos_improcedentes.id_ciclo','=',$query2) ->where('rfc','LIKE','%'.$query.'%')->orwhere('nom_emp','LIKE','%'.$query.'%')->join('ciclo_escolar','ciclo_escolar.id','=','pagos_improcedentes.id_ciclo')->select('pagos_improcedentes.*','ciclo_escolar.ciclo')->orderby('pagos_improcedentes.estado','desc')->paginate(40);

    return view('nomina.pagos_improcedentes.index',["ciclos"=>$ciclos,"pagos" => $pagos,"ciclo_escolar2"=>$query2,"searchText"=>$query]);


}
        //
}

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

   }
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
      $tipo_usuario = Auth::user()->tipo_usuario;
      if($tipo_usuario <> "2" || $tipo_usuario=="5"){
       return view('permisos');

   }else{

   }
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

   }
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
      $tipo_usuario = Auth::user()->tipo_usuario;
      if($tipo_usuario <> "2" || $tipo_usuario=="5"){
       return view('permisos');

   }else{

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
        $cuadro=PagosImprocedentesModel::findOrFail($id);
        $cuadro->estado="PENDIENTE";
        $cuadro->update();
        return redirect('pagos_improcedentes'.'?ciclo_escolar2=2');


    }
        //
}

public function excel(Request $request, $aux)
{

 Excel::create('PAGOS IMPROCEDENTES', function($excel) use($aux) {
   $excel->sheet('Excel sheet', function($sheet) use($aux) {
     $personal = PagosImprocedentesModel::join('ciclo_escolar','ciclo_escolar.id','=','pagos_improcedentes.id_ciclo')->where('pagos_improcedentes.id_ciclo','=',$aux)->select('pagos_improcedentes.region','pagos_improcedentes.rfc','pagos_improcedentes.nom_emp','pagos_improcedentes.qna_ini','pagos_improcedentes.qna_fin','pagos_improcedentes.qna_pago','pagos_improcedentes.num_cheque','pagos_improcedentes.perc','pagos_improcedentes.ded','pagos_improcedentes.neto','pagos_improcedentes.observaciones','pagos_improcedentes.estado','ciclo_escolar.ciclo','pagos_improcedentes.captura')->get();
     $sheet->fromArray($personal);
     $sheet->row(1,['REGION','RFC','NOMBRE EMPLEADO','QNA INCIAL','QNA FIN','QNA PAGO','NUM DE CHQUE','PERCEPCION','DEDUCCION','NETO','OBSERVACIONES','ESTADO','CICLO ESCOLAR','CAPTURA']);
     $sheet->setOrientation('landscape');
 });
})->export('xls');
}


public function invoice($aux){

    $cuadro = PagosImprocedentesModel::join('ciclo_escolar','ciclo_escolar.id','=','pagos_improcedentes.id_ciclo')->where('pagos_improcedentes.id_ciclo','=',$aux)->select('pagos_improcedentes.region','pagos_improcedentes.rfc','pagos_improcedentes.nom_emp','pagos_improcedentes.qna_ini','pagos_improcedentes.qna_fin','pagos_improcedentes.qna_pago','pagos_improcedentes.num_cheque','pagos_improcedentes.perc','pagos_improcedentes.ded','pagos_improcedentes.neto','pagos_improcedentes.observaciones','pagos_improcedentes.estado','ciclo_escolar.ciclo','pagos_improcedentes.captura')->get();



      //    $directorio_regional= DB::table('tabulador_pagos')->where('ciclo','=',$id)->first();
         //$material   = AlmacenMaterial:: findOrFail($id);
        //$customPaper = array(0,0,567.00,283.80);
    $date = date('Y-m-d');
    $invoice = "2222";
       // print_r($materiales);
    $view =  \View::make('nomina.pagos_improcedentes.invoice', compact('date', 'invoice','cuadro'))->render();
        //->setPaper($customPaper, 'landscape');
    $pdf = \App::make('dompdf.wrapper');
    $pdf->loadHTML($view);
    return $pdf->stream('invoice');
}

public function activar($id){
          $tipo_usuario = Auth::user()->tipo_usuario;
      if($tipo_usuario <> "2" || $tipo_usuario=="5"){
         return view('permisos');

     }else{
        $cuadro=PagosImprocedentesModel::findOrFail($id);
        $cuadro->estado="RESUELTO";
        $cuadro->update();
        return redirect('pagos_improcedentes'.'?ciclo_escolar2=2');


    }

}
}
