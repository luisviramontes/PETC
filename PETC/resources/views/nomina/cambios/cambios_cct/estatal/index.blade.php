@extends('layouts.principal')
@section('contenido')
<div class="pull-left breadcrumb_admin clear_both">
	<div class="pull-left page_title theme_color">
		<h1>Lista de Empleados Registrados en PETC </h1>
		<h2 class="">Empleados PETC</h2>
	</div>
	<div class="pull-right">
		<ol class="breadcrumb">
			<li ><a style="color: #808080" href="{{url('/captura')}}">Inicio</a></li>
			<li class="active">Empleados SEDUZAC</a></li>
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
							<h2 class="content-header" style="margin-top: -5px;">&nbsp;&nbsp;<strong>CAMBIOS DE CTE PETC ESTATALES PENDIENTES: {{$contador}}</strong></h2>
							@include('nomina.cambios.cambios_cct.estatal.search')
						</div>
						<div class="col-md-5">
							<div class="btn-group pull-right">
								<b>

									<div class="btn-group" style="margin-right: 10px;">
										<a class="btn btn-sm btn-success tooltips" href="{{ route('captura.create')}}" style="margin-right: 10px;" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Registrar Nuevo Empleado"> <i class="fa fa-plus"></i> Registrar </a>


										<a class="btn btn-sm btn-warning tooltips" href="{{ route('nomina.cambios_cct_est.excel')}}" style="margin-right: 10px;" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Descargar"> <i class="fa fa-download"></i> Descargar </a>  										


									</div>								
								</b>
							</div>
						</div>
					</div>
				</div>

				<div class="porlets-content" >
					<div class="table-responsive">
						<table cellpadding="0" cellspacing="0" border="0"  class="display table table-bordered " id="hidden-table-info11" >
							<thead>   
								<tr>
									<th>Región</th>
									<th>RFC </th>
									<th>Nombre del Empleado</th>
									<th style="display:none;" >Teléfono </th>
									<th style="display:none;" >Email </th>
									<th>CCT</th>
									<th style="display:none;" >Nombre de Escuela</th>
									<th style="display:none;" >Sostenimiento</th>
									<th style="display:none;" >Clave</th>
									<th>Categoria</th>
									<th>Contrato Actual</th>
									<th>Contrato Fin</th>
									<th style="display:none;" >Documentación Entregada </th>
									<th style="display:none;" >Observaciónes </th>
									<th style="display:none;" >CCT 2 </th>
									<th>Captura</th>
									<th>Estado</th>
									<th>Pagos Reg</th>
									<th>Qna Act</th>
									<th style="display:none;" >Ciclo</th>
									<th style="display:none;" >Localidad </th>
									<th style="display:none;" >Municipio </th>

									<th style="display:none;" >CCT Aterior</th>
									<th style="display:none;" >Nombre de la Escuela</th>
									<th style="display:none;" >Región Aterior</th>
									<th style="display:none;" >Localidad Aterior</th>
									<th style="display:none;" >Municipio Aterior</th>									
									<th style="display:none;" >Dias Trabajados </th>					
									<th>Ver Datos</th>
									<th style="display:none;" >Fecha de Actualización</th>
									<th>Modificar</th>
									<th>Desactivar</th>											
									<th style="display:none;" >Tipo de Movimiento</th>	
									<th>Activar</th>						
									
									
								</tr>
							</thead>
							<tbody>
								@foreach($personal  as $datos)
								@if ($datos->estado == "RESUELTO")     
								<tr class="gradeX">									
									<td style="background-color: #DBFFC2;">{{$datos->region2}} {{$datos->sostenimiento}} </td>
									<td style="background-color: #DBFFC2;">{{$datos->rfc}} </td>
									<td style="background-color: #DBFFC2;">{{$datos->nombre}} </td>
									<td style="display:none;" >{{$datos->telefono}}</td>
									<td style="display:none;" >{{$datos->email}} </td>
									<td style="background-color: #DBFFC2;" >{{$datos->cct2}} </td>	
									<td style="display:none;" >{{$datos->nombre_escuela2}} </td>	
									<th style="display:none;" >{{$datos->sostenimiento}} </td>	
										<th style="display:none;" >{{$datos->cat_puesto}} </td>	
											<td style="background-color: #DBFFC2;" >{{$datos->categoria}} </td>	
											<td style="background-color: #DBFFC2;">{{$datos->fecha_inicio}} </td>
											<td style="background-color: #DBFFC2;">{{$datos->fecha_termino}} </td>
											<td style="display:none;" >{{$datos->documentacion_entregada}} </td>	
											<td style="display:none;" >{{$datos->observaciones}} </td>	
											<td style="display:none;" >{{$datos->cct_2}} </td>	
											<td style="background-color: #DBFFC2;" >{{$datos->captura}} </td>	
											<td style="background-color: #DBFFC2;" >{{$datos->estado}} </td>
											@if($datos->pagos_registrados == "1")
											<td style="background-color: #18F306;">✔</td>
											@else
											<td style="background-color: #E74C3C;">X</td>
											@endif

											@if($datos->qna_actual == "1")
											<td style="background-color: #18F306;">✔</td>
											@else
											<td style="background-color: #E74C3C;">X</td>
											@endif


											<th style="display:none;" >{{$datos->ciclo}} </td>	
												<td style="display:none;" >{{$datos->nom_loc2}} </td>
												<td style="display:none;" >{{$datos->municipio2}} </td>
												<td style="display:none;" >{{$datos->region}} {{$datos->sostenimiento}} </td>
												<td style="display:none;" >{{$datos->cct}} </td>	
												<td style="display:none;" >{{$datos->nombre_escuela}} </td>
												<td style="display:none;" >{{$datos->nom_loc}} </td>
												<td style="display:none;" >{{$datos->municipio}} </td>	

												<td style="display:none;" >{{$datos->dias_trabajados}} </td>

												<td style="background-color: #DBFFC2;">
													<a href="{{URL::action('CapturaController@verInformacion',$datos->idcaptura.'/1')}}" class="btn btn-primary btn-sm" role="button"><i class="fa fa-eye"></i></a>    </td>
													<td style="display:none;" >{{$datos->updated_at}} </td>

													<td style="background-color: #DBFFC2;"> 
														<a href="{{URL::action('CambiosEstController@edit',$datos->id)}}" class="btn btn-primary btn -sm" role="button"><i class="fa fa-edit"></i></a>  
													</td>
													<td style="background-color: #DBFFC2;">
														<a class="btn btn-danger btn-sm" data-target="#modal-delete-{{$datos->id}}" data-toggle="modal" style="margin-right: 10px;"  role="button"><i class="fa fa-eraser"></i></a></
													</td>
													<td style="display:none;" >{{$datos->tipo_movimiento}} </td>
													<td style="background-color: #DBFFC2;">
														
													</td>


													@else
													<tr class="gradeX">									
														<td style="background-color: #FFE4E1;">{{$datos->region2}} {{$datos->sostenimiento}}</td>
														<td style="background-color: #FFE4E1;">{{$datos->rfc}} </td>
														<td style="background-color: #FFE4E1;">{{$datos->nombre}} </td>
														<td style="display:none;" >{{$datos->telefono}}</td>
														<td style="display:none;" >{{$datos->email}} </td>
														<td style="background-color: #FFE4E1;" >{{$datos->cct2}} </td>
														<td style="display:none;" >{{$datos->nombre_escuela2}} </td>	
														<th style="display:none;" >{{$datos->sostenimiento}} </td>	
															<th style="display:none;" >{{$datos->cat_puesto}} </td>	
																<td style="background-color: #FFE4E1;" >{{$datos->categoria}} </td>	
																<td style="background-color: #FFE4E1;">{{$datos->fecha_inicio}} </td>
																<td style="background-color: #FFE4E1;">{{$datos->fecha_termino}} </td>
																<td style="display:none;" >{{$datos->documentacion_entregada}} </td>	
																<td style="display:none;" >{{$datos->observaciones}} </td>	
																<td style="display:none;" >{{$datos->cct_2}} </td>	
																<td style="background-color: #FFE4E1;" >{{$datos->captura}} </td>	
																<td style="background-color: #FFE4E1;" >{{$datos->estado}} </td>
																@if($datos->pagos_registrados == "1")
																<td style="background-color: #18F306;">✔</td>
																@else
																<td style="background-color: #E74C3C;">X</td>
																@endif

																@if($datos->qna_actual == "1")
																<td style="background-color: #18F306;">✔</td>
																@else
																<td style="background-color: #E74C3C;">X</td>
																@endif


																<th style="display:none;" >{{$datos->ciclo}} </td>	
																	<td style="display:none;" >{{$datos->nom_loc2}} </td>							
																	<td style="display:none;" >{{$datos->municipio2}} </td>

																	<td style="display:none;" >{{$datos->region}} {{$datos->sostenimiento}}</td>
																	<td style="display:none;" >{{$datos->cct}} </td>
																	<td style="display:none;" >{{$datos->nombre_escuela}} </td>	
																	<td style="display:none;" >{{$datos->nom_loc}} </td>							
																	<td style="display:none;" >{{$datos->municipio}} </td>
																	<td style="display:none;" >{{$datos->dias_trabajados}} </td>




																	<td style="background-color: #FFE4E1;">
																		<a href="{{URL::action('CapturaController@verInformacion',$datos->idcaptura.'/1')}}" class="btn btn-primary btn-sm" role="button"><i class="fa fa-eye"></i></a>    </td>
																		<td style="display:none;" >{{$datos->updated_at}} </td>

																		<td style="background-color: #FFE4E1;"> 
																			<a href="{{URL::action('CambiosEstController@edit',$datos->id)}}" class="btn btn-primary btn -sm" role="button"><i class="fa fa-edit"></i></a>  
																		</td>
																		<td style="background-color: #FFE4E1;">
																			</
																		</td>
																		<td style="display:none;" >{{$datos->tipo_movimiento}} </td>

																		<td style="background-color: #FFE4E1;">
																			<a class="btn btn-sm btn-success tooltips" data-target="#modal-delete2-{{$datos->id}}" data-toggle="modal" style="margin-right: 10px;"  role="button"> <i class="glyphicon glyphicon-ok"></i></a>
																		</td>

																		@endif
																		@include('nomina.cambios.cambios_cct.estatal.modale')
																		@include('nomina.cambios.cambios_cct.estatal.modal')


																	</tr>														

																	@endforeach
																</tbody>
																<tfoot>
																	<tr>
																		<th></th> 
																		<th>Región</th>
																		<th>RFC </th>
																		<th>Nombre del Empleado</th>
																		<th style="display:none;" >Teléfono </th>
																		<th style="display:none;" >Email </th>
																		<th>CCT</th>
																		<th style="display:none;" >Sostenimiento</th>
																		<th style="display:none;" >Clave</th>
																		<th>Categoria</th>
																		<th>Contrato Actual</th>
																		<th>Contrato Fin</th>
																		<th style="display:none;" >Documentación Entregada </th>
																		<th style="display:none;" >Observaciónes </th>
																		<th style="display:none;" >CCT 2 </th>
																		<th>Captura</th>
																		<th>Estado</th>
																		<th>Pagos Reg</th>
																		<th>Qna Act</th>
																		<th style="display:none;" >Ciclo</th>
																		<th style="display:none;" >Localidad </th>
																		<th style="display:none;" >Municipio </th>							
																		<th style="display:none;" >Dias Trabajados </th>					
																		<th>Ver Datos</th>
																		<th style="display:none;" >Fecha de Actualización</th>
																		<th>Modificar</th>
																		<th>Desactivar</th>
																		<th style="display:none;" >Nombre Escuela</th>
																		<th style="display:none;" >Tipo de Movimiento</th>
																		<th>Activar</th>	
																	</tr>
																</tr>
															</tfoot>
															{!! $personal->render() !!}
														</table>

													</div><!--/table-responsive-->
												</div><!--/porlets-content-->
											</div><!--/block-web-->
										</div><!--/col-md-12-->
									</div><!--/row-->
								</div>
								@include('nomina.personal.modalreactivar')
								<script type="text/javascript">
									window.onload=function() {
										document.getElementById('searchText').focus();

									}

									var aux2 = [];
									function cambia5(x){

										var z = document.getElementById(x).checked;
										var j =document.getElementById(x).value;
										if (z == true){
											aux2.push(j);

										}else{
											var pos = aux2.indexOf(j);
											var elementoEliminado = aux2.splice(pos, 1);

										}
										document.getElementById('doc').value = aux2;
										var y = document.getElementById('doc').value;

									}
								</script>
								@endsection