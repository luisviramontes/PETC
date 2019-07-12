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
									<select name="ciclo_escolar" id="ciclo_escolar" class="form-control select2" onchange="enviar_ciclo5();" >
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

										<a class="btn btn-primary btn-sm"  href="{{URL::action('ReclamosController@ver_reclamos')}}" style="margin-right: 10px;" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Cancelar"> <i class="fa fa-eye"></i> Ver Reclamos</a>
										


									</div>								
								</b>
							</div>
						</div>
					</div>
				</div> 

				<div class="porlets-content" >
					<div class="table-responsive">
						<table cellpadding="0" cellspacing="0" border="0"  class="display table table-bordered " id="hidden-table-info14" >
							<thead>    
								<tr>
									<th>RFC</th>
									<th>Nombre del Empleado </th>
									<th>CCT</th>
									<th style="display:none;" >Nombre Escuela </th>
									<th style="display:none;" >Teléfono </th>
									<th style="display:none;" >Email </th>
									<th>Region</th>
									<th style="display:none;" >Sostenimiento</th>
									<th style="display:none;" >Motivo</th>
									<th style="display:none;" >Clave</th>
									<th>Categoria</th>
									<th>Periodo Reclamo Inicial</th>
									<th>Periodo Reclamo Inicial</th>
									<th>Total de Dias Habiles</th>
									<th>Monto Total</th>						
									<th style="display:none;" >Observaciones </th>
									<th style="display:none;" >Num. Oficio </th>
									<th style="display:none;" >Captura</th>								
									<th>Estado</th>	
									<th style="display:none;" >Ciclo</th>
									<th style="display:none;" >Localidad </th>
									<th style="display:none;" >Municipio </th>							
									<th style="display:none;" >Dias Trabajados </th>					
									<th>Ver Historial</th>
									<th style="display:none;" >Fecha de Actualización</th>
									<th>Modificar</th>
									<th>Desactivar</th>		
									<th style="display:none;" >Nombre de Escuela</th>
									<th style="display:none;" >Tipo de Movimiento</th>	
									<th>Aplicar</th>
									<th style="display:none;" >fecha_icaptura</th>
									<th style="display:none;" >fecha_fcaptura</th>
									<th style="display:none;" >cobervaciones</th>

									
									
								</tr>
							</thead>
							<tbody>
								@foreach($reclamos  as $reclamos)
								@if ($reclamos->estado == "APLICADO")     
								<tr class="gradeX">
									<td style="background-color: #DBFFC2;">{{$reclamos->rfc}} </td>
									<td style="background-color: #DBFFC2;">{{$reclamos->nombre}} </td>
									<td style="background-color: #DBFFC2;" >{{$reclamos->cct}} </td>
										<td style="display:none;" >{{$reclamos->nombre_escuela}}</td>
									<td style="display:none;" >{{$reclamos->telefono}}</td>
									<td style="display:none;" >{{$reclamos->email}} </td>			
									<td style="background-color: #DBFFC2;">{{$reclamos->region}} {{$reclamos->sostenimiento}} </td>
									<td style="display:none;" >{{$reclamos->sostenimiento}} </td>	
									<td style="display:none;" >{{$reclamos->motivo}} </td>
									<td style="display:none;" >{{$reclamos->cat_puesto}} </td>				
									<td style="background-color: #DBFFC2;" >{{$reclamos->categoria}} </td>
									<td style="background-color: #DBFFC2;">{{$reclamos->periodo_inicial}} </td>
									<td style="background-color: #DBFFC2;">{{$reclamos->periodo_final}}</td>
									<td style="background-color: #DBFFC2;">{{$reclamos->total_dias}} Dias</td>
									<td style="background-color: #DBFFC2;">${{$reclamos->total_reclamo}}.000 </td>
									<td style="display:none;" >{{$reclamos->observaciones}} </td>
									<td style="display:none;" >{{$reclamos->oficio}} </td>
									<td style="display:none;" >{{$reclamos->captura}} </td>
									<td style="background-color: #DBFFC2;">{{$reclamos->estado}} </td>
									<td style="display:none;" > {{$reclamos->ciclo}}</td>
									<td style="display:none;" >{{$reclamos->nom_loc}} </td>	
									<td style="display:none;" >{{$reclamos->municipio}} </td>
									<td style="display:none;" >{{$reclamos->dias_trabajados}} </td>	
									<td style="background-color: #DBFFC2;">
									<a href="{{URL::action('CapturaController@verInformacion',$reclamos->id_captura.'/1')}}" class="btn btn-primary btn-sm" role="button"><i class="fa fa-eye"></i></a></td>
									<td style="display:none;" >{{$reclamos->updated_at}} </td>
									<td style="background-color: #DBFFC2;"> 
									<a href="{{URL::action('ReclamosController@edit',$reclamos->id)}}" class="btn btn-primary btn -sm" role="button"><i class="fa fa-edit"></i></a>  
									</td>
									<td style="background-color: #DBFFC2;">
									<a class="btn btn-danger btn-sm" data-target="#modal-delete-{{$reclamos->id}}" data-toggle="modal" style="margin-right: 10px;"  role="button"><i class="fa fa-eraser"></i></a></</td>
									<td style="display:none;" >{{$reclamos->nombre_escuela}} </td>	
									<td style="display:none;" >{{$reclamos->tipo_movimiento}} </td>
									<td style="background-color: #DBFFC2;">	</td>									
									<td style="display:none;" >{{$reclamos->fecha_icaptura}} </td>
									<td style="display:none;" >{{$reclamos->fecha_tcaptura}} </td>
									<td style="display:none;" >{{$reclamos->cobservaciones}} </td>


									@else
									<tr class="gradeX">									
									<td style="background-color: #FFE4E1;">{{$reclamos->rfc}} </td>
									<td style="background-color: #FFE4E1;">{{$reclamos->nombre}} </td>
									<td style="background-color: #FFE4E1;" >{{$reclamos->cct}} </td>
										<td style="display:none;" >{{$reclamos->nombre_escuela}}</td>
									<td style="display:none;" >{{$reclamos->telefono}}</td>
									<td style="display:none;" >{{$reclamos->email}} </td>			
									<td style="background-color: #FFE4E1;">{{$reclamos->region}} {{$reclamos->sostenimiento}} </td>
									<td style="display:none;" >{{$reclamos->sostenimiento}} </td>	
									<td style="display:none;" >{{$reclamos->motivo}} </td>
									<td style="display:none;" >{{$reclamos->cat_puesto}} </td>				
									<td style="background-color: #FFE4E1;" >{{$reclamos->categoria}} </td>
									<td style="background-color: #FFE4E1;">{{$reclamos->periodo_inicial}} </td>
									<td style="background-color: #FFE4E1;">{{$reclamos->periodo_final}}</td>
									<td style="background-color: #FFE4E1;">{{$reclamos->total_dias}} Dias </td>
									<td style="background-color: #FFE4E1;">${{$reclamos->total_reclamo}}.000 </td>
									<td style="display:none;" >{{$reclamos->observaciones}} </td>
									<td style="display:none;" >{{$reclamos->oficio}} </td>
									<td style="display:none;" >{{$reclamos->captura}} </td>
									<td style="background-color: #FFE4E1;">{{$reclamos->estado}} </td>
									<td style="display:none;" > {{$reclamos->ciclo}}</td>
									<td style="display:none;" >{{$reclamos->nom_loc}} </td>	
									<td style="display:none;" >{{$reclamos->municipio}} </td>
									<td style="display:none;" >{{$reclamos->dias_trabajados}} </td>	
									<td style="background-color: #FFE4E1;">
									<a href="{{URL::action('CapturaController@verInformacion',$reclamos->id_captura.'/1')}}" class="btn btn-primary btn-sm" role="button"><i class="fa fa-eye"></i></a></td>
									<td style="display:none;" >{{$reclamos->updated_at}} </td>
									<td style="background-color: #FFE4E1;"> 
									<a href="{{URL::action('ReclamosController@edit',$reclamos->id)}}" class="btn btn-primary btn -sm" role="button"><i class="fa fa-edit"></i></a>  
									</td>
									<td style="background-color: #FFE4E1;">
									<a class="btn btn-danger btn-sm" data-target="#modal-delete-{{$reclamos->id}}" data-toggle="modal" style="margin-right: 10px;"  role="button"><i class="fa fa-eraser"></i></a></</td>
									<td style="display:none;" >{{$reclamos->nombre_escuela}} </td>	
									<td style="display:none;" >{{$reclamos->tipo_movimiento}} </td>
									<td style="background-color: #FFE4E1;">
									<a class="btn btn-sm btn-success tooltips" data-target="#modal-delete2-{{$reclamos->id}}" data-toggle="modal" style="margin-right: 10px;"  role="button"> <i class="glyphicon glyphicon-ok"></i></a></td>
									
									<td style="display:none;" >{{$reclamos->fecha_icaptura}} </td>
									<td style="display:none;" >{{$reclamos->fecha_tcaptura}} </td>
									<td style="display:none;" >{{$reclamos->cobservaciones}} </td>
                                    @endif			
									@include('nomina.reclamos.modal')
									@include('nomina.reclamos.modale')


									</tr>														

									@endforeach




									</tbody>
									<tfoot>
									<tr>
					
																														h>


																				</tr>
																			</tfoot>
																			
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

												
												</script>
												@endsection
