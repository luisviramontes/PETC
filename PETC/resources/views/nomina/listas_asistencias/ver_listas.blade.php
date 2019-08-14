@extends('layouts.principal')
@section('contenido')
<div class="pull-left breadcrumb_admin clear_both">
	<div class="pull-left page_title theme_color">
		<h1>Inicio</h1>
		<h2 class="">Historial de Listas </h2>
	</div>
	<div class="pull-right">
		<ol class="breadcrumb">
			<li ><a style="color: #808080" href="{{url('/captura')}}">Inicio</a></li>
			<li class="active">Historial de Listas de Asistencia</a></li>
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

							<h4 class="content-header " style="margin-top: -5px;">&nbsp;&nbsp;<strong>Historial de Listas de Asistencias :</strong></h4>



						</div>
						<div class="btn-group pull-right">
							<b>
								<div class="btn-group" style="margin-right: 10px;">
									<a class="btn btn-sm btn-success tooltips" href="{{URL::action('InasistenciasController@create',[])}}" style="margin-right: 10px;" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Registrar Nueva Oficio de Reclamos"> <i class="fa fa-plus"></i> Registrar </a>



									<a class="btn btn-sm btn-danger tooltips" href="{{URL::action('InasistenciasController@index')}}" style="margin-right: 10px;" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Cancelar"> <i class="fa fa-times"></i> Salir</a>

									<a class="btn btn-primary btn-sm" id="invoice" href="{{URL::action('ListasAsistenciasController@invoice','2')}}" style="margin-right: 10px;" data-toggle="tooltip" target="_blank" data-placement="bottom" title="" data-original-title="Descargar"> <i class="fa fa-print"></i> Generar PDF</a>



								</div>

							</a>

						</b>
					</div>

				</div>
			</div>


			<h5 class="content-header " style="margin-top: -5px;">&nbsp;&nbsp;<strong>Por Ciclo Escolar :</strong></h5>
			<br> <br>

			<div class="form-group">
				<label class="col-sm-3 control-label">Seleccione Ciclo Escolar: <strog class="theme_color"></strog></label>
				<div class="col-sm-6">
					<select name="ciclo_escolar" id="ciclo_escolar" onchange="busca_listas_ciclo();busca_listas_region();busca_listas_mes();" class="form-control select2">
						@foreach($ciclos as $ciclo)
						@if($ciclo->id == 2)
						<option value='{{$ciclo->id}}' selected>
							{{$ciclo->ciclo}}
						</option>
						@else
						<option value='{{$ciclo->id}}' >
							{{$ciclo->ciclo}}
						</option>
						@endif
						@endforeach
					</select>

				</div>
			</div>
			<br> <br>

			<div class="form-group"  class="table-responsive">
				<table id="detalles" name="detalles[]" value="" class="table table-responsive-xl table-bordered">
					<thead style="background-color:#A9D0F5">
						<th>N° Listas Generadas</th>
						<th>N° Listas Entregadas</th>
						<th>N° Listas Pendientes</th>

					</thead>
					<tfoot>
						<td style="display:none;"></td>
						<td style="display:none;"></td>
						<td style="display:none;"></td>
					</tfoot>
				</table>




				<a class="btn btn-sm btn-warning tooltips" id="excel_reclamos" href="{{ route('nomina.reclamos.excel2',2)}}" style="margin-right: 10px;" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Descargar"> <i class="fa fa-download"></i> Descargar </a>

			</div>
			<br> <br>


			<div class="form-group">
				<label class="col-sm-3 control-label">Seleccione Región: <strog class="theme_color"></strog></label>
				<div class="col-sm-6">
					<select name="region" id="region" onchange="busca_listas_region();busca_listas_mes();escs();busca_listas_esc();" class="form-control select2">
						<option selected>
							Seleciona una opción
						</option>
						@foreach($regiones as $region)
						<option value='{{$region->id}}' >
							{{$region->region}} {{$region->sostenimiento}}
						</option>
						@endforeach
					</select>

				</div>
			</div>
			<br> <br>


			<div class="form-group"  class="table-responsive">
				<table id="detalles2" name="detalles2[]" value="" class="table table-responsive-xl table-bordered">
					<thead style="background-color:#A9D0F5">
						<th>N° Listas Generadas</th>
						<th>N° Listas Entregadas</th>
						<th>N° Listas Pendientes</th>


					</thead>
					<tfoot>
						<td style="display:none;"></td>
						<td style="display:none;"></td>
						<td style="display:none;"></td>
					</tfoot>
				</table>


				<br><br><br><br>

				<h5 class="content-header " style="margin-top: -5px;">&nbsp;&nbsp;<strong>Por Mes :</strong></h5>
				<br> <br>

				<div class="form-group">
					<label class="col-sm-3 control-label">Seleccione Mes: <strog class="theme_color"></strog></label>
					<div class="col-sm-6">
						<select name="mes" id="mes" onchange="busca_listas_mes();busca_listas_esc();" class="form-control select2">
							<option selected>
								Selecione una opción
							</option>
							<option value="ENERO">
								ENERO
							</option>
							<option value="FEBRERO">
								FEBRERO
							</option>
							<option value="MARZO">
								MARZO
							</option>
							<option value="ABRIL">
								ABRIL
							</option>
							<option value="MAYO">
								MAYO
							</option>
							<option value="JUNIO">
								JUNIO
							</option>
							<option value="JULIO">
								JULIO
							</option>
							<option value="AGOSTO">
								AGOSTO
							</option>
							<option value="SEPTIEMBRE">
								SEPTIEMBRE
							</option>
							<option value="OCTUBRE">
								OCTUBRE
							</option>
							<option value="NOVIEMBRE">
								NOVIEMBRE
							</option>
							<option value="DICIEMBRE">
								DICIEMBRE
							</option>

						</select>

					</div>
				</div>
				<br> <br>

				<div class="form-group"  class="table-responsive">
					<table id="detalles4" name="detalles4[]" value="" class="table table-responsive-xl table-bordered">
						<thead style="background-color:#A9D0F5">
							<th>N° Listas Generadas</th>
							<th>N° Listas Entregadas</th>
							<th>N° Listas Pendientes</th>

						</thead>
						<tfoot>
							<td style="display:none;"></td>
							<td style="display:none;"></td>
							<td style="display:none;"></td>
						</tfoot>
					</table>






				</div>
				<h5 class="content-header " style="margin-top: -5px;">&nbsp;&nbsp;<strong>Por Escuela :</strong></h5>
				<br><br>
				<div class="form-group">
					<label class="col-sm-3 control-label">Seleccione Escuela: <strog class="theme_color"></strog></label>
					<div class="col-sm-6">
						<select name="escuela" id="escuela" onchange="busca_listas_esc();" class="form-control select2">
							<option selected>
								Selecione una opción
							</option>

						</select>

					</div>
				</div>

				<br><br><br><br>


								<div class="form-group"  class="table-responsive">
									<table id="detalles3" name="detalles3[]" value="" class="table table-responsive-xl table-bordered">
										<thead style="background-color:#A9D0F5">
											<th>N° Listas Generadas</th>
											<th>N° Listas Entregadas</th>
											<th>N° Listas Pendientes</th>

										</thead>
										<tfoot>
											<td style="display:none;"></td>
											<td style="display:none;"></td>
											<td style="display:none;"></td>
										</tfoot>
									</table>






								</div>
								<br> <br>

			<br><br><br><br>








			</div><!--/porlets-content-->
		</div><!--/block-web-->
	</div><!--/col-md-12-->
</div><!--/row-->
</div>

<script type="text/javascript">
	window.onload=function(){
		//cambia_reclamos();
		busca_listas_ciclo();
		busca_listas_region();
		busca_listas_mes();
		busca_listas_esc();

	}




</script>
@endsection
