@extends('layouts.principal')
@section('contenido')
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<div class="pull-left breadcrumb_admin clear_both">
	<div class="pull-left page_title theme_color">
		<h1>Inicio</h1>
		<h2 class="">Historial del CTE </h2>
	</div>
	<div class="pull-right">
		<ol class="breadcrumb">
			<li ><a style="color: #808080" href="{{url('/captura')}}">Inicio</a></li>
			<li class="active">Historial del CTE</a></li>

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
							<h4 class="content-header " style="margin-top: -5px;">&nbsp;&nbsp;<strong>Historial del CTE: {{$nombre->nombre_escuela}} {{$nombre->cct}} {{$nombre_ciclo->ciclo}}</strong></h4>
							
							<div class="form-group">
								<label class="col-sm-3 control-label">Seleccione Ciclo Escolar: <strog class="theme_color"></strog></label>
								<div class="col-sm-6">
									<select name="ciclo_escolar" id="ciclo_escolar"  onchange="enviar_ciclo4();" class="form-control select2" ">
										@foreach($ciclos as $ciclo)
										@if($ciclo->id == $id_ciclo)
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
									<a class="btn btn-sm btn-success tooltips" href="{{URL::action('CentroTrabajoController@create',[])}}" style="margin-right: 10px;" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Registrar Nueva Localidad"> <i class="fa fa-plus"></i> Registrar </a>



									<a class="btn btn-sm btn-danger tooltips" href="{{URL::action('CentroTrabajoController@index')}}" style="margin-right: 10px;" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Cancelar"> <i class="fa fa-times"></i> Salir</a>

									<a class="btn btn-primary btn-sm" href="{{URL::action('CentroTrabajoController@invoice_centro_cct',$nombre->id.'/'.$id_ciclo)}}" style="margin-right: 10px;" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Descargar" target="_blank" > <i class="fa fa-print"></i> Generar PDF</a> 
									
								</div>

							</a>
							<div class="porlets-content container clear_both padding_fix">
								<div class="alert alert-danger"> <strong>La </strong>Escuela Registra un Total de {{$total_ina}} Inasistencias en el Ciclo Escolar Seleccionado </div>
							</div>
						</b>
					</div>

				</div>
			</div>


			<div class="col-lg-6"> 
				<div class="panel-body">		
					<section class="panel default blue_title h4">
						<div class="panel-heading"><span class="semi-bold">Datos de la Escuela </span> 
						</div>



						<table class="table table-striped">

							<tbody>
								<tr>
									<th>CCT: </th>
									<td>{{$centro->cct}}</td>
								</tr>
								<tr>
									<th>Nombre de la Escuela:</th>
									<td>{{$centro->nombre_escuela}}</td>
								</tr>
								<tr>
									<th>Alimentación:</th>
									<td>{{$centro->alimentacion}}</td>
								</tr>
								<tr>
									<th>Región: </th>
									<td>{{$centro->region}} {{$centro->sostenimiento}}</td>
								</tr>
								<tr>
									<th>Domicilio: </th>
									<td>{{$centro->domicilio}}</td>
								</tr>
								<tr>
									<th>Localidad: </th>
									<td>{{$centro->nom_loc}}</td>
								</tr>
								<tr>
									<th>Municipio: </th>
									<td> {{$centro->municipio}}</td>
								</tr>	

								<tr>
									<th>Teléfono: </th>
									<td>{{$centro->telefono}}</td>
								</tr>
								<tr>
									<th>Fecha de Ingreso al PETC:</th>
									<td>CICLO ESCOLAR {{$centro->fecha_ingreso}}</td>
								</tr>	
								<tr>
									<th>Fecha de Baja del PETC:</th>
									@if($centro->fecha_baja == null)
									<td>SIGUE ACTIVO EN EL PETC</td>
									@else
									<td>{{$centro->fecha_baja}}</td>
									@endif
								</tr>	

								<tr>
									<th>Nombre del Director:</th>
									<td>{{$centro->email}}</td>
								</tr>	
								<tr>
									<th>Email:</th>
									<td>{{$centro->email}}</td>
								</tr>													
								<tr>
									<th>Capturo: </th>
									<td> {{$centro->captura}}</td>
								</tr>
								<tr>
									<th>Modificado </th>
									<td> {{$centro->updated_at}}</td>
								</tr>


							</tbody>
						</table>
					</div>		
				</div>
			</section>


			<div class="col-lg-6"> 
				<div class="panel-body">		
					<section class="panel default blue_title h4">
						<div class="panel-heading"><span class="semi-bold">Estadistica 911  <a class="btn btn-primary btn-sm" href="{{URL::action('CentroTrabajoController@invoice_centro_cct',$nombre->id.'/'.$id_ciclo)}}" style="margin-right: 10px;" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Descargar" target="_blank" > <i class="fa fa-print"></i> Generar PDF</a> </span> 
						</div>



						<table class="table table-striped">

							<tbody>
								<tr>
									<th>Nivel:</th>
									<td>{{$centro->nivel}}</td>
								</tr>	
								<tr>
									<th>Tipo de Organizaciòn: </th>
									<td>{{$centro->tipo_organizacion}}</td>
								</tr>
								<tr>
									<th>Directores: </th>
									<td>{{$centro->total_directores}}</td>
								</tr>
								<tr>
									<th>Docentes Frente a Grupo:</th>
									<td>{{$centro->total_docentes}}</td>
								</tr>
								<tr>
									<th>Docentes de USAER: </th>
									<td>{{$centro->total_usaer}}</td>
								</tr>
								<tr>
									<th>Docentes de Educación Fisica: </th>
									<td>{{$centro->total_fisica}}</td>
								</tr>
								<tr>
									<th>Docentes Artistica: </th>
									<td> {{$centro->total_artistica}}</td>
								</tr>						
								<tr>
									<th>Intentendes	: </th>
									<td> {{$centro->total_intendentes}}</td>
								</tr>
								<tr>
									<th>Alumnos </th>
									<td> {{$centro->total_alumnos}}</td>
								</tr>

								<tr>
									<th>Niñas </th>
									<td> {{$centro->total_ninas}}</td>
								</tr>
								<tr>
									<th>Niños </th>
									<td> {{$centro->total_ninos}}</td>
								</tr>
								<tr>
									<th>Grados </th>
									<td> {{$centro->total_grados}}</td>
								</tr>
								<tr>
									<th>Grupos </th>
									<td> {{$centro->total_grupos}}</td>
								</tr>
								<tr>
									<th>Editar: </th>
									<td>      
										<center>
											<a href="{{URL::action('CentroTrabajoController@edit',$centro->id)}}" class="btn btn-primary btn-sm" role="button"><i class="fa fa-edit"></i></a>  
										</center>
									</td>
								</tr>

							</tbody>
						</table>
					</div>		
				</div>
			</section>


			<div class="porlets-content container clear_both padding_fix">
				@if($personal==null)
				<div class="alert alert-danger"> <strong>No</strong> Se encuentra Plantilla de Personal Registrada en este CTE <a class="alert-link" href="{{URL::action('CentroTrabajoController@create')}}">Click Para registrar</a></div>

			</b>
		</div>
		@else
		<section class="panel default blue_title h4">
			<div class="panel-heading"><span class="semi-bold">Plantilla de Personal  <a class="btn btn-primary btn-sm" href="{{URL::action('CentroTrabajoController@invoice_plantilla',$nombre->id.'/'.$id_ciclo)}}" style="margin-right: 10px;" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Descargar" target="_blank" > <i class="fa fa-print"></i> Generar PDF</a> </span> 
			</div>
			<div class="porlets-content">
				<div class="table-responsive" >
					<table  class="display table table-bordered table-striped" id="dynamic-table">
						<thead>
							<tr>
								<th>RFC </th>
								<th>Nombre</th>
								<th>Categoria </th>
								<th>Clave </th>
								<th>Fecha Inicial </th>
								<th>Fecha Final </th>								
							</tr>
						</thead>
						<tbody>
							@foreach($personal  as $personal)
							<tr class="gradeA">
								<td>{{$personal->rfc}} </td>
								<td>{{$personal->nombre}}</td>
								<td>{{$personal->categoria}} </td>
								<th>{{$personal->cat_puesto}} </th>
								<td>{{$personal->fecha_inicio}} </td>
								<td>{{$personal->fecha_termino}} </td>
							</td>
						</tr>
						@endforeach
					</tbody>
					<tfoot>
					</tfoot>
				</table>

			</div><!--/table-responsive-->
		</div><!--/porlets-content-->
	</section>
	@endif



	<section class="panel default blue_title h4">
		<div class="panel-heading"><span class="semi-bold">Registros de Asistencia  </span> 				
		</div>
		<div class="form-group">						
			<div class="col-sm-6">
				<select  name="mes" id="mes" class="form-control select2" onchange="busca_personal3(callback);" required>
					<option value="ENERO">
						ENERO
					</option>
					<option value="FEBRERO">
						FEBRERO
					</option>
					<option value="MARZO">
						MARZO
					</option>
					<option value="ABRIL">
						ABRIL
					</option>
					<option value="MAYO">
						MAYO
					</option>
					<option value="JUNIO">
						JUNIO
					</option>
					<option value="JULIO">
						JULIO
					</option>
					<option value="AGOSTO">
						AGOSTO
					</option>
					<option value="SEPTIEMBRE">
						SEPTIEMBRE
					</option>
					<option value="OCTUBRE">
						OCTUBRE
					</option>
					<option value="NOVIEMBRE">
						NOVIEMBRE
					</option>
					<option value="DICIEMBRE">
						DICIEMBRE
					</option>
				</select>
				<div class="help-block with-errors"></div>
			</div>
		</div><!--/form-group-->

		<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
			<div class="form-group"> 
				<table id="detalles" name="detalles[]" value="" class="table table-striped table-bordered table-condensed table-hover">
					<thead style="background-color:#A9D0F5">



					</thead>
					<tfoot>

					</tfoot>
					<tbody>

					</tbody>

				</table>

				<div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
					<div class="form-group"> 
						<label for="total">Total de Inasistencias </label>
						<input name="total" id="total" type="number"  class="form-control"  readonly/>
					</div>    
				</div>  
			</div>
		</div>
	</section>


	<div class="porlets-content container clear_both padding_fix">
		@if($alta_1==null)
		<div class="alert alert-danger"> <strong>No</strong> Se encuentra Altas de Personal Registradas en este CTE <a class="alert-link" href="{{URL::action('CapturaController@create')}}">Click Para registrar</a></div>

	</b>
</div>
@else

<section class="panel default blue_title h4">
	<div class="panel-heading"><span class="semi-bold">Altas Registradas  <a class="btn btn-primary btn-sm" href="{{URL::action('CapturaController@invoice',$nombre->id.'/'.$id_ciclo)}}" style="margin-right: 10px;" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Descargar" target="_blank" > <i class="fa fa-print"></i> Generar PDF</a> </span> 
	</div>
	<div class="porlets-content">
		<div class="table-responsive" >
			<table  class="display table table-bordered table-striped" id="dynamic-table">
				<thead>
					<tr>
						<th>Estado </th>
						<th>RFC </th>
						<th>Nombre</th>
						<th>Categoria </th>
						<th>Tipo de Movimiento </th>
						<th>Fecha Inicial </th>
						<th>Fecha Final </th>
						<th>Llega a Cubrir </th>	
						<th>RFC </th>	
						<th>Observaciónes </th>
						<th>Documentación </th>								
					</tr>
				</thead>
				<tbody>
					@foreach($alta_1  as $personal)
					<tr class="gradeA">
						<td>{{$personal->estado_cap}} </td>
						<td>{{$personal->rfc}} </td>
						<td>{{$personal->nombre}}</td>
						<td>{{$personal->categoria}} </td>
						<th>{{$personal->tipo_movimiento}} </th>
						<td>{{$personal->fecha_inicio}} </td>
						<td>{{$personal->fecha_baja}} </td>
						<td> </td>
						<td> </td>
						<td>{{$personal->observaciones}} </td>
						<td>{{$personal->documentacion_entregada}} </td>
					</td>
				</tr>
				@endforeach

				@foreach($alta_2  as $personal)
				<tr class="gradeA">
					<td>{{$personal->estado_cap}} </td>
					<td>{{$personal->rfc}} </td>
					<td>{{$personal->nombre}}</td>
					<td>{{$personal->categoria}} </td>
					<th>{{$personal->tipo_movimiento}} </th>
					<td>{{$personal->fecha_inicio}} </td>
					<td>{{$personal->fecha_baja}} </td>
					<td>{{$personal->rfc2}} </td>
					<td>{{$personal->nombre2}}</td>
					<td>{{$personal->observaciones}} </td>
					<td>{{$personal->documentacion_entregada}} </td>
				</td>
			</tr>
			@endforeach
		</tbody>
		<tfoot>
		</tfoot>
	</table>

</div><!--/table-responsive-->
</div><!--/porlets-content-->
</section>
@endif


<div class="porlets-content container clear_both padding_fix">
	@if($baja_1==null)
	<div class="alert alert-danger"> <strong>No</strong> Se encuentra Bajas de Personal Registradas en este CTE <a class="alert-link" href="{{URL::action('CapturaController@create')}}">Click Para registrar</a></div>

</b>
</div>
@else

<section class="panel default blue_title h4">
	<div class="panel-heading"><span class="semi-bold">Bajas Registradas  <a class="btn btn-primary btn-sm" href="{{URL::action('CapturaController@invoice',$nombre->id.'/'.$id_ciclo)}}" style="margin-right: 10px;" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Descargar" target="_blank" > <i class="fa fa-print"></i> Generar PDF</a> </span> 
	</div>
	<div class="porlets-content">
		<div class="table-responsive" >
			<table  class="display table table-bordered table-striped" id="dynamic-table">
				<thead>
					<tr>
						<th>Estado </th>
						<th>RFC </th>
						<th>Nombre</th>
						<th>Categoria </th>
						<th>Fecha Baja </th>
						<th>Lo Cubre </th>	
						<th>RFC </th>	
						<th>Observaciónes </th>
						<th>Documentación </th>								
					</tr>
				</thead>
				<tbody>
					@foreach($baja_1  as $personal)
					<tr class="gradeA">
						<td>{{$personal->estado_cap}} </td>
						<td>{{$personal->rfc}} </td>
						<td>{{$personal->nombre}}</td>
						<td>{{$personal->categoria}} </td>
						<td>{{$personal->fecha_baja}} </td>
						<td> </td>
						<td> </td>
						<td>{{$personal->observaciones}} </td>
						<td>{{$personal->documentacion_entregada}} </td>
					</td>
				</tr>
				@endforeach

				@foreach($baja_2  as $personal)
				<tr class="gradeA">
					<td>{{$personal->estado_cap}} </td>
					<td>{{$personal->rfc}} </td>
					<td>{{$personal->nombre}}</td>
					<td>{{$personal->categoria}} </td>
					<td>{{$personal->fecha_baja}} </td>
					<td>{{$personal->rfc2}} </td>
					<td>{{$personal->nombre2}}</td>
					<td>{{$personal->observaciones}} </td>
					<td>{{$personal->documentacion_entregada}} </td>
				</td>
			</tr>
			@endforeach
		</tbody>
		<tfoot>
		</tfoot>
	</table>

</div><!--/table-responsive-->
</div><!--/porlets-content-->
</section>
@endif




<div class="porlets-content container clear_both padding_fix">
	@if($baja_1==null)
	<div class="alert alert-danger"> <strong>No</strong> Se encuentra Cambios de Personal Registrados en este CTE <a class="alert-link" href="{{URL::action('CapturaController@create')}}">Click Para registrar</a></div>

</b>
</div>
@else
<section class="panel default blue_title h4">
	<div class="panel-heading"><span class="semi-bold">Cambios de CTE  <a class="btn btn-primary btn-sm" href="{{URL::action('CapturaController@invoice',$nombre->id.'/'.$id_ciclo)}}" style="margin-right: 10px;" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Descargar" target="_blank" > <i class="fa fa-print"></i> Generar PDF</a> </span> 
	</div>
	<div class="porlets-content">
		<div class="table-responsive" >
			<table  class="display table table-bordered table-striped" id="dynamic-table">
				<thead>
					<tr>
						<th>Estado </th>
						<th>RFC </th>
						<th>Nombre</th>
						<th>Categoria </th>
						<th>Fecha Inicial </th>
						<th>Fecha Final </th>
						<th>CCT Anterior </th>	
						<th>CCT Nuevo </th>	
						<th>Observaciónes </th>
						<th>Documentación </th>								
					</tr>
				</thead>
				<tbody>
					@foreach($cambio_cct  as $personal)
					<tr class="gradeA">
						<td>{{$personal->estado_cap}} </td>
						<td>{{$personal->rfc}} </td>
						<td>{{$personal->nombre}}</td>
						<td>{{$personal->categoria}} </td>
						<td>{{$personal->fecha_inicio}} </td>
						<td>{{$personal->fecha_baja}} </td>
						<td>{{$personal->cct2}} </td>
						<td>{{$personal->cct}} </td>
						<td>{{$personal->observaciones}} </td>
						<td>{{$personal->documentacion_entregada}} </td>
					</td>
				</tr>
				@endforeach							
			</tbody>
			<tfoot>
			</tfoot>
		</table>

	</div><!--/table-responsive-->
</div><!--/porlets-content-->
</section>
@endif


			 <div class="porlets-content container clear_both padding_fix">
				@if($cambio_funcion==null)
				<div class="alert alert-danger"> <strong>No</strong> Se encuentra Cambios de Funcion de Personal Registra en este CTE <a class="alert-link" href="{{URL::action('CapturaController@create')}}">Click Para registrar</a></div>

			</b>
		</div>
		@else

<section class="panel default blue_title h4">
	<div class="panel-heading"><span class="semi-bold">Cambios de Función  <a class="btn btn-primary btn-sm" href="{{URL::action('CapturaController@invoice',$nombre->id.'/'.$id_ciclo)}}" style="margin-right: 10px;" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Descargar" target="_blank" > <i class="fa fa-print"></i> Generar PDF</a> </span> 
	</div>
	<div class="porlets-content">
		<div class="table-responsive" >
			<table  class="display table table-bordered table-striped" id="dynamic-table">
				<thead>
					<tr>
						<th>Estado </th>
						<th>RFC </th>
						<th>Nombre</th>
						<th>Categoria </th>
						<th>Fecha Inicial </th>
						<th>Fecha Final </th>
						<th>Función Anterior </th>	
						<th>Función Nueva </th>	
						<th>Observaciónes </th>
						<th>Documentación </th>								
					</tr>
				</thead>
				<tbody>
					@foreach($cambio_funcion  as $personal)
					<tr class="gradeA">
						<td>{{$personal->estado_cap}} </td>
						<td>{{$personal->rfc}} </td>
						<td>{{$personal->nombre}}</td>
						<td>{{$personal->categoria}} </td>
						<td>{{$personal->fecha_inicio}} </td>
						<td>{{$personal->fecha_baja}} </td>
						<td>{{$personal->categoria_anterior}} </td>
						<td>{{$personal->categoria_nueva}} </td>
						<td>{{$personal->observaciones}} </td>
						<td>{{$personal->documentacion_entregada}} </td>
					</td>
				</tr>
				@endforeach							
			</tbody>
			<tfoot>
			</tfoot>
		</table>
		
	</div><!--/table-responsive-->
</div><!--/porlets-content-->
</section>
@endif



<div class="form-group">
	<div class="col-sm-6">
		<input  id="id_centro"  name="id_centro" value="{{$nombre->id}}" type="hidden"  class="form-control" />
	</div>
</div>

<div class="form-group">
	<div class="col-sm-6">
		<input  id="id_ciclo"  name="id_ciclo" value="{{$id_ciclo}}" type="hidden"  class="form-control" />
	</div>
</div>

<div class="form-group">
	<div class="col-sm-6">
		<input  id="nombre_ciclo"  name="nombre_ciclo" value="{{$nombre_ciclo->ciclo}}" type="hidden"  class="form-control" />
	</div>
</div>

<div class="form-group">
	<div class="col-sm-6">
		<input  id="inasistencias" value="" name="inasistencias[]" type="hidden"  class="form-control"/>
	</div>
</div>

</div><!--/porlets-content-->
</div><!--/block-web-->
</div><!--/col-md-12-->
</div><!--/row-->
</div>
<script type="text/javascript">
	window.onload=function() {
		busca_personal3(callback);

	}
</script>
@endsection
