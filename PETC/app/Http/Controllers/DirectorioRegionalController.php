<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DirectorioRegionalModel;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;

class DirectorioRegionalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

      $directorio_regional= DB::table('directorio_regional')->get();
      return view('nomina.directorio_regional.index',['directorio_regional' => $directorio_regional]);


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $directorio_regional = new DirectorioRegionalModel; //para que devuelva campo vacio en formcreate
      return view("nomina.directorio_regional.create",["directorio_regional" => $directorio_regional]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $tabla= new directorio_regional;
      $tabla->region=$request->get('region');
      $tabla->sostenimiento=$request->get('sostenimiento');
      $tabla->nombre_enlace=$request->get('nombre_enlace');
      $tabla->telefono=$request->get('telefono');
      $tabla->ext1_enlace=$request->get('etx1_enlace');
      $tabla->etx2_enlace=$request->get('ext2_enlace');
      $tabla->correo_enlace=$request->get('correo_enlace');
      $tabla->director_regional=$request->get('director_regional');
      $tabla->telefono_director=$request->get('telefono_director');
      $tabla->financiero_regional=$request->get('financiero_regional');
      $tabla->telefono_regional=$request->get('telefono_regional');
      $tabla->ext_reg_1=$request->get('ext_reg_1');
      $tabla->ext_reg_2=$request->get('ext_reg_2');
      $tabla->captura=$request->get('captura');

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
}
