@extends('layouts.principal')
@section('contenido')
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<div class="pull-left breadcrumb_admin clear_both">
	<div class="pull-left page_title theme_color">
		<h1>Rechazos </h1>
		<h2 class="">Rechazos</h2>
	</div>
	<div class="pull-right">
		<ol class="breadcrumb">
			<li ><a style="color: #808080" href="{{url('/')}}">Inicio</a></li>
			<li class="active">Tabla de Rechazos </a></li>
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
							<h2 class="content-header" style="margin-top: -5px;">&nbsp;&nbsp;<strong>Tabla de Rechazos</strong></h2>
							<br>
								@include('nomina.cap_rechazo.search')

						</div>
						<div class="col-md-5">
							<div class="btn-group pull-right">
								<b>


									<div class="btn-group" style="margin-right: 10px;">

										<a class="btn btn-sm btn-success tooltips" href="{{ route('cap_rechazo.create')}}" style="margin-right: 10px;" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Registrar Nueva Nomina"> <i class="fa fa-plus"></i> Registrar </a>
										<a class="btn btn-sm btn-warning tooltips" href="{{ route('nomina.cap_rechazo.excel')}}" style="margin-right: 10px;" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Descargar"> <i class="fa fa-download"></i> Descargar </a>
										<a class="btn btn-primary btn-sm" href="{{URL::action('RechazoCapController@invoice','2018-2019')}}" style="margin-right: 10px;" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Descargar"> <i class="fa fa-print"></i> Generar PDF</a>


									</div>

								</a>
							</b>
						</div>
					</div>
				</div>
			</div>

			<div class="porlets-content">
				<div class="table-responsive">
					<table cellpadding="0" cellpadding="0" border="0"  class="display table table-bordered" id="hidden-table-info">
						<thead>
							<tr>

								<th>Quincena</th>
								<th>Sostenimiento</th>
								<th>Ver&nbsp; &nbsp;</th>
								<th>Tipo</th>
								<th>Estado</th>
								<th>Captura</th>
								<th>Fecha de Captura</th>
              	<td><center><b>Editar</b></center></td>
								<td><center><b>Borrar</b></center></td>
							</tr>
						</thead>
						<tbody>
						@foreach($cap_rechazo  as $rechazo)
							@if ($rechazo->estado == "ACTIVO")
							<tr class="gradeX">
								<td style="background-color:#DBFFC2;">{{$rechazo->qna}} </td>
								<td style="background-color:#DBFFC2;">{{$rechazo->sostenimiento}}</td>
								<td style="background-color:#DBFFC2;">
									@if ($rechazo->sostenimiento == "FEDERAL")
									<a href="{{ action('RechazosFederalController@index') }}" class="btn btn-primary btn-sm" role="button"><i class="fa fa-eye"></i></a>
									@else
									<a href="{{ action('RechazosEstController@index') }}" class="btn btn-primary btn-sm" role="button"><i class="fa fa-eye"></i></a>
									@endif
								</td>
								<td style="background-color:#DBFFC2;">{{$rechazo->tipo}}</td>
								<td style="background-color:#DBFFC2;">{{$rechazo->estado}}</td>
								<td style="background-color:#DBFFC2;">{{$rechazo->captura}}</td>
								<td style="background-color:#DBFFC2;">{{$rechazo->created_at}}</td>




								@if ($rechazo->estado == "INACTIVO")


								<td style="background-color:#DBFFC2;">
									<center>
										<a href="{{URL::action('RechazoCapController@edit',$rechazo->id)}}" id="edit" onchange="valida_edit()" title="Editar" class="btn btn-primary btn-sm" role="button"><i class="fa fa-edit"></i></a>

									</center>
								</td>
								@else <td style="background-color:#DBFFC2;">
									<center>

											<h4><span class="label label-warning">Inactivar para editar</span></h4>

									</center>
								</td>
								@endif
								<td style="background-color:#DBFFC2;">
									<center>
										<a class="btn btn-danger btn-sm" id="delete" data-target="#modal-delete-{{$rechazo->id}}" data-toggle="modal" style="margin-right: 10px;"  role="button"><i class="fa fa-eraser"></i></a></center>

									</center>
									</td>
								</td>
							</tr>
							@else
							<tr class="gradeX">
								<td style="background-color:#FFE4E1;">{{$rechazo->qna}} </td>
								<td style="background-color:#FFE4E1;">{{$rechazo->sostenimiento}}</td>
								<td style="background-color:#FFE4E1;">
									@if ($rechazo->sostenimiento == "FEDERAL")
									<a href="{{ action('RechazosFederalController@index') }}" class="btn btn-primary btn-sm" role="button"><i class="fa fa-eye"></i></a>
									@else
									<a href="{{ action('RechazosEstController@index') }}" class="btn btn-primary btn-sm" role="button"><i class="fa fa-eye"></i></a>
									@endif
								</td>
								<td style="background-color:#FFE4E1;">{{$rechazo->tipo}}</td>
								<td style="background-color:#FFE4E1;">{{$rechazo->estado}}</td>
								<td style="background-color:#FFE4E1;">{{$rechazo->captura}}</td>
								<td style="background-color:#FFE4E1;">{{$rechazo->created_at}}</td>




								@if ($rechazo->estado == "INACTIVO")


								<td style="background-color:#FFE4E1;">
									<center>
										<a href="{{URL::action('RechazoCapController@edit',$rechazo->id)}}" id="edit" onchange="valida_edit()" title="Editar" class="btn btn-primary btn-sm" role="button"><i class="fa fa-edit"></i></a>

									</center>
								</td>
								@else <td style="background-color:#FFE4E1;">
									<center>

											<h4><span class="label label-warning">Inactivar para editar</span></h4>

									</center>
								</td>
								@endif
								<td style="background-color:#FFE4E1;">
									<center>
										<a class="btn btn-danger btn-sm" id="delete" data-target="#modal-delete-{{$rechazo->id}}" data-toggle="modal" style="margin-right: 10px;"  role="button"><i class="fa fa-eraser"></i></a></center>

									</center>
									</td>
								</td>
							</tr>
							@endif
							@include('nomina.cap_rechazo.modal')
					@endforeach
						</tbody>
						<!--<tfoot>
							<tr>
                <th></th>
								<th>Quincena </th>
								<th>Dias Trabajados</th>
								<th>Pago por Director </th>
								<th>Pago por Docente </th>
								<th>Pago por Intendente </th>
								<th>Ciclo </th>>
								<th>Capturo </th>
								<th>Modificado</th>


								<td><center><b>Editar</b></center></td>
								<td><center><b>Borrar</b></center></td>
							</tr>
						</tfoot> -->
					</table>

				</div><!--/table-responsive-->
			</div><!--/porlets-content-->
		</div><!--/block-web-->
	</div><!--/col-md-12-->
</div><!--/row-->
</div>
<script type="text/javascript">
window.onload = function() {

	//valida_edit();



function valida_edit(){

		var estado= document.getElementById("estado").value;

		var route = "http://localhost:8000/validar_edit/"+estado;
		var aux=0;


		$.get(route,function(res){

				if(res.length > 0 ){
					for (var i=0; i < res.length; i++){
						if(res[i].estado != "ACTIVO"){


							document.getElementById('edit').disabled=false;

						//	document.getElementById("error_rechazoapturada").innerHTML = "La Quincena que intenta registrar ya ha sido insertada anteriormente";
							return false
						}

					}
				}else{
					swal("ERROR!","Inactiva esta quincena para poder editar","error");

						document.getElementById('edit').disabled=true;
		//valida_file();
				}

		});
	//	valida_file();



}

}



</script>
@endsection
