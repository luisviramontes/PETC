<!DOCTYPE html>
<html lang="es">
<head>
<style media="screen">
		@page { size: 20cm 40cm landscape; }
	</style>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<title>Reporte de CTE: {{$nombre->nombre_escuela}} {{$nombre->cct}}</title>
	<link rel="stylesheet" href="css/plantilla_historial.css" media="all" />
<body>
	<header class="clearfix">
		<div id="logo">
			<img src="img/logopetc2.jpg"  width="750" height="80"/>
		</div>
		<h1>CCT: {{$centro->cct}}</h1>
		<div id="project" >
			<div><span> Programa</span> PROGRAMA ESCUELAS DE TIEMPO COMPLETO</div>
			<div><span>CCT: </span> {{$centro->cct}}</div> 
			<div><span>Escuela: </span> {{$centro->nombre_escuela}}</div> 
			<div><span>Email: </span> {{$centro->email}}</div>
			<div><span>Tel: </span>{{$centro->telefono}}</div>
		</div>

		<div id="project2" align="right" >
			<div><span>Fecha: </span> {{$date}}</div>
			<div><span>Director: </span>{{$centro->email}}</div>
			<div><span>Region: </span>{{$centro->region}} {{$centro->sostenimiento}}</div>
			<div><span>Domicilio:</span>{{$centro->domicilio}}</div>
			<div><span>Localidad:</span>{{$centro->nom_loc}}</div>
			<div><span>Municipio:</span>{{$centro->municipio}}</div>
		</div>
	</header>

	<main>


<h2>Estadistica 911:</h2>
		<table name="table_producto" id="table_producto" border="0" cellspacing="0" cellpadding="0">
			<thead>
				<tr>
					<th class="unit">CCT</th>
					<th class="unit">Alimentación</th>
					<th class="total">Nivel</th>
					<th class="total">Tipo de Organizaciòn</th>
					<th class="total">Directores</th>
					<th class="total">Docentes Frente a Grupo</th>
					<th class="total">Docentes de USAER</th>
					<th class="total">Docentes de Educación Fisica</th>
					<th class="total">Docentes Artistica</th>
					<th class="total">Intentendes</th>
					<th class="total">Alumnos</th>
					<th class="total">Niñas</th>
					<th class="total">Niños</th>
					<th class="total">Grados</th>
					<th class="total">Grupos</th>
					<th class="total">Fecha de Ingreso al PETC</th>
					<th class="total">Fecha de Baja del PETC</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td class="total">{{$centro->cct}} </td>
					<td class="unit">{{$centro->alimentacion}}</td>
					<td class="unit">{{$centro->nivel}} </td> 
					<td class="total">{{$centro->tipo_organizacion}} </td>
					<td class="unit">{{$centro->total_directores}}</td>
					<td class="unit">{{$centro->total_docentes}}</td>
					<td class="unit">{{$centro->total_usaer}}</td>
					<td class="unit">{{$centro->total_fisica}}</td>
					<td class="unit">{{$centro->total_artistica}}</td>
					<td class="unit">{{$centro->total_intendentes}}</td>
					<td class="unit">{{$centro->total_alumnos}}</td>
					<td class="unit">{{$centro->total_ninas}}</td>
					<td class="unit">{{$centro->total_ninos}}</td>
					<td class="unit">{{$centro->total_grados}}</td>
					<td class="unit">{{$centro->total_grupos}}</td>
					<td class="total">CICLO ESCOLAR {{$centro->fecha_ingreso}} </td>
					@if($centro->fecha_baja == null)
					<td class="unit">SIGUE ACTIVO EN EL PETC</td>
					@else
					<td class="unit">{{$centro->fecha_baja}}</td>
					@endif					     
				</tr>
			</tbody>
			<tfoot>

			</tfoot>
		</table>


		<div><?php echo DNS2D::getBarcodeHTML('{$centro->cct}', "QRCODE",3,3);?></div>
		<br/>
	</body>
	</html>