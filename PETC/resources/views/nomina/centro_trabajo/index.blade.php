@extends('layouts.principal')
@section('contenido')
<div class="pull-left breadcrumb_admin clear_both">
	<div class="pull-left page_title theme_color">
		<h1>Centros de Trabajo PETC </h1>
		<h2 class="">Centros de Trabajo PETC</h2>
	</div>
	<div class="pull-right">
		<ol class="breadcrumb">
			<li ><a style="color: #808080" href="{{url('/centro_trabajo')}}">Inicio</a></li>
			<li class="active">Centros de Trabajo PETC</a></li>
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
							<h2 class="content-header" style="margin-top: -5px;">&nbsp;&nbsp;<strong>Centros de Trabajo PETC </strong></h2>
							@include('nomina.centro_trabajo.search')
						</div>
						<div class="col-md-5">
							<div class="btn-group pull-right">
								<b>

									<div class="btn-group" style="margin-right: 10px;">
										<a class="btn btn-sm btn-success tooltips" href="{{ route('centro_trabajo.create')}}" style="margin-right: 10px;" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Registrar Nuevo CT"> <i class="fa fa-plus"></i> Registrar </a>


										<a class="btn btn-sm btn-warning tooltips" href="{{ route('nomina.centro_trabajo.excel')}}" style="margin-right: 10px;" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Descargar"> <i class="fa fa-download"></i> Descargar </a>

										<a class="btn btn-primary btn-sm" href="{{URL::action('CentroTrabajoController@invoice' )}}" id="invoice" style="margin-right: 10px;" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Descargar"> <i class="fa fa-print"></i> Generar PDF</a> 										


									</div>
								</b>
							</div>
						</div>
					</div>
				</div>

				<div class="porlets-content">
					<div class="table-responsive">
						<table cellpadding="0" cellspacing="0" border="0" class="display table table-bordered " id="hidden-table-info2">
							<thead>
								<tr>
									<th>CCT </th>
									<th>Nombre de la Escuela</th>
									<<th style="display:none;" >Municipio </th>
									<th style="display:none;" >Localidad </th>
									<th style="display:none;" >Domicilio </th>
									<th>Región </th>
									<th>Sostenimiento </th>
									<th>Teléfono </th>
									<th>Email </th>
									<th>Capturo </th>
									<th>Ciclo Escolar </th>
									<th style="display:none;" >Entrego Carta Compromiso </th>
									<th>Alimentacion </th>
									<th>Modificado </th>
									<th style="display:none;" >Total de Alumnos </th>
									<th style="display:none;" >Total Niñas </th>
									<th style="display:none;" >Total Niños </th>
									<th style="display:none;" >Total Grupos </th>
									<th style="display:none;" >Total Grados </th>
									<th style="display:none;" >Total Directores </th>
									<th style="display:none;" >Total Docentes </th>
									<th style="display:none;" >Total E.Fisica </th>
									<th style="display:none;" >Total USAER </th>
									<th style="display:none;" >Total Artistica </th>
									<th style="display:none;" >Total Intendentes </th>
									<th style="display:none;" >Fecha Ingreso PETC </th>
									<th style="display:none;" >Fecha Baja PETC</th>
									<th>Ver Datos Completos&nbsp; &nbsp;</th>
									<td><center><b>Editar</b></center></td>
									<td><center><b>Borrar</b></center></td>
								</tr>
							</thead>
							<tbody>
								@foreach($centro  as $datos)
								<tr class="gradeX">
									<td>{{$datos->cct}} </td>
									<td>{{$datos->nombre_escuela}} </td>
									<td style="display:none;" >{{$datos->municipio}} </td>
									<td style="display:none;" >{{$datos->nom_loc}} </td>
									<td style="display:none;" >{{$datos->domicilio}} </td>
									<td>{{$datos->region}} </td>
									<td>{{$datos->sostenimiento}}</td>
									<td>{{$datos->telefono}} </td>
									<td>{{$datos->email}} </td>
									<td>{{$datos->captura}} </td>
									<td>{{$datos->ciclo_escolar}} </td>
									<td style="display:none;" >{{$datos->entrego_carta}} </td>
									<td>{{$datos->alimentacion}} </td>
									<td>{{$datos->updated_at}} </td>
									<td style="display:none;" >{{$datos->total_alumnos}} </td>
									<td style="display:none;" >{{$datos->total_ninas}} </td>
									<td style="display:none;" >{{$datos->total_ninos}} </td>
									<td style="display:none;" >{{$datos->total_grupos}} </td>
									<td style="display:none;" >{{$datos->total_grados}} </td>
									<td style="display:none;" >{{$datos->total_directores}} </td>
									<td style="display:none;" >{{$datos->total_docentes}} </td>
									<td style="display:none;" >{{$datos->total_fisica}} </td>
									<td style="display:none;" >{{$datos->total_usaer}} </td>
									<td style="display:none;" >{{$datos->total_artistica}} </td>
									<td style="display:none;" >{{$datos->total_intendentes}} </td>
									<td style="display:none;" >{{$datos->fecha_ingreso}} </td>
									<td style="display:none;" >{{$datos->fecha_baja}} </td>
									<td >
										<a href="{{URL::action('CentroTrabajoController@verInformacion',$datos->id.'/1')}}" class="btn btn-primary btn-sm" role="button"><i class="fa fa-eye"></i></a>    </td>

										<td>
											<a href="{{URL::action('CentroTrabajoController@edit',$datos->id)}}" class="btn btn-primary btn-sm" role="button"><i class="fa fa-edit"></i></a>
										</td>
										<td>
											<a class="btn btn-danger btn-sm" data-target="#modal-delete-{{$datos->id}}" data-toggle="modal" style="margin-right: 10px;"  role="button"><i class="fa fa-eraser"></i></a></
										</td>
									</tr>
									@include('nomina.centro_trabajo.modal')
									@endforeach
								</tbody>
								<tfoot>
									<tr>
										<th></th>
										<th>CCT </th>
										<th>Nombre de la Escuela</th>
										<th style="display:none;" >Municipio </th>
										<th style="display:none;" >Localidad </th>
										<th style="display:none;" >Domicilio </th>
										<th>Región </th>
										<th>Sostenimiento </th>
										<th>Teléfono </th>
										<th>Email </th>
										<th>Capturo </th>
										<th>Ciclo Escolar </th>
										<th style="display:none;" >Entrego Carta Compromiso </th>
										<th>Alimentacion </th>
										<th >Modificado </th>
										<th style="display:none;" >Total de Alumnos </th>
										<th style="display:none;" >Total Niñas </th>
										<th style="display:none;" >Total Grupos </th>
										<th style="display:none;" >Total Grados </th>
										<th style="display:none;" >Total Directores </th>
										<th style="display:none;" >Total Docentes </th>
										<th style="display:none;" >Total E.Fisica </th>
										<th style="display:none;" >Total USAER </th>
										<th style="display:none;" >Total Artistica </th>
										<th style="display:none;" >Total Intendentes </th>
										<th style="display:none;" >Fecha Ingreso PETC </th>
										<th style="display:none;" >Fecha Baja PETC</th>
										<th>Ver Datos Completos&nbsp; &nbsp;</th>
										<td><center><b>Editar</b></center></td>
										<td><center><b>Borrar</b></center></td>
									</tr>
								</tfoot>
							</table>
							{!! $centro->render() !!}
						</div><!--/table-responsive-->
					</div><!--/porlets-content-->
				</div><!--/block-web-->
			</div><!--/col-md-12-->
		</div><!--/row-->
	</div>
	@endsection
