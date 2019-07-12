<?php

namespace petc\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use petc\Http\Requests;

use petc\Http\Controllers\Controller;
use petc\LocalidadesModel;

use DB;
use Maatwebsite\Excel\Facades\Excel;
use PHPExcel_Worksheet_Drawing;
use Validator; 
use \Milon\Barcode\DNS1D;
use \Milon\Barcode\DNS2D;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Collection as Collection;
class LocalidadesController extends Controller
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
    {   
      if($request)
      {
       $query=trim($request->GET('searchText'));
       $dato = DB::table('localidades')
       ->join('municipios', 'localidades.id_municipio', '=','municipios.id') 
       ->select('municipios.municipio','localidades.*')->where('municipios.municipio','LIKE','%'.$query.'%')->orwhere('localidades.nom_loc','LIKE','%'.$query.'%')->where('localidades.estado','=','ACTIVO')->paginate(10);
       return view('nomina.region.municipios.localidades.index',["dato"=>$dato,"searchText"=>$query]);
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
      $municipios= DB::table('municipios')->where('estado','=','ACTIVO')->get();
      return view('nomina.region.municipios.localidades.create',["municipios"=>$municipios]);
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
        $datos= new LocalidadesModel;
        $datos->id_municipio=$request->get('municipio');
        $datos->nom_loc=$request->get('localidad');
        $datos->longitud=$request->get('longitud');
        $datos->latitud=$request->get('latitud');
        $datos->altitud=$request->get('altitud');
        $datos->pobtot=$request->get('pobtot');
        $datos->pobmas=$request->get('pobmas');
        $datos->pobfem=$request->get('pobfem');
        $datos->estado="ACTIVO";
        $datos->captura=$user;
        $datos->save();
        return Redirect::to('localidades');
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
        $dato2 = DB::table('localidades')
        ->select('localidades.nom_loc')->where('localidades.id','=',$id)->first();

        $localidad=LocalidadesModel::findOrFail($id);
        $municipios= DB::table('municipios')->where('estado','=','ACTIVO')->get();
        return view('nomina.region.municipios.localidades.edit',["municipios"=>$municipios,'localidad'=>$localidad,"dato2"=>$dato2]);
        //

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
       $datos=LocalidadesModel::findOrFail($id);
       $datos->id_municipio=$request->get('municipio');
       $datos->nom_loc=$request->get('localidad');
       $datos->longitud=$request->get('longitud');
       $datos->latitud=$request->get('latitud');
       $datos->altitud=$request->get('altitud');
       $datos->pobtot=$request->get('pobtot');
       $datos->pobmas=$request->get('pobmas');
       $datos->pobfem=$request->get('pobfem');
       $datos->estado="ACTIVO";
       $datos->captura=$user;
       $datos->update();
       return Redirect::to('localidades');
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
      $user = Auth::user()->name;
        $datos=LocalidadesModel::findOrFail($id);
        $datos->estado="INACTIVO";
        $datos->captura=$user;
        $datos->update();
        return Redirect::to('localidades');
        //
    }

    public function excel()
    {
        Excel::create('Localidades', function($excel) {
            $excel->sheet('Excel sheet', function($sheet) {
                //otra opción -> $products = Product::select('name')->get();            
                $tabla = LocalidadesModel::join('municipios', 'localidades.id_municipio', '=','municipios.id') 
                ->select('localidades.id','municipios.municipio','localidades.nom_loc','localidades.longitud','localidades.latitud','localidades.altitud','localidades.pobtot','localidades.pobmas','localidades.pobfem','localidades.captura')
                ->get();
                $sheet->fromArray($tabla);
                $sheet->row(1,['ID','MUNICIPIO','LOCALIDAD','LONGITUD','LATITUD' ,'ALTITUD','POBLACION TOTAL','POBLACION MASCULINA','POBLACION FEMENINA','CAPTURO']);
                $sheet->setOrientation('landscape');
            });
        })->export('xls');
    }

    public function invoice()
    {
      $tabla = DB::table('localidades')
      ->join('municipios', 'localidades.id_municipio', '=','municipios.id') 
      ->select('municipios.municipio','localidades.*')
      ->get();
      $date = date('Y-m-d');
      $invoice = "2222";
       // print_r($materiales);
      $view =  \View::make('nomina.region.municipios.localidades.invoice', compact('date', 'invoice','tabla','pago'))->render();
      $pdf = \App::make('dompdf.wrapper');
      $pdf->loadHTML($view);
      return $pdf->stream('invoice');
        //
  }

  public function verInformacion($id)
  {

    $dato2 = DB::table('localidades')
    ->join('municipios', 'localidades.id_municipio', '=','municipios.id') 
    ->select('municipios.municipio','localidades.*')->where('localidades.id_municipio','=',$id)->first();
    $dato = DB::table('localidades')
    ->join('municipios', 'localidades.id_municipio', '=','municipios.id') 
    ->select('municipios.municipio','localidades.*')->where('localidades.id_municipio','=',$id)->get();
    return view('nomina.region.municipios.localidades.verInformacion',["dato"=>$dato,"dato2"=>$dato2]);


}

}
