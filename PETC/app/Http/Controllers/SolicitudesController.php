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
      if($request)
      {
       $query=trim($request->GET('searchText'));
       $solicitudes = DB::table('solicitudes')
       ->join('municipios', 'solicitudes.id_municipio', '=','municipios.id')
       ->join('localidades', 'solicitudes.id_localidad', '=','localidades.id')
       ->select('municipios.*','localidades.*','solicitudes.*')
       ->where('nombre_escuela','LIKE','%'.$query.'%')
       ->orwhere('cct','LIKE','%'.$query.'%')
       ->orwhere('localidades.nom_loc','LIKE','%'.$query.'%')
       ->orwhere('municipios.municipio','LIKE','%'.$query.'%')->paginate(10);



        return view('nomina.solicitudes.index',["solicitudes"=>$solicitudes,"searchText"=>$query]);
    }
  }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $municipios=DB::table('municipios')->get();
      $localidades= DB::table('localidades')->get();
      return view("nomina.solicitudes.create",["municipios"=>$municipios,"localidades"=>$localidades]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $user = Auth::user()->name;
      $solicitudes= new SolicitudesModel;
      $solicitudes -> entrego_acta = $request ->entrego_acta;
      $solicitudes -> solicitud_inco = $request ->solicitud_inco;
      $solicitudes -> cct = $request ->cct;
      $solicitudes -> nombre_escuela = $request ->nombre_escuela;
      $solicitudes-> id_municipio=$request ->municipio;
      $solicitudes-> id_localidad=$request ->localidad;
      $solicitudes -> domicilio = $request ->domicilio;
      $solicitudes -> nivel = $request ->nivel;
      $solicitudes -> pnpsvd = $request ->pnpsvd;
      $solicitudes -> cnh = $request ->cnh;
      $solicitudes -> carta_compromiso = $request ->carta_compromiso;
      $solicitudes -> acta_constitutiva_cte = $request ->acta_constitutiva_cte;
      $solicitudes -> acta_cps = $request ->acta_cps;
      $solicitudes -> acta_ctcs = $request ->acta_ctcs;
      $solicitudes -> tramite_estado = $request ->tramite_estado;
      $solicitudes -> estado = $request ->estado;
      $solicitudes -> fecha_recepcion = $request ->fecha_recepcion;
      $solicitudes -> captura=$user;

      if($solicitudes->save()){

        return redirect('/solicitudes');

      }else {
      return view('solicitudes.index');
      }
    }

    //convertir y descargar pdf

    public function invoice($id){
      $solicitudes = DB::table('solicitudes')
      ->join('municipios', 'solicitudes.id_municipio', '=','municipios.id')
      ->join('localidades', 'solicitudes.id_localidad', '=','localidades.id')
      ->select('municipios.*','localidades.*','solicitudes.*')
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
      $municipios=DB::table('municipios')->get();
      $localidades= DB::table('localidades')->get();
      return view("nomina.solicitudes.edit",["solicitudes"=>$solicitudes,"municipios"=>$municipios,"localidades"=>$localidades]);
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
      $solicitudes -> cct = $request ->cct;
      $solicitudes -> nombre_escuela = $request ->nombre_escuela;
      $solicitudes-> id_municipio=$request ->municipio;
      $solicitudes-> id_localidad=$request ->localidad;
      $solicitudes -> domicilio = $request ->domicilio;
      $solicitudes -> nivel = $request ->nivel;
      $solicitudes -> pnpsvd = $request ->pnpsvd;
      $solicitudes -> cnh = $request ->cnh;
      $solicitudes -> carta_compromiso = $request ->carta_compromiso;
      $solicitudes -> acta_constitutiva_cte = $request ->acta_constitutiva_cte;
      $solicitudes -> acta_cps = $request ->acta_cps;
      $solicitudes -> acta_ctcs = $request ->acta_ctcs;
      $solicitudes -> tramite_estado = $request ->tramite_estado;
      $solicitudes -> estado = $request ->estado;
      $solicitudes -> fecha_recepcion = $request ->fecha_recepcion;
      $solicitudes -> captura=$user;

      if($solicitudes->save()){

        return redirect('/solicitudes');

      }else {
      return view('solicitudes.index');
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
      SolicitudesModel::destroy($id);
      return redirect('/solicitudes');
    }

    ////////////exel////////////////

    public function excel(Request $request)
    {

     Excel::create('solicitudes', function($excel) {
         $excel->sheet('Excel sheet', function($sheet) {
                 //otra opción -> $products = Product::select('name')->get();
           $tabla = SolicitudesModel::join('municipios', 'solicitudes.id_municipio', '=','municipios.id')
           ->join('localidades', 'solicitudes.id_localidad', '=','localidades.id')
           ->select('solicitudes.entrego_acta','solicitud_inco','cct','nombre_escuela','municipios.municipio','localidades.nom_loc',
           'solicitudes.domicilio','solicitudes.nivel','solicitudes.pnpsvd','solicitudes.cnh','solicitudes.carta_compromiso',
           'solicitudes.acta_constitutiva_cte','solicitudes.acta_cps','solicitudes.acta_ctcs','solicitudes.tramite_estado'
           ,'solicitudes.fecha_recepcion')
             //->where('directorio_regional')
             ->get();
             $sheet->fromArray($tabla);
             $sheet->row(1,['ENTREGO CARTA','SOLICITUD INCORPORACION','CCT','NOMBRE ESCUELA','MUNICIPIO','LOCALIDAD','DOMICILIO','NIVEL','PNPSVD'
             ,'CNH','CARTA COMPROMISO','ACTA CONSTITUTICA CTE','ACTA CPS','ACTA CTCS','TRAMITE ESTADO','FECHA DE RECEPCION']);
             $sheet->setOrientation('landscape');
         });
     })->export('xls');
 }


}
