@extends('layouts.principal')
@section('contenido')
<div class="pull-left breadcrumb_admin clear_both">
	<div class="pull-left page_title theme_color">
		<h1>Inicio</h1>
		<h2 class="">Calculo de Nominas</h2>
	</div>
	<div class="pull-right">
		<ol class="breadcrumb">
			<li ><a style="color: #808080" href="{{url('/calculo_nomina')}}">Inicio</a></li>
			<li class="active"> Calculo de Nominas</a></li>
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
							<h4 class="content-header " style="margin-top: -5px;">&nbsp;&nbsp;<strong>Calculo de Nominas</strong></h4>
						</div>
						<div class="btn-group pull-right">
							<b>               
								<div class="btn-group" style="margin-right: 10px;">									
									<a class="btn btn-sm btn-danger tooltips" href="{{url('calculo_nomina')}}" style="margin-right: 10px;" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Cancelar"> <i class="fa fa-times"></i> Salir</a>
								</div> 
							</b>
						</div>

					</div>
				</div>
				<div class="porlets-content container clear_both padding_fix">


					<div class="form-group">
						<label class="col-sm-3 control-label">Seleccione Ciclo Escolar : <strog class="theme_color"></strog></label>
						<div class="col-sm-3">
							<select name="ciclo_escolar2" id="ciclo_escolar2" onchange="calculo_nomina();" class="form-control select2"  >
								@foreach($ciclos as $ciclo)
								@if($ciclo->id== 2)							
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

					<br><br>
					<div class="form-group">
						<label class="col-sm-3 control-label">Seleccione Qna : <strog class="theme_color"></strog></label>
						<div class="col-sm-3">
							<select name="qna" id="qna" onchange="calculo_qna_nominas();" class="form-control select"  >

							</select>

						</div>
					</div>	
					<br><br>

					<div class="porlets-content">
						<div class="table-responsive">
							<table  class="display table table-bordered table-striped" id="dynamic-table">
								<thead>
									<tr>
										<th>Total de Dias </th> 
										<th>Categoria </th> 
										<th>Total Personal </th>										
										<th>Monto Total </th> 										         
									</tr>
								</thead>
								<tbody>           																							              
								</tbody>

							</table>

						</div><!--/porlets-content-->
					</div><!--/block-web-->
					<br>
					<h4 class="content-header " style="margin-top: -5px;">&nbsp;&nbsp;<strong>Datos Por Región </b> </u> </strong></h4>
					<br>

					<div class="form-group">
						<label class="col-sm-3 control-label">Seleccione Región: <strog class="theme_color"></strog></label>
						<div class="col-sm-6">
							<select name="region" id="region" onchange="calculo_nomina_region();" class="form-control select2">
								@foreach($region as $region)
								<option value='{{$region->id}}' >
									{{$region->region}} {{$region->sostenimiento}}
								</option>
								@endforeach
							</select>

						</div>
					</div>
					<br><br>

					<div class="porlets-content">
						<div class="table-responsive">
						<table  id="detalles2" class="display table table-bordered table-striped" >
								<thead>
									<tr>
										<th>Total de Dias </th> 
										<th>Categoria </th> 
										<th>Total Personal </th>										
										<th>Monto Total </th> 										         
									</tr>
								</thead>
								<tbody>           

									<tr class="gradeA">

									</tbody>

								</table>

							</div><!--/porlets-content-->
						</div><!--/block-web-->


					</div><!--/block-web-->
				</div><!--/col-md-12-->
			</div><!--/row-->
		</div>
		<script type="text/javascript">
			window.onload = function() {
				calculo_nomina();
				//calculo_qna_nominas();
				//calculo_nomina_region();
			}
		</script>



		@endsection