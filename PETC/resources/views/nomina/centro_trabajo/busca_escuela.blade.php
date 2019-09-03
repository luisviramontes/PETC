@extends('layouts.principal')
@section('contenido')
<div class="pull-left breadcrumb_admin clear_both">
	<div class="pull-left page_title theme_color">
		<h1>Centros de Trabajo PETC </h1>
		<h2 class="">Centros de Trabajo PETC</h2>
	</div>
	<div class="pull-right">
		<ol class="breadcrumb">
			<li ><a style="color: #808080" href="{{url('/')}}">Inicio</a></li>
			<li class="active">Centros de Trabajo PETC</a></li>
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
							<h2 class="content-header" style="margin-top: -5px;">&nbsp;&nbsp;<strong>Centros de Trabajo PETC </strong></h2>
							@include('nomina.centro_trabajo.search2')
						</div>
						<div class="col-md-5">
							<div class="btn-group pull-right">

								<b>
								</div>
							</b>
						</div>
						
						
					</div>
				</div>
			</div>
	<label class="col-sm-3 control-label">Se Encontraron {{$cuenta}} Resultados  <strog class="theme_color"></strog></label>
			<div class="porlets-content">
				<div class="table-responsive">
					<table cellpadding="0" cellspacing="0" border="0" class="display table table-bordered " id="hidden-table-info2">
						<thead>
							<tr>
								<th>CCT </th>
								<th>Nombre de la Escuela</th>
								<th style="display:none;" >Municipio </th>
								<th style="display:none;" >Localidad </th>
								<th style="display:none;" >Domicilio </th>
								<th>Región </th>
								<th>Sostenimiento </th>
								<th>Teléfono </th>
								<th>Email </th>
								<th>Capturo </th>
								<th>Ciclo Escolar </th>
								<th style="display:none;" >Entrego Carta Compromiso </th>
								<th>Alimentacion </th>
								<th>Modificado </th>
								<th style="display:none;" >Total de Alumnos </th>
								<th style="display:none;" >Total Niñas </th>
								<th style="display:none;" >Total Niños </th>
								<th style="display:none;" >Total Grupos </th>
								<th style="display:none;" >Total Grados </th>
								<th style="display:none;" >Total Directores </th>
								<th style="display:none;" >Total Docentes </th>
								<th style="display:none;" >Total E.Fisica </th>
								<th style="display:none;" >Total USAER </th>
								<th style="display:none;" >Total Artistica </th>
								<th style="display:none;" >Total Intendentes </th>
								<th style="display:none;" >Fecha Ingreso PETC </th>
								<th style="display:none;" >Fecha Baja PETC</th>						
							</tr>
						</thead>
						<tbody>
							@foreach($centros  as $datos)
							<tr class="gradeX">
								<td>{{$datos->cct}} </td>
								<td>{{$datos->nombre_escuela}} </td>
								<td style="display:none;" >{{$datos->municipio}} </td>
								<td style="display:none;" >{{$datos->nom_loc}} </td>
								<td style="display:none;" >{{$datos->domicilio}} </td>
								<td>{{$datos->region}} </td>
								<td>{{$datos->sostenimiento}}</td>
								<td>{{$datos->telefono}} </td>
								<td>{{$datos->email}} </td>
								<td>{{$datos->captura}} </td>
								<td>{{$datos->ciclo_escolar}} </td>
								<td style="display:none;" >{{$datos->entrego_carta}} </td>
								<td>{{$datos->alimentacion}} </td>
								<td>{{$datos->updated_at}} </td>
								<td style="display:none;" >{{$datos->total_alumnos}} </td>
								<td style="display:none;" >{{$datos->total_ninas}} </td>
								<td style="display:none;" >{{$datos->total_ninos}} </td>
								<td style="display:none;" >{{$datos->total_grupos}} </td>
								<td style="display:none;" >{{$datos->total_grados}} </td>
								<td style="display:none;" >{{$datos->total_directores}} </td>
								<td style="display:none;" >{{$datos->total_docentes}} </td>
								<td style="display:none;" >{{$datos->total_fisica}} </td>
								<td style="display:none;" >{{$datos->total_usaer}} </td>
								<td style="display:none;" >{{$datos->total_artistica}} </td>
								<td style="display:none;" >{{$datos->total_intendentes}} </td>
								<td style="display:none;" >{{$datos->fecha_ingreso}} </td>
								<td style="display:none;" >{{$datos->fecha_baja}} </td>
								
							</tr>								
							@endforeach
							

						</tbody>
						<tfoot>
							<tr>
								<th></th>
								<th>CCT </th>
								<th>Nombre de la Escuela</th>
								<th style="display:none;" >Municipio </th>
								<th style="display:none;" >Localidad </th>
								<th style="display:none;" >Domicilio </th>
								<th>Región </th>
								<th>Sostenimiento </th>
								<th>Teléfono </th>
								<th>Email </th>
								<th>Capturo </th>
								<th>Ciclo Escolar </th>
								<th style="display:none;" >Entrego Carta Compromiso </th>
								<th>Alimentacion </th>
								<th >Modificado </th>
								<th style="display:none;" >Total de Alumnos </th>
								<th style="display:none;" >Total Niñas </th>
								<th style="display:none;" >Total Grupos </th>
								<th style="display:none;" >Total Grados </th>
								<th style="display:none;" >Total Directores </th>
								<th style="display:none;" >Total Docentes </th>
								<th style="display:none;" >Total E.Fisica </th>
								<th style="display:none;" >Total USAER </th>
								<th style="display:none;" >Total Artistica </th>
								<th style="display:none;" >Total Intendentes </th>
								<th style="display:none;" >Fecha Ingreso PETC </th>
								<th style="display:none;" >Fecha Baja PETC</th>

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


	function traer_localidad(callback){
		var x = document.getElementById('localidad');
		if (x.length > 0){
			for (var i = 0; i < x.length; i++) {
				x.remove(i);
			}}


			var municipio = document.getElementById('municipio').value ;
			var route = "http://localhost:8000/traer_localidad/"+municipio;
			$.get(route,function(res){
				for (var i =0; res.length > i; i++) {

					var x = document.getElementById("localidad");
					var option = document.createElement("option");
					option.text = res[i].nom_loc ;
					option.value = res[i].id;
					x.add(option, x[i])
				}

			});

		}

		window.onload=function() {
			setTimeout(function(){traer_localidad()},500);

		}


	</script>
	@endsection
