@extends('layouts.principal')
@section('contenido')
<div class="pull-left breadcrumb_admin clear_both">
	<div class="pull-left page_title theme_color">
		<h1>Inicio</h1>
		<h2 class="">Informe Escuelas PETC </h2>
	</div>
	<div class="pull-right">
		<ol class="breadcrumb">
			<li ><a style="color: #808080" href="{{url('/calculo_nomina')}}">Inicio</a></li>
			<li class="active">Informe Escuelas PETC</a></li>
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
							<h4 class="content-header " style="margin-top: -5px;">&nbsp;&nbsp;<strong>Informe Escuelas PETC</strong></h4>
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


					<h4 class="content-header " style="margin-top: -5px;">&nbsp;&nbsp;<strong>Total de Escuelas </b> </u> </strong></h4>
					<br>

					<div class="porlets-content">
						<div class="table-responsive">
							<table  class="display table table-bordered table-striped" id="dynamic-table">
								<thead>
									<tr>
										<th>Total de Escuelas </th>
										<th>Preescolares </th>
										<th>Preescolares Alimentación </th>  
										<th>Primarias </th>
										<th>Primarias Alimentación </th>   
										<th>TeleSecundarias </th>	
										<th>TeleSecundarias Alimentación </th>   																												         
									</tr>
								</thead>
								<tbody> 
									<tr>							
										<td>{{$total->total_registros}}</td>
										<td>{{$total_pre->total_registros}}</td>
										<td>{{$total_pre_a->total_registros}}</td>
										<td>{{$total_prim->total_registros}}</td>
										<td>{{$total_prim_a->total_registros}}</td>
										<td>{{$total_sec->total_registros}}</td>
										<td>{{$total_sec_a->total_registros}}</td>
									</tr>          																							              
								</tbody>

							</table>

						</div><!--/porlets-content-->
					</div><!--/block-web-->
					<br>
					<h4 class="content-header " style="margin-top: -5px;">&nbsp;&nbsp;<strong>Filtrar Datos </b> </u> </strong></h4>
					<br>

					<div class="form-group">
						<label class="col-sm-3 control-label">Filtrar: <strog class="theme_color"></strog></label>
						<div class="col-sm-3">
							<select name="option1" id="option1" onchange="filtro_centros();" class="form-control select2">
								<option value='1' selected>
									Seleccione Una Opción									
								</option>
								<option value='2' >
									Región									
								</option>
								<option value='3' >
									Municipio									
								</option>
								<option value='4' >
									Localidad									
								</option>
								<option value='5' >
									Fecha de Ingreso 									
								</option>
								
							</select>

						</div>
					</div>




					<br><br><br>

					<div class="form-group">
						<label class="col-sm-3 control-label">Seleccione Opción: <strog class="theme_color"></strog></label>
						<div class="col-sm-6">
							<select name="option2" id="option2"  onchange="ver_centros_filtro();" class="form-control select2">

							</select>

						</div>
					</div>
					<br><br>

					<div class="porlets-content">
						<div class="table-responsive">
							<table  class="display table table-bordered table-striped" id="dynamic-table2">
								<thead>
									<tr>
										<th>Total de Escuelas </th>
										<th>Preescolares </th>
										<th>Preescolares Alimentación </th>  
										<th>Primarias </th>
										<th>Primarias Alimentación </th>   
										<th>TeleSecundarias </th>	
										<th>TeleSecundarias Alimentación </th>   																												         
									</tr>
								</thead>
								<tbody> 

								</tbody>

							</table>

						</div><!--/porlets-content-->
					</div><!--/block-web-->
<br><br><br>
					<h4 class="content-header " style="margin-top: -5px;">&nbsp;&nbsp;<strong>Escuelas </b> </u> </strong></h4>

					<div class="porlets-content">
						<div class="table-responsive">
							<table  class="display table table-bordered table-striped" id="dynamic-table3">
								<thead>
									<tr>
										<th>C.C.T </th>
										<th>Nombre de Escuela </th>
										<th>Nivel </th>  
										<th>Alimentación </th>
										<th>Teléfono </th>
										<th>Domicilio </th>
										<th>Localidad </th>
										<th>Municipio </th>								         
									</tr>
								</thead>
								<tbody> 

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
			//	calculo_nomina();
				//calculo_qna_nominas();
				//calculo_nomina_region();
			}
		</script>



		@endsection