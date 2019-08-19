<?php

namespace petc\Http\Controllers;

use Illuminate\Http\Request;

use petc\Http\Requests;
use petc\Http\Controllers\Controller;
use petc\Director_CCTModel;

use DB;
use Maatwebsite\Excel\Facades\Excel;
use PHPExcel_Worksheet_Drawing;
use Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Collection as Collection;
class DirectorCentroController extends Controller
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
    public function index(request $request)
    {
        $tipo_usuario = Auth::user()->tipo_usuario;
      if($tipo_usuario <> "2" || $tipo_usuario=="5"){
       return view('permisos');

      }else{

       if($request)
       {
       // $aux=$request->get('searchText');
          $query=trim($request->GET('searchText'));
          $ciclos=DB::table('ciclo_escolar')->get();
          $query2=trim($request->GET('ciclo_escolar'));

          $personal= DB::table('director_cct')
          ->join('captura','captura.id','=','director_cct.id_captura')
          ->join('cat_puesto','cat_puesto.id','=','captura.clave')
          ->join('centro_trabajo', 'centro_trabajo.id', '=','captura.id_cct_etc')

          ->select('centro_trabajo.id_region','centro_trabajo.id_localidades','centro_trabajo.id_municipios')
          ->join('region', 'region.id', '=','centro_trabajo.id_region')
          ->join('localidades', 'localidades.id', '=','centro_trabajo.id_localidades')
          ->join('municipios', 'municipios.id', '=','centro_trabajo.id_municipios')
          ->join('ciclo_escolar', 'ciclo_escolar.id', '=','captura.id_ciclo')

          ->select('captura.*',
          'cat_puesto.cat_puesto',
          'centro_trabajo.cct',
          'centro_trabajo.nombre_escuela',
          'ciclo_escolar.ciclo',
          'region.region',
          'municipios.municipio',
          'localidades.nom_loc')

          ->where('captura.categoria','=','DIRECTOR')
          ->where('ciclo_escolar','=',$query2)
          ->where('captura.nombre','LIKE','%'.$query.'%')
          ->orwhere('captura.rfc','LIKE','%'.$query.'%')
          ->orwhere('centro_trabajo.nombre_escuela','LIKE','%'.$query.'%')
          ->orwhere('centro_trabajo.cct','LIKE','%'.$query.'%')
          ->paginate(40);

          return view('nomina.director_centro.index',["personal"=>$personal,"searchText"=>$query,"ciclo_escolar"=>$query2,"ciclos"=>$ciclos]);
        // return view('nomina.tabla_pagos.index',['tabla_pagos' => $tabla_pagos,'ciclos'=> $ciclos]);
        //
      }}}
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

    public function invoice()
    {
        $personal= DB::table('director_cct')->join('captura','captura.id','=','director_cct.id_captura')->join('centro_trabajo', 'centro_trabajo.id', '=','captura.id_cct_etc')->select('centro_trabajo.id_region','centro_trabajo.id_localidades','centro_trabajo.id_municipios')->join('region', 'region.id', '=','centro_trabajo.id_region')->join('ciclo_escolar', 'ciclo_escolar.id', '=','captura.id_ciclo')->select('captura.*','centro_trabajo.cct','centro_trabajo.nombre_escuela','ciclo_escolar.ciclo','region.region')->where('captura.estado','=','ACTIVO')->where('captura.categoria','=','DIRECTOR')->orderby('region.region','desc')->get();

        //print_r($);
        $view =  \View::make('nomina.director_centro.invoice', compact('personal'))->render();
        //->setPaper($customPaper, 'landscape');
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        return $pdf->stream('invoice');

        //
    }

        public function excel(Request $request)
    {

     Excel::create('DIRECTORES-CTE', function($excel) {
         $excel->sheet('Excel sheet', function($sheet) {
                 //otra opción -> $products = Product::select('name')->get();

              $tabla= Director_CCTModel::join('captura','captura.id','=','director_cct.id_captura')->join('centro_trabajo', 'centro_trabajo.id', '=','captura.id_cct_etc')->join('region', 'region.id', '=','centro_trabajo.id_region')->join('ciclo_escolar', 'ciclo_escolar.id', '=','captura.id_ciclo')->select('captura.nombre','captura.rfc','centro_trabajo.cct','centro_trabajo.nombre_escuela','ciclo_escolar.ciclo','region.region','region.sostenimiento')->where('captura.estado','=','ACTIVO')->where('captura.categoria','=','DIRECTOR')->orderby('region.region','desc')->get();

             $sheet->fromArray($tabla);
             $sheet->row(1,['NOMBRE','RFC','CCT','NOMBRE_ESCUELA','CICLO ESCOLAR','REGION','SOSTENIMIENTO']);
             $sheet->setOrientation('landscape');
         });
     })->export('xls');
 }


}
