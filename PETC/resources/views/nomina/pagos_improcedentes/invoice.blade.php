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
						<th class="no">Regiòn</th>
						<th class="no">R.F.C</th>
						<th class="unit">Nombre</th>
						<th class="unit">Qna Inicial</th>
						<th class="unit">Qna Final</th>
						<th class="total">Qna Pago</th>
						<th class="total">Num Cheque</th>
						<th class="total">Percepciòn</th>
						<th class="total">Deducciòn</th>
						<th class="total">Neto</th>
						<th class="total">Ciclo</th>
						<th class="total">Estado</th>
					</tr>
				</thead>
				<tbody>
				<!-- {{$x=1}} -->
					@foreach($cuadro as $cuadro)
					<tr>
						<td class="no">{{$x}}</td>
						<td class="no">{{$cuadro->region}}</td>           
						<td class="no">{{$cuadro->rfc}}</td>
						<td class="no">{{$cuadro->nom_emp}} </td> 
						<td class="no">{{$cuadro->qna_ini}} </td> 
						<td class="no">{{$cuadro->qna_fin}} </td> 
						<td class="no">{{$cuadro->qna_pago}} </td> 
						<td class="no">{{$cuadro->num_cheque}} </td> 
						<td class="no"><?php echo  number_format($cuadro->perc) ?></td>
						<td class="no">$  <?php echo  number_format($cuadro->ded) ?> </td>
						<td class="no">$  <?php echo  number_format($cuadro->neto) ?> </td>		    
						<td class="no">{{$cuadro->ciclo}}</td>   
						<td class="no">{{$cuadro->estado}}</td>         
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