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
use petc\PlanContasteNominaModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Collection as Collection;

class PlanContasteController extends Controller
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
             $plan=DB::table('plan_contraste_nomina')->join('ciclo_escolar','ciclo_escolar.id','=','plan_contraste_nomina.id_ciclo')->join('centro_trabajo','centro_trabajo.id','=','plan_contraste_nomina.id_cct_etc')->join('region','region.id','=','centro_trabajo.id_region')->where('plan_contraste_nomina.id_ciclo','=',$query2)->select('plan_contraste_nomina.*','centro_trabajo.cct','centro_trabajo.nombre_escuela','region.region','region.sostenimiento','centro_trabajo.domicilio','centro_trabajo.email','centro_trabajo.telefono','ciclo_escolar.ciclo')->paginate(40);

         }elseif($query == "" && $query2 != ""){
            $plan=DB::table('plan_contraste_nomina')->join('ciclo_escolar','ciclo_escolar.id','=','plan_contraste_nomina.id_ciclo')->join('centro_trabajo','centro_trabajo.id','=','plan_contraste_nomina.id_cct_etc')->join('region','region.id','=','centro_trabajo.id_region')->where('plan_contraste_nomina.id_ciclo','=',$query2)->select('plan_contraste_nomina.*','centro_trabajo.cct','centro_trabajo.nombre_escuela','region.region','region.sostenimiento','centro_trabajo.domicilio','centro_trabajo.email','centro_trabajo.telefono','ciclo_escolar.ciclo')->paginate(40);

        }else{
            $plan=DB::table('plan_contraste_nomina')->join('ciclo_escolar','ciclo_escolar.id','=','plan_contraste_nomina.id_ciclo')->join('centro_trabajo','centro_trabajo.id','=','plan_contraste_nomina.id_cct_etc')->join('region','region.id','=','centro_trabajo.id_region')->where('plan_contraste_nomina.id_ciclo','=',$query2)->where('centro_trabajo.cct','LIKE','%'.$query.'%')->orwhere('centro_trabajo.nombre_escuela','LIKE','%'.$query.'%')->select('plan_contraste_nomina.*','centro_trabajo.cct','centro_trabajo.nombre_escuela','region.region','region.sostenimiento','centro_trabajo.domicilio','centro_trabajo.email','centro_trabajo.telefono','ciclo_escolar.ciclo')->paginate(40);

        }
        return view('nomina.plan_contraste.index',["ciclos"=>$ciclos,"plan" => $plan,"ciclo_escolar2"=>$query2,"searchText"=>$query]);
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
     $tipo_usuario = Auth::user()->tipo_usuario;
     if($tipo_usuario <> "2" || $tipo_usuario=="5"){
       return view('permisos');

   }else{
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
    $plan=DB::table('plan_contraste_nomina')->join('centro_trabajo','centro_trabajo.id','=','plan_contraste_nomina.id_cct_etc')->where('plan_contraste_nomina.id','=',$id)->select('plan_contraste_nomina.*','centro_trabajo.cct','centro_trabajo.nombre_escuela')->first();

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
     $tipo_usuario = Auth::user()->tipo_usuario;
     if($tipo_usuario <> "2" || $tipo_usuario=="5"){
       return view('permisos');

   }else{
    //   $user = Auth::user()->name; 
     $plan = PlanContasteNominaModel::findOrFail($id);
     $plan->total_directores =$request->get('total_dire');
     $plan->monto_directores=$request->get('perce_dire');
     $plan->deducciones_directores =$request->get('dedu_dire');
     $plan->total_docentes=$request->get('total_doce');
     $plan->monto_docentes=$request->get('perce_doce');
     $plan->deducciones_docentes=$request->get('dedu_doce');
     $plan->total_intendentes=$request->get('total_inte');
     $plan->monto_intendentes=$request->get('perce_inte');
     $plan->deducciones_intendentes=$request->get('dedu_inte');
     $plan->update();
     return Redirect::to('plan_contraste');
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
   }
        //
}

public function excel(Request $request, $aux)
{

   Excel::create('PLAN CONTRASTE', function($excel) use($aux) {
     $excel->sheet('Excel sheet', function($sheet) use($aux) {



        $plan = PlanContasteNominaModel::join('ciclo_escolar','ciclo_escolar.id','=','plan_contraste_nomina.id_ciclo')->join('centro_trabajo','centro_trabajo.id','=','plan_contraste_nomina.id_cct_etc')->join('region','region.id','=','centro_trabajo.id_region')->where('plan_contraste_nomina.id_ciclo','=',$aux)->select('region.region','region.sostenimiento','centro_trabajo.cct','centro_trabajo.nombre_escuela','plan_contraste_nomina.total_directores','plan_contraste_nomina.total_docentes','plan_contraste_nomina.total_intendentes','plan_contraste_nomina.monto_directores','plan_contraste_nomina.monto_docentes','plan_contraste_nomina.monto_intendentes','plan_contraste_nomina.deducciones_directores','plan_contraste_nomina.deducciones_docentes','plan_contraste_nomina.deducciones_intendentes','ciclo_escolar.ciclo')->get();

        $sheet->fromArray($plan);
        $sheet->row(1,['REGION','SOSTENIMIENTO','CCT','NOMBRE ESCUELA','TOTAL DIRECTORES','TOTAL DOCENTES','TOTAL INTENDENTES','PERCEPCION DIRECTORES','PERCEPCION DOCENTES','PERCEPCION INTENDENTES','DEDUCCIONES DIRECTORES','DEDUCCIONES DOCENTES','DEDUCCIONES INTENDENTES','CICLO ESCOLAR']);
        $sheet->setOrientation('landscape');
    });
 })->export('xls');
}

public function invoice($id)
{
 $tipo_usuario = Auth::user()->tipo_usuario;
 if($tipo_usuario <> "2" || $tipo_usuario=="5"){
   return view('permisos');

}else{
}
        //
}

public function ver_plan($ciclo){


   $total_directores=DB::table('plan_contraste_nomina')->where('id_ciclo','=',$ciclo)->select(DB::raw('SUM(plan_contraste_nomina.total_directores) as total_director'))->first();

   $total_docentes=DB::table('plan_contraste_nomina')->where('id_ciclo','=',$ciclo)->select(DB::raw('SUM(plan_contraste_nomina.total_docentes) as total_docente'))->first();

   $total_intendentes=DB::table('plan_contraste_nomina')->where('id_ciclo','=',$ciclo)->select(DB::raw('SUM(plan_contraste_nomina.total_intendentes) as total_intendente'))->first();

   $total_registros=$total_directores->total_director+$total_docentes->total_docente+$total_intendentes->total_intendente;

   $total_perce_dire=DB::table('plan_contraste_nomina')->where('id_ciclo','=',$ciclo)->select(DB::raw('SUM(plan_contraste_nomina.monto_directores) as total_perce_dire'))->first();

   $total_perce_doce=DB::table('plan_contraste_nomina')->where('id_ciclo','=',$ciclo)->select(DB::raw('SUM(plan_contraste_nomina.monto_docentes) as total_perce_doce'))->first();

   $total_perce_inte=DB::table('plan_contraste_nomina')->where('id_ciclo','=',$ciclo)->select(DB::raw('SUM(plan_contraste_nomina.monto_intendentes) as total_perce_inte'))->first();

   $total_perce=$total_perce_dire->total_perce_dire+$total_perce_doce->total_perce_doce+$total_perce_inte->total_perce_inte;

   $total_dedu_dire=DB::table('plan_contraste_nomina')->where('id_ciclo','=',$ciclo)->select(DB::raw('SUM(plan_contraste_nomina.deducciones_directores) as total_dedu_dire'))->first();

   $total_dedu_doce=DB::table('plan_contraste_nomina')->where('id_ciclo','=',$ciclo)->select(DB::raw('SUM(plan_contraste_nomina.deducciones_docentes) as total_dedu_doce'))->first();

   $total_dedu_inte=DB::table('plan_contraste_nomina')->where('id_ciclo','=',$ciclo)->select(DB::raw('SUM(plan_contraste_nomina.deducciones_intendentes) as total_dedu_inte'))->first();

   $total_dedu=$total_dedu_dire->total_dedu_dire+$total_dedu_doce->total_dedu_doce+$total_dedu_inte->total_dedu_inte;

   $total_liquido_dire=$total_perce_dire->total_perce_dire-$total_dedu_dire->total_dedu_dire;
   $total_liquido_doce=$total_perce_doce->total_perce_doce-$total_dedu_doce->total_dedu_doce;
   $total_liquido_inte=$total_perce_inte->total_perce_inte-$total_dedu_inte->total_dedu_inte;

   $total_liquido=$total_liquido_dire+$total_liquido_doce+$total_liquido_inte;
   $regiones=DB::table('region')->where('estado','=','ACTIVO')->get();

   $ciclo=DB::table('ciclo_escolar')->where('id','=',$ciclo)->select('id','ciclo')->first();
   return view("nomina.plan_contraste.ver_plan",['total_directores'=>$total_directores,'total_docentes'=>$total_docentes,'total_intendentes'=>$total_intendentes,'total_registros'=>$total_registros,"total_perce_dire" => $total_perce_dire, "total_perce_doce" => $total_perce_doce,'total_perce_inte'=>$total_perce_inte,'total_perce'=>$total_perce,'total_dedu_dire'=>$total_dedu_dire,'total_dedu_doce'=>$total_dedu_doce,'total_dedu_inte'=>$total_dedu_inte,'total_dedu'=>$total_dedu,'total_liquido_dire'=>$total_liquido_dire,'total_liquido_doce'=>$total_liquido_doce,'total_liquido_inte'=>$total_liquido_inte,'total_liquido'=>$total_liquido,'ciclo'=>$ciclo,'regiones'=>$regiones]); 


}

public function ver_plan_region($ciclo_aux,$region){
 $ciclo=DB::table('ciclo_escolar')->where('ciclo','=',$ciclo_aux)->first()->id;

   $total_directores=DB::table('plan_contraste_nomina')->join('centro_trabajo','centro_trabajo.id','=','plan_contraste_nomina.id_cct_etc')->where('centro_trabajo.id_region','=',$region)->where('plan_contraste_nomina.id_ciclo','=',$ciclo)->select(DB::raw('SUM(plan_contraste_nomina.total_directores) as total_director'))->first();

   $total_docentes=DB::table('plan_contraste_nomina')->join('centro_trabajo','centro_trabajo.id','=','plan_contraste_nomina.id_cct_etc')->where('centro_trabajo.id_region','=',$region)->where('plan_contraste_nomina.id_ciclo','=',$ciclo)->select(DB::raw('SUM(plan_contraste_nomina.total_docentes) as total_docente'))->first();

   $total_intendentes=DB::table('plan_contraste_nomina')->join('centro_trabajo','centro_trabajo.id','=','plan_contraste_nomina.id_cct_etc')->where('centro_trabajo.id_region','=',$region)->where('plan_contraste_nomina.id_ciclo','=',$ciclo)->select(DB::raw('SUM(plan_contraste_nomina.total_intendentes) as total_intendente'))->first();

   $total_registros=$total_directores->total_director+$total_docentes->total_docente+$total_intendentes->total_intendente;

   $total_perce_dire=DB::table('plan_contraste_nomina')->join('centro_trabajo','centro_trabajo.id','=','plan_contraste_nomina.id_cct_etc')->where('centro_trabajo.id_region','=',$region)->where('plan_contraste_nomina.id_ciclo','=',$ciclo)->select(DB::raw('SUM(plan_contraste_nomina.monto_directores) as total_perce_dire'))->first();

   $total_perce_doce=DB::table('plan_contraste_nomina')->join('centro_trabajo','centro_trabajo.id','=','plan_contraste_nomina.id_cct_etc')->where('centro_trabajo.id_region','=',$region)->where('plan_contraste_nomina.id_ciclo','=',$ciclo)->select(DB::raw('SUM(plan_contraste_nomina.monto_docentes) as total_perce_doce'))->first();

   $total_perce_inte=DB::table('plan_contraste_nomina')->join('centro_trabajo','centro_trabajo.id','=','plan_contraste_nomina.id_cct_etc')->where('centro_trabajo.id_region','=',$region)->where('plan_contraste_nomina.id_ciclo','=',$ciclo)->select(DB::raw('SUM(plan_contraste_nomina.monto_intendentes) as total_perce_inte'))->first();

   $total_perce=$total_perce_dire->total_perce_dire+$total_perce_doce->total_perce_doce+$total_perce_inte->total_perce_inte;

   $total_dedu_dire=DB::table('plan_contraste_nomina')->join('centro_trabajo','centro_trabajo.id','=','plan_contraste_nomina.id_cct_etc')->where('centro_trabajo.id_region','=',$region)->where('plan_contraste_nomina.id_ciclo','=',$ciclo)->select(DB::raw('SUM(plan_contraste_nomina.deducciones_directores) as total_dedu_dire'))->first();

   $total_dedu_doce=DB::table('plan_contraste_nomina')->join('centro_trabajo','centro_trabajo.id','=','plan_contraste_nomina.id_cct_etc')->where('centro_trabajo.id_region','=',$region)->where('plan_contraste_nomina.id_ciclo','=',$ciclo)->select(DB::raw('SUM(plan_contraste_nomina.deducciones_docentes) as total_dedu_doce'))->first();

   $total_dedu_inte=DB::table('plan_contraste_nomina')->join('centro_trabajo','centro_trabajo.id','=','plan_contraste_nomina.id_cct_etc')->where('centro_trabajo.id_region','=',$region)->where('plan_contraste_nomina.id_ciclo','=',$ciclo)->select(DB::raw('SUM(plan_contraste_nomina.deducciones_intendentes) as total_dedu_inte'))->first();

   $total_dedu=$total_dedu_dire->total_dedu_dire+$total_dedu_doce->total_dedu_doce+$total_dedu_inte->total_dedu_inte;

   $total_liquido_dire=$total_perce_dire->total_perce_dire-$total_dedu_dire->total_dedu_dire;
   $total_liquido_doce=$total_perce_doce->total_perce_doce-$total_dedu_doce->total_dedu_doce;
   $total_liquido_inte=$total_perce_inte->total_perce_inte-$total_dedu_inte->total_dedu_inte;

   $total_liquido=$total_liquido_dire+$total_liquido_doce+$total_liquido_inte;


   return response()->json([$total_directores,$total_docentes,$total_intendentes,$total_registros,$total_perce_dire, $total_perce_doce,$total_perce_inte,$total_perce,$total_dedu_dire,$total_dedu_doce,$total_dedu_inte,$total_dedu,$total_liquido_dire,$total_liquido_doce,$total_liquido_inte,$total_liquido]);

}


}
