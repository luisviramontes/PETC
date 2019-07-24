@extends('layouts.principal')
@section('contenido')
<div class="pull-left breadcrumb_admin clear_both">
	<div class="pull-left page_title theme_color">
		<h1>Fortalecimientos </h1>
		<h2 class="">Fortalecimientos</h2>
	</div>
	<div class="pull-right">
		<ol class="breadcrumb">
			<li ><a style="color: #808080" href="{{url('/tarjetas_fortalecimiento')}}">Inicio</a></li>
			<li class="active">Tabla de Fortalecimientos</a></li>
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
							<h2 class="content-header" style="margin-top: -5px;">&nbsp;&nbsp;<strong>Tarjetas de Recurso de Fortalecimiento</strong></h2>
							@include('nomina.tarjetas_fortalecimiento.search')

						</div>
						<div class="col-md-5">
							<div class="btn-group pull-right">
								<b>

									<div class="btn-group" style="margin-right: 10px;">
										<a class="btn btn-sm btn-success tooltips" href="{{ route('tarjetas_fortalecimiento.create')}}" style="margin-right: 10px;" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Registrar Nuevo Fortalecimiento"> <i class="fa fa-plus"></i> Registrar </a>
										<a class="btn btn-sm btn-warning tooltips" href="{{ route('nomina.tarjetas_fortalecimiento.excel','2')}}" id="excel"  style="margin-right: 10px;" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Descargar"> <i class="fa fa-download"></i> Descargar </a>
										<a class="btn btn-primary btn-sm" href=" {{URL::action('TarjetasFortalecimientoController@invoice','2')}}" id="invoice" style="margin-right: 10px;" data-toggle="tooltip" data-placement="bottom"  target="_blank"  title="" data-original-title="Descargar"> <i class="fa fa-print"></i> Generar PDF</a>

										

									</div>

								</a>
							</b>
						</div>
					</div>
				</div>
			</div>

			<div class="porlets-content">
				<div class="table-responsive">
					<table cellpadding="0" cellpadding="0" border="0"  class="display table table-bordered " id="hidden-table-info18" >
						<thead> 
							<tr>

								<th>CCT </th>
								<th>Nombre de Escuela </th>
								<th>Región</th>
								<th style="display:none;" >Sostenimiento </th>
								<th style="display:none;" >Domicilio </th>
								<th style="display:none;" >Télefono </th>
								<th style="display:none;" >Email </th>
								<th>Monto Fortalecimiento</th>
								<th style="display:none;" >Observaciones Fortalecimiento</th>
								<th style="display:none;" >Captura Fortalecimiento</th>
								<th>N° Tarjeta</th>
								<th style="display:none;" >TSL</th>
								<th style="display:none;" >Producto</th>
								<th style="display:none;" >Empresa</th>
								<th style="display:none;" >Obervaciónes Tarjeta</th>
								<th style="display:none;" >Captura tarjeta</th>
								<th>Ciclo Escolar</th>
								<th style="display:none;" >Fecha de Modificacion</th>
								<td><center><b>Editar</b></center></td>
								<td><center><b>Borrar</b></center></td>

							</tr>
						</thead>
						<tbody>
							@foreach($tarjetas  as $tarjetas)							
							<tr class="gradeX">

								<td style="background-color:#DBFFC2;">{{$tarjetas->cct}} </td>
								<td style="background-color:#DBFFC2;">{{$tarjetas->nombre_escuela}} </td>
								<td style="background-color:#DBFFC2;">{{$tarjetas->region}} {{$tarjetas->sostenimiento}} </td>
								<td style="display:none;" >{{$tarjetas->sostenimiento}} </td>
								<td style="display:none;" >{{$tarjetas->domicilio}} </td>
								<td style="display:none;" >{{$tarjetas->telefono}} </td>
								<td style="display:none;" >{{$tarjetas->email}} </td>
								<td style="background-color:#DBFFC2;">$ <?php echo  number_format($tarjetas->monto_forta) ?> </td> 
								<td style="display:none;" >{{$tarjetas->observaciones_forta}} </td>
								<td style="display:none;" >{{$tarjetas->captura_forta}} </td>
								<td style="background-color:#DBFFC2;">{{$tarjetas->num_tarjeta}} </td>
								<td style="display:none;" >{{$tarjetas->TSL}} </td>
								<td style="display:none;" >{{$tarjetas->producto}} </td>
								<td style="display:none;" >{{$tarjetas->empresa}} </td>
								<td style="display:none;" >{{$tarjetas->observaciones}} </td>
								<td style="display:none;" >{{$tarjetas->captura}} </td>
								<td style="background-color:#DBFFC2;">{{$tarjetas->ciclo}} </td>
								<td style="display:none;" >{{$tarjetas->updated_at}} </td>
								<td style="background-color:#DBFFC2;">
									<center>
										<a href="{{URL::action('TarjetasFortalecimientoController@edit',$tarjetas->id)}}" id="edit" onchange="" title="Editar" class="btn btn-primary btn-sm" role="button"><i class="fa fa-edit"></i></a>

									</center>
								</td>
								<td style="background-color:#DBFFC2;" >
									<center>
										<a class="btn btn-danger btn-sm" data-target="#modal-delete-{{$tarjetas->id}}" data-toggle="modal" style="margin-right: 10px;"  role="button"><i class="fa fa-eraser"></i></a></center>
									
								</td>
							
						</tr>						
						@include('nomina.tarjetas_fortalecimiento.modal')
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
								<th>Monto Fortalecimiento </th>
								<th style="display:none;" >Observaciones Fortalecimiento</th>
								<th style="display:none;" >Captura Fortalecimiento</th>
								<th>N° Tarjeta</th>
								<th style="display:none;" >TSL</th>
								<th style="display:none;" >Producto</th>
								<th style="display:none;" >Empresa</th>
								<th style="display:none;" >Obervaciónes Tarjeta</th>
								<th style="display:none;" >Captura tarjeta</th>
								<th>Ciclo Escolar</th>
								<th style="display:none;" >Fecha de Modificacion</th>
								<th><center><b>Editar</b></center></th>
								<th><center><b>Borrar</b></center></th>
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
           document.getElementById('excel').href="/descargar-tarjetas_fortalecimiento/"+x; 
      document.getElementById('invoice').href="/pdf-tarjetas_fortalecimiento/"+x; 
    
	}

	function cambia_ruta(){
		 var x =document.getElementById('ciclo_escolar2').value;
           document.getElementById('excel').href="/descargar-tarjetas_fortalecimiento/"+x; 
           document.getElementById('invoice').href="/pdf-tarjetas_fortalecimiento/"+x; 
	}


</script>

@endsection
