@extends('layouts.principal')
@section('contenido')
<div class="pull-left breadcrumb_admin clear_both">
	<div class="pull-left page_title theme_color">
		<h1>Actividades Recientes</h1>
		<h2 class="">Actividades Recientes</h2>
	</div>
	<div class="pull-right">
		<ol class="breadcrumb">
			<li ><a style="color: #808080" href="{{url('/actividad')}}">Inicio</a></li>
			<li class="active">Actividades Recientes</a></li>
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
							<h2 class="content-header" style="margin-top: -5px;">&nbsp;&nbsp;<strong>Actividades Recientes: </strong></h2>
							@include('administrativa.actividad.search')

						</div> 
						<div class="col-md-5">
							<div class="btn-group pull-right">
								<b>

									<div class="btn-group" style="margin-right: 10px;">
										<a class="btn btn-sm btn-success tooltips" href="{{ route('actividad.create')}}" style="margin-right: 10px;" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Registrar Nuevo Aviso"> <i class="fa fa-plus"></i> Registrar </a>
										<a class="btn btn-sm btn-warning tooltips" href="{{ route('administrativa.actividad.excel',2)}}" id="excel" style="margin-right: 10px;" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Descargar"> <i class="fa fa-download"></i> Descargar </a>
										
									</div>
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

									<th>Nombre Actividad </th>
									<th>Lugar</th>
									<th>Fecha</th>
									<th >Área</th>
									<th >Motivo</th>
									<th >Descripción</th>
									<th >Ciclo</th>
									<th>Estado</th>
									<th >Captura</th>
									<th>Archivo</th>									
									<th>Modificar</th>
									<th>Borrar</th>
								</tr>
							</thead>
							<tbody>
								@foreach($actividad  as $actividad)
									<tr class="gradeX">

								
									<td>{{$actividad->nombre_actividad}} </td>
									<td>{{$actividad->lugar}}</td>
									<td>{{$actividad->fecha}}</td>					
									<td>{{$actividad->area}}</td>						
									<td>{{$actividad->motivo}}</td>
									<td>{{$actividad->descripcion}}</td>
									<td >{{$actividad->ciclo}}</td>
									<td >{{$actividad->estado}}</td>
									<td >{{$actividad->captura}}</td>
									<td >	@if(($actividad->archivo)!="")										
 
										<a target="_blank"   href="{{asset('img/administrativa/actividad/'.$actividad->archivo)}}"><img src="{{asset('img/administrativa/actividad/'.$actividad->archivo)}}" alt="{{$actividad->archivo}}" height="100px" width="100px" class="img-thumbnail"></a>


										@else
										No Hay Imagen Disponible
										@endif</td>								

										<td >
											<center>
												<a href="{{URL::action('ActividadController@edit',$actividad->id)}}" id="edit"  title="Editar" class="btn btn-primary btn-sm" role="button"><i class="fa fa-edit"></i></a>

											</center>
										</td>

										<td >
											<center>
												<a class="btn btn-danger btn-sm" data-target="#modal-delete-{{$actividad->id}}" data-toggle="modal" style="margin-right: 10px;"  role="button"><i class="fa fa-eraser"></i></a></center>							
											</td>



		</tr>
					
										@include('administrativa.actividad.modal')
										@endforeach
									</tbody>

									<tfoot>
										<tr>

											<th>Nombre Aviso </th>
											<th>Dirigido</th>
											<th>Fecha</th>
											<th >Área</th>
											<th >Motivo</th>
											<th >Descripción</th>
											<th >Ciclo</th>
											<th>Estado</th>
											<th >Captura</th>
											<th>Archivo</th>									
											<th>Modificar</th>
											<th>Borrar</th>
										</tr>
									</tfoot>

								</table>


							</div><!--/table-responsive-->
						</div><!--/porlets-content-->
					</div><!--/block-web-->
				</div><!--/col-md-12-->
			</div><!--/row-->
		</div>
		
		@endsection
