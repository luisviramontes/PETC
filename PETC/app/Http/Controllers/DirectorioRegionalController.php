<?php

namespace petc\Http\Controllers;

use Illuminate\Http\Request;


use petc\Http\Requests;
use petc\Http\Controllers\Controller;

use petc\DirectorioRegionalModel;

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

      return view("nomina.directorio_regional.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $directorio= new DirectorioRegionalModel;
      $directorio -> region = $request ->region;
      $directorio -> sostenimiento = $request ->sostenimiento;
      $directorio -> nombre_enlace=$request ->nombre_enlace;
      $directorio -> telefono=$request->telefono;
      $directorio -> ext1_enlace=$request ->ext1_enlace;
      $directorio -> ext2_enlace=$request ->ext2_enlace;
      $directorio -> correo_enlace=$request ->correo_enlace;
      $directorio -> director_regional=$request ->director_regional;
      $directorio -> telefono_director=$request ->telefono_director;
      $directorio -> financiero_regional=$request ->financiero_regional;
      $directorio -> telefono_regional=$request ->telefono_regional;
      $directorio -> ext_reg_1=$request ->ext_reg_1;
      $directorio -> ext_reg_2=$request ->ext_reg_2;
      $directorio -> captura="Administrador";





      if($directorio->save()){

        return redirect('/directorio_regional');

      }else {
      return view('director_regional.index');
      }

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

      $directorio = DirectorioRegionalModel::find($id);
      return view("nomina.directorio_regional.edit",["directorio"=>$directorio]);
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

        $directorio = DirectorioRegionalModel::find($id);
        //asignamos nuevos valores
        $directorio -> region = $request ->region;
        $directorio -> sostenimiento = $request ->sostenimiento;
        $directorio -> nombre_enlace=$request ->nombre_enlace;
        $directorio -> telefono=$request->telefono;
        $directorio -> ext1_enlace=$request ->ext1_enlace;
        $directorio -> ext2_enlace=$request ->ext2_enlace;
        $directorio -> correo_enlace=$request ->correo_enlace;
        $directorio -> director_regional=$request ->director_regional;
        $directorio -> telefono_director=$request ->telefono_director;
        $directorio -> financiero_regional=$request ->financiero_regional;
        $directorio -> telefono_regional=$request ->telefono_regional;
        $directorio -> ext_reg_1=$request ->ext_reg_1;
        $directorio -> ext_reg_2=$request ->ext_reg_2;
        $directorio -> captura="Administrador";
        //guardar
        if($directorio->save()){

          return redirect('/directorio_regional');

        }else {
        return view('director_regional.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      DirectorioRegionalModel::destroy($id);
      return redirect('/directorio_regional');
    }
}
