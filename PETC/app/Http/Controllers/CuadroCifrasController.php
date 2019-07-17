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
     if($tipo_usuario <> "2" || $tipo_usuario=="5"){
       return view('permisos');

   }else{
      if($request)
      {
       // $aux=$request->get('searchText');
      
       $query2=trim($request->GET('ciclo_escolar'));
       $ciclos=DB::table('ciclo_escolar')->get();

       $cuadro=DB::table('cuadros_cifra')->join('ciclo_escolar','ciclo_escolar.id','=','cuadros_cifra.id_ciclo')->join('tabla_pagos','tabla_pagos.id','=','cuadros_cifra.id_qna')->select('cuadros_cifra.*','ciclo_escolar.ciclo','tabla_pagos.dias','tabla_pagos.qna','pago_director','pago_docente','pago_intendente')->where('cuadros_cifra.id_ciclo','=',$query2)->get();

         return view('nomina.cuadros_cifras.index',["ciclos"=>$ciclos,"cuadro" => $cuadro,"ciclo_escolar"=>$query2]);
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
}
