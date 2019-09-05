<?php

namespace petc\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use petc\Http\Requests;

use petc\Http\Controllers\Controller;
use petc\Estadistica911Model;


use Dompdf\Dompdf;
use DB;
use Maatwebsite\Excel\Facades\Excel;
use PHPExcel_Worksheet_Drawing;
use Validator;
use \Milon\Barcode\DNS1D;
use \Milon\Barcode\DNS2D;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Collection as Collection;

class Estadistica911Controller extends Controller
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
      if($tipo_usuario <> "1" && $tipo_usuario <> "2"  && $tipo_usuario <> "3" && $tipo_usuario <> "4" &&    $tipo_usuario <> "5" && $tipo_usuario <> "6"){
       return view('permisos');

   }else{
     if($request)
     {
       $query2=trim($request->GET('ciclo_escolar'));
       $query=trim($request->GET('searchText'));
       $ciclos=DB::table('ciclo_escolar')->get();

       if($query == "" && $query2 == ""){
         $query2=2;
         $centro = DB::table('estadistica911')
         ->join('ciclo_escolar', 'ciclo_escolar.id', '=','estadistica911.id_ciclo')
         ->join('centro_trabajo', 'centro_trabajo.id', '=','estadistica911.id_centro_trabajo')
         ->join('region', 'centro_trabajo.id_region', '=','region.id')
         ->join('localidades', 'centro_trabajo.id_localidades', '=','localidades.id')
         ->join('municipios', 'centro_trabajo.id_municipios', '=','municipios.id')
         ->select('estadistica911.*','centro_trabajo.cct','centro_trabajo.nombre_escuela','centro_trabajo.alimentacion','centro_trabajo.domicilio','centro_trabajo.telefono','centro_trabajo.email','region.region','region.sostenimiento','localidades.nom_loc','municipios.municipio','ciclo_escolar.ciclo')
         ->where('estadistica911.id_ciclo','LIKE','%'.$query2.'%')
         ->paginate(10);
     }elseif ($query == "" && $query2 != "") {
      $centro = DB::table('estadistica911')
      ->join('ciclo_escolar', 'ciclo_escolar.id', '=','estadistica911.id_ciclo')
      ->join('centro_trabajo', 'centro_trabajo.id', '=','estadistica911.id_centro_trabajo')
      ->join('region', 'centro_trabajo.id_region', '=','region.id')
      ->join('localidades', 'centro_trabajo.id_localidades', '=','localidades.id')
      ->join('municipios', 'centro_trabajo.id_municipios', '=','municipios.id')
      ->select('estadistica911.*','centro_trabajo.cct','centro_trabajo.nombre_escuela','centro_trabajo.alimentacion','centro_trabajo.domicilio','centro_trabajo.telefono','centro_trabajo.email','region.region','region.sostenimiento','localidades.nom_loc','municipios.municipio','ciclo_escolar.ciclo')
      ->where('estadistica911.id_ciclo','LIKE','%'.$query2.'%')
      ->paginate(10);

  }else {
      $centro = DB::table('estadistica911')
      ->join('ciclo_escolar', 'ciclo_escolar.id', '=','estadistica911.id_ciclo')
      ->join('centro_trabajo', 'centro_trabajo.id', '=','estadistica911.id_centro_trabajo')
      ->join('region', 'centro_trabajo.id_region', '=','region.id')
      ->join('localidades', 'centro_trabajo.id_localidades', '=','localidades.id')
      ->join('municipios', 'centro_trabajo.id_municipios', '=','municipios.id')
      ->select('estadistica911.*','centro_trabajo.cct','centro_trabajo.nombre_escuela','centro_trabajo.alimentacion','centro_trabajo.domicilio','centro_trabajo.telefono','centro_trabajo.email','region.region','region.sostenimiento','localidades.nom_loc','municipios.municipio','ciclo_escolar.ciclo')
      ->where('estadistica911.id_ciclo','LIKE','%'.$query2.'%')
      ->where('centro_trabajo.cct','LIKE','%'.$query.'%')
      ->orwhere('localidades.nom_loc','LIKE','%'.$query.'%')
      ->orwhere('municipios.municipio','LIKE','%'.$query.'%')
      ->orwhere('centro_trabajo.domicilio','LIKE','%'.$query.'%')
      ->where('centro_trabajo.nombre_escuela','LIKE','%'.$query.'%')
      ->paginate(10);

  }

  return view('nomina.estadistica911.index',["centro"=>$centro,"searchText"=>$query,"ciclo_escolar"=>$query2,"ciclos"=>$ciclos]);

}
        //
}}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $tipo_usuario = Auth::user()->tipo_usuario;
      if($tipo_usuario <> "2" && $tipo_usuario <>"5"){
       return view('permisos');

   }else{
     $ciclos=DB::table('ciclo_escolar')->get();
     return view('nomina.estadistica911.create',["ciclos"=>$ciclos]);

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
    {      $tipo_usuario = Auth::user()->tipo_usuario;
      if($tipo_usuario <> "2" && $tipo_usuario <>"5"){
       return view('permisos');

   }else{
     $user = Auth::user()->name;
     $path = $request->file->getRealPath();
     $data = Excel::load($path)->get();

     foreach ($data as $key => $value) {  
        $ciclo = $value->ciclo_escolar;
        $id_ciclo=DB::table('ciclo_escolar')->where('ciclo','=',$ciclo)->first()->id;
    }

    $estadistica=DB::table('estadistica911')->where('id_ciclo','=',$id_ciclo)->get();
    $cuenta = count($estadistica);

    for ($x=0; $x < $cuenta  ; $x++) {
      $elimina = Estadistica911Model::findOrFail($estadistica[$x]->id);
      $elimina->delete();
  }


  foreach ($data as $key => $value) {  
    $est= new Estadistica911Model;
    $cct = $value->cct;
    $ciclo = $value->ciclo_escolar;
    $est->total_alumnos = $value->total_alumnos;
    $est->total_ninas = $value->total_ninas;
    $est->total_ninos = $value->total_ninos;
    $est->total_grupos = $value->total_grupos;
    $est->total_grados = $value->total_grados;
    $est->total_directores = $value->total_directores;
    $est->total_docentes = $value->total_docentes;
    $est->total_fisica = $value->total_fisica;
    $est->total_usaer = $value->total_usaer;
    $est->total_artistica = $value->total_artistica;
    $est->total_intendentes = $value->total_intendentes;
    $id_ciclo=DB::table('ciclo_escolar')->where('ciclo','=',$ciclo)->first()->id;
    $id_centro=DB::table('centro_trabajo')->where('cct','=',$cct)->first()->id;
    $est->id_centro_trabajo=$id_centro;       
    $est->id_ciclo = $id_ciclo;
    $est->captura = $user;
    $est->save();   
}
  return Redirect::to('estadistica911');
}
        //
}

public function verifica($ciclo){
 
    $ciclos=DB::table('ciclo_escolar')->where('id','=',$ciclo)->get();
return response()->json(
  $ciclos);

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
    {      $tipo_usuario = Auth::user()->tipo_usuario;
      if($tipo_usuario <> "2" && $tipo_usuario <>"5"){
       return view('permisos');

   }else{

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
    {      $tipo_usuario = Auth::user()->tipo_usuario;
      if($tipo_usuario <> "2" && $tipo_usuario <>"5"){
       return view('permisos');

   }else{
     $user = Auth::user()->name;
     $path = $formulario->file->getRealPath();
     $data = Excel::load($path)->get();

     foreach ($data as $key => $value) {     
     }
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
    {      $tipo_usuario = Auth::user()->tipo_usuario;
      if($tipo_usuario <> "2" && $tipo_usuario <>"5"){
       return view('permisos');

   }else{
     $user = Auth::user()->name;
     $path = $formulario->file->getRealPath();
     $data = Excel::load($path)->get();

     foreach ($data as $key => $value) {     
     }
 }
        //
}
}
