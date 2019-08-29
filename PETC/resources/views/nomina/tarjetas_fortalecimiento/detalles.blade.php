@extends('layouts.principal')
@section('contenido')
<div class="pull-left breadcrumb_admin clear_both">
	<div class="pull-left page_title theme_color">
		<h1>Inicio</h1>
		<h2 class="">Detalle de la Importacion</h2>
	</div>
	<div class="pull-right">
		<ol class="breadcrumb">
			<li ><a style="color: #808080" href="{{url('/almacenes/agroquimicos')}}">Inicio</a></li>
			<li class="active">Importación Exitosa</a></li>
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
							<h4 class="content-header " style="margin-top: -5px;">&nbsp;&nbsp;<strong>Importación Exitosa</strong></h4> <img src="{{asset('img/correcto.png')}}" alt="correcto" height="100px" width="100px" class="img-thumbnail">
						</div>
						<div class="btn-group pull-right">
							<b>
							<a class="btn btn-primary btn-sm" href="{{URL::action('TarjetasFortalecimientoController@generar_cartas')}}" style="margin-right: 10px;" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Descargar"> <i class="fa fa-print"></i> Generar Cartas Compromiso</a>
							
								<div class="btn-group" style="margin-right: 10px;">
									<a class="btn btn-sm btn-danger tooltips" href="{{url('tarjetas_fortalecimiento')}}" style="margin-right: 10px;" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Cancelar"> <i class="fa fa-times"></i> Salir</a>
								</div> 
							</b>
						</div>

					</div>
				</div>
				<div class="porlets-content container clear_both padding_fix">


					<h4 class="content-header " style="margin-top: -5px;">&nbsp;&nbsp;<strong>Registros Insertados Correctamente  <u> <b> <?php echo count($registrados) ?> </b> </u> </strong></h4>

					<h4 class="content-header " style="margin-top: -5px;">&nbsp;&nbsp;<strong>Registros Rechazados Por Duplicidad de Tarjeta  <u> <b> <?php echo count($tarjetas_duplicadas) ?> </u></b> </strong></h4>

					<h4 class="content-header " style="margin-top: -5px;">&nbsp;&nbsp;<strong>Registros Rechazados <u> <b> <?php echo count($rechazos) ?> </b> </u> </strong></h4>

					<div class="porlets-content">
						<div class="table-responsive">
							<table  class="display table table-bordered table-striped" id="dynamic-table">
								<thead>
									<tr>
										<th>CCT </th>
										<th>N° Tarjeta</th>
										<th>Observación </th>								
									</tr>
								</thead>
								<tbody>						
									@foreach ($tarjetas_duplicadas as $tarjetas_duplicadas)
									<tr class="gradeA">
										<td style="background-color: #FFE4E1;" >{{$tarjetas_duplicadas['cct']}}</td>							
										<td style="background-color: #FFE4E1;" >{{$tarjetas_duplicadas['num_tarjeta']}}</td>
										<td style="background-color: #FFE4E1;" >{{$tarjetas_duplicadas['motivo']}}</td>
									</td>
								</tr>
								@endforeach		
								@foreach ($rechazos as $rechazos)
									<tr class="gradeA">
										<td style="background-color: #FFE4E1;" >{{$rechazos['cct']}}</td>							
										<td style="background-color: #FFE4E1;" >{{$rechazos['num_tarjeta']}}</td>
										<td style="background-color: #FFE4E1;" >{{$rechazos['motivo']}}</td>
									</td>
								</tr>
								@endforeach	

																

							</tbody>

						</table>

					</div><!--/porlets-content-->
				</div><!--/block-web-->
			</div><!--/col-md-12-->
		</div><!--/row-->
	</div>



	@endsection