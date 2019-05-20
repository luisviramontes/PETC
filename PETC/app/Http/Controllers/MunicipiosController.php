<?php

namespace petc\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use petc\Http\Requests;

use petc\Http\Controllers\Controller;
use petc\MunicipiosModel;

use DB;
use Maatwebsite\Excel\Facades\Excel;
use PHPExcel_Worksheet_Drawing;
use Validator; 
use \Milon\Barcode\DNS1D;
use \Milon\Barcode\DNS2D;

class MunicipiosController extends Controller
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
         $query=trim($request->GET('searchText'));
         $dato = DB::table('municipios')
         ->join('region', 'region.id', '=','municipios.id_region') 
         ->select('region.region','municipios.municipio','municipios.cabecera','municipios.*')->where('municipios.cabecera','LIKE','%'.$query.'%')->orwhere('municipios.municipio','LIKE','%'.$query.'%')->orwhere('region.region','LIKE','%'.$query.'%')->where('municipios.estado','=','ACTIVO')->paginate(10);
         return view('nomina.region.municipios.index',["dato"=>$dato,"searchText"=>$query]);
        //
     }
 }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $region= DB::table('region')->get();
        return view('nomina.region.municipios.create',["region"=>$region]);
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
        $datos= new MunicipiosModel;
        $datos->id_region=$request->get('region');
        $datos->municipio=$request->get('municipio');
        $datos->cabecera=$request->get('cabecera');
        $datos->fecha_creacion=$request->get('fecha');
        $datos->poblacion=$request->get('poblacion');
        $datos->area_km=$request->get('area');
        $datos->estado="ACTIVO";
        $datos->capturo="ADMINISTRADOR";
        $datos->save();
        return Redirect::to('municipios');
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
        $region= DB::table('region')->get();
        $municipio=MunicipiosModel::findOrFail($id);
        return view("nomina.region.municipios.edit",["municipio"=>$municipio,"region"=>$region]);

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
     $municipio=MunicipiosModel::findOrFail($id);
     $municipio->id_region=$request->get('region');
     $municipio->municipio=$request->get('municipio');
     $municipio->cabecera=$request->get('cabecera');
     $municipio->fecha_creacion=$request->get('fecha');
     $municipio->poblacion=$request->get('poblacion');
     $municipio->area_km=$request->get('area');
     $municipio->estado="ACTIVO";
     $municipio->capturo="ADMINISTRADOR";
     $municipio->update();
     return Redirect::to('municipios');
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
     $municipio=MunicipiosModel::findOrFail($id);
     $municipio->estado="INACTIVO";
     $municipio->capturo="ADMINISTRADOR";
     $municipio->update();
     return Redirect::to('municipios');
        //
 }

 public function invoice()
 {
  $tabla = DB::table('municipios')
  ->join('region', 'region.id', '=','municipios.id_region') 
  ->select('region.region','municipios.municipio','municipios.cabecera','municipios.fecha_creacion','municipios.poblacion','municipios.area_km','municipios.capturo')
  ->get();
  $date = date('Y-m-d');
  $invoice = "2222";
       // print_r($materiales);
  $view =  \View::make('nomina.region.municipios.invoice', compact('date', 'invoice','tabla','pago'))->render();
  $pdf = \App::make('dompdf.wrapper');
  $pdf->loadHTML($view);
  return $pdf->stream('invoice');
        //
}

public function excel()
{
    Excel::create('Municipios', function($excel) {
        $excel->sheet('Excel sheet', function($sheet) {
                //otra opción -> $products = Product::select('name')->get();            
            $tabla = MunicipiosModel::join('region', 'region.id', '=','municipios.id_region') 
            ->select('municipios.id','region.region as reg','municipios.municipio','municipios.cabecera','municipios.fecha_creacion','municipios.poblacion','municipios.area_km','municipios.capturo')
            ->get();
            $sheet->fromArray($tabla);
            $sheet->row(1,['N°','REGION','MUNICIPIO','CABECERA','FECHA CREACION','TOTAL POBLACION' ,'AREA KM','CAPTURA']);
            $sheet->setOrientation('landscape');
        });
    })->export('xls');
}



}
