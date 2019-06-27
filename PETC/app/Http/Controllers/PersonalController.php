<?php

namespace petc\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use petc\Http\Requests;

use petc\Http\Controllers\Controller;
use petc\PersonalModel;

use DB;
use Maatwebsite\Excel\Facades\Excel;
use PHPExcel_Worksheet_Drawing;
use Validator;
use \Milon\Barcode\DNS1D;
use \Milon\Barcode\DNS2D;
use petc\Http\Requests\PersonalRequest;

class PersonalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(request $request)
    {

     if($request)
     {
       // $aux=$request->get('searchText');
        $query=trim($request->GET('searchText'));

        $personal= DB::table('personal')->join('cat_puesto', 'personal.clave', '=','cat_puesto.id')->select('personal.*','cat_puesto.cat_puesto')->where('estado','=','ACTIVO')->where('personal.rfc','LIKE','%'.$query.'%')->orwhere('personal.nombre','LIKE','%'.$query.'%')->paginate(30);
        return view('nomina.personal.index',["personal"=>$personal,"searchText"=>$query]);
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
        $claves=DB::table('cat_puesto')->get();

        return view('nomina.personal.create', ['claves'=> $claves]);
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PersonalRequest $formulario)
    {
        $validator = Validator::make(
            $formulario->all(),
            $formulario->rules(),
            $formulario->messages());
        if ($validator->valid()){

            if ($formulario->ajax()){
              return response()->json(["valid" => true], 200);
          }
          else{
            $tabla= new PersonalModel;
            $tabla->nombre=$formulario->get('nombre');
            $tabla->rfc=$formulario->get('rfc_input');
            $tabla->telefono=$formulario->get('telefono');
            $tabla->email=$formulario->get('email');
            $tabla->clave=$formulario->get('clave');
            $tabla->captura="ADMINISTRADOR";
            $tabla->estado="ACTIVO";
            $tabla->save();
            return Redirect::to('personal');
        //
        }}}

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
      $claves=DB::table('cat_puesto')->get();
      $personal=PersonalModel::findOrFail($id);
      return view("nomina.personal.edit",["personal"=>$personal,"claves"=>$claves]);
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
       $tabla=PersonalModel::findOrFail($id);
       $tabla->nombre=$request->get('nombre');
       $tabla->rfc=$request->get('rfc_input');
       $tabla->telefono=$request->get('telefono');
       $tabla->email=$request->get('email');
       $tabla->clave=$request->get('clave');
       $tabla->captura="ADMINISTRADOR";
       $tabla->estado="ACTIVO";
       $tabla->update();
       return Redirect::to('personal');
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
     $tabla=PersonalModel::findOrFail($id);
     $tabla->captura="ADMINISTRADOR";
     $tabla->estado="INACTIVO";
     $tabla->update();
     return Redirect::to('personal');
        //
 }

 public function excel(Request $request)
 {

    Excel::create('PERSONAL TOTAL SEDUZAC', function($excel) {
        $excel->sheet('Excel sheet', function($sheet) {
                //otra opción -> $products = Product::select('name')->get();
            $tabla = PersonalModel::join('cat_puesto', 'personal.clave', '=','cat_puesto.id')->select('personal.nombre','personal.rfc','personal.telefono','personal.email','cat_puesto.cat_puesto','personal.captura')
            ->where('personal.estado','ACTIVO')
            ->get();
            $sheet->fromArray($tabla);
            $sheet->row(1,['NOMBRE EMPLEADO','RFC','TELEFONO','EMAIL' ,'CAT PUESTO','CAPTURA']);
            $sheet->setOrientation('landscape');
        });
    })->export('xls');
}

public function  ver_informacion($id){

}

public function validarRFC($rfc)
{
 //return Redirect::to('personal');
    $personal= PersonalModel::
    select('id','rfc','nombre', 'estado')
    ->where('rfc','=',$rfc)
    ->get();

    return response()->json(
      $personal->toArray());

}

public function activar(Request $request)
{
    $id =  $request->get('idCliente');
    $cliente=PersonalModel::findOrFail($id);
    $cliente->estado="ACTIVO";
    $cliente->update();
    return Redirect::to('personal');
}

}
