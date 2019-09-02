@extends('layouts.principal')
@section('contenido')
<div class="pull-left breadcrumb_admin clear_both">
	<div class="pull-left page_title theme_color">
		<h1>Nomina {{$sostenimiento}} </h1>
		<h2 class="">Nomina {{$sostenimiento}}</h2>
	</div>
	<div class="pull-right">
		<ol class="breadcrumb">
			<li ><a style="color: #808080" href="{{url('/')}}">Inicio</a></li>
			<li class="active">Nomina {{$sostenimiento}}</a></li>
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
							<h2 class="content-header" style="margin-top: -5px;">&nbsp;&nbsp;<strong>Reporte de Pagos: {{$rfc_input}}</strong></h2>
							@include('nomina.consulta_pagos.search')
							



						</div> 

				</div>
			</div>

			<div class="porlets-content">
				<div class="table-responsive">
					<table cellpadding="0" cellpadding="0" border="0"  class="display table table-bordered" id="hidden-table-info_nofe">
					@if($sostenimiento == "FEDERAL")
						<thead>
							<tr>

								<th>Region </th>
								<th>RFC</th>
								<th>Nom Empeado</th>
								<th style="display:none;">Entidad Federal</th>
								<th style="display:none;">CT Clasif</th>
								<th style="display:none;">CT ID</th>
								<th style="display:none;">CT Sec</th>
								<th style="display:none;">CT Digito Ver</th>
								<th style="display:none;">Cod Pago</th>
								<th style="display:none;">Unidad</th>
								<th style="display:none;">Subunidad</th>
								<th style="display:none;">Cat Puesto</th>
								<th style="display:none;">Horas</th>
								<th style="display:none;">Cons Plaza</th>
								<th>Qna Ini</th>
								<th>Qna Fin</th>
								<th>Qna Pago</th>
								<th>Num Cheque</th>
								<th>PERC</th>
								<th >DED</th>
								<th>Neto</th>
								<th style="display:none;">Ciclo escolar</th>
								<th>Fecha de Registro</th>
								<th style="display:none;">Captura</th>
								<th>Imprimir Comprobante</th> 
				</tr>
						</thead>
						<tbody>
							@foreach($nomina_federal  as $nomina)
							<tr class="gradeX">

								<td>{{$nomina->region}} </td>
								<td>{{$nomina->rfc}}</td>
								<td>{{$nomina->nom_emp}}</td>
								<td style="display:none;">{{$nomina->ent_fed}}</td>
								<td style="display:none;">{{$nomina->ct_clasif}}</td>
								<td style="display:none;">{{$nomina->ct_id}}</td>
								<td style="display:none;">{{$nomina->ct_sec}}</td>
								<td style="display:none;">{{$nomina->ct_digito_ver}}</td>
								<td style="display:none;">{{$nomina->cod_pago}}</td>
								<td style="display:none;">{{$nomina->unidad}}</td>
								<td style="display:none;">{{$nomina->subunidad}}</td>
								<td style="display:none;">{{$nomina->cat_puesto}}</td>
								<td style="display:none;">{{$nomina->horas}}</td>
								<td style="display:none;">{{$nomina->cons_plaza}}</td>
								<td>{{$nomina->qna_ini_01}}</td>
								<td>{{$nomina->qna_fin_01}}</td>
								<td>{{$nomina->qna_pago}}</td>
								<td>{{$nomina->num_cheque}}</td>
								<td >$ <?php echo  number_format($nomina->perc) ?></td>
								<td >$ <?php echo  number_format($nomina->ded) ?></td>
								<td ><b>$ <?php echo  number_format($nomina->neto) ?> </b></td>
								<td style="display:none;">{{$nomina->ciclo_escolar}}</td>
								<td>{{$nomina->created_at}}</td>
								<td style="display:none;">{{$nomina->captura}}</td>
								<td style="background-color: #DBFFC2;"> 
												<a href="{{URL::action('ConsultaPagosController@invoice',$nomina->rfc.'/'.$nomina->ciclo_escolar.'/'.$nomina->qna_pago.'/FEDERAL')}}"  target="_blank"  class="btn btn-primary btn-sm" role="button"><i class="fa fa-print"></i></a>    </td>
							</td>


						</tr>
						@endforeach
											</tbody>

					</table>


					@else
						<thead>
							<tr>

								<th>BCO </th>
								<th>Num Cheque</th>
								<th>Num Empleado</th>
								<th>RFC</th>
								<th>Nombre</th>
								<th style="display:none;">CVE</th>
								<th style="display:none;">Plaza</th>
								<th style="display:none;" >Contrato</th>
								<th style="display:none;" >CCT</th>
								<th style="display:none;">Region</th>
								<th >PERC</th>
								<th >DED</th>
								<th >Neto</th>
								<th>Qna Ini</th>
								<th>Qna Fin</th>
								<th>Qna Pago</th>
								<th>Ciclo Escolar</th>
								<th>Fecha de registro</th>	
								<th style="display:none;">Captura</th>
								<th>Imprimir Comprobante</th>
							</tr>
						</thead>
						<tbody>
							@foreach($nomina_federal  as $nomina)
							<tr class="gradeX">

								<td>{{$nomina->bco}} </td>
								<td>{{$nomina->num_cheque}} </td>
								<td>{{$nomina->num_empleado}} </td>
								<td>{{$nomina->rfc}} </td>
								<td>{{$nomina->nombre}}</td>
								<td style="display:none;">{{$nomina->cve}}</td>
								<td style="display:none;">{{$nomina->plaza}}</td>
								<td style="display:none;">{{$nomina->contrato}}</td>
								<td style="display:none;">{{$nomina->cct}}</td>
								<td style="display:none;">{{$nomina->region}}</td>
								<td >$ <?php echo  number_format($nomina->perc) ?></td>
								<td >$ <?php echo  number_format($nomina->ded) ?></td>
								<td >$ <?php echo  number_format($nomina->neto) ?> </td>
								<td>{{$nomina->qna_ini}}</td>
								<td>{{$nomina->qna_fin}}</td>
								<td>{{$nomina->qna_pago}}</td>
								<td>{{$nomina->ciclo_escolar}}</td>
								<td>{{$nomina->created_at}}</td>
								<td style="display:none;">{{$nomina->captura}}</td>
								<td style="background-color: #DBFFC2;"> 
												<a href="{{URL::action('ConsultaPagosController@invoice',$nomina->rfc.'/'.$nomina->ciclo_escolar.'/'.$nomina->qna_pago.'/ESTATAL')}}"  target="_blank"  class="btn btn-primary btn-sm" role="button"><i class="fa fa-print"></i></a>    </td>
							</td>
						</tr>
						@endforeach
					</tbody>

					</table>



					@endif
				</div><!--/table-responsive-->
			</div><!--/porlets-content-->
		</div><!--/block-web-->
	</div><!--/col-md-12-->
</div><!--/row-->
</div>
@endsection
