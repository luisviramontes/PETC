<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use CEPROZAC\TablaPagosModel;
use DB;

class TablaPagosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ciclos=DB::table('ciclo_escolar')->get();
        $tabla_pagos= DB::table('tabla_pagos')->orderBy('qna', 'ASC')->where('ciclo','2018-2019')->get();
        return view('nomina.tabla_pagos.index',['tabla_pagos' => $tabla_pagos]);
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $ciclos=DB::table('ciclo_escolar')->get();

        return view('nomina.tabla_pagos.create', ['ciclos'=> $ciclos]);
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
        $tabla= new TablaPagos;
        $tabla->qna=$request->get('qna');
        $tabla->dias=$request->get('pago_director');
        $tabla->pago_director=$request->get('pago_director');
        $tabla->pago_docente=$request->get('pago_director');
        $tabla->pago_intendente=$request->get('pago_intendente');
        $tabla->captura=$request->get('ADMINISTRADOR');
        $tabla->ciclo=$request->get('ciclo');


        $material->nombre=$request->get('nombre');

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
