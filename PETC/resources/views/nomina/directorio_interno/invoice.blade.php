<!DOCTYPE html>
<html lang="es">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<title>Directorio PETC</title>
	<link rel="stylesheet"  href="css/plantilla_directorioi.css"  media="all" />
	<style media="screen">
		@page { size: 30cm 32cm landscape; }
	</style>
</head>
<body>
	<header class="clearfix">
		<div id="logo">
			<img src="img/logopetc2.jpg"  width="1100"  height="70"/>
		</div>
		<div id="project" >
			<div> PERSONAL ESCUELAS DE TIEMPO COMPLETO</div>
		</div>

		<div id="project2" align="right" >

		</div>
	</header>

	<main>

		<table name="table_producto" id="table_producto" border="0" cellspacing="0" cellpadding="0">
			<thead>
				<tr>				
					<th>NOMBRE </th>
					<th>R.F.C </th>
					<th>CURP</th>
					<th>FECHA_NACIMIENTO</th>
					<th>TELEFONO</th>
					<th>DOMICILIO</th>
					<th>LICENCIATURA</th>
					<th>FECHA INGRESO</th>
					<th>AREA</th>
					<th>PUESTO</th>
					<th>TIPO</th>
					<th>SUELDO</th>

				</tr>
			</thead>
			<tbody>
				@foreach($personal as $personal)
				<tr>
					<td>{{$personal->nombre}} </td>
					<td>{{$personal->rfc}}</td>
					<td>{{$personal->curp}} </td>
					<td>{{$personal->fecha_nacimiento}} </td>
					<td>{{$personal->telefono}} </td>
					<td>{{$personal->domicilio}} </td>
					<td>{{$personal->licenciatura}}</td>
					<td>{{$personal->fecha_ingreso}} </td>
					<td>{{$personal->area}} </td>
					<td>{{$personal->puesto}} </td>
					<td>{{$personal->tipo}} </td>
					<td>${{$personal->neto}} </td>

				</tr>
				@endforeach
			</tbody>
			<tfoot>

			</tfoot>
		</table>
	</body>
	</html>
