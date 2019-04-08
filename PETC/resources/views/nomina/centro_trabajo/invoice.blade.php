<!DOCTYPE html>
<html lang="es">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<title>Tabla de Centros de Trabajo PETC</title>
	<link rel="stylesheet" href="css/platilla_centros.css" media="all" />
	  <style media="screen">
     @page { size: 20cm 40cm landscape; }
  </style>
</head>
<body>
	<header class="clearfix">
		<div id="logo">
			<img src="img/logocompleto.png"  width="1400" height="80"/>
		</div>
		<h1>Centros de Trabajo PETC</h1>
		<div id="project" >
			<div><span> Programa</span> PROGRAMA ESCUELAS DE TIEMPO COMPLETO</div>
			<div><span>Área: </span> Nomina y Sistemas</div> 
			<div><span>Email: </span> NOMINA.ETC@GMAIL.COM</div>
			<div><span>Tel: </span>9220666 EXT: 5403-5405</div>
		</div>
	</header>

	<main>

		<table name="table_producto" id="table_producto" border="0" cellspacing="0" cellpadding="0">
			<thead>
				<tr>
					<th class="unit">CCT  </th>
					<th class="unit">Nombre Escuela  </th>
					<th class="unit">Región  </th>
					<th class="unit">Localidad  </th>
					<th class="unit">Municipio  </th>
					<th class="unit">Teléfono  </th>
					<th class="unit">Ciclo  </th>
					<th class="unit">Alimentacion  </th>
					<th class="unit">Total Alumnos  </th>
					<th class="unit">Total Niñas  </th>
					<th class="unit">Total Niños  </th>
					<th class="unit">Total Grupos  </th>
					<th class="unit">Total Grados  </th>
					<th class="unit">Total Director  </th>
					<th class="unit">Total Docentes  </th>
					<th class="unit">Total E.Fisica  </th>
					<th class="unit">Total USAER  </th>
					<th class="unit">Total Artistica  </th>
				</tr>
			</thead>
			<tbody>
				@foreach($centros as $datos)
				<tr>
					<td class="total">{{$datos->cct}} </td>
					<td class="unit">{{$datos->nombre_escuela}}</td>
					<td class="unit">{{$datos->region}}-{{$datos->sostenimiento}}</td>
					<td class="total">{{$datos->nom_loc}} </td>
					<td class="unit">{{$datos->municipio}}</td>
					<td class="unit">{{$datos->telefono}}</td>
					<td class="total">{{$datos->ciclo_escolar}} </td>
						<td class="total">{{$datos->alimentacion}} </td>
					<td class="unit">{{$datos->total_alumnos}}</td>		
					<td class="unit">{{$datos->total_ninas}}</td>		
					<td class="unit">{{$datos->total_ninos}}</td>		
					<td class="unit">{{$datos->total_grupos}}</td>		
					<td class="unit">{{$datos->total_grados}}</td>		
					<td class="unit">{{$datos->total_directores}}</td>		
					<td class="unit">{{$datos->total_docentes}}</td>		
					<td class="unit">{{$datos->total_fisica}}</td>		
					<td class="unit">{{$datos->total_usaer}}</td>		
					<td class="unit">{{$datos->total_artistica}}</td>								
				</tr>
				@endforeach
			</tbody>
			<tfoot>

			</tfoot>
		</table>
		<br/>
	</body>
	</html>