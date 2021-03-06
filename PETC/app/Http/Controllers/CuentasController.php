<?php

namespace petc\Http\Controllers;
use petc\CuentasModel;
use Illuminate\Http\Request;
use DB;
use Maatwebsite\Excel\Facades\Excel;
use PHPExcel_Worksheet_Drawing;
use Validator;
use \Milon\Barcode\DNS1D;
use \Milon\Barcode\DNS2D;
use petc\Http\Requests;
use Illuminate\Support\Facades\Auth;
use petc\Http\Controllers\Controller;

class CuentasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $tipo_usuario = Auth::user()->tipo_usuario;
      if($tipo_usuario <> "1" && $tipo_usuario <> "2"  && $tipo_usuario <> "3" && $tipo_usuario <> "4" &&    $tipo_usuario <> "5" && $tipo_usuario <> "6"){
       return view('permisos');

      }else{
      if($request)
      {
       $query=trim($request->GET('searchText'));
       $cuentas = DB::table('cuentas')
       ->join('bancos', 'cuentas.id_banco', '=','bancos.id')
       ->select('cuentas.id as id','cuentas.*','bancos.nombre_banco')
       ->where('nombre_banco','LIKE','%'.$query.'%')
       ->orwhere('num_cuenta','LIKE','%'.$query.'%')
       ->orwhere('clave_in','LIKE','%'.$query.'%')
       ->orwhere('secretaria','LIKE','%'.$query.'%')
       ->orwhere('nombre','LIKE','%'.$query.'%')
       ->paginate(10);

      return view('nomina.cuentas.index',["cuentas"=>$cuentas,"searchText"=>$query]);


    }
}

    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $tipo_usuario = Auth::user()->tipo_usuario;
      if($tipo_usuario <> "2" || $tipo_usuario=="5"){
       return view('permisos');

     }else{
        $bancos=DB::table('bancos')->get();
        return view("nomina.cuentas.create",["bancos"=>$bancos]);
     }
   }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $tipo_usuario = Auth::user()->tipo_usuario;
      if($tipo_usuario <> "2" || $tipo_usuario=="5"){
       return view('permisos');

     }else{
      $user = Auth::user()->name;
      $cuenta= new CuentasModel;
      $cuenta-> nombre = $request ->nombre;
      $cuenta -> num_cuenta = $request ->cuenta;
      $cuenta -> clave_in = $request ->clave_in;
      $cuenta -> secretaria = $request ->secretaria;
      $cuenta -> id_banco = $request ->id_banco;
      $cuenta -> estado="ACTIVO";
      $cuenta -> captura=$user;

      if($cuenta->save()){

        return redirect('/cuentas');

      }else {
        return false;
       }
     }
   }

    //convertir y descargar pdf

    public function invoice($id){
      $cuentas= DB::table('cuentas')
      ->join('bancos', 'cuentas.id_banco', '=','bancos.id')
      ->select('cuentas.id as id','cuentas.*','bancos.nombre_banco')->get();
      $date = date('Y-m-d');
      $invoice = "2222";
       // print_r($materiales);
      $view =  \View::make('nomina.cuentas.invoice', compact('date', 'invoice','cuentas'))->render();
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
      $tipo_usuario = Auth::user()->tipo_usuario;
      if($tipo_usuario <> "2" || $tipo_usuario=="5"){
       return view('permisos');

     }else{
      $bancos=DB::table('bancos')->get();
      $cuentas = CuentasModel::find($id);
      return view("nomina.cuentas.edit",["cuentas"=>$cuentas,"bancos"=>$bancos]);
      }
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
      $tipo_usuario = Auth::user()->tipo_usuario;
      if($tipo_usuario <> "2" || $tipo_usuario=="5"){
       return view('permisos');

     }else{
      $user = Auth::user()->name;
      $cuenta = CuentasModel::find($id);
      $cuenta-> nombre = $request ->nombre;
      $cuenta -> num_cuenta = $request ->cuenta;
      $cuenta -> clave_in = $request ->clave_in;
      $cuenta -> secretaria = $request ->secretaria;
      $cuenta -> id_banco = $request ->id_banco;
      $cuenta -> estado = "ACTIVO";
      $cuenta -> captura = $user;

      if($cuenta->update()){

        return redirect('/cuentas');

      }else {
        return false;
        }
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
      $tipo_usuario = Auth::user()->tipo_usuario;
      if($tipo_usuario <> "2" || $tipo_usuario=="5"){
       return view('permisos');

     }else{
      $user = Auth::user()->name;
      $cuenta=CuentasModel::findOrFail($id);
      $cuenta->estado="INACTIVO";
      $cuenta->captura=$user;
      $cuenta->update();
        return redirect('cuentas');
     }
   }

    ////////////exel////////////////

    public function excel(Request $request)
    {

     Excel::create('cuentas', function($excel) {
         $excel->sheet('Excel sheet', function($sheet) {

            $tabla = CuentasModel::join('bancos', 'cuentas.id_banco', '=','bancos.id')
             ->select('cuentas.nombre','cuentas.num_cuenta','cuentas.clave_in','cuentas.secretaria','bancos.nombre_banco','cuentas.created_at')->get();
             $sheet->fromArray($tabla);
             $sheet->row(1,['NOMBRE','CUENTA','CLAVE INTER','SECRETARIA','BANCO','FECHA DE REGISTRO']);
             $sheet->setOrientation('landscape');
         });
     })->export('xls');
   }

}
