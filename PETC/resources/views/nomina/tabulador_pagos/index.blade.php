@extends('layouts.principal')
@section('contenido')
<div class="pull-left breadcrumb_admin clear_both">
	<div class="pull-left page_title theme_color">
		<h1>Tabla de Pagos Por Empleado </h1>
		<h2 class="">Tabla de Pagos por Empleado</h2>
	</div>
	<div class="pull-right">
		<ol class="breadcrumb">
			<li ><a style="color: #808080" href="{{url('/tabulador_pagos')}}">Inicio</a></li>
			<li class="active">Tabla de Pagos Por Empleado</a></li>
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
							<h2 class="content-header" style="margin-top: -5px;">&nbsp;&nbsp;<strong>Tabla de Pagos Por Empleado:</strong></h2>
							@include('nomina.tabulador_pagos.search')
						</div>
						<div class="col-md-5">
							<div class="btn-group pull-right">
								<b>

									<div class="btn-group" style="margin-right: 10px;">
										<a class="btn btn-sm btn-success tooltips" href="{{ route('tabulador_pagos.create')}}" style="margin-right: 10px;" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Registrar Nuevo Pago "> <i class="fa fa-plus"></i> Registrar </a>


										<a class="btn btn-sm btn-warning tooltips" href="{{ route('nomina.tabulador_pagos.excel')}}" style="margin-right: 10px;" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Descargar"> <i class="fa fa-download"></i> Descargar </a> 

										<a class="btn btn-primary btn-sm" href="{{URL::action('TabuladorPagosController@invoice',$tabla_2->ciclo)}}" target="_blank" style="margin-right: 10px;" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Descargar"> <i class="fa fa-print"></i> Generar PDF</a> 

										<a  class="btn btn-sm btn btn-info" href="{{route('nomina.tabulador_pagos.calculadora_pagos')}}" style="margin-right: 10px;" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Calculadora de Pagos"> <i class="fa fa-plus"></i> Calculadora de Pagos </a> 


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
								<th>Pago Por Director </th>
								<th>Pago Por Docente</th>
								<th>Pago Por Intendente </th>
								<th>Ciclo </th>
								<th>Capturo </th>
								<th>Modificado </th>
								<td><center><b>Editar</b></center></td>
								<td><center><b>Borrar</b></center></td>
							</tr>
						</thead>
						<tbody>
							@foreach($tabla_pagos  as $tabla_pago)
							<tr class="gradeA">
								<td>${{$tabla_pago->pago_director}}.00 </td>
								<td>${{$tabla_pago->pago_docente}}.00 </td>
								<td>${{$tabla_pago->pago_intendente}}.00 </td>
								<th>{{$tabla_pago->ciclo}} </th>
								<td>{{$tabla_pago->capturo}} </td>
								<td>{{$tabla_pago->updated_at}} </td>
								<td> 
									<center>
										<a href="{{URL::action('TabuladorPagosController@edit',$tabla_pago->id)}}" class="btn btn-primary btn-sm" role="button"><i class="fa fa-edit"></i></a>  
									</center>
								</td>
								<td>
									<center>
										<a class="btn btn-danger btn-sm" data-target="#modal-delete-{{$tabla_pago->id}}" data-toggle="modal" style="margin-right: 10px;"  role="button"><i class="fa fa-eraser"></i></a></center>
									</td>
								</td>
							</tr>
                            @include('nomina.tabulador_pagos.modal')
							@endforeach
						</tbody>
						<tfoot>
							<tr>
								<th>Pago Por Director </th>
								<th>Pago Por Docente</th>
								<th>Pago Por Intendente </th>
								<th>Ciclo </th>
								<th>Capturo </th>
								<th>Modificado </th>
								<td><center><b>Editar</b></center></td>
								<td><center><b>Borrar</b></center></td>
							</tr>
						</tfoot>
					</table>
					{!! $tabla_pagos->render() !!}
				</div><!--/table-responsive-->
			</div><!--/porlets-content-->
		</div><!--/block-web-->
	</div><!--/col-md-12-->
</div><!--/row-->
</div>
@stop
