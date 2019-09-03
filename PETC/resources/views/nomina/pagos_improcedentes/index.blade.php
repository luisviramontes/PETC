@extends('layouts.principal')
@section('contenido')
<div class="pull-left breadcrumb_admin clear_both">
	<div class="pull-left page_title theme_color">
		<h1>Pagos Improcedentes </h1>
		<h2 class="">Pagos Improcedentes</h2>
	</div>
	<div class="pull-right">
		<ol class="breadcrumb">
			<li ><a style="color: #808080" href="{{url('/pagos_improcedentes')}}">Inicio</a></li>
			<li class="active">Pagos Improcedentes</a></li>
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
							<h2 class="content-header" style="margin-top: -5px;">&nbsp;&nbsp;<strong>Pagos Improcedentes</strong></h2>
							@include('nomina.pagos_improcedentes.search')
						</div>
						<div class="col-md-5">
							<div class="btn-group pull-right">
								<b>

									<div class="btn-group" style="margin-right: 10px;">


										<a class="btn btn-sm btn-warning tooltips" href="{{ route('nomina.pagos-improcedentes.excel',1)}}"  id="excel" style="margin-right: 10px;" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Descargar"> <i class="fa fa-download"></i> Descargar </a>

										<a class="btn btn-primary btn-sm"  id="invoice" href="{{URL::action('PagosImprocedentesController@invoice',2)}}" style="margin-right: 10px;" data-toggle="tooltip" data-placement="bottom" title="" target="_blank" data-original-title="Descargar"> <i class="fa fa-print"></i> Generar PDF</a>




									</div>

								</a>
							</b>
						</div>
					</div>
				</div>
			</div>

			<div class="porlets-content">
				<div class="table-responsive">
					<table cellpadding="0" cellspacing="0" border="0"  class="display table table-bordered " id="hidden-table-info17" >
						<thead>
							<tr>
								<th>Región </th>
								<th>R.F.C</th>
								<th>Nombre </th>
								<th>Qna Inicial </th>
								<th>Qna Final </th>
								<th>Qna Pago </th>
								<th>Num_Cheque </th>
								<th>Percepción </th>
								<th>Deducción </th>
								<th>Liquido </th>
								<th style="display:none;" >Observaciónes </th>
								<th style="display:none;" >Ciclo </th>
								<th >Estado </th>
								<th style="display:none;" >Capturo </th>
								<td><center><b>Activar</b></center></td>
								<td><center><b>Borrar</b></center></td>
									<th style="display:none;" >up </th>
							</tr>
						</thead>
						<tbody>

							@foreach($pagos  as $pagos)
							@if($pagos->estado == "RESUELTO" )
							<tr class="gradeX">
								<td style="background-color: #DBFFC2;">{{$pagos->region}} </td>
								<td style="background-color: #DBFFC2;">{{$pagos->rfc}} </td>
								<td style="background-color: #DBFFC2;">{{$pagos->nom_emp}}</td>
								<td style="background-color: #DBFFC2;">{{$pagos->qna_ini}}</td>
								<td style="background-color: #DBFFC2;">{{$pagos->qna_fin}}</td>
								<td style="background-color: #DBFFC2;">{{$pagos->qna_pago}}</td>
								<td style="background-color: #DBFFC2;">{{$pagos->num_cheque}}</td>
								<td style="background-color: #DBFFC2;">$ <?php echo  number_format($pagos->perc) ?> </td>
								<td style="background-color: #DBFFC2;">$ <?php echo  number_format($pagos->ded) ?></td>
								<td style="background-color: #DBFFC2;">$ <?php echo  number_format($pagos->neto) ?></td>
								<td style="display:none;" >{{$pagos->observaciones}} </th>
								<td style="display:none;" > {{$pagos->ciclo}} </th>
									<td style="background-color: #DBFFC2;">{{$pagos->estado}} </th>
									<td style="display:none;" >{{$pagos->captura}} </td>
										<td style="background-color: #DBFFC2;">
											<a class="btn btn-sm btn-success tooltips" data-target="#modal-delete2-{{$pagos->id}}" data-toggle="modal" style="margin-right: 10px;"  role="button"> <i class="glyphicon glyphicon-ok"></i></a>
										</td>
										<td style="background-color: #DBFFC2;">
											<center>
												<a class="btn btn-danger btn-sm" data-target="#modal-delete-{{$pagos->id}}" data-toggle="modal" style="margin-right: 10px;"  role="button"><i class="fa fa-eraser"></i></a></center>
											</td>
												<td style="display:none;" >{{$pagos->updated_at}} </th>

										</tr>
										@else

											<tr class="gradeX">
											<td style="background-color: #FFE4E1;">{{$pagos->region}} </td>
											<td style="background-color: #FFE4E1;">{{$pagos->rfc}} </td>
											<td style="background-color: #FFE4E1;">{{$pagos->nom_emp}}</td>
											<td style="background-color: #FFE4E1;">{{$pagos->qna_ini}}</td>
											<td style="background-color: #FFE4E1;">{{$pagos->qna_fin}}</td>
											<td style="background-color: #FFE4E1;">{{$pagos->qna_pago}}</td>
											<td style="background-color: #FFE4E1;">{{$pagos->num_cheque}}</td>
											<td style="background-color: #FFE4E1;">$ <?php echo  number_format($pagos->perc) ?> </td>
											<td style="background-color: #FFE4E1;">$ <?php echo  number_format($pagos->ded) ?></td>
											<td style="background-color: #FFE4E1;">$ <?php echo  number_format($pagos->neto) ?></td>
												<td style="display:none;" >{{$pagos->observaciones}} </th>
												<td style="display:none;" >{{$pagos->ciclo}} </th>
													<td style="background-color: #FFE4E1;">{{$pagos->estado}} </th>
														<td style="display:none;" >{{$pagos->captura}} </td>
														<td style="background-color: #FFE4E1;">
															<center>
																<a class="btn btn-sm btn-success tooltips" data-target="#modal-delete2-{{$pagos->id}}" data-toggle="modal" style="margin-right: 10px;"  role="button"> <i class="glyphicon glyphicon-ok"></i></a>
															</center>
														</td>
														<td style="background-color: #FFE4E1;">
															<center>
																<a class="btn btn-danger btn-sm" data-target="#modal-delete-{{$pagos->id}}" data-toggle="modal" style="margin-right: 10px;"  role="button"><i class="fa fa-eraser"></i></a></center>
															</td>
															<td style="display:none;" >{{$pagos->updated_at}} </th>

														</tr>

														@endif
														@include('nomina.pagos_improcedentes.modal')
														@include('nomina.pagos_improcedentes.modale')
														@endforeach
													</tbody>
													<tfoot>
														<tr>
															<th></th>
															<th>Región </th>
															<th>R.F.C</th>
															<th>Nombre </th>
															<th>Qna Inicial </th>
															<th>Qna Final </th>
															<th>Qna Pago </th>
															<th>Num_Cheque </th>
															<th>Percepción </th>
															<th>Deducción </th>
															<th>Liquido </th>
															<th style="display:none;" >Observaciónes </th>
															<th style="display:none;" >Ciclo </th>
															<th>Estado </th>
															<th style="display:none;" >Capturo </th>
															<td><center><b>Activar</b></center></td>
															<td><center><b>Borrar</b></center></td>
															<th style="display:none;" >up </th>
														</tr>
													</tfoot>

												</table>

											</div><!--/table-responsive-->
										</div><!--/porlets-content-->
									</div><!--/block-web-->
								</div><!--/col-md-12-->
							</div><!--/row-->
						</div>
						<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
						<script type="text/javascript">
							window.onload=function(){
								var x =document.getElementById('ciclo_escolar2').value;
								document.getElementById('excel').href="/descargar-pagos-improcedentes/"+x;
								document.getElementById('invoice').href="/pdf-pagos-improcedentes/"+x;

							}

							function cambia_ruta(){
								var x =document.getElementById('ciclo_escolar2').value;
								document.getElementById('excel').href="/descargar-pagos-improcedentes/"+x;
								document.getElementById('invoice').href="/pdf-pagos-improcedentes/"+x;
							}


						</script>
						@endsection
