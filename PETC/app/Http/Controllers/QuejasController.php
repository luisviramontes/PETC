<?php

namespace petc\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use petc\Http\Requests;

use petc\Http\Controllers\Controller;


use DB;
use Excel;
use PHPExcel_Worksheet_Drawing;
use Validator;
use petc\QuejasModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Collection as Collection;

class QuejasController extends Controller
{ 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

     $tipo_usuario = Auth::user()->tipo_usuario;
     if($tipo_usuario <> "2" && $tipo_usuario <>"5"  ){
       return view('permisos');

   }else{
       if($request)
       {
       // $aux=$request->get('searchText');
         $query=trim($request->GET('searchText'));       
         $query2=trim($request->GET('ciclo_escolar'));

         $ciclos=DB::table('ciclo_escolar')->get();

         if($query == "" && $query2 == ""){
             $query2=2;
             $quejas=DB::table('quejas')->join('ciclo_escolar','ciclo_escolar.id','=','quejas.id_ciclo')->join('centro_trabajo','centro_trabajo.id','=','quejas.id_centro_trabajo')->where('quejas.id_ciclo','=',$query2)->select('quejas.*','centro_trabajo.cct','centro_trabajo.nombre_escuela','centro_trabajo.domicilio','centro_trabajo.email','centro_trabajo.telefono','ciclo_escolar.ciclo')->paginate(40);    

         }elseif($query == "" && $query2 != ""){
            $quejas=DB::table('quejas')->join('ciclo_escolar','ciclo_escolar.id','=','quejas.id_ciclo')->join('centro_trabajo','centro_trabajo.id','=','quejas.id_centro_trabajo')->where('quejas.id_ciclo','=',$query2)->select('quejas.*','centro_trabajo.cct','centro_trabajo.nombre_escuela','centro_trabajo.domicilio','centro_trabajo.email','centro_trabajo.telefono','ciclo_escolar.ciclo')->paginate(40);    
        }else{   
            $quejas=DB::table('quejas')->join('ciclo_escolar','ciclo_escolar.id','=','quejas.id_ciclo')->join('centro_trabajo','centro_trabajo.id','=','quejas.id_centro_trabajo')->where('quejas.id_ciclo','=',$query2)->where('centro_trabajo.cct','LIKE','%'.$query.'%')->orwhere('centro_trabajo.nombre_escuela','LIKE','%'.$query.'%')->orwhere('quejas.motivo','LIKE','%'.$query.'%')->orwhere('quejas.descripcion','LIKE','%'.$query.'%')->select('quejas.*','centro_trabajo.cct','centro_trabajo.nombre_escuela','centro_trabajo.domicilio','centro_trabajo.email','centro_trabajo.telefono','ciclo_escolar.ciclo')->paginate(40);    

        }
        return view('administrativa.quejas.index',["ciclos"=>$ciclos,"quejas" => $quejas,"ciclo_escolar"=>$query2,"searchText"=>$query]);
    }
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
      $cct=DB::table('centro_trabajo')->get();
      $ciclos=DB::table('ciclo_escolar')->get();

      return view('administrativa.quejas.create',["cct"=>$cct,'ciclos'=>$ciclos]);
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
        $queja= new QuejasModel;
        $queja->id_centro_trabajo=$request->get('cct');
        $queja->id_ciclo=2;
        $queja->nombre_d=$request->get('nombre');
        $queja->telefono_=$request->get('telefono');
        $queja->ocupacion=$request->get('ocupacion');
        $queja->nombre_q=$request->get('nombres');
        $queja->puesto_q=$request->get('puesto');
        $queja->motivo=$request->get('motivo');
        $queja->descripcion=$request->get('descripcion');
        $queja->fecha=$request->get('fecha');
        $queja->estado="PENDIENTE";
        if(Input::hasFile('archivo')){
            $file=$request->file('archivo');
            $file->move(public_path().'/img/denuncias',$file->getClientoriginalName());
            $queja->archivo=$file->getClientoriginalName();
        }
        $queja->save();
        return Redirect::to('/');
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
      if($tipo_usuario <> "2" || $tipo_usuario<>"5"){
       return view('permisos');

   }else{ 
    $plan=DB::table('plan_contraste_nomina')->join('centro_trabajo','centro_trabajo.id','=','plan_contraste_nomina.id_centro_trabajo')->where('plan_contraste_nomina.id','=',$id)->select('plan_contraste_nomina.*','centro_trabajo.cct','centro_trabajo.nombre_escuela')->first();

    $ciclos=DB::table('ciclo_escolar')->get();
    return view("nomina.plan_contraste.edit",["plan" => $plan, "ciclos" => $ciclos]);

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
        $tipo_usuario = Auth::user()->tipo_usuario;
        if($tipo_usuario <> "2" && $tipo_usuario<>"5"){
         return view('permisos');

     }else{
      $user = Auth::user()->name;
      $queja = QuejasModel::find($id);
      $queja->delete();
      return Redirect::to('quejas');
  }
        //
}


public function resolverqueja($id)
{
    $tipo_usuario = Auth::user()->tipo_usuario;
    if($tipo_usuario <> "2" && $tipo_usuario<>"5"){
     return view('permisos');

 }else{
  $user = Auth::user()->name;
  $queja = QuejasModel::find($id);
  $queja->captura=$user;
   $queja->estado="RESUELTO";
  $queja->update();
  return Redirect::to('quejas');
}
        //
}



public function excel($aux)
{
  $tipo_usuario = Auth::user()->tipo_usuario;
  if($tipo_usuario <> "2" && $tipo_usuario <>"5"){
   return view('permisos'); 

}else{ 
    {

       Excel::create('QUEJAS Y DENUNCIAS', function($excel) use($aux) {
         $excel->sheet('Excel sheet', function($sheet) use($aux) {

            $quejas=QuejasModel::join('ciclo_escolar','ciclo_escolar.id','=','quejas.id_ciclo')->join('centro_trabajo','centro_trabajo.id','=','quejas.id_centro_trabajo')->where('quejas.id_ciclo','=',$aux)->select('quejas.id','centro_trabajo.cct','centro_trabajo.nombre_escuela','quejas.nombre_d','quejas.telefono_','quejas.ocupacion','quejas.nombre_q','quejas.puesto_q','quejas.motivo','quejas.descripcion','quejas.fecha','quejas.estado','ciclo_escolar.ciclo')->get();   


            $sheet->fromArray($quejas);
            $sheet->row(1,['N°','CCT','NOMBRE ESCUELA','NOMBRE/DENUNCIA','TELEFONO/DENUNCIA','OCUPACION/DENUNCIA','SERVIDOR PUBLICO','PUESTO','MOTIVO','DESCRIPCION','FECHA DENUNCIA','ESTADO','CICLO ESCOLAR']);
            $sheet->setOrientation('landscape');
        });
     })->export('xls');
   }


}
}


}
