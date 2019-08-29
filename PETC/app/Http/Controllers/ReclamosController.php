<?php

namespace petc\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Redirect;
use petc\Http\Requests;
use petc\Http\Controllers\Controller;
use petc\ReclamosModel;
use petc\DiasMesModel;
use petc\TabuladorPagosModel;
use petc\OficiosEmitidosModel;
use petc\TablaPagosModel;

use DB;

use Maatwebsite\Excel\Facades\Excel;
use PHPExcel_Worksheet_Drawing;
use Validator;
use \Milon\Barcode\DNS1D;
use \Milon\Barcode\DNS2D;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Collection as Collection;
class ReclamosController extends Controller
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
    public function index(request $request,$id)
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

        $contador= DB::table('reclamos')->where('reclamos.estado','=','PENDIENTE')->where('reclamos.id_ciclo','=',$id)->count();

        if ($query == ""){
         $reclamos=ReclamosModel::join('captura','captura.id','=','reclamos.id_captura')->join('cat_puesto','cat_puesto.id','=','captura.clave')->join('centro_trabajo','centro_trabajo.id','=','captura.id_cct_etc')->join('region', 'region.id', '=','centro_trabajo.id_region')->join('localidades', 'localidades.id', '=','centro_trabajo.id_localidades')->join('municipios', 'municipios.id', '=','centro_trabajo.id_municipios')->join('ciclo_escolar', 'ciclo_escolar.id', '=','reclamos.id_ciclo')->select('cat_puesto.cat_puesto','captura.observaciones as cobservaciones','ciclo_escolar.ciclo','captura.tipo_movimiento','captura.fecha_inicio as fecha_icaptura','captura.fecha_termino as fecha_tcaptura','captura.sostenimiento','region.region','municipios.municipio','localidades.nom_loc','captura.categoria','captura.nombre','captura.rfc','centro_trabajo.cct','centro_trabajo.nombre_escuela','reclamos.*')->where('reclamos.id_ciclo','=',$id)->paginate(30);
       }else{
        $reclamos=ReclamosModel::join('captura','captura.id','=','reclamos.id_captura')->join('cat_puesto','cat_puesto.id','=','captura.clave')->join('centro_trabajo','centro_trabajo.id','=','captura.id_cct_etc')->join('region', 'region.id', '=','centro_trabajo.id_region')->join('localidades', 'localidades.id', '=','centro_trabajo.id_localidades')->join('municipios', 'municipios.id', '=','centro_trabajo.id_municipios')->join('ciclo_escolar', 'ciclo_escolar.id', '=','reclamos.id_ciclo')->select('cat_puesto.cat_puesto','captura.observaciones as cobservaciones','ciclo_escolar.ciclo','captura.tipo_movimiento','captura.fecha_inicio as fecha_icaptura','captura.fecha_termino as fecha_tcaptura','captura.sostenimiento','region.region','municipios.municipio','localidades.nom_loc','captura.categoria','captura.nombre','captura.rfc','centro_trabajo.cct','centro_trabajo.nombre_escuela','reclamos.*')->where('reclamos.id_ciclo','=',$id)->orderBy('reclamos.estado','desc')->where('captura.rfc','LIKE','%'.$query.'%')->orwhere('captura.nombre','LIKE','%'.$query.'%')->orwhere('centro_trabajo.cct','LIKE','%'.$query.'%')->paginate(30);
      }}
      return view('nomina.reclamos.index',["reclamos"=>$reclamos,"contador"=>$contador,"searchText"=>$query,"ciclos"=>$ciclos,"id"=>$id]);





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
      $pagos=DB::table('tabla_pagos')->get();
      $genero=DB::table('directoriointerno')->where('estado','=','ACTIVO')->get();
      $dirigido=DB::table('directorioexterno')->where('estado','=','ACTIVO')->get();
      $ciclos=DB::table('ciclo_escolar')->get();
      $captura=DB::table('captura')->where('captura.estado','=','ACTIVO')->join('centro_trabajo','centro_trabajo.id','=','captura.id_cct_etc')->select('captura.id','captura.rfc','captura.fecha_inicio','captura.fecha_termino','captura.nombre','captura.categoria','centro_trabajo.nombre_escuela','centro_trabajo.cct')->get();
      return view('nomina.reclamos.create', ['dirigido'=>$dirigido,'captura'=> $captura,'ciclos'=>$ciclos,'genero'=>$genero,'pagos'=>$pagos]);
        //
    }}

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
              $tipo_usuario = Auth::user()->tipo_usuario;
      if($tipo_usuario <> "2" || $tipo_usuario=="5"){
       return view('permisos');

      }else{
      $user = Auth::user()->name;
      $date = $request->get('fecha');
      $ciclo_aux=$request->get('ciclo_escolar');

      $oficio=$request->get('oficio');
      $name2 = explode("/",$oficio);
      $oficio_a=$name2[3];
      $name3 = explode(".-",$oficio_a);
      $oficio_aux=$name3[1];

      $motivo=$request->get('motivo');
      $observaciones=$request->get('observaciones');
      $qna=$request->get('pagos');
        $year_aux = substr($qna, 0, -2);  // devuelve "abcde" 201818
        $qna_aux = substr($qna, 4, 5);  // devuelve "abcde" 201818

        //QUIEN GENERO EL OFICIO
        $genero_aux=$request->get('genero');
        //$first = head($genero_aux);
        $name = explode("_",$genero_aux);
        $genero=$name[0];
        $id_genero=$name[1];

        //A QUIEN VA DIRIGIDO EL OFICIO
        $dirigido_aux=$request->get('dirigido_a');
        $name4 = explode("_",$dirigido_aux);
        $dirigido_puesto=$name4[0];
        $dirigido_nombrec=$name4[1];
        $id_dirigido=$name4[2];
        $dirigido_lic=$name4[3];

        //VO BO
        $visto_bueno_aux = $request->get('visto_bueno');
        $first5 = head($visto_bueno_aux);
        $name5 = explode(",",$first5);
        $cuenta_visto_aux= count($name5);
        $cuenta_visto=$cuenta_visto_aux/4;

        if($cuenta_visto == 1){
          $name_vo_1=$name5;
        }else{
         $name_vo_1=$name5;
       }


        //CCP
       $copia_aux = $request->get('c_copia');
       $first6 = head($copia_aux);
       $name6 = explode(",",$first6);
       $cuenta_copia= count($name6);
       $cuenta_copia_t=$cuenta_copia/5;



       $ciclo=DB::table('ciclo_escolar')->where('ciclo','=',$ciclo_aux)->first();
       $elementos= $request->get('totale');
       $x=0;
       $producto = $request->get('codigo2');
       $first = head($producto);
       $name = explode(",",$first);

       $ofico_emite= new OficiosEmitidosModel;
       $ofico_emite->num_oficio=$oficio_aux;
       $ofico_emite->nombre_oficio=$request->get('oficio');
       $ofico_emite->id_dirigido=$id_dirigido;
       $ofico_emite->asunto="Solicitud de Pago";
       $ofico_emite->referencia="Nomina PETC";
       $ofico_emite->salida=$date;
       $ofico_emite->id_elabora=$id_genero;
       $ofico_emite->observaciones=$observaciones;
       $ofico_emite->estado="PENDIENTE";
       $ofico_emite->captura=$user;
       $ofico_emite->id_ciclo=$ciclo->id;
       $ofico_emite->save();
       $ultimo = OficiosEmitidosModel::orderBy('id', 'desc')->first()->id;



       for ($i=0; $i < $elementos ; $i++) {
        $reclamo = new ReclamosModel;
        $reclamo->id_captura=$name[$x];
        $x=$x+1;

        $reclamo->id_ciclo=$ciclo->id;
        $reclamo->total_dias=$name[$x];
        $reclamo->observaciones=$observaciones;
        $reclamo->oficio=$oficio;
        $reclamo->id_oficio=$ultimo;
        $reclamo->motivo=$motivo;
        $reclamo->estado="ACTIVO";
        $reclamo->captura=$user;


        $x=$x+1;
        $reclamo->periodo_inicial=$name[$x];
        $x=$x+1;
        $reclamo->periodo_final=$name[$x];
        $x=$x+1;
        $reclamo->total_reclamo=$name[$x];
        $x=$x+1;
        $reclamo->save();
            # code...
      }
      $reclamos=ReclamosModel::join('captura','captura.id','=','reclamos.id_captura')->join('centro_trabajo','centro_trabajo.id','=','captura.id_cct_etc')->select('captura.categoria','captura.nombre','captura.rfc','centro_trabajo.cct','reclamos.*')->where('id_oficio','=',$ultimo)->where('reclamos.estado','=','ACTIVO')->where('reclamos.id_ciclo','=',$ciclo->id)->get();
      $cuenta=count($reclamos);

      $view =  \View::make('nomina.reclamos.invoice', compact('cuenta_copia_t','cuenta_copia','name6','name_vo_1','dirigido_puesto','dirigido_nombrec','dirigido_lic','cuenta','reclamos','motivo','date','oficio','qna_aux','year_aux','genero'))->render();
        //->setPaper($customPaper, 'landscape');
      $pdf = \App::make('dompdf.wrapper');
      $pdf->loadHTML($view);
      return $pdf->stream('invoice.pdf');
        //
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
              $tipo_usuario = Auth::user()->tipo_usuario;
      if($tipo_usuario <> "2" || $tipo_usuario=="5"){
       return view('permisos');

      }else{
      $pagos=DB::table('tabla_pagos')->get();
      $genero=DB::table('directoriointerno')->where('estado','=','ACTIVO')->get();
      $dirigido=DB::table('directorioexterno')->where('estado','=','ACTIVO')->get();
      $ciclos=DB::table('ciclo_escolar')->get();

      $id_rec=DB::table('reclamos')->where('id','=',$id)->first();

      $reclamo=ReclamosModel::join('oficiosemitidos','oficiosemitidos.id','=','reclamos.id_oficio')->select('reclamos.*','oficiosemitidos.id_elabora','oficiosemitidos.salida','oficiosemitidos.num_oficio')->where('reclamos.id','=',$id)->first();

      $captura=DB::table('captura')->join('centro_trabajo','centro_trabajo.id','=','captura.id_cct_etc')->where('captura.estado','=','ACTIVO')->where('captura.pagos_registrados','=','0')->select('captura.id','captura.rfc','captura.fecha_inicio','captura.fecha_termino','captura.nombre','captura.categoria','centro_trabajo.nombre_escuela','centro_trabajo.cct')->where('captura.id','=',$id_rec->id_captura)->get();

      $captura2=DB::table('captura')->join('centro_trabajo','centro_trabajo.id','=','captura.id_cct_etc')->where('captura.estado','=','ACTIVO')->where('captura.pagos_registrados','=','0')->select('captura.id','captura.rfc','captura.fecha_inicio','captura.fecha_termino','captura.nombre','captura.categoria','centro_trabajo.nombre_escuela','centro_trabajo.cct')->where('captura.id','=',$id_rec->id_captura)->first();
      return view('nomina.reclamos.edit', ['captura2'=>$captura2,'reclamo'=>$reclamo,'pagos'=> $pagos,'genero'=>$genero,'ciclos'=>$ciclos,'dirigido'=>$dirigido,'captura'=>$captura]);
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
      //QUIEN ELABORO EL OFICIO
      $genero_aux=$request->get('genero');
        //$first = head($genero_aux);
      $name = explode("_",$genero_aux);
      $genero=$name[0];
      $id_genero=$name[1];

              //A QUIEN VA DIRIGIDO EL OFICIO
      $dirigido_aux=$request->get('dirigido_a');
      $name4 = explode("_",$dirigido_aux);
      $dirigido_puesto=$name4[0];
      $dirigido_nombrec=$name4[1];
      $id_dirigido=$name4[2];
      $dirigido_lic=$name4[3];


      $ciclo_aux=$request->get('ciclo_escolar');
        //
      $ciclo=DB::table('ciclo_escolar')->where('ciclo','=',$ciclo_aux)->first();

      $reclamo=ReclamosModel::findOrFail($id);
      $id_oficio_aux=$reclamo->id_oficio;
      $oficio=OficiosEmitidosModel::findOrFail($id_oficio_aux);
      $oficio->num_oficio=$request->get('oficio_aux');
      $oficio->nombre_oficio=$request->get('oficio');
      $oficio->id_dirigido=$id_dirigido;
      $oficio->asunto="Solicitud de Pago";
      $oficio->referencia="Nomina PETC";
      $oficio->salida=$request->get('fecha');
      $oficio->id_elabora=$id_genero;
      $oficio->observaciones=$request->get('observaciones');
      $oficio->estado="PENDIENTE";
      $oficio->captura=$user;
      $oficio->id_ciclo=$ciclo->id;
      $oficio->update();


      $reclamo->id_ciclo=$ciclo->id;
      $reclamo->total_dias=$request->get('dias');
      $reclamo->motivo=$request->get('motivo');
      $reclamo->periodo_inicial=$request->get('fechai');
      $reclamo->periodo_final=$request->get('fechaf');
      $reclamo->total_reclamo=$request->get('total');
      $reclamo->observaciones=$request->get('observaciones');
      $reclamo->captura=$user;
      $reclamo->oficio=$request->get('oficio');
      $reclamo->id_oficio=$oficio->id;
      $reclamo->estado="PENDIENTE";
      $reclamo->update();

      return Redirect::to('reclamos2/2');


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
     $reclamos = ReclamosModel::find($id);
     $reclamos->estado='PENDIENTE';
     $reclamos->update();
     return Redirect::to('reclamos2/1');

        //
   }}

   public function valida_reclamos($dia, $mes, $year){

    $dia=intval($dia);

    if($mes == 1){
      $mes_aux="ENERO";
    }elseif ($mes == 2) {
      $mes_aux="FEBRERO";
    }elseif ($mes == 3) {
      $mes_aux="MARZO";
    }elseif ($mes == 4) {
      $mes_aux="ABRIL";
    }elseif ($mes == 5) {
      $mes_aux="MAYO";
    }elseif ($mes == 6) {
      $mes_aux="JUNIO";
    }elseif ($mes == 7) {
      $mes_aux="JULIO";
    }elseif ($mes == 8) {
      $mes_aux="AGOSTO";
    }elseif ($mes ==9) {
      $mes_aux="SEPRIEMBRE";
    }elseif ($mes == 10) {
      $mes_aux="OCTUBRE";
    }elseif ($mes == 11) {
      $mes_aux="NOVIEMBRE";
    }elseif ($mes == 12) {
      $mes_aux="DICIEMBRE";
    }


    $dia= DiasMesModel::
    select('id','tipo_dia')
    ->where('dia','=',$dia)->where('mes','=',$mes_aux)->where('año','=',$year)->where('tipo_dia','=','HABIL')
    ->get();

    return response()->json(
      $dia->toArray());
  }


  public function calcular_reclamo($dias, $categoria, $ciclo){

    if($categoria == "DOCENTE"){
      $monto=TabuladorPagosModel::select('pago_docente')->where('ciclo','=',$ciclo)->first();
      $monto2= $monto->pago_docente * $dias;

    }elseif($categoria == "DIRECTOR"){
      $monto=TabuladorPagosModel::select('pago_director')->where('ciclo','=',$ciclo)->first();
      $monto2= $monto->pago_director * $dias;


    }elseif($categoria == "INTENDENTE"){
      $monto=TabuladorPagosModel::select('pago_intendente')->where('ciclo','=',$ciclo)->first();
      $monto2= $monto->pago_intendente * $dias;


    }elseif($categoria == "USAER"){
      $monto=TabuladorPagosModel::select('pago_docente')->where('ciclo','=',$ciclo)->first();
      $monto2= $monto->pago_docente * $dias;


    }elseif($categoria == "EDUCACION FISICA"){
      $monto=TabuladorPagosModel::select('pago_docente')->where('ciclo','=',$ciclo)->first();
      $monto2= $monto->pago_docente * $dias;

    }

    return response()->json(
      $monto2);

  }

  public function buscar_qnas($ciclo_aux){
    $ciclo=DB::table('ciclo_escolar')->where('ciclo','=',$ciclo_aux)->first();

    $qnas= TablaPagosModel::
    select('qna')
    ->where('id_ciclo','=',$ciclo->id)
    ->get();
    return response()->json(
      $qnas);
  }

  public function excel(Request $request, $aux)
  {

   Excel::create('REGISTRO DE RECLAMOS', function($excel) use($aux) {
     $excel->sheet('Excel sheet', function($sheet) use($aux) {
       $personal = ReclamosModel::join('ciclo_escolar','ciclo_escolar.id','=','reclamos.id_ciclo')->join('captura','captura.id','=','reclamos.id_captura')->join('centro_trabajo','centro_trabajo.id','=','captura.id_cct_etc')->join('region','region.id','=','centro_trabajo.id_region')->where('reclamos.id_ciclo','=',$aux)->select('reclamos.id','captura.nombre','captura.rfc','centro_trabajo.cct','centro_trabajo.nombre_escuela','region.region','region.sostenimiento','reclamos.periodo_inicial','reclamos.periodo_final','reclamos.total_dias','reclamos.total_reclamo','reclamos.estado','ciclo_escolar.ciclo','reclamos.observaciones','reclamos.oficio','reclamos.motivo')->get();
       $sheet->fromArray($personal);
       $sheet->row(1,['ID','NOMBRE','RFC','CCT','NOMBRE ESCUELA','REGION','SOSTENIMIENTO','FECHA INICIAL','FECHA FINAL','TOTAL DE DIAS HABILES','MONTO TOTAL','ESTADO','CICLO ESCOLAR','OBSERVACIONES','N° OFICIO','MOTIVO']);
       $sheet->setOrientation('landscape');
     });
   })->export('xls');
 }

 public function activar($id){
          $tipo_usuario = Auth::user()->tipo_usuario;
      if($tipo_usuario <> "2" || $tipo_usuario=="5"){
       return view('permisos');

      }else{
  $user = Auth::user()->name;
   $reclamos = ReclamosModel::find($id);
   $reclamos->estado='APLICADO';
   $reclamos->update();
   return Redirect::to('reclamos2/1');

 }}

 public function ver_reclamos(){
  $ciclos=DB::table('ciclo_escolar')->get();
  $regiones=DB::table('region')->where('estado','=','ACTIVO')->get();

  return view('nomina.reclamos.ver_reclamos', ['ciclos'=>$ciclos,'regiones'=>$regiones]);

}

public function busca_dias_reclamo($ciclo){
  $reclamos=DB::table('reclamos')->join('captura','captura.id','=','reclamos.id_captura')->where('reclamos.id_ciclo','=',$ciclo)->select('reclamos.total_dias','reclamos.total_reclamo','reclamos.estado','captura.categoria','captura.sostenimiento')->get();
  return response()->json(
    $reclamos);

}

public function busca_dias_reclamo_region($region,$ciclo){
  if ($region == "todas") {
    $reclamos=DB::table('reclamos')->join('captura','captura.id','=','reclamos.id_captura')->join('centro_trabajo','centro_trabajo.id','=','captura.id_cct_etc')->join('region','region.id','=','centro_trabajo.id_region')->where('reclamos.id_ciclo','=',$ciclo)->select('region.region','region.sostenimiento','reclamos.total_dias','reclamos.total_reclamo','reclamos.estado','captura.categoria','captura.pagos_registrados','captura.qna_actual')->get();
      # code...
  }else{
    $reclamos=DB::table('reclamos')->join('captura','captura.id','=','reclamos.id_captura')->join('centro_trabajo','centro_trabajo.id','=','captura.id_cct_etc')->join('region','region.id','=','centro_trabajo.id_region')->where('centro_trabajo.id_region','=',$region)->where('reclamos.id_ciclo','=',$ciclo)->select('region.region','region.sostenimiento','reclamos.total_dias','reclamos.total_reclamo','reclamos.estado','captura.categoria','captura.pagos_registrados','captura.qna_actual')->get();
  }
  return response()->json(
    $reclamos);

}

public function invoice($ciclo){
  $ciclo_aux=DB::table('ciclo_escolar')->where('id','=',$ciclo)->first();


  $reclamos=DB::table('reclamos')->join('captura','captura.id','=','reclamos.id_captura')->where('reclamos.id_ciclo','=',$ciclo)
  ->select(DB::raw('SUM(reclamos.total_dias) as total_dias'),
    DB::raw('SUM(reclamos.total_reclamo) as total_reclamo'),
    DB::raw('COUNT(reclamos.estado) as reclamos_count'),
    'captura.categoria')->first();

  $reclamos_director=DB::table('reclamos')->join('captura','captura.id','=','reclamos.id_captura')->where('reclamos.id_ciclo','=',$ciclo)->where('captura.categoria','=','DIRECTOR')
  ->select(DB::raw('COUNT(reclamos.estado) as reclamos_director'),
    'captura.categoria')->first();

  $reclamos_docente=DB::table('reclamos')->join('captura','captura.id','=','reclamos.id_captura')->where('reclamos.id_ciclo','=',$ciclo)->where('captura.categoria','=','DOCENTE')->orwhere('captura.categoria','=','USAER')->orwhere('captura.categoria','=','EDUCACION FISICA')
  ->select(DB::raw('COUNT(reclamos.estado) as reclamos_docente'),
    'captura.categoria')->first();

  $reclamos_intendente=DB::table('reclamos')->join('captura','captura.id','=','reclamos.id_captura')->where('reclamos.id_ciclo','=',$ciclo)->where('captura.categoria','=','INTENDENTE')
  ->select(DB::raw('COUNT(reclamos.estado) as reclamos_intendente'),
    'captura.categoria')->first();

  $reclamos_resueltos=DB::table('reclamos')->join('captura','captura.id','=','reclamos.id_captura')->where('reclamos.id_ciclo','=',$ciclo)->where('reclamos.estado','=','APLICADO')
  ->select(DB::raw('COUNT(reclamos.estado) as reclamos_resueltos'),
    'captura.categoria')->first();
  $reclamos_pendientes=DB::table('reclamos')->join('captura','captura.id','=','reclamos.id_captura')->where('reclamos.id_ciclo','=',$ciclo)->where('reclamos.estado','=','PENDIENTE')
  ->select(DB::raw('COUNT(reclamos.estado) as reclamos_pendientes'),
    'captura.categoria')->first();

  for ($i=1; $i <= 26 ; $i++) {



    ${"reclamos_region".$i}=DB::table('region')->join('centro_trabajo','centro_trabajo.id_region','=','region.id')->join('captura','captura.id_cct_etc','=','centro_trabajo.id')->join('reclamos','reclamos.id_captura','=','captura.id')->where('reclamos.id_ciclo','=',$ciclo)->where('centro_trabajo.id_region','=',$i)
    ->select(DB::raw('SUM(reclamos.total_dias) as total_dias'),
      DB::raw('SUM(reclamos.total_reclamo) as total_reclamo'),
      DB::raw('COUNT(reclamos.estado) as reclamos_count'),
      'captura.categoria','region.region','region.sostenimiento')->first();




    ${"reclamos_region".$i}=DB::table('reclamos')->join('captura','captura.id','=','reclamos.id_captura')->join('centro_trabajo','centro_trabajo.id','=','captura.id_cct_etc')->join('region','region.id','=','centro_trabajo.id_region')->where('reclamos.id_ciclo','=',$ciclo)->where('centro_trabajo.id_region','=',$i)
    ->select(DB::raw('SUM(reclamos.total_dias) as total_dias'),
      DB::raw('SUM(reclamos.total_reclamo) as total_reclamo'),
      DB::raw('COUNT(reclamos.estado) as reclamos_count'),
      'captura.categoria','region.region','region.sostenimiento')->first();

    ${"reclamos_region_di".$i}=DB::table('reclamos')->join('captura','captura.id','=','reclamos.id_captura')->join('centro_trabajo','centro_trabajo.id','=','captura.id_cct_etc')->where('reclamos.id_ciclo','=',$ciclo)->where('centro_trabajo.id_region','=',$i)->where('captura.categoria','=','DIRECTOR')
    ->select(DB::raw('COUNT(reclamos.estado) as reclamos_director'),
      'captura.categoria')->first();

    ${"reclamos_region_do".$i}=DB::table('reclamos')->join('captura','captura.id','=','reclamos.id_captura')->join('centro_trabajo','centro_trabajo.id','=','captura.id_cct_etc')->where('reclamos.id_ciclo','=',$ciclo)->where('centro_trabajo.id_region','=',$i)->where('captura.categoria','=','DOCENTE')->orwhere('captura.categoria','=','USAER')->orwhere('captura.categoria','=','EDUCACION FISICA')
    ->select(DB::raw('COUNT(reclamos.estado) as reclamos_docente'),
      'captura.categoria')->first();

    ${"reclamos_region_in".$i}=DB::table('reclamos')->join('captura','captura.id','=','reclamos.id_captura')->join('centro_trabajo','centro_trabajo.id','=','captura.id_cct_etc')->join('region','region.id','=','centro_trabajo.id_region')->where('reclamos.id_ciclo','=',$ciclo)->where('centro_trabajo.id_region','=',$i)->where('captura.categoria','=','INTENDENTE')
    ->select(DB::raw('COUNT(reclamos.estado) as reclamos_intendente'),
      'captura.categoria')->first();

    ${"reclamos_region_apli".$i}=DB::table('reclamos')->join('captura','captura.id','=','reclamos.id_captura')->join('centro_trabajo','centro_trabajo.id','=','captura.id_cct_etc')->join('region','region.id','=','centro_trabajo.id_region')->where('reclamos.id_ciclo','=',$ciclo)->where('reclamos.estado','=','APLICADO')->where('centro_trabajo.id_region','=',$i)
    ->select(DB::raw('COUNT(reclamos.estado) as reclamos_resueltos'),
      'captura.categoria')->first();

    ${"reclamos_region_pend".$i}=DB::table('reclamos')->join('captura','captura.id','=','reclamos.id_captura')->join('centro_trabajo','centro_trabajo.id','=','captura.id_cct_etc')->join('region','region.id','=','centro_trabajo.id_region')->where('reclamos.id_ciclo','=',$ciclo)->where('reclamos.estado','=','PENDIENTE')->where('centro_trabajo.id_region','=',$i)
    ->select(DB::raw('COUNT(reclamos.estado) as reclamos_pendientes'),
      'captura.categoria')->first();
  }

  $view =  \View::make('nomina.reclamos.invoice2', compact('ciclo_aux','reclamos_resueltos','reclamos_pendientes','reclamos','reclamos_director','reclamos_docente','reclamos_intendente','reclamos_region1','reclamos_region_di1','reclamos_region_do1','reclamos_region_in1','reclamos_region_apli1','reclamos_region_pend1','reclamos_region2','reclamos_region_di2','reclamos_region_do2','reclamos_region_in2','reclamos_region_apli2','reclamos_region_pend2','reclamos_region3','reclamos_region_di3','reclamos_region_do3','reclamos_region_in3','reclamos_region_apli3','reclamos_region_pend3','reclamos_region4','reclamos_region_di4','reclamos_region_do4','reclamos_region_in4','reclamos_region_apli4','reclamos_region_pend4','reclamos_region5','reclamos_region_di5','reclamos_region_do5','reclamos_region_in5','reclamos_region_apli5','reclamos_region_pend5','reclamos_region6','reclamos_region_di6','reclamos_region_do6','reclamos_region_in6','reclamos_region_apli6','reclamos_region_pend6','reclamos_region7','reclamos_region_di7','reclamos_region_do7','reclamos_region_in7','reclamos_region_apli7','reclamos_region_pend7','reclamos_region8','reclamos_region_di8','reclamos_region_do8','reclamos_region_in8','reclamos_region_apli8','reclamos_region_pend8','reclamos_region9','reclamos_region_di9','reclamos_region_do9','reclamos_region_in9','reclamos_region_apli9','reclamos_region_pend9','reclamos_region10','reclamos_region_di10','reclamos_region_do10','reclamos_region_in10','reclamos_region_apli10','reclamos_region_pend10','reclamos_region11','reclamos_region_di11','reclamos_region_do11','reclamos_region_in11','reclamos_region_apli11','reclamos_region_pend11','reclamos_region12','reclamos_region_di12','reclamos_region_do12','reclamos_region_in12','reclamos_region_apli12','reclamos_region_pend12','reclamos_region13','reclamos_region_di13','reclamos_region_do13','reclamos_region_in13','reclamos_region_apli13','reclamos_region_pend13','reclamos_region14','reclamos_region_di14','reclamos_region_do14','reclamos_region_in14','reclamos_region_apli14','reclamos_region_pend14','reclamos_region15','reclamos_region_di15','reclamos_region_do15','reclamos_region_in15','reclamos_region_apli15','reclamos_region_pend15','reclamos_region16','reclamos_region_di16','reclamos_region_do16','reclamos_region_in16','reclamos_region_apli16','reclamos_region_pend16','reclamos_region17','reclamos_region_di17','reclamos_region_do17','reclamos_region_in17','reclamos_region_apli17','reclamos_region_pend17','reclamos_region18','reclamos_region_di18','reclamos_region_do18','reclamos_region_in18','reclamos_region_apli18','reclamos_region_pend18','reclamos_region19','reclamos_region_di19','reclamos_region_do19','reclamos_region_in19','reclamos_region_apli19','reclamos_region_pend19','reclamos_region20','reclamos_region_di20','reclamos_region_do20','reclamos_region_in20','reclamos_region_apli20','reclamos_region_pend20','reclamos_region21','reclamos_region_di21','reclamos_region_do21','reclamos_region_in21','reclamos_region_apli21','reclamos_region_pend21','reclamos_region22','reclamos_region_di22','reclamos_region_do22','reclamos_region_in22','reclamos_region_apli22','reclamos_region_pend22','reclamos_region23','reclamos_region_di23','reclamos_region_do23','reclamos_region_in23','reclamos_region_apli23','reclamos_region_pend23','reclamos_region24','reclamos_region_di24','reclamos_region_do24','reclamos_region_in24','reclamos_region_apli24','reclamos_region_pend24','reclamos_region25','reclamos_region_di25','reclamos_region_do25','reclamos_region_in25','reclamos_region_apli25','reclamos_region_pend25','reclamos_region26','reclamos_region_di26','reclamos_region_do26','reclamos_region_in26','reclamos_region_apli26','reclamos_region_pend26'))->render();
        //->setPaper($customPaper, 'landscape');
  $pdf = \App::make('dompdf.wrapper');
  $pdf->loadHTML($view);
  return $pdf->stream('invoice.pdf');
    # code...





}


}
