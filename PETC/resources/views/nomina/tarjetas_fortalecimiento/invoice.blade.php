<!DOCTYPE html>
<html lang="es">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<title>Tarjetas de Fortalecimiento </title>
	<link rel="stylesheet" href="css/cuadro_cifras.css" media="all" />
</head>
<body>
	<header class="clearfix">
		<div id="logo">
			<img src="img/logopetc2.jpg"  width="750" height="80"/>
		</div>		
		<h1><b>Sección: </b>&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp; Programa Escuelas de Tiempo <br>Completo&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</h1>
		<h1><b>Asunto: </b>&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; Tarjetas Fortalecimiento&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </h1>
		<h1><b>Referencia: </b> &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;Nomina PETC&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</h1>
		<h1><b>Lugar: </b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;Zacatecas,Zacatecas&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;</h1>
		<h1><b>Fecha: </b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;{{$date}}&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</h1>

			<div id="project" >
			<div> <b>P r e s e n t e</b></div>
		</div>

	</header>

	<main>


			<table name="table_producto" id="table_producto" border="0" cellspacing="0" cellpadding="0">
				<thead>
					<tr>
					<th class="no">N°</th>
						<th class="no">REGION</th>
						<th class="no">SOSTENIMIENTO</th>
						<th class="unit">CCT</th>
						<th class="unit">NOMBRE ESCUELA</th>
						<th class="unit">MONTO FORTALECIMIENTO</th>
						<th class="total">NUM TARJETA</th>
						<th class="total">CICLO ESCOLAR</th>
						<th class="total">ALIMENTACION</th>
					</tr>
				</thead>
				<tbody>
				<!-- {{$x=1}} -->
					@foreach($tarjeta as $tarjeta)
					<tr>
						<td class="no">{{$x}}</td>
						<td class="no">{{$tarjeta->region}}</td>           
						<td class="no">{{$tarjeta->sostenimiento}}</td>
						<td class="no">{{$tarjeta->cct}} </td> 
						<td class="no">{{$tarjeta->nombre_escuela}} </td> 
						<td class="no"><?php echo  number_format($tarjeta->monto_forta) ?></td>
						<td class="no">{{$tarjeta->num_tarjeta}} </td> 
						<td class="no">{{$tarjeta->ciclo}} </td> 						 
						<td class="no">{{$tarjeta->alimentacion}}</td>         
					</tr>				
					<?php
					$x=$x+1;
					?>
					@endforeach
				</tbody>
				<tfoot>

				</tfoot>
			</table>

<br><br><br>




			<div><h3> <b>A t e n t a m e n t e </b> </h3></div>
			<br> <br><br> <br><br><br>
			<div><h3> <b>Prof. César Pérez Hernández </b></h3></div>
			<div><h3><b> Coordinador Estatal del Programa Escuelas de Tiempo Completo </b></h3></div>
			<br> <br>
			

			<br> <br>
			<br> <br>
		</body>
		</html> 