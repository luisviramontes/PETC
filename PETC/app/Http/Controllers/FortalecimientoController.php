<?php


namespace petc\Http\Controllers;

use Illuminate\Http\Request;

use petc\Http\Requests;
use petc\Http\Controllers\Controller;


use petc\FortalecimientoModel;

use DB;

use Maatwebsite\Excel\Facades\Excel;
use PHPExcel_Worksheet_Drawing;
use Validator;
use \Milon\Barcode\DNS1D;
use \Milon\Barcode\DNS2D;
use petc\Http\Requests\FortalecimientoRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Collection as Collection;

class FortalecimientoController extends Controller
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
       $query=trim($request->GET('searchText'));
       $fortalecimientos = DB::table('fortalecimiento')
       ->join('centro_trabajo', 'fortalecimiento.id_cct', '=','centro_trabajo.id')
       ->select('fortalecimiento.id as id','fortalecimiento.*','centro_trabajo.cct as cct')
       ->where('cct','LIKE','%'.$query.'%')
       ->orwhere('monto_forta','LIKE','%'.$query.'%')
       ->paginate(10);

      return view('nomina.fortalecimiento.index',["fortalecimientos"=>$fortalecimientos,"searchText"=>$query]);

      }    //
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
      $ciclos= DB::table('ciclo_escolar')->get();
      return view("nomina.fortalecimiento.create",["ciclos"=>$ciclos,"cct"=>$cct]);
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
        $fortalecimientos = new FortalecimientoModel;
        $fortalecimientos -> id_cct = $request ->id_cct;
        $fortalecimientos -> monto_forta = $request ->monto_forta;
        $fortalecimientos -> ciclo_escolar = $request ->ciclo_escolar;
        $fortalecimientos -> estado = "ACTIVO";
        $fortalecimientos -> observaciones = $request ->observaciones;
        $fortalecimientos -> captura=$user;

        if($fortalecimientos->save()){

          return redirect('/fortalecimiento');

        }else {
        return view('fortalecimiento.index');
        }

    }}

    public function invoice($id){
        $fortalecimientos = DB::table('fortalecimiento')
        ->join('centro_trabajo', 'fortalecimiento.id_cct', '=','centro_trabajo.id')
        ->select('fortalecimiento.id as id','fortalecimiento.*','centro_trabajo.cct as cct')->get();
        //$centro_trabajo= DB::table('centro_trabajo')->where('cct','=',$id)->first();
         //$material   = AlmacenMaterial:: findOrFail($id);
        //$customPaper = array(0,0,567.00,283.80);

        $date = date('Y-m-d');
        $invoice = "2222";
        $view =  \View::make('nomina.fortalecimiento.invoice', compact('date', 'invoice','fortalecimientos'))->render();
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
      $fortalecimientos = FortalecimientoModel::find($id);
      $cct= DB::table('centro_trabajo')->get();
      $ciclos= DB::table('ciclo_escolar')->get();
      return view("nomina.fortalecimiento.edit",["fortalecimientos"=>$fortalecimientos,"cct"=>$cct,"ciclos"=>$ciclos]);
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
      $fortalecimientos = FortalecimientoModel::find($id);
      $fortalecimientos -> id_cct = $request ->id_cct;
      $fortalecimientos -> monto_forta = $request ->monto_forta;
      $fortalecimientos -> ciclo_escolar = $request ->ciclo_escolar;
      $fortalecimientos -> estado = "ACTIVO";
      $fortalecimientos -> observaciones = $request ->observaciones;
      $fortalecimientos -> captura=$user;

      if($fortalecimientos->save()){

        return redirect('/fortalecimiento');

      }else {
      return view('fortalecimiento.index');
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
      $fortalecimiento=FortalecimientoModel::findOrFail($id);
      $fortalecimiento->estado="INACTIVO";
      $fortalecimiento->captura=$user;
      $fortalecimiento->update();
        return redirect('fortalecimiento');
    }}

    ////////////exel////////////////

    public function excel(Request $request)
    {

     Excel::create('fortalecimiento', function($excel) {
         $excel->sheet('Excel sheet', function($sheet) {

            $tabla = FortalecimientoModel::join('centro_trabajo', 'fortalecimiento.id_cct', '=','centro_trabajo.id')
           ->select('centro_trabajo.cct','fortalecimiento.monto_forta','fortalecimiento.ciclo_escolar','fortalecimiento.estado'
           ,'fortalecimiento.observaciones','fortalecimiento.captura')
           ->get();
             $sheet->fromArray($tabla);
             $sheet->row(1,['CCT','MONTO FORTALECIMIENTO','CICLO ESCOLAR','ESTADO','OBSERVACIONES']);
             $sheet->setOrientation('landscape');
         });
     })->export('xls');
   }

}
