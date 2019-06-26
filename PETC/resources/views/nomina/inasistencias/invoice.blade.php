<!DOCTYPE html>
<html lang="es">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<title>Formato De Inasistencias PETC: {{$personal->rfc}}</title>
	<link rel="stylesheet" href="css/plantillaformato.css" media="all" />
</head>
<body>
	<header class="clearfix">
		<div id="logo">
			<img src="img/logopetc2.jpg"  width="750" height="80"/>
		</div>
		
		<h1>Formato De Inasistencias PETC: {{$personal->rfc}}</h1>
		<div id="project" >
			<div><span> Programa</span> PROGRAMA ESCUELAS DE TIEMPO COMPLETO</div>
			<div><span>Nombre Trabajador: </span> {{$personal->nombre}}</div> 
			<div><span>RFC: </span> {{$personal->rfc}}</div>
			<div><span>Categoria: </span>{{$personal->categoria}}</div>
			<div><span>Teléfono: </span> {{$personal->telefono}}</div>
			<div><span>Email: </span>{{$personal->email}}</div>
		</div>

		<div id="project2" align="right" >
			<div><span>CCT: </span> {{$personal->cct}}</div>
			<div><span>Nombre de la Escuela: </span>{{$personal->nombre_escuela}}</div>
			<div><span>Región: </span>{{$personal->region}} {{$personal->sostenimiento}}</div>
			<div><span>Localidad:</span>{{$personal->nom_loc}}</div>
			<div><span>Municipio:</span>{{$personal->municipio}}</div>
			<div><span>Ciclo Escolar :</span>{{$nombre_ciclo->ciclo}}</div>

		</div>
	</header>

	<main>

		
		<h2>Ultimo Periodo:</h2>
		@if($personal==null)
		<div class="alert alert-danger"> <strong>No</strong> Se encuentran Registros  de este Empleado. </div>
		@else
		<table name="table_producto" id="table_producto" border="0" cellspacing="0" cellpadding="0">
			<thead>
				<tr>	
					<th class="desc">Tipo de Movimiento</th>	
					<th class="desc">Ciclo Escolar</th>
					<th class="desc">Clave</th>
					<th class="desc">Categoria</th>	
					<th class="desc">Fecha de Inicio</th>
					<th class="unit">Fecha de Termino</th>
					<th class="unit">Documentación</th>
					<th class="unit">CCT</th>


				</tr>
			</thead>
			<tbody>
				<tr>
					<td class="no">{{$personal->tipo_movimiento}}</td>  
					<td class="no">{{$personal->ciclo}}</td>  
					<td class="no">{{$personal->cat_puesto}}</td> 
					<td class="unit">{{$personal->categoria}}</td> 
					<td class="unit">{{$personal->fecha_inicio}}</td>
					<td class="total">{{$personal->fecha_termino}} </td>
					<td class="unit">{{$personal->documentacion_entregada}}</td>
					<td class="unit">{{$personal->cct}}</td> 

				</tr>
				<tr>
					<td class="unit" colspan="3">Observaciónes: {{$personal->observaciones}}</td> 
					<td class="unit" colspan="3">Fecha Captura: {{$personal->created_at}} </td>

				</tr>

			</tbody>
			<tfoot>

			</tfoot>
		</table>
		@endif


		<h2>Inasistencias Registradas:</h2>
		@if($inasistencias==null)
		<div class="alert alert-danger"> <strong>No</strong> Se encuentran inasistencias Registradas  a este Empleado. </div>
		@else
		<table name="table_producto" id="table_producto" border="0" cellspacing="0" cellpadding="0">
			<thead>
				<tr>
					<th class="no">Inasistencia N°</th>
					<th class="desc">Fecha de Inasistencia</th>
					<th class="unit">Ciclo</th>
					<th class="unit">Estado</th>
					<th class="unit">Nombre Escuela</th>
					<th class="total">CCT</th>
					<th class="total">Qna Aplico Desc</th>

				</tr>
			</thead>
			<tbody>
				@foreach($inasistencias as $ina)
				<tr>
					<td class="no">{{$ina->id}}</td>           
					<td class="unit">{{$ina->dia}}  {{$ina->mes}}</td>
					<td class="total">{{$ina->ciclo_ina}} </td>
					<td class="unit">{{$ina->estado_ina}}</td>
					<td class="unit">{{$ina->nombre_escuela_ina}}</td>
					<td class="unit">{{$ina->cct_ina}}</td>
					<td class="unit">{{$ina->fecha_aplica}}</td>   

				</tr>
				<tr>
					<td class="unit" colspan="3">Captura: {{$ina->captura}}</td> 
					<td class="unit" colspan="3">Fecha: {{$ina->updated_at}}</td>
					<td class="unit" colspan="3">Observaciones: {{$ina->observaciones}}</td> 
				</tr>


				@endforeach

				

			</tbody>
			<tfoot>

			</tfoot>
		</table>
		@endif

		
		
		<br> </br>


		<div><?php echo DNS2D::getBarcodeHTML('{$personal->id}', "QRCODE",3,3);?></div>
		<br/>
	</body>
	</html>