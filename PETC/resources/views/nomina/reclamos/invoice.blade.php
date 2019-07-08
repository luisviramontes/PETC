<!DOCTYPE html>
<html lang="es">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<title>Tabla de Pagos Ciclo: </title>
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
			<div><b>{{$dirigido_lic}} {{$dirigido_nombrec}}</b></div>
			<div> <b>{{$dirigido_puesto}}</b></div> 
			<div> <b>P r e s e n t e</b></div>
		</div>

	</header>

	<main>

		<div>
			<h2> Por este conducto aprovecho para saludarlo y a su vez solicitarle que gire sus apreciables instrucciones a quien corresponda con el fin de generar el pago a docentes interinos, {{$motivo}}, por lo que se pide se genere el pago correspondiente de los {{$cuenta}} docentes que se adjunta al presente. <br> <br> La fecha para este pago se solicita en la quincena {{$qna_aux}} del {{$year_aux}}, misma que ingerirá la siguiente clave presupuestal 4 10 1001 3 1 4 5 1 5 1927021 <b>1211</b>. <br> <br> Lo anterior para dar cumplimiento al Acuerdo número 08/02/19 publicado en el Diario Oficial de la Federación, el día 01 de marzo de 2019, las Reglas de Operación (ROP) del Programa Escuelas de Tiempo Completo (PETC) para el ejercicio fiscal  2019; en específico al numeral "3.4 Características de los apoyos (tipos y montos)" en los apartados "Financieros" y "monto del apoyo".<br> <br>En estos apartados se establecen los diferentes rubros del PETC, mismos que auditan los entes fiscalizadores de la Federación y del Estado. El mezclar recurso de diferentes rubros en los cuadros de cifras dificulta en mucho el poder aclarar el ejercicio del recurso al momento de contestar observaciones de las auditorias. Por lo que se sugiere se atiendan los cuadros mencionados.<br> <br> Sin más por el momento agradezco a usted las atenciones al presente.
				<br> <br></h2> 
			</div>
			<div><h3> <b>A t e n t a m e n t e </b> </h3></div>
			<br> <br><br> <br><br><br>
			<div><h3> <b>Prof. César Pérez Hernández </b></h3></div>
			<div><h3><b> Coordinador Estatal del Programa Escuelas de Tiempo Completo </b></h3></div>
			<br> <br>
			<div><h3> <b>Vo.Bo&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;Vo.Bo   </b></h3></div>
			<br><br><br>
			<div><h3>&nbsp;&nbsp; &nbsp;&nbsp; {{$name_vo_1[1]}} {{$name_vo_1[2]}}&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;{{$name_vo_1[5]}} {{$name_vo_1[6]}} </h3></div>

			<div><h3><b>{{$name_vo_1[3]}}&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;{{$name_vo_1[7]}} </b></h3></div>
			<br> <br>
			<div><h4>
				@for($z=0;$z < $cuenta_copia; $z++)
				C.c.p. {{$name6[$z+1]}}. {{$name6[$z+2]}} - {{$name6[$z+3]}}- Para su Conocimiento<br>
					<?php
				$z=$z+4;
				?>
				@endfor
				<br> <br>
				@for($z=1;$z <= $cuenta_copia_t; $z++)
				@if($name6[$z*5-1] !=  null)
				{{$name6[$z*5-1]}}/
				@endif
				@endfor
				{{$genero}}
			</h4></div>


			<br> <br><br> <br><br><br>
			<div id="logo">
				<img src="img/logopetc2.jpg"  width="750" height="80"/>
			</div>
			<br>
			<div id="project" >
				<div><b>Relación de Reclamos</b></div>
				<br><br>
			</div>
			<!-- {{$x=1}} -->
			<table name="table_producto" id="table_producto" border="0" cellspacing="0" cellpadding="0">
				<thead>
					<tr>
						<th class="no">N°</th>
						<th class="no">Nombre</th>
						<th class="desc">R.F.C</th>
						<th class="unit">Categoria</th>
						<th class="unit">C.C.T</th>
						<th class="unit">Fecha Inicial</th>
						<th class="total">Fecha Final</th>
						<th class="total">Total de Dias</th>
						<th class="total">Monto Total</th>
					</tr>
				</thead>
				<tbody>
					@foreach($reclamos as $datos)
					<tr>
						<td class="no">{{$x}}</td>
						<td class="no">{{$datos->nombre}}</td>           
						<td class="no">{{$datos->rfc}}</td>
						<td class="no">{{$datos->categoria}} </td>
						<td class="no">{{$datos->cct}}</td>
						<td class="no">{{$datos->periodo_inicial}}</td>
						<td class="no">{{$datos->periodo_final}}</td>    
						<td class="no">{{$datos->total_dias}}</td>    
						<td class="no">$ {{$datos->total_reclamo}}</td>      
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