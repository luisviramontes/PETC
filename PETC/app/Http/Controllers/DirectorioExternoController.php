<?php

namespace petc\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use petc\Http\Requests;

use petc\Http\Controllers\Controller;
use petc\DirectorioExternoModel;



use DB;
use Maatwebsite\Excel\Facades\Excel;
use PHPExcel_Worksheet_Drawing;
use Validator;
use \Milon\Barcode\DNS1D;
use \Milon\Barcode\DNS2D;
use petc\Http\Requests\CapturaRequest;;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Collection as Collection;
class DirectorioExternoController extends Controller
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
      $personal= DB::table('directorioexterno')->select('directorioexterno.*')->where('directorioexterno.nombre','LIKE','%'.$query.'%')->orwhere('directorioexterno.puesto','LIKE','%'.$query.'%')->orwhere('directorioexterno.puesto','LIKE','%'.$query.'%')->orwhere('directorioexterno.direccion','LIKE','%'.$query.'%')->orwhere('directorioexterno.ext','LIKE','%'.$query.'%')->paginate(40);

      return view('nomina.directorio_externo.index',["personal"=>$personal,"searchText"=>$query]);
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
      return view('nomina.directorio_externo.create');
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
        $user = Auth::user()->name;

        $tabla= new DirectorioExternoModel;
        $tabla->nombre=$request->get('nombre');
        $tabla->apellido1=$request->get('paterno');
        $tabla->apellido2=$request->get('materno');        
        $tabla->a_n=$request->get('a_n');
        $tabla->nombre_c=$tabla->nombre." ".$tabla->apellido1." ".$tabla->apellido2;
        $tabla->lic=$request->get('lic');
        $tabla->puesto=$request->get('puesto');
        $tabla->direccion=$request->get('direccion');
        $tabla->a_d=$request->get('a_d');
        $tabla->correo=$request->get('email');
        $tabla->ext=$request->get('ext');
        $tabla->captura=$user;
        $tabla->estado="ACTIVO";
        $tabla->save();
        return Redirect::to('directorio_externo'); 


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
     $personal=DirectorioExternoModel::findOrFail($id);

     return view('nomina.directorio_externo.edit', ['personal'=>$personal]);
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
        $user = Auth::user()->name;
        $tabla=DirectorioExternoModel::findOrFail($id);
        $tabla->nombre=$request->get('nombre');
        $tabla->apellido1=$request->get('paterno');
        $tabla->apellido2=$request->get('materno');        
        $tabla->a_n=$request->get('a_n');
        $tabla->nombre_c=$tabla->nombre." ".$tabla->apellido1." ".$tabla->apellido2;
        $tabla->lic=$request->get('lic');
        $tabla->puesto=$request->get('puesto');
        $tabla->direccion=$request->get('direccion');
        $tabla->a_d=$request->get('a_d');
        $tabla->correo=$request->get('email');
        $tabla->ext=$request->get('ext');
        $tabla->captura=$user;
        $tabla->estado="ACTIVO";
        $tabla->update();
        return Redirect::to('directorio_externo'); 
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
        $user = Auth::user()->name;
        $personal=DirectorioExternoModel::findOrFail($id);
        $personal->estado="INACTIVO";
         $personal->captura=$user;
        $personal->update();
        return Redirect::to('directorio_externo'); 
        //
    }

    public function excel(Request $request)
    {

       Excel::create('DIRECTORIO EXTERNO', function($excel) {
           $excel->sheet('Excel sheet', function($sheet) {
                 //otra opción -> $products = Product::select('name')->get();
               $tabla = DirectorioExternoModel::select('lic','nombre_c','nombre','apellido1','apellido2','a_n','puesto','direccion','a_d','correo','ext','captura')->where('estado','=','ACTIVO')
             //->where('directorio_regional')
               ->get();
               $sheet->fromArray($tabla);
               $sheet->row(1,['LIC','NOMBRE COMPLETO','NOMBRE','APELLIDO P','APELLIDO M','A_N','PUESTO','DIRECCION','A_D','CORREO','EXT','CAPTURA']);
               $sheet->setOrientation('landscape');
           });
       })->export('xls');
   }

   public function invoice(){
     $personal = DirectorioExternoModel::select('lic','nombre_c','nombre','apellido1','apellido2','a_n','puesto','direccion','a_d','correo','ext','captura')->where('estado','=','ACTIVO')
             //->where('directorio_regional')
     ->get();


     $date = date('Y-m-d');
     $invoice = "2222";
        //print_r($);
     $view =  \View::make('nomina.directorio_externo.invoice', compact('date', 'invoice','personal'))->render();
        //->setPaper($customPaper, 'landscape');
     $pdf = \App::make('dompdf.wrapper');
     $pdf->loadHTML($view);
     return $pdf->stream('invoice');
 }

}
