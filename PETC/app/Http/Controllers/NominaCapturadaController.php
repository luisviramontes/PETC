<?php

namespace petc\Http\Controllers;
use petc\NominaCapturadaModel;
use petc\NominaEstatalModel;
use petc\NominaFederalModel;
use Illuminate\Http\Request;

use petc\Http\Requests;
use petc\Http\Controllers\Controller;
use DB;
use Excel;
use PHPExcel_Worksheet_Drawing;
use Validator;
use \Milon\Barcode\DNS1D;
use \Milon\Barcode\DNS2D;
use petc\Http\Requests\NominaCapturadaRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Collection as Collection;
class NominaCapturadaController extends Controller
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
       $nomina_capturada = DB::table('nomina_capturada')
       ->where('qna','LIKE','%'.$query.'%')
       ->orwhere('sostenimiento','LIKE','%'.$query.'%')
       ->orwhere('tipo','LIKE','%'.$query.'%')
       ->orwhere('estado','LIKE','%'.$query.'%')
       ->paginate(24);
      }


      return view('nomina.nomina_capturada.index',["nomina_capturada" => $nomina_capturada,"searchText"=>$query]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {     $quincena= DB::table('tabla_pagos')->get();
          return view("nomina.nomina_capturada.create",["quincena"=>$quincena]);

    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(NominaCapturadaRequest $formulario)
    {
      $user = Auth::user()->name;
      $validator = Validator::make(
      $formulario->all(),
      $formulario->rules(),
      $formulario->messages());

      if ($formulario->ajax()){
        return response()->json(["valid" => true], 200);
      }else{
        $nomina = new NominaCapturadaModel;
        $nomina -> qna = $formulario ->qna;
        $nomina -> sostenimiento = $formulario ->sostenimiento;
        $nomina -> estado ="ACTIVO";
        $nomina -> tipo = $formulario ->tipo;
        $nomina ->  captura=$user;



        $sostenimiento = $nomina->sostenimiento;
        if($sostenimiento  == "ESTATAL") {

          /////////////////////////////

          $path = $formulario->file->getRealPath();
          $data = Excel::load($path)->get();


              foreach ($data as $key => $value) {
                  $arr[] = [
                    'bco' => $value->bco,
                    'num_cheque' => $value->num_cheque,
                    'num_empleado' => $value->num_empleado,
                    'rfc' => $value->rfc,
                    'nombre' => $value->nombre,
                    'cve' => $value->cve,
                    'plaza' => $value->plaza,
                    'contrato' => $value->contrato,
                    'cct' => $value->cct,
                    'region' => $value->region,
                    'perc' => $value->perc,
                    'ded' => $value->ded,
                    'neto' => $value->neto,
                    'qna_ini' => $value->qna_ini,
                    'qna_fin' => $value->qna_fin,
                    'qna_pago' => $value->qna_pago,
                    'ciclo_escolar' => $value->ciclo_escolar,
                    'created_at' => $value->created_at,
                  ];
              }

              if(!empty($arr)){
                  DB::table('nomina_estatal')->insert($arr);

              }
            ///////////////////////////////////////////////77
        }else{

          $path = $formulario->file->getRealPath();
          $data = Excel::load($path)->get();


              foreach ($data as $key => $value) {
                  $arr[] = [
                    'region' => $value->region,
                    'rfc' => $value->rfc,
                    'nom_emp' => $value->nom_emp,
                    'ent_fed' => $value->ent_fed,
                    'ct_clasif' => $value->ct_clasif,
                    'ct_id' => $value->ct_id,
                    'ct_sec' => $value->ct_sec,
                    'ct_digito_ver' => $value->ct_digito_ver,
                    'cod_pago' => $value->cod_pago,
                    'unidad' => $value->unidad,
                    'subunidad' => $value->subunidad,
                    'cat_puesto' => $value->cat_puesto,
                    'horas' => $value->horas,
                    'cons_plaza' => $value->cons_plaza,
                    'qna_ini_01' => $value->qna_ini_01,
                    'qna_fin_01' => $value->qna_fin_01,
                    'qna_pago' => $value->qna_pago,
                    'num_cheque' => $value->num_cheque,
                    'perc' => $value->perc,
                    'ded' => $value->ded,
                    'neto' => $value->neto,
                    'ciclo_escolar' => $value->ciclo_escolar,
                    'created_at' => $value->created_at,

                  ];
              }

              if(!empty($arr)){
                  DB::table('nomina_federal')->insert($arr);

              }


        }




        if($nomina->save()){

          return redirect('nomina_capturada');

        }else {
        return false;
        }
      }
    }


    //convertir y descargar pdf

    public function invoice($id){
        $nomina= DB::table('nomina_capturada')->get();
      //    $directorio_regional= DB::table('tabulador_pagos')->where('ciclo','=',$id)->first();
         //$material   = AlmacenMaterial:: findOrFail($id);
        //$customPaper = array(0,0,567.00,283.80);
        $date = date('Y-m-d');
        $invoice = "2222";
       // print_r($materiales);
        $view =  \View::make('nomina.nomina_capturada.invoice', compact('date', 'invoice','nomina'))->render();
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
        $nomina_capturada = NominaCapturadaModel::find($id);
        $quincena= DB::table('tabla_pagos')->get();
        return view("nomina.nomina_capturada.edit",["nomina_capturada" => $nomina_capturada, "quincena" => $quincena]);
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
      $user = Auth::user()->name;
        $nomina = NominaCapturadaModel::findOrFail($id);
        $nomina -> qna = $request ->qna;
        $nomina -> sostenimiento = $request ->sostenimiento;
        $nomina -> estado ="ACTIVO";
        $nomina -> tipo = $request ->tipo;
        $nomina -> captura=$user;



        $sostenimiento = $nomina->sostenimiento;

        if($sostenimiento  == "ESTATAL") {

          /////////////////////////////

          $path = $request->file->getRealPath();
          $data = Excel::load($path)->get();


              foreach ($data as $key => $value) {
                  $arr[] = [
                    'bco' => $value->bco,
                    'num_cheque' => $value->num_cheque,
                    'num_empleado' => $value->num_empleado,
                    'rfc' => $value->rfc,
                    'nombre' => $value->nombre,
                    'cve' => $value->cve,
                    'plaza' => $value->plaza,
                    'contrato' => $value->contrato,
                    'cct' => $value->cct,
                    'region' => $value->region,
                    'perc' => $value->perc,
                    'ded' => $value->ded,
                    'neto' => $value->neto,
                    'qna_ini' => $value->qna_ini,
                    'qna_fin' => $value->qna_fin,
                    'qna_pago' => $value->qna_pago,
                    'ciclo_escolar' => $value->ciclo_escolar,
                    'created_at' => $value->created_at,
                  ];
              }

              if(!empty($arr)){
                  DB::table('nomina_estatal')->insert($arr);

              }
            ///////////////////////////////////////////////77
        }else{

          $path = $request->file->getRealPath();
          $data = Excel::load($path)->get();


              foreach ($data as $key => $value) {
                  $arr[] = [
                    'region' => $value->region,
                    'rfc' => $value->rfc,
                    'nom_emp' => $value->nom_emp,
                    'ent_fed' => $value->ent_fed,
                    'ct_clasif' => $value->ct_clasif,
                    'ct_id' => $value->ct_id,
                    'ct_sec' => $value->ct_sec,
                    'ct_digito_ver' => $value->ct_digito_ver,
                    'cod_pago' => $value->cod_pago,
                    'unidad' => $value->unidad,
                    'subunidad' => $value->subunidad,
                    'cat_puesto' => $value->cat_puesto,
                    'horas' => $value->horas,
                    'cons_plaza' => $value->cons_plaza,
                    'qna_ini_01' => $value->qna_ini_01,
                    'qna_fin_01' => $value->qna_fin_01,
                    'qna_pago' => $value->qna_pago,
                    'num_cheque' => $value->num_cheque,
                    'perc' => $value->perc,
                    'ded' => $value->ded,
                    'neto' => $value->neto,
                    'ciclo_escolar' => $value->ciclo_escolar,
                    'created_at' => $value->created_at,
                  ];
              }

              if(!empty($arr)){
                  DB::table('nomina_federal')->insert($arr);

              }


        }




        if($nomina->save()){

          return redirect('nomina_capturada');

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
    public function destroy(Request $request, $id )
    {
      $user = Auth::user()->name;
      $nomina=NominaCapturadaModel::findOrFail($id);
      $nomina->estado="INACTIVO";
      $nomina->captura=$user;
      $nomina->update();

      $qna =  $nomina->qna;

      $sostenimiento = $nomina->sostenimiento;

      if($sostenimiento  == "FEDERAL") {
      NominaFederalModel::where('qna_pago', $qna)->delete();

      }else{
        NominaEstatalModel::where('qna_pago', $qna)->delete();
      }
      $nomina->update();
      return redirect('nomina_capturada');
    }

    ////////////exel////////////////

    public function excel(Request $request)
    {

     Excel::create('nomina_capturada', function($excel) {
         $excel->sheet('Excel sheet', function($sheet) {

           $tabla = NominaCapturadaModel::select('qna','sostenimiento','estado','tipo','captura')
           //->where('directorio_regional')
           ->get();
             $sheet->fromArray($tabla);
             $sheet->row(1,['QUINCENA','SOSTENIMIENTO','ESTADO','TIPO','CAPTURA']);
             $sheet->setOrientation('landscape');
         });
     })->export('xls');
   }

   public function validar_nomina($qna,$sostenimiento,$tipo)
   {
    $nomina = NominaCapturadaModel::select('qna','sostenimiento','tipo','estado')
    ->where('qna',"=" ,$qna)
    ->where('sostenimiento', "=" ,$sostenimiento)
    ->where('tipo', "=" ,$tipo)
    ->where('estado', "=" ,"ACTIVO")
    ->get();
        return response()->json(
          $nomina->toArray());

   }

   public function validar_quincenaIna($qna,$sostenimiento,$tipo)
   {
    $rechazo = NominaCapturadaModel::select('qna','sostenimiento','tipo','estado')
    ->where('qna',"=" ,$qna)
    ->where('sostenimiento', "=" ,$sostenimiento)
    ->where('tipo', "=" ,$tipo)
    ->where('estado', "=" ,"INACTIVO")
    ->get();
        return response()->json(
          $rechazo->toArray());

   }

}
