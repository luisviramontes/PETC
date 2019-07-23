<!DOCTYPE html>
<html lang="es">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<title>Tabla de Cuadro de Cifras: </title>
	<link rel="stylesheet" href="css/cuadro_cifras.css" media="all" />
</head>
<body>
	<header class="clearfix">
		<div id="logo">
			<img src="img/logopetc2.jpg"  width="750" height="80"/>
		</div>		
		<h1><b>Sección: </b>&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp; Programa Escuelas de Tiempo <br>Completo&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</h1>
		<h1><b>Asunto: </b>&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; Cuadros de Cifra &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</h1>
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
						<th class="no">Qna</th>
						<th class="no">Sostenimiento</th>
						<th class="unit">Categoria</th>
						<th class="unit">Total de Registros</th>
						<th class="unit">Total Percepciónes</th>
						<th class="total">Total Deducciónes</th>
						<th class="total">Total Liquido</th>
						<th class="total">Ciclo Escolar</th>
					</tr>
				</thead>
				<tbody>
				<!-- {{$x=1}} -->
					@foreach($cuadro as $cuadro)
					<tr>
						<td class="no">{{$x}}</td>
						<td class="no">{{$cuadro->qna}}</td>           
						<td class="no">{{$cuadro->sostenimiento}}</td>
						<td class="no">{{$cuadro->categoria}} </td> 
						<td class="no"><?php echo  number_format($cuadro->total_reclamos) ?></td>
						<td class="no">$  <?php echo  number_format($cuadro->total_percepciones) ?> </td>
						<td class="no">$  <?php echo  number_format($cuadro->total_deducciones) ?> </td>
						<td class="no">$  <?php echo  number_format($cuadro->total_liquido) ?></td>    
						<td class="no">{{$cuadro->ciclo}}</td>         
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