@extends('layouts.principal')
@section('contenido')
<div class="pull-left breadcrumb_admin clear_both">
	<div class="pull-left page_title theme_color">
		<h1>Nomina Estatal </h1>
		<h2 class="">Nomina Estatal</h2>
	</div>
	<div class="pull-right">
		<ol class="breadcrumb">
			<li ><a style="color: #808080" href="{{url('/')}}">Inicio</a></li>
			<li class="active">Tabla de Nomina Estatal</a></li>
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
							<h2 class="content-header" style="margin-top: -5px;">&nbsp;&nbsp;<strong>Tabla de Nominas Estatales</strong></h2>
							@include('nomina.nomina_estatal.search')

						</div>
						<div class="col-md-5">
							<div class="btn-group pull-right">
								<b>


									<div class="btn-group" style="margin-right: 10px;">
										<a class="btn btn-sm btn-success tooltips" href="{{ route('nomina_capturada.create')}}" style="margin-right: 10px;" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Registrar Nueva Nomina"> <i class="fa fa-plus"></i> Registrar </a>
										<a class="btn btn-sm btn-warning tooltips" href="{{ route('nomina.nomina_capturada.excel')}}" style="margin-right: 10px;" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Descargar"> <i class="fa fa-download"></i> Descargar </a>
										<a class="btn btn-primary btn-sm" href="{{URL::action('NominaCapturadaController@invoice','2019-2020')}}" target="_blank"  style="margin-right: 10px;" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Descargar"> <i class="fa fa-print"></i> Generar PDF</a>



									</div>

								</a>
							</b>
						</div>
					</div>
				</div>
			</div>

			<div class="porlets-content">
				<div class="table-responsive">
					<table cellpadding="0" cellpadding="0" border="0"  class="display table table-bordered" id="hidden-table-info_noes">
						<thead>
							<tr>

								<th>BCO </th>
								<th>Num Cheque</th>
								<th>Num Empleado</th>
								<th>RFC</th>
								<th>Nombre</th>
								<th>CVE</th>
								<th style="display:none;">Plaza</th>
								<th style="display:none;" >Contrato</th>
								<th style="display:none;" >CCT</th>
								<th style="display:none;">Region</th>
								<th style="display:none;">PERC</th>
								<th style="display:none;">DED</th>
								<th style="display:none;">Neto</th>
								<th>Qna Ini</th>
								<th>Qna Fin</th>
								<th>Qna Pago</th>
								<th>Ciclo Escolar</th>
								<th>Fecha de registro</th>	
								<th style="display:none;">Captura</th>





								<!--	<td><center><b>Borrar</b></center></td>-->
							</tr>
						</thead>
						<tbody>
							@foreach($nomina_estatal  as $nomina)
							<tr class="gradeX">

								<td>{{$nomina->bco}} </td>
								<td>{{$nomina->num_cheque}} </td>
								<td>{{$nomina->num_empleado}} </td>
								<td>{{$nomina->rfc}} </td>
								<td>{{$nomina->nombre}}</td>
								<td>{{$nomina->cve}}</td>
								<td style="display:none;">{{$nomina->plaza}}</td>
								<td style="display:none;">{{$nomina->contrato}}</td>
								<td style="display:none;">{{$nomina->cct}}</td>
								<td style="display:none;">{{$nomina->region}}</td>
								<td style="display:none;">$ <?php echo  number_format($nomina->perc) ?></td>
								<td style="display:none;">$ <?php echo  number_format($nomina->ded) ?></td>
								<td style="display:none;">$ <?php echo  number_format($nomina->neto) ?> </td>
								<td>{{$nomina->qna_ini}}</td>
								<td>{{$nomina->qna_fin}}</td>
								<td>{{$nomina->qna_pago}}</td>
								<td>{{$nomina->ciclo_escolar}}</td>
								<td>{{$nomina->created_at}}</td>
								<td style="display:none;">{{$nomina->captura}}</td>



							<!--	<td>
									<center>
										<a class="btn btn-danger btn-sm" data-target="#modal-delete-{{$nomina->qna_pago}}" data-toggle="modal" style="margin-right: 10px;"  role="button"><i class="fa fa-eraser"></i></a></center>
									</center>
								</td> -->
							</td>
						</tr>
						@include('nomina.nomina_estatal.modal')
						@endforeach
					</tbody>
						<!--<tfoot>
							<tr>
                <th></th>
								<th>Quincena </th>
								<th>Dias Trabajados</th>
								<th>Pago por Director </th>
								<th>Pago por Docente </th>
								<th>Pago por Intendente </th>
								<th>Ciclo </th>>
								<th>Capturo </th>
								<th>Modificado</th>


								<td><center><b>Editar</b></center></td>
								<td><center><b>Borrar</b></center></td>
							</tr>
						</tfoot> -->
					</table>

				</div><!--/table-responsive-->
			</div><!--/porlets-content-->
		</div><!--/block-web-->
	</div><!--/col-md-12-->
</div><!--/row-->
</div>
@endsection
