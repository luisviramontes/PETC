@extends('layouts.principal')
@section('contenido')
<div class="pull-left breadcrumb_admin clear_both">
	<div class="pull-left page_title theme_color">
		<h1>Quejas y Denuncias </h1>
		<h2 class="">Quejas y Denuncias</h2>
	</div>
	<div class="pull-right">
		<ol class="breadcrumb">
			<li ><a style="color: #808080" href="{{url('/quejas')}}">Inicio</a></li>
			<li class="active">Quejas y Denuncias</a></li>
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
							<h2 class="content-header" style="margin-top: -5px;">&nbsp;&nbsp;<strong>Quejas y Denuncias </strong></h2>
							@include('administrativa.quejas.search')
						</div>
						<div class="col-md-5"> 
							<div class="btn-group pull-right">
								<b>

									<div class="btn-group" style="margin-right: 10px;">
										<a class="btn btn-sm btn-success tooltips" href="{{ route('quejas.create')}}" style="margin-right: 10px;" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Registrar Nueva Queja"> <i class="fa fa-plus"></i> Registrar </a>


										<a class="btn btn-sm btn-warning tooltips" href="{{ route('administrativa.quejas.excel','2')}}"  id="excel" style="margin-right: 10px;" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Descargar"> <i class="fa fa-download"></i> Descargar </a> 
										




									</div>

								</a>
							</b>
						</div>
					</div>
				</div>
			</div>

			<div class="porlets-content">
				<div class="table-responsive">
				<table cellpadding="0" cellspacing="0" border="0"  class="display table table-bordered " id="hidden-table-info22" >
						<thead>
							<tr>
								<th>CCT </th>
								<th>Nombre Escuela</th>
								<th>Motivo </th>
								<th style="display:none;" >Descripción </th>
								<th>Fecha Denuncia </th>
								<th style="display:none;" >Nombre de Quien Denuncia </th>
								<th style="display:none;" >Teléfono </th>
								<th style="display:none;" >Ocupación </th>
								<th style="display:none;" >Servidor Publico Contra Quien se Denuncia </th>
								<th style="display:none;" >Puesto </th>
								<th>Ver</th>
								<th>Estado</th>
								<th>Captura</th>
								<th>Ciclo Escolar</th>
								<td><center><b>Borrar</b></center></td>
								<td><center><b>Resuelto</b></center></td>
								
							</tr>
						</thead>
						<tbody>
							@foreach($quejas  as $quejas)
							@if ($quejas->estado == "RESUELTO")
							<tr class="gradeA">

								<td style="background-color: #DBFFC2;">{{$quejas->cct}} </td>
								<td style="background-color: #DBFFC2;">{{$quejas->nombre_escuela}} </td>
								<td style="background-color: #DBFFC2;">{{$quejas->motivo}}</td>
								<td style="display:none;" >{{$quejas->descripcion}}</td>
								<td style="background-color: #DBFFC2;">{{$quejas->fecha}}</td>
								<td style="display:none;" >{{$quejas->nombre_d}} </th>
									<td style="display:none;" >{{$quejas->telefono_}} </td>
									<td style="display:none;" >{{$quejas->ocupacion}} </td>
									<td style="display:none;" >{{$quejas->nombre_q}} </th>
										<td style="display:none;" >{{$quejas->puesto_q}} </td>
										<td style="background-color: #DBFFC2;">ver </td>
										<td style="background-color: #DBFFC2;">{{$quejas->estado}} </th>
											<td style="background-color: #DBFFC2;">{{$quejas->captura}} </td>
											<td style="background-color: #DBFFC2;">{{$quejas->ciclo}} </td>
											<td style="background-color: #DBFFC2;">
												<center>
													<a class="btn btn-danger btn-sm" data-target="#modal-delete-{{$quejas->id}}" data-toggle="modal" style="margin-right: 10px;"  role="button"><i class="fa fa-eraser"></i></a></center>
												</td>	
											<td style="background-color: #DBFFC2;">
													<a class="btn btn-sm btn-success tooltips" data-target="#modal-delete2-{{$quejas->id}}" data-toggle="modal" style="margin-right: 10px;"  role="button"> <i class="glyphicon glyphicon-ok"></i></a>
												</td>					
											</tr>
											@else
											<tr class="gradeA">
												<td style="background-color: #FFE4E1;">{{$quejas->cct}} </td>
												<td style="background-color: #FFE4E1;">{{$quejas->nombre_escuela}} </td>
												<td style="background-color: #FFE4E1;">{{$quejas->motivo}}</td>
												<td style="display:none;" >{{$quejas->descripcion}}</td>
												<td style="background-color: #FFE4E1;">{{$quejas->fecha}}</td>
												<td style="display:none;" >{{$quejas->nombre_d}} </th>
													<td style="display:none;" >{{$quejas->telefono_}} </td>
													<td style="display:none;" >{{$quejas->ocupacion}} </td>
													<td style="display:none;" >{{$quejas->nombre_q}} </th>
														<td style="display:none;" >{{$quejas->puesto_q}} </td>
														<td style="background-color: #FFE4E1;">
										@if(($quejas->archivo)!="")
										<a href="/img/denuncias/{{$quejas->archivo}}"  target="_blank" class="btn btn-info btn-lg">
											<span class="glyphicon glyphicon-picture"> </span>Ver
										</a>
										@else									

										<a class="btn btn-info btn-lg" data-target="#modal-delete3-{{$quejas->id}}" data-toggle="modal" style="margin-right: 10px;"  role="button"><i class="glyphicon glyphicon-picture"></i>Subir</a>

										@endif </td>
														<td style="background-color: #FFE4E1;">{{$quejas->estado}} </th>
															<td style="background-color: #FFE4E1;">{{$quejas->captura}} </td>
															<td style="background-color: #FFE4E1;">{{$quejas->ciclo}} </td>
															<td style="background-color: #FFE4E1;">
																<center>
																	<a class="btn btn-danger btn-sm" data-target="#modal-delete-{{$quejas->id}}" data-toggle="modal" style="margin-right: 10px;"  role="button"><i class="fa fa-eraser"></i></a></center>
																</td>			
											<td style="background-color: #FFE4E1;">
													<a class="btn btn-sm btn-success tooltips" data-target="#modal-delete2-{{$quejas->id}}" data-toggle="modal" style="margin-right: 10px;"  role="button"> <i class="glyphicon glyphicon-ok"></i></a>
												</td>							
															</tr>

															@endif
															@include('administrativa.quejas.modal')
														    @include('administrativa.quejas.modale')
															@endforeach
														</tbody>
														<tfoot>
															<tr>
															<th></th> 
																<th>CCT </th>
																<th>Nombre Escuela</th>
																<th>Motivo </th>
																<th style="display:none;" >Descripción </th>
																<th>Fecha Denuncia </th>
																<th style="display:none;" >Nombre de Quien Denuncia </th>
																<th style="display:none;" >Teléfono </th>
																<th style="display:none;" >Ocupación </th>
																<th style="display:none;" >Servidor Publico Contra Quien se Denuncia </th>
																<th style="display:none;" >Puesto </th>
																<th>Ver</th>
																<th>Estado</th>
																<th>Captura</th>
																<th>Ciclo Escolar</th>
																<td><center><b>Borrar</b></center></td>
																<td><center><b>Resuelto</b></center></td>																
															</tr>
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
		window.onload=function(){

      //document.getElementById('invoice').href="/pdf-cuadros-cifras/"+x; 
  var x =document.getElementById('ciclo_escolar').value;
  document.getElementById('excel').href="/descargar-quejas/"+x;

  }



  </script>

						@endsection


