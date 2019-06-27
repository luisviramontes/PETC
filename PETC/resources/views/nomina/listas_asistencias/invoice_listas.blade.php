
<!DOCTYPE html>
@foreach($centros as $centros)
<html lang="es">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<title>Listas de Asistencias</title>
	<link rel="stylesheet" href="css/plantilla_historial.css" media="all" />
	<style media="screen">
		@page { size: 20cm 40cm landscape; }
	</style>
</head>
<body>
	<header class="clearfix">
		<div id="logo">
			<img src="img/logopetc2.jpg"  width="700"  height="70"/>



		</div>



		<h1>Listas de Asistencias: {{$centros->nombre_escuela}}</h1>
		<div id="project" >
			<div><span> Programa</span> PROGRAMA ESCUELAS DE TIEMPO COMPLETO</div>
			<div><span>Área: </span> NOMINA Y SISTEMAS</div>
			<div><span>Ciclo Escolar: </span> NOMINA.ETC@GMAIL.COM</div>
		</div>

		<div id="project2" align="right" >

		</div>
	</header>

	<main>
		<table class="egt" >
			<thead>
				<tr>
					<th class="desc" >N°</th>
					<th  class="desc" >NOMBRE DEL DOCENTE</th>
					<th  class="desc" >R.F.C</th>
					<th  class="desc" >PUESTO</th>
					<th class="desc"  >FIRMA</th>
					@for($i=0;$i < $cuenta_dias; $i++)
					<th  class="desc" >{{$dias[$i]->l_semana}}</th>
					@endfor
				</tr>
			</thead>
			<tbody>
				
					@for($x=1;$x < 30; $x++)
					<tr>
						<td class="no"> {{$x}} </td>
						<td class="no"> </td>
						<td class="no"> </td>
						<td class="no"> </td>
						<td class="no"> </td>
						<td class="no"> </td>
						</tr>
						@endfor


					
				</tbody>
			</table>

			<hr color="black" aling="left" width="20%">
		</body>
		@endforeach
		</html>

