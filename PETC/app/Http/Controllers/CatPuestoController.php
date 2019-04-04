<?php

namespace petc\Http\Controllers;

use Illuminate\Http\Request;

use petc\Http\Requests;
use petc\Http\Controllers\Controller;

use petc\CatPuestoModel;

use DB;

use Maatwebsite\Excel\Facades\Excel;
use PHPExcel_Worksheet_Drawing;
use Validator;
use \Milon\Barcode\DNS1D;
use \Milon\Barcode\DNS2D;
use petc\Http\Requests\CatPuestoRequest;

class CatPuestoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(request $request)
    {
    //  $categorias = CatPuestoModel::orderBy('id', 'DESC')
                          //  ->paginate(24);


////////////////////buscar////////////////////////7
if($request)
{
 $query=trim($request->GET('searchText'));
 $categorias = DB::table('cat_puesto')
 ->where('cat_puesto','LIKE','%'.$query.'%')
 ->orwhere('categoria','LIKE','%'.$query.'%')
 ->orwhere('tipo_puesto','LIKE','%'.$query.'%')
 ->paginate(24);
}
        return view('nomina.cat_puesto.index',["categorias"=>$categorias, "searchText"=>$query]);
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
          return view("nomina.cat_puesto.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $categorias= new CatPuestoModel;
      $categorias -> cv_ur = $request ->cv_ur;
      $categorias -> entidad = $request ->entidad;
      $categorias -> ccp = $request ->ccp;
      $categorias -> nom_prog = $request ->nom_prog;
      $categorias -> cat_puesto = $request ->cat_puesto;
      $categorias -> des_puesto = $request ->des_puesto;
      $categorias -> tipo_puesto = $request ->tipo_puesto;
      $categorias -> categoria = $request ->categoria;
      $categorias -> captura="Administrador";

      if($categorias->save()){

        return redirect('/cat_puesto');

      }else {
      return view('cat_puesto.index');
      }
    }

    //convertir y descargar pdf

    public function invoice($id){
        $categorias= DB::table('cat_puesto')->get();


        $date = date('Y-m-d');
        $invoice = "2222";
        //print_r($);
        $view =  \View::make('nomina.cat_puesto.invoice', compact('date', 'invoice','categorias'))->render();
        //->setPaper($customPaper, 'landscape');
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        return $pdf->stream('invoice');
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
      $categorias = CatPuestoModel::find($id);
      return view("nomina.cat_puesto.edit",["categorias"=>$categorias]);
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
      $categorias = CatPuestoModel::find($id);
      //asignamos nuevos valores
      $categorias -> cv_ur = $request ->cv_ur;
      $categorias -> entidad = $request ->entidad;
      $categorias -> ccp = $request ->ccp;
      $categorias -> nom_prog = $request ->nom_prog;
      $categorias -> cat_puesto = $request ->cat_puesto;
      $categorias -> des_puesto = $request ->des_puesto;
      $categorias -> tipo_puesto = $request ->tipo_puesto;
      $categorias -> categoria = $request ->categoria;
      $categorias -> captura="Administrador";
      //guardar
      if($categorias->save()){

        return redirect('/cat_puesto');

      }else {
      return view('cat_puesto.index');
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
      CatPuestoModel::destroy($id);
      return redirect('/cat_puesto');
    }

    ////////////exel////////////////

    public function excel(Request $request)
    {

     Excel::create('cat_puesto', function($excel) {
         $excel->sheet('Excel sheet', function($sheet) {
                 //otra opción -> $products = Product::select('name')->get();
             $tabla = CatPuestoModel::select('cv_ur','entidad','ccp','nom_prog','cat_puesto','des_puesto','categoria','tipo_puesto')
             //->where('directorio_regional')
             ->get();
             $sheet->fromArray($tabla);
             $sheet->row(1,['CV_UR','ENTIDAD','CCP','NOM_PROG','CATEGORIA PUESTO','DESCRIPCION PUESTO','CATEGORIA','TIPO PUESTO']);
             $sheet->setOrientation('landscape');
         });
     })->export('xls');
 }

}
