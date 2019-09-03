<?php

namespace petc\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use petc\Http\Requests;

use petc\Http\Controllers\Controller;
use petc\CapacitacionesModel;


use DB;
use Maatwebsite\Excel\Facades\Excel;
use PHPExcel_Worksheet_Drawing;
use Validator;
use \Milon\Barcode\DNS1D;
use \Milon\Barcode\DNS2D;
use petc\Http\Requests\CapturaRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Collection as Collection;

class CapacitacionesController extends Controller
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
     if($request)
     { 
        $query=trim($request->GET('searchText'));
        $query2=trim($request->GET('ciclo_escolar'));
        $ciclos=DB::table('ciclo_escolar')->get();


        if($query == ""  && $query2 == ""){
            $capacitaciones= DB::table('capacitaciones')
            ->join('ciclo_escolar', 'ciclo_escolar.id', '=','capacitaciones.id_ciclo')
            ->select('capacitaciones.*','ciclo_escolar.ciclo')
            ->paginate(40);

        }elseif($query2 <> "" && $query == "") {
          $capacitaciones= DB::table('capacitaciones')
          ->join('ciclo_escolar', 'ciclo_escolar.id', '=','capacitaciones.id_ciclo')
          ->where('ciclo_escolar.id','=',$query2)
          ->select('capacitaciones.*','ciclo_escolar.ciclo')
          ->paginate(40);


      }else{
          $capacitaciones= DB::table('capacitaciones')
          ->join('ciclo_escolar', 'ciclo_escolar.id', '=','capacitaciones.id_ciclo')
          ->where('ciclo_escolar.id','=',$query2)->where('capacitaciones.num_oficio','LIKE','%'.$query.'%')->orwhere('capacitaciones.nombre_capacitacion','LIKE','%'.$query.'%')->orwhere('capacitaciones.dirigido','LIKE','%'.$query.'%')->orwhere('capacitaciones.lugar','LIKE','%'.$query.'%')->orwhere('capacitaciones.imparte','LIKE','%'.$query.'%')
          ->select('capacitaciones.*','ciclo_escolar.ciclo')
          ->paginate(40);
      }


      return view('academica.capacitaciones.index',["capacitaciones"=>$capacitaciones,"searchText"=>$query,"ciclo_escolar"=>$query2,"ciclos"=>$ciclos]);
        // return view('nomina.tabla_pagos.index',['tabla_pagos' => $tabla_pagos,'ciclos'=> $ciclos]);
        //
  }}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       $ciclos=DB::table('ciclo_escolar')->get();
       return view("academica.capacitaciones.create",["ciclos"=>$ciclos]);

        //
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
       $capacitacion = new CapacitacionesModel;
       $capacitacion->nombre_capacitacion=$request->get('nombre_c');
       $capacitacion->dirigido=$request->get('dirijido');
       $capacitacion->lugar=$request->get('lugar');
       $capacitacion->dia=$request->get('fecha');
       $capacitacion->hora=$request->get('hora');
       $capacitacion->imparte=$request->get('imparte');
       $capacitacion->area=$request->get('area');
       $capacitacion->motivo=$request->get('motivo');
       $capacitacion->descripcion=$request->get('descripcion');
       $capacitacion->id_ciclo=$request->get('ciclo_escolar');
       $capacitacion->estado="PENDIENTE";
       $capacitacion->captura=$user;

       if(Input::hasFile('archivo')){
        $file=$request->file('archivo');
        $file->move(public_path().'/img/capacitaciones',$file->getClientoriginalName());
        $capacitacion->archivo=$file->getClientoriginalName();
    }
    $capacitacion->save();
    return redirect('/capacitaciones');
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
       $ciclos=DB::table('ciclo_escolar')->get();
       $capacitaciones = CapacitacionesModel::find($id);
       return view("academica.capacitaciones.edit",["ciclos"=>$ciclos,"capacitaciones"=>$capacitaciones]);

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
       $capacitacion = CapacitacionesModel::find($id);
       $capacitacion->nombre_capacitacion=$request->get('nombre_c');
       $capacitacion->dirigido=$request->get('dirijido');
       $capacitacion->lugar=$request->get('lugar');
       $capacitacion->dia=$request->get('fecha');
       $capacitacion->hora=$request->get('hora');
       $capacitacion->imparte=$request->get('imparte');
       $capacitacion->area=$request->get('area');
       $capacitacion->motivo=$request->get('motivo');
       $capacitacion->descripcion=$request->get('descripcion');
       $capacitacion->id_ciclo=$request->get('ciclo_escolar');
       $capacitacion->estado="PENDIENTE";
       $capacitacion->captura=$user;

       if(Input::hasFile('archivo')){
        $file=$request->file('archivo');
        $file->move(public_path().'/img/capacitaciones',$file->getClientoriginalName());
        $capacitacion->archivo=$file->getClientoriginalName();
    }
    $capacitacion->update();
    return redirect('/capacitaciones');


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
       $capacitaciones = CapacitacionesModel::find($id);
       $capacitaciones->delete();
       return redirect('/capacitaciones');
        //
   }

   public function capacitacion_realizada($id){
       $capacitaciones = CapacitacionesModel::find($id);
       $user = Auth::user()->name;
       $capacitaciones->captura=$user;
       $capacitaciones->estado="REALIZADA";

       $capacitaciones->update();
       return redirect('/capacitaciones');
   }

   public function excel(Request $request, $aux)
   {

     Excel::create('CAPACITACIONES', function($excel) use($aux) {
       $excel->sheet('Excel sheet', function($sheet) use($aux) {
        $tarjeta = CapacitacionesModel::join('ciclo_escolar', 'ciclo_escolar.id', '=','capacitaciones.id_ciclo')
        ->where('ciclo_escolar.id','=',$aux)
        ->select('capacitaciones.id','capacitaciones.nombre_capacitacion','capacitaciones.dirigido','capacitaciones.lugar','capacitaciones.dia','capacitaciones.hora','capacitaciones.imparte','capacitaciones.area','capacitaciones.motivo','capacitaciones.descripcion','ciclo_escolar.ciclo','capacitaciones.estado','capacitaciones.captura')->get();
        $sheet->fromArray($tarjeta);
        $sheet->row(1,['N°','NOMBRE CAPACITACION','DIRIGIDO','LUGAR','DIA','HORA','IMPARTE','AREA','MOTIVO','DESCRIPCION','CICLO ESCOLAR','ESTADO','CAPTURO']);
        $sheet->setOrientation('landscape');
    });
   })->export('xls');
 }



}
