@extends('layouts.principal')
@section('contenido')
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<div class="pull-left breadcrumb_admin clear_both">
	<div class="pull-left page_title theme_color">
		<h1>Rechazos Estatales </h1>
		<h2 class="">Rechazos Estatales</h2>
	</div>
	<div class="pull-right">
		<ol class="breadcrumb">
			<li ><a style="color: #808080" href="{{url('/')}}">Inicio</a></li>
			<li class="active">Tabla de Rechazos Estatales</a></li>
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
							<h2 class="content-header" style="margin-top: -5px;">&nbsp;&nbsp;<strong>Tabla de Rechazos</strong></h2>
							<br>
								@include('nomina.rechazos_est.search')

						</div>
						<div class="col-md-5">
							<div class="btn-group pull-right">
								<b>


									<div class="btn-group" style="margin-right: 10px;">
									<!--	<a class="btn btn-sm btn-success tooltips" href="{{ route('bancos.create')}}" style="margin-right: 10px;" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Registrar Nueva Nomina"> <i class="fa fa-plus"></i> Registrar </a>
									-->
										<a class="btn btn-sm btn-warning tooltips" href="{{ route('nomina.rechazosest.excel')}}" style="margin-right: 10px;" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Descargar"> <i class="fa fa-download"></i> Descargar </a>
										<a class="btn btn-primary btn-sm" href="{{URL::action('RechazosEstController@invoice','2020-2020')}}" target="_blank" style="margin-right: 10px;" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Descargar"> <i class="fa fa-print"></i> Generar PDF</a>



									</div>

								</a>
							</b>
						</div>
					</div>
				</div>
			</div>

			<div class="porlets-content">
				<div class="table-responsive">
					<table cellpadding="0" cellpadding="0" border="0"  class="display table table-bordered" id="hidden-table-info">
						<thead>
							<tr>
								<th>Número Empleado</th>
								<th>RFC</th>
								<th>Nombre Empleado</th>
								<th>PER</th>
								<th>DED</th>
								<th>Exp 6</th>
								<th>Qna pago</th>

              <!--	<td><center><b>Editar</b></center></td>
								<td><center><b>Borrar</b></center></td>
							-->
							</tr>
						</thead>
						<tbody>
						@foreach($rechazos  as $rechazo)
							<tr class="gradeX">

								<td>{{$rechazo->numemp}} </td>
								<td>{{$rechazo->rfcemp}}</td>
								<td>{{$rechazo->nomemp}}</td>
								<td>{{$rechazo->per}}</td>
								<td>{{$rechazo->ded}}</td>
								<td>{{$rechazo->exp_6}}</td>
								<td>{{$rechazo->qna_pago}}</td>


							<!--	<td>
									<center>
										<a class="btn btn-danger btn-sm" id="delete" data-target="#modal-delete-{{$rechazo->id}}" data-toggle="modal" style="margin-right: 10px;"  role="button"><i class="fa fa-eraser"></i></a></center>

									</center>
								</td> -->
								</td>
							</tr>

					@endforeach
						</tbody>
						<tfoot>
							<tr>
								<th>Número Empleado</th>
								<th>RFC</th>
								<th>Nombre Empleado</th>
								<th>PER</th>
								<th>DED</th>
								<th>Exp 6</th>
								<th>Qna pago</th>



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

</script>
@endsection
