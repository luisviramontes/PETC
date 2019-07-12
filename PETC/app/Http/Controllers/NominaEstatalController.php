<?php

namespace petc\Http\Controllers;

use petc\NominaEstatalModel;

use Illuminate\Http\Request;

use petc\Http\Requests;
use petc\Http\Controllers\Controller;

use DB;
use Excel;
use PHPExcel_Worksheet_Drawing;
use Validator;
use \Milon\Barcode\DNS1D;
use \Milon\Barcode\DNS2D;
use petc\Http\Requests\NominaEstatalRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Collection as Collection;

class NominaEstatalController extends Controller
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
       $nomina_estatal = DB::table('nomina_estatal')
       ->where('RFC','LIKE','%'.$query.'%')
       ->orwhere('nombre','LIKE','%'.$query.'%')
       ->orwhere('num_empleado','LIKE','%'.$query.'%')
       ->orwhere('num_cheque','LIKE','%'.$query.'%')
       ->orwhere('cct','LIKE','%'.$query.'%')
       ->orwhere('qna_ini','LIKE','%'.$query.'%')
       ->orwhere('qna_fin','LIKE','%'.$query.'%')
       ->orwhere('qna_pago','LIKE','%'.$query.'%')
       ->paginate(24);
      }


      return view('nomina.nomina_estatal.index',["nomina_estatal" => $nomina_estatal,"searchText"=>$query]);

        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $nomina_estatal = new NominaEstatalModel;

    }

    //importar Excel a la BD

    
    ////////////////////////////


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

      NominaEstatalModel::where('qna_pago', $qna_pago)->delete();


      return redirect('/nomina_estatal');
    }
}
