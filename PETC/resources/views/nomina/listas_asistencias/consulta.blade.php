@extends('layouts.principal')
@section('contenido')
<div class="pull-left breadcrumb_admin clear_both">
	<div class="pull-left page_title theme_color">
		<h1>Listas de Asistencias </h1>
		<h2 class="">Listas</h2>
	</div>
	<div class="pull-right">
		<ol class="breadcrumb">
			<li ><a style="color: #808080" href="{{url('/listas_asistencias')}}">Inicio</a></li>
			<li class="active">Listas de Asistencias</a></li>
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
							<h2 class="content-header" style="margin-top: -5px;">&nbsp;&nbsp;<strong>Listas de Asistencias</strong></h2>
							@include('nomina.listas_asistencias.search2')

						</div>
						<div class="col-md-5">
							<div class="btn-group pull-right">
								<b>

									
								</a>
							</b>
						</div>
					</div>
				</div>
			</div>

			<div class="porlets-content">
				<div class="table-responsive">
					<table cellpadding="0" cellpadding="0" border="0"  class="display table table-bordered" id="dynamic-table">
						<thead>
							<tr>
								<th>Clave Centro Trabajo </th>
								<th>Nombre de la Escuela </th>
								<th>Ciclo Escolar</th>
								<th>Region </th>
								<th>Mes </th>
								<th>Observaciones</th>
								<th>Captura</th>
								<th>Estado</th>
								<th>Fecha de Registro</th>
								<th>Fecha de Entrega</th>	
								<th>Imprimir Formato</th>									
							</tr>
						</thead>
						<tbody>
							@foreach($listas  as $lista)
							@if ($lista->estado == "ENTREGADA")
							<tr class="gradeX">
								<td style= "background-color:#DBFFC2;">{{$lista->cct}} </td>
								<td style= "background-color:#DBFFC2;">{{$lista->nombre_escuela}} </td>
								<td style= "background-color:#DBFFC2;">{{$lista->ciclo}} </td>
								<td style= "background-color:#DBFFC2;">{{$lista->region}} {{$lista->sostenimiento}}</td>
								<td style= "background-color:#DBFFC2;">{{$lista->mes}} </td>
								<td style= "background-color:#DBFFC2;">{{$lista->observaciones}} </td>
								<td style= "background-color:#DBFFC2;">{{$lista->captura}}</td>
								<td style= "background-color:#DBFFC2;">{{$lista->estado}} </td>
								<td style= "background-color:#DBFFC2;">{{$lista->created_at}} </td>
								<td style= "background-color:#DBFFC2;">{{$lista->updated_at}} </td>
									<td style="background-color: #DBFFC2;"> 
												<a href="{{URL::action('ListasPublicasController@generar_pdf_listas',$lista->id_centro.'/'.$lista->id_ciclo_c.'/'.$lista->mes)}}"  target="_blank"  class="btn btn-primary btn-sm" role="button"><i class="fa fa-print"></i></a>    </td>

							
						</tr>
						@else

						<tr class="gradeX">
							<td style= "background-color:#FFE4E1;">{{$lista->cct}} </td>
							<td style= "background-color:#FFE4E1;">{{$lista->nombre_escuela}} </td>
							<td style= "background-color:#FFE4E1;">{{$lista->ciclo}} </td>
							<td style= "background-color:#FFE4E1;">{{$lista->region}} {{$lista->sostenimiento}}</td>
							<td style= "background-color:#FFE4E1;">{{$lista->mes}} </td>
							<td style= "background-color:#FFE4E1;">{{$lista->observaciones}} </td>
							<td style= "background-color:#FFE4E1;">{{$lista->captura}}</td>
							<td style= "background-color:#FFE4E1;">{{$lista->estado}} </td>
							<td style= "background-color:#FFE4E1;">{{$lista->created_at}} </td>
							<td style= "background-color:#FFE4E1;">{{$lista->updated_at}} </td>
								<td style="background-color: #FFE4E1;"> 
												<a href="{{URL::action('ListasPublicasController@generar_pdf_listas',$lista->id_centro.'/'.$lista->id_ciclo_c.'/'.$lista->mes)}}"  target="_blank"  class="btn btn-primary btn-sm" role="button"><i class="fa fa-print"></i></a>    </td>
							
						
					</tr>
					@endif
					@endforeach
				</tbody>
						<tfoot>
							<tr>
      
									<th>Clave Centro Trabajo </th>
								<th>Nombre de la Escuela </th>
								<th>Ciclo Escolar</th>
								<th>Region </th>
								<th>Mes </th>
								<th>Observaciones</th>
								<th>Captura</th>
								<th>Estado</th>
								<th>Fecha de Registro</th>
								<th>Fecha de Entrega</th>
								<th>Imprimir Formato</th>							


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
	

	}



</script>

@endsection
