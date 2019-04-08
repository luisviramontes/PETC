<?php

namespace petc\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use petc\Http\Requests;

use petc\Http\Controllers\Controller;
use petc\CentroTrabajoModel;
use petc\DatosCentroTrabajoModel; 

use DB;
use Maatwebsite\Excel\Facades\Excel;
use PHPExcel_Worksheet_Drawing;
use Validator; 
use \Milon\Barcode\DNS1D;
use \Milon\Barcode\DNS2D;
use petc\Http\Requests\CentroTrabajoRequest;

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
         ->join('region', 'centro_trabajo.id_region', '=','region.id')
         ->join('localidades', 'centro_trabajo.id_localidades', '=','localidades.id')
         ->join('municipios', 'centro_trabajo.id_municipios', '=','municipios.id') 
         ->select('centro_trabajo.*','region.region','region.sostenimiento','localidades.*','municipios.*','datos_centro_trabajo.total_alumnos','datos_centro_trabajo.total_ninas','datos_centro_trabajo.total_ninos', 
            'datos_centro_trabajo.total_grupos', 'datos_centro_trabajo.total_grados','datos_centro_trabajo.total_directores', 
            'datos_centro_trabajo.total_docentes', 'datos_centro_trabajo.total_fisica','datos_centro_trabajo.total_usaer','datos_centro_trabajo.total_artistica','datos_centro_trabajo.total_intendentes', 
            'datos_centro_trabajo.fecha_ingreso', 'datos_centro_trabajo.fecha_baja','datos_centro_trabajo.captura')->where('nombre_escuela','LIKE','%'.$query.'%')->orwhere('cct','LIKE','%'.$query.'%')->orwhere('localidades.nom_loc','LIKE','%'.$query.'%')->orwhere('municipios.municipio','LIKE','%'.$query.'%')->where('centro_trabajo.estado','=','ACTIVO')->paginate(10);
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
        $region=DB::table('region')->get();
        $localidades=DB::table('localidades')->where('estado','=','ACTIVO')->get();
        $municipios=DB::table('municipios')->where('estado','=','ACTIVO')->get();
        $ciclos=DB::table('ciclo_escolar')->get();
        return view('nomina.centro_trabajo.create', ['ciclos'=> $ciclos,'localidades'=>$localidades,'municipios'=>$municipios,'region'=>$region]);
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CentroTrabajoRequest $formulario)
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
            $datos= new CentroTrabajoModel;
            $datos2= new DatosCentroTrabajoModel;
            $datos->cct=$formulario->get('cct');
            $datos->nombre_escuela=$formulario->get('nombre');
            $datos->domicilio=$formulario->get('domicilio');
            $datos->id_localidades=$formulario->get('localidad');
            $datos->id_municipios=$formulario->get('municipio');
            $datos->id_region=$formulario->get('region');
            $datos->captura="ADMINISTRADOR";
            $datos->telefono=$formulario->get('telefono');
            $datos->email=$formulario->get('email');
            $datos->ciclo_escolar=$formulario->get('ciclo');
            $datos->entrego_carta=$formulario->get('carta_compromiso');
            $datos->alimentacion=$formulario->get('alimentacion');
            $datos->estado="ACTIVO";
            $datos->save();

            $ultimo = CentroTrabajoModel::orderby('created_at','DESC')->first()->id;
            $datos2->total_alumnos=$formulario->get('alumnos');
            $datos2->total_ninas=$formulario->get('ninas');
            $datos2->total_ninos=$formulario->get('ninos');
            $datos2->total_grupos=$formulario->get('grupos');
            $datos2->total_grados=$formulario->get('grados');
            $datos2->total_directores=$formulario->get('director');
            $datos2->total_docentes=$formulario->get('docente');
            $datos2->total_fisica=$formulario->get('e_fisica');
            $datos2->total_usaer=$formulario->get('usaer');
            $datos2->total_artistica=$formulario->get('artistica');
            $datos2->total_intendentes=$formulario->get('intendente');
            $datos2->id_centro_trabajo=$ultimo;
            $datos2->fecha_ingreso=$formulario->get('ingreso');
            $datos2->captura="ADMINISTRADOR";
            $datos2->save();
            return Redirect::to('centro_trabajo');
}       //
}}

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
        $region=DB::table('region')->get();
        $localidades=DB::table('localidades')->where('estado','=','ACTIVO')->get();
        $municipios=DB::table('municipios')->where('estado','=','ACTIVO')->get();
        $ciclos=DB::table('ciclo_escolar')->get();
       // $centros=CentroTrabajoModel::findOrFail($id);
        $centros = DB::table('centro_trabajo')
        ->join('datos_centro_trabajo', 'centro_trabajo.id', '=','datos_centro_trabajo.id_centro_trabajo')
        ->join('region', 'centro_trabajo.id_region', '=','region.id')
        ->join('localidades', 'centro_trabajo.id_localidades', '=','localidades.id')
        ->join('municipios', 'centro_trabajo.id_municipios', '=','municipios.id') 
        ->select('centro_trabajo.*','region.region','region.sostenimiento','localidades.*','municipios.*','datos_centro_trabajo.id as id_datos_centro','datos_centro_trabajo.total_alumnos','datos_centro_trabajo.total_ninas','datos_centro_trabajo.total_ninos', 
            'datos_centro_trabajo.total_grupos', 'datos_centro_trabajo.total_grados','datos_centro_trabajo.total_directores', 
            'datos_centro_trabajo.total_docentes', 'datos_centro_trabajo.total_fisica','datos_centro_trabajo.total_usaer','datos_centro_trabajo.total_artistica','datos_centro_trabajo.total_intendentes', 
            'datos_centro_trabajo.fecha_ingreso', 'datos_centro_trabajo.fecha_baja','datos_centro_trabajo.captura')->where('centro_trabajo.id','=',$id)->first();

        return view('nomina.centro_trabajo.edit', ['ciclos'=> $ciclos,'localidades'=>$localidades,'municipios'=>$municipios,'centros'=>$centros,'region'=>$region]);
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
        $datos=CentroTrabajoModel::findOrFail($id);

        $datos->cct=$request->get('cct');
        $datos->nombre_escuela=$request->get('nombre');
        $datos->domicilio=$request->get('domicilio');
        $datos->id_localidades=$request->get('localidad');
        $datos->id_municipios=$request->get('municipio');
        $datos->id_region=$request->get('region');
        $datos->captura="ADMINISTRADOR";
        $datos->telefono=$request->get('telefono');
        $datos->email=$request->get('email');
        $datos->ciclo_escolar=$request->get('ciclo');
        $datos->entrego_carta=$request->get('carta_compromiso');
        $datos->alimentacion=$request->get('alimentacion');
        $datos->estado="ACTIVO";
        $datos->update();

        $id_datos=DB::table('datos_centro_trabajo')->where('id_centro_trabajo','=',$id)->first();
        $datos2=DatosCentroTrabajoModel::findOrFail($id_datos->id);
        $datos2->total_alumnos=$request->get('alumnos');
        $datos2->total_ninas=$request->get('ninas');
        $datos2->total_ninos=$request->get('ninos');
        $datos2->total_grupos=$request->get('grupos');
        $datos2->total_grados=$request->get('grados');
        $datos2->total_directores=$request->get('director');
        $datos2->total_docentes=$request->get('docente');
        $datos2->total_fisica=$request->get('e_fisica');
        $datos2->total_usaer=$request->get('usaer');
        $datos2->total_artistica=$request->get('artistica');
        $datos2->total_intendentes=$request->get('intendente');
        $datos2->id_centro_trabajo=$id;
        $datos2->fecha_ingreso=$request->get('ingreso');
        $datos2->captura="ADMINISTRADOR";
        $datos2->update();
        return Redirect::to('centro_trabajo');
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
