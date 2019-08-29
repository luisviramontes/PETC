@extends('layouts.principal')
@section('contenido')
<div class="pull-left breadcrumb_admin clear_both">
	<div class="pull-left page_title theme_color">
		<h1>Cuadro de Cifras </h1>
		<h2 class="">Cuadro de Cifras</h2>
	</div>
	<div class="pull-right">
		<ol class="breadcrumb">
			<li ><a style="color: #808080" href="{{url('/cuadros_cifras')}}">Inicio</a></li>
			<li class="active">Cuadro de Cifras</a></li>
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
							<h2 class="content-header" style="margin-top: -5px;">&nbsp;&nbsp;<strong>Cuadro de Cifras Ciclo</strong></h2>
							@include('nomina.cuadros_cifras.search')
						</div>
						<div class="col-md-5"> 
							<div class="btn-group pull-right">
								<b>

									<div class="btn-group" style="margin-right: 10px;">


										<a class="btn btn-sm btn-warning tooltips" href="{{ route('nomina.cuadros-cifras.excel',1)}}"  id="excel" style="margin-right: 10px;" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Descargar"> <i class="fa fa-download"></i> Descargar </a> 

										<a class="btn btn-primary btn-sm"  id="invoice" href="{{URL::action('CuadroCifrasController@invoice',2)}}" style="margin-right: 10px;" data-toggle="tooltip" data-placement="bottom" title="" target="_blank" data-original-title="Descargar"> <i class="fa fa-print"></i> Generar PDF</a> 

										<a  class="btn btn-sm btn btn-info" href="{{route('nomina.tabulador_pagos.calculadora_pagos')}}" style="margin-right: 10px;" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Calculadora de Pagos"> <i class="fa fa-plus"></i> Calculadora de Pagos </a> 



									</div>

								</a>
							</b>
						</div>
					</div>
				</div>
			</div>

			<div class="porlets-content">
				<div class="table-responsive">
					<table  class="display table table-bordered table-striped" id="dynamic-table">
						<thead>
							<tr>
								<th>Quincena </th>
								<th>Categoria</th>
								<th>Total Registros </th>
								<th>Total Percepciones </th>
								<th>Total Deducciones </th>
								<th>Total Liquido </th>
								<th>Ciclo Escolar </th>
								<th>Capturo </th>
								<td><center><b>Editar</b></center></td>
								<td><center><b>Borrar</b></center></td>
							</tr>
						</thead>
						<tbody>
							@foreach($cuadro  as $cuadro)
							<tr class="gradeA">
								<td>{{$cuadro->qna}} </td>
								<td>{{$cuadro->categoria}} </td>
								<td>{{$cuadro->total_reclamos}}</td>
								<td>$ <?php echo  number_format($cuadro->total_liquido) ?> </td>
								<td>$ <?php echo  number_format($cuadro->total_percepciones) ?></td>
								<td>$ <?php echo  number_format($cuadro->total_deducciones) ?></td>
								<th>{{$cuadro->ciclo}} </th>
								<td>{{$cuadro->captura}} </td>						
								<td> 
									<center>
										<a href="{{URL::action('CuadroCifrasController@edit',$cuadro->id)}}" class="btn btn-primary btn-sm" role="button"><i class="fa fa-edit"></i></a>  
									</center>
								</td>
								<td>
									<center>
										<a class="btn btn-danger btn-sm" data-target="#modal-delete-{{$cuadro->id}}" data-toggle="modal" style="margin-right: 10px;"  role="button"><i class="fa fa-eraser"></i></a></center>
									</td>
								</td>
							</tr>
                            @include('nomina.cuadros_cifras.modal')
							@endforeach
						</tbody>
						<tfoot>
							<tr>
								<th>Quincena </th>
								<th>Categoria</th>
								<th>Total </th>
								<th>Total Percepciones </th>
								<th>Total Deducciones </th>
								<th>Total Liquido </th>
								<th>Ciclo Escolar </th>
								<th>Capturo </th>
								<td><center><b>Editar</b></center></td>
								<td><center><b>Borrar</b></center></td>
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
           document.getElementById('excel').href="/descargar-cuadros-cifras/"+x; 
      document.getElementById('invoice').href="/pdf-cuadros-cifras/"+x; 
    
	}

	function cambia_ruta(){
		 var x =document.getElementById('ciclo_escolar2').value;
           document.getElementById('excel').href="/descargar-cuadros-cifras/"+x; 
           document.getElementById('invoice').href="/pdf-cuadros-cifras/"+x; 
	}


</script>
@endsection
