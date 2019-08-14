<?php

namespace petc\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use petc\Http\Requests;

use petc\Http\Controllers\Controller;


use petc\TarjetasFortalecimientoModel;

use DB;

use Maatwebsite\Excel\Facades\Excel;
use PHPExcel_Worksheet_Drawing;
use Validator;


use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Collection as Collection;  
class TarjetasFortalecimientoController extends Controller
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
     $tipo_usuario = Auth::user()->tipo_usuario;
     if($tipo_usuario <> "2" || $tipo_usuario=="5"){
       return view('permisos');

     }else{
      if($request)
      {
       // $aux=$request->get('searchText');
       $query=trim($request->GET('searchText'));       
       $query2=trim($request->GET('ciclo_escolar2'));

       $ciclos=DB::table('ciclo_escolar')->get();

       if($query == "" && $query2 == ""){
        $query2=2;
        $tarjetas=DB::table('tarjetasfortalecimiento')->join('fortalecimiento','fortalecimiento.id','=','tarjetasfortalecimiento.id_fortalecimiento')->join('centro_trabajo','centro_trabajo.id','=','fortalecimiento.id_cct')->join('ciclo_escolar','ciclo_escolar.id','=','fortalecimiento.id_ciclo')->join('region','region.id','=','centro_trabajo.id_region')->where('fortalecimiento.id_ciclo','=',$query2)->select('tarjetasfortalecimiento.*','ciclo_escolar.ciclo','fortalecimiento.monto_forta','fortalecimiento.observaciones as observaciones_forta ','fortalecimiento.captura as captura_forta ','centro_trabajo.cct','centro_trabajo.nombre_escuela','region.region','region.sostenimiento','centro_trabajo.domicilio','centro_trabajo.email','centro_trabajo.telefono')->paginate(40);


      }elseif($query == "" && $query2 != ""){
       $tarjetas=DB::table('tarjetasfortalecimiento')->join('fortalecimiento','fortalecimiento.id','=','tarjetasfortalecimiento.id_fortalecimiento')->join('centro_trabajo','centro_trabajo.id','=','fortalecimiento.id_cct')->join('ciclo_escolar','ciclo_escolar.id','=','fortalecimiento.id_ciclo')->join('region','region.id','=','centro_trabajo.id_region')->where('fortalecimiento.id_ciclo','=',$query2)->select('tarjetasfortalecimiento.*','ciclo_escolar.ciclo','fortalecimiento.monto_forta','fortalecimiento.observaciones as observaciones_forta ','fortalecimiento.captura as captura_forta ','centro_trabajo.cct','centro_trabajo.nombre_escuela','region.region','region.sostenimiento','centro_trabajo.domicilio','centro_trabajo.email','centro_trabajo.telefono')->paginate(40);

     }else{
      $tarjetas=DB::table('tarjetasfortalecimiento')->join('fortalecimiento','fortalecimiento.id','=','tarjetasfortalecimiento.id_fortalecimiento')->join('centro_trabajo','centro_trabajo.id','=','fortalecimiento.id_cct')->join('ciclo_escolar','ciclo_escolar.id','=','fortalecimiento.id_ciclo')->join('region','region.id','=','centro_trabajo.id_region')->where('fortalecimiento.id_ciclo','=',$query2)->where('centro_trabajo.cct','=',$query)->orwhere('tarjetasfortalecimiento.num_tarjeta','=',$query)->orwhere('centro_trabajo.nombre_escuela')->select('tarjetasfortalecimiento.*','ciclo_escolar.ciclo','fortalecimiento.monto_forta','fortalecimiento.observaciones as observaciones_forta ','fortalecimiento.captura as captura_forta ','centro_trabajo.cct','centro_trabajo.nombre_escuela','region.region','region.sostenimiento','centro_trabajo.domicilio','centro_trabajo.email','centro_trabajo.telefono')->paginate(40);


    }
    return view('nomina.tarjetas_fortalecimiento.index',["ciclos"=>$ciclos,"tarjetas" => $tarjetas,"ciclo_escolar2"=>$query2,"searchText"=>$query]);
  }


}
        //
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
       $ciclos=DB::table('ciclo_escolar')->get();
       return view('nomina.tarjetas_fortalecimiento.create', ['ciclos'=>$ciclos]);

     }
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
     $tipo_usuario = Auth::user()->tipo_usuario;
     if($tipo_usuario <> "2" || $tipo_usuario=="5"){
       return view('permisos');

     }else{
      $user = Auth::user()->name; 
      $tarjeta = new TarjetasFortalecimientoModel;
      $tarjeta->id_fortalecimiento=$request->get('cct');
      $tarjeta->TSL=$request->get('tsl');
      $tarjeta->num_tarjeta=$request->get('num_tarjeta');
      $tarjeta->producto=$request->get('producto');
      $tarjeta->empresa=$request->get('empresa');
      $tarjeta->observaciones=$request->get('observaciones');
      $tarjeta->captura=$user;
      $tarjeta->save();
      return Redirect::to('tarjetas_fortalecimiento');

    }
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
     $tipo_usuario = Auth::user()->tipo_usuario;
     if($tipo_usuario <> "2" || $tipo_usuario=="5"){
       return view('permisos');

     }else{
        //$tarjeta = TarjetasFortalecimientoModel::findOrFail($id); 
      $ciclos=DB::table('ciclo_escolar')->get();
      $tarjeta=DB::table('tarjetasfortalecimiento')->join('fortalecimiento','fortalecimiento.id','=','tarjetasfortalecimiento.id_fortalecimiento')->join('centro_trabajo','centro_trabajo.id','=','fortalecimiento.id_cct')->select('tarjetasfortalecimiento.*','fortalecimiento.monto_forta','fortalecimiento.id_ciclo','centro_trabajo.cct','centro_trabajo.nombre_escuela')->first();

      return view('nomina.tarjetas_fortalecimiento.edit', ['tarjeta'=>$tarjeta,'ciclos'=>$ciclos]);    

    }
        //
  }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id){
      $tipo_usuario = Auth::user()->tipo_usuario;
      if($tipo_usuario <> "2" || $tipo_usuario=="5"){
       return view('permisos');

     }else{
       $user = Auth::user()->name; 
       $tarjeta = TarjetasFortalecimientoModel::findOrFail($id);        
       $tarjeta->TSL=$request->get('tsl');
       $tarjeta->num_tarjeta=$request->get('num_tarjeta');
       $tarjeta->producto=$request->get('producto');
       $tarjeta->empresa=$request->get('empresa');
       $tarjeta->observaciones=$request->get('observaciones');
       $tarjeta->captura=$user;
       $tarjeta->update();
       return Redirect::to('tarjetas_fortalecimiento');

     }
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
     $tipo_usuario = Auth::user()->tipo_usuario;
     if($tipo_usuario <> "2" || $tipo_usuario=="5"){
       return view('permisos');

     }else{
      $tarjeta = TarjetasFortalecimientoModel::findOrFail($id);  
      $tarjeta->delete();
      return Redirect::to('tarjetas_fortalecimiento');   
  }        //
}


public function traer_escuelasforta($ciclo){
 $tipo_usuario = Auth::user()->tipo_usuario;
 if($tipo_usuario <> "2" || $tipo_usuario=="5"){
   return view('permisos');

 }else{
  $centros=DB::table('fortalecimiento')->join('centro_trabajo','centro_trabajo.id','=','fortalecimiento.id_cct')->where('fortalecimiento.id_ciclo','=',$ciclo)->select('fortalecimiento.*','centro_trabajo.id as id_centro','centro_trabajo.cct','centro_trabajo.nombre_escuela')->get();
  return response()->json(
    $centros);

}

}


public function traer_montos_forta($cct){
 $tipo_usuario = Auth::user()->tipo_usuario;
 if($tipo_usuario <> "2" || $tipo_usuario=="5"){
   return view('permisos');

 }else{
  $centros=DB::table('fortalecimiento')->where('fortalecimiento.id_cct','=',$cct)->select('fortalecimiento.monto_forta')->get();
  return response()->json(
    $centros);

}

}

public function excel(Request $request, $aux)
{

 Excel::create('TARJETAS DE FORTALECIMIENTO', function($excel) use($aux) {
   $excel->sheet('Excel sheet', function($sheet) use($aux) {



    $tarjeta = TarjetasFortalecimientoModel::join('fortalecimiento','fortalecimiento.id','=','tarjetasfortalecimiento.id_fortalecimiento')->join('centro_trabajo','centro_trabajo.id','=','fortalecimiento.id_cct')->join('ciclo_escolar','ciclo_escolar.id','=','fortalecimiento.id_ciclo')->join('region','region.id','=','centro_trabajo.id_region')->where('fortalecimiento.id_ciclo','=',$aux)->select('region.region','region.sostenimiento','centro_trabajo.cct','centro_trabajo.nombre_escuela','fortalecimiento.monto_forta','tarjetasfortalecimiento.num_tarjeta','ciclo_escolar.ciclo','centro_trabajo.alimentacion')->get();
    $sheet->fromArray($tarjeta);
    $sheet->row(1,['REGION','SOSTENIMIENTO','CCT','NOMBRE ESCUELA','MONTO FORTALECIMIENTO','NUM TARJETA','CICLO ESCOLAR','ALIMENTACION']);
    $sheet->setOrientation('landscape');
  });
 })->export('xls');
} 


public function invoice($id){

  $tarjeta = TarjetasFortalecimientoModel::join('fortalecimiento','fortalecimiento.id','=','tarjetasfortalecimiento.id_fortalecimiento')->join('centro_trabajo','centro_trabajo.id','=','fortalecimiento.id_cct')->join('ciclo_escolar','ciclo_escolar.id','=','fortalecimiento.id_ciclo')->join('region','region.id','=','centro_trabajo.id_region')->where('fortalecimiento.id_ciclo','=',$id)->select('region.region','region.sostenimiento','centro_trabajo.cct','centro_trabajo.nombre_escuela','fortalecimiento.monto_forta','tarjetasfortalecimiento.num_tarjeta','ciclo_escolar.ciclo','centro_trabajo.alimentacion')->get();



      //    $directorio_regional= DB::table('tabulador_pagos')->where('ciclo','=',$id)->first();
         //$material   = AlmacenMaterial:: findOrFail($id);
        //$customPaper = array(0,0,567.00,283.80);
  $date = date('Y-m-d');
  $invoice = "2222";
       // print_r($materiales);
  $view =  \View::make('nomina.tarjetas_fortalecimiento.invoice', compact('date', 'invoice','tarjeta'))->render();
        //->setPaper($customPaper, 'landscape');
  $pdf = \App::make('dompdf.wrapper');
  $pdf->loadHTML($view);
  return $pdf->stream('invoice');
}


public function generar_cartas()
{
  $ciclos=DB::table('ciclo_escolar')->get();
  $region=DB::table('region')->get();

  return view('nomina.tarjetas_fortalecimiento.generar', ['ciclos'=>$ciclos,'region'=>$region]);  

}

public function generar_pdf_cartas(Request $request){

 $tipo_usuario = Auth::user()->tipo_usuario;
 if($tipo_usuario <> "2" || $tipo_usuario=="5"){
   return view('permisos');

 }else{
  $user = Auth::user()->name;
  $ciclo_aux=$request->get('ciclo_escolar'); 
  $name = explode("-",$ciclo_aux);
  $year01=$name[0];
  $year02=$name[1];
  $ciclo_id=DB::table('ciclo_escolar')->where('ciclo','=',$ciclo_aux)->first()->id;

  $todos=$request->get('option1');
  $region=$request->get('region');
  $escuelas=$request->get('option2');
  $cct=$request->get('cct');
  $mes=$request->get('mes');
  $dia=$request->get('dia');




  if ($todos == "1") {
   $tarjeta = TarjetasFortalecimientoModel::join('fortalecimiento','fortalecimiento.id','=','tarjetasfortalecimiento.id_fortalecimiento')->join('centro_trabajo','centro_trabajo.id','=','fortalecimiento.id_cct')->join('ciclo_escolar','ciclo_escolar.id','=','fortalecimiento.id_ciclo')->join('region','region.id','=','centro_trabajo.id_region')->where('fortalecimiento.id_ciclo','=',$ciclo_id)->select('region.region','region.sostenimiento','centro_trabajo.cct','centro_trabajo.nombre_escuela','fortalecimiento.monto_forta','tarjetasfortalecimiento.*','ciclo_escolar.ciclo','centro_trabajo.alimentacion')->get();                      
           //   

 }else{
  if($escuelas== "1"){
    $tarjeta = TarjetasFortalecimientoModel::join('fortalecimiento','fortalecimiento.id','=','tarjetasfortalecimiento.id_fortalecimiento')->join('centro_trabajo','centro_trabajo.id','=','fortalecimiento.id_cct')->join('ciclo_escolar','ciclo_escolar.id','=','fortalecimiento.id_ciclo')->join('region','region.id','=','centro_trabajo.id_region')->where('fortalecimiento.id_ciclo','=',$ciclo_id)->where('centro_trabajo.id_region','=',$region)->select('region.region','region.sostenimiento','centro_trabajo.cct','centro_trabajo.nombre_escuela','fortalecimiento.monto_forta','tarjetasfortalecimiento.*','ciclo_escolar.ciclo','centro_trabajo.alimentacion')->get();

  }else{
    $tarjeta = TarjetasFortalecimientoModel::join('fortalecimiento','fortalecimiento.id','=','tarjetasfortalecimiento.id_fortalecimiento')->join('centro_trabajo','centro_trabajo.id','=','fortalecimiento.id_cct')->join('ciclo_escolar','ciclo_escolar.id','=','fortalecimiento.id_ciclo')->join('region','region.id','=','centro_trabajo.id_region')->where('fortalecimiento.id_ciclo','=',$ciclo_id)->where('centro_trabajo.id','=',$cct)->select('region.region','region.sostenimiento','centro_trabajo.cct','centro_trabajo.nombre_escuela','fortalecimiento.monto_forta','tarjetasfortalecimiento.*','ciclo_escolar.ciclo','centro_trabajo.alimentacion')->get();

  }

}  
$date = date('Y-m-d');
$invoice = "2222";
       // print_r($materiales);
$view =  \View::make('nomina.tarjetas_fortalecimiento.invoice_carta', compact('date', 'invoice','tarjeta','ciclo_aux','year01','mes','dia'))->render();
$pdf = \App::make('dompdf.wrapper');
$pdf->loadHTML($view);
return $pdf->stream('invoice');

}
}

//------    CONVERTIR NUMEROS A LETRAS         ---------------
//------    Máxima cifra soportada: 18 dígitos con 2 decimales
//------    999,999,999,999,999,999.99
// NOVECIENTOS NOVENTA Y NUEVE MIL NOVECIENTOS NOVENTA Y NUEVE BILLONES
// NOVECIENTOS NOVENTA Y NUEVE MIL NOVECIENTOS NOVENTA Y NUEVE MILLONES
// NOVECIENTOS NOVENTA Y NUEVE MIL NOVECIENTOS NOVENTA Y NUEVE PESOS 99/100 M.N.
//------    Creada por:                        ---------------
//------             ULTIMINIO RAMOS GALÁN     ---------------
//------            uramos@gmail.com           ---------------
//------    10 de junio de 20 09. México, D.F.  ---------------
//------    PHP Version 4.3.1 o mayores (aunque podría funcionar en versiones anteriores, tendrías que probar)


public function numtoletras($xcifra)
{
  $xarray = array(0 => "Cero",
    1 => "UN", "DOS", "TRES", "CUATRO", "CINCO", "SEIS", "SIETE", "OCHO", "NUEVE",
    "DIEZ", "ONCE", "DOCE", "TRECE", "CATORCE", "QUINCE", "DIECISEIS", "DIECISIETE", "DIECIOCHO", "DIECINUEVE",
    "VEINTI", 30 => "TREINTA", 40 => "CUARENTA", 50 => "CINCUENTA", 60 => "SESENTA", 70 => "SETENTA", 80 => "OCHENTA", 90 => "NOVENTA",
    100 => "CIENTO", 200 => "DOSCIENTOS", 300 => "TRESCIENTOS", 400 => "CUATROCIENTOS", 500 => "QUINIENTOS", 600 => "SEISCIENTOS", 700 => "SETECIENTOS", 800 => "OCHOCIENTOS", 900 => "NOVECIENTOS"
    );
//
  $xcifra = trim($xcifra);
  $xlength = strlen($xcifra);
  $xpos_punto = strpos($xcifra, ".");
  $xaux_int = $xcifra;
  $xdecimales = "00";
  if (!($xpos_punto === false)) {
    if ($xpos_punto == 0) {
      $xcifra = "0" . $xcifra;
      $xpos_punto = strpos($xcifra, ".");
    }
        $xaux_int = substr($xcifra, 0, $xpos_punto); // obtengo el entero de la cifra a covertir
        $xdecimales = substr($xcifra . "00", $xpos_punto + 1, 2); // obtengo los valores decimales
      }

    $XAUX = str_pad($xaux_int, 18, " ", STR_PAD_LEFT); // ajusto la longitud de la cifra, para que sea divisible por centenas de miles (grupos de 6)
    $xcadena = "";
    for ($xz = 0; $xz < 3; $xz++) {
      $xaux = substr($XAUX, $xz * 6, 6);
      $xi = 0;
        $xlimite = 6; // inicializo el contador de centenas xi y establezco el límite a 6 dígitos en la parte entera
        $xexit = true; // bandera para controlar el ciclo del While
        while ($xexit) {
            if ($xi == $xlimite) { // si ya llegó al límite máximo de enteros
                break; // termina el ciclo
              }

            $x3digitos = ($xlimite - $xi) * -1; // comienzo con los tres primeros digitos de la cifra, comenzando por la izquierda
            $xaux = substr($xaux, $x3digitos, abs($x3digitos)); // obtengo la centena (los tres dígitos)
            for ($xy = 1; $xy < 4; $xy++) { // ciclo para revisar centenas, decenas y unidades, en ese orden
              switch ($xy) {
                    case 1: // checa las centenas
                        if (substr($xaux, 0, 3) < 100) { // si el grupo de tres dígitos es menor a una centena ( < 99) no hace nada y pasa a revisar las decenas

                        } else {
                          $key = (int) substr($xaux, 0, 3);
                            if (TRUE === array_key_exists($key, $xarray)){  // busco si la centena es número redondo (100, 200, 300, 400, etc..)
                              $xseek = $xarray[$key];
                                $xsub = self::subfijo($xaux); // devuelve el subfijo correspondiente (Millón, Millones, Mil o nada)
                                if (substr($xaux, 0, 3) == 100)
                                  $xcadena = " " . $xcadena . " CIEN " . $xsub;
                                else
                                  $xcadena = " " . $xcadena . " " . $xseek . " " . $xsub;
                                $xy = 3; // la centena fue redonda, entonces termino el ciclo del for y ya no reviso decenas ni unidades
                              }
                            else { // entra aquí si la centena no fue numero redondo (101, 253, 120, 980, etc.)
                              $key = (int) substr($xaux, 0, 1) * 100;
                                $xseek = $xarray[$key]; // toma el primer caracter de la centena y lo multiplica por cien y lo busca en el arreglo (para que busque 100,200,300, etc)
                                $xcadena = " " . $xcadena . " " . $xseek;
                            } // ENDIF ($xseek)
                        } // ENDIF (substr($xaux, 0, 3) < 100)
                        break;
                    case 2: // checa las decenas (con la misma lógica que las centenas)
                    if (substr($xaux, 1, 2) < 10) {

                    } else {
                      $key = (int) substr($xaux, 1, 2);
                      if (TRUE === array_key_exists($key, $xarray)) {
                        $xseek = $xarray[$key];
                        $xsub = self::subfijo($xaux);
                        if (substr($xaux, 1, 2) == 20)
                          $xcadena = " " . $xcadena . " VEINTE " . $xsub;
                        else
                          $xcadena = " " . $xcadena . " " . $xseek . " " . $xsub;
                        $xy = 3;
                      }
                      else {
                        $key = (int) substr($xaux, 1, 1) * 10;
                        $xseek = $xarray[$key];
                        if (20 == substr($xaux, 1, 1) * 10)
                          $xcadena = " " . $xcadena . " " . $xseek;
                        else
                          $xcadena = " " . $xcadena . " " . $xseek . " Y ";
                            } // ENDIF ($xseek)
                        } // ENDIF (substr($xaux, 1, 2) < 10)
                        break;
                    case 3: // checa las unidades
                        if (substr($xaux, 2, 1) < 1) { // si la unidad es cero, ya no hace nada

                        } else {
                          $key = (int) substr($xaux, 2, 1);
                            $xseek = $xarray[$key]; // obtengo directamente el valor de la unidad (del uno al nueve)
                            $xsub = self::subfijo($xaux);
                            $xcadena = " " . $xcadena . " " . $xseek . " " . $xsub;
                        } // ENDIF (substr($xaux, 2, 1) < 1)
                        break;
                } // END SWITCH
            } // END FOR
            $xi = $xi + 3;
        } // ENDDO

        if (substr(trim($xcadena), -5, 5) == "ILLON") // si la cadena obtenida termina en MILLON o BILLON, entonces le agrega al final la conjuncion DE
        $xcadena.= " DE";

        if (substr(trim($xcadena), -7, 7) == "ILLONES") // si la cadena obtenida en MILLONES o BILLONES, entoncea le agrega al final la conjuncion DE
        $xcadena.= " DE";

        // ----------- esta línea la puedes cambiar de acuerdo a tus necesidades o a tu país -------
        if (trim($xaux) != "") {
          switch ($xz) {
            case 0:
            if (trim(substr($XAUX, $xz * 6, 6)) == "1")
              $xcadena.= "UN BILLON ";
            else
              $xcadena.= " BILLONES ";
            break;
            case 1:
            if (trim(substr($XAUX, $xz * 6, 6)) == "1")
              $xcadena.= "UN MILLON ";
            else
              $xcadena.= " MILLONES ";
            break;
            case 2:
            if ($xcifra < 1) {
              $xcadena = "CERO PESOS $xdecimales/100 M.N.";
            }
            if ($xcifra >= 1 && $xcifra < 2) {
              $xcadena = "UN PESO $xdecimales/100 M.N. ";
            }
            if ($xcifra >= 2) {
                        $xcadena.= " PESOS $xdecimales/100 M.N. "; //
                      }
                      break;
            } // endswitch ($xz)
        } // ENDIF (trim($xaux) != "")
        // ------------------      en este caso, para México se usa esta leyenda     ----------------
        $xcadena = str_replace("VEINTI ", "VEINTI", $xcadena); // quito el espacio para el VEINTI, para que quede: VEINTICUATRO, VEINTIUN, VEINTIDOS, etc
        $xcadena = str_replace("  ", " ", $xcadena); // quito espacios dobles
        $xcadena = str_replace("UN UN", "UN", $xcadena); // quito la duplicidad
        $xcadena = str_replace("  ", " ", $xcadena); // quito espacios dobles
        $xcadena = str_replace("BILLON DE MILLONES", "BILLON DE", $xcadena); // corrigo la leyenda
        $xcadena = str_replace("BILLONES DE MILLONES", "BILLONES DE", $xcadena); // corrigo la leyenda
        $xcadena = str_replace("DE UN", "UN", $xcadena); // corrigo la leyenda
    } // ENDFOR ($xz)
    return trim($xcadena);
  }

// END FUNCTION

  protected  function subfijo($xx)
{ // esta función regresa un subfijo para la cifra
  $xx = trim($xx);
  $xstrlen = strlen($xx);
  if ($xstrlen == 1 || $xstrlen == 2 || $xstrlen == 3)
    $xsub = "";
    //
  if ($xstrlen == 4 || $xstrlen == 5 || $xstrlen == 6)
    $xsub = "MIL";
    //
  return $xsub;
}

// END FUNCTION


public function importar_cartas(Request $request)
{
  $tipo_usuario = Auth::user()->tipo_usuario;
  if($tipo_usuario <> "2" || $tipo_usuario=="5"){
   return view('permisos');

 }else{

   $rechazos=array();
   $tarjetas_duplicadas=array();
   $registrados=array();

   $path = $request->excel->getRealPath();
   $data = Excel::load($path)->get();



   foreach ($data as $key => $value) {        
    $cct=$value->cct;
    $fortalecimiento=DB::table('fortalecimiento')->join('centro_trabajo','centro_trabajo.id','=','fortalecimiento.id_cct')->where('centro_trabajo.cct','=',$cct)->select('fortalecimiento.id')->first();

    if($fortalecimiento != null){
      $user = Auth::user()->name;
      $tarjeta= new TarjetasFortalecimientoModel;
      $tarjeta->id_fortalecimiento=$fortalecimiento->id;
      $tarjeta->tsl=$value->tsl;
      $tarjeta->num_tarjeta=$value->num_tarjeta;
      $combrueba=DB::table('tarjetasfortalecimiento')->where('num_tarjeta','=',$value->num_tarjeta)->get();
      if($combrueba == null){
        $tarjeta->producto=$value->producto;
        $tarjeta->empresa=$value->empresa;
        $tarjeta->observaciones=$value->observaciones;
        $tarjeta->captura=$user;
        $tarjeta->save();
        $data=['cct'=>$cct,'num_tarjeta'=>$value->num_tarjeta];
        array_push($registrados, $data);
      }else{
       $data2=['cct'=>$cct,'num_tarjeta'=>$value->num_tarjeta,'motivo'=>'YA SE ENCUENTRA UN NUMERO DE TARJETA IGUAL REGISTRADO'];

       array_push($tarjetas_duplicadas, $data2);

     }

   }else{
    $data3=['cct'=>$cct,'num_tarjeta'=>$value->num_tarjeta,'motivo'=>"NO SE ENCUENTRA MONTO DE FORTALECIMIENTO REGISTRADO"];
    array_push($rechazos, $data3);         

  }

}
 $ciclos=DB::table('ciclo_escolar')->get();





 return view('nomina.tarjetas_fortalecimiento.detalles', ['tarjetas_duplicadas'=>$tarjetas_duplicadas,'registrados'=>$registrados,'rechazos'=>$rechazos]);   

}}

public function tarjetas_forta(){
 $ciclos=DB::table('ciclo_escolar')->get();

 return view('nomina.tarjetas_fortalecimiento.importar', ['ciclos'=>$ciclos]);    

}

}

