<?php

namespace petc\Http\Controllers;

use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use petc\Http\Requests;
use petc\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;

use petc\OficiosEmitidosModel;
use petc\OficiosRecibidosModel;

use DB;

use Maatwebsite\Excel\Facades\Excel;
use PHPExcel_Worksheet_Drawing;
use Validator;
use \Milon\Barcode\DNS1D;
use \Milon\Barcode\DNS2D;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Collection as Collection;
class OficiosEmitidosController extends Controller
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
          $oficios=DB::table('oficiosemitidos')->join('directoriointerno','directoriointerno.id','=','oficiosemitidos.id_elabora')->join('ciclo_escolar','ciclo_escolar.id','=','oficiosemitidos.id_ciclo')->join('directorioexterno','directorioexterno.id','=','oficiosemitidos.id_dirigido')->select('oficiosemitidos.*','directoriointerno.nombre','directoriointerno.lic','directoriointerno.area','directoriointerno.puesto','directorioexterno.nombre_c','directorioexterno.lic as licext','directorioexterno.puesto as puestoext','directorioexterno.direccion','directorioexterno.ext','directorioexterno.correo','ciclo_escolar.ciclo')->where('ciclo_escolar.id','=',$query2)->get();
        }elseif($query == "" && $query2 != ""){
          $oficios=DB::table('oficiosemitidos')->join('directoriointerno','directoriointerno.id','=','oficiosemitidos.id_elabora')->join('ciclo_escolar','ciclo_escolar.id','=','oficiosemitidos.id_ciclo')->join('directorioexterno','directorioexterno.id','=','oficiosemitidos.id_dirigido')->select('oficiosemitidos.*','directoriointerno.nombre','directoriointerno.lic','directoriointerno.area','directoriointerno.puesto','directorioexterno.nombre_c','directorioexterno.lic as licext','directorioexterno.puesto as puestoext','directorioexterno.direccion','directorioexterno.ext','directorioexterno.correo','ciclo_escolar.ciclo')->where('ciclo_escolar.id','=',$query2)->get();

        }else{
          $oficios=DB::table('oficiosemitidos')->join('directoriointerno','directoriointerno.id','=','oficiosemitidos.id_elabora')->join('ciclo_escolar','ciclo_escolar.id','=','oficiosemitidos.id_ciclo')->join('directorioexterno','directorioexterno.id','=','oficiosemitidos.id_dirigido')->select('oficiosemitidos.*','directoriointerno.nombre','directoriointerno.lic','directoriointerno.area','directoriointerno.puesto','directorioexterno.nombre_c','directorioexterno.lic as licext','directorioexterno.puesto as puestoext','directorioexterno.direccion','directorioexterno.ext','directorioexterno.correo','ciclo_escolar.ciclo')->where('ciclo_escolar.id','=',$query2)->where('oficiosemitidos.num_oficio','LIKE','%'.$query.'%')->orwhere('oficiosemitidos.asunto','LIKE','%'.$query.'%')->orwhere('oficiosemitidos.referencia','LIKE','%'.$query.'%')->orwhere('directoriointerno.nombre','LIKE','%'.$query.'%')->orwhere('directoriointerno.area','LIKE','%'.$query.'%')->orwhere('directorioexterno.nombre_c','LIKE','%'.$query.'%')->orwhere('directorioexterno.direccion','LIKE','%'.$query.'%')->orwhere('directorioexterno.direccion','LIKE','%'.$query.'%')->paginate(40);


        }
        //codigo
      }
      $contador= DB::table('oficiosemitidos')->where('oficiosemitidos.estado','=','PENDIENTE')->where('oficiosemitidos.id_ciclo','=',$query2)->count();
      return view('administrativa.oficios_emitidos.index',["oficios"=>$oficios,"searchText"=>$query,"ciclo_escolar"=>$query2,'contador'=>$contador,'ciclos'=>$ciclos]);


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
       $dirigido=DB::table('DirectorioExterno')->where('estado','=','ACTIVO')->get();
       $genero=DB::table('directoriointerno')->where('estado','=','ACTIVO')->get();

       return view('administrativa.oficios_emitidos.create',['ciclos'=>$ciclos,'dirigido'=>$dirigido,'genero'=>$genero]);

     }else{
       return view('permisos');

     }

        //
   }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {               $tipo_usuario = Auth::user()->tipo_usuario;
      if($tipo_usuario <> "2" && $tipo_usuario<>"5"){
       return view('permisos');

     }else{
      $user = Auth::user()->name;
      $ofico_emite= new OficiosEmitidosModel;
      $ofico_emite->num_oficio=$request->get('oficio_aux');
      $ofico_emite->nombre_oficio=$request->get('oficio');
      $ofico_emite->id_dirigido=$request->get('dirigido_a');
      $ofico_emite->asunto=$request->get('asunto');
      $ofico_emite->referencia=$request->get('referencia');
      $ofico_emite->salida=$request->get('fechas');
      $ofico_emite->id_elabora=$request->get('genero');
      $ofico_emite->observaciones=$request->get('observaciones');
      $ofico_emite->estado="PENDIENTE";
      $ofico_emite->captura=$user;
      $ofico_emite->id_ciclo=$request->get('ciclo_escolar');
      $ofico_emite->save();
      return Redirect::to('oficiosemitidos');
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
      if($tipo_usuario <> "2" && $tipo_usuario<>"5"){
       return view('permisos');

     }else{

      $oficios=OficiosEmitidosModel::findOrFail($id);
      $ciclos=DB::table('ciclo_escolar')->get();
      $dirigido=DB::table('DirectorioExterno')->where('estado','=','ACTIVO')->get();
      $genero=DB::table('directoriointerno')->where('estado','=','ACTIVO')->get();

      return view('administrativa.oficios_emitidos.edit',['ciclos'=>$ciclos,'dirigido'=>$dirigido,'genero'=>$genero,'oficios'=>$oficios]);
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
      $ofico_emite = OficiosEmitidosModel::find($id);
      $ofico_emite->num_oficio=$request->get('oficio_aux');
      $ofico_emite->nombre_oficio=$request->get('oficio');
      $ofico_emite->id_dirigido=$request->get('dirigido_a');
      $ofico_emite->asunto=$request->get('asunto');
      $ofico_emite->referencia=$request->get('referencia');
      $ofico_emite->salida=$request->get('fechas');
      $ofico_emite->id_elabora=$request->get('genero');
      $ofico_emite->observaciones=$request->get('observaciones');
      $ofico_emite->estado="PENDIENTE";
      $ofico_emite->captura=$user;
      $ofico_emite->id_ciclo=$request->get('ciclo_escolar');
      $ofico_emite->update();
      return Redirect::to('oficiosemitidos');
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

    public function buscar_oficio($oficio,$ciclo_aux)
    {
      $ciclo=DB::table('ciclo_escolar')->where('ciclo','=',$ciclo_aux)->first();
      $oficio= OficiosEmitidosModel::
      select('id')
      ->where('id_ciclo','=',$ciclo->id)->where('num_oficio','=',$oficio)
      ->get();
      return response()->json(
        $oficio);
        //
    }

    public function buscar_oficio2($oficio,$id)
    {
      $oficio= OficiosEmitidosModel::
      select('id')
      ->where('id_ciclo','=',$id)->where('num_oficio','=',$oficio)
      ->get();
      return response()->json(
        $oficio);
        //
    }

    public function buscar_oficio3($oficio,$id)
    {
      $oficio_aux=OficiosEmitidosModel::findOrFail($id)->num_oficio;
      $oficio= OficiosEmitidosModel::
      select('id')->where('num_oficio','<>',$oficio_aux)->where('num_oficio','=',$oficio)
      ->get();
      return response()->json(
        $oficio);
        //
    }



    public function oficioemitido_resuelto($id){
     $tipo_usuario = Auth::user()->tipo_usuario;
     if($tipo_usuario == "0" ){
       return view('permisos');

     }else{
      $user = Auth::user()->name;
      $tabla=OficiosEmitidosModel::findOrFail($id);
      $tabla->estado="RESUELTO";
      $tabla->captura=$user;
      $tabla->update();
      return Redirect::to('oficiosemitidos');
    }
  }

  public function subir_imagen_oficioe(Request $request,$id){
    $tipo_usuario = Auth::user()->tipo_usuario;
    if($tipo_usuario == "0" ){
     return view('permisos');

   }else{
    $user = Auth::user()->name;
    $tabla=OficiosEmitidosModel::findOrFail($id);
    if(Input::hasFile('archivo'.$id)){
      $file=$request->file('archivo'.$id);
      $file->move(public_path().'/img/oficiosemitidos',$file->getClientoriginalName());
      $tabla->archivo=$file->getClientoriginalName();
    }
    $tabla->captura=$user;
    $tabla->update();

    return Redirect::to('oficiosemitidos');


  }}

  public function excel(Request $request, $aux)
  {

   Excel::create('OFICIOS EMITIDOS PETC', function($excel) use($aux) {
     $excel->sheet('Excel sheet', function($sheet) use($aux) {



      $tarjeta = OficiosEmitidosModel::join('DirectorioExterno','DirectorioExterno.id','=','oficiosemitidos.id_dirigido')->join('directoriointerno','directoriointerno.id','=','oficiosemitidos.id_elabora')->join('ciclo_escolar','ciclo_escolar.id','=','oficiosemitidos.id_ciclo')->where('oficiosemitidos.id_ciclo','=',$aux)->select('oficiosemitidos.num_oficio','oficiosemitidos.nombre_oficio','oficiosemitidos.asunto','oficiosemitidos.referencia','oficiosemitidos.estado','DirectorioExterno.nombre_c','DirectorioExterno.puesto as puestoext','DirectorioExterno.direccion','oficiosemitidos.salida','directoriointerno.nombre','directoriointerno.area','directoriointerno.puesto','oficiosemitidos.observaciones')->get();
      $sheet->fromArray($tarjeta);
      $sheet->row(1,['N° OFICIO','NOMBRE OFICIO','ASUNTO','REFERENCIA','ESTADO','DIRIGIDO','PUESTO','DIRECCION','FECHA SALIDA','ELABORO','AREA','PUESTO']);
      $sheet->setOrientation('landscape');
    });
   })->export('xls');
 }

 public function ultimo_oficio($ciclo){
  $existe=DB::table('oficiosemitidos')->where('id_ciclo','=',$ciclo)->get();
  $aux=count($existe);

  if($aux > 0){
   $oficio= OficiosEmitidosModel::orderBy('num_oficio','desc')->where('id_ciclo','=',$ciclo)->first()->id;
   $ultimo=$oficio+1;

 }else{
  $ultimo = 001;  
}
return response()->json(
  $ultimo);

} 


public function ver_oficios_e(){
  $ciclos=DB::table('ciclo_escolar')->get();

  return view('administrativa.oficios_emitidos.ver_oficios', ['ciclos'=>$ciclos]);
}

public function ver_oficios_ciclo($ciclo){
  $oficio= OficiosEmitidosModel::
  select('id','num_oficio','estado')->where('id_ciclo','=',$ciclo)
  ->get();
  return response()->json(
    $oficio);

}

public function ver_oficios_area($ciclo,$area){
  $oficio= OficiosEmitidosModel::join('directoriointerno','directoriointerno.id','=','oficiosemitidos.id_elabora')->join('directorioexterno','directorioexterno.id','=','oficiosemitidos.id_dirigido')->where('oficiosemitidos.id_ciclo','=',$ciclo)->where('directoriointerno.area','=',$area)->
  select('oficiosemitidos.id','oficiosemitidos.num_oficio','oficiosemitidos.estado','directoriointerno.nombre','directorioexterno.nombre_c','directorioexterno.lic','oficiosemitidos.salida','oficiosemitidos.asunto','oficiosemitidos.referencia')
  ->get();
  return response()->json(
    $oficio);
}

public function excel2(Request $request, $aux,$area)
{

 Excel::create('OFICIOS EMITIDOS PETC POR AREA', function($excel) use($aux,$area) {
   $excel->sheet('Excel sheet', function($sheet) use($aux,$area) {



    $tarjeta = OficiosEmitidosModel::join('DirectorioExterno','DirectorioExterno.id','=','oficiosemitidos.id_dirigido')->join('directoriointerno','directoriointerno.id','=','oficiosemitidos.id_elabora')->join('ciclo_escolar','ciclo_escolar.id','=','oficiosemitidos.id_ciclo')->where('oficiosemitidos.id_ciclo','=',$aux)->where('directoriointerno.area','=',$area)->select('oficiosemitidos.num_oficio','oficiosemitidos.nombre_oficio','oficiosemitidos.asunto','oficiosemitidos.referencia','oficiosemitidos.estado','DirectorioExterno.nombre_c','DirectorioExterno.puesto as puestoext','DirectorioExterno.direccion','oficiosemitidos.salida','directoriointerno.nombre','directoriointerno.area','directoriointerno.puesto','oficiosemitidos.observaciones')->get();
    $sheet->fromArray($tarjeta);
    $sheet->row(1,['N° OFICIO','NOMBRE OFICIO','ASUNTO','REFERENCIA','ESTADO','DIRIGIDO','PUESTO','DIRECCION','FECHA SALIDA','ELABORO','AREA','PUESTO']);
    $sheet->setOrientation('landscape');
  });
 })->export('xls');
}


public function ver_oficios_persona(){
 $user = Auth::user()->id;
 $oficio= OficiosEmitidosModel::join('directoriointerno','directoriointerno.id','=','oficiosemitidos.id_elabora')->where('directoriointerno.id','=',$user)->select(DB::raw('COUNT(oficiosemitidos.id) as total'))->first();
 return $oficio->total;
}

public function ver_oficios_personar(){
 $user = Auth::user()->id;
 $oficio= OficiosRecibidosModel::join('directoriointerno','directoriointerno.id','=','oficiosrecibidos.id_contesta')->where('directoriointerno.id','=',$user)->select(DB::raw('COUNT(oficiosrecibidos.id) as total'))->first();

 return $oficio->total;
}

}
