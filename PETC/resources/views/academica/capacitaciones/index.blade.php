@extends('layouts.principal')
@section('contenido')
<div class="pull-left breadcrumb_admin clear_both">
	<div class="pull-left page_title theme_color">
		<h1>Capacitaciónes</h1>
		<h2 class="">Capacitaciónes</h2>
	</div>
	<div class="pull-right">
		<ol class="breadcrumb">
			<li ><a style="color: #808080" href="{{url('/capacitaciones')}}">Inicio</a></li>
			<li class="active">Capacitaciónes</a></li>
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
							<h2 class="content-header" style="margin-top: -5px;">&nbsp;&nbsp;<strong>Capacitaciónes: </strong></h2>
							@include('academica.capacitaciones.search')

						</div>
												<div class="col-md-5">
							<div class="btn-group pull-right">
								<b>

									<div class="btn-group" style="margin-right: 10px;">
										<a class="btn btn-sm btn-success tooltips" href="{{ route('capacitaciones.create')}}" style="margin-right: 10px;" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Registrar Nuevo Empleado"> <i class="fa fa-plus"></i> Registrar </a>
										<a class="btn btn-sm btn-warning tooltips" href="{{ route('academica.capacitaciones.excel',2)}}" id="excel" style="margin-right: 10px;" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Descargar"> <i class="fa fa-download"></i> Descargar </a>

									</div>
								</b>
							</div>
						</div>

					</div>
				</div>

				<div class="porlets-content">
					<div class="table-responsive">
						<table cellpadding="0" cellpadding="0" border="0"  class="display table table-bordered" id="hidden-table-info23">

							<thead>
								<tr>

									<th>Nombre Capacitacion </th>
									<th>Dirigido</th>
									<th>Lugar</th>
									<th >Dia</th>
									<th style="display:none;">Hora</th>
									<th style="display:none;">Imparte</th>
									<th style="display:none;">Área</th>
									<th style="display:none;">Motivo</th>
									<th style="display:none;">Descripción</th>
									<th style="display:none;">Ciclo</th>
									<th>Estado</th>
									<th style="display:none;">Captura</th>
									<th >Evidencia</th>
									<th>Resuelto</th>
									<th>Modificar</th>
									<th>Borrar</th>
								</tr>
							</thead>
							<tbody>
								@foreach($capacitaciones  as $capacitaciones)
									@if ($capacitaciones->estado == "REALIZADA")
								<tr class="gradeX">

									<td style="background-color:#DBFFC2;">{{$capacitaciones->nombre_capacitacion}} </td>
									<td style="background-color:#DBFFC2;">{{$capacitaciones->dirigido}}</td>
									<td style="background-color:#DBFFC2;">{{$capacitaciones->lugar}}</td>
									<td style="background-color:#DBFFC2;">{{$capacitaciones->dia}}</td>
									<td style="display:none;">{{$capacitaciones->hora}}</td>
									<td style="display:none;">{{$capacitaciones->imparte}}</td>
									<td style="display:none;">{{$capacitaciones->area}}</td>
									<td style="display:none;">{{$capacitaciones->motivo}}</td>
									<td style="display:none;">{{$capacitaciones->descripcion}}</td>
									<td style="display:none;">{{$capacitaciones->ciclo}}</td>
									<td style="background-color:#DBFFC2;">{{$capacitaciones->estado}}</td>
									<td style="display:none;">{{$capacitaciones->captura}}</td>
									<td style="background-color:#DBFFC2;">	@if(($capacitaciones->archivo)!="")
										<img src="{{asset('img/capacitaciones/'.$capacitaciones->archivo)}}" alt="{{$capacitaciones->archivo}}" height="100px" width="100px" class="img-thumbnail">
										@else
										No Hay Imagen Disponible
										@endif</td>

									<td style="background-color:#DBFFC2;">
										<a class="btn btn-sm btn-success tooltips" data-target="#modal-delete2-{{$capacitaciones->id}}" data-toggle="modal" style="margin-right: 10px;"  role="button"> <i class="glyphicon glyphicon-ok"></i></a>
									</td>

									<td style="background-color:#DBFFC2;">
										<center>
											<a href="{{URL::action('CapacitacionesController@edit',$capacitaciones->id)}}" id="edit"  title="Editar" class="btn btn-primary btn-sm" role="button"><i class="fa fa-edit"></i></a>

										</center>
									</td>

									<td style="background-color:#DBFFC2;">
										<center>
											<a class="btn btn-danger btn-sm" data-target="#modal-delete-{{$capacitaciones->id}}" data-toggle="modal" style="margin-right: 10px;"  role="button"><i class="fa fa-eraser"></i></a></center>
										</td>




									</tr>
									@else

									<tr class="gradeX">

										<td style="background-color:#FFE4E1;">{{$capacitaciones->nombre_capacitacion}} </td>
										<td style="background-color:#FFE4E1;">{{$capacitaciones->dirigido}}</td>
										<td style="background-color:#FFE4E1;">{{$capacitaciones->lugar}}</td>
										<td style="background-color:#FFE4E1;">{{$capacitaciones->dia}}</td>
										<td style="display:none;">{{$capacitaciones->hora}}</td>
										<td style="display:none;">{{$capacitaciones->imparte}}</td>
										<td style="display:none;">{{$capacitaciones->area}}</td>
										<td style="display:none;">{{$capacitaciones->motivo}}</td>
										<td style="display:none;">{{$capacitaciones->descripcion}}</td>
										<td style="display:none;">{{$capacitaciones->ciclo}}</td>
										<td style="background-color:#FFE4E1;">{{$capacitaciones->estado}}</td>
										<td style="display:none;">{{$capacitaciones->captura}}</td>
										<td style="background-color:#FFE4E1;">	@if(($capacitaciones->archivo)!="")
											<img src="{{asset('img/capacitaciones/'.$capacitaciones->archivo)}}" alt="{{$capacitaciones->archivo}}" height="100px" width="100px" class="img-thumbnail">
											@else
											No Hay Imagen Disponible
											@endif</td>

										<td style="background-color:#FFE4E1;">
											<a class="btn btn-sm btn-success tooltips" data-target="#modal-delete2-{{$capacitaciones->id}}" data-toggle="modal" style="margin-right: 10px;"  role="button"> <i class="glyphicon glyphicon-ok"></i></a>
										</td>

										<td style="background-color:#FFE4E1;">
											<center>
												<a href="{{URL::action('CapacitacionesController@edit',$capacitaciones->id)}}" id="edit"  title="Editar" class="btn btn-primary btn-sm" role="button"><i class="fa fa-edit"></i></a>

											</center>
										</td>

										<td style="background-color:#FFE4E1;">
											<center>
												<a class="btn btn-danger btn-sm" data-target="#modal-delete-{{$capacitaciones->id}}" data-toggle="modal" style="margin-right: 10px;"  role="button"><i class="fa fa-eraser"></i></a></center>
											</td>




										</tr>
									@endif

									@include('academica.capacitaciones.modal')
									@include('academica.capacitaciones.modale')
									@endforeach
								</tbody>

									<tfoot>
										<tr>
											<th></th>

											<th>Nombre Capacitacion </th>
											<th>Dirigido</th>
											<th>Lugar</th>
											<th >Dia</th>
											<th style="display:none;">Hora</th>
											<th style="display:none;">Imparte</th>
											<th style="display:none;">Área</th>
											<th style="display:none;">Motivo</th>
											<th style="display:none;">Descripción</th>
											<th style="display:none;">Ciclo</th>
											<th >Estado</th>
											<th style="display:none;">Captura</th>
											<th >Evidencia</th>
											<th>Resuelto</th>
											<th>Modificar</th>
											<th>Borrar</th>
										</tr>
									</tfoot>

								</table>


							</div><!--/table-responsive-->
						</div><!--/porlets-content-->
					</div><!--/block-web-->
				</div><!--/col-md-12-->
			</div><!--/row-->
		</div>
		<script type="text/javascript">
		window.onload=function() {
		
			document.getElementById('searchText').focus();

			var x =document.getElementById('ciclo_escolar').value;
			document.getElementById('excel').href="/descargar-capacitaciones/"+x;

		}

		function cambia_ruta_capa(){
			var x =document.getElementById('ciclo_escolar').value;
		 document.getElementById('excel').href="/descargar-capacitaciones/"+x;
		}
		</script>
		@endsection
