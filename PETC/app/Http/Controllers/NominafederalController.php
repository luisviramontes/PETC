<?php

namespace petc\Http\Controllers;

use Illuminate\Http\Request;

use petc\NominaFederalModel;

use petc\Http\Requests;
use petc\Http\Controllers\Controller;

use DB;
use Excel;
use PHPExcel_Worksheet_Drawing;
use Validator;
use \Milon\Barcode\DNS1D;
use \Milon\Barcode\DNS2D;
use petc\Http\Requests\NominaFederalRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Collection as Collection;
class NominafederalController extends Controller
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
      if($request)
      {
       $query=trim($request->GET('searchText'));
       $nomina_federal = DB::table('nomina_federal')
       ->where('region','LIKE','%'.$query.'%')
       ->orwhere('rfc','LIKE','%'.$query.'%')
       ->orwhere('nom_emp','LIKE','%'.$query.'%')
       ->orwhere('ent_fed','LIKE','%'.$query.'%')
       ->orwhere('cod_pago','LIKE','%'.$query.'%')
       ->orwhere('cat_puesto','LIKE','%'.$query.'%')
       ->orwhere('qna_ini_01','LIKE','%'.$query.'%')
      ->orwhere('qna_fin_01','LIKE','%'.$query.'%')
       ->orwhere('qna_pago','LIKE','%'.$query.'%')
       ->orwhere('num_cheque','LIKE','%'.$query.'%')
       ->orwhere('ciclo_escolar','LIKE','%'.$query.'%')
       ->paginate(24);
      }


      return view('nomina.nomina_federal.index',["nomina_federal" => $nomina_federal,"searchText"=>$query]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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
     public function destroy($qna_pago)
     {

       NominaFederalModel::where('qna_pago', $qna_pago)->delete();


       return redirect('/nomina_federal');
     }


     
}
