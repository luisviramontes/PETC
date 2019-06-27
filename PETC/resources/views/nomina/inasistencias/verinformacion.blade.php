@extends('layouts.principal')
@section('contenido')
<div class="pull-left breadcrumb_admin clear_both">
	<div class="pull-left page_title theme_color">
		<h1>Inicio</h1>
		<h2 class="">Historial del Docente </h2>
	</div>
	<div class="pull-right">
		<ol class="breadcrumb">
			<li ><a style="color: #808080" href="{{url('/captura')}}">Inicio</a></li>
			<li class="active">Historial del Docente</a></li>
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
							
							<h4 class="content-header " style="margin-top: -5px;">&nbsp;&nbsp;<strong>Historial del Empleado:  {{$nombre->nombre}}</strong></h4>
							
							<div class="form-group">
								<label class="col-sm-3 control-label">Seleccione Ciclo Escolar: <strog class="theme_color"></strog></label>
								<div class="col-sm-6">
									<select name="ciclo_escolar" id="ciclo_escolar"  onchange="enviar_ciclo3();" class="form-control select2" ">
										@foreach($ciclos as $ciclo)
										@if($ciclo->id == $ciclo_aux)
										<option value='{{$ciclo->id}}' selected>
											{{$ciclo->ciclo}}
										</option>
										@else
										<option value='{{$ciclo->id}}'>
											{{$ciclo->ciclo}}
										</option>
										@endif
										@endforeach
									</select>

								</div>
							</div>


						</div>						
						<div class="btn-group pull-right">
							<b>
								<div class="btn-group" style="margin-right: 10px;">
									<a class="btn btn-sm btn-success tooltips" href="{{URL::action('InasistenciasController@create',[])}}" style="margin-right: 10px;" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Registrar Nueva Lista de Asistencia"> <i class="fa fa-plus"></i> Registrar </a>



									<a class="btn btn-sm btn-danger tooltips" href="{{URL::action('ListasAsistenciasController@index')}}" style="margin-right: 10px;" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Cancelar"> <i class="fa fa-times"></i> Salir</a>

									<a class="btn btn-primary btn-sm" href="{{URL::action('InasistenciasController@invoice',$nombre->id.'/'.$ciclo_aux)}}" style="margin-right: 10px;" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Descargar" target="_blank" > <i class="fa fa-print"></i> Generar PDF</a> 

									<a class="btn btn-primary btn-sm" href="{{URL::action('InasistenciasController@excel2',$nombre->id.'/'.$ciclo_aux)}}" style="margin-right: 10px;" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Descargar"> <i class="fa fa-download"></i></i> Generar Excel</a> 
									
								</div>

							</a>
							<div class="porlets-content container clear_both padding_fix">
						<div class="alert alert-danger"> <strong>El </strong>Empleado Registra un Total de {{$total_ina}} Inasistencias en el Ciclo Escolar Seleccionado </div>
						</div>
						</b>
					</div>

				</div>
			</div>
			

			<div class="porlets-content container clear_both padding_fix">
				@if($personal==null)
				<div class="alert alert-danger"> <strong>No</strong> Se encuentran Contratos Registrados  a este Docente En El Ciclo escolar Seleccionado. <a class="alert-link" href="{{URL::action('CapturaController@create')}}">Click Para registrar</a></div>

			</b>
		</div>
		@else
		@foreach($personal as $personal)
		<div class="col-lg-6"> 
			<section class="panel default blue_title h4">
				<div class="panel-heading"><span class="semi-bold">Datos Personales</span> 
				</div>
				<div class="panel-body">

					<table class="table table-striped">

						<tbody>
							<tr>
								<th>Nombre: </th>
								<td>{{$personal->nombre}}</td>
							</tr>
							<tr>
								<th>RFC:</th>
								<td>{{$personal->rfc}}</td>
							</tr>
							<tr>
								<th>Teléfono: </th>
								<td>{{$personal->telefono}} </td>
							</tr>
							<tr>
								<th>Email: </th>
								<td>{{$personal->email}}</td>
							</tr>
							<tr>
								<th>Función Actual: </th>
								<td>{{$personal->categoria}}</td>
							</tr>	
							<tr>
								<th>Clave: </th>
								<td>{{$personal->cat_puesto}}</td>
							</tr>

							<tr>
								<th>Estado Actual en el PETC: </th>
								<td>{{$personal->estado}}</td>
							</tr>													

						</tbody>
					</table>
				</div>
			</section>
		</div>


		<div class="col-lg-6"> 
			<section class="panel default blue_title h4">
				<div class="panel-heading"><span class="semi-bold">Datos del CTE Actual</span> 
				</div>
				<div class="panel-body">

					<table class="table table-striped">

						<tbody>
							<tr>
								<th>CCT: </th>
								<td>{{$personal->cct}}</td>
							</tr>
							<tr>
								<th>Nombre de la Escuela:</th>
								<td>{{$personal->nombre_escuela}}</td>
							</tr>
							<tr>
								<th>Región: </th>
								<td>{{$personal->region}} {{$personal->sostenimiento}}</td>
							</tr>
							<tr>
								<th>Localidad: </th>
								<td>{{$personal->nom_loc}}</td>
							</tr>
							<tr>
								<th>Municipio: </th>
								<td> {{$personal->municipio}}</td>
							</tr>						
							<tr>
								<th>Capturo: </th>
								<td> {{$personal->captura}}</td>
							</tr>
							<tr>
								<th>Modificado </th>
								<td> {{$personal->updated_at}}</td>
							</tr>
							<tr>
								<th>Editar: </th>
								<td>      
									<center>
										<a href="{{URL::action('LocalidadesController@edit',$personal->id)}}" class="btn btn-primary btn-sm" role="button"><i class="fa fa-edit"></i></a>  
									</center>
								</td>
							</tr>

						</tbody>
					</table>
				</div>
			</section>
		</div>

	
		@endforeach
		@endif


		<!-- {{$x=1}} -->

		@if($inasistencias == null)
		<div class="porlets-content container clear_both padding_fix">
			<div class="alert alert-danger"> <strong>No</strong> Se encuentran Inasistencias Registradas a este Empleado En El Ciclo escolar Seleccionado. <a class="alert-link" href="{{URL::action('CapturaController@create')}}">Click Para registrar</a></div>
		</div>
		@else
		@foreach($inasistencias as $personal)
		<div class="col-lg-6"> 
			<section class="panel default blue_title h4">
				<div class="panel-heading"><span class="semi-bold">Historial de Inasistencias</span> 
				</div>
				<div class="panel-body">
					<table class="table table-striped">
						<tbody>
							<tr>
								<th>Inasistencia Número: </th>
								<td>{{$x}}</td>
							</tr>							
							<tr>
								<th>Fecha de Inasistencia: </th>
								<td>{{$personal->dia}}  {{$personal->mes}}</td>
							</tr>
							<tr>
								<th>Ciclo Escolar:</th>
								<td>{{$personal->ciclo_ina}}</td>
							</tr>							
							<tr>
								<th>Estado: </th>
								<td>{{$personal->estado_ina}}</td>
							</tr>
							<tr>
								<th>Nombre de la Escuela: </th>
								<td>{{$personal->nombre_escuela_ina}}</td>
							</tr>
							<tr>
								<th>CCT: </th>
								<td>{{$personal->cct_ina}}</td>
							</tr>
							<tr>
								<th>QNA en que se Aplico la Inasistencia: </th>
								<td>{{$personal->fecha_aplica}}</td>
							</tr>							

							<tr>
								<th>Observaciónes: </th>
								<td>{{$personal->observaciones}}</td>
							</tr>							
							<tr>
								<th>Capturo: </th>
								<td> {{$personal->captura}} </td>
							</tr>
							<tr>
								<th>Fecha de Captura: </th>
								<td> {{$personal->updated_at}}</td>
							</tr>
							<tr>
								<th> </th>
								<td></td>
							</tr>
							

						</tbody>
					</table>
				</div>
			</section>
		</div>
		<?php
		$x=$x+1;
		?>
		@endforeach				
		@endif


			<div class="form-group">
				<div class="col-sm-6">
					<input  id="id_personal"  name="id_personal" value="{{$nombre->id}}" type="hidden"  class="form-control" />
				</div>
			</div>


		</div><!--/porlets-content-->
	</div><!--/block-web-->
</div><!--/col-md-12-->
</div><!--/row-->
</div>
@endsection
