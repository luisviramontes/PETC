@extends('layouts.principal')
@section('contenido')
<div class="pull-left breadcrumb_admin clear_both">
	<div class="pull-left page_title theme_color">
		<h1>Inicio</h1>
		<h2 class="">Historial de Captura </h2>
	</div>
	<div class="pull-right">
		<ol class="breadcrumb">
			<li ><a style="color: #808080" href="{{url('/captura')}}">Inicio</a></li>
			<li class="active">Historial de Captura</a></li>
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

							<h4 class="content-header " style="margin-top: -5px;">&nbsp;&nbsp;<strong>Historial de Captura :</strong></h4>



							</div>
							<div class="btn-group pull-right">
							<b>
								<div class="btn-group" style="margin-right: 10px;">
									<a class="btn btn-sm btn-success tooltips" href="{{URL::action('CapturaController@create',[])}}" style="margin-right: 10px;" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Registrar Nueva Captura"> <i class="fa fa-plus"></i> Registrar </a>



									<a class="btn btn-sm btn-danger tooltips" href="{{URL::action('CapturaController@index')}}" style="margin-right: 10px;" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Cancelar"> <i class="fa fa-times"></i> Salir</a>

									<a class="btn btn-primary btn-sm" id="generar" href="{{URL::action('CapturaController@invoice1','2')}}" style="margin-right: 10px;" data-toggle="tooltip"  target="_blank" data-placement="bottom" title="" data-original-title="Descargar"> <i class="fa fa-print"></i> Generar PDF</a>



								</div>

							</a>

							</b>
							</div>
							</div>



							<h5 class="content-header " style="margin-top: -5px;">&nbsp;&nbsp;<strong>Por Ciclo Escolar :</strong></h5>
							<br> <br>

							<div class="form-group">
							<label class="col-sm-3 control-label">Seleccione Ciclo Escolar: <strog class="theme_color"></strog></label>
							<div class="col-sm-6">
							<select name="ciclo_escolar" id="ciclo_escolar" onchange="busca_dias_captura();busca_dias_captura_region();" class="form-control select2">
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
							<th>N° Registros</th>
							<th>Directores</th>
							<th>Docentes</th>
							<th>Intendentes </th>
							<th>N° Estatales</th>
							<th>N° Federales </th>
							<th>Pagos Registrados</th>
							<th>Pagos Pendientes </th>


							</thead>
							<tfoot>
							<td style="display:none;"></td>
							<td style="display:none;"></td>
							<td style="display:none;"></td>
							<td style="display:none;"></td>
							<td style="display:none;"></td>
							<td style="display:none;"></td>
							<td style="display:none;"></td>
							<td style="display:none;"></td>

							</tfoot>
							</table>


							<a class="btn btn-sm btn-warning tooltips" id="excel_capturas" href="{{ route('nomina.captura.excel2',2)}}" style="margin-right: 10px;" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Descargar"> <i class="fa fa-download"></i> Descargar </a>

							</div>
							<br> <br>

							<h5 class="content-header " style="margin-top: -5px;">&nbsp;&nbsp;<strong>Por Region:</strong></h5>
							<br> <br>

							<div class="form-group">
							<label class="col-sm-3 control-label">Seleccione Región: <strog class="theme_color"></strog></label>
							<div class="col-sm-6">
							<select name="region" id="region" onchange="busca_dias_captura_region();escs()" class="form-control select2">
							<option selected>
							Selecione una opción
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
							<th>N° Registros</th>
							<th>Directores</th>
							<th>Docentes</th>
							<th>Intendentes </th>
							<th>Pagos Registrados</th>
							<th>Pagos Pendientes </th>


							</thead>
							<tfoot>
							<td style="display:none;"></td>
							<td style="display:none;"></td>
							<td style="display:none;"></td>
							<td style="display:none;"></td>


							</tfoot>
							</table>
							</div>

							<br> <br>
							<div class="form-group">
							<label class="col-sm-3 control-label">Seleccione Escuela: <strog class="theme_color"></strog></label>
							<div class="col-sm-6">
							<select name="escuela" id="escuela" onchange="busca_captura_esc();" class="form-control select2">
							<option selected>
							Selecione una opción
							</option>

							</select>

							</div>
							</div>
							<br> <br>
							<div class="form-group"  class="table-responsive">
							<table id="detalles3" name="detalles3[]" value="" class="table table-responsive-xl table-bordered">
								<thead style="background-color:#A9D0F5">
									<th>N° Registros</th>
									<th>Directores</th>
									<th>Docentes</th>
									<th>Intendentes </th>
									<th>Pagos Registrados</th>
									<th>Pagos Pendientes </th>

								</thead>
								<tfoot>
									<td style="display:none;"></td>
									<td style="display:none;"></td>
									<td style="display:none;"></td>
									<td style="display:none;"></td>

								</tfoot>
							</table>
							</div>



		</div><!--/porlets-content-->
	</div><!--/block-web-->
</div><!--/col-md-12-->
</div><!--/row-->
</div>

<script type="text/javascript">
	window.onload=function(){
		escs();
		busca_dias_captura();
		busca_dias_captura_region();
		busca_captura_esc();
}



</script>
@endsection
