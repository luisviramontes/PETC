@extends('layouts.principal')
@section('contenido')
<div class="pull-left breadcrumb_admin clear_both">
	<div class="pull-left page_title theme_color">
		<h1>Inicio</h1>
		<h2 class="">Detalle de la Qna</h2>
	</div>
	<div class="pull-right">
		<ol class="breadcrumb">
			<li ><a style="color: #808080" href="{{url('/nomina_capturada')}}">Inicio</a></li>
			<li class="active"> Qna {{$qna}}</a></li>
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
							<h4 class="content-header " style="margin-top: -5px;">&nbsp;&nbsp;<strong>Reporte de Qna {{$qna}}</strong></h4>
						</div>
						<div class="btn-group pull-right">
							<b>               
								<div class="btn-group" style="margin-right: 10px;">
								<a class="btn btn-sm btn-warning tooltips" href="{{ route('nomina.descargar_reporte_qna.excel2',$qna)}}" style="margin-right: 10px;" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Descargar"> <i class="fa fa-download"></i> Descargar </a>
										<a class="btn btn-primary btn-sm" href="{{URL::action('NominaCapturadaController@invoice2',$qna)}}" style="margin-right: 10px;" data-toggle="tooltip" data-placement="bottom" target="_blank" data-original-title="Descargar"> <i class="fa fa-print"></i> Generar PDF</a>
									<a class="btn btn-sm btn-danger tooltips" href="{{url('nomina_capturada')}}" style="margin-right: 10px;" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Cancelar"> <i class="fa fa-times"></i> Salir</a>
								</div> 
							</b>
						</div>

					</div>
				</div>
				<div class="porlets-content container clear_both padding_fix">


					<h4 class="content-header " style="margin-top: -5px;">&nbsp;&nbsp;<strong>Total de Pagos <u> <b>{{$cuadros_cifra_totales->total_resgistros}} </b> </u> </strong>  &nbsp;&nbsp; &nbsp;&nbsp;<strong>Total Percepciones <u> <b>$ <?php echo  number_format($cuadros_cifra_perce->total_percepciones,2) ?> </b> </u> </strong> &nbsp;&nbsp; &nbsp;&nbsp;<strong>Total Deducciones <u> <b>$ <?php echo  number_format($cuadros_cifra_dedu->total_deducciones,2) ?> </b> </u> </strong>  &nbsp;&nbsp; &nbsp;&nbsp;<strong>Total Liquido <u> <b>$ <?php echo  number_format($cuadros_cifra_neto->total_liquido,2) ?> </b> </u> </strong> </h4>



					<div class="porlets-content">
						<div class="table-responsive">
							<table  class="display table table-bordered table-striped" id="dynamic-table">
								<thead>
									<tr>
										<th>Total Registros </th>
										<th>Sostenimiento </th>
										<th>Categoria </th> 
										<th>Percepciónes </th> 
										<th>Deducciónes </th> 
										<th>Liquido </th>          
									</tr>
								</thead>
								<tbody>           
									@foreach($cuadros_cifra as $cuadros_cifra)
									<tr class="gradeA">
										<td style="background-color: #DBFFC2;" >{{$cuadros_cifra->total_reclamos}}</td>  
										<td style="background-color: #DBFFC2;" >{{$cuadros_cifra->sostenimiento}}</td>
										<td style="background-color: #DBFFC2;" >{{$cuadros_cifra->categoria}}</td> 
										<td style="background-color: #DBFFC2;" >$ <?php echo  number_format($cuadros_cifra->total_percepciones,2) ?> </td> 
										<td style="background-color: #DBFFC2;" >$ <?php echo  number_format($cuadros_cifra->total_deducciones,2) ?> </td>
										<td style="background-color: #DBFFC2;" >$ <?php echo  number_format( $cuadros_cifra->total_liquido,2) ?> </td>      
									</td>
								</tr>                               
								@endforeach

							</tbody>

						</table>

					</div><!--/porlets-content-->
				</div><!--/block-web-->
				<br>
				<h4 class="content-header " style="margin-top: -5px;">&nbsp;&nbsp;<strong>Datos de la Qna </b> </u> </strong></h4>
				<br>


				<div class="porlets-content">
					<div class="table-responsive">
						<table  class="display table table-bordered table-striped" id="dynamic-table">
							<thead>
								<tr>
									<th>Qna </th>
									<th>Dias Habiles </th>
									<th>Pago por Director </th> 
									<th>Pago por Docente </th> 
									<th>Pago Por Intendente </th>        
								</tr>
							</thead>
							<tbody>           
								@foreach($tabla_pagos as $tabla_pagos)
								<tr class="gradeA">
								<td style="background-color: #DBFFC2;" >{{$tabla_pagos->qna}}</td>  
									<td style="background-color: #DBFFC2;" >{{$tabla_pagos->dias}}</td>
									<td style="background-color: #DBFFC2;" >$ <?php echo  number_format($tabla_pagos->pago_director,2) ?> </td> 
									<td style="background-color: #DBFFC2;" >$ <?php echo  number_format($tabla_pagos->pago_docente,2) ?> </td>
									<td style="background-color: #DBFFC2;" >$ <?php echo  number_format( $tabla_pagos->pago_intendente,2) ?> </td>      
								</td>
							</tr>                               
							@endforeach

						</tbody>

					</table>

				</div><!--/porlets-content-->
				

			</div><!--/porlets-content-->
		</div><!--/block-web-->
	</div><!--/col-md-12-->
</div><!--/row-->
</div>



@endsection