<?php

namespace petc\Http\Controllers;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use petc\Http\Requests;
use petc\Http\Controllers\Controller;

use petc\ListasAsistenciaModel;
use petc\CentroTrabajoModel;

use DB;
use Maatwebsite\Excel\Facades\Excel;
use PHPExcel_Worksheet_Drawing;
use Validator;
use \Milon\Barcode\DNS1D;
use \Milon\Barcode\DNS2D;
use petc\Http\Requests\ListaAsistenciasRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Collection as Collection;
class ListasAsistenciasController extends Controller
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
       $query=trim($request->GET('searchText'));
       $ciclos=DB::table('ciclo_escolar')->get();
       $query2=trim($request->GET('ciclo_escolar'));
       $listas = DB::table('listas_de_asistencias')
       ->join('centro_trabajo','listas_de_asistencias.id_centro_trabajo', '=', 'centro_trabajo.id' )
       ->select('centro_trabajo.id_region as id_region' )
       ->join('region','centro_trabajo.id_region', '=' ,'region.id')
       ->join('ciclo_escolar','listas_de_asistencias.id_ciclo', '=','ciclo_escolar.id')

       ->select('listas_de_asistencias.id as id','listas_de_asistencias.id_centro_trabajo','listas_de_asistencias.mes'
       ,'listas_de_asistencias.estado','listas_de_asistencias.observaciones','listas_de_asistencias.captura',
       'centro_trabajo.nombre_escuela','centro_trabajo.cct','region.region','region.sostenimiento','ciclo_escolar.ciclo','listas_de_asistencias.created_at')
       ->where('nombre_escuela','LIKE','%'.$query.'%')
       ->orwhere('centro_trabajo.cct','LIKE','%'.$query.'%')
       ->orwhere('ciclo_escolar.ciclo','LIKE','%'.$query.'%')
       ->orwhere('region.region','LIKE','%'.$query.'%')
       ->where('ciclo_escolar','=',$query2)
       ->paginate(24);
       //print_r($listas);
      return view('nomina.listas_asistencias.index',["listas"=>$listas,"searchText"=>$query,"ciclo_escolar"=>$query2,"ciclos"=>$ciclos]);
      // return view('nomina.tabla_pagos.index',['tabla_pagos' => $tabla_pagos,'ciclos'=> $ciclos]);
      //




       //$listas = ListasAsistenciaModel::orderBy('id', 'DESC')
        //                    ->paginate(24);

      //return view('nomina.listas_asistencias.index',['listas'=>$listas]);

        //
    }
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
       $ciclos=DB::table('ciclo_escolar')->get();
      $escuelas=DB::table('centro_trabajo')->get();
      $regiones=DB::table('region')->where('estado','=','ACTIVO')->get();

      $cct= DB::table('centro_trabajo')->get();
      return view("nomina.listas_asistencias.create",["escuelas"=>$escuelas,"cct"=>$cct,'ciclos'=>$ciclos,'regiones'=>$regiones]);

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


      $lista= new ListasAsistenciaModel;

      $id_cct=$request->get('cct');
      //$first=head($id_cct);
      $name=explode("_",$id_cct);
      $lista -> id_centro_trabajo = $name[2];
      $lista -> id_ciclo =$request ->ciclo_escolar;
      $lista -> mes = $request ->mes;
      $lista -> estado = "ACTIVO";
      $lista -> observaciones = $request ->observaciones;
      $lista -> captura=$user;

      if($lista->save()){

        return redirect('/listas_asistencias');

      }else {
      return view('listas_asistencias.create');
      }
    }}

    //convertir y descargar pdf

    public function invoice($id){
        $listas= DB::table('listas_de_asistencias')
        ->join('centro_trabajo','listas_de_asistencias.id_centro_trabajo', '=', 'centro_trabajo.id' )
         ->join('region','centro_trabajo.id_region', '=' ,'region.id')
        ->select('listas_de_asistencias.*','centro_trabajo.nombre_escuela','centro_trabajo.cct as cct','region.region')->where('listas_de_asistencias.id_ciclo','=',$id)->get();
        //$centro_trabajo= DB::table('centro_trabajo')->where('cct','=',$id)->first();
         //$material   = AlmacenMaterial:: findOrFail($id);
        //$customPaper = array(0,0,567.00,283.80);

        $date = date('Y-m-d');
        $invoice = "2222";
        $view =  \View::make('nomina.listas_asistencias.invoice', compact('date', 'invoice','listas'))->render();
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
              $tipo_usuario = Auth::user()->tipo_usuario;
      if($tipo_usuario <> "2" || $tipo_usuario=="5"){
       return view('permisos');

      }else{
      $listas = ListasAsistenciaModel::find($id);
      $escuelas=DB::table('centro_trabajo')->get();
      $cct= DB::table('centro_trabajo')->get();
      return view("nomina.listas_asistencias.edit",["listas"=>$listas,"escuelas"=>$escuelas,"cct"=>$cct]);
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

      $listas = ListasAsistenciaModel::find($id);

      $id_cct=$request->get('cct');
      //$first=head($id_cct);
      $name=explode("_",$id_cct);
      $listas -> id_centro_trabajo = $name[2];
      //$listas -> region = $request ->region;
      $listas -> mes = $request ->mes;
      $listas -> estado = "ACTIVO";
      $listas -> observaciones = $request ->observaciones;
      $listas -> captura=$user;

      if($listas->save()){

        return redirect('/listas_asistencias');

      }else {
      return view('listas_asistencias.index');
      }
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
      $lista=ListasAsistenciaModel::findOrFail($id);
      $lista->estado="INACTIVO";
      $lista->captura=$user;
      $lista->update();
        return redirect('listas_asistencias');
    }}

    ////////////exel////////////////

    public function excel(Request $request)
    {

     Excel::create('listas_asistencias', function($excel) {
         $excel->sheet('Excel sheet', function($sheet) {

             $tabla = ListasAsistenciaModel::join('centro_trabajo','listas_de_asistencias.id_centro_trabajo', '=', 'centro_trabajo.id')
              ->join('region','centro_trabajo.id_region', '=' ,'region.id')
             ->select('centro_trabajo.cct','centro_trabajo.nombre_escuela','region.region','listas_de_asistencias.mes'
             ,'listas_de_asistencias.observaciones','listas_de_asistencias.estado')
             ->get();
             $sheet->fromArray($tabla);
             $sheet->row(1,['CCT','NOMBRE ESCUELA','REGION','MES','OBSERVACIONES','ESTADO']);
             $sheet->setOrientation('landscape');
         });
     })->export('xls');
 }


 public function ver_listas(){
  $ciclos=DB::table('ciclo_escolar')->get();
  $regiones=DB::table('region')->where('estado','=','ACTIVO')->get();

  return view('nomina.listas_asistencias.ver_listas', ['ciclos'=>$ciclos,'regiones'=>$regiones]);

}

 public function busca_listas($ciclo){


   $lista= ListasAsistenciaModel::select('id','estado')
   ->where('id_ciclo','=',$ciclo)
   ->get();

   return response()->json(
    $lista->toArray());
 }

  public function busca_listas_region($ciclo,$region){


   $lista= ListasAsistenciaModel::join('centro_trabajo','centro_trabajo.id','=','listas_de_asistencias.id_centro_trabajo')->select('listas_de_asistencias.id','listas_de_asistencias.estado')
   ->where('listas_de_asistencias.id_ciclo','=',$ciclo)->where('centro_trabajo.id_region','=',$region)
   ->get();

   return response()->json(
    $lista->toArray());
 }

   public function busca_listas_mes($ciclo,$region,$mes){


   $lista= ListasAsistenciaModel::join('centro_trabajo','centro_trabajo.id','=','listas_de_asistencias.id_centro_trabajo')->select('listas_de_asistencias.id','listas_de_asistencias.estado')
   ->where('listas_de_asistencias.id_ciclo','=',$ciclo)->where('centro_trabajo.id_region','=',$region)->where('listas_de_asistencias.mes','=',$mes)
   ->get();

   return response()->json(
    $lista->toArray());

 }


   public function excel2(Request $request, $aux)
  {

   Excel::create('REGISTRO DE LISTAS DE ASISTENCIA', function($excel) use($aux) {
     $excel->sheet('Excel sheet', function($sheet) use($aux) {
       $tabla = ListasAsistenciaModel::join('centro_trabajo','listas_de_asistencias.id_centro_trabajo', '=', 'centro_trabajo.id')
              ->join('region','centro_trabajo.id_region', '=' ,'region.id')
             ->select('centro_trabajo.cct','centro_trabajo.nombre_escuela','region.region','listas_de_asistencias.mes'
             ,'listas_de_asistencias.observaciones','listas_de_asistencias.estado')
             ->where('id_ciclo','=',$aux) ->get();
             $sheet->fromArray($tabla);
             $sheet->row(1,['CCT','NOMBRE ESCUELA','REGION','MES','OBSERVACIONES','ESTADO']);
             $sheet->setOrientation('landscape');
         });
     })->export('xls');
 }

 public function escuelas(Request $request,$esc)
   {
     $escuelas= CentroTrabajoModel::select('id','nombre_escuela','cct', 'estado')
     ->where('id_region','=',$esc)->where('estado','=','ACTIVO')
     ->get();

     return response()->json(
       $escuelas->toArray());
}

public function busca_listas_esc($region,$cct){
  if ($region == "todas") {
    $listas=DB::table('listas_de_asistencias')
    ->join('centro_trabajo','centro_trabajo.id','=','listas_de_asistencias.id_centro_trabajo')
    ->where('listas_de_asistencias.id_centro_trabajo','=',$cct)
    ->where('listas_de_asistencias.estado','=',"ACTIVO")
    ->select('listas_de_asistencias.mes','listas_de_asistencias.estado','centro_trabajo.nombre_escuela')->get();
      # code...
  }else{
    $listas=DB::table('listas_de_asistencias')
    ->join('centro_trabajo','centro_trabajo.id','=','listas_de_asistencias.id_centro_trabajo')
    ->where('centro_trabajo.id_region','=',$region)
    ->where('listas_de_asistencias.id_centro_trabajo','=',$cct)
    ->where('listas_de_asistencias.estado','=',"ACTIVO")
    ->select('listas_de_asistencias.mes','listas_de_asistencias.estado','centro_trabajo.nombre_escuela')->get();
  }
  return response()->json(
    $listas);

}


}
