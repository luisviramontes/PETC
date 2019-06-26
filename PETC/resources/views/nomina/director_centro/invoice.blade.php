<!DOCTYPE html>
<html lang="es">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<title>Listado de Directores PETC</title>
	<link rel="stylesheet" href="css/plantillaformato.css" media="all" />
</head>
<body>
	<header class="clearfix">
		<div id="logo">
			<img src="img/logopetc2.jpg"  width="750" height="80"/>
		</div>
		
		<h1>Listado de Directores PETC</h1>
		<div id="project" >
			<div><span> Programa</span> PROGRAMA ESCUELAS DE TIEMPO COMPLETO</div>
			<div><span>Área: </span> Nomina y Sistemas</div> 
			<div><span>Email: </span> NOMINA.ETC@GMAIL.COM</div>
			<div><span>Tel: </span>9220666 EXT: 5403-5405</div>
		</div>

	</header>

	<main>

		
		<h2>Listado de Directores:</h2>
		@if($personal==null)
		<div class="alert alert-danger"> <strong>No</strong> Se encuentran Registros  de este Empleado. </div>
		@else
		<table name="table_producto" id="table_producto" border="0" cellspacing="0" cellpadding="0">
			<thead>
				<tr>
				<th class="desc">Región</th>	
					<th class="desc">CCT</th>	
					<th class="desc">Nombre de la Escuela</th>	
					<th class="desc">RFC</th>	
					<th class="desc">Nombre</th>
					<th class="desc">Categoria</th>h>
					<th class="unit">Ciclo Escolar</th>


				</tr>
			</thead>
			<tbody>
				@foreach($personal as $personal)
				<tr>
				<td class="unit">{{$personal->region}} {{$personal->sostenimiento}}</td>
					<td class="unit">{{$personal->cct}}</td>
					<td class="unit">{{$personal->nombre_escuela}} </td>
					<td class="unit">{{$personal->rfc}}</td>  
					<td class="unit">{{$personal->nombre}}</td>  
					<td class="unit">{{$personal->categoria}}</td> 
					<td class="unit">{{$personal->ciclo}}</td> 

				</tr>
				@endforeach

			</tbody>
			<tfoot>

			</tfoot>
		</table>
		@endif



		<br> </br>
		<br/>
	</body>
	</html>