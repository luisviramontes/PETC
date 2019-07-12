<?php

namespace petc\Http\Controllers;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use petc\Http\Requests;
use petc\Http\Controllers\Controller;

use petc\DirectorioRegionalModel;

use DB;

use Maatwebsite\Excel\Facades\Excel;
use PHPExcel_Worksheet_Drawing;
use Validator;
use \Milon\Barcode\DNS1D;
use \Milon\Barcode\DNS2D;
use petc\Http\Requests\DirectorioRegionalRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Collection as Collection;

class DirectorioRegionalController extends Controller
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
       $directorio_regional = DB::table('directorio_regional')->join('region','region.id','=','directorio_regional.id_region')->select('directorio_regional.*','region.sostenimiento','region.region')
       ->where('region','LIKE','%'.$query.'%')
       ->orwhere('sostenimiento','LIKE','%'.$query.'%')
       ->orwhere('nombre_enlace','LIKE','%'.$query.'%')
       ->orwhere('director_regional','LIKE','%'.$query.'%')
       ->orwhere('financiero_regional','LIKE','%'.$query.'%')
       ->paginate(24);
     }
     return view('nomina.directorio_regional.index',['directorio_regional' => $directorio_regional]);

   }








    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    { 
     $region=DB::table('region')->get();

     return view("nomina.directorio_regional.create", ['region'=> $region]);
   }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DirectorioRegionalRequest $formulario)
    {
      $user = Auth::user()->name;
      $validator = Validator::make(
        $formulario->all(),
        $formulario->rules(),
        $formulario->messages());

      if ($formulario->ajax()){
        return response()->json(["valid" => true], 200);
      }else{
        $directorio= new DirectorioRegionalModel;
        $directorio -> id_region = $formulario ->region;
      //$directorio -> sostenimiento = $formulario ->sostenimiento;
        $directorio -> nombre_enlace=$formulario ->nombre_enlace;
        $directorio -> telefono=$formulario->telefono;
        $directorio -> ext1_enlace=$formulario ->ext1_enlace;
        $directorio -> ext2_enlace=$formulario ->ext2_enlace;
        $directorio -> correo_enlace=$formulario ->correo_enlace;
        $directorio -> director_regional=$formulario ->director_regional;
        $directorio -> telefono_director=$formulario ->telefono_director;
        $directorio -> financiero_regional=$formulario ->financiero_regional;
        $directorio -> telefono_regional=$formulario ->telefono_regional;
        $directorio -> ext_reg_1=$formulario ->ext_reg_1;
        $directorio -> ext_reg_2=$formulario ->ext_reg_2;
        $directorio -> estado="ACTIVO";
        $directorio -> captura=$user;





        if($directorio->save()){

          return redirect('/directorio_regional');

        }else {
          return view('director_regional.index');
        }

      }
    }

    //convertir y descargar pdf

    public function invoice($id){
      $directorio_regional= DB::table('directorio_regional')->get();
      $date = date('Y-m-d');
      $invoice = "2222";
       // print_r($materiales);
      $view =  \View::make('nomina.directorio_regional.invoice', compact('date', 'invoice','directorio_regional'))->render();
        //->setPaper($customPaper, 'landscape');
      $pdf = \App::make('dompdf.wrapper');
      $pdf->setPaper('A4', 'portrait');
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
     $region=DB::table('region')->get();
     $directorio = DirectorioRegionalModel::find($id);
     return view("nomina.directorio_regional.edit",["directorio"=>$directorio,"region"=>$region]);
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

      $directorio = DirectorioRegionalModel::find($id);
        //asignamos nuevos valores
      $directorio -> id_region = $formulario ->region;
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
      $directorio -> estado="ACTIVO";
      $directorio -> captura=$user;
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
      $user = Auth::user()->name;
      $directorio=DirectorioRegionalModel::findOrFail($id);
      $directorio->estado="INACTIVO";
      $directorio->captura=$user;
      $directorio->update();
      return redirect('directorio_regional');
    }

    ////////////exel////////////////

    public function excel(Request $request)
    {

     Excel::create('directorio_regional', function($excel) {
       $excel->sheet('Excel sheet', function($sheet) {
                 //otra opción -> $products = Product::select('name')->get();
         $tabla = DirectorioRegionalModel::select('region','sostenimiento','nombre_enlace','telefono','ext1_enlace','ext2_enlace','correo_enlace','director_regional','telefono_director','financiero_regional','telefono_regional','ext_reg_1','ext_reg_2')
             //->where('directorio_regional')
         ->get();
         $sheet->fromArray($tabla);
         $sheet->row(1,['REGION','SOSTENIMIENTO','NOMBRE DE ENLACE','TELEFONO','EXTENCION 1 ENLACE' ,'EXTENCION 2 ENLACE','CORREO ENLACE','DIRECTOR REGIONAL','TELEFONO DIRECTOR','FINANCIOERO REGIONAL','TELEFONO REGIONAL','EXTENCION REGIONAL 1','EXTENCION REGIONAL 2']);
         $sheet->setOrientation('landscape');
       });
     })->export('xls');
   }

 }
