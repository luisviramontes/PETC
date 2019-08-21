<?php

namespace petc\Http\Controllers;

use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use petc\Http\Requests;
use petc\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;

use petc\OficiosRecibidosModel;

use DB;

use Maatwebsite\Excel\Facades\Excel;
use PHPExcel_Worksheet_Drawing;
use Validator;
use \Milon\Barcode\DNS1D;
use \Milon\Barcode\DNS2D;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Collection as Collection;
class OficiosRecibidosController extends Controller
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
      if($tipo_usuario < "0" || $tipo_usuario > "6"){
         return view('permisos');

     }else{
       if($request)
       {
        $query=trim($request->GET('searchText')); 
        $query2=trim($request->GET('ciclo_escolar'));

        $ciclos=DB::table('ciclo_escolar')->get();



        if($query == "" && $query2 == ""){
            $query2=2;
            $oficios=DB::table('oficiosrecibidos')->join('directoriointerno','directoriointerno.id','=','oficiosrecibidos.id_contesta')->join('ciclo_escolar','ciclo_escolar.id','=','oficiosrecibidos.id_ciclo')->select('oficiosrecibidos.*','directoriointerno.nombre','directoriointerno.lic','directoriointerno.area','directoriointerno.puesto','ciclo_escolar.ciclo')->where('ciclo_escolar.id','=',$query2)->get();
        }elseif($query == "" && $query2 != ""){
            $oficios=DB::table('oficiosrecibidos')->join('directoriointerno','directoriointerno.id','=','oficiosrecibidos.id_contesta')->join('ciclo_escolar','ciclo_escolar.id','=','oficiosrecibidos.id_ciclo')->select('oficiosrecibidos.*','directoriointerno.nombre','directoriointerno.lic','directoriointerno.area','directoriointerno.puesto','ciclo_escolar.ciclo')->where('ciclo_escolar.id','=',$query2)->get();

        }else{
            $oficios=DB::table('oficiosrecibidos')->join('directoriointerno','directoriointerno.id','=','oficiosrecibidos.id_contesta')->join('ciclo_escolar','ciclo_escolar.id','=','oficiosrecibidos.id_ciclo')->select('oficiosrecibidos.*','directoriointerno.nombre','directoriointerno.lic','directoriointerno.area','directoriointerno.puesto','ciclo_escolar.ciclo')->where('ciclo_escolar.id','=',$id)->where('oficiosrecibidos.num_oficio','LIKE','%'.$query.'%')->orwhere('oficiosrecibidos.asunto','LIKE','%'.$query.'%')->orwhere('oficiosrecibidos.referencia','LIKE','%'.$query.'%')->orwhere('directoriointerno.nombre','LIKE','%'.$query.'%')->orwhere('directoriointerno.area','LIKE','%'.$query.'%')->paginate(40);


        }
        //codigo
    }
    $contador= DB::table('oficiosrecibidos')->where('oficiosrecibidos.estado','=','PENDIENTE')->where('oficiosrecibidos.id_ciclo','=',$query2)->count();
    return view('administrativa.oficios_recibidos.index',["oficios"=>$oficios,"searchText"=>$query,"ciclo_escolar"=>$query2,'contador'=>$contador,'ciclos'=>$ciclos]);


}
        //
}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $tipo_usuario = Auth::user()->tipo_usuario;
      if($tipo_usuario > '0'){
       $ciclos=DB::table('ciclo_escolar')->get();
       $genero=DB::table('directoriointerno')->where('estado','=','ACTIVO')->get();

       return view('administrativa.oficios_recibidos.create',['ciclos'=>$ciclos,'genero'=>$genero]);

   }else{
     return view('permisos');


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
      if($tipo_usuario <> "2" && $tipo_usuario<>"5"){
         return view('permisos');

     }else{
      $user = Auth::user()->name;
      $ofico_emite= new OficiosRecibidosModel;
      $ofico_emite->num_oficio=$request->get('oficio_aux');
      $ofico_emite->nombre_oficio=$request->get('oficio');
      $ofico_emite->remitente=$request->get('remitente');
      $ofico_emite->asunto=$request->get('asunto');
      $ofico_emite->referencia=$request->get('referencia');
      $ofico_emite->fecha_entrada=$request->get('fecha_entrada');
      $ofico_emite->id_contesta=$request->get('contesta');
      $ofico_emite->observaciones=$request->get('observaciones');

      if(Input::hasFile('archivo')){
        $file=$request->file('archivo');
        $file->move(public_path().'/img/oficiosrecibidos',$file->getClientoriginalName());
        $ofico_emite->archivo=$file->getClientoriginalName();
    }


    $ofico_emite->estado="PENDIENTE";
    $ofico_emite->captura=$user;
    $ofico_emite->id_ciclo=$request->get('ciclo_escolar');
    $ofico_emite->save();
    return Redirect::to('oficiosrecibidos');
        //
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
      $tipo_usuario = Auth::user()->tipo_usuario;
      if($tipo_usuario <> "2" && $tipo_usuario<>"5"){
       return view('permisos');

   }else{

    $oficios=OficiosRecibidosModel::findOrFail($id);
    $ciclos=DB::table('ciclo_escolar')->get();
    $genero=DB::table('directoriointerno')->where('estado','=','ACTIVO')->get();

    return view('administrativa.oficios_recibidos.edit',['ciclos'=>$ciclos,'genero'=>$genero,'oficios'=>$oficios]);
}
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
        $tipo_usuario = Auth::user()->tipo_usuario;
        if($tipo_usuario <> "2" && $tipo_usuario<>"5"){
         return view('permisos');

     }else{
      $user = Auth::user()->name;
      $ofico_emite = OficiosRecibidosModel::find($id);
      $ofico_emite->num_oficio=$request->get('oficio_aux');
      $ofico_emite->nombre_oficio=$request->get('oficio');
      $ofico_emite->remitente=$request->get('remitente');
      $ofico_emite->asunto=$request->get('asunto');
      $ofico_emite->referencia=$request->get('referencia');
      $ofico_emite->fecha_entrada=$request->get('fecha_entrada');
      $ofico_emite->id_contesta=$request->get('contesta');
      $ofico_emite->observaciones=$request->get('observaciones');

      if(Input::hasFile('archivo')){
        $file=$request->file('archivo');
        $file->move(public_path().'/img/oficiosrecibidos',$file->getClientoriginalName());
        $ofico_emite->archivo=$file->getClientoriginalName();
    }


    $ofico_emite->estado="PENDIENTE";
    $ofico_emite->captura=$user;
    $ofico_emite->id_ciclo=$request->get('ciclo_escolar');
    $ofico_emite->update();
    return Redirect::to('oficiosrecibidos');
        //
}
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


    public function buscar_oficio($oficio,$id_ciclo)
    {
        $oficio= OficiosRecibidosModel::
        select('id')
        ->where('id_ciclo','=',$id_ciclo)->where('nombre_oficio','=',$oficio)
        ->get();
        return response()->json(
            $oficio);
        //
    }



    public function buscar_oficio3($oficio,$id)
    {
        $oficio_aux=OficiosRecibidosModel::findOrFail($id)->num_oficio;
        $oficio= OficiosRecibidosModel::
        select('id')->where('num_oficio','<>',$oficio_aux)->where('num_oficio','=',$oficio)
        ->get();
        return response()->json(
            $oficio);
        //
    }

    public function oficiorecibido_resuelto($id){
     $tipo_usuario = Auth::user()->tipo_usuario;
     if($tipo_usuario == "0" ){
         return view('permisos');

     }else{
        $user = Auth::user()->name;
        $tabla=OficiosRecibidosModel::findOrFail($id);
        $tabla->estado="RESUELTO";
        $tabla->captura=$user;
        $tabla->update();
        return Redirect::to('oficiosrecibidos');
    }
}

public function subir_imagen_oficioe(Request $request,$id){
  $tipo_usuario = Auth::user()->tipo_usuario;
  if($tipo_usuario == "0" ){
   return view('permisos');

}else{
    $user = Auth::user()->name;
    $tabla=OficiosRecibidosModel::findOrFail($id);
    if(Input::hasFile('archivo'.$id)){
        $file=$request->file('archivo'.$id);
        $file->move(public_path().'/img/oficiosrecibidos',$file->getClientoriginalName());
        $tabla->archivo=$file->getClientoriginalName();
    }
    $tabla->captura=$user;
    $tabla->update();

    return Redirect::to('oficiosrecibidos');


}}

public function excel(Request $request, $aux)
{

 Excel::create('OFICIOS RECIBIDOS PETC', function($excel) use($aux) {
   $excel->sheet('Excel sheet', function($sheet) use($aux) {



    $tarjeta = OficiosRecibidosModel::join('directoriointerno','directoriointerno.id','=','oficiosrecibidos.id_contesta')->join('ciclo_escolar','ciclo_escolar.id','=','oficiosrecibidos.id_ciclo')->where('oficiosrecibidos.id_ciclo','=',$aux)->select('oficiosrecibidos.num_oficio','oficiosrecibidos.nombre_oficio','oficiosrecibidos.remitente','oficiosrecibidos.asunto','oficiosrecibidos.referencia','oficiosrecibidos.estado','oficiosrecibidos.fecha_entrada','directoriointerno.nombre','directoriointerno.area','directoriointerno.puesto','oficiosrecibidos.fecha_respuesta','oficiosrecibidos.observaciones','ciclo_escolar.ciclo')->get();
    $sheet->fromArray($tarjeta);
    $sheet->row(1,['N° OFICIO','NOMBRE OFICIO','REMITENTE','ASUNTO','REFERENCIA','ESTADO','FECHA RECEPCION','RESPONDE','AREA','PUESTO','FECHA DE RESPUESTA','OBSERVACIONES','CICLO ESCOLAR']);
    $sheet->setOrientation('landscape');
});
})->export('xls');
}

public function ultimo_oficio($ciclo){
    $existe=DB::table('oficiosrecibidos')->where('id_ciclo','=',$ciclo)->get();
    $aux=count($existe);

    if($aux > 0){
       $oficio= OficiosRecibidosModel::orderBy('num_oficio','desc')->where('id_ciclo','=',$ciclo)->first()->id;
       $ultimo=$oficio+1;

   }else{
    $ultimo = 001;  
}
return response()->json(
    $ultimo);

}

public function ver_oficios_r(){
  $ciclos=DB::table('ciclo_escolar')->get();

  return view('administrativa.oficios_recibidos.ver_oficios', ['ciclos'=>$ciclos]);
}

public function ver_oficios_ciclo($ciclo){
    $oficio= OficiosRecibidosModel::
    select('id','num_oficio','estado')->where('id_ciclo','=',$ciclo)
    ->get();
    return response()->json(
        $oficio);

}

public function ver_oficios_area($ciclo,$area){
    $oficio= OficiosRecibidosModel::join('directoriointerno','directoriointerno.id','=','oficiosrecibidos.id_contesta')->where('oficiosrecibidos.id_ciclo','=',$ciclo)->where('directoriointerno.area','=',$area)->
    select('oficiosrecibidos.id','oficiosrecibidos.num_oficio','oficiosrecibidos.estado','directoriointerno.nombre','oficiosrecibidos.fecha_entrada','oficiosrecibidos.asunto','oficiosrecibidos.referencia','oficiosrecibidos.remitente')
    ->get();
    return response()->json(
        $oficio);
}

public function excel2(Request $request, $aux,$area)
{

 Excel::create('OFICIOS RECIBIDOS PETC POR AREA', function($excel) use($aux,$area) {
   $excel->sheet('Excel sheet', function($sheet) use($aux,$area) {


      $tarjeta = OficiosRecibidosModel::join('directoriointerno','directoriointerno.id','=','oficiosrecibidos.id_contesta')->join('ciclo_escolar','ciclo_escolar.id','=','oficiosrecibidos.id_ciclo')->where('directoriointerno.area','=',$area)->where('oficiosrecibidos.id_ciclo','=',$aux)->select('oficiosrecibidos.num_oficio','oficiosrecibidos.nombre_oficio','oficiosrecibidos.remitente','oficiosrecibidos.asunto','oficiosrecibidos.referencia','oficiosrecibidos.estado','oficiosrecibidos.fecha_entrada','directoriointerno.nombre','directoriointerno.area','directoriointerno.puesto','oficiosrecibidos.fecha_respuesta','oficiosrecibidos.observaciones','ciclo_escolar.ciclo')->get();

      $sheet->fromArray($tarjeta);
      $sheet->row(1,['N° OFICIO','NOMBRE OFICIO','REMITENTE','ASUNTO','REFERENCIA','ESTADO','FECHA RECEPCION','RESPONDE','AREA','PUESTO','FECHA DE RESPUESTA','OBSERVACIONES','CICLO ESCOLAR']);
      $sheet->setOrientation('landscape');
  });
})->export('xls');
}


}
