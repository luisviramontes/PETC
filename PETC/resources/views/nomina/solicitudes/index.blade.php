@extends('layouts.principal')
@section('contenido')
<div class="pull-left breadcrumb_admin clear_both">
	<div class="pull-left page_title theme_color">
		<h1>Solicitudes de Ingreso </h1>
		<h2 class="">Solicitudes de Ingreso</h2>
	</div>
	<div class="pull-right">
		<ol class="breadcrumb">
			<li ><a style="color: #808080" href="{{url('/')}}">Inicio</a></li>
			<li class="active">Tabla de Solicitudes de Ingreso</a></li>
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
							<h2 class="content-header" style="margin-top: -5px;">&nbsp;&nbsp;<strong>Tabla de Solicitudes</strong></h2>
								@include('nomina.solicitudes.search')
			</div>
						<div class="col-md-5">
							<div class="btn-group pull-right">
								<b>

									<div class="btn-group" style="margin-right: 10px;">
											<a class="btn btn-sm btn-success tooltips" href="{{ route('solicitudes.create')}}" style="margin-right: 10px;" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Registrar Nueva Solicitud"> <i class="fa fa-plus"></i> Registrar </a>
											<a class="btn btn-sm btn-danger tooltips" href="{{URL::action('CapturaController@index')}}" style="margin-right: 10px;" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Cancelar"> <i class="fa fa-times"></i> Salir</a>

											<a class="btn btn-primary btn-sm" id="pdf_solicitudes" href="{{URL::action('SolicitudesController@invoice','2')}}" style="margin-right: 10px;" data-toggle="tooltip"  target="_blank" data-placement="bottom" title="" data-original-title="Descargar"> <i class="fa fa-print"></i> Generar PDF</a>

											<a class="btn btn-primary btn-sm"  href="{{URL::action('SolicitudesController@ver_solicitudes')}}" style="margin-right: 10px;" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Ver registro de capturas"> <i class="fa fa-eye"></i> Ver Solicitudes</a>

									</div>

								</a>
							</b>
						</div>
					</div>
				</div>
			</div>

			<div class="porlets-content">
				<div class="table-responsive">
					<table cellpadding="0" cellpadding="0" border="0"  class="display table table-bordered " id="hidden-table-info_solicitudes">
						<thead>
							<tr>

								<th style="display:none;">Entrego Acta</th>
								<th style="display:none;">Solicitud de Incorporacion</th>
								<th>CCT</th>
								<th>Ciclo Escolar</th>
								<th>Nombre de la Escuela</th>
								<th>Municipio</th>
								<th>Localidad</th>
								<th>Domicilio</th>
								<th>Nivel</th>
								<th style="display:none;">PNPSVD</th>
								<th style="display:none;">CNH</th>
								<th style="display:none;">Carta Compromiso</th>
								<th style="display:none;">Acta Constitutiva</th>
								<th style="display:none;">Acta CPS</th>
								<th style="display:none;">Acta CTCS</th>
								<th>Tramite Estado</th>
								<th style="display:none;">Fecha de Registro</th>
								<th style="display:none;">Capturo</th>
								<th>Estado</th>



								<td><center><b>Editar</b></center></td>
								<td><center><b>Borrar</b></center></td>
							</tr>
						</thead>
						<tbody>
						@foreach($solicitudes  as $solicitud)
							@if ($solicitud->estado == "ACTIVO")
							<tr class="gradeX">

								<td style="display:none;">{{$solicitud->entrego_acta}} </td>
								<td style="display:none;">{{$solicitud->solicitud_inco}} </td>
								<td style="background-color:#DBFFC2;">{{$solicitud->cct}} </td>
								<td style="background-color:#DBFFC2;">{{$solicitud->ciclo}} </td>
								<td style="background-color:#DBFFC2;">{{$solicitud->nombre_escuela}}</td>
								<td style="background-color:#DBFFC2;">{{$solicitud->municipio}}</td>
								<td style="background-color:#DBFFC2;">{{$solicitud->nom_loc}}</td>
								<td style="background-color:#DBFFC2;">{{$solicitud->domicilio}}</td>
								<td style="background-color:#DBFFC2;">{{$solicitud->nivel}}</td>
								<td style="display:none;">{{$solicitud->pnpsvd}}</td>
								<td style="display:none;">{{$solicitud->cnh}}</td>
								<td style="display:none;">{{$solicitud->carta_compromiso}}</td>
								<td style="display:none;">{{$solicitud->acta_constitutiva_cte}}</td>
								<td style="display:none;">{{$solicitud->acta_cps}}</td>
								<td style="display:none;">{{$solicitud->acta_ctcs}}</td>
								<td style="background-color:#DBFFC2;">{{$solicitud->tramite_estado}}</td>
								<td style="display:none">{{$solicitud->fecha_recepcion}}</td>
								<td style="display:none;">{{$solicitud->captura}}</td>
								<td style="background-color:#DBFFC2;">{{$solicitud->estado}}</td>

								<td style="background-color:#DBFFC2;">
									<center>
										<a href="{{URL::action('SolicitudesController@edit',$solicitud->id)}}" title="Editar" class="btn btn-primary btn-sm" role="button"><i class="fa fa-edit"></i></a>

									</center>
								</td>
								<td style="background-color:#DBFFC2;">
									<center>
										<a class="btn btn-danger btn-sm" data-target="#modal-delete-{{$solicitud->id}}" data-toggle="modal" style="margin-right: 10px;"  role="button"><i class="fa fa-eraser"></i></a></center>

									</center>
									</td>
								</td>
							</tr>
								@else

								<tr class="gradeX">

									<td style="display:none;">{{$solicitud->entrego_acta}} </td>
									<td style="display:none;">{{$solicitud->solicitud_inco}} </td>
									<td style="background-color:#FFE4E1;">{{$solicitud->cct}} </td>
									<td style="background-color:#FFE4E1;">{{$solicitud->ciclo}} </td>
									<td style="background-color:#FFE4E1;">{{$solicitud->nombre_escuela}}</td>
									<td style="background-color:#FFE4E1;">{{$solicitud->municipio}}</td>
									<td style="background-color:#FFE4E1;">{{$solicitud->nom_loc}}</td>
									<td style="background-color:#FFE4E1;">{{$solicitud->domicilio}}</td>
									<td style="background-color:#FFE4E1;">{{$solicitud->nivel}}</td>
									<td style="display:none;">{{$solicitud->pnpsvd}}</td>
									<td style="display:none;">{{$solicitud->cnh}}</td>
									<td style="display:none;">{{$solicitud->carta_compromiso}}</td>
									<td style="display:none;">{{$solicitud->acta_constitutiva_cte}}</td>
									<td style="display:none;">{{$solicitud->acta_cps}}</td>
									<td style="display:none;">{{$solicitud->acta_ctcs}}</td>
									<td style="background-color:#FFE4E1;">{{$solicitud->tramite_estado}}</td>
									<td style="display:none">{{$solicitud->fecha_recepcion}}</td>
									<td style="display:none;">{{$solicitud->captura}}</td>
									<td style="background-color:#FFE4E1;">{{$solicitud->estado}}</td>

									<td style="background-color:#FFE4E1;">
										<center>
											<a href="{{URL::action('SolicitudesController@edit',$solicitud->id)}}" title="Editar" class="btn btn-primary btn-sm" role="button"><i class="fa fa-edit"></i></a>

										</center>
									</td>
									<td style="background-color:#FFE4E1;">
										<center>
											<a class="btn btn-danger btn-sm" data-target="#modal-delete-{{$solicitud->id}}" data-toggle="modal" style="margin-right: 10px;"  role="button"><i class="fa fa-eraser"></i></a></center>

										</center>
										</td>
									</td>
								</tr>
								@endif
							@include('nomina.solicitudes.modal')
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
					{!! $solicitudes->render() !!}
				</div><!--/table-responsive-->
			</div><!--/porlets-content-->
		</div><!--/block-web-->
	</div><!--/col-md-12-->
</div><!--/row-->
</div>
@endsection
