<?php

namespace petc\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use petc\Http\Requests;

use petc\Http\Controllers\Controller;
use petc\CentroTrabajoModel;
use petc\CicloEscolarModel;

use petc\DatosCentroTrabajoModel;

use Dompdf\Dompdf;
use DB;
use Maatwebsite\Excel\Facades\Excel;
use PHPExcel_Worksheet_Drawing;
use Validator;
use \Milon\Barcode\DNS1D;
use \Milon\Barcode\DNS2D;
use petc\Http\Requests\CentroTrabajoRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Collection as Collection;
class CentroTrabajoController extends Controller
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
      if($tipo_usuario <> "1" && $tipo_usuario <> "2"  && $tipo_usuario <> "3" && $tipo_usuario <> "4" &&    $tipo_usuario <> "5" && $tipo_usuario <> "6"){
       return view('permisos');

     }else{
      if($request)
      {

        $query=trim($request->GET('searchText'));







       $query=trim($request->GET('searchText'));



         $centro = DB::table('centro_trabajo')
         ->join('datos_centro_trabajo', 'centro_trabajo.id', '=','datos_centro_trabajo.id_centro_trabajo')
         ->join('region', 'centro_trabajo.id_region', '=','region.id')
         ->join('localidades', 'centro_trabajo.id_localidades', '=','localidades.id')
         ->join('municipios', 'centro_trabajo.id_municipios', '=','municipios.id')



          ->select('centro_trabajo.*','region.region','region.sostenimiento','localidades.nom_loc','municipios.municipio','datos_centro_trabajo.total_alumnos','datos_centro_trabajo.total_ninas','datos_centro_trabajo.total_ninos',
           'datos_centro_trabajo.total_grupos', 'datos_centro_trabajo.total_grados','datos_centro_trabajo.total_directores',
           'datos_centro_trabajo.total_docentes', 'datos_centro_trabajo.total_fisica','datos_centro_trabajo.total_usaer','datos_centro_trabajo.total_artistica','datos_centro_trabajo.total_intendentes',
           'datos_centro_trabajo.fecha_ingreso', 'datos_centro_trabajo.fecha_baja','datos_centro_trabajo.captura')

           ->orwhere('cct','LIKE','%'.$query.'%')
           ->orwhere('localidades.nom_loc','LIKE','%'.$query.'%')
           ->orwhere('municipios.municipio','LIKE','%'.$query.'%')
           ->orwhere('centro_trabajo.domicilio','LIKE','%'.$query.'%')
           ->where('centro_trabajo.estado','=','ACTIVO')
           ->where('nombre_escuela','LIKE','%'.$query.'%')


          ->paginate(10);


       return view('nomina.centro_trabajo.index',["centro"=>$centro,"searchText"=>$query]);
        // return view('nomina.tabla_pagos.index',['tabla_pagos' => $tabla_pagos,'ciclos'=> $ciclos]);
        //
     }} }
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
      $region=DB::table('region')->get();
      $localidades=DB::table('localidades')->where('estado','=','ACTIVO')->get();
      $municipios=DB::table('municipios')->where('estado','=','ACTIVO')->get();
      $ciclos=DB::table('ciclo_escolar')->get();
      return view('nomina.centro_trabajo.create', ['ciclos'=> $ciclos,'localidades'=>$localidades,'municipios'=>$municipios,'region'=>$region]);
        //
    }}

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CentroTrabajoRequest $formulario)
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
          $datos->captura=$user;
          $datos->telefono=$formulario->get('telefono');
          $datos->email=$formulario->get('email');
          $datos->ciclo_escolar=$formulario->get('ciclo');
          $datos->entrego_carta=$formulario->get('carta_compromiso');
          $datos->alimentacion=$formulario->get('alimentacion');
          $datos->tipo_organizacion=$formulario->get('organizacion');
          $datos->nivel=$formulario->get('nivel');
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
          $datos2->captura=$user;
          $datos2->save();
          return Redirect::to('centro_trabajo');
}       //
}}}

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
      $datos=CentroTrabajoModel::findOrFail($id);

      $datos->cct=$request->get('cct');
      $datos->nombre_escuela=$request->get('nombre');
      $datos->domicilio=$request->get('domicilio');
      $datos->id_localidades=$request->get('localidad');
      $datos->id_municipios=$request->get('municipio');
      $datos->id_region=$request->get('region');
      $datos->captura=$user;
      $datos->telefono=$request->get('telefono');
      $datos->email=$request->get('email');
      $datos->ciclo_escolar=$request->get('ciclo');
      $datos->entrego_carta=$request->get('carta_compromiso');
      $datos->alimentacion=$request->get('alimentacion');
      $datos->tipo_organizacion=$formulario->get('organizacion');
      $datos->nivel=$formulario->get('nivel');
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
      $datos2->captura=$user;
      $datos2->update();
      return Redirect::to('centro_trabajo');
        //
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
      $datos=CentroTrabajoModel::findOrFail($id);
      $datos->estado="INACTIVO";
      $datos->captura=$user;
      $datos2->update();
      return Redirect::to('centro_trabajo');
        //
    }}

    public function invoice(){

     set_time_limit(0);
     ini_set("memory_limit",-1);
     ini_set('max_execution_time', 0);

     $centros = DB::table('centro_trabajo')
     ->join('datos_centro_trabajo', 'centro_trabajo.id', '=','datos_centro_trabajo.id_centro_trabajo')
     ->join('region', 'centro_trabajo.id_region', '=','region.id')
     ->join('localidades', 'centro_trabajo.id_localidades', '=','localidades.id')
     ->join('municipios', 'centro_trabajo.id_municipios', '=','municipios.id')
     ->select('centro_trabajo.*','region.region','region.sostenimiento','localidades.*','municipios.*','datos_centro_trabajo.id as id_datos_centro','datos_centro_trabajo.total_alumnos','datos_centro_trabajo.total_ninas','datos_centro_trabajo.total_ninos',
      'datos_centro_trabajo.total_grupos', 'datos_centro_trabajo.total_grados','datos_centro_trabajo.total_directores',
      'datos_centro_trabajo.total_docentes', 'datos_centro_trabajo.total_fisica','datos_centro_trabajo.total_usaer','datos_centro_trabajo.total_artistica','datos_centro_trabajo.total_intendentes',
      'datos_centro_trabajo.fecha_ingreso', 'datos_centro_trabajo.fecha_baja','datos_centro_trabajo.captura')->where('centro_trabajo.estado','=','ACTIVO')->take(200)->get();
         //$material   = AlmacenMaterial:: findOrFail($id);

     //$pdf = new DOMPDF();
     $date = date('Y-m-d');
     $invoice = "2222";
       // print_r($materiales);

   //$pdf = \PDF::loadView('nomina.centro_trabajo.invoice',['centros' => $centros]);
     $view =  \View::make('nomina.centro_trabajo.invoice', array('centros'=>$centros))->render();
     $pdf = \App::make('dompdf.wrapper');
     $pdf->loadHTML($view);

     return $pdf->stream('invoice23');
    //return $pdf->download('invoice.pdf');

   }

   public function invoice_centro_cct($id_cct,$ciclo){
     $nombre_ciclo= DB::table('ciclo_escolar')->where('id','=',$ciclo)->select('ciclo_escolar.ciclo')->first();
     $nombre=DB::table('centro_trabajo')->where('centro_trabajo.id','=',$id_cct)->first();
     $date = date('Y-m-d');
     $centro = DB::table('centro_trabajo')
     ->join('datos_centro_trabajo', 'centro_trabajo.id', '=','datos_centro_trabajo.id_centro_trabajo')
     ->join('region', 'centro_trabajo.id_region', '=','region.id')
     ->join('localidades', 'centro_trabajo.id_localidades', '=','localidades.id')
     ->join('municipios', 'centro_trabajo.id_municipios', '=','municipios.id')
     ->select('centro_trabajo.*','region.region','region.sostenimiento','localidades.nom_loc','municipios.municipio','datos_centro_trabajo.total_alumnos','datos_centro_trabajo.total_ninas','datos_centro_trabajo.total_ninos',
      'datos_centro_trabajo.total_grupos', 'datos_centro_trabajo.total_grados','datos_centro_trabajo.total_directores',
      'datos_centro_trabajo.total_docentes', 'datos_centro_trabajo.total_fisica','datos_centro_trabajo.total_usaer','datos_centro_trabajo.total_artistica','datos_centro_trabajo.total_intendentes',
      'datos_centro_trabajo.fecha_ingreso', 'datos_centro_trabajo.fecha_baja','datos_centro_trabajo.captura')->where('centro_trabajo.id','=',$id_cct)->first();
       // print_r($materiales);
     $view =  \View::make('nomina.centro_trabajo.invoice_centro', compact('centro','date','nombre_ciclo','nombre'))->render();
        //->setPaper($customPaper, 'landscape');
     $pdf = \App::make('dompdf.wrapper');
     $pdf->setPaper('A4', 'portrait');
     $pdf->loadHTML($view);
     return $pdf->stream('invoice_centro');
   }


   public function invoice_plantilla($id_cct,$ciclo){
     $nombre_ciclo= DB::table('ciclo_escolar')->where('id','=',$ciclo)->select('ciclo_escolar.ciclo')->first();
     $nombre=DB::table('centro_trabajo')->join('datos_centro_trabajo', 'centro_trabajo.id', '=','datos_centro_trabajo.id_centro_trabajo')
     ->join('region', 'centro_trabajo.id_region', '=','region.id')
     ->join('localidades', 'centro_trabajo.id_localidades', '=','localidades.id')
     ->join('municipios', 'centro_trabajo.id_municipios', '=','municipios.id')
     ->select('centro_trabajo.*','region.region','region.sostenimiento','localidades.nom_loc','municipios.municipio','datos_centro_trabajo.fecha_ingreso', 'datos_centro_trabajo.fecha_baja','datos_centro_trabajo.captura')->where('centro_trabajo.id','=',$id_cct)->first();


     $date = date('Y-m-d');

     $personal= DB::table('captura')->join('cat_puesto','cat_puesto.id','=','captura.clave')->select('captura.*','cat_puesto.cat_puesto')->where('captura.id_cct_etc','=',$id_cct)->where('captura.id_ciclo','=',$ciclo)->where('captura.estado','=','ACTIVO')->get();
       // print_r($materiales);
     $view =  \View::make('nomina.centro_trabajo.invoice_plantilla', compact('personal','date','nombre_ciclo','nombre'))->render();
        //->setPaper($customPaper, 'landscape');
     $pdf = \App::make('dompdf.wrapper');
     $pdf->setPaper('A4', 'portrait');
     $pdf->loadHTML($view);
     return $pdf->stream('invoice_plantilla');
   }


   public function excel(Request $request)
   {

    Excel::create('CENTROS DE TRABAJO PETC', function($excel) {
      $excel->sheet('Excel sheet', function($sheet) {
                //otra opción -> $products = Product::select('name')->get();
        $tabla = CentroTrabajoModel::join('datos_centro_trabajo', 'centro_trabajo.id', '=','datos_centro_trabajo.id_centro_trabajo')
        ->join('region', 'centro_trabajo.id_region', '=','region.id')
        ->join('localidades', 'centro_trabajo.id_localidades', '=','localidades.id')
        ->join('municipios', 'centro_trabajo.id_municipios', '=','municipios.id')
        ->select('centro_trabajo.cct','centro_trabajo.nombre_escuela','centro_trabajo.domicilio','centro_trabajo.telefono','centro_trabajo.email','centro_trabajo.ciclo_escolar','centro_trabajo.alimentacion','region.region','region.sostenimiento','localidades.nom_loc','municipios.municipio','datos_centro_trabajo.total_alumnos','datos_centro_trabajo.total_ninas','datos_centro_trabajo.total_ninos',
          'datos_centro_trabajo.total_grupos', 'datos_centro_trabajo.total_grados','datos_centro_trabajo.total_directores',
          'datos_centro_trabajo.total_docentes', 'datos_centro_trabajo.total_fisica','datos_centro_trabajo.total_usaer','datos_centro_trabajo.total_artistica','datos_centro_trabajo.total_intendentes',
          'datos_centro_trabajo.fecha_ingreso','datos_centro_trabajo.captura')->where('centro_trabajo.estado','=','ACTIVO')->get();
        $sheet->fromArray($tabla);
        $sheet->row(1,['CCT','NOMBRE ESCUELA','DOMICILIO','TELEFONO' ,'EMAIL','CICLO ESCOLAR','ALIMENTACION','REGION','SOSTENIMIENTO','NOMBRE LOCALIDAD','MUNICIPIO','TOTAL ALUMNOS','TOTAL NIÑAS','TOTAL NIÑOS','TOTAL GRUPOS','TOTAL GRADOS','TOTAL DIRECTOR','TOTAL DOCENTES','TOTAL E.FISICA','TOTAL USAER','TOTAL ARTISTICA','TOTAL INTENDENTES','FECHA DE INGRESO AL PETC','CAPTURO']);
        $sheet->setOrientation('landscape');
      });
    })->export('xls');
  }

  public function  verInformacion($id_cct,$ciclo){

    $personal= DB::table('captura')->join('cat_puesto','cat_puesto.id','=','captura.clave')->select('captura.*','cat_puesto.cat_puesto')->where('captura.id_cct_etc','=',$id_cct)->where('captura.id_ciclo','=',$ciclo)->where('captura.estado','=','ACTIVO')->get();

    $nombre_ciclo= DB::table('ciclo_escolar')->where('id','=',$ciclo)->select('ciclo_escolar.ciclo')->first();

    $total_ina=DB::table('inasistencias')->where('inasistencias.id_cct_etc','=',$id_cct)->where('inasistencias.id_ciclo','=',$ciclo)->count();

    $nombre=DB::table('centro_trabajo')->where('centro_trabajo.id','=',$id_cct)->first();

    $centro = DB::table('centro_trabajo')
    ->join('datos_centro_trabajo', 'centro_trabajo.id', '=','datos_centro_trabajo.id_centro_trabajo')
    ->join('region', 'centro_trabajo.id_region', '=','region.id')
    ->join('localidades', 'centro_trabajo.id_localidades', '=','localidades.id')
    ->join('municipios', 'centro_trabajo.id_municipios', '=','municipios.id')
    ->select('centro_trabajo.*','region.region','region.sostenimiento','localidades.nom_loc','municipios.municipio','datos_centro_trabajo.total_alumnos','datos_centro_trabajo.total_ninas','datos_centro_trabajo.total_ninos',
      'datos_centro_trabajo.total_grupos', 'datos_centro_trabajo.total_grados','datos_centro_trabajo.total_directores',
      'datos_centro_trabajo.total_docentes', 'datos_centro_trabajo.total_fisica','datos_centro_trabajo.total_usaer','datos_centro_trabajo.total_artistica','datos_centro_trabajo.total_intendentes',
      'datos_centro_trabajo.fecha_ingreso', 'datos_centro_trabajo.fecha_baja','datos_centro_trabajo.captura')->where('centro_trabajo.id','=',$id_cct)->first();

    $inasistencias= DB::table('inasistencias')->join('captura','captura.id','=','inasistencias.id_captura')->select('inasistencias.*','captura.rfc','captura.nombre','captura.categoria')->where('inasistencias.id_ciclo','=',$ciclo)->where('inasistencias.id_cct_etc','=',$id_cct)->get();

    $alta_1= DB::table('altas_contrato')->join('captura','captura.id','=','altas_contrato.id_captura')->select('captura.nombre','captura.rfc','captura.estado as estado_cap','altas_contrato.*')->whereNull('altas_contrato.id_baja')->where('altas_contrato.id_cct_etc','=',$id_cct)->where('altas_contrato.id_ciclo','=',$ciclo)->get();

    $alta_2= DB::table('altas_contrato')->join('captura','captura.id','=','altas_contrato.id_captura')->join('captura as captura2','captura2.id','=','altas_contrato.id_baja')->select('captura.nombre','captura.rfc','captura2.nombre as nombre2','captura.estado as estado_cap','captura2.rfc as rfc2','altas_contrato.*')->where('altas_contrato.id_cct_etc','=',$id_cct)->where('altas_contrato.id_ciclo','=',$ciclo)->get();

    $baja_1= DB::table('bajas_contrato')->join('captura','captura.id','=','bajas_contrato.id_captura')->select('captura.nombre','captura.rfc','captura.categoria','captura.estado as estado_cap','bajas_contrato.*')->whereNull('bajas_contrato.id_alta')->where('bajas_contrato.id_cct_etc','=',$id_cct)->where('bajas_contrato.id_ciclo','=',$ciclo)->get();

    $baja_2= DB::table('bajas_contrato')->join('captura','captura.id','=','bajas_contrato.id_captura')->join('captura as captura2','captura2.id','=','bajas_contrato.id_alta')->select('captura.categoria','captura.nombre','captura.rfc','captura2.nombre as nombre2','captura.estado as estado_cap','captura2.rfc as rfc2','bajas_contrato.*')->where('bajas_contrato.id_cct_etc','=',$id_cct)->where('bajas_contrato.id_ciclo','=',$ciclo)->get();

    $cambio_cct= DB::table('cambios_cct')->join('captura','captura.id','=','cambios_cct.id_captura')->join('centro_trabajo','centro_trabajo.id','=','cambios_cct.id_cct_nuevo')->join('centro_trabajo as centro2','centro2.id','=','cambios_cct.id_cct_anterior')->select('captura.nombre','captura.rfc','captura.estado as estado_cap','cambios_cct.*','centro_trabajo.cct','centro2.cct as cct2')->where('cambios_cct.id_ciclo','=',$ciclo)->where('cambios_cct.id_cct_anterior','=',$id_cct)->orwhere('cambios_cct.id_cct_nuevo','=',$id_cct)->get();

    $cambio_funcion= DB::table('cambio_funcion')->join('captura','captura.id','=','cambio_funcion.id_captura')->select('captura.nombre','captura.rfc','captura.estado as estado_cap','cambio_funcion.*')->where('cambio_funcion.id_cct_etc','=',$id_cct)->where('cambio_funcion.id_ciclo','=',$ciclo)->get();



    $ciclos=DB::table('ciclo_escolar')->get();
    $id_ciclo=$ciclo;
    return view('nomina.centro_trabajo.verinformacion', ['personal'=> $personal,'centro'=>$centro,'ciclos'=>$ciclos,'id_ciclo'=>$id_ciclo,'total_ina'=>$total_ina,'nombre'=>$nombre,'nombre_ciclo'=>$nombre_ciclo,'alta_1'=>$alta_1,'alta_2'=>$alta_2,'baja_1'=>$baja_1,'baja_2'=>$baja_2,'cambio_cct'=>$cambio_cct,'cambio_funcion'=>$cambio_funcion]);

  }

  public function ver_centros_trabajo(){
   $total=DB::table('centro_trabajo')->where('estado','=',"ACTIVO")->select(DB::raw('COUNT(centro_trabajo.nivel) as total_registros'))->first();

   $total_prim=DB::table('centro_trabajo')->where('estado','=',"ACTIVO")->where('nivel','=','PRIMARIA')->select(DB::raw('COUNT(centro_trabajo.nivel) as total_registros'))->first();

   $total_prim_a=DB::table('centro_trabajo')->where('estado','=',"ACTIVO")->where('nivel','=','PRIMARIA')->where('alimentacion','=','SI')->select(DB::raw('COUNT(centro_trabajo.nivel) as total_registros'))->first();

   $total_pre=DB::table('centro_trabajo')->where('estado','=',"ACTIVO")->where('nivel','=','PREESCOLAR')->select(DB::raw('COUNT(centro_trabajo.nivel) as total_registros'))->first();

   $total_pre_a=DB::table('centro_trabajo')->where('estado','=',"ACTIVO")->where('nivel','=','PREESCOLAR')->where('alimentacion','=','SI')->select(DB::raw('COUNT(centro_trabajo.nivel) as total_registros'))->first();

   $total_sec=DB::table('centro_trabajo')->where('estado','=',"ACTIVO")->where('nivel','=','SECUNDARIA')->select(DB::raw('COUNT(centro_trabajo.nivel) as total_registros'))->first();

   $total_sec_a=DB::table('centro_trabajo')->where('estado','=',"ACTIVO")->where('nivel','=','SECUNDARIA')->where('alimentacion','=','SI')->select(DB::raw('COUNT(centro_trabajo.nivel) as total_registros'))->first();

   return view('nomina.centro_trabajo.ver_centros',['total'=>$total,'total_prim'=>$total_prim,'total_prim_a'=>$total_prim_a,'total_pre'=>$total_pre,'total_pre_a'=>$total_pre_a,'total_sec'=>$total_sec,'total_sec_a'=>$total_sec_a]);

 }

 public function option($op){

  if ($op==2){
    $res=DB::table('region')->select('id','region','sostenimiento')->get();

  }elseif($op==3){
   $res=DB::table('municipios')->get();

 }elseif($op ==4){
   $res=DB::table('localidades')->join('municipios','municipios.id','=','localidades.id_municipio')->select('localidades.nom_loc','localidades.id','municipios.municipio')->get();

 }elseif($op ==5){
   $res= DB::table('datos_centro_trabajo')->orderby('fecha_ingreso','DESC')->distinct()->get(['fecha_ingreso']);


 }

 return response()->json([
  $res,$op]);

}

public function ver_centros_filtro($op,$id){
 if ($op==2){
   $total=DB::table('centro_trabajo')->where('id_region','=',$id)->where('estado','=',"ACTIVO")->select(DB::raw('COUNT(centro_trabajo.nivel) as total_registros'))->first();

   $esc =DB::table('centro_trabajo')->join('localidades', 'centro_trabajo.id_localidades', '=','localidades.id')
   ->join('municipios', 'centro_trabajo.id_municipios', '=','municipios.id')->where('centro_trabajo.id_region','=',$id)->where('centro_trabajo.estado','=',"ACTIVO")->select('centro_trabajo.cct','centro_trabajo.nombre_escuela','centro_trabajo.alimentacion','centro_trabajo.nivel','centro_trabajo.telefono','centro_trabajo.domicilio','localidades.nom_loc','municipios.municipio')->orderby('nivel','DESC')->get();

   $total_prim=DB::table('centro_trabajo')->where('id_region','=',$id)->where('estado','=',"ACTIVO")->where('nivel','=','PRIMARIA')->select(DB::raw('COUNT(centro_trabajo.nivel) as total_registros'))->first();

   $total_prim_a=DB::table('centro_trabajo')->where('id_region','=',$id)->where('estado','=',"ACTIVO")->where('nivel','=','PRIMARIA')->where('alimentacion','=','SI')->select(DB::raw('COUNT(centro_trabajo.nivel) as total_registros'))->first();

   $total_pre=DB::table('centro_trabajo')->where('id_region','=',$id)->where('estado','=',"ACTIVO")->where('nivel','=','PREESCOLAR')->select(DB::raw('COUNT(centro_trabajo.nivel) as total_registros'))->first();

   $total_pre_a=DB::table('centro_trabajo')->where('id_region','=',$id)->where('estado','=',"ACTIVO")->where('nivel','=','PREESCOLAR')->where('alimentacion','=','SI')->select(DB::raw('COUNT(centro_trabajo.nivel) as total_registros'))->first();

   $total_sec=DB::table('centro_trabajo')->where('id_region','=',$id)->where('estado','=',"ACTIVO")->where('nivel','=','SECUNDARIA')->select(DB::raw('COUNT(centro_trabajo.nivel) as total_registros'))->first();

   $total_sec_a=DB::table('centro_trabajo')->where('id_region','=',$id)->where('estado','=',"ACTIVO")->where('nivel','=','SECUNDARIA')->where('alimentacion','=','SI')->select(DB::raw('COUNT(centro_trabajo.nivel) as total_registros'))->first();

 }elseif($op==3){
  $total=DB::table('centro_trabajo')->where('id_municipios','=',$id)->where('estado','=',"ACTIVO")->select(DB::raw('COUNT(centro_trabajo.nivel) as total_registros'))->first();

  $esc =DB::table('centro_trabajo')->join('localidades', 'centro_trabajo.id_localidades', '=','localidades.id')
  ->join('municipios', 'centro_trabajo.id_municipios', '=','municipios.id')->where('centro_trabajo.id_municipios','=',$id)->where('centro_trabajo.estado','=',"ACTIVO")->select('centro_trabajo.cct','centro_trabajo.nombre_escuela','centro_trabajo.alimentacion','centro_trabajo.nivel','centro_trabajo.telefono','centro_trabajo.domicilio','localidades.nom_loc','municipios.municipio')->orderby('nivel','DESC')->get();

  $total_prim=DB::table('centro_trabajo')->where('id_municipios','=',$id)->where('estado','=',"ACTIVO")->where('nivel','=','PRIMARIA')->select(DB::raw('COUNT(centro_trabajo.nivel) as total_registros'))->first();

  $total_prim_a=DB::table('centro_trabajo')->where('id_municipios','=',$id)->where('estado','=',"ACTIVO")->where('nivel','=','PRIMARIA')->where('alimentacion','=','SI')->select(DB::raw('COUNT(centro_trabajo.nivel) as total_registros'))->first();

  $total_pre=DB::table('centro_trabajo')->where('id_municipios','=',$id)->where('estado','=',"ACTIVO")->where('nivel','=','PREESCOLAR')->select(DB::raw('COUNT(centro_trabajo.nivel) as total_registros'))->first();

  $total_pre_a=DB::table('centro_trabajo')->where('id_municipios','=',$id)->where('estado','=',"ACTIVO")->where('nivel','=','PREESCOLAR')->where('alimentacion','=','SI')->select(DB::raw('COUNT(centro_trabajo.nivel) as total_registros'))->first();

  $total_sec=DB::table('centro_trabajo')->where('id_municipios','=',$id)->where('estado','=',"ACTIVO")->where('nivel','=','SECUNDARIA')->select(DB::raw('COUNT(centro_trabajo.nivel) as total_registros'))->first();

  $total_sec_a=DB::table('centro_trabajo')->where('id_municipios','=',$id)->where('estado','=',"ACTIVO")->where('nivel','=','SECUNDARIA')->where('alimentacion','=','SI')->select(DB::raw('COUNT(centro_trabajo.nivel) as total_registros'))->first();

}elseif($op ==4){
 $total=DB::table('centro_trabajo')->where('id_localidades','=',$id)->where('estado','=',"ACTIVO")->select(DB::raw('COUNT(centro_trabajo.nivel) as total_registros'))->first();

 $esc =DB::table('centro_trabajo')->join('localidades', 'centro_trabajo.id_localidades', '=','localidades.id')
 ->join('municipios', 'centro_trabajo.id_municipios', '=','municipios.id')->where('centro_trabajo.id_localidades','=',$id)->where('centro_trabajo.estado','=',"ACTIVO")->select('centro_trabajo.cct','centro_trabajo.nombre_escuela','centro_trabajo.alimentacion','centro_trabajo.nivel','centro_trabajo.telefono','centro_trabajo.domicilio','localidades.nom_loc','municipios.municipio')->orderby('nivel','DESC')->get();

 $total_prim=DB::table('centro_trabajo')->where('id_localidades','=',$id)->where('estado','=',"ACTIVO")->where('nivel','=','PRIMARIA')->select(DB::raw('COUNT(centro_trabajo.nivel) as total_registros'))->first();

 $total_prim_a=DB::table('centro_trabajo')->where('id_localidades','=',$id)->where('estado','=',"ACTIVO")->where('nivel','=','PRIMARIA')->where('alimentacion','=','SI')->select(DB::raw('COUNT(centro_trabajo.nivel) as total_registros'))->first();

 $total_pre=DB::table('centro_trabajo')->where('id_localidades','=',$id)->where('estado','=',"ACTIVO")->where('nivel','=','PREESCOLAR')->select(DB::raw('COUNT(centro_trabajo.nivel) as total_registros'))->first();

 $total_pre_a=DB::table('centro_trabajo')->where('id_localidades','=',$id)->where('estado','=',"ACTIVO")->where('nivel','=','PREESCOLAR')->where('alimentacion','=','SI')->select(DB::raw('COUNT(centro_trabajo.nivel) as total_registros'))->first();

 $total_sec=DB::table('centro_trabajo')->where('id_localidades','=',$id)->where('estado','=',"ACTIVO")->where('nivel','=','SECUNDARIA')->select(DB::raw('COUNT(centro_trabajo.nivel) as total_registros'))->first();

 $total_sec_a=DB::table('centro_trabajo')->where('id_localidades','=',$id)->where('estado','=',"ACTIVO")->where('nivel','=','SECUNDARIA')->where('alimentacion','=','SI')->select(DB::raw('COUNT(centro_trabajo.nivel) as total_registros'))->first();

}elseif($op ==5){

 $total=DB::table('centro_trabajo')->join('datos_centro_trabajo','datos_centro_trabajo.id_centro_trabajo','=','centro_trabajo.id')->where('datos_centro_trabajo.fecha_ingreso','=',$id)->where('centro_trabajo.estado','=',"ACTIVO")->select(DB::raw('COUNT(centro_trabajo.nivel) as total_registros'))->first();

 $esc =DB::table('centro_trabajo')->join('localidades', 'centro_trabajo.id_localidades', '=','localidades.id')
 ->join('municipios', 'centro_trabajo.id_municipios', '=','municipios.id')->join('datos_centro_trabajo','datos_centro_trabajo.id_centro_trabajo','=','centro_trabajo.id')->where('datos_centro_trabajo.fecha_ingreso','=',$id)->where('centro_trabajo.estado','=',"ACTIVO")->select('centro_trabajo.cct','centro_trabajo.nombre_escuela','centro_trabajo.alimentacion','centro_trabajo.nivel','centro_trabajo.telefono','centro_trabajo.domicilio','localidades.nom_loc','municipios.municipio')->orderby('centro_trabajo.nivel','DESC')->get();

 $total_prim=DB::table('centro_trabajo')->join('datos_centro_trabajo','datos_centro_trabajo.id_centro_trabajo','=','centro_trabajo.id')->where('datos_centro_trabajo.fecha_ingreso','=',$id)->where('centro_trabajo.estado','=',"ACTIVO")->where('centro_trabajo.nivel','=','PRIMARIA')->select(DB::raw('COUNT(centro_trabajo.nivel) as total_registros'))->first();

 $total_prim_a=DB::table('centro_trabajo')->join('datos_centro_trabajo','datos_centro_trabajo.id_centro_trabajo','=','centro_trabajo.id')->where('datos_centro_trabajo.fecha_ingreso','=',$id)->where('centro_trabajo.estado','=',"ACTIVO")->where('centro_trabajo.nivel','=','PRIMARIA')->where('centro_trabajo.alimentacion','=','SI')->select(DB::raw('COUNT(centro_trabajo.nivel) as total_registros'))->first();

 $total_pre=DB::table('centro_trabajo')->join('datos_centro_trabajo','datos_centro_trabajo.id_centro_trabajo','=','centro_trabajo.id')->where('datos_centro_trabajo.fecha_ingreso','=',$id)->where('centro_trabajo.estado','=',"ACTIVO")->where('centro_trabajo.nivel','=','PREESCOLAR')->select(DB::raw('COUNT(centro_trabajo.nivel) as total_registros'))->first();

 $total_pre_a=DB::table('centro_trabajo')->join('datos_centro_trabajo','datos_centro_trabajo.id_centro_trabajo','=','centro_trabajo.id')->where('datos_centro_trabajo.fecha_ingreso','=',$id)->where('centro_trabajo.estado','=',"ACTIVO")->where('centro_trabajo.nivel','=','PREESCOLAR')->where('centro_trabajo.alimentacion','=','SI')->select(DB::raw('COUNT(centro_trabajo.nivel) as total_registros'))->first();

 $total_sec=DB::table('centro_trabajo')->join('datos_centro_trabajo','datos_centro_trabajo.id_centro_trabajo','=','centro_trabajo.id')->where('datos_centro_trabajo.fecha_ingreso','=',$id)->where('centro_trabajo.estado','=',"ACTIVO")->where('nivel','=','SECUNDARIA')->select(DB::raw('COUNT(centro_trabajo.nivel) as total_registros'))->first();

 $total_sec_a=DB::table('centro_trabajo')->join('datos_centro_trabajo','datos_centro_trabajo.id_centro_trabajo','=','centro_trabajo.id')->where('datos_centro_trabajo.fecha_ingreso','=',$id)->where('centro_trabajo.estado','=',"ACTIVO")->where('centro_trabajo.nivel','=','SECUNDARIA')->where('centro_trabajo.alimentacion','=','SI')->select(DB::raw('COUNT(centro_trabajo.nivel) as total_registros'))->first();


}

return response()->json([$total,$total_prim,$total_prim_a,$total_pre,$total_pre_a,$total_sec,$total_sec_a,$esc]);



}


}
