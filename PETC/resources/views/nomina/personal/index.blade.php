@extends('layouts.principal')
@section('contenido')
<div class="pull-left breadcrumb_admin clear_both">
	<div class="pull-left page_title theme_color">
		<h1>Lista de Empleados Registrados en SEDUZAC </h1>
		<h2 class="">Empleados SEDUZAC</h2>
	</div>
	<div class="pull-right">
		<ol class="breadcrumb">
			<li ><a style="color: #808080" href="{{url('/personal')}}">Inicio</a></li>
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
							<h2 class="content-header" style="margin-top: -5px;">&nbsp;&nbsp;<strong>Empleados SEDUZAC </strong></h2>
							@include('nomina.personal.search')
						</div>
						<div class="col-md-5">
							<div class="btn-group pull-right">
								<b>

									<div class="btn-group" style="margin-right: 10px;">
										<a class="btn btn-sm btn-success tooltips" href="{{ route('personal.create')}}" style="margin-right: 10px;" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Registrar Nuevo CT"> <i class="fa fa-plus"></i> Registrar </a>


										<a class="btn btn-sm btn-warning tooltips" href="{{ route('nomina.personal.excel')}}" style="margin-right: 10px;" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Descargar"> <i class="fa fa-download"></i> Descargar </a>  										


									</div>								
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
									<th>RFC </th>
									<th>Nombre del Empleado</th>
									<th>Teléfono</th>
									<th>Email</th>
									<th>Clave</th>
									<th>Ver Datos Completos&nbsp; &nbsp;</th>
									<th>Captura</th>
									<th>Modificado</th>
									<td><center><b>Editar</b></center></td>
									<td><center><b>Borrar</b></center></td> 
								</tr>
							</thead>
							<tbody>
								@foreach($personal  as $datos)
								<tr class="gradeX">
									<td>{{$datos->rfc}} </td>
									<td>{{$datos->nombre}} </td>
									<td>{{$datos->telefono}} </td>
									<td>{{$datos->email}}</td>
									<td>{{$datos->cat_puesto}} </td>									
									<td >
										<a href="{{URL::action('PersonalController@verInformacion',$datos->id)}}" class="btn btn-primary btn-sm" role="button"><i class="fa fa-eye"></i></a>    </td>
										<td>{{$datos->captura}}</td>
										<td>{{$datos->updated_at}} </td>

										<td> 
											<a href="{{URL::action('PersonalController@edit',$datos->id)}}" class="btn btn-primary btn-sm" role="button"><i class="fa fa-edit"></i></a>  
										</td>
										<td>
											<a class="btn btn-danger btn-sm" data-target="#modal-delete-{{$datos->id}}" data-toggle="modal" style="margin-right: 10px;"  role="button"><i class="fa fa-eraser"></i></a></
										</td>
									</tr>
									@include('nomina.personal.modal')
									@endforeach
								</tbody>
								<tfoot>
									<tr>
										<th>RFC </th>
										<th>Nombre del Empleado</th>
										<th>Teléfono</th>
										<th>Email</th>
										<th>Clave</th>
										<th>Ver Datos Completos&nbsp; &nbsp;</th>
										<th>Captura</th>
										<th>Modificado</th>
										<td><center><b>Editar</b></center></td>
										<td><center><b>Borrar</b></center></td> 
									</tr>
								</tr>
							</tfoot>
						</table>
						{!! $personal->render() !!}
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
</script>
@endsection
