@extends('layouts.principal')
@section('contenido')
<div class="pull-left breadcrumb_admin clear_both">
	<div class="pull-left page_title theme_color">
		<h1>Plan Contraste </h1>
		<h2 class="">Plan Contraste</h2>
	</div>
	<div class="pull-right">
		<ol class="breadcrumb">
			<li ><a style="color: #808080" href="{{url('/plan_contraste')}}">Inicio</a></li>
			<li class="active">Plan Contraste de Nominas</a></li>
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
							<h2 class="content-header" style="margin-top: -5px;">&nbsp;&nbsp;<strong>Plan Contraste de Nomina</strong></h2>
							@include('nomina.plan_contraste.search')

						</div>
						<div class="col-md-5">
							<div class="btn-group pull-right">
								<b>

									<div class="btn-group" style="margin-right: 10px;">
										<a class="btn btn-sm btn-warning tooltips" href="{{ route('nomina.plan_contraste.excel','2')}}" id="excel"  style="margin-right: 10px;" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Descargar"> <i class="fa fa-download"></i> Descargar </a>

											<a class="btn btn-primary btn-sm"   href="{{URL::action('PlanContasteController@ver_plan','2')}}" id="invoice" style="margin-right: 10px;" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Ver Plan" ><i class="fa fa-eye"></i> Ver Plan</a>										


									</div>

								</a>
							</b>
						</div>
					</div>
				</div>
			</div>

			<div class="porlets-content">
				<div class="table-responsive">
					<table cellpadding="0" cellpadding="0" border="0"  class="display table table-bordered " id="hidden-table-info19" >
						<thead>
							<tr>

								<th>CCT </th>
								<th>Nombre de Escuela </th>
								<th>Región</th>
								<th style="display:none;" >Sostenimiento </th>
								<th style="display:none;" >Domicilio </th>
								<th style="display:none;" >Télefono </th>
								<th style="display:none;" >Email </th>
								<th>Total</th>
								<th>Directores</th>
								<th>Docentes</th>
								<th>Intendentes</th>
								<th>Percepción Directores</th>
								<th>Percepción Docentes</th>
								<th>Percepción Intendentes</th>
								<th style="display:none;" >Deducciones Director</th>
								<th style="display:none;" >Deducciones Docente</th>
								<th style="display:none;" >Deducciones Intendente</th>
								<th style="display:none;" >Liquido</th>
								<th style="display:none;" >Liquido</th>
								<th style="display:none;" >Liquido</th>
								<th>Ciclo Escolar</th>
								<td><center><b>Editar</b></center></td>

							</tr>
						</thead>
						<tbody>
							@foreach($plan  as $datos)
							<tr class="gradeX">

								<td style="background-color:#DBFFC2;">{{$datos->cct}} </td>
								<td style="background-color:#DBFFC2;">{{$datos->nombre_escuela}} </td>
								<td style="background-color:#DBFFC2;">{{$datos->region}} {{$datos->sostenimiento}} </td>
								<td style="display:none;" >{{$datos->sostenimiento}} </td>
								<td style="display:none;" >{{$datos->domicilio}} </td>
								<td style="display:none;" >{{$datos->telefono}} </td>
								<td style="display:none;" >{{$datos->email}} </td>
								<td style="background-color:#DBFFC2;"><?php $x=$datos->total_directores + $datos->total_docentes + $datos->total_intendentes; echo  $x ?> </td>
								<td style="background-color:#DBFFC2;">{{$datos->total_directores}} </td>
								<td style="background-color:#DBFFC2;">{{$datos->total_docentes}} </td>
								<td style="background-color:#DBFFC2;">{{$datos->total_intendentes}} </td>

								<td style="background-color:#DBFFC2;">$ <?php echo  number_format($datos->monto_directores,2) ?> </td>
								<td style="background-color:#DBFFC2;">$ <?php echo  number_format($datos->monto_docentes,2) ?> </td>
								<td style="background-color:#DBFFC2;">$ <?php echo  number_format($datos->monto_intendentes,2) ?> </td>

								<td style="display:none;" >$ <?php echo  number_format($datos->deducciones_directores,2) ?> </td>
								<td style="display:none;" >$ <?php echo  number_format($datos->deducciones_docentes,2) ?> </td>
								<td style="display:none;" >$ <?php echo  number_format($datos->deducciones_intendentes,2) ?> </td>

								<td style="display:none;" > $ <?php $x=$datos->monto_directores - $datos->deducciones_directores; echo  number_format($x,2) ?> </td>
								<td style="display:none;" > $ <?php $x=$datos->monto_docentes - $datos->deducciones_docentes; echo  number_format($x,2) ?> </td>

								<td style="display:none;" > $ <?php $x=$datos->monto_intendentes - $datos->deducciones_intendentes; echo  number_format($x,2) ?>  </td>

								<td style="background-color:#DBFFC2;">{{$datos->ciclo}} </td>
								<td style="background-color:#DBFFC2;">
									<center>
										<a href="{{URL::action('PlanContasteController@edit',$datos->id)}}" id="edit" onchange="" title="Editar" class="btn btn-primary btn-sm" role="button"><i class="fa fa-edit"></i></a>

									</center>
								</td>

							</tr>

							@endforeach
						</tbody>
						<tfoot>
							<tr>
								<th></th>
								<th>CCT </th>
								<th>Nombre de Escuela </th>
								<th>Región</th>
								<th style="display:none;" >Sostenimiento </th>
								<th style="display:none;" >Domicilio </th>
								<th style="display:none;" >Télefono </th>
								<th style="display:none;" >Email </th>
								<th>Total</th>
								<th>Directores</th>
								<th>Docentes</th>
								<th>Intendentes</th>
								<th>Percepción Directores</th>
								<th>Percepción Docentes</th>
								<th>Percepción Intendentes</th>
								<th style="display:none;" >Deducciones Director</th>
								<th style="display:none;" >Deducciones Docente</th>
								<th style="display:none;" >Deducciones Intendente</th>
								<th style="display:none;" >Liquido</th>
								<th style="display:none;" >Liquido</th>
								<th style="display:none;" >Liquido</th>
								<th>Ciclo Escolar</th>
								<td><center><b>Editar</b></center></td>
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
		var x =document.getElementById('ciclo_escolar2').value;
		document.getElementById('excel').href="/descargar-plan_contraste/"+x;
		document.getElementById('invoice').href="/pdf-plan_contraste/"+x;

	}

	function cambia_ruta(){
		var x =document.getElementById('ciclo_escolar2').value;
		document.getElementById('excel').href="/descargar-plan_contraste/"+x;
		document.getElementById('invoice').href="/pdf-plan_contraste/"+x;
	}

	function enviar_ciclo_plan(){
		var x =document.getElementById('ciclo_escolar2').value;
		var y =document.getElementById('searchText').value;
		document.getElementById('excel').href="/descargar-plan_contraste/"+x;
		document.getElementById('invoice').href="/pdf-plan_contraste/"+x;
		location.href="/plan_contraste?searchText="+y+"&ciclo_escolar2="+x;
	}
</script>

@endsection
