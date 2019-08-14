@extends('layouts.principal')
@section('contenido')
<div class="pull-left breadcrumb_admin clear_both">
	<div class="pull-left page_title theme_color">
		<h1>Inicio</h1>
		<h2 class="">Historial de Reintegros </h2>
	</div>
	<div class="pull-right">
		<ol class="breadcrumb">
			<li ><a style="color: #808080" href="{{url('/captura')}}">Inicio</a></li>
			<li class="active">Historial de Reintegros</a></li>
		</ol>
	</div>
</div>
<div class="container clear_both padding_fix">
	<div class="row">
		<div class="col-md-12">
			<div class="block-web">
				<div class="header">
					<div class="row" style="margin-top: 15px; margin-bottom: 12px;">
						<div class="col-sm-7">
							<div class="actions"> </div>

							<h4 class="content-header " style="margin-top: -5px;">&nbsp;&nbsp;<strong>Historial de Reintegros :</strong></h4>



						</div>
						<div class="btn-group pull-right">
							<b>
								<div class="btn-group" style="margin-right: 10px;">
									<a class="btn btn-sm btn-success tooltips" href="{{URL::action('ReintegrosController@create',[])}}" style="margin-right: 10px;" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Registrar Nueva Captura"> <i class="fa fa-plus"></i> Registrar </a>



									<a class="btn btn-sm btn-danger tooltips" href="{{URL::action('CapturaController@index')}}" style="margin-right: 10px;" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Cancelar"> <i class="fa fa-times"></i> Salir</a>

									<a class="btn btn-primary btn-sm" id="pdf_reintegros" href="{{URL::action('ReintegrosController@invoice2','2')}}" style="margin-right: 10px;" data-toggle="tooltip"  target="_blank" data-placement="bottom" title="" data-original-title="Descargar"> <i class="fa fa-print"></i> Generar PDF</a>



								</div>

							</a>

						</b>
					</div>

				</div>
			</div>


<h5 class="content-header " style="margin-top: -5px;">&nbsp;&nbsp;<strong>Por Ciclo Escolar :</strong></h5>
			<br> <br>

			<div class="form-group">
				<label class="col-sm-3 control-label">Seleccione Ciclo Escolar: <strog class="theme_color"></strog></label>
				<div class="col-sm-6">
					<select name="ciclo_escolar" id="ciclo_escolar" onchange="busca_rein();busca_rein_region()" class="form-control select2">
						@foreach($ciclos as $ciclo)
						@if($ciclo->id == 2)
						<option value='{{$ciclo->id}}' selected>
							{{$ciclo->ciclo}}
						</option>
						@else
						<option value='{{$ciclo->id}}' >
							{{$ciclo->ciclo}}
						</option>
						@endif
						@endforeach
					</select>

				</div>
			</div>

			<br> <br>

			<div class="form-group"  class="table-responsive">
				<table id="detalles" name="detalles[]" value="" class="table table-responsive-xl table-bordered">
					<thead style="background-color:#A9D0F5">
						<th>N°</th>
						<th>Total</th>
						<th>N° Estatales</th>
						<th>Total Estatal</th>
						<th>N° Federales </th>
						<th>Total Federal</th>



					</thead>
					<tfoot>
						<td style="display:none;"></td>
						<td style="display:none;"></td>
						<td style="display:none;"></td>
						<td style="display:none;"></td>
						<td style="display:none;"></td>
						<td style="display:none;"></td>

					</tfoot>
				</table>


			<a class="btn btn-sm btn-warning tooltips" id="descargar-reintegros" href="{{ route('nomina.reintegros.excel',2)}}" style="margin-right: 10px;" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Descargar"> <i class="fa fa-download"></i> Descargar </a>

</div>
<br> <br>


			<div class="form-group">
				<label class="col-sm-3 control-label">Seleccione Región: <strog class="theme_color"></strog></label>
				<div class="col-sm-6">
					<select name="region" id="region" onchange="busca_rein_region()" class="form-control select2">
						<option selected>
							Selecione una opción
						</option>
						@foreach($regiones as $region)
						<option value='{{$region->id}}' >
							{{$region->region}} {{$region->sostenimiento}}
						</option>
						@endforeach
					</select>

				</div>
			</div>
<br> <br>
			<div class="form-group"  class="table-responsive">
				<table id="detalles2" name="detalles2[]" value="" class="table table-responsive-xl table-bordered">
					<thead style="background-color:#A9D0F5">
						<th>N°</th>
						<th>Total</th>
						<th>Total Estatal</th>
						<th>Total Federal</th>



					</thead>
					<tfoot>
						<td style="display:none;"></td>
						<td style="display:none;"></td>
						<td style="display:none;"></td>
						<td style="display:none;"></td>




					</tfoot>
				</table>
			</div>



		</div><!--/porlets-content-->
	</div><!--/block-web-->
</div><!--/col-md-12-->
</div><!--/row-->
</div>

<script type="text/javascript">
	window.onload=function(){
		busca_rein();
		busca_rein_region();
}

function busca_rein(){
  document.getElementById("detalles").deleteRow(1);

  var ciclo = document.getElementById('ciclo_escolar').value;

  document.getElementById('pdf_reintegros').href="http://localhost:8000/pdf_reintegros/"+ciclo;

  var route = "http://localhost:8000/busca_rein/"+ciclo;

  document.getElementById('descargar-reintegros').href="http://localhost:8000/descargar-reintegros/"+ciclo;

	var activo = 0;
  var totala= 0;
  var estatal = 0;
  var federal = 0;
  var totest = 0;
  var totfed = 0;

  $.get(route,function(res){

    if(res.length > 0){
      for (var i =0; res.length > i; i++) {
        if(res[i].estado == "ACTIVO"){
          activo = activo +1;

        }

        if(res[i].sostenimiento == "ESTATAL" || res[i].sostenimiento == "	ESTATAL" ){
          estatal=estatal+1;
						totest= res[i].total * estatal;

        }else if(res[i].sostenimiento == "FEDERAL" || res[i].sostenimiento == "	FEDERAL" ){
          federal=federal+1;
					totfed= res[i].total * federal;
        }

				if(res[i].total != 0){
					totala= totest + totfed;
				}

      /*  if(res[i].qna_actual != 0){
          recibidos=recibidos+1;
        }else if(res[i].qna_actual == 0){
          pendientes=pendientes+1;
        }
*/
      }
    }
    var tabla = document.getElementById("detalles");
    var row = tabla.insertRow(1);
    row.style.backgroundColor = "white";
    var cell1 = row.insertCell(0);
    var cell2 = row.insertCell(1);
    var cell3 = row.insertCell(2);
    var cell4 = row.insertCell(3);
		var cell5 = row.insertCell(4);
		var cell6 = row.insertCell(5);


    cell1.innerHTML = res.length;
    cell2.innerHTML = currencyFormat(totala);
    cell3.innerHTML =  estatal;
    cell4.innerHTML =  currencyFormat(totest);
		cell5.innerHTML =  federal;
		cell6.innerHTML =  currencyFormat(totfed);


  });


}

function busca_rein_region(){
  document.getElementById("detalles2").deleteRow(1);

 var ciclo = document.getElementById('ciclo_escolar').value;
 var region = document.getElementById('region').value;

 var route = "http://localhost:8000/busca_rein_region/"+region+"/"+ciclo;

 var activo = 0;
 var totala= 0;
 var estatal = 0;
 var federal = 0;
 var totest = 0;
 var totfed = 0;



 $.get(route,function(res){
	 console.log(res);
   if(res.length > 0){
     for (var i =0; res.length > i; i++) {
       if(res[i].estado == "ACTIVO"){
         activo = activo +1;
    }


		if(res[i].sostenimiento == "ESTATAL" || res[i].sostenimiento == "	ESTATAL" ){
			estatal=estatal+1;
				totest= res[i].total * estatal;

		}else if(res[i].sostenimiento == "FEDERAL" || res[i].sostenimiento == "	FEDERAL" ){
			federal=federal+1;
			totfed= res[i].total * federal;
		}

		if(res[i].monto_forta != 0){
			totala= totest + totfed;
		}


     }
   }



   var tabla = document.getElementById("detalles2");
   var row = tabla.insertRow(1);
   row.style.backgroundColor = "white";
	 var cell1 = row.insertCell(0);
	 var cell2 = row.insertCell(1);
	 var cell3 = row.insertCell(2);
	 var cell4 = row.insertCell(3);



	 cell1.innerHTML = res.length;
	 cell2.innerHTML = currencyFormat(totala);
	// cell3.innerHTML =  totest.toFixed(2);
	// cell4.innerHTML =  totfed.toFixed(2);
	cell3.innerHTML =  currencyFormat(totest);
  cell4.innerHTML =  currencyFormat(totfed);

 });


}


</script>
@endsection
