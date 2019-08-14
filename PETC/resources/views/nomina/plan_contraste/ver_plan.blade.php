@extends('layouts.principal')
@section('contenido')
<div class="pull-left breadcrumb_admin clear_both">
	<div class="pull-left page_title theme_color">
		<h1>Inicio</h1>
		<h2 class="">Plan Contraste de Nominas</h2>
	</div>
	<div class="pull-right">
		<ol class="breadcrumb">
			<li ><a style="color: #808080" href="{{url('/nomina_capturada')}}">Inicio</a></li>
			<li class="active"> Ciclo {{$ciclo->ciclo}}</a></li>
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
							<h4 class="content-header " style="margin-top: -5px;">&nbsp;&nbsp;<strong>Reporte Plan Contraste de Nominas {{$ciclo->ciclo}}</strong></h4>
						</div>
						<div class="btn-group pull-right">
							<b>               
								<div class="btn-group" style="margin-right: 10px;">
									<a class="btn btn-sm btn-warning tooltips" href="{{ route('nomina.plan_contraste.excel',$ciclo->id)}}" style="margin-right: 10px;" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Descargar"> <i class="fa fa-download"></i> Descargar </a>
									<a class="btn btn-primary btn-sm" href="{{URL::action('PlanContasteController@invoice',$ciclo->id)}}" style="margin-right: 10px;" data-toggle="tooltip" data-placement="bottom" target="_blank" data-original-title="Descargar"> <i class="fa fa-print"></i> Generar PDF</a>
									<a class="btn btn-sm btn-danger tooltips" href="{{url('plan_contraste')}}" style="margin-right: 10px;" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Cancelar"> <i class="fa fa-times"></i> Salir</a>
								</div> 
							</b>
						</div>

					</div>
				</div>
				<div class="porlets-content container clear_both padding_fix">


					<h4 class="content-header " style="margin-top: -5px;">&nbsp;&nbsp;<strong>Total de Personal <u> <b>{{$total_registros}} </b> </u> </strong>  &nbsp;&nbsp; &nbsp;&nbsp;<strong>Total Directores <u> <b> <?php echo  number_format($total_directores->total_director) ?> </b> </u> </strong> &nbsp;&nbsp; &nbsp;&nbsp;<strong>Total Docentes <u> <b> <?php echo  number_format($total_docentes->total_docente) ?> </b> </u> </strong>  &nbsp;&nbsp; &nbsp;&nbsp;<strong>Total Intendentes <u> <b> <?php echo  number_format($total_intendentes->total_intendente) ?> </b> </u> </strong> </h4>



					<div class="porlets-content">
						<div class="table-responsive">
							<table  class="display table table-bordered table-striped" id="dynamic-table">
								<thead>
									<tr>
										<th>Categoria </th> 
										<th>Total Registros </th>										
										<th>Total Percepciónes </th> 
										<th>Total Deducciónes </th> 
										<th>Total Liquido </th>          
									</tr>
								</thead>
								<tbody>           
									
									<tr class="gradeA">
										<td style="background-color: #DBFFC2;" >Directores</td>
										<td style="background-color: #DBFFC2;" ><?php echo  number_format($total_directores->total_director) ?></td>  
										
										<td style="background-color: #DBFFC2;" >$ <?php echo  number_format($total_perce_dire->total_perce_dire,2) ?></td> 
										<td style="background-color: #DBFFC2;" >$ <?php echo  number_format($total_dedu_dire->total_dedu_dire,2) ?> </td> 
										<td style="background-color: #DBFFC2;" >$ <?php echo  number_format($total_liquido_dire,2) ?></td>									
									</td>

								</tr>          
								<tr class="gradeA">
									<td style="background-color: #DBFFC2;" >Docentes</td>
									<td style="background-color: #DBFFC2;" > <?php echo  number_format($total_docentes->total_docente) ?></td>  

									<td style="background-color: #DBFFC2;" >$ <?php echo  number_format($total_perce_doce->total_perce_doce,2) ?></td> 
									<td style="background-color: #DBFFC2;" >$ <?php echo  number_format($total_dedu_doce->total_dedu_doce,2) ?> </td> 
									<td style="background-color: #DBFFC2;" >$ <?php echo  number_format($total_liquido_doce,2) ?></td>									
								</td>

							</tr>              
							<tr class="gradeA">
								<td style="background-color: #DBFFC2;" >Intendentes</td>
								<td style="background-color: #DBFFC2;" > <?php echo  number_format($total_intendentes->total_intendente) ?></td>  

								<td style="background-color: #DBFFC2;" >$ <?php echo  number_format($total_perce_inte->total_perce_inte,2) ?></td> 
								<td style="background-color: #DBFFC2;" >$ <?php echo  number_format($total_dedu_inte->total_dedu_inte,2) ?> </td> 
								<td style="background-color: #DBFFC2;" >$ <?php echo  number_format($total_liquido_inte,2) ?></td>									
							</td>

						</tr>    
						<tr>
							<th>Total </th> 
							<th><?php echo  number_format($total_registros) ?> </th>										
							<th>$ <?php echo  number_format($total_perce,2) ?> </th> 
							<th>$ <?php echo  number_format($total_dedu,2) ?> </th> 
							<th>$ <?php echo  number_format($total_liquido,2) ?> </th>          
						</tr>                           
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
					<select name="region" id="region" onchange="ver_plan_region('{{$ciclo->ciclo}}');" class="form-control select2">
						@foreach($regiones as $region)
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
							<table  id="detalles2" class="display table table-bordered table-striped" id="dynamic-table">
								<thead>
									<tr>
										<th>Categoria </th> 
										<th>Total Registros </th>										
										<th>Total Percepciónes </th> 
										<th>Total Deducciónes </th> 
										<th>Total Liquido </th>          
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
		ver_plan_region('{{$ciclo->ciclo}}');
	}
</script>



@endsection