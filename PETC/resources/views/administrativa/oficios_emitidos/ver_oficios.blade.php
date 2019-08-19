@extends('layouts.principal')
@section('contenido')
<div class="pull-left breadcrumb_admin clear_both">
	<div class="pull-left page_title theme_color">
		<h1>Inicio</h1>
		<h2 class="">Historial de Oficios Emitidos </h2>
	</div>
	<div class="pull-right">
		<ol class="breadcrumb">
			<li ><a style="color: #808080" href="{{url('/captura')}}">Inicio</a></li>
			<li class="active">Historial de Oficios Emitidos</a></li>
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

							<h4 class="content-header " style="margin-top: -5px;">&nbsp;&nbsp;<strong>Historial de Oficios Emitidos :</strong></h4>



						</div>
						<div class="btn-group pull-right">
							<b>
								<div class="btn-group" style="margin-right: 10px;">
									<a class="btn btn-sm btn-success tooltips" href="{{URL::action('OficiosEmitidosController@create',[])}}" style="margin-right: 10px;" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Registrar Nueva Oficio de Reclamos"> <i class="fa fa-plus"></i> Registrar </a>



									<a class="btn btn-sm btn-danger tooltips" href="{{URL::action('OficiosEmitidosController@index')}}" style="margin-right: 10px;" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Cancelar"> <i class="fa fa-times"></i> Salir</a>




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
					<select name="ciclo_escolar" id="ciclo_escolar" onchange="oficios_emitidos();oficios_emitidos_area();" class="form-control select2">
						@foreach($ciclos as $ciclo)
						@if($ciclo->id == 2)
						<option value='{{$ciclo->id}}' selected>
							{{$ciclo->ciclo}}
						</option>
						@else
						<option value='{{$ciclo->id}}'>
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
						<th>N° Oficios</th>
						<th>Resueltos</th>
						<th>Pedientes</th>
					</thead>
					<tfoot>
						<td style="display:none;"></td>
						<td style="display:none;"></td>
						<td style="display:none;"></td>
					</tfoot>
				</table>



				<a class="btn btn-sm btn-warning tooltips" id="excel" href="{{ route('administrativa.oficios-emitidos.excel',2)}}" style="margin-right: 10px;" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Descargar"> <i class="fa fa-download"></i> Descargar </a> 

			</div>
			<br> <br>


			<div class="form-group">
				<label class="col-sm-3 control-label">Seleccione Área: <strog class="theme_color"></strog></label>
				<div class="col-sm-6">
					<select name="area" id="area" onchange="oficios_emitidos_area();" class="form-control select2">
						<option value="ALIMENTACION"  selected>ALIMENTACION</option>
						<option value="NOMINA Y SISTEMAS">NOMINA Y SISTEMAS</option>
						<option value="ACADEMICA">ACADEMICA</option>
						<option value="RECEPCION">RECEPCION</option>	
						<option value="FINANCIERA">FINANCIERA</option>	
						<option value="MATERIALES">MATERIALES</option>	
						<option value="JURIDICA">JURIDICA</option>	
						<option value="ADMINISTRATIVA">ADMINISTRATIVA</option>
					</select>

				</div>
			</div>
			<br> <br>
			<div class="form-group"  class="table-responsive">
				<table id="detalles2" name="detalles2[]" value="" class="table table-responsive-xl table-bordered">
					<thead style="background-color:#A9D0F5">
						<th>N° Oficios</th>
						<th>Resueltos</th>
						<th>Pedientes</th>
					</thead>
					<tfoot>
						<td style="display:none;"></td>
						<td style="display:none;"></td>
						<td style="display:none;"></td>
					</tfoot>
				</table>



				<a class="btn btn-sm btn-warning tooltips" id="excel2" href="{{ route('administrativa.oficios-emitidos-area.excel',2,'ALIMENTACION')}}" style="margin-right: 10px;" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Descargar"> <i class="fa fa-download"></i> Descargar </a> 

			</div>		


			<br> <br>
			<div class="form-group"  class="table-responsive">
				<table id="detalles3" name="detalles3[]" value="" class="table table-responsive-xl table-bordered">
					<thead style="background-color:#A9D0F5">
						<th>N° Oficio</th>
						<th>Dirigido</th>
						<th>Asunto</th>
						<th>Fecha</th>
						<th>Estado</th>
						<th>Elaboro</th>
					</thead>
					<tfoot>
						<td style="display:none;"></td>
						<td style="display:none;"></td>
						<td style="display:none;"></td>
						<td style="display:none;"></td>
						<td style="display:none;"></td>
						<td style="display:none;"></td>
					</tfoot>
				</table>				

			</div>


		</div><!--/block-web-->
	</div><!--/col-md-12-->
</div><!--/row-->
</div>

<script type="text/javascript">
	window.onload=function(callback){
		
		setTimeout(function(){oficios_emitidos()},1000);
		setTimeout(function(){oficios_emitidos_area()},1000);
		//busca_dias_reclamo();
	}
</script>
@endsection
