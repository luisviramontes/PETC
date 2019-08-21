@extends('layouts.principal')
@section('contenido')
<div class="pull-left breadcrumb_admin clear_both">
	<div class="pull-left page_title theme_color">
		<h1>Rechazos Federales </h1>
		<h2 class="">Rechazos Federales</h2>
	</div>
	<div class="pull-right">
		<ol class="breadcrumb">
			<li ><a style="color: #808080" href="{{url('/')}}">Inicio</a></li>
			<li class="active">Tabla de Rechazos Federales</a></li>
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
							<h2 class="content-header" style="margin-top: -5px;">&nbsp;&nbsp;<strong>Tabla de Rechazos Federales</strong></h2>
									@include('nomina.rechazos_fed.search')

						</div>
						<div class="col-md-5">
							<div class="btn-group pull-right">
								<b>


									<div class="btn-group" style="margin-right: 10px;">
										<!--	<a class="btn btn-sm btn-success tooltips" href="{{ route('bancos.create')}}" style="margin-right: 10px;" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Registrar Nueva Nomina"> <i class="fa fa-plus"></i> Registrar </a>
										-->
											<a class="btn btn-sm btn-warning tooltips" href="{{ route('nomina.rechazos_fed.excel')}}" style="margin-right: 10px;" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Descargar"> <i class="fa fa-download"></i> Descargar </a>
											<a class="btn btn-primary btn-sm" href="{{URL::action('RechazosFederalController@invoice','2018-2019')}}" style="margin-right: 10px;" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Descargar"> <i class="fa fa-print"></i> Generar PDF</a>

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

								<th>Número Cheque </th>
								<th>UDC</th>
								<th>RFC</th>
								<th>CURP</th>
                <th>Nombre</th>
                <th>CT</th>
								<th>importe</th>
								<th>Qna pago</th>

							<!--	<td><center><b>Borrar</b></center></td> -->
							</tr>
						</thead>
						<tbody>
						@foreach($rechazos  as $rechazo)
							<tr class="gradeX">

								<td>{{$rechazo->num_cheque}} </td>
								<td>{{$rechazo->udc}}</td>
                <td>{{$rechazo->rfc}}</td>
                <td>{{$rechazo->curp}}</td>
                <td>{{$rechazo->nombre}}</td>
								<td>{{$rechazo->ct}}</td>
								<td>${{number_format($rechazo->importe,2)}}</td>
								<td>{{$rechazo->qna_pago}}</td>

								</td>


							</tr>
					@include('nomina.rechazos_fed.modal')
        @endforeach
						</tbody>
						<tfoot>
							<tr>
								<th>Número Cheque </th>
								<th>UDC</th>
								<th>RFC</th>
								<th>CURP</th>
                <th>Nombre</th>
                <th>CT</th>
								<th>importe</th>
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
@endsection
