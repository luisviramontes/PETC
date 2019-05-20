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

class CicloEscolarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

      if($request)
      {
       $query=trim($request->GET('searchText'));
       $ciclos = DB::table('ciclo_escolar')
       ->where('ciclo','LIKE','%'.$query.'%')
       ->paginate(24);
      }

        return view('nomina.ciclo_escolar.index',["ciclos"=>$ciclos,"searchText"=>$query]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
          return view("nomina.ciclo_escolar.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CicloEscolarRequest $formulario)
    {

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


}

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
      $ciclos = CicloEscolarModel::find($id);
      return view("nomina.ciclo_escolar.edit",["ciclos"=>$ciclos]);
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
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

      $ciclo=CicloEscolarModel::findOrFail($id);
      $ciclo->estado="INACTIVO";
      $ciclo->capturo="ADMINISTRADOR";
      $ciclo->update();
        return redirect('ciclo_escolar');
    }


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
