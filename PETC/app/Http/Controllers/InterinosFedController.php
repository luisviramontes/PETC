<?php

namespace petc\Http\Controllers;

use Illuminate\Http\Request;

use petc\CapturaModel;

use DB;
use Maatwebsite\Excel\Facades\Excel;
use PHPExcel_Worksheet_Drawing;
use Validator;

use petc\Http\Requests;
use petc\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Collection as Collection;
class InterinosFedController extends Controller
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
    public function index(request $request){
     if($request)
     {
       // $aux=$request->get('searchText');
      $query=trim($request->GET('searchText'));

      $contador= DB::table('captura')->where('captura.pagos_registrados','=','0')->where('captura.sostenimiento','=','FEDERAL')->where('captura.estado','=','ACTIVO')->count(); 

      if ($query == ""){
        $personal= DB::table('captura')->join('cat_puesto','cat_puesto.id','=','captura.clave')->join('centro_trabajo', 'centro_trabajo.id', '=','captura.id_cct_etc')->select('centro_trabajo.id_region','centro_trabajo.id_localidades','centro_trabajo.id_municipios')->join('region', 'region.id', '=','centro_trabajo.id_region')->join('localidades', 'localidades.id', '=','centro_trabajo.id_localidades')->join('municipios', 'municipios.id', '=','centro_trabajo.id_municipios')->join('ciclo_escolar', 'ciclo_escolar.id', '=','captura.id_ciclo')->select('captura.*','cat_puesto.cat_puesto','centro_trabajo.cct','centro_trabajo.nombre_escuela','ciclo_escolar.ciclo','region.region','municipios.municipio','localidades.nom_loc')->where('captura.pagos_registrados','=','0')->where('captura.sostenimiento','=','FEDERAL')->where('captura.estado','=','ACTIVO')->paginate(30);
        //
    }else{
      $personal= DB::table('captura')->join('cat_puesto','cat_puesto.id','=','captura.clave')->join('centro_trabajo', 'centro_trabajo.id', '=','captura.id_cct_etc')->select('centro_trabajo.id_region','centro_trabajo.id_localidades','centro_trabajo.id_municipios')->join('region', 'region.id', '=','centro_trabajo.id_region')->join('localidades', 'localidades.id', '=','centro_trabajo.id_localidades')->join('municipios', 'municipios.id', '=','centro_trabajo.id_municipios')->join('ciclo_escolar', 'ciclo_escolar.id', '=','captura.id_ciclo')->select('captura.*','cat_puesto.cat_puesto','centro_trabajo.cct','centro_trabajo.nombre_escuela','ciclo_escolar.ciclo','region.region','municipios.municipio','localidades.nom_loc')->where('captura.pagos_registrados','=','0')->where('captura.sostenimiento','=','FEDERAL')->where('captura.estado','=','ACTIVO')->where('captura.rfc','LIKE','%'.$query.'%')->orwhere('captura.nombre','LIKE','%'.$query.'%')->orwhere('centro_trabajo.nombre_escuela','LIKE','%'.$query.'%')->orwhere('centro_trabajo.cct','LIKE','%'.$query.'%')->paginate(30);

  }

  return view('nomina.interinos.federal.index',["personal"=>$personal,"contador"=>$contador,"searchText"=>$query]);

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

        public function activar($id)
    { 
        $user = Auth::user()->name;
      $captura=CapturaModel::findOrFail($id);
      $captura->pagos_registrados="1";
      $captura->captura=$user;
      $captura->update();
      return redirect('interinosfed');
        //
    }

    public function excel(Request $request)
    {
     Excel::create('INTERINOS FEDERALES', function($excel) {
       $excel->sheet('Excel sheet', function($sheet) {
         $personal = CapturaModel::join('cat_puesto','cat_puesto.id','=','captura.clave')->join('centro_trabajo', 'centro_trabajo.id', '=','captura.id_cct_etc')->select('centro_trabajo.id_region','centro_trabajo.id_localidades','centro_trabajo.id_municipios')->join('region', 'region.id', '=','centro_trabajo.id_region')->join('localidades', 'localidades.id', '=','centro_trabajo.id_localidades')->join('municipios', 'municipios.id', '=','centro_trabajo.id_municipios')->join('ciclo_escolar', 'ciclo_escolar.id', '=','captura.id_ciclo')->select('captura.id','captura.nombre','captura.rfc','captura.fecha_inicio','captura.fecha_termino','centro_trabajo.cct','centro_trabajo.nombre_escuela','captura.categoria','cat_puesto.cat_puesto','region.region','captura.sostenimiento','captura.telefono','captura.email','captura.num_escuelas','captura.observaciones','captura.estado','ciclo_escolar.ciclo')->where('captura.pagos_registrados','=','0')->where('captura.sostenimiento','=','FEDERAL')->get();
         $sheet->fromArray($personal);
         $sheet->row(1,['ID','NOMBRE','RFC','FECHA DE INICIO','FECHA DE TERMINO','CCT','NOMBRE ESCUELA','CATEGORIA','CLAVE','REGION','SOSTENIMIENTO','TELEFONO','EMAIL','NUM DE ESCUELAS ETC','OBSERVACIONES','ESTADO','CICLO ESCOLAR']);
         $sheet->setOrientation('landscape');
       });
     })->export('xls');
   }

}
