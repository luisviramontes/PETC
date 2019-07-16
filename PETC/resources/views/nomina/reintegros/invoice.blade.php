<!DOCTYPE html>
<html lang="es">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<title>Reintegros: </title>
	<link rel="stylesheet" href="css/plantilla_reclamos.css" media="all" />
</head>
<body>
	<header class="clearfix">
		<div id="logo">
			<img src="img/logopetc2.jpg"  width="750" height="80"/>
		</div>
		<h1  align="justify"><b>Oficio: </b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;{{$oficio}}&nbsp;&nbsp; &nbsp;&nbsp;</h1>
		<h1><b>Sección: </b>&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp; Programa Escuelas de Tiempo <br>Completo&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</h1>
		<h1><b>Asunto: </b>&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; Solicitud de Pago &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</h1>
		<h1><b>Referencia: </b> &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;Nomina PETC&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</h1>
		<h1><b>Lugar: </b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;Zacatecas,Zacatecas&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;</h1>
		<h1><b>Fecha: </b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;{{$date}}&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</h1>

		<div id="project" >
			<div><b>{{$namecap[0]}}</b></div>

			<div> <b>P r e s e n t e</b></div>
		</div>

	</header>

	<main>

		<div>
			<h2>
				Por este conducto le envío un cordial saludo y a su vez solicito dela manera más atenta el reintegro por la cantidad de {{$nametot[0]}} ( {{$nametotex[0]}} ), debido a que el docente no estuvo laborando {{$num_d}} por motivos de {{$motivo}},dicho reintegro se deberá de efectuar en el departamento de pagos de esta dependencia
				<br> <br>
				Comentándole que este reintegro se efectuara a la Cuenta: {{$namecue[2]}} Clabe: {{$namecue[3]}} Banco: {{$nameban[0]}} Nombre: {{$namecue[4]}} para que con este quede usted absuelto de cualquier responsabilidad.
				<br> <br>
				Sin más por el momento agradezco a usted las atenciones al presente.
				<br> <br> <br> <br> <br> <br> <br> <br> <br> </h2>
			</div>
			<div><h3> <b>A t e n t a m e n t e </b> </h3></div>
			<br> <br><br> <br><br><br>
			<div><h3> <b>Prof. César Pérez Hernández </b></h3></div>
			<div><h3><b> Coordinador Estatal del Programa Escuelas de Tiempo Completo </b></h3></div>
			<br> <br>
			<br><br><br> <br> <br>
			<br> <br>
			<br><br><br> <br> <br>
			<br> <br>
			<br> <br>
			<br><br><br> <br> <br>
			<br> <br>

			<div><h4>

				{{$genero}}
			</h4></div>


			<br> <br><br> <br><br><br>
			<div id="logo">
				<img src="img/logopetc2.jpg"  width="750" height="80"/>
			</div>
			<br>
			<div id="project" >
				<div><b>Tabla de Reintegros</b></div>
				<br><br>
			</div>
			<!-- {{$x=1}} -->
			<table name="table_producto" id="table_producto" border="0" cellspacing="0" cellpadding="0">
				<thead>
					<tr>
						<th class="no">N°</th>
						<th class="no">CCT</th>
						<th class="no">Nombre</th>
						<th class="unit">Categoria</th>
						<th class="no">Director Regional</th>
						<th class="no">No Oficio</th>
						<th class="no">Motivo</th>
						<th class="total">Total de Dias</th>
						<th class="total">Monto Total</th>
					</tr>
				</thead>
				<tbody>
					@foreach($reintegro as $datos)
					<tr>
						<td class="no">{{$x}}</td>
						<td class="no">{{$datos->nombre}}</td>
						<td class="no">{{$datos->cct}}</td>
						<td class="no">{{$datos->categoria}} </td>
						<td class="no">{{$datos->id_directorio_regional}}</td>
						<td class="no">{{$datos->oficio}}</td>
						<td class="no">{{$datos->motivo}}</td>
						<td class="no">{{$datos->num_dias}}</td>
						<td class="no">{{$datos->total}}</td>
					</tr>
					<?php
					$x=$x+1;
					?>
					@endforeach
				</tbody>
				<tfoot>

				</tfoot>
			</table>
			<br> <br>
			<br> <br>
			<div><?php echo DNS2D::getBarcodeHTML('{$oficio}', "QRCODE",3,3);?></div>
			<br/>
			<div><?php echo DNS1D::getBarcodeHTML('{$oficio}', "C128",1,40);?></div>
		</body>
		</html>
