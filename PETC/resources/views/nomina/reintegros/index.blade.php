@extends('layouts.principal')
@section('contenido')
<div class="pull-left breadcrumb_admin clear_both">
	<div class="pull-left page_title theme_color">
		<h1>Reintegros </h1>
		<h2 class="">Reintegros</h2>
	</div>
	<div class="pull-right">
		<ol class="breadcrumb">
			<li ><a style="color: #808080" href="{{url('/')}}">Inicio</a></li>
			<li class="active">Reintegros</a></li>
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
							<h2 class="content-header" style="margin-top: -5px;">&nbsp;&nbsp;<strong>Tabla de Reintegros</strong></h2>
									@include('nomina.reintegros.search')
								</div>
						<div class="col-md-5">
							<div class="btn-group pull-right">
								<b>

									<div class="btn-group" style="margin-right: 10px;">
											<a class="btn btn-sm btn-success tooltips" href="{{ route('reintegros.create')}}" style="margin-right: 10px;" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Registrar Nueva Region"> <i class="fa fa-plus"></i> Registrar </a>
										<!--	<a class="btn btn-sm btn-warning tooltips" href="{{ route('nomina.region.excel')}}" style="margin-right: 10px;" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Descargar"> <i class="fa fa-download"></i> Descargar </a>
										-->	<a class="btn btn-primary btn-sm" href="{{URL::action('ReintegrosController@invoice2','2019-2020')}}" id="invoice" style="margin-right: 10px;" data-toggle="tooltip" target="_blank" data-placement="bottom" title="" data-original-title="Descargar"> <i class="fa fa-print"></i> Generar PDF</a>
													<a class="btn btn-primary btn-sm"  href="{{URL::action('ReintegrosController@ver_reintegros')}}" style="margin-right: 10px;" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Ver registro de Reintegros"> <i class="fa fa-eye"></i> Ver Reintegros</a>
									</div>

								</a>
							</b>
						</div>
					</div>
				</div>
			</div>

			<div class="porlets-content">
				<div class="table-responsive">
					<table cellpadding="0" cellpadding="0" border="0"  class="display table table-bordered" id="hidden-table-info_rein">
						<thead>
							<tr>

								<th>CCT</th>
								<th>Nombre</th>
								<th>Categoría</th>
								<th>Número de días</th>
								<th>Director Regional</th>
								<th>Ciclo Escolar</th>
								<th>No. Oficio</th>
								<th>Motivo</th>
								<th>Total</th>
								<th style="display:none">Capturo</th>
								<th style="display:none">Estado</th>
                <th>Fecha de Registro</th>



								<td><center><b>Editar</b></center></td>
								<td><center><b>Borrar</b></center></td>
							</tr>
						</thead>
						<tbody>
						@foreach($reintegros  as $reintegro)
							@if ($reintegro->estado == "ACTIVO")
							<tr class="gradeX">


								<td style="background-color:#DBFFC2;">{{$reintegro->cct}} </td>
								<td style="background-color:#DBFFC2;">{{$reintegro->nombre}} </td>
								<td style="background-color:#DBFFC2;">{{$reintegro->categoria}} </td>
								<td style="background-color:#DBFFC2;">{{$reintegro->num_dias}} </td>
								<td style="background-color:#DBFFC2;">{{$reintegro->director_regional}} </td>
								<td style="background-color:#DBFFC2;">{{$reintegro->ciclo}} </td>
								<td style="background-color:#DBFFC2;">{{$reintegro->oficio}} </td>
								<td style="background-color:#DBFFC2;">{{$reintegro->motivo}} </td>
								<td style="background-color:#DBFFC2;">${{number_format($reintegro->total, 2)}} </td>
								<td style="display:none">{{$reintegro->captura}} </td>
								<td style="display: none">{{$reintegro->estado}} </td>
								<td style="background-color:#DBFFC2;">{{$reintegro->created_at}} </td>



							<td style="background-color:#DBFFC2;">
								<center>
									<a href="{{URL::action('ReintegrosController@edit',$reintegro->id)}}" id="edit" onchange="" title="Editar" class="btn btn-primary btn-sm" role="button"><i class="fa fa-edit"></i></a>

								</center>
							</td>

								<!-- //////////////////////////////////////////////////////////////////// -->



								<td style="background-color:#DBFFC2;">
									<center>
										<a class="btn btn-danger btn-sm" data-target="#modal-delete-{{$reintegro->id}}" data-toggle="modal" style="margin-right: 10px;"  role="button"><i class="fa fa-eraser"></i></a></center>

									</center>
									</td>
								</td>
							</tr>
							@else
							<tr class="gradeX">


								<td style="background-color:#FFE4E1;">{{$reintegro->cct}} </td>
								<td style="background-color:#FFE4E1;">{{$reintegro->nombre}} </td>
								<td style="background-color:#FFE4E1;">{{$reintegro->categoria}} </td>
								<td style="background-color:#FFE4E1;">{{$reintegro->num_dias}} </td>
								<td style="background-color:#FFE4E1;">{{$reintegro->director_regional}} </td>
								<td style="background-color:#FFE4E1;">{{$reintegro->oficio}} </td>
								<td style="background-color:#FFE4E1;">{{$reintegro->motivo}} </td>
								<td style="background-color:#FFE4E1;">${{number_format($reintegro->total, 2)}} </td>
								<td style="display:none">{{$reintegro->captura}} </td>
								<td style="display: none">{{$reintegro->estado}} </td>
								<td style="background-color:#FFE4E1;">{{$reintegro->created_at}} </td>



								<td style="background-color:#FFE4E1;">
									<center>
										<a href="{{URL::action('ReintegrosController@edit',$reintegro->id)}}" title="Editar" class="btn btn-primary btn-sm" role="button"><i class="fa fa-edit"></i></a>

									</center>
								</td>
								<td style="background-color:#FFE4E1;">
									<center>
										<a class="btn btn-danger btn-sm" data-target="#modal-delete-{{$reintegro->id}}" data-toggle="modal" style="margin-right: 10px;"  role="button"><i class="fa fa-eraser"></i></a></center>

									</center>
									</td>
								</td>
							</tr>
							@endif
								@include('nomina.reintegros.modal')

							@endforeach
						</tbody>
						<tfoot>
							<tr>
                <th></th>
								<th>CCT</th>
								<th>Nombre</th>
								<th>Categoría</th>
								<th>Número de días</th>
								<th>Director Regional</th>
								<th>Ciclo Escolar</th>
								<th>No. Oficio</th>
								<th>Motivo</th>
								<th>Total</th>
								<th style="display:none">Capturo</th>
								<th style="display:none">Estado</th>
                <th>Fecha de Registro</th>


								<td><center><b>Editar</b></center></td>
								<td><center><b>Borrar</b></center></td>
							</tr>
						</tfoot>
					</table>
					{!! $reintegros->render() !!}
				</div><!--/table-responsive-->
			</div><!--/porlets-content-->
		</div><!--/block-web-->
	</div><!--/col-md-12-->
</div><!--/row-->
</div>
@endsection
