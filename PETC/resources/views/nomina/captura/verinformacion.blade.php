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
									<select name="ciclo_escolar" id="ciclo_escolar"  onchange="enviar_ciclo();" class="form-control select2" ">
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
									<a class="btn btn-sm btn-success tooltips" href="{{URL::action('CapturaController@create',[])}}" style="margin-right: 10px;" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Registrar Nueva Localidad"> <i class="fa fa-plus"></i> Registrar </a>



									<a class="btn btn-sm btn-danger tooltips" href="{{URL::action('CapturaController@index')}}" style="margin-right: 10px;" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Cancelar"> <i class="fa fa-times"></i> Salir</a>

									<a class="btn btn-primary btn-sm" href="{{URL::action('CapturaController@invoice',$nombre->id.'/'.$id_ciclo)}}" style="margin-right: 10px;" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Descargar"> <i class="fa fa-print"></i> Generar PDF</a> 
									
								</div>

							</a>
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



		<div class="col-lg-6"> 
			<section class="panel default blue_title h4">
				<div class="panel-heading"><span class="semi-bold">Contrato Actual ó Ultimo</span> 
				</div>
				<div class="panel-body">

					<table class="table table-striped">

						<tbody>
							<tr>
								<th>Tipo de Movimiento: </th>
								<td>{{$personal->tipo_movimiento}}</td>
							</tr>
							<tr>
								<th>Ciclo Escolar:</th>
								<td>{{$personal->ciclo}}</td>
							</tr>
							<tr>
								<th>Clave: </th>
								<td>{{$personal->cat_puesto}}</td>
							</tr>
							<tr>
								<th>Categoria: </th>
								<td>{{$personal->categoria}}</td>
							</tr>
							<tr>
								<th>Fecha de Inicio: </th>
								<td> {{$personal->fecha_inicio}}</td>
							</tr>
							<tr>
								<th>Fecha de Termino: </th>
								<td> {{$personal->fecha_termino}} </td>
							</tr>
							<tr>
								<th>Documentación Entregada: </th>
								<td> {{$personal->documentacion_entregada}}</td>
							</tr>
							<tr>
								<th>Observaciónes: </th>
								<td> {{$personal->observaciones}}</td>
							</tr>
							<tr>
								<th>Número de Escuelas ETC: </th>
								<td> {{$personal->num_escuelas}}</td>
							</tr>
							<tr>
								<th>CCT 2 </th>
								<td> {{$personal->cct_2}}</td>
							</tr>
							<tr>
								<th>Dias Trabajados  </th>
								<td> {{$personal->dias_trabajados}}</td>
							</tr>

							<tr>
								<th>Capturo  </th>
								<td> {{$personal->captura}}</td>
							</tr>

							<tr>
								<th>Fecha de Actualización  </th>
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


		

		@if($altas==null)
		<div class="porlets-content container clear_both padding_fix">
			<div class="alert alert-danger"> <strong>No</strong> Se encuentran Altas Registradas a este Docente En El Ciclo escolar Seleccionado. <a class="alert-link" href="{{URL::action('CapturaController@create')}}">Click Para registrar</a></div>
		</div>
		@else
		@foreach($altas as $alta)
		<div class="col-lg-6"> 
			<section class="panel default blue_title h4">
				<div class="panel-heading"><span class="semi-bold">Historial de Altas</span> 
				</div>
				<div class="panel-body">
					<table class="table table-striped">
						<tbody>
							<tr>
								<th>Alta Número: </th>
								<td>{{$alta->id}}</td>
							</tr>
							<tr>
								<th>Fecha de Inicio: </th>
								<td>{{$alta->fecha_inicio}}</td>
							</tr>
							<tr>
								<th>Fecha de Termino:</th>
								<td>{{$alta->fecha_baja}}</td>
							</tr>
							<tr>
								<th>Documentación Entregada: </th>
								<td>{{$alta->documentacion_entregada}}</td>
							</tr>
							<tr>
								<th>CCT: </th>
								<td>{{$alta->cct}}</td>
							</tr>
							<tr>
								<th>Nombre de la Escuela: </th>
								<td>{{$alta->nombre_escuela}}</td>
							</tr>
							<tr>
								<th>Categoria: </th>
								<td>{{$alta->categoria}}</td>
							</tr>
							<tr>
								<th>Clave: </th>
								<td>{{$alta->cat_puesto}}</td>
							</tr>
							<tr>
								<th>Llego a Cubrir A: </th>
								<td>{{$alta->nombre}}</td>
							</tr>

							<tr>
								<th>Observaciónes: </th>
								<td>{{$alta->observaciones}}</td>
							</tr>
							<tr>
								<th>Estado: </th>
								<td> {{$alta->estado}}</td>
							</tr>
							<tr>
								<th>Capturo: </th>
								<td> {{$alta->captura}} </td>
							</tr>
							<tr>
								<th>Fecha de Captura: </th>
								<td> {{$alta->created_at}}</td>
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
		@endforeach
		@endif

		@if($bajas==null)
		<div class="porlets-content container clear_both padding_fix">
			<div class="alert alert-danger"> <strong>No</strong> Se encuentran Bajas Registradas a este Docente En El Ciclo escolar Seleccionado. <a class="alert-link" href="{{URL::action('CapturaController@create')}}">Click Para registrar</a></div>
		</div>
		@else

		@foreach($bajas as $baja)
		<div class="col-lg-6"> 
			<section class="panel default blue_title h4">
				<div class="panel-heading"><span class="semi-bold">Historial de Bajas</span> 
				</div>
				<div class="panel-body">
					<table class="table table-striped">
						<tbody>							
							<tr>
								<th>Fecha de Baja:</th>
								<td>{{$baja->fecha_baja}}</td>
							</tr>
							<tr>
								<th>Documentación Entregada: </th>
								<td>{{$baja->documentacion_entregada}}</td>
							</tr>
							<tr>
								<th>CCT: </th>
								<td>{{$baja->cct}}</td>
							</tr>
							<tr>
								<th>Nombre de la Escuela: </th>
								<td>{{$baja->nombre_escuela}}</td>
							</tr>							
							<tr>
								<th>Lo Llega a Cubrir: </th>
								<td>{{$baja->nombre}}</td>
							</tr>
							<tr>
								<th>Observaciónes: </th>
								<td>{{$baja->observaciones}}</td>
							</tr>
							<tr>
								<th>Estado: </th>
								<td> {{$baja->estado}}</td>
							</tr>
							<tr>
								<th>Capturo: </th>
								<td> {{$baja->captura}} </td>
							</tr>
							<tr>
								<th>Fecha de Captura: </th>
								<td> {{$baja->created_at}}</td>
							</tr>
							

						</tbody>
					</table>
				</div>
			</section>
		</div>
		@endforeach
		@endif


		@if($extenciones==null)
		<div class="porlets-content container clear_both padding_fix">
			<div class="alert alert-danger"> <strong>No</strong> Se encuentran extenciónes de Contrato Registradas  a este Docente En El Ciclo escolar Seleccionado. <a class="alert-link" href="{{URL::action('CapturaController@create')}}">Click Para registrar</a></div>
		</div>
		@else
		@foreach($extenciones as $extencion)

		<div class="col-lg-6"> 
			<section class="panel default blue_title h4">
				<div class="panel-heading"><span class="semi-bold">Historial de Extenciónes de Contrato</span> 
				</div>
				<div class="panel-body">
					<table class="table table-striped">
						<tbody>		
							<tr>
								<th>Fecha de Inicio:</th>
								<td>{{$extencion->fecha_inicio}}</td>
							</tr>					
							<tr>
								<th>Fecha de Baja:</th>
								<td>{{$extencion->fecha_baja}}</td>
							</tr>
							<tr>
								<th>Documentación Entregada: </th>
								<td>{{$extencion->documentacion_entregada}}</td>
							</tr>

							<tr>
								<th>Observaciónes: </th>
								<td>{{$extencion->observaciones}}</td>
							</tr>
							<tr>
								<th>Estado: </th>
								<td> {{$extencion->estado}}</td>
							</tr>
							<tr>
								<th>Capturo: </th>
								<td> {{$extencion->captura}} </td>
							</tr>
							<tr>
								<th>Fecha de Captura: </th>
								<td> {{$extencion->created_at}}</td>
							</tr>
							

						</tbody>
					</table>
				</div>
			</section>
		</div>
		@endforeach
		@endif


		@if($cambios==null)
		<div class="porlets-content container clear_both padding_fix">
			<div class="alert alert-danger"> <strong>No</strong> Se encuentran Cambios de CTE de este Docente En El Ciclo escolar Seleccionado. <a class="alert-link" href="{{URL::action('CapturaController@create')}}">Click Para registrar</a></div>
		</div>
		@else

		@foreach($cambios as $cambio)
		<div class="col-lg-6"> 
			<section class="panel default blue_title h4">
				<div class="panel-heading"><span class="semi-bold">Historial de Cambios de CTE</span> 
				</div>
				<div class="panel-body">
					<table class="table table-striped">
						<tbody>	
							<tr>
								<th>Anterior Escuela:</th>
								<td>{{$cambio->anteriorcentro_nombre_escuela}}</td>
							</tr>		
							<tr>
								<th>Anterior CCT:</th>
								<td>{{$cambio->anteriorcentro_cct}}</td>
							</tr>					
							<tr>
								<th>Fecha de Cambio:</th>
								<td>{{$cambio->fecha_cambio}}</td>
							</tr>
							<tr>
								<th>Nueva Escuela:</th>
								<td>{{$cambio->nuevocentro_nombre_escuela}}</td>
							</tr>		
							<tr>
								<th>Nuevo CCT:</th>
								<td>{{$cambio->nuevocentro_cct}}</td>
							</tr>					
							<tr>
								<tr>
									<th>Documentación Entregada: </th>
									<td>{{$cambio->documentacion_entregada}}</td>
								</tr>>

								<tr>
									<th>Categoria: </th>
									<td>{{$cambio->categoria}}</td>
								</tr>
								<tr>
									<th>Clave: </th>
									<td>{{$cambio->cat_puesto}}</td>
								</tr>						
								<tr>
									<th>Observaciónes: </th>
									<td>{{$cambio->observaciones}}</td>
								</tr>
								<tr>
									<th>Capturo: </th>
									<td> {{$cambio->captura}} </td>
								</tr>
								<tr>
									<th>Fecha de Captura: </th>
									<td> {{$cambio->created_at}}</td>
								</tr>


							</tbody>
						</table>
					</div>
				</section>
			</div>
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
