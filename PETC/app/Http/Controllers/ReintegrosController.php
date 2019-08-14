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
use petc\BancosModel;
use petc\TabuladorPagosModel;
use petc\OficiosEmitidosModel;
use petc\TablaPagosModel;
use Maatwebsite\Excel\Facades\Excel;
use PHPExcel_Worksheet_Drawing;
use Validator;
use \Milon\Barcode\DNS1D;
use \Milon\Barcode\DNS2D;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Collection as Collection;
use petc\Http\Requests\ReintegrosRequest;


class ReintegrosController extends Controller
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
       $reintegros = DB::table('reintegros')
       ->join('centro_trabajo','reintegros.id_centro_trabajo', '=', 'centro_trabajo.id' ) //cct
       ->join('captura','reintegros.id_captura', '=', 'captura.id' ) //nombre, sostenimiento, categoria
       ->join('directorio_regional','reintegros.id_directorio_regional', '=', 'directorio_regional.id' ) //director_regional,sostenimiento
       ->join('cuentas','reintegros.id_cuenta', '=', 'cuentas.id' ) //cuentas
       ->join('bancos','reintegros.id_banco', '=', 'bancos.id' ) //bancos


       ->select('reintegros.id as id','reintegros.id_centro_trabajo','reintegros.id_captura','reintegros.id_directorio_regional','reintegros.id_ciclo'
       ,'reintegros.num_dias','reintegros.total','reintegros.oficio','reintegros.motivo','reintegros.estado'
       ,'reintegros.captura','reintegros.created_at'
       ,'centro_trabajo.cct'
       ,'cuentas.nombre','cuentas.num_cuenta','cuentas.secretaria'
       ,'bancos.nombre_banco'
       ,'captura.nombre','captura.categoria'
       ,'directorio_regional.director_regional','directorio_regional.id_region')

       ->where('reintegros.total','LIKE','%'.$query.'%')
       ->orwhere('reintegros.oficio','LIKE','%'.$query.'%')
       ->orwhere('reintegros.motivo','LIKE','%'.$query.'%')
       ->orwhere('reintegros.estado','LIKE','%'.$query.'%')
       ->orwhere('centro_trabajo.cct','LIKE','%'.$query.'%')
       ->orwhere('captura.nombre','LIKE','%'.$query.'%')
       ->orwhere('bancos.nombre_banco','LIKE','%'.$query.'%')
       ->orwhere('cuentas.nombre','LIKE','%'.$query.'%')
       ->orwhere('cuentas.num_cuenta','LIKE','%'.$query.'%')
       ->orwhere('cuentas.secretaria','LIKE','%'.$query.'%')
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

      $genero=DB::table('directoriointerno')->where('estado','=','ACTIVO')->get();
      $dirigido=DB::table('directorioexterno')->where('estado','=','ACTIVO')->get();
      $cct= DB::table('centro_trabajo')->get();
      $captura= DB::table('captura')->get();
      $directorio_regional=DB::table('directorio_regional')->get();
      $tabla= DB::table('tabulador_pagos')->get();
      $ciclos=DB::table('ciclo_escolar')->get();
      $cuentas=DB::table('cuentas')->get();
      return view("nomina.reintegros.create",
      [
      'ciclos'=>$ciclos,
      "genero"=>$genero,
      "dirigido"=>$dirigido,
      "directorio_regional"=>$directorio_regional,
      "captura"=>$captura,
      "cct"=>$cct,
      "tabla"=>$tabla,
      "cuentas"=>$cuentas
      ]);
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

      //$qna=$request->get('pagos');
      //$year_aux = substr($qna, 0, -2);  // devuelve "abcde" 201818
      //$qna_aux = substr($qna, 4, 5);  // devuelve "abcde" 201818

        //QUIEN GENERO EL OFICIO
        $genero_aux=$request->get('genero');
        //$first = head($genero_aux);
        $name = explode("_",$genero_aux);
        $genero=$name[0];
        $id_genero=$name[1];

        //A QUIEN VA DIRIGIDO EL OFICIO
        $dirigido_aux=$request->get('');




        //CCP
       $copia_aux = $request->get('c_copia');
       $first6 = head($copia_aux);
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
       $ofico_emite->id_dirigido=$dirigido_aux;
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

//////////////////////////////////////////////////////////////////////////////////



      $reintegros = new ReintegrosModel;

      $id_cap=$request->get('id_captura');
      //$first=head($id_cct);
      $namecap=explode("_",$id_cap);
      $reintegros -> id_captura = $namecap[3]; //captura

      $id_ct=$request->get('id_centro_trabajo');
      $reintegros -> id_centro_trabajo = $id_ct; //cct

      $id_dir=$request->get('id_directorio_regional');
      $namedir=explode("_",$id_dir);
      $reintegros -> id_directorio_regional = $namedir[1]; //dir reg

      $id_cic=$request->get('id_ciclo'); //ciclo
      $reintegros -> id_ciclo = $id_cic;

      $id_cue=$request->get('id_cuenta'); //cuenta
      $namecue=explode("_",$id_cue);
      $reintegros -> id_cuenta = $namecue[0];


      $id_ban=$request->get('id_banco'); //banco
      $nameban=explode("_",$id_ban);
      $reintegros -> id_banco = $nameban[1];


      $reintegros->id_ciclo=$ciclo->id; //ciclo

      $num_d=$request->get('num_dias'); //numdias
      $reintegros -> num_dias = $num_d;

      $id_tot=$request->get('total'); //total
      $nametot=explode("_",$id_tot);
      $reintegros -> total = $nametot[0];


      $id_totex=$request->get('total_text');
      $nametotex=explode("_",$id_totex);
      $reintegros -> total_text = $nametotex[0];

      $reintegros -> oficio = $oficio;

      $reintegros->id_oficio=$ultimo;

      $reintegros-> motivo=$motivo;

      $reintegros -> estado = "ACTIVO";

      $reintegros -> captura =$user;

      if($reintegros->save()){

        $reintegro=ReintegrosModel::join('captura','reintegros.id_captura', '=', 'captura.id' ) //nombre, sostenimiento, categoria
        ->join('centro_trabajo','reintegros.id_centro_trabajo', '=', 'centro_trabajo.id' ) //cct
        ->join('directorio_regional','reintegros.id_directorio_regional', '=', 'directorio_regional.id' ) //director_regional,sostenimiento
        ->join('cuentas','reintegros.id_cuenta', '=', 'cuentas.id' ) //cuentas
        ->join('bancos','reintegros.id_banco', '=', 'bancos.id' ) //bancos
        //->join('oficiosemitidos','oficiosemitidos.id_oficio', '=', 'oficiosemitidos.id')



        ->select('captura.categoria','captura.nombre'
        ,'centro_trabajo.cct'
        ,'reintegros.*'
        ,'directorio_regional.director_regional'
        ,'cuentas.nombre','cuentas.num_cuenta','cuentas.clave_in','cuentas.secretaria'
        ,'bancos.nombre_banco')
        //,'oficiosemitidos.num_oficio','oficiosemitidos.asunto','oficiosemitidos.referencia','oficiosemitidos.salida','oficiosemitidos.observaciones')

        ->where('oficio','=',$oficio)
        ->where('reintegros.estado','=','ACTIVO')
        ->where('reintegros.id_ciclo','=',$ciclo->id)->get();
        $cuenta=count($reintegro);

        $view =  \View::make('nomina.reintegros.invoice', compact('cuenta_copia_t','cuenta_copia','name6'
        ,'dirigido_puesto','dirigido_nombrec','dirigido_aux'
        ,'cuenta','motivo','date','oficio'
        ,'genero','reintegro','namecap','id_ct','namedir','id_cic','namecue','nameban','ciclo','num_d','id_tot','nametot','nameban','nametotex','ultimo'))->render();
          //->setPaper($customPaper, 'landscape');
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        return $pdf->stream('invoice.pdf');

      }else {
      return false;
      }


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

      $genero=DB::table('directoriointerno')->where('estado','=','ACTIVO')->get();
      $dirigido=DB::table('directorioexterno')->where('estado','=','ACTIVO')->get();

      $id_rein=DB::table('reintegros')->where('id','=',$id)->first();

      $reintegros=ReintegrosModel::join('oficiosemitidos','oficiosemitidos.id','=','reintegros.id_oficio')
      ->select('reintegros.*','oficiosemitidos.id_elabora','oficiosemitidos.salida','oficiosemitidos.num_oficio','oficiosemitidos.observaciones')
      ->where('reintegros.id','=',$id)
      ->first();


      $cct= DB::table('centro_trabajo')->get();
      $captura= DB::table('captura')->get();
      $directorio_regional=DB::table('directorio_regional')->get();
      $tabla= DB::table('tabulador_pagos')->get();
      $ciclos=DB::table('ciclo_escolar')->get();
      $cuentas=DB::table('cuentas')->get();
      return view("nomina.reintegros.edit",
      [
      "id_rein"=>$id_rein,
      "reintegros"=>$reintegros,
      'ciclos'=>$ciclos,
      "genero"=>$genero,
      "dirigido"=>$dirigido,
      "directorio_regional"=>$directorio_regional,
      "captura"=>$captura,
      "cct"=>$cct,
      "tabla"=>$tabla,
      "cuentas"=>$cuentas
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
      //QUIEN ELABORO EL OFICIO
      $genero_aux=$request->get('genero');
        //$first = head($genero_aux);
      $name = explode("_",$genero_aux);
      $genero=$name[0];
      $id_genero=$name[1];

              //A QUIEN VA DIRIGIDO EL OFICIO
      $dirigido_aux=$request->get('');


      $motivo=$request->get('motivo');
      $observaciones=$request->get('observaciones');

      $ciclo_aux=$request->get('ciclo_escolar');
        //
      $ciclo=DB::table('ciclo_escolar')->where('ciclo','=',$ciclo_aux)->first();

      $reintegros=ReintegrosModel::findOrFail($id);
      $id_oficio_aux=$reintegros->id_oficio;
      $oficio=OficiosEmitidosModel::findOrFail($id_oficio_aux);
      $oficio->num_oficio=$request->get('oficio_aux');
      $oficio->id_dirigido=$dirigido_aux;
      $oficio->asunto="Solicitud de Pago";
      $oficio->referencia="Nomina PETC";
      $oficio->salida=$request->get('fecha');
      $oficio->id_elabora=$id_genero;
      $oficio->observaciones=$request->get('observaciones');
      $oficio->estado="PENDIENTE";
      $oficio->captura=$user;
      $oficio->id_ciclo=$ciclo->id;
      $oficio->update();


      $id_cap=$request->get('id_captura');
      //$first=head($id_cct);
      $namecap=explode("_",$id_cap);
      $reintegros -> id_captura = $namecap[3]; //captura

      $id_ct=$request->get('id_centro_trabajo');
      $reintegros -> id_centro_trabajo = $id_ct; //cct

      $id_dir=$request->get('id_directorio_regional');
      $namedir=explode("_",$id_dir);
      $reintegros -> id_directorio_regional = $namedir[1]; //dir reg

      $id_cic=$request->get('id_ciclo'); //ciclo
      $reintegros -> id_ciclo = $id_cic;

      $id_cue=$request->get('id_cuenta'); //cuenta
      $namecue=explode("_",$id_cue);
      $reintegros -> id_cuenta = $namecue[0];


      $id_ban=$request->get('id_banco'); //banco
      $nameban=explode("_",$id_ban);
      $reintegros -> id_banco = $nameban[1];


      $reintegros->id_ciclo=$ciclo->id; //ciclo

      $num_d=$request->get('num_dias'); //numdias
      $reintegros -> num_dias = $num_d;

      $id_tot=$request->get('total'); //total
      $nametot=explode("_",$id_tot);
      $reintegros -> total = $nametot[0];


      $id_totex=$request->get('total_text');
      $nametotex=explode("_",$id_totex);
      $reintegros -> total_text = $nametotex[0];

      $reintegros -> oficio = $request ->oficio;

      $reintegros->id_oficio=$oficio->id;

      $reintegros-> motivo=$motivo;

      $reintegros -> estado = "PENDIENTE";

      $reintegros -> captura =$user;

      $reintegros->update();

      return Redirect::to('reintegros');
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
      $reintegros=ReintegrosModel::findOrFail($id);
      $reintegros->estado="INACTIVO";
      $reintegros->captura="ADMINISTRADOR";
      $reintegros->update();
        return redirect('reintegros');
    }
  }

    public function invoice2($id){
      $reintegro=ReintegrosModel::join('captura','reintegros.id_captura', '=', 'captura.id' ) //nombre, sostenimiento, categoria
      ->join('centro_trabajo','reintegros.id_centro_trabajo', '=', 'centro_trabajo.id' ) //cct
      ->join('directorio_regional','reintegros.id_directorio_regional', '=', 'directorio_regional.id' ) //director_regional,sostenimiento
      ->join('cuentas','reintegros.id_cuenta', '=', 'cuentas.id' ) //cuentas
      ->join('bancos','reintegros.id_banco', '=', 'bancos.id' ) //bancos
      //->join('oficiosemitidos','oficiosemitidos.id_oficio', '=', 'oficiosemitidos.id')



      ->select('captura.categoria','captura.nombre'
      ,'centro_trabajo.cct'
      ,'reintegros.*'
      ,'directorio_regional.director_regional'
      ,'cuentas.nombre','cuentas.num_cuenta','cuentas.clave_in','cuentas.secretaria'
      ,'bancos.nombre_banco')->where('reintegros.id_ciclo','=',$id)->get();
      //,'oficiosemitidos.num_oficio','oficiosemitidos.asunto','oficiosemitidos.referencia','oficiosemitidos.salida','oficiosemitidos.observaciones')


      $view =  \View::make('nomina.reintegros.invoice2', compact('cuenta_copia_t','cuenta_copia','name6'
      ,'dirigido_puesto','dirigido_nombrec','dirigido_aux'
      ,'cuenta','motivo','date','oficio'
      ,'genero','reintegro','namecap','id_ct','namedir','id_cic','namecue','nameban','ciclo','num_d','id_tot','nametot','nameban','nametotex','ultimo'))->render();
        //->setPaper($customPaper, 'landscape');
      $pdf = \App::make('dompdf.wrapper');
      $pdf->loadHTML($view);
      return $pdf->stream('invoice2.pdf');
    }


    ////////////exel////////////////

    public function excel(Request $request, $aux)
    {

     Excel::create('reintegros', function($excel) use($aux) {
         $excel->sheet('Excel sheet', function($sheet) use($aux) {

            $tabla = ReintegrosModel::join('captura','reintegros.id_captura', '=', 'captura.id' ) //nombre, sostenimiento, categoria
            ->join('centro_trabajo','reintegros.id_centro_trabajo', '=', 'centro_trabajo.id' ) //cct
            ->join('directorio_regional','reintegros.id_directorio_regional', '=', 'directorio_regional.id' ) //director_regional,sostenimiento
            ->join('cuentas','reintegros.id_cuenta', '=', 'cuentas.id' ) //cuentas
            ->join('bancos','reintegros.id_banco', '=', 'bancos.id' ) //bancos
            ->join('ciclo_escolar','reintegros.id_ciclo', '=', 'ciclo_escolar.id' ) //bancos

            ->select(
            'centro_trabajo.cct'
            ,'captura.nombre','captura.categoria'
            ,'directorio_regional.director_regional'
            ,'reintegros.num_dias'
            ,'reintegros.oficio'
            ,'reintegros.motivo'
            ,'reintegros.total'
            ,'ciclo_escolar.ciclo'
            ,'reintegros.created_at')
           ->where('reintegros.id_ciclo','=',$aux)
           ->get();

             $sheet->fromArray($tabla);
             $sheet->row(1,['CCT','NOMBRE','CATEGORIA','DIRECTOR REGIONAL','NUM_DIAS','NO OFICIO','MOTIVO','TOTAL','CICLO ESCOLAR','FECHA DE REGISTRO']);
             $sheet->setOrientation('landscape');
         });
     })->export('xls');
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

public function cuenta(Request $request,$nombre)
  {
    $cuentas= CuentasModel::select('id','nombre','clave_in','num_cuenta','secretaria','id_banco', 'estado')
    ->where('id_cuenta','=',$cuenta)->where('estado','=','ACTIVO')
    ->get();

    return response()->json(
      $cuentas->toArray());
}

public function banco(Request $request,$banco)
  {
    $bancos= BancosModel::select('id','nombre_banco','estado')
    ->where('id','=',$banco)->where('estado','=','ACTIVO')
    ->get();

    return response()->json(
      $bancos->toArray());
}



public function ver_reintegros(){
    $ciclos=DB::table('ciclo_escolar')->get();
    $regiones=DB::table('region')->where('estado','=','ACTIVO')->get();
    $escuelas=DB::table('centro_trabajo')->get();
    return view('nomina.reintegros.ver_reintegros', ['ciclos'=>$ciclos,'regiones'=>$regiones,'escuelas'=>$escuelas,]);

}

public function busca_rein($ciclo){

 $fortalecimiento=DB::table('reintegros')
 ->where('reintegros.id_ciclo','=',$ciclo)
 ->where('reintegros.estado','=',"ACTIVO")
 ->join('centro_trabajo', 'reintegros.id_centro_trabajo', '=','centro_trabajo.id')
 ->join('region', 'centro_trabajo.id_region', '=','region.id')
 ->select('reintegros.estado','centro_trabajo.cct','reintegros.total','region.sostenimiento')
 ->get();
 return response()->json(
   $fortalecimiento);

}

public function busca_rein_region($region,$ciclo){
  if ($region == "todas") {
    $reintegros=DB::table('reintegros')->join('centro_trabajo','centro_trabajo.id','=','reintegros.id_centro_trabajo')
    ->join('region','region.id','=','centro_trabajo.id_region')
    //->where('captura.id_cct_etc','=',$cct)
    ->where('reintegros.id_ciclo','=',$ciclo)
    ->where('reintegros.estado','=',"ACTIVO")
    ->select('region.region','region.sostenimiento')->get();

  }else{
    $reintegros=DB::table('reintegros')->join('centro_trabajo','centro_trabajo.id','=','reintegros.id_centro_trabajo')
    ->join('region','region.id','=','centro_trabajo.id_region')
    ->where('centro_trabajo.id_region','=',$region)
    ->where('reintegros.id_ciclo','=',$ciclo)
    ->where('reintegros.estado','=',"ACTIVO")
    //->where('captura.id_cct_etc','=',$cct)
    ->select('region.region','region.sostenimiento','reintegros.total')->get();
  }
  return response()->json(
    $reintegros);

}


}
