@extends('layouts.principal')
@section('contenido')
<div class="pull-left breadcrumb_admin clear_both">
	<div class="pull-left page_title theme_color">
		<h1>Nomina Federal </h1>
		<h2 class="">Nomina Federal</h2>
	</div>
	<div class="pull-right">
		<ol class="breadcrumb">
			<li ><a style="color: #808080" href="{{url('/')}}">Inicio</a></li>
			<li class="active">Tabla de Nomina Federal</a></li>
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
							<h2 class="content-header" style="margin-top: -5px;">&nbsp;&nbsp;<strong>Tabla de Nominas Federales</strong></h2>
							@include('nomina.nomina_federal.search')



						</div> 
						<div class="col-md-5">
							<div class="btn-group pull-right">
								<b>


									<div class="btn-group" style="margin-right: 10px;">
										<div class="btn-group" style="margin-right: 10px;">
											<a class="btn btn-sm btn-success tooltips" href="{{ route('nomina_capturada.create')}}" style="margin-right: 10px;" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Registrar Nueva Nomina"> <i class="fa fa-plus"></i> Registrar </a>
											<a class="btn btn-sm btn-warning tooltips" href="{{ route('nomina.nomina_capturada.excel')}}" style="margin-right: 10px;" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Descargar"> <i class="fa fa-download"></i> Descargar </a>
											<a class="btn btn-primary btn-sm" href="{{URL::action('NominaCapturadaController@invoice','2018-2019')}}" style="margin-right: 10px;" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Descargar"> <i class="fa fa-print"></i> Generar PDF</a>


 
										</div>
									</div>

								</a>
							</b>
						</div>
					</div>
				</div>
			</div>

			<div class="porlets-content">
				<div class="table-responsive">
					<table cellpadding="0" cellpadding="0" border="0"  class="display table table-bordered" id="hidden-table-info_nofe">
						<thead>
							<tr>

								<th>Region </th>
								<th>RFC</th>
								<th>Nom Empeado</th>
								<th>Entidad Federal</th>
								<th>CT Clasif</th>
								<th style="display:none;">CT ID</th>
								<th style="display:none;">CT Sec</th>
								<th style="display:none;">CT Digito Ver</th>
								<th>Cod Pago</th>
								<th>Unidad</th>
								<th style="display:none;">Subunidad</th>
								<th style="display:none;">Cat Puesto</th>
								<th>Horas</th>
								<th style="display:none;">Cons Plaza</th>
								<th>Qna Ini</th>
								<th>Qna Fin</th>
								<th>Qna Pago</th>
								<th>Num Cheque</th>
								<th style="display:none;">PERC</th>
								<th style="display:none;">DED</th>
								<th style="display:none;">Neto</th>
								<th style="display:none;">Ciclo escolar</th>
								<th>Fecha de Registro</th>
								<th style="display:none;">Captura</th>

								<!--	<td><center><b>Borrar</b></center></td> -->
							</tr>
						</thead>
						<tbody>
							@foreach($nomina_federal  as $nomina)
							<tr class="gradeX">

								<td>{{$nomina->region}} </td>
								<td>{{$nomina->rfc}}</td>
								<td>{{$nomina->nom_emp}}</td>
								<td>{{$nomina->ent_fed}}</td>
								<td>{{$nomina->ct_clasif}}</td>
								<td style="display:none;">{{$nomina->ct_id}}</td>
								<td style="display:none;">{{$nomina->ct_sec}}</td>
								<td style="display:none;">{{$nomina->ct_digito_ver}}</td>
								<td>{{$nomina->cod_pago}}</td>
								<td>{{$nomina->unidad}}</td>
								<td style="display:none;">{{$nomina->subunidad}}</td>
								<td style="display:none;">{{$nomina->cat_puesto}}</td>
								<td>{{$nomina->horas}}</td>
								<td style="display:none;">{{$nomina->cons_plaza}}</td>
								<td>{{$nomina->qna_ini_01}}</td>
								<td>{{$nomina->qna_fin_01}}</td>
								<td>{{$nomina->qna_pago}}</td>
								<td>{{$nomina->num_cheque}}</td>
								<td style="display:none;">$ <?php echo  number_format($nomina->perc) ?></td>
								<td style="display:none;">$ <?php echo  number_format($nomina->ded) ?></td>
								<td style="display:none;"><b>$ <?php echo  number_format($nomina->neto) ?> </b></td>
								<td style="display:none;">{{$nomina->ciclo_escolar}}</td>
								<td>{{$nomina->created_at}}</td>
								<td style="display:none;">{{$nomina->captura}}</td>

							<!--	<td>
									<center>
										<a class="btn btn-danger btn-sm" data-target="#modal-delete-{{$nomina->qna_pago}}" data-toggle="modal" style="margin-right: 10px;"  role="button"><i class="fa fa-eraser"></i></a></center>
									</center>
								</td> -->
							</td>


						</tr>
						@include('nomina.nomina_federal.modal')
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
