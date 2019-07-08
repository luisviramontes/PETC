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
							<h2 class="content-header" style="margin-top: -5px;">&nbsp;&nbsp;<strong>RECLAMOS PENDIENTES: {{$contador}}</strong></h2>
							@include('nomina.reclamos.search')
							<div class="form-group">
								<label class="col-sm-3 control-label">Seleccione Ciclo Escolar: <strog class="theme_color"></strog></label>
								<div class="col-sm-6">
									<select name="ciclo_escolar" id="ciclo_escolar" class="form-control select2" onchange="enviar_ciclo2();" >
										@foreach($ciclos as $ciclo)
										@if($ciclo->id == $id)
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
						<div class="col-md-5">
							<div class="btn-group pull-right">
								<b>

									<div class="btn-group" style="margin-right: 10px;">
										<a class="btn btn-sm btn-success tooltips" href="{{ route('reclamos.create')}}" style="margin-right: 10px;" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Registrar Nuevo Empleado"> <i class="fa fa-plus"></i> Registrar </a>


										<a class="btn btn-sm btn-warning tooltips" href="{{ route('nomina.reclamos.excel',$id)}}" style="margin-right: 10px;" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Descargar"> <i class="fa fa-download"></i> Descargar </a>  										


									</div>								
								</b>
							</div>
						</div>
					</div>
				</div> 

				<div class="porlets-content" >
					<div class="table-responsive">
						<table cellpadding="0" cellspacing="0" border="0"  class="display table table-bordered " id="hidden-table-info13" >
							<thead>    
								<tr>
									<th>RFC</th>
									<th>Nombre del Empleado </th>
									<th>CCT</th>
									<th style="display:none;" >Teléfono </th>
									<th style="display:none;" >Email </th>
									<th>Region</th>
									<th style="display:none;" >Motivo</th>
									<th style="display:none;" >Clave</th>
									<th>Categoria</th>
									<th>Peridio Reclamo Inicial</th>
									<th>Peridio Reclamo Inicial</th>
									<th>Total de Dias Habiles</th>
									<th>Monto Total</th>
									<th style="display:none;" >Ciclo Escolar </th>
									<th style="display:none;" >Observaciones </th>
									<th style="display:none;" >Num. Oficio </th>
									<th style="display:none;" >Observaciónes </th>
									<th style="display:none;" >CCT 2 </th>
									<th style="display:none;" >Captura</th>
									<th>Monto Total</th>
									<th>Estado</th>
									<th>Qna Act</th>
									<th style="display:none;" >Ciclo</th>
									<th style="display:none;" >Localidad </th>
									<th style="display:none;" >Municipio </th>							
									<th style="display:none;" >Dias Trabajados </th>					
									<th>Ver reclamos</th>
									<th style="display:none;" >Fecha de Actualización</th>
									<th>Modificar</th>
									<th>Desactivar</th>		
									<th style="display:none;" >Nombre de Escuela</th>
									<th style="display:none;" >Tipo de Movimiento</th>	
									<th>Aplicar</th>
									<th style="display:none;" >Ver Inasistencias</th>

									
									
								</tr>
							</thead>
							<tbody>
								@foreach($reclamos  as $reclamos)
								@if ($reclamos->estado == "APLICADO")     
								<tr class="gradeX">
									<td style="background-color: #DBFFC2;">{{$reclamos->rfc}} </td>
									<td style="background-color: #DBFFC2;">{{$reclamos->nombre}} </td>
									<td style="background-color: #DBFFC2;" >{{$reclamos->cct}} </td>
									<td style="display:none;" >{{$reclamos->telefono}}</td>
									<td style="display:none;" >{{$reclamos->email}} </td>			
									<td style="background-color: #DBFFC2;">{{$reclamos->region}} {{$reclamos->sostenimiento}} </td>
									<th style="display:none;" >{{$reclamos->motivo}} </td>
									<th style="display:none;" >{{$reclamos->cat_puesto}} </td>
									<th style="display:none;" >{{$reclamos->sostenimiento}} </td>				
									<td style="background-color: #DBFFC2;" >{{$reclamos->categoria}} </td>
									<td style="background-color: #DBFFC2;">{{$reclamos->periodo_inicial}} </td>
									<td style="background-color: #DBFFC2;">{{$reclamos->periodo_final}}</td>
									<td style="background-color: #DBFFC2;">{{$reclamos->total_dias}} </td>
									<td style="background-color: #DBFFC2;">{{$reclamos->total_reclamo}} </td>
									<td style="display:none;" >{{$reclamos->observaciones}} </td>
									<td style="display:none;" >{{$reclamos->estado}} </td>

											
											
											<th style="display:none;" > {{$reclamos->ciclo_ina}}</td>
													<td style="display:none;" >{{$reclamos->documentacion_entregada}} </td>	
														
													<td style="display:none;" >{{$reclamos->cct_2}} </td>	
													<td style="display:none;" >{{$reclamos->captura}} </td>	
													<td style="background-color: #DBFFC2;" >{{$reclamos->estado}} </td>
													@if($reclamos->pagos_registrados == "1")
													<td style="background-color: #18F306;">✔</td>
													@else
													<td style="background-color: #E74C3C;">X</td>
													@endif

													@if($reclamos->qna_actual == "1")
													<td style="background-color: #18F306;">✔</td>
													@else
													<td style="background-color: #E74C3C;">X</td>
													@endif


													<th style="display:none;" >{{$reclamos->ciclo}} </td>	
														<td style="display:none;" >{{$reclamos->nom_loc}} </td>							
														<td style="display:none;" >{{$reclamos->municipio}} </td>							
														<td style="display:none;" >{{$reclamos->dias_trabajados}} </td>

														<td style="background-color: #DBFFC2;">
															<a href="{{URL::action('CapturaController@verInformacion',$reclamos->idcaptura.'/1')}}" class="btn btn-primary btn-sm" role="button"><i class="fa fa-eye"></i></a>    </td>
															<td style="display:none;" >{{$reclamos->updated_at}} </td>

															<td style="background-color: #DBFFC2;"> 
																<a href="{{URL::action('InasistenciasController@edit',$reclamos->id)}}" class="btn btn-primary btn -sm" role="button"><i class="fa fa-edit"></i></a>  
															</td>
															<td style="background-color: #DBFFC2;">
																<a class="btn btn-danger btn-sm" data-target="#modal-delete-{{$reclamos->id}}" data-toggle="modal" style="margin-right: 10px;"  role="button"><i class="fa fa-eraser"></i></a></
															</td>
															<td style="display:none;" >{{$reclamos->nombre_escuela}} </td>	
															<td style="display:none;" >{{$reclamos->tipo_movimiento}} </td>
															<td style="background-color: #DBFFC2;">	</td>
															<td style="display:none;" ><a href="{{URL::action('InasistenciasController@verInformacion',$reclamos->idcaptura.'/1')}}" class="btn btn-primary btn-sm" role="button"><i class="fa fa-eye"></i></a>    </td>



															@else
															<tr class="gradeX">									
																<td style="background-color: #FFE4E1;">{{$reclamos->region}} {{$reclamos->sostenimiento}}</td>
																<td style="background-color: #FFE4E1;">{{$reclamos->rfc}} </td>
																<td style="background-color: #FFE4E1;">{{$reclamos->nombre}} </td>
																<td style="display:none;" >{{$reclamos->telefono}}</td>
																<td style="display:none;" >{{$reclamos->email}} </td>
																<td style="background-color: #FFE4E1;" >{{$reclamos->cct}} </td>	
																<th style="display:none;" >{{$reclamos->sostenimiento}} </td>	
																	<th style="display:none;" >{{$reclamos->cat_puesto}} </td>	
																		<td style="background-color: #FFE4E1;" >{{$reclamos->categoria}} </td>	
																		<td style="background-color: #FFE4E1;">{{$reclamos->fecha_inicio}} </td>
																		<td style="background-color: #FFE4E1;">{{$reclamos->fecha_termino}} </td>
																		<td style="background-color: #FFE4E1;">{{$reclamos->dia}} {{$reclamos->mes}}</td>	
																		<th style="display:none;" > {{$reclamos->ciclo_ina}}</td>
																			<th style="display:none;" > {{$reclamos->observaciones_ina}}</td>

																				<td style="display:none;" >{{$reclamos->documentacion_entregada}} </td>	
																				<td style="display:none;" >{{$reclamos->observaciones}} </td>	
																				<td style="display:none;" >{{$reclamos->cct_2}} </td>	
																				<td style="display:none;" >{{$reclamos->captura}} </td>	
																				<td style="background-color: #FFE4E1;" >{{$reclamos->estado}} </td>
																				@if($reclamos->pagos_registrados == "1")
																				<td style="background-color: #18F306;">✔</td>
																				@else
																				<td style="background-color: #E74C3C;">X</td>
																				@endif

																				@if($reclamos->qna_actual == "1")
																				<td style="background-color: #18F306;">✔</td>
																				@else
																				<td style="background-color: #E74C3C;">X</td>
																				@endif


																				<th style="display:none;" >{{$reclamos->ciclo}} </td>	
																					<td style="display:none;" >{{$reclamos->nom_loc}} </td>							
																					<td style="display:none;" >{{$reclamos->municipio}} </td>							
																					<td style="display:none;" >{{$reclamos->dias_trabajados}} </td>



																					<td style="background-color: #FFE4E1;">
																						<a href="{{URL::action('CapturaController@verInformacion',$reclamos->idcaptura.'/1')}}" class="btn btn-primary btn-sm" role="button"><i class="fa fa-eye"></i></a>    </td>
																						<td style="display:none;" >{{$reclamos->updated_at}} </td>

																						<td style="background-color: #FFE4E1;"> 
																							<a href="{{URL::action('InasistenciasController@edit',$reclamos->id)}}" class="btn btn-primary btn -sm" role="button"><i class="fa fa-edit"></i></a>  
																						</td>
																						<td style="background-color: #FFE4E1;">
																							</
																						</td>
																						<td style="display:none;" >{{$reclamos->nombre_escuela}} </td>
																						<td style="display:none;" >{{$reclamos->tipo_movimiento}} </td>

																						<td style="background-color: #FFE4E1;">
																							<a class="btn btn-sm btn-success tooltips" data-target="#modal-delete2-{{$reclamos->id}}" data-toggle="modal" style="margin-right: 10px;"  role="button"> <i class="glyphicon glyphicon-ok"></i></a>
																						</td>
																						<td style="display:none;" ><a href="{{URL::action('InasistenciasController@verInformacion',$reclamos->idcaptura.'/1')}}" class="btn btn-primary btn-sm" role="button"><i class="fa fa-eye"></i></a>    </td>


																						@endif
																						@include('nomina.inasistencias.modale')
																						@include('nomina.inasistencias.modal')


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
																						<th>Fecha Inasistencia</th>
																						<th style="display:none;" >Ciclo Escolar </th>
																						<th style="display:none;" >Observaciones </th>
																						<th style="display:none;" >Documentación Entregada </th>
																						<th style="display:none;" >Observaciónes </th>
																						<th style="display:none;" >CCT 2 </th>
																						<th style="display:none;" >Captura</th>
																						<th>Estado</th>
																						<th>Pagos Reg</th>
																						<th>Qna Act</th>
																						<th style="display:none;" >Ciclo</th>
																						<th style="display:none;" >Localidad </th>
																						<th style="display:none;" >Municipio </th>							
																						<th style="display:none;" >Dias Trabajados </th>					
																						<th>Ver reclamos</th>
																						<th style="display:none;" >Fecha de Actualización</th>
																						<th>Modificar</th>
																						<th>Desactivar</th>
																						<th style="display:none;" >Nombre Escuela</th>
																						<th style="display:none;" >Tipo de Movimiento</th>
																						<th>Aplicar</th>
																						<th style="display:none;" >Ver Inasistencias</th>

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
