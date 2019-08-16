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
       $ciclos=DB::table('ciclo_escolar')->get();
       $query2=trim($request->GET('ciclo_escolar'));
       $query=trim($request->GET('searchText'));
       $fortalecimientos = DB::table('fortalecimiento')
       ->join('centro_trabajo', 'fortalecimiento.id_cct', '=','centro_trabajo.id')
       ->join('ciclo_escolar', 'fortalecimiento.id_ciclo', '=','ciclo_escolar.id')
       ->join('region', 'centro_trabajo.id_region', '=','region.id')

       ->select('fortalecimiento.id as id','fortalecimiento.*'
       ,'centro_trabajo.cct as cct'
       ,'ciclo_escolar.ciclo'
       ,'region.sostenimiento'
       ,'region.region')

       ->where('cct','LIKE','%'.$query.'%')
       ->where('ciclo_escolar.ciclo','=',$query2)
       ->orwhere('region.sostenimiento','LIKE','%'.$query.'%')
       ->orwhere('monto_forta','LIKE','%'.$query.'%')
       ->paginate(915);

      return view('nomina.fortalecimiento.index',["fortalecimientos"=>$fortalecimientos,"searchText"=>$query,"ciclo_escolar"=>$query2,"ciclos"=>$ciclos]);

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
      $fortalecimiento = DB::table('fortalecimiento')->get();
      $cct= DB::table('centro_trabajo')->get();
      $ciclos= DB::table('ciclo_escolar')->get();
      return view("nomina.fortalecimiento.create",["ciclos"=>$ciclos,"cct"=>$cct,"fortalecimiento"=>$fortalecimiento]);
    }
  }

  public function subir(Request $request)
  {
    $tipo_usuario = Auth::user()->tipo_usuario;
    if($tipo_usuario <> "2" || $tipo_usuario=="5"){
     return view('permisos');

    }else{




      /////////////////////////////

      $path = $request->file->getRealPath();
      $data = Excel::load($path)->get();


          foreach ($data as $key => $value) {


            $id_cct=DB::table('centro_trabajo')->where('cct','=',$value->cct)->first()->id;
            $id_ciclo=DB::table('ciclo_escolar')->where('ciclo','=',$value->ciclo)->first()->id;
            $monto = $value->monto_forta;

            $obser = $value->observaciones;
            $user = Auth::user()->name;


            $arr[] = [
              'id_cct' => $value=$id_cct,
              'monto_forta' => $value=$monto,
              'id_ciclo' => $value=$id_ciclo,
              'estado' => $value="ACTIVO",
              'observaciones' => $value=$obser,
              'captura' => $value=$user,
              'created_at' => $request->created_at,

            ];


            /*
                $forta = new FortalecimientoModel;
                $forta->id_cct = $value=$id_cct;
                $forta->monto_forta = $value=$monto;
                $forta->id_ciclo = $value=$id_ciclo;
                $forta->estado = $value="ACTIVO";
                $forta->observaciones = $value=$obser;
                $forta->captura = $value=$user;
                $forta->created_at = $request->created_at;
                if($forta->save()){

                  return redirect('/fortalecimiento');

                }else {
                return false;
                }

                */
          }

          if(!empty($arr)){
              DB::table('fortalecimiento')->insert($arr);
              return redirect('fortalecimiento');
          }


        ///////////////////////////////////////////////77


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
        $fortalecimientos = new FortalecimientoModel;
        $fortalecimientos -> id_cct = $request ->id_cct;
        $fortalecimientos -> monto_forta = $request ->monto_forta;
        $fortalecimientos -> id_ciclo = $request ->id_ciclo;
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
        ->join('ciclo_escolar', 'ciclo_escolar.id', '=','fortalecimiento.id_ciclo')
        ->select('fortalecimiento.id as id','fortalecimiento.*','centro_trabajo.cct as cct','ciclo_escolar.ciclo as ciclo')
        ->where('fortalecimiento.id_ciclo','=',$id)->get();
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
/*
    public function invoice1($id){



      $personal= DB::table('captura')
       ->join('centro_trabajo', 'centro_trabajo.id', '=','captura.id_cct_etc')
       ->join('ciclo_escolar', 'ciclo_escolar.id', '=','captura.id_ciclo')
      ->select('captura.*','ciclo_escolar.ciclo','centro_trabajo.cct')->where('captura.id_ciclo','=',$id)->get();

      $date = date('Y-m-d');
      $invoice = "2222";
        //print_r($);
      $view =  \View::make('nomina.captura.invoice1', compact('date', 'invoice','personal'))->render();
        //->setPaper($customPaper, 'landscape');
      $pdf = \App::make('dompdf.wrapper');
      $pdf->loadHTML($view);
      return $pdf->stream('invoice');


    }
*/
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

    public function excel(Request $request, $aux)
    {

     Excel::create('fortalecimiento', function($excel) use($aux) {
         $excel->sheet('Excel sheet', function($sheet) use($aux) {

            $tabla = FortalecimientoModel::join('centro_trabajo', 'fortalecimiento.id_cct', '=','centro_trabajo.id')
           ->join('ciclo_escolar', 'ciclo_escolar.id', '=','fortalecimiento.id_ciclo')
           ->select('centro_trabajo.cct','fortalecimiento.monto_forta','ciclo_escolar.ciclo'
           ,'fortalecimiento.observaciones')
           ->where('id_ciclo','=',$aux)
           ->get();

             $sheet->fromArray($tabla);
             $sheet->row(1,['CCT','MONTO FORTALECIMIENTO','CICLO ESCOLAR','OBSERVACIONES']);
             $sheet->setOrientation('landscape');
         });
     })->export('xls');
   }


   public function ver_fortalecimiento(){
    $ciclos=DB::table('ciclo_escolar')->get();
    $regiones=DB::table('region')->where('estado','=','ACTIVO')->get();
    $escuelas=DB::table('centro_trabajo')->get();
    return view('nomina.fortalecimiento.ver_fortalecimiento', ['ciclos'=>$ciclos,'regiones'=>$regiones,'escuelas'=>$escuelas,]);

  }

  public function busca_forta($ciclo){

   $fortalecimiento=DB::table('fortalecimiento')
   ->where('fortalecimiento.id_ciclo','=',$ciclo)
   ->where('fortalecimiento.estado','=',"ACTIVO")
   ->join('centro_trabajo', 'fortalecimiento.id_cct', '=','centro_trabajo.id')
   ->join('region', 'centro_trabajo.id_region', '=','region.id')
   ->select('fortalecimiento.estado','centro_trabajo.cct','fortalecimiento.monto_forta','region.sostenimiento')
   ->get();
   return response()->json(
     $fortalecimiento);

  }

  public function busca_forta_region($region,$ciclo){
    if ($region == "todas") {
      $captura=DB::table('fortalecimiento')->join('centro_trabajo','centro_trabajo.id','=','fortalecimiento.id_cct')
      ->join('region','region.id','=','centro_trabajo.id_region')
      //->where('captura.id_cct_etc','=',$cct)
      ->where('fortalecimiento.id_ciclo','=',$ciclo)
      ->where('fortalecimiento.estado','=',"ACTIVO")
      ->select('region.region','region.sostenimiento')->get();

    }else{
      $captura=DB::table('fortalecimiento')->join('centro_trabajo','centro_trabajo.id','=','fortalecimiento.id_cct')
      ->join('region','region.id','=','centro_trabajo.id_region')
      ->where('centro_trabajo.id_region','=',$region)
      ->where('fortalecimiento.id_ciclo','=',$ciclo)
      ->where('fortalecimiento.estado','=',"ACTIVO")
      //->where('captura.id_cct_etc','=',$cct)
      ->select('region.region','region.sostenimiento','fortalecimiento.monto_forta')->get();
    }
    return response()->json(
      $captura);

  }

}
