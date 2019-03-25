@extends('layouts.principal')
@section('contenido')
<div class="pull-left breadcrumb_admin clear_both">
	<div class="pull-left page_title theme_color">
		<h1>Tabla de Pagos </h1>
		<h2 class="">Tabla de Pagos</h2>
	</div>
	<div class="pull-right">
		<ol class="breadcrumb">
			<li ><a style="color: #808080" href="{{url('/unidades_medida')}}">Inicio</a></li>
			<li class="active">Tabla de Pagos Por Quincena</a></li>
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
							<h2 class="content-header" style="margin-top: -5px;">&nbsp;&nbsp;<strong>Tabla de Pagos</strong></h2>
						</div>
						<div class="col-md-5">
							<div class="btn-group pull-right">
								<b>

									<div class="btn-group" style="margin-right: 10px;">
										<a class="btn btn-sm btn-success tooltips" href="{{ route('tabla_pagos.create')}}" style="margin-right: 10px;" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Registrar nuevo Invernadero"> <i class="fa fa-plus"></i> Registrar </a>


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
								<th>Quincena </th>
								<th>Dias Trabajados</th>
								<th>Pago por Director </th>
								<th>Pago por Docente </th>
								<th>Pago por Intendente </th>
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
								<td>{{$tabla_pago->qna}} </td>
								<td>{{$tabla_pago->dias}} </td>
								<td>${{$tabla_pago->pago_director}}.00 </td>
								<td>${{$tabla_pago->pago_docente}}.00 </td>
								<td>${{$tabla_pago->pago_intendente}}.00 </td>
								<th>{{$tabla_pago->ciclo}} </th>
								<td>{{$tabla_pago->captura}} </td>
								<td>{{$tabla_pago->updated_at}} </td>


								<td> 
									<center>
										<a href="{{URL::action('TablaPagosController@edit',$tabla_pago->id_tabla_pagos)}}" class="btn btn-primary btn-sm" role="button"><i class="fa fa-edit"></i></a>  
									</center>
								</td>
								<td>
									<center>
										<a class="btn btn-danger btn-sm" data-target="#modal-delete-{{$tabla_pago->id_tabla_pagos}}" data-toggle="modal" style="margin-right: 10px;"  role="button"><i class="fa fa-eraser"></i></a></center>
									</td>
								</td>
							</tr>
					
							@endforeach
						</tbody>
						<tfoot>
							<tr>
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
						</tfoot>
					</table>
				</div><!--/table-responsive-->
			</div><!--/porlets-content-->
		</div><!--/block-web-->
	</div><!--/col-md-12-->
</div><!--/row-->
</div>
@stop