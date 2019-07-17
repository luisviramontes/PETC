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
use petc\CapturaModel;
use petc\TablaPagosModel;
use petc\CuadrosCifraModel;
use petc\PagosImprocedentesModel;
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
      $tipo_usuario = Auth::user()->tipo_usuario;
      if($tipo_usuario <> "2" || $tipo_usuario=="5"){
       return view('permisos');

     }else{
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
      $ciclos=DB::table('ciclo_escolar')->get();
      $quincena= DB::table('tabla_pagos')->get();
      return view("nomina.nomina_capturada.create",["quincena"=>$quincena,"ciclos"=>$ciclos]);

    }}



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(NominaCapturadaRequest $formulario)
    {

      $tipo_usuario = Auth::user()->tipo_usuario;
      if($tipo_usuario <> "2" || $tipo_usuario=="5"){
       return view('permisos');

     }else{

       $total_director_est=0;
       $total_docente_est=0;
       $total_intendente_est=0;
       $total_dedu_director_est=0;
       $total_dedu_docente_est=0;
       $total_dedu_intendente_est=0;
       $total_liqui_director_est=0;
       $total_liqui_docente_est=0;
       $total_liqui_intendente_est=0;
       $total_perce_director_est=0;
       $total_perce_docente_est=0;
       $total_perce_intendente_est=0;

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

        $id_ciclo=$formulario->get('ciclo_escolar');






        $qna=$formulario->get('qna');
        $id_qna=DB::table('tabla_pagos')->where('qna','=',$qna)->first()->id;






        $sostenimiento = $nomina->sostenimiento;
        if($sostenimiento  == "ESTATAL") {

          /////////////////////////////

          $path = $formulario->file->getRealPath();
          $data = Excel::load($path)->get();

          $id_captura= DB::table('captura')->where('sostenimiento','=','ESTATAL')->where('qna_actual','=',"1")->get();
          $cuenta_captura=count($id_captura);

          for ($i=0; $i < $cuenta_captura ; $i++) { 
           $captura=CapturaModel::findOrFail($id_captura[$i]->id);
           $captura->qna_actual=0;
           $captura->update();
                   # code...
         }




         foreach ($data as $key => $value) {        
          $est= new NominaEstatalModel;
          $est->bco = $value->bco;
          $$est->num_cheque = $value->num_cheque;
          $estnum_empleado = $value->num_empleado;
          $est->rfc = $value->rfc;
          $est->nombre = $value->nombre;
          $est->cve = $value->cve;
          $est->plaza = $value->plaza;
          $est->contrato = $value->contrato;
          $est->cct = $value->cct;
          $est->region = $value->region;
          $est->perc = $value->perc;
          $est->ded = $value->ded;
          $est->neto = $value->neto;
          $est->qna_ini = $value->qna_ini;
          $est->qna_fin = $value->qna_fin;
          $est->qna_pago = $value->qna_pago;
          $est->ciclo_escolar = $value->ciclo_escolar;
          $est->captura = $user;
          $est->save();
          
          $id_captura= DB::table('captura')->where('rfc','=',$value->rfc)->first();
          if ($id_captura == null) {
           $letra=substr($value->cat_puesto,0,1);
           if ($letra == "S") {
            $total_intendente_fed= $total_intendente_fed+1;
            $total_dedu_intendente_fed=$total_dedu_intendente_fed + $value->ded;
            $total_liqui_docente_fed=$total_liqui_docente_fed + $value->neto;
            $total_perce_intendente_fed=$total_perce_intendente_fed + $value->perc;
        # code...
          }else{
            $total_docente_fed= $total_docente_fed+1;
            $total_dedu_docente_fed=$total_dedu_docente_fed + $value->ded;
            $total_liqui_docente_fed=$total_liqui_docente_fed + $value->neto;
            $total_perce_docente_fed=$total_perce_docente_fed + $value->perc;

          }
          $improcedente= new PagosImprocedentesModel;
          $improcedente->region=$value->region;
          $improcedente->nom_emp=$value->nom_emp;
          $improcedente->rfc=$value->rfc;
          $improcedente->qna_ini= $value->qna_ini_01;
          $improcedente->qna_fin=$value->qna_fin_01;
          $improcedente->qna_pago=$value->qna_pago;
          $improcedente->num_cheque=$value->num_cheque;
          $improcedente->perc= $value->perc;
          $improcedente->ded=$value->ded;
          $improcedente->neto= $value->neto;
          $improcedente->id_ciclo=$id_ciclo;
          $improcedente->captura=$user;
          $improcedente->save();
            # code...
        }else{
         $captura=CapturaModel::findOrFail($id_captura->id);
         $captura->pagos_registrados=1;
         $captura->qna_actual=1;
         $captura->update();

         if($id_captura->categoria == "DIRECTOR"){
           $total_director_est= $total_director_est+1;
           $total_dedu_director_est=  $total_dedu_director_est + $value->ded;
           $total_liqui_director_est=$total_liqui_director_est + $value->neto;
           $total_perce_director_est=$total_perce_director_est + $value->perc;

         }elseif ($id_captura->categoria == "DOCENTE" || $id_captura->categoria == "USAER"  || $id_captura->categoria == "EDUCACION FISICA") {
           $total_docente_est= $total_docente_est+1;
           $total_dedu_docente_est=$total_dedu_docente_est + $value->ded;
           $total_liqui_docente_est=$total_liqui_docente_est + $value->neto;
           $total_perce_docente_est=$total_perce_docente_est + $value->perc;
           # code...
         }elseif ($id_captura->categoria == "INTENDENTE") {
           # code...
          $total_intendente_est= $total_intendente_est+1;
          $total_dedu_intendente_est=$total_dedu_intendente_est + $value->ded;
          $total_liqui_intendente_est=$total_liqui_intendente_est + $value->neto;
          $total_perce_intendente_est=$total_perce_intendente_est + $value->perc;
           # code...
        }
      }
    }
    $tabla= new CuadrosCifraModel;
    $tabla->id_qna=$id_qna;
    $tabla->sostenimiento= "ESTATAL";
    $tabla->categoria="DIRECTOR";
    $tabla->total_reclamos=$total_director_est;
    $tabla->total_deducciones=$total_dedu_director_est;
    $tabla->total_liquido=$total_liqui_director_est;
    $tabla->total_percepciones=$total_perce_director_est;
    $tabla->id_ciclo=$id_ciclo;
    $tabla->captura=$user;
    $tabla->save();
    $tabla2= new CuadrosCifraModel;
    $tabla2->id_qna=$id_qna;
    $tabla2->sostenimiento= "ESTATAL";
    $tabla2->categoria="DOCENTE";
    $tabla2->total_reclamos=$total_docente_est;
    $tabla2->total_deducciones=$total_dedu_docente_est;
    $tabla2->total_liquido=$total_liqui_docente_est;
    $tabla2->total_percepciones=$total_perce_docente_est;
    $tabla2->id_ciclo=$id_ciclo;
    $tabla2->captura=$user;
    $tabla2->save();
    $tabla3= new CuadrosCifraModel;
    $tabla3->id_qna=$id_qna;
    $tabla3->sostenimiento= "ESTATAL";
    $tabla3->categoria="INTENDENTE";
    $tabla3->total_reclamos=$total_intendente_est;
    $tabla3->total_deducciones=$total_dedu_intendente_est;
    $tabla3->total_liquido=$total_liqui_intendente_est;
    $tabla3->total_percepciones=$total_perce_intendente_est;
    $tabla3->id_ciclo=$id_ciclo;
    $tabla3->captura=$user;
    $tabla3->save();


            ///////////////////////////////////////////////77
  }else{
       $total_director_fed=0;
       $total_dedu_director_fed=0;
       $total_liqui_director_fed=0;
       $total_perce_director_fed=0;

       $total_docente_fed=0;
       $total_dedu_docente_fed=0;
       $total_liqui_docente_fed=0;
       $total_perce_docente_fed=0;


       $total_intendente_fed= 0;               
       $total_dedu_intendente_fed=0;            
       $total_liqui_intendente_fed=0;
       $total_perce_intendente_fed=0;

  //\Excel::filter('chunk')->load($formulario->file)->chunk(250, function($results){

    $path = $formulario->file->getRealPath();
    $data = Excel::load($path)->get();

    $id_captura= DB::table('captura')->where('sostenimiento','=','FEDERAL')->where('qna_actual','=',"1")->get();
    $cuenta_captura=count($id_captura);

    for ($i=0; $i < $cuenta_captura ; $i++) { 
     $captura=CapturaModel::findOrFail($id_captura[$i]->id);
     $captura->qna_actual=0;
     $captura->update();
                   # code...
   }

   foreach ($data as $key => $value) {

    $fed = new NominaFederalModel;
    $fed->region = $value->region;
    $fed->rfc = $value->rfc;
    $fed->nom_emp = $value->nom_emp;
    $fed->ent_fed = $value->ent_fed;
    $fed->ct_clasif = $value->ct_clasif;
    $fed->ct_id = $value->ct_id;
    $fed->ct_sec = $value->ct_sec;
    $fed->ct_digito_ver = $value->ct_digito_ver;
    $fed->cod_pago = $value->cod_pago;
    $fed->unidad = $value->unidad;
    $fed->subunidad = $value->subunidad;
    $fed->cat_puesto = $value->cat_puesto;
    $fed->horas = $value->horas;
    $fed->cons_plaza = $value->cons_plaza;
    $fed->qna_ini_01 = $value->qna_ini_01;
    $fed->qna_fin_01 = $value->qna_fin_01;
    $fed->qna_pago = $value->qna_pago;
    $fed->num_cheque = $value->num_cheque;
    $fed->perc = $value->perc;
    $fed->ded = $value->ded;
    $fed->neto = $value->neto;
    $fed->ciclo_escolar = $value->ciclo_escolar;
    $fed->captura = $user;
    $fed->save();

    $id_captura= DB::table('captura')->where('rfc','=',$value->rfc)->first();

    if ($id_captura == null) {
      $letra=substr($value->cat_puesto,0,1);
      if ($letra == "S") {
        $total_intendente_fed= $total_intendente_fed+1;
        $total_dedu_intendente_fed=$total_dedu_intendente_fed + $value->ded;
        $total_liqui_docente_fed=$total_liqui_docente_fed + $value->neto;
        $total_perce_intendente_fed=$total_perce_intendente_fed + $value->perc;
        # code...
      }else{
        $total_docente_fed= $total_docente_fed+1;
        $total_dedu_docente_fed=$total_dedu_docente_fed + $value->ded;
        $total_liqui_docente_fed=$total_liqui_docente_fed + $value->neto;
        $total_perce_docente_fed=$total_perce_docente_fed + $value->perc;

      }
      $improcedente= new PagosImprocedentesModel;
      $improcedente->region=$value->region;
      $improcedente->nom_emp=$value->nom_emp;
      $improcedente->rfc=$value->rfc;
      $improcedente->qna_ini= $value->qna_ini_01;
      $improcedente->qna_fin=$value->qna_fin_01;
      $improcedente->qna_pago=$value->qna_pago;
      $improcedente->num_cheque=$value->num_cheque;
      $improcedente->perc= $value->perc;
      $improcedente->ded=$value->ded;
      $improcedente->neto= $value->neto;
      $improcedente->id_ciclo=$id_ciclo;
      $improcedente->captura=$user;
      $improcedente->save();

            # code...
    }else{
     $captura=CapturaModel::findOrFail($id_captura->id);
     $captura->pagos_registrados=1;
     $captura->qna_actual=1;
     $captura->update();

     if($id_captura->categoria == "DIRECTOR"){
       $total_director_fed= $total_director_fed+1;
       $total_dedu_director_fed=  $total_dedu_director_fed + $value->ded;
       $total_liqui_director_fed=$total_liqui_director_fed + $value->neto;
       $total_perce_director_fed=$total_perce_director_fed + $value->perc;

     }elseif ($id_captura->categoria == "DOCENTE" || $id_captura->categoria == "USAER"  || $id_captura->categoria == "EDUCACION FISICA") {
       $total_docente_fed= $total_docente_fed+1;
       $total_dedu_docente_fed=$total_dedu_docente_fed + $value->ded;
       $total_liqui_docente_fed=$total_liqui_docente_fed + $value->neto;
       $total_perce_docente_fed=$total_perce_docente_fed + $value->perc;
           # code...
     }elseif ($id_captura->categoria == "INTENDENTE") {
           # code...
      $total_intendente_fed= $total_intendente_fed+1;
      $total_dedu_intendente_fed=$total_dedu_intendente_fed + $value->ded;
      $total_liqui_intendente_fed=$total_liqui_intendente_fed + $value->neto;
      $total_perce_intendente_fed=$total_perce_intendente_fed + $value->perc;
           # code...
    }
  }



}
$tabla4= new CuadrosCifraModel;
$tabla4->id_qna=$id_qna;
$tabla4->sostenimiento= "FEDERAL";
$tabla4->categoria="DIRECTOR";
$tabla4->total_reclamos=$total_director_fed;
$tabla4->total_deducciones=$total_dedu_director_fed;
$tabla4->total_liquido=$total_liqui_director_fed;
$tabla4->total_percepciones=$total_perce_director_fed;
$tabla4->id_ciclo=$id_ciclo;
$tabla4->captura=$user;
$tabla4->save();
$tabla5= new CuadrosCifraModel;
$tabla5->id_qna=$id_qna;
$tabla5->sostenimiento= "FEDERAL";
$tabla5->categoria="DOCENTE";
$tabla5->total_reclamos=$total_docente_fed;
$tabla5->total_deducciones=$total_dedu_docente_fed;
$tabla5->total_liquido=$total_liqui_docente_fed;
$tabla5->total_percepciones=$total_perce_docente_fed;
$tabla5->id_ciclo=$id_ciclo;
$tabla5->captura=$user;
$tabla5->save();
$tabla6= new CuadrosCifraModel;
$tabla6->id_qna=$id_qna;
$tabla6->sostenimiento= "FEDERAL";
$tabla6->categoria="INTENDENTE";
$tabla6->total_reclamos=$total_intendente_fed;
$tabla6->total_deducciones=$total_dedu_intendente_fed;
$tabla6->total_liquido=$total_liqui_docente_fed;
$tabla6->total_percepciones=$total_perce_intendente_fed;
$tabla6->id_ciclo=$id_ciclo;
$tabla6->captura=$user;
$tabla6->save();




}





if($nomina->save()){


  return redirect('nomina_capturada');

}else {
  return false;
}
}
}}


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
      $tipo_usuario = Auth::user()->tipo_usuario;
      if($tipo_usuario <> "2" || $tipo_usuario=="5"){
       return view('permisos');

     }else{
      $nomina_capturada = NominaCapturadaModel::find($id);
      $quincena= DB::table('tabla_pagos')->get();
      return view("nomina.nomina_capturada.edit",["nomina_capturada" => $nomina_capturada, "quincena" => $quincena]);
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
    }}




    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id )
    {
      $tipo_usuario = Auth::user()->tipo_usuario;
      if($tipo_usuario <> "2" || $tipo_usuario=="5"){
       return view('permisos');

     }else{
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
    }}
    

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

  public function buscar_qnas_pagos($ciclo){
    $tabla = TablaPagosModel::select('id','qna')
    ->where('id_ciclo',"=" ,$ciclo)
    ->get();
    return response()->json(
      $tabla->toArray());
  }

}
