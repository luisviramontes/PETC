@extends('layouts.principal')
@section('contenido')
<div class="pull-left breadcrumb_admin clear_both">
	<div class="pull-left page_title theme_color">
		<h1>Localidades </h1>
		<h2 class="">Localidades </h2>
	</div>
	<div class="pull-right">
		<ol class="breadcrumb">
			<li ><a style="color: #808080" href="{{url('/localidades')}}">Inicio</a></li>
			<li class="active">Tabla de Localidades </a></li>
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
							<h2 class="content-header" style="margin-top: -5px;">&nbsp;&nbsp;<strong>Localidades </strong></h2>
							@include('nomina.region.municipios.localidades.search')
						</div>
						<div class="col-md-5">
							<div class="btn-group pull-right">
								<b>

									<div class="btn-group" style="margin-right: 10px;">
										<a class="btn btn-sm btn-success tooltips" href="{{ route('localidades.create')}}" style="margin-right: 10px;" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Registrar Nueva Localidad	"> <i class="fa fa-plus"></i> Registrar </a>


										<a class="btn btn-sm btn-warning tooltips" href="{{ route('nomina.region.municipios.localidades.excel')}}" style="margin-right: 10px;" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Descargar Localidades"> <i class="fa fa-download"></i> Descargar Excel </a>

										<a class="btn btn-primary btn-sm" href="{{URL::action('LocalidadesController@invoice')}}" style="margin-right: 10px;" target="_blank" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Descargar"> <i class="fa fa-print"></i> Generar PDF</a>

									</div>

								</a>
							</b>
						</div>
					</div>
				</div>
			</div>

			<div class="porlets-content">
				<div class="table-responsive">
					<table  class="display table table-bordered table-striped" id="hidden-table-info_loca">
						<thead>
							<tr>
								<th>Municipio </th>
								<th>Localidad</th>
								<th style="display:none;">Longitud </th>
								<th style="display:none;">Latitud </th>
								<th style="display:none;">Altitud </th>
								<th>Población Total </th>
								<th>Población Masculina </th>
								<th>Población Femenina </th>
								<th>Capturo </th>
								<th>Estado</th>
								<th>Modificado </th>
								<td><center><b>Editar</b></center></td>
								<td><center><b>Borrar</b></center></td>
							</tr>
						</thead>
						<tbody>
							@foreach($dato  as $datos)
								@if ($datos->estado == "ACTIVO")
							<tr class="gradeA">
								<td style="background-color: #DBFFC2;">{{$datos->municipio}} </td>
								<td style="background-color: #DBFFC2;">{{$datos->nom_loc}} </td>
								<td style="display:none;">{{$datos->longitud}} KM </td>
								<td style="display:none;">{{$datos->latitud}} </td>
								<td style="display:none;">{{$datos->altitud}}</td>
								<td style="background-color: #DBFFC2;">{{$datos->pobtot}} Hab.</td>
								<td style="background-color: #DBFFC2;">{{$datos->pobmas}} Hab.</td>
								<td style="background-color: #DBFFC2;">{{$datos->pobfem}} Hab.</td>
								<th style="background-color: #DBFFC2;">{{$datos->captura}} </th>
								<th style="background-color: #DBFFC2;">{{$datos->estado}} </th>
								<td style="background-color: #DBFFC2;">{{$datos->updated_at}} </td>
								<td style="background-color: #DBFFC2;">
									<center>
										<a href="{{URL::action('LocalidadesController@edit',$datos->id)}}" class="btn btn-primary btn-sm" role="button"><i class="fa fa-edit"></i></a>
									</center>
								</td>
								<td style="background-color: #DBFFC2;">
									<center>
										<a class="btn btn-danger btn-sm" data-target="#modal-delete-{{$datos->id}}" data-toggle="modal" style="margin-right: 10px;"  role="button"><i class="fa fa-eraser"></i></a></center>
									</td>
								</td>
							</tr>
							@else
							<tr class="gradeA">
								<td style="background-color: #FFE4E1;">{{$datos->municipio}} </td>
								<td style="background-color: #FFE4E1;">{{$datos->nom_loc}} </td>
								<td style="display:none;">{{$datos->longitud}} KM </td>
								<td style="display:none;">{{$datos->latitud}} </td>
								<td style="display:none;">{{$datos->altitud}}</td>
								<td style="background-color: #FFE4E1;">{{$datos->pobtot}} Hab.</td>
								<td style="background-color: #FFE4E1;">{{$datos->pobmas}} Hab.</td>
								<td style="background-color: #FFE4E1;">{{$datos->pobfem}} Hab.</td>
								<th style="background-color: #FFE4E1;">{{$datos->captura}} </th>
								<th style="background-color: #FFE4E1;">{{$datos->estado}} </th>
								<td style="background-color: #FFE4E1;">{{$datos->updated_at}} </td>
								<td style="background-color: #FFE4E1;">
									<center>
										<a href="{{URL::action('LocalidadesController@edit',$datos->id)}}" class="btn btn-primary btn-sm" role="button"><i class="fa fa-edit"></i></a>
									</center>
								</td>
								<td style="background-color: #FFE4E1;">
									<center>
										<a class="btn btn-danger btn-sm" data-target="#modal-delete-{{$datos->id}}" data-toggle="modal" style="margin-right: 10px;"  role="button"><i class="fa fa-eraser"></i></a></center>
									</td>
								</td>
							</tr>
							@endif
							@include('nomina.region.municipios.localidades.modal')
							@endforeach
						</tbody>
						<tfoot>
							<tr>
								<th>Municipio </th>
								<th>Localidad</th>
								<th style="display:none;">Longitud </th>
								<th style="display:none;">Latitud </th>
								<th style="display:none;">Altitud </th>
								<th>Población Total </th>
								<th>Población Masculina </th>
								<th>Población Femenina </th>
								<th>Capturo </th>
								<th>Estado</th>
								<th>Modificado </th>
								<td><center><b>Editar</b></center></td>
								<td><center><b>Borrar</b></center></td>
							</tr>
						</tfoot>
					</table>
					{!! $dato->render() !!}
				</div><!--/table-responsive-->
			</div><!--/porlets-content-->
		</div><!--/block-web-->
	</div><!--/col-md-12-->
</div><!--/row-->
</div>
@stop
