<?php

namespace petc\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use petc\Http\Requests;

use petc\Http\Controllers\Controller;
use petc\CentroTrabajoModel;

use Dompdf\Dompdf;
use DB;
use Maatwebsite\Excel\Facades\Excel;
use PHPExcel_Worksheet_Drawing;
use Validator;
use \Milon\Barcode\DNS1D;
use \Milon\Barcode\DNS2D;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Collection as Collection;

class UbicaEscuelaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    { 
        $municipios=DB::table('municipios')->get();
        $query=trim($request->GET('localidad'));
        $query2=trim($request->GET('municipio'));

        $centros =CentroTrabajoModel::join('datos_centro_trabajo', 'centro_trabajo.id', '=','datos_centro_trabajo.id_centro_trabajo')
        ->join('region', 'centro_trabajo.id_region', '=','region.id')
        ->join('localidades', 'centro_trabajo.id_localidades', '=','localidades.id')
        ->join('municipios', 'centro_trabajo.id_municipios', '=','municipios.id')
        ->select('centro_trabajo.*','region.region','region.sostenimiento','localidades.nom_loc','municipios.municipio','datos_centro_trabajo.total_alumnos','datos_centro_trabajo.total_ninas','datos_centro_trabajo.total_ninos',
         'datos_centro_trabajo.total_grupos', 'datos_centro_trabajo.total_grados','datos_centro_trabajo.total_directores',
         'datos_centro_trabajo.total_docentes', 'datos_centro_trabajo.total_fisica','datos_centro_trabajo.total_usaer','datos_centro_trabajo.total_artistica','datos_centro_trabajo.total_intendentes',
         'datos_centro_trabajo.fecha_ingreso', 'datos_centro_trabajo.fecha_baja','datos_centro_trabajo.captura')->where('centro_trabajo.id_localidades','=',$query)->get();
$cuenta=count($centros);

        return view('nomina.centro_trabajo.busca_escuela',["municipios"=>$municipios,"localidad"=>$query,"centros"=>$centros,"municipio"=>$query2,'cuenta'=>$cuenta]);

        //
    }

    public function traer_localidad($mun){
       $localidades=DB::table('localidades')
       ->where('localidades.id_municipio','=',$mun)
       ->get();

       return $localidades
       ;

   }

   public function buscar_esc_loc($mun){
       $centros =CentroTrabajoModel::join('datos_centro_trabajo', 'centro_trabajo.id', '=','datos_centro_trabajo.id_centro_trabajo')
       ->join('region', 'centro_trabajo.id_region', '=','region.id')
       ->join('localidades', 'centro_trabajo.id_localidades', '=','localidades.id')
       ->join('municipios', 'centro_trabajo.id_municipios', '=','municipios.id')
       ->select('centro_trabajo.*','region.region','region.sostenimiento','localidades.nom_loc','municipios.municipio','datos_centro_trabajo.total_alumnos','datos_centro_trabajo.total_ninas','datos_centro_trabajo.total_ninos',
         'datos_centro_trabajo.total_grupos', 'datos_centro_trabajo.total_grados','datos_centro_trabajo.total_directores',
         'datos_centro_trabajo.total_docentes', 'datos_centro_trabajo.total_fisica','datos_centro_trabajo.total_usaer','datos_centro_trabajo.total_artistica','datos_centro_trabajo.total_intendentes',
         'datos_centro_trabajo.fecha_ingreso', 'datos_centro_trabajo.fecha_baja','datos_centro_trabajo.captura')->where('centro_trabajo.id_municipios','=',$mun)->get();

       return response()->json(
        $centros->toArray());
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
