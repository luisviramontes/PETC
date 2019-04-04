<!DOCTYPE html>
<html lang="es">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<title>Tabla de Localidades</title>
	<link rel="stylesheet" href="css/plantillapdf2.css" media="all" />
	<style media="screen">
		@page { size: 20cm 40cm landscape; }
	</style>
</head>
<body>
	<header class="clearfix">
		<div id="logo"> 
			<img src="img/logopetc2.jpg"  width="750" height="80"/>
		</div>
		<h1>Tabla de Municipios</h1>
		<div id="project" >
			<div><span> Programa</span> PROGRAMA ESCUELAS DE TIEMPO COMPLETO</div>
			<div><span>Área: </span> Nomina y Sistemas</div> 
			<div><span>Email: </span> NOMINA.ETC@GMAIL.COM</div>
			<div><span>Tel: </span>9220666 EXT: 5403-5405</div>
		</div>

		<div id="project2" align="right" >
		</div>
	</header>

	<main>

		<table name="table_producto" id="table_producto" border="0" cellspacing="0" cellpadding="0">
			<thead>
				<tr>
					<th class="no">Municipio</th>
					<th class="desc">Localidad</th>
					<th class="unit">Longitud</th>
					<th class="unit">Latitud</th>
					<th class="unit">Altitud</th>
					<th class="unit">Poblacion Total</th>
					<th class="unit">Poblacion Masculina</th>
					<th class="unit">Poblacion Femenina</th>
					<th class="unit">Capturo</th>
				</tr>
			</thead>
			<tbody>
				@foreach($tabla as $datos)
				<tr>
					<td class="no">{{$datos->municipio}}</td>           
					<td class="unit">{{$datos->nom_loc}}</td>
					<td class="total">{{$datos->longitud}} </td>
					<td class="unit">{{$datos->latitud}} </td>
					<td class="unit">{{$datos->altitud}} </td>
					<td class="no">{{$datos->pobtot}}</td>           
					<td class="unit">{{$datos->pobmas}}</td>
					<td class="total">{{$datos->pobfem}} </td>
					<td class="unit">{{$datos->captura}} </td>
				</tr>
				@endforeach
			</tbody>
			<tfoot>

			</tfoot>
		</table>		
	</body>
	</html>