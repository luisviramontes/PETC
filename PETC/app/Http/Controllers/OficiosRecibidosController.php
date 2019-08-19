<?php

namespace petc\Http\Controllers;

use Illuminate\Http\Request;

use petc\Http\Requests;
use petc\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Collection as Collection;
class OficiosRecibidosController extends Controller
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
      $tipo_usuario = Auth::user()->tipo_usuario;
      if($tipo_usuario < "0" || $tipo_usuario > "6"){
       return view('permisos');

   }else{
     if($request)
     {
        $query=trim($request->GET('searchText')); 
        $query2=trim($request->GET('ciclo_escolar'));

        $ciclos=DB::table('ciclo_escolar')->get();



        if($query == "" && $query2 == ""){
            $query2=2;
            $oficios=DB::table('oficiosrecibidos')->join('directoriointerno','directoriointerno.id','=','oficiosrecibidos.id_contesta')->join('ciclo_escolar','ciclo_escolar.id','=','oficiosrecibidos.id_ciclo')->select('oficiosrecibidos.*','directoriointerno.nombre','directoriointerno.lic','directoriointerno.area','directoriointerno.puesto','ciclo_escolar.ciclo')->where('ciclo_escolar.id','=',$query2)->get();
        }elseif($query == "" && $query2 != ""){
            $oficios=DB::table('oficiosrecibidos')->join('directoriointerno','directoriointerno.id','=','oficiosrecibidos.id_contesta')->join('ciclo_escolar','ciclo_escolar.id','=','oficiosrecibidos.id_ciclo')->select('oficiosrecibidos.*','directoriointerno.nombre','directoriointerno.lic','directoriointerno.area','directoriointerno.puesto','ciclo_escolar.ciclo')->where('ciclo_escolar.id','=',$query2)->get();

        }else{
            $oficios=DB::table('oficiosrecibidos')->join('directoriointerno','directoriointerno.id','=','oficiosrecibidos.id_contesta')->join('ciclo_escolar','ciclo_escolar.id','=','oficiosrecibidos.id_ciclo')->select('oficiosrecibidos.*','directoriointerno.nombre','directoriointerno.lic','directoriointerno.area','directoriointerno.puesto','ciclo_escolar.ciclo')->where('ciclo_escolar.id','=',$id)->where('oficiosrecibidos.num_oficio','LIKE','%'.$query.'%')->orwhere('oficiosrecibidos.asunto','LIKE','%'.$query.'%')->orwhere('oficiosrecibidos.referencia','LIKE','%'.$query.'%')->orwhere('directoriointerno.nombre','LIKE','%'.$query.'%')->orwhere('directoriointerno.area','LIKE','%'.$query.'%')->paginate(40);


        }
        //codigo
    }
    $contador= DB::table('oficiosrecibidos')->where('oficiosrecibidos.estado','=','PENDIENTE')->where('oficiosrecibidos.id_ciclo','=',$query2)->count();
    return view('administrativa.oficios_recibidos.index',["oficios"=>$oficios,"searchText"=>$query,"ciclo_escolar"=>$query2,'contador'=>$contador,'ciclos'=>$ciclos]);


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
    public function destroy($id)
    {
        //
    }
}
