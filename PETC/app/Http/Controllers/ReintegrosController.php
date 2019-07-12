<?php

namespace petc\Http\Controllers;

use Illuminate\Http\Request;

use petc\Http\Requests;
use petc\Http\Controllers\Controller;

use DB;
use petc\CapturaModel;
use petc\DirectorioRegionalModel;
use petc\ReintegrosModel;
use petc\DiasMesModel;
use petc\TabuladorPagosModel;
use petc\OficiosEmitidosModel;
use petc\TablaPagosModel;
use Maatwebsite\Excel\Facades\Excel;
use PHPExcel_Worksheet_Drawing;
use Validator;
use \Milon\Barcode\DNS1D;
use \Milon\Barcode\DNS2D;
use petc\Http\Requests\ReintegrosRequest;


class ReintegrosController extends Controller
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
       $reintegros = DB::table('reintegros')
       ->join('centro_trabajo','reintegros.id_centro_trabajo', '=', 'centro_trabajo.id' ) //cct
       ->join('captura','reintegros.id_captura', '=', 'captura.id' ) //nombre, sostenimiento, categoria
       ->join('directorio_regional','reintegros.id_directorio_regional', '=', 'directorio_regional.id' ) //director_regional,sostenimiento
       ->join('region','reintegros.id_region', '=', 'region.id' ) //region

       ->select('reintegros.id as id','reintegros.id_centro_trabajo','reintegros.id_captura','reintegros.id_directorio_regional','reintegros.id_ciclo'
       ,'reintegros.num_dias','reintegros.total','reintegros.oficio','reintegros.motivo','reintegros.estado'
       ,'reintegros.captura','reintegros.created_at'
       ,'centro_trabajo.cct'
       ,'captura.nombre','captura.categoria'
       ,'directorio_regional.director_regional','directorio_regional.id_region')

       ->where('reintegros.total','LIKE','%'.$query.'%')
       ->orwhere('reintegros.oficio','LIKE','%'.$query.'%')
       ->orwhere('reintegros.motivo','LIKE','%'.$query.'%')
       ->orwhere('reintegros.estado','LIKE','%'.$query.'%')
       ->orwhere('centro_trabajo.cct','LIKE','%'.$query.'%')
       ->orwhere('captura.nombre','LIKE','%'.$query.'%')
       ->orwhere('directorio_regional.director_regional','LIKE','%'.$query.'%')
       ->paginate(24);
       //print_r($listas);
      return view('nomina.reintegros.index',["reintegros"=>$reintegros,"searchText"=>$query]);

    }
}
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $pagos=DB::table('tabla_pagos')->get();
      $genero=DB::table('directoriointerno')->where('estado','=','ACTIVO')->get();
      $dirigido=DB::table('directorioexterno')->where('estado','=','ACTIVO')->get();
      $cct= DB::table('centro_trabajo')->get();
      $captura= DB::table('captura')->get();
      $directorio_regional=DB::table('directorio_regional')->get();
      $tabla= DB::table('tabulador_pagos')->get();
      $ciclos=DB::table('ciclo_escolar')->get();
      return view("nomina.reintegros.create",['ciclos'=>$ciclos,"pagos"=>$pagos,"genero"=>$genero,"dirigido"=>$dirigido,"directorio_regional"=>$directorio_regional,"captura"=>$captura,"cct"=>$cct,"tabla"=>$tabla]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

       $ofico_emite= new OficiosEmitidosModel;
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
        $first5 = ($visto_bueno_aux);
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
       $first6 = ($copia_aux);
       $name6 = explode(",",$first6);
       $cuenta_copia= count($name6);
       $cuenta_copia_t=$cuenta_copia/5;



       $ciclo=DB::table('ciclo_escolar')->where('ciclo','=',$ciclo_aux)->first();
       $elementos= $request->get('total');
       $x=0;
       $producto = $request->get('codigo2');
       $first = ($producto);
       $name = explode(",",$first);


       $ofico_emite->num_oficio=$oficio_aux;
       $ofico_emite->id_dirigido=$id_dirigido;
       $ofico_emite->asunto="Solicitud de Pago";
       $ofico_emite->referencia="Nomina PETC";
       $ofico_emite->salida=$date;
       $ofico_emite->id_elabora=$id_genero;
       $ofico_emite->observaciones=$observaciones;
       $ofico_emite->estado="PENDIENTE";
       $ofico_emite->captura="ADMINISTRADOR";
       $ofico_emite->id_ciclo=$ciclo->id;
       $ofico_emite->save();

      $reintegros= new ReintegrosModel;

      $id_cap=$request->get('id_captura');
      //$first=head($id_cct);
      $name=explode("_",$id_cap);
      $reintegros -> id_captura = $name[2];

      $reintegros -> id_centro_trabajo = $request ->id_centro_trabajo;

      $reintegros -> id_directorio_regional = $request ->id_directorio_regional;


      $reintegros -> id_ciclo = $request ->id_ciclo;

      $reintegros -> num_dias = $request ->num_dias;
      //$reintegros -> categoria = $request ->categoria;
      $reintegros -> total = $request ->total;

      $reintegros -> motivo = $request ->motivo;

      $reintegros -> estado = "ACTIVO";
      $reintegros -> captura = "ADMINISTRADOR";



      $reintegros=ReintegrosModel::join('captura','reintegros.id_captura', '=', 'captura.id' ) //nombre, sostenimiento, categoria
      ->join('centro_trabajo','centro_trabajo.id','=','captura.id_cct_etc')
      ->select('captura.categoria','captura.nombre','captura.rfc','centro_trabajo.cct','reintegros.*')
      ->where('oficio','=',$oficio)
      ->where('reintegros.estado','=','ACTIVO')
      ->where('reintegros.id_ciclo','=',$ciclo->id)->get();
      $cuenta=count($reintegros);

      $view =  \View::make('nomina.reintegros.invoice', compact('cuenta_copia_t','cuenta_copia','name6','name_vo_1','dirigido_puesto','dirigido_nombrec','dirigido_lic','cuenta','reintegros','motivo','date','oficio','qna_aux','year_aux','genero'))->render();
        //->setPaper($customPaper, 'landscape');
      $pdf = \App::make('dompdf.wrapper');
      $pdf->loadHTML($view);
      return $pdf->stream('invoice.pdf');
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

    public function traerpersonal(Request $request,$cct)
      {
        $personal= CapturaModel::
        select('id','categoria','nombre','sostenimiento', 'estado')
        ->where('id_cct_etc','=',$cct)->where('estado','=','ACTIVO')
        ->get();

        return response()->json(
          $personal->toArray());
}

public function traerdire(Request $request,$dire)
  {
    $director= DirectorioRegionalModel::select('id','director_regional', 'estado')
    ->where('id_region','=',$dire)->where('estado','=','ACTIVO')
    ->get();

    return response()->json(
      $director->toArray());
}



}
