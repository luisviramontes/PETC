<?php

namespace petc\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use petc\Http\Requests;

use petc\Http\Controllers\Controller;
use petc\AvisosModel;


use DB;
use Maatwebsite\Excel\Facades\Excel;
use PHPExcel_Worksheet_Drawing;
use Validator;
use \Milon\Barcode\DNS1D;
use \Milon\Barcode\DNS2D;
use petc\Http\Requests\CapturaRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Collection as Collection;

class AvisosController extends Controller
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
  { if($request)
     { 
        $query=trim($request->GET('searchText'));
        $query2=trim($request->GET('ciclo_escolar'));
        $ciclos=DB::table('ciclo_escolar')->get();


        if($query == ""  && $query2 == ""){
            $avisos= DB::table('avisos')
            ->join('ciclo_escolar', 'ciclo_escolar.id', '=','avisos.id_ciclo')
            ->select('avisos.*','ciclo_escolar.ciclo')
            ->paginate(40);

        }elseif($query2 <> "" && $query == "") {
          $avisos= DB::table('avisos')
          ->join('ciclo_escolar', 'ciclo_escolar.id', '=','avisos.id_ciclo')
          ->where('ciclo_escolar.id','=',$query2)
          ->select('avisos.*','ciclo_escolar.ciclo')
          ->paginate(40);


      }else{
          $avisos= DB::table('avisos')
          ->join('ciclo_escolar', 'ciclo_escolar.id', '=','avisos.id_ciclo')
          ->where('ciclo_escolar.id','=',$query2)->orwhere('avisos.nombre_aviso','LIKE','%'.$query.'%')->orwhere('avisos.dirigido','LIKE','%'.$query.'%')
          ->select('avisos.*','ciclo_escolar.ciclo')
          ->paginate(40);
      }


      return view('administrativa.avisos.index',["avisos"=>$avisos,"searchText"=>$query,"ciclo_escolar"=>$query2,"ciclos"=>$ciclos]);
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
       return view("administrativa.avisos.create",["ciclos"=>$ciclos]);
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
     $aviso = new AvisosModel;
     $aviso->nombre_aviso=$request->get('nombre');
     $aviso->dirigido=$request->get('dirijido');
     $aviso->fecha_emite=$request->get('fecha');
     $aviso->area=$request->get('area');
     $aviso->motivo=$request->get('motivo');
     $aviso->descripcion=$request->get('descripcion');
     $aviso->id_ciclo=$request->get('ciclo_escolar');
     $aviso->estado="ACTIVO";
     $aviso->captura=$user;

     if(Input::hasFile('archivo')){
        $file=$request->file('archivo');
        $file->move(public_path().'/img/administrativa/avisos/pdf',$file->getClientoriginalName());
        $aviso->archivo=$file->getClientoriginalName();
    }

    if(Input::hasFile('imagen')){
        $file=$request->file('imagen');
        $file->move(public_path().'/img/administrativa/avisos/imagen',$file->getClientoriginalName());
        $aviso->imagen=$file->getClientoriginalName();
    }
    $aviso->save();
    return redirect('/avisos');
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
     $aviso = AvisosModel::find($id);
     return view("administrativa.avisos.edit",["ciclos"=>$ciclos,"aviso"=>$aviso]);

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
      $aviso = AvisosModel::find($id);
      $aviso->nombre_aviso=$request->get('nombre');
      $aviso->dirigido=$request->get('dirijido');
      $aviso->fecha_emite=$request->get('fecha');
      $aviso->area=$request->get('area');
      $aviso->motivo=$request->get('motivo');
      $aviso->descripcion=$request->get('descripcion');
      $aviso->id_ciclo=$request->get('ciclo_escolar');
      $aviso->estado="ACTIVO";
      $aviso->captura=$user;

      if(Input::hasFile('archivo')){
        $file=$request->file('archivo');
        $file->move(public_path().'/img/administrativa/avisos/pdf',$file->getClientoriginalName());
        $aviso->archivo=$file->getClientoriginalName();
    }

    if(Input::hasFile('imagen')){
        $file=$request->file('imagen');
        $file->move(public_path().'/img/administrativa/avisos/imagen',$file->getClientoriginalName());
        $aviso->imagen=$file->getClientoriginalName();
    }
    $aviso->update();
    return redirect('/avisos');
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
     $aviso = AvisosModel::find($id);
     $aviso->delete();
     return redirect('/avisos');
        //
 }

 public function excel(Request $request, $aux)
 {

   Excel::create('AVISOS', function($excel) use($aux) {
     $excel->sheet('Excel sheet', function($sheet) use($aux) {
        $tarjeta = AvisosModel::join('ciclo_escolar', 'ciclo_escolar.id', '=','avisos.id_ciclo')
        ->where('ciclo_escolar.id','=',$aux)
        ->select('avisos.id','avisos.nombre_aviso','avisos.dirigido','avisos.fecha_emite','avisos.area','avisos.motivo','avisos.descripcion','ciclo_escolar.ciclo','avisos.estado','avisos.captura')->get();
        $sheet->fromArray($tarjeta);
        $sheet->row(1,['N°','NOMBRE AVISO','DIRIGIDO','FECHA EMITE','AREA','MOTIVO','DESCRIPCION','CICLO ESCOLAR','ESTADO','CAPTURO']);
        $sheet->setOrientation('landscape');
    });
 })->export('xls');
}
}
