<?php

namespace petc\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use petc\Http\Requests;

use petc\Http\Controllers\Controller;
use petc\CentroTrabajoModel;

use DB;
use Maatwebsite\Excel\Facades\Excel;
use PHPExcel_Worksheet_Drawing;
use Validator; 
use \Milon\Barcode\DNS1D;
use \Milon\Barcode\DNS2D;

class CentroTrabajoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(request $request)
    {  
        if($request)
        {
         $query=trim($request->GET('searchText'));
         $centro = DB::table('centro_trabajo')
         ->join('datos_centro_trabajo', 'centro_trabajo.id', '=','datos_centro_trabajo.id_centro_trabajo') 
         ->select('centro_trabajo.id as id','centro_trabajo.nombre_escuela','centro_trabajo.cct',
            'centro_trabajo.domicilio','centro_trabajo.localidad','centro_trabajo.municipio', 
            'centro_trabajo.region', 
            'centro_trabajo.sostenimiento', 'centro_trabajo.captura','centro_trabajo.telefono', 
            'centro_trabajo.email', 'centro_trabajo.ciclo_escolar','centro_trabajo.entrego_carta','centro_trabajo.alimentacion','centro_trabajo.updated_at','datos_centro_trabajo.total_alumnos','datos_centro_trabajo.total_ninas','datos_centro_trabajo.total_ninos', 
            'datos_centro_trabajo.total_grupos', 'datos_centro_trabajo.total_grados','datos_centro_trabajo.total_directores', 
            'datos_centro_trabajo.total_docentes', 'datos_centro_trabajo.total_fisica','datos_centro_trabajo.total_usaer','datos_centro_trabajo.total_artistica','datos_centro_trabajo.total_intendentes', 
            'datos_centro_trabajo.fecha_ingreso', 'datos_centro_trabajo.fecha_baja','datos_centro_trabajo.captura')->where('nombre_escuela','LIKE','%'.$query.'%')->orwhere('cct','LIKE','%'.$query.'%')->orwhere('localidad','LIKE','%'.$query.'%')->orwhere('municipio','LIKE','%'.$query.'%')->where('centro_trabajo.estado','=','ACTIVO')->paginate(10);
         return view('nomina.centro_trabajo.index',["centro"=>$centro,"searchText"=>$query]);
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
