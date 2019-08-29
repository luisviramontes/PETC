<?php

namespace petc\Http\Controllers;

use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use petc\Http\Requests;
use petc\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use petc\DirectorioInternoModel;
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
class DirectorioInternoController extends Controller
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
       // $aux=$request->get('searchText');
      $personal= DB::table('directoriointerno')->select('directoriointerno.*')->where('directoriointerno.nombre','LIKE','%'.$query.'%')->orwhere('directoriointerno.puesto','LIKE','%'.$query.'%')->orwhere('directoriointerno.rfc','LIKE','%'.$query.'%')->orwhere('directoriointerno.licenciatura','LIKE','%'.$query.'%')->orwhere('directoriointerno.telefono','LIKE','%'.$query.'%')->paginate(40);

      return view('nomina.directorio_interno.index',["personal"=>$personal,"searchText"=>$query]);
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
      if($tipo_usuario <> "2" || $tipo_usuario=="5"){
       return view('permisos');

      }else{
      return view('nomina.directorio_interno.create');
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
      if($tipo_usuario <> "2" || $tipo_usuario=="5"){
       return view('permisos');

      }else{
      $user = Auth::user()->name;
        $tabla= new DirectorioInternoModel;
        $tabla->nombre=$request->get('nombre');
        $tabla->abrebiatura=$request->get('a_n');
        $tabla->rfc=$request->get('rfc_input');        
        $tabla->curp=$request->get('curp');
        $tabla->fecha_nacimiento=$request->get('fecha_nacimiento');
        $tabla->telefono=$request->get('telefono');
        $tabla->email=$request->get('email');
        $tabla->domicilio=$request->get('domicilio');
        $tabla->num_seguro=$request->get('seguro');
        $tabla->lic=$request->get('lic');
        $tabla->licenciatura=$request->get('licenciatura');
        $tabla->fecha_ingreso=$request->get('fecha_ingreso');
        if(Input::hasFile('imagen')){
            $file=$request->file('imagen');
            $file->move(public_path().'/img/personal_etc',$file->getClientoriginalName());
            $tabla->imagen=$file->getClientoriginalName();
        }
        $tabla->area=$request->get('area');
        $tabla->puesto=$request->get('puesto');
        $tabla->tipo=$request->get('tipo');
        $tabla->sueldo_mensual=$request->get('sueldo_mensual');
        $tabla->deducciones=$request->get('deducciones');
        $tabla->neto=$request->get('neto');
        $tabla->capturo=$user;
        $tabla->estado="ACTIVO";
        $tabla->save();
        return Redirect::to('directorio_interno'); 
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
       $personal=DirectorioInternoModel::findOrFail($id);

       return view('nomina.directorio_interno.edit', ['personal'=>$personal]);
        //
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
      $tabla=DirectorioInternoModel::findOrFail($id);
      $tabla->nombre=$request->get('nombre');
      $tabla->abrebiatura=$request->get('a_n');
      $tabla->rfc=$request->get('rfc_input');        
      $tabla->curp=$request->get('curp');
      $tabla->fecha_nacimiento=$request->get('fecha_nacimiento');
      $tabla->telefono=$request->get('telefono');
      $tabla->email=$request->get('email');
      $tabla->domicilio=$request->get('domicilio');
      $tabla->num_seguro=$request->get('seguro');
      $tabla->lic=$request->get('lic');
      $tabla->licenciatura=$request->get('licenciatura');
      $tabla->fecha_ingreso=$request->get('fecha_ingreso');
      if(Input::hasFile('imagen')){
        $file=$request->file('imagen');
        $file->move(public_path().'/img/personal_etc',$file->getClientoriginalName());
        $tabla->imagen=$file->getClientoriginalName();
    }
    $tabla->area=$request->get('area');
    $tabla->puesto=$request->get('puesto');
    $tabla->tipo=$request->get('tipo');
    $tabla->sueldo_mensual=$request->get('sueldo_mensual');
    $tabla->deducciones=$request->get('deducciones');
    $tabla->neto=$request->get('neto');
    $tabla->capturo=$user;
    $tabla->estado="ACTIVO";
    $tabla->update();
    return Redirect::to('directorio_interno'); 
        //
}}

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
              $tipo_usuario = Auth::user()->tipo_usuario;
      if($tipo_usuario <> "2" || $tipo_usuario=="5"){
       return view('permisos');

      }else{
      $user = Auth::user()->name;
        $personal=DirectorioInternoModel::findOrFail($id);
        $personal->estado="INACTIVO";
        $personal->capturo=$user;
        $personal->fecha_salida=$request->get('fecha_salida'.$id);

        $personal->update();
        return Redirect::to('directorio_interno'); 
        //
    }}

        public function excel(Request $request)
    {

       Excel::create('DIRECTORIO INTERNO', function($excel) {
           $excel->sheet('Excel sheet', function($sheet) {
                 //otra opción -> $products = Product::select('name')->get();
               $tabla = DirectorioInternoModel::select('lic','nombre','rfc','curp','abrebiatura','fecha_nacimiento','telefono','email','domicilio','num_seguro','licenciatura','fecha_ingreso','fecha_salida','area','puesto','tipo','sueldo_mensual','deducciones','neto','estado','capturo')->where('estado','=','ACTIVO')
             //->where('directorio_regional')
               ->get();
               $sheet->fromArray($tabla);
               $sheet->row(1,['LIC','NOMBRE COMPLETO','R.F.C','CURP','AB','FECHA DE NACIMIENTO','TELEFONO','EMAIL','DOMICILIO','NUM_SEGURO','LICENCIATURA','FECHA DE INGRESO','FECHA DE SALIDA','AREA','PUESTO','TIPO CONTRATO','SUELDO MENSUAL','DEDUCCIONES','NETO','ESTADO','CAPTURO']);
               $sheet->setOrientation('landscape');
           });
       })->export('xls');
   }

      public function invoice(){
     $personal = DirectorioInternoModel::where('estado','=','ACTIVO')
             //->where('directorio_regional')
     ->get();


     $date = date('Y-m-d');
     $invoice = "2222";
        //print_r($);
     $view =  \View::make('nomina.directorio_interno.invoice', compact('date', 'invoice','personal'))->render();
        //->setPaper($customPaper, 'landscape');
     $pdf = \App::make('dompdf.wrapper');
     $pdf->loadHTML($view);
     return $pdf->stream('invoice');
 }

       public function perfil($id){
       $tipo_usuario = Auth::user()->tipo_usuario;
      if($tipo_usuario < 0 || $tipo_usuario > 7){
       return view('permisos');

      }else{
       $personal=DirectorioInternoModel::findOrFail($id);
       $user = Auth::user()->id_usuario;
       $oficioe= OficiosEmitidosModel::join('directoriointerno','directoriointerno.id','=','oficiosemitidos.id_elabora')->join('directorioexterno','directorioexterno.id','=','oficiosemitidos.id_dirigido')->where('directoriointerno.id','=',$user)->select('oficiosemitidos.*','directoriointerno.nombre','directoriointerno.lic','directorioexterno.nombre_c','directorioexterno.lic as licext');

       $oficior= OficiosRecibidosModel::join('directoriointerno','directoriointerno.id','=','oficiosrecibidos.id_contesta')->where('directoriointerno.id','=',$user)->select('oficiosrecibidos.*','directoriointerno.nombre','directoriointerno.lic');

       return view('perfil', ['personal'=>$personal,'oficioe'=>$oficioe,'oficior'=>$oficior]);
        //
   }

 }


        public function perfilactualiza($id){
       $tipo_usuario = Auth::user()->tipo_usuario;
      if($tipo_usuario < 0 || $tipo_usuario > 7){
       return view('permisos');

      }else{
       $personal=DirectorioInternoModel::findOrFail($id);
       $user = Auth::user()->id_usuario;
       $oficioe= OficiosEmitidosModel::join('directoriointerno','directoriointerno.id','=','oficiosemitidos.id_elabora')->join('directorioexterno','directorioexterno.id','=','oficiosemitidos.id_dirigido')->where('directoriointerno.id','=',$user)->select('oficiosemitidos.*','directoriointerno.nombre','directoriointerno.lic','directorioexterno.nombre_c','directorioexterno.lic as licext');

       $oficior= OficiosRecibidosModel::join('directoriointerno','directoriointerno.id','=','oficiosrecibidos.id_contesta')->where('directoriointerno.id','=',$user)->select('oficiosrecibidos.*','directoriointerno.nombre','directoriointerno.lic');

       return view('perfil', ['personal'=>$personal,'oficioe'=>$oficioe,'oficior'=>$oficior]);
        //
   }

 }




}
