@extends('layouts.principal')
@section('contenido')
<div class="pull-left breadcrumb_admin clear_both">
	<div class="pull-left page_title theme_color">
		<h1>Fortalecimientos </h1>
		<h2 class="">Fortalecimientos</h2>
	</div>
	<div class="pull-right">
		<ol class="breadcrumb">
			<li ><a style="color: #808080" href="{{url('/')}}">Inicio</a></li>
			<li class="active">Tabla de Fortalecimientos</a></li>
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
							<h2 class="content-header" style="margin-top: -5px;">&nbsp;&nbsp;<strong>Tabla de Fortalecimientos</strong></h2>
							@include('nomina.fortalecimiento.search')

						</div>
						<div class="col-md-5">
							<div class="btn-group pull-right">
								<b>

									<div class="btn-group" style="margin-right: 10px;">
										<a class="btn btn-sm btn-success tooltips" href="{{ route('fortalecimiento.create')}}" style="margin-right: 10px;" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Registrar Nuevo Fortalecimiento"> <i class="fa fa-plus"></i> Registrar </a>
										<a class="btn btn-sm btn-warning tooltips" href="{{ route('nomina.fortalecimiento.excel')}}" style="margin-right: 10px;" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Descargar"> <i class="fa fa-download"></i> Descargar </a>
								 		<a class="btn btn-primary btn-sm" href="{{URL::action('FortalecimientoController@invoice','2018-2019')}}" style="margin-right: 10px;" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Descargar"> <i class="fa fa-print"></i> Generar PDF</a>

									</div>

								</a>
							</b>
						</div>
					</div>
				</div>
			</div>

			<div class="porlets-content">
				<div class="table-responsive">
					<table cellpadding="0" cellpadding="0" border="0"  class="display table table-bordered" id="hidden-table-info_forta">
						<thead>
							<tr>

								<th>CCT </th>
								<th>Monto Fortalecimiento</th>
								<th>Ciclo Escolar</th>
								<th>Estado</th>
                <th>observaciones</th>
                <th>captura</th>




								<td><center><b>Editar</b></center></td>
								<td><center><b>Borrar</b></center></td>
							</tr>
						</thead>
						<tbody>
						@foreach($fortalecimientos  as $fortalecimiento)
								@if ($fortalecimiento->estado == "ACTIVO")
							<tr class="gradeX">

								<td style="background-color:#DBFFC2;">{{$fortalecimiento->cct}} </td>
								<td style="background-color:#DBFFC2;">{{$fortalecimiento->monto_forta}} </td>
								<td style="background-color:#DBFFC2;">{{$fortalecimiento->ciclo}} </td>
								<td style="background-color:#DBFFC2;">{{$fortalecimiento->estado}} </td>
                <td style="background-color:#DBFFC2;">{{$fortalecimiento->observaciones}}</td>
                <td style="background-color:#DBFFC2;">{{$fortalecimiento->captura}}</td>

								<!-- //////////////////////////////////////////////////////////////////// -->



							<td style="background-color:#DBFFC2;">
								<center>
									<a href="{{URL::action('FortalecimientoController@edit',$fortalecimiento->id)}}" id="edit" onchange="" title="Editar" class="btn btn-primary btn-sm" role="button"><i class="fa fa-edit"></i></a>

								</center>
							</td>

								<!-- //////////////////////////////////////////////////////////////////// -->

								<td style="background-color:#DBFFC2;" >
									<center>
										<a class="btn btn-danger btn-sm" data-target="#modal-delete-{{$fortalecimiento->id}}" data-toggle="modal" style="margin-right: 10px;"  role="button"><i class="fa fa-eraser"></i></a></center>

									</center>
									</td>
								</td>
							</tr>
								@else

								<td style="background-color:#FFE4E1;">{{$fortalecimiento->cct}} </td>
								<td style="background-color:#FFE4E1;">{{$fortalecimiento->monto_forta}} </td>
								<td style="background-color:#FFE4E1;">{{$fortalecimiento->ciclo}} </td>
								<td style="background-color:#FFE4E1;">{{$fortalecimiento->estado}} </td>
								<td style="background-color:#FFE4E1;">{{$fortalecimiento->observaciones}}</td>
								<td style="background-color:#FFE4E1;">{{$fortalecimiento->captura}}</td>

								<td style="background-color:#FFE4E1;">
									<center>
										<a href="{{URL::action('FortalecimientoController@edit',$fortalecimiento->id)}}" id="edit" onchange="" title="Editar" class="btn btn-primary btn-sm" role="button"><i class="fa fa-edit"></i></a>

									</center>
								</td>

								<td style="background-color:#FFE4E1;" >
									<center>
										<a class="btn btn-danger btn-sm" data-target="#modal-delete-{{$fortalecimiento->id}}" data-toggle="modal" style="margin-right: 10px;"  role="button"><i class="fa fa-eraser"></i></a></center>

									</center>
									</td>
								@endif
						@include('nomina.fortalecimiento.modal')
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
@endsection
