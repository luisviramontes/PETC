@extends('layouts.principal')
@section('contenido')
<div class="pull-left breadcrumb_admin clear_both">
	<div class="pull-left page_title theme_color">
		<h1>Ciclo Escolar </h1>
		<h2 class="">Ciclos</h2>
	</div>
	<div class="pull-right">
		<ol class="breadcrumb">
			<li ><a style="color: #808080" href="{{url('/')}}">Inicio</a></li>
			<li class="active">Tabla de Ciclos Escolares</a></li>
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
							<h2 class="content-header" style="margin-top: -5px;">&nbsp;&nbsp;<strong>Tabla de Ciclos Escolares</strong></h2>
							<br>
								@include('nomina.ciclo_escolar.search')
						</div>
						<div class="col-md-5">
							<div class="btn-group pull-right">
								<b>

									<div class="btn-group" style="margin-right: 10px;">
											<a class="btn btn-sm btn-success tooltips" href="{{ route('ciclo_escolar.create')}}" style="margin-right: 10px;" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Registrar Nuevo Ciclo Escolar"> <i class="fa fa-plus"></i> Registrar </a>
											<a class="btn btn-sm btn-warning tooltips" href="{{ route('nomina.ciclo_escolar.excel')}}" style="margin-right: 10px;" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Descargar"> <i class="fa fa-download"></i> Descargar </a>
											<a class="btn btn-primary btn-sm" href="{{URL::action('CicloEscolarController@invoice','2018-2019')}}" style="margin-right: 10px;" target="_blank"  data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Descargar"> <i class="fa fa-print"></i> Generar PDF</a>

									</div>

								</a>
							</b>
						</div>
					</div>
				</div>
			</div>

			<div class="porlets-content">
				<div class="table-responsive">
					<table cellpadding="0" cellpadding="0" border="0"  class="display table table-bordered" id="dynamic-table">
						<thead>
							<tr>

								<th>Dias Habiles</th>
								<th>Ciclo </th>
								<th>Inicio Ciclo</th>
								<th>Fin Ciclo</th>
								<th>Estado</th>
								<th>Captura</th>



								<td><center><b>Editar</b></center></td>
								<td><center><b>Borrar</b></center></td>
							</tr>
						</thead>
						<tbody>
						@foreach($ciclos  as $ciclo)
						@if ($ciclo->estado == "ACTIVO")
							<tr class="gradeX">

								<td style="background-color:#DBFFC2;" >{{$ciclo->dias_habiles}} </td>
								<td style="background-color:#DBFFC2;" >{{$ciclo->ciclo}} </td>
								<td style="background-color:#DBFFC2;" >{{$ciclo->inicio_ciclo}} </td>
								<td style="background-color:#DBFFC2;" >{{$ciclo->fin_ciclo}} </td>
								<td style="background-color:#DBFFC2;" >{{$ciclo->estado}}</td>
								<td style="background-color:#DBFFC2;" >{{$ciclo->capturo}}</td>
								<!-- //////////////////////////////////////////////////////////////////// -->



								<td style="background-color:#DBFFC2;">
									<center>
										<a href="{{URL::action('CicloEscolarController@edit',$ciclo->id)}}" id="edit" onchange="" title="Editar" class="btn btn-primary btn-sm" role="button"><i class="fa fa-edit"></i></a>

									</center>
								</td>

									<!-- //////////////////////////////////////////////////////////////////// -->


								<td style="background-color:#DBFFC2;">
									<center>
										<a class="btn btn-danger btn-sm" data-target="#modal-delete-{{$ciclo->id}}" data-toggle="modal" style="margin-right: 10px;"  role="button"><i class="fa fa-eraser"></i></a></center>

									</center>
									</td>
								</td>

							</tr>
							@else
							<!-- /////////////if color else //////////////////////////7-->
							<tr class="gradeX">

								<td style="background-color:#FFE4E1;" >{{$ciclo->dias_habiles}} </td>
								<td style="background-color:#FFE4E1;" >{{$ciclo->ciclo}} </td>
								<td style="background-color:#FFE4E1;" >{{$ciclo->inicio_ciclo}} </td>
								<td style="background-color:#FFE4E1;" >{{$ciclo->fin_ciclo}} </td>
								<td style="background-color:#FFE4E1;" >{{$ciclo->estado}}</td>


								<td>{{$ciclo->capturo}}</td>
								<!-- //////////////////////////////////////////////////////////////////// -->


								<td>
									<center>
										<a href="{{URL::action('CicloEscolarController@edit',$ciclo->id)}}" id="edit" onchange="" title="Editar" class="btn btn-primary btn-sm" role="button"><i class="fa fa-edit"></i></a>

									</center>
								</td>

									<td>
									<center>
										<a class="btn btn-danger btn-sm" data-target="#modal-delete-{{$ciclo->id}}" data-toggle="modal" style="margin-right: 10px;"  role="button"><i class="fa fa-eraser"></i></a></center>

									</center>
									</td>
								</td>

							</tr>
							@endif
								  @include('nomina.ciclo_escolar.modal')
							@endforeach
						</tbody>
						<tfoot>
							<tr>
								<th>Dias Habiles</th>
								<th>Ciclo </th>
								<th>Inicio Ciclo</th>
								<th>Fin Ciclo</th>
								<th>Estado</th>
								<th>Captura</th>


								<td><center><b>Editar</b></center></td>
								<td><center><b>Borrar</b></center></td>
							</tr>
						</tfoot>
					</table>
					{!! $ciclos->render() !!}
				</div><!--/table-responsive-->
			</div><!--/porlets-content-->
		</div><!--/block-web-->
	</div><!--/col-md-12-->
</div><!--/row-->
</div>
@endsection
