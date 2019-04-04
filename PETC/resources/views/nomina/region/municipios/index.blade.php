@extends('layouts.principal')
@section('contenido')
<div class="pull-left breadcrumb_admin clear_both">
	<div class="pull-left page_title theme_color">
		<h1>Municipios </h1>
		<h2 class="">Municipios </h2>
	</div>
	<div class="pull-right">
		<ol class="breadcrumb">
			<li ><a style="color: #808080" href="{{url('/municipios')}}">Inicio</a></li>
			<li class="active">Tabla de Municipios </a></li>
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
							<h2 class="content-header" style="margin-top: -5px;">&nbsp;&nbsp;<strong>Municipios </strong></h2>
							@include('nomina.region.municipios.search')
						</div>
						<div class="col-md-5">
							<div class="btn-group pull-right">
								<b>

									<div class="btn-group" style="margin-right: 10px;">
										<a class="btn btn-sm btn-success tooltips" href="{{ route('municipios.create')}}" style="margin-right: 10px;" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Registrar Nuevo Municipio	"> <i class="fa fa-plus"></i> Registrar </a>


										<a class="btn btn-sm btn-warning tooltips" href="{{ route('nomina.region.municipios.excel')}}" style="margin-right: 10px;" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Descargar Municipios"> <i class="fa fa-download"></i> Descargar Excel </a> 

										<a class="btn btn-primary btn-sm" href="{{URL::action('MunicipiosController@invoice')}}" style="margin-right: 10px;" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Descargar"> <i class="fa fa-print"></i> Generar PDF</a> 

									</div>

								</a>
							</b>
						</div>
					</div>
				</div>
			</div>

			<div class="porlets-content">
				<div class="table-responsive">
					<table  class="display table table-bordered table-striped" id="dynamic-table">
						<thead>
							<tr>
								<th>Región </th>
								<th>Municipio</th>
								<th>Cabecera </th>
								<th>Población </th>
								<th>Área KM </th>
								<th>Ver Localidades&nbsp; &nbsp;</th>
								<th>Capturo </th>
								<th>Modificado </th>
								<td><center><b>Editar</b></center></td>
								<td><center><b>Borrar</b></center></td>
							</tr>
						</thead>
						<tbody>
							@foreach($dato  as $datos)
							<tr class="gradeA">
								<td>{{$datos->region}} </td>
								<td>{{$datos->municipio}} </td>
								<td>{{$datos->cabecera}} </td>
								<td>{{$datos->poblacion}} </td>
								<td>{{$datos->area_km}}</td>
								<td >
									<a href="{{URL::action('LocalidadesController@verInformacion',$datos->id)}}" class="btn btn-primary btn-sm" role="button"><i class="fa fa-eye"></i></a>    </td>
									<th>{{$datos->capturo}} </th>
									<td>{{$datos->updated_at}} </td>
									<td> 
										<center>
											<a href="{{URL::action('MunicipiosController@edit',$datos->id)}}" class="btn btn-primary btn-sm" role="button"><i class="fa fa-edit"></i></a>  
										</center>
									</td>
									<td>
										<center>
											<a class="btn btn-danger btn-sm" data-target="#modal-delete-{{$datos->id}}" data-toggle="modal" style="margin-right: 10px;"  role="button"><i class="fa fa-eraser"></i></a></center>
										</td>
									</td>
								</tr>
								@include('nomina.region.municipios.modal')
								@endforeach
							</tbody>
							<tfoot>
								<tr>
									<th>Región </th>
									<th>Municipio</th>
									<th>Cabecera </th>
									<th>Población </th>
									<th>Área KM </th>
									<th>Ver Localidades&nbsp; &nbsp;</th>
									<th>Capturo </th>
									<th>Modificado</th>
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
