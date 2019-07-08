@extends('layouts.principal')
@section('contenido')
<div class="pull-left breadcrumb_admin clear_both">
	<div class="pull-left page_title theme_color">
		<h1>Region </h1>
		<h2 class="">Region</h2>
	</div>
	<div class="pull-right">
		<ol class="breadcrumb">
			<li ><a style="color: #808080" href="{{url('/')}}">Inicio</a></li>
			<li class="active">Tabla de Regiones</a></li>
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
							<h2 class="content-header" style="margin-top: -5px;">&nbsp;&nbsp;<strong>Tabla de Regiones</strong></h2>
									@include('nomina.region.search')
			</div>
						<div class="col-md-5">
							<div class="btn-group pull-right">
								<b>

									<div class="btn-group" style="margin-right: 10px;">
											<a class="btn btn-sm btn-success tooltips" href="{{ route('region.create')}}" style="margin-right: 10px;" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Registrar Nueva Region"> <i class="fa fa-plus"></i> Registrar </a>
											<a class="btn btn-sm btn-warning tooltips" href="{{ route('nomina.region.excel')}}" style="margin-right: 10px;" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Descargar"> <i class="fa fa-download"></i> Descargar </a>
											<a class="btn btn-primary btn-sm" href="{{URL::action('RegionController@invoice','2018-2019')}}" style="margin-right: 10px;" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Descargar"> <i class="fa fa-print"></i> Generar PDF</a>

									</div>

								</a>
							</b>
						</div>
					</div>
				</div>
			</div>

			<div class="porlets-content">
				<div class="table-responsive">
					<table cellpadding="0" cellpadding="0" border="0"  class="display table table-bordered" id="dynamic-table">
						<thead>
							<tr>

								<th>Region </th>
								<th>Sostenimiento</th>
								<th>Capturo</th>
								<th>Estado</th>



								<td><center><b>Editar</b></center></td>
								<td><center><b>Borrar</b></center></td>
							</tr>
						</thead>
						<tbody>
						@foreach($regiones  as $region)
							@if ($region->estado == "ACTIVO")
							<tr class="gradeX">

								<td style="background-color:#DBFFC2;">{{$region->region}} </td>
								<td style="background-color:#DBFFC2;">{{$region->sostenimiento}} </td>
								<td style="background-color:#DBFFC2;">{{$region->capturo}} </td>
								<td style="background-color:#DBFFC2;">{{$region->estado}}</td>





							<td style="background-color:#DBFFC2;">
								<center>
									<a href="{{URL::action('RegionController@edit',$region->id)}}" id="edit" onchange="" title="Editar" class="btn btn-primary btn-sm" role="button"><i class="fa fa-edit"></i></a>

								</center>
							</td>

								<!-- //////////////////////////////////////////////////////////////////// -->



								<td style="background-color:#DBFFC2;">
									<center>
										<a class="btn btn-danger btn-sm" data-target="#modal-delete-{{$region->id}}" data-toggle="modal" style="margin-right: 10px;"  role="button"><i class="fa fa-eraser"></i></a></center>

									</center>
									</td>
								</td>
							</tr>
							@else
							<tr class="gradeX">

								<td style="background-color:#FFE4E1;">{{$region->region}} </td>
								<td style="background-color:#FFE4E1;">{{$region->sostenimiento}} </td>
								<td style="background-color:#FFE4E1;">{{$region->capturo}} </td>
								<td style="background-color:#FFE4E1;">{{$region->estado}}</td>



								<td style="background-color:#FFE4E1;">
									<center>
										<a href="{{URL::action('RegionController@edit',$region->id)}}" title="Editar" class="btn btn-primary btn-sm" role="button"><i class="fa fa-edit"></i></a>

									</center>
								</td>
								<td style="background-color:#FFE4E1;">
									<center>
										<a class="btn btn-danger btn-sm" data-target="#modal-delete-{{$region->id}}" data-toggle="modal" style="margin-right: 10px;"  role="button"><i class="fa fa-eraser"></i></a></center>

									</center>
									</td>
								</td>
							</tr>
							@endif
							@include('nomina.region.modal')

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
					{!! $regiones->render() !!}
				</div><!--/table-responsive-->
			</div><!--/porlets-content-->
		</div><!--/block-web-->
	</div><!--/col-md-12-->
</div><!--/row-->
</div>
@endsection