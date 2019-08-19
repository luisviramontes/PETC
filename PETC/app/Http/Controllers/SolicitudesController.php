<?php

namespace petc\Http\Controllers;

use Illuminate\Http\Request;

use petc\Http\Requests;
use petc\Http\Controllers\Controller;


use petc\SolicitudesModel;

use DB;

use Maatwebsite\Excel\Facades\Excel;
use PHPExcel_Worksheet_Drawing;
use Validator;
use \Milon\Barcode\DNS1D;
use \Milon\Barcode\DNS2D;
use petc\Http\Requests\SolicitudesRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Collection as Collection;
class SolicitudesController extends Controller
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
    public function index(Request $request)
    {
      $tipo_usuario = Auth::user()->tipo_usuario;
      if($tipo_usuario <> "2" || $tipo_usuario=="5"){
       return view('permisos');

      }else{
      if($request)
      {
       $query2=trim($request->GET('ciclo_escolar'));
       $query=trim($request->GET('searchText'));
       $ciclos=DB::table('ciclo_escolar')->get();

       if($query == "" && $query2 == ""){
         $query2=2;
       $solicitudes = DB::table('solicitudes')
       ->join('municipios', 'solicitudes.id_municipio', '=','municipios.id')
       ->join('localidades', 'solicitudes.id_localidad', '=','localidades.id')
       ->join('centro_trabajo', 'solicitudes.id_cct', '=','centro_trabajo.id')
       ->join('ciclo_escolar', 'solicitudes.id_ciclo', '=','ciclo_escolar.id')

       ->where('solicitudes.id_ciclo','=',$query2)

       ->select('municipios.*','localidades.*','solicitudes.*','centro_trabajo.cct','ciclo_escolar.ciclo')


       ->paginate(10);




     }elseif ($query == "" && $query2 != "") {
       $solicitudes = DB::table('solicitudes')
       ->join('municipios', 'solicitudes.id_municipio', '=','municipios.id')
       ->join('localidades', 'solicitudes.id_localidad', '=','localidades.id')
       ->join('centro_trabajo', 'solicitudes.id_cct', '=','centro_trabajo.id')
       ->join('ciclo_escolar', 'solicitudes.id_ciclo', '=','ciclo_escolar.id')

       ->where('solicitudes.id_ciclo','=',$query2)

       ->select('municipios.*','localidades.*','solicitudes.*','centro_trabajo.cct','ciclo_escolar.ciclo')


       ->paginate(10);
     }else {
       $solicitudes = DB::table('solicitudes')
       ->join('municipios', 'solicitudes.id_municipio', '=','municipios.id')
       ->join('localidades', 'solicitudes.id_localidad', '=','localidades.id')
       ->join('centro_trabajo', 'solicitudes.id_cct', '=','centro_trabajo.id')
       ->join('ciclo_escolar', 'solicitudes.id_ciclo', '=','ciclo_escolar.id')


       ->select('municipios.*','localidades.*','solicitudes.*','centro_trabajo.cct','ciclo_escolar.ciclo')


       ->where('solicitudes.nombre_escuela','LIKE','%'.$query.'%')
       ->orwhere('centro_trabajo.cct','LIKE','%'.$query.'%')
       ->orwhere('localidades.nom_loc','LIKE','%'.$query.'%')
       ->orwhere('ciclo_escolar.ciclo','LIKE','%'.$query.'%')
       ->orwhere('municipios.municipio','LIKE','%'.$query.'%')
       ->where('solicitudes.id_ciclo','=',$query2)
       ->paginate(10);
     }

        return view('nomina.solicitudes.index',["solicitudes"=>$solicitudes,"searchText"=>$query,"ciclo_escolar"=>$query2,"ciclos"=>$ciclos]);
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

      $cct= DB::table('centro_trabajo')->get();
      $ciclo= DB::table('ciclo_escolar')->get();
      $municipios=DB::table('municipios')->get();
      $localidades= DB::table('localidades')->get();

      return view("nomina.solicitudes.create",[
        "municipios"=>$municipios
        ,"localidades"=>$localidades
        ,"cct"=>$cct
        ,"ciclo"=>$ciclo
      ]);
    }
  }

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
      $solicitudes= new SolicitudesModel;
      $solicitudes -> entrego_acta = $request ->entrego_acta;
      $solicitudes -> solicitud_inco = $request ->solicitud_inco;
      $solicitudes -> id_cct = $request ->cct;
      $solicitudes -> id_ciclo = $request ->ciclo;
      $solicitudes -> nombre_escuela = $request ->nombre_escuela;
      $solicitudes -> id_municipio=$request ->municipio;
      $solicitudes -> id_localidad=$request ->localidad;
      $solicitudes -> domicilio = $request ->domicilio;
      $solicitudes -> nivel = $request ->nivel;
      $solicitudes -> pnpsvd = $request ->pnpsvd;
      $solicitudes -> cnh = $request ->cnh;
      $solicitudes -> carta_compromiso = $request ->carta_compromiso;
      $solicitudes -> acta_constitutiva_cte = $request ->acta_constitutiva_cte;
      $solicitudes -> acta_cps = $request ->acta_cps;
      $solicitudes -> acta_ctcs = $request ->acta_ctcs;
      $solicitudes -> tramite_estado = $request ->tramite_estado;
      $solicitudes -> estado = 'ACTIVO';
      $solicitudes -> fecha_recepcion = $request ->fecha_recepcion;
      $solicitudes -> captura=$user;

      if($solicitudes->save()){

        return redirect('/solicitudes');

      }else {
      return view('solicitudes.index');
      }
    }}

    //convertir y descargar pdf

    public function invoice($id){
      $solicitudes = DB::table('solicitudes')
      ->join('municipios', 'solicitudes.id_municipio', '=','municipios.id')
      ->join('localidades', 'solicitudes.id_localidad', '=','localidades.id')
      ->join('centro_trabajo', 'solicitudes.id_cct', '=','centro_trabajo.id')
      ->join('ciclo_escolar', 'solicitudes.id_ciclo', '=','ciclo_escolar.id')

      ->select('municipios.*','localidades.*','solicitudes.*','centro_trabajo.cct','ciclo_escolar.ciclo')
      ->where('solicitudes.id_ciclo','=',$id)
      ->get();

        $date = date('Y-m-d');
        $invoice = "2222";
       // print_r($materiales);
        $view =  \View::make('nomina.solicitudes.invoice', compact('date', 'invoice','solicitudes'))->render();
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
      $solicitudes = SolicitudesModel::find($id);
      $cct= DB::table('centro_trabajo')->get();
      $ciclo= DB::table('ciclo_escolar')->get();
      $municipios=DB::table('municipios')->get();
      $localidades= DB::table('localidades')->get();

      return view("nomina.solicitudes.edit",[
        "municipios"=>$municipios
        ,"localidades"=>$localidades
        ,"cct"=>$cct
        ,"ciclo"=>$ciclo
        ,"solicitudes"=>$solicitudes
      ]);
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
      $user = Auth::user()->name;
      $solicitudes=SolicitudesModel::findOrFail($id);
      $solicitudes -> entrego_acta = $request ->entrego_acta;
      $solicitudes -> solicitud_inco = $request ->solicitud_inco;
      $solicitudes -> id_cct = $request ->cct;
      $solicitudes -> id_ciclo = $request ->ciclo;
      $solicitudes -> nombre_escuela = $request ->nombre_escuela;
      $solicitudes -> id_municipio=$request ->municipio;
      $solicitudes -> id_localidad=$request ->localidad;
      $solicitudes -> domicilio = $request ->domicilio;
      $solicitudes -> nivel = $request ->nivel;
      $solicitudes -> pnpsvd = $request ->pnpsvd;
      $solicitudes -> cnh = $request ->cnh;
      $solicitudes -> carta_compromiso = $request ->carta_compromiso;
      $solicitudes -> acta_constitutiva_cte = $request ->acta_constitutiva_cte;
      $solicitudes -> acta_cps = $request ->acta_cps;
      $solicitudes -> acta_ctcs = $request ->acta_ctcs;
      $solicitudes -> tramite_estado = $request ->tramite_estado;
      $solicitudes -> estado = 'ACTIVO';
      $solicitudes -> fecha_recepcion = $request ->fecha_recepcion;
      $solicitudes -> captura=$user;

      if($solicitudes->save()){

        return redirect('/solicitudes');

      }else {
      return false;
      }
    }




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
$datos=SolicitudesModel::findOrFail($id);
$datos->estado="INACTIVO";
$datos->captura=$user;
$datos->update();
return redirect('/solicitudes');
    }
}
    ////////////exel////////////////

    public function excel(Request $request, $aux)
    {

      Excel::create('solicitudes', function($excel) use($aux) {
          $excel->sheet('Excel sheet', function($sheet) use($aux) {
                 //otra opción -> $products = Product::select('name')->get();
           $tabla = SolicitudesModel::join('municipios', 'solicitudes.id_municipio', '=','municipios.id')
           ->join('localidades', 'solicitudes.id_localidad', '=','localidades.id')
           ->join('centro_trabajo', 'solicitudes.id_cct', '=','centro_trabajo.id')
           ->join('ciclo_escolar', 'solicitudes.id_ciclo', '=','ciclo_escolar.id')


           ->select('solicitudes.entrego_acta','solicitud_inco','centro_trabajo.cct','solicitudes.nombre_escuela','ciclo_escolar.ciclo','municipios.municipio','localidades.nom_loc',
           'solicitudes.domicilio','solicitudes.nivel','solicitudes.pnpsvd','solicitudes.cnh','solicitudes.carta_compromiso',
           'solicitudes.acta_constitutiva_cte','solicitudes.acta_cps','solicitudes.acta_ctcs','solicitudes.tramite_estado'
           ,'solicitudes.fecha_recepcion')
              ->where('id_ciclo','=',$aux)
             ->get();
             $sheet->fromArray($tabla);
             $sheet->row(1,['ENTREGO CARTA','SOLICITUD INCORPORACION','CCT','NOMBRE ESCUELA','CICLO ESCOLAR','MUNICIPIO','LOCALIDAD','DOMICILIO','NIVEL','PNPSVD'
             ,'CNH','CARTA COMPROMISO','ACTA CONSTITUTICA CTE','ACTA CPS','ACTA CTCS','TRAMITE ESTADO','FECHA DE RECEPCION']);
             $sheet->setOrientation('landscape');
         });
     })->export('xls');
 }

 public function ver_solicitudes(){
  $ciclos=DB::table('ciclo_escolar')->get();
  $regiones=DB::table('region')->where('estado','=','ACTIVO')->get();
  $escuelas=DB::table('centro_trabajo')->get();
  return view('nomina.solicitudes.ver_solicitudes', ['ciclos'=>$ciclos,'regiones'=>$regiones,'escuelas'=>$escuelas,]);

}

public function busca_solis($ciclo){

 $solicitudes=DB::table('solicitudes')
 ->where('solicitudes.id_ciclo','=',$ciclo)
 ->where('solicitudes.estado','=',"ACTIVO")
 ->join('centro_trabajo', 'solicitudes.id_cct', '=','centro_trabajo.id')
 ->join('region', 'centro_trabajo.id_region', '=','region.id')
 ->select('solicitudes.estado','centro_trabajo.cct','solicitudes.tramite_estado','region.sostenimiento')
 ->get();
 return response()->json(
   $solicitudes);

}

public function busca_solis_region($region,$ciclo){
  if ($region == "todas") {
    $captura=DB::table('solicitudes')->join('centro_trabajo','centro_trabajo.id','=','solicitudes.id_cct')
    ->join('region','region.id','=','centro_trabajo.id_region')
    //->where('captura.id_cct_etc','=',$cct)
    ->where('solicitudes.id_ciclo','=',$ciclo)
    ->where('solicitudes.estado','=',"ACTIVO")
    ->select('region.region','region.sostenimiento')->get();

  }else{
    $captura=DB::table('solicitudes')->join('centro_trabajo','centro_trabajo.id','=','solicitudes.id_cct')
    ->join('region','region.id','=','centro_trabajo.id_region')
    ->where('centro_trabajo.id_region','=',$region)
    ->where('solicitudes.id_ciclo','=',$ciclo)
    ->where('solicitudes.estado','=',"ACTIVO")
    //->where('captura.id_cct_etc','=',$cct)
    ->select('region.region','region.sostenimiento','solicitudes.tramite_estado')->get();
  }
  return response()->json(
    $captura);

}


}
