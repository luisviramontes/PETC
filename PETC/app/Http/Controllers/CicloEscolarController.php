<?php

namespace petc\Http\Controllers;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use petc\Http\Requests;
use petc\Http\Controllers\Controller;

use petc\CicloEscolarModel;

use DB;

use Maatwebsite\Excel\Facades\Excel;
use PHPExcel_Worksheet_Drawing;
use Validator;
use \Milon\Barcode\DNS1D;
use \Milon\Barcode\DNS2D;
use petc\Http\Requests\CicloEscolarRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Collection as Collection;
class CicloEscolarController extends Controller
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
      if($tipo_usuario <> "1" && $tipo_usuario <> "2"  && $tipo_usuario <> "3" && $tipo_usuario <> "4" &&    $tipo_usuario <> "5" && $tipo_usuario <> "6"){
       return view('permisos');

      }else{

      if($request)
      {
       $query=trim($request->GET('searchText'));
       $ciclos = DB::table('ciclo_escolar')
       ->where('ciclo','LIKE','%'.$query.'%')
       ->paginate(24);
      }

        return view('nomina.ciclo_escolar.index',["ciclos"=>$ciclos,"searchText"=>$query]);
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
          return view("nomina.ciclo_escolar.create");
    }}

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CicloEscolarRequest $formulario)
    {
              $tipo_usuario = Auth::user()->tipo_usuario;
      if($tipo_usuario <> "2" || $tipo_usuario=="5"){
       return view('permisos');

      }else{
$user = Auth::user()->name;
        $validator = Validator::make(
        $formulario->all(),
        $formulario->rules(),
        $formulario->messages());

        if ($formulario->ajax()){
          return response()->json(["valid" => true], 200);
        }
        else{
          $ciclo= new CicloEscolarModel;
          $ciclo -> ciclo = $formulario ->ciclo;
          $ciclo -> dias_habiles = $formulario ->dias_habiles;
          $ciclo -> inicio_ciclo = $formulario ->inicio_ciclo;
          $ciclo -> fin_ciclo = $formulario ->fin_ciclo;
          $ciclo -> estado = "ACTIVO";
          $ciclo -> capturo="ADMINISTRDOR";

          if($ciclo->save()){

            return redirect('/ciclo_escolar');

          }else {
          return view('ciclo_escolar.index');
          }
        }


}}

      //convertir y descargar pdf

      public function invoice($id){
          $ciclos= DB::table('ciclo_escolar')->get();
        //    $directorio_regional= DB::table('tabulador_pagos')->where('ciclo','=',$id)->first();
           //$material   = AlmacenMaterial:: findOrFail($id);
          //$customPaper = array(0,0,567.00,283.80);
          $date = date('Y-m-d');
          $invoice = "2222";
         // print_r($materiales);
          $view =  \View::make('nomina.ciclo_escolar.invoice', compact('date', 'invoice','ciclos'))->render();
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
      $ciclos = CicloEscolarModel::find($id);
      return view("nomina.ciclo_escolar.edit",["ciclos"=>$ciclos]);
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
      $ciclos = CicloEscolarModel::find($id);
      //asignamos nuevos valores
      $ciclos -> ciclo = $request ->ciclo;
      $ciclos -> dias_habiles = $request ->dias_habiles;
      $ciclos -> inicio_ciclo = $request ->inicio_ciclo;
      $ciclos -> fin_ciclo = $request ->fin_ciclo;
      $ciclos -> estado = "ACTIVO";
      $ciclos -> capturo="ADMINISTRDOR";
      //guardar
      if($ciclos->save()){

        return redirect('/ciclo_escolar');

      }else {
      return view('ciclo_escolar.index');
      }
    }}

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
      $user = Auth::user()->name;

      $ciclo=CicloEscolarModel::findOrFail($id);
      $ciclo->estado="INACTIVO";
      $ciclo->capturo=$user;
      $ciclo->update();
        return redirect('ciclo_escolar');
    }}


    ////////////exel////////////////

    public function excel(Request $request)
    {

     Excel::create('ciclo_escolar', function($excel) {
         $excel->sheet('Excel sheet', function($sheet) {
                 //otra opción -> $products = Product::select('name')->get();
             $tabla = CicloEscolarModel::select('ciclo','dias_habiles','inicio_ciclo','fin_ciclo')
             //->where('directorio_regional')
             ->get();
             $sheet->fromArray($tabla);
             $sheet->row(1,['CICLO','DIAS HABLIES','INICIO CICLO','FIN CICLO']);
             $sheet->setOrientation('landscape');
         });
     })->export('xls');
 }


}
