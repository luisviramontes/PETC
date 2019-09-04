<?php

namespace petc\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use petc\Http\Requests;

use petc\Http\Controllers\Controller;
use petc\ActividadModel;


use DB;
use Maatwebsite\Excel\Facades\Excel;
use PHPExcel_Worksheet_Drawing;
use Validator;
use \Milon\Barcode\DNS1D;
use \Milon\Barcode\DNS2D;
use petc\Http\Requests\CapturaRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Collection as Collection;


class ActividadController extends Controller
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
  public function  index(request $request)
  {
    if($request)
    { 
        $query=trim($request->GET('searchText'));
        $query2=trim($request->GET('ciclo_escolar'));
        $ciclos=DB::table('ciclo_escolar')->get();


        if($query == ""  && $query2 == ""){
            $actividad= DB::table('actividad')
            ->join('ciclo_escolar', 'ciclo_escolar.id', '=','actividad.id_ciclo')
            ->select('actividad.*','ciclo_escolar.ciclo')
            ->paginate(40);

        }elseif($query2 <> "" && $query == "") {
          $actividad= DB::table('actividad')
          ->join('ciclo_escolar', 'ciclo_escolar.id', '=','actividad.id_ciclo')
          ->where('ciclo_escolar.id','=',$query2)
          ->select('actividad.*','ciclo_escolar.ciclo')
          ->paginate(40);


      }else{
          $actividad= DB::table('actividad')
          ->join('ciclo_escolar', 'ciclo_escolar.id', '=','actividad.id_ciclo')
          ->where('ciclo_escolar.id','=',$query2)->orwhere('actividad.nombre_actividad','LIKE','%'.$query.'%')->orwhere('actividad.fecha','LIKE','%'.$query.'%')
          ->select('actividad.*','ciclo_escolar.ciclo')
          ->paginate(40);
      }


      return view('administrativa.actividad.index',["actividad"=>$actividad,"searchText"=>$query,"ciclo_escolar"=>$query2,"ciclos"=>$ciclos]);
        // return view('nomina.tabla_pagos.index',['tabla_pagos' => $tabla_pagos,'ciclos'=> $ciclos]);
        //
  }}
        //


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       $ciclos=DB::table('ciclo_escolar')->get();
       return view("administrativa.actividad.create",["ciclos"=>$ciclos]);
        //
   }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   $user = Auth::user()->name;
       $actividad = new ActividadModel;
       $actividad->nombre_actividad=$request->get('nombre');
       $actividad->lugar=$request->get('lugar');
       $actividad->fecha=$request->get('fecha');
       $actividad->area=$request->get('area');
       $actividad->motivo=$request->get('motivo');
       $actividad->descripcion=$request->get('descripcion');
       $actividad->id_ciclo=$request->get('ciclo_escolar');
       $actividad->estado="ACTIVO";
       $actividad->captura=$user;


    if(Input::hasFile('archivo')){
        $file=$request->file('archivo');
        $file->move(public_path().'/img/administrativa/actividad',$file->getClientoriginalName());
        $actividad->archivo=$file->getClientoriginalName();
    }

    

    $actividad->save();
    return redirect('/actividad');
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
       $actividad = ActividadModel::find($id);
       return view("administrativa.actividad.edit",["ciclos"=>$ciclos,"actividad"=>$actividad]);
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
    { $user = Auth::user()->name;
      $aviso = ActividadModel::find($id);
      $aviso->nombre_actividad=$request->get('nombre');
      $aviso->lugar=$request->get('lugar');
      $aviso->fecha=$request->get('fecha');
      $aviso->area=$request->get('area');
      $aviso->motivo=$request->get('motivo');
      $aviso->descripcion=$request->get('descripcion');
      $aviso->id_ciclo=$request->get('ciclo_escolar');
      $aviso->estado="ACTIVO";
      $aviso->captura=$user;

      if(Input::hasFile('archivo')){
        $file=$request->file('archivo');
        $file->move(public_path().'/img/administrativa/actividad',$file->getClientoriginalName());
        $aviso->archivo=$file->getClientoriginalName();
    }

    $aviso->update();
    return redirect('/actividad');
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
      $aviso = ActividadModel::find($id);
      $aviso->delete();
      return redirect('/actividad');
        //
  }

  public function excel(Request $request, $aux)
  {

     Excel::create('ACTIVIDADES PETC', function($excel) use($aux) {
       $excel->sheet('Excel sheet', function($sheet) use($aux) {
        $tarjeta = ActividadModel::join('ciclo_escolar', 'ciclo_escolar.id', '=','actividad.id_ciclo')
        ->where('ciclo_escolar.id','=',$aux)
        ->select('actividad.id','actividad.nombre_actividad','actividad.lugar','actividad.fecha','actividad.area','actividad.motivo','actividad.descripcion','ciclo_escolar.ciclo','actividad.estado','actividad.captura')->get();
        $sheet->fromArray($tarjeta);
        $sheet->row(1,['N°','NOMBRE ACTIVIDAD','LUGAR','FECHA ','AREA','MOTIVO','DESCRIPCION','CICLO ESCOLAR','ESTADO','CAPTURO']);
        $sheet->setOrientation('landscape');
    });
   })->export('xls');
 }


}
