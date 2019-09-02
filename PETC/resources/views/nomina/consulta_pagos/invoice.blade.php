@inject('metodo','petc\Http\Controllers\TarjetasFortalecimientoController')

<!DOCTYPE html>
<html lang="es">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<title>COMPROBANTE DE APOYO ECONOMICO PETC: {{$personal->rfc}}</title>
	<link rel="stylesheet" href="css/talon.css" media="all" />
	
</head>
<body>
	<header class="clearfix">
		<div id="logo">
			<img src="img/logopetc2.jpg"  width="750" height="80"/>
		</div>
		
		<h1>COMPROBANTE DE APOYO ECONOMICO PETC: {{$personal->rfc}}</h1>
<br>
			<h2>DATOS PETC DEL TRABAJADOR:</h2>


		<div id="project" >
			<div><span>PROGRAMA</span> PROGRAMA ESCUELAS DE TIEMPO COMPLETO</div>
			<div><span>NOMBRE: </span> {{$personal->nombre}}</div> 
			<div><span>RFC: </span> {{$personal->rfc}}</div>
			<div><span>CATEGORIA: </span>{{$personal->categoria}}</div>
			<div><span>TELEFONO: </span> {{$personal->telefono}}</div>
			<div><span>EMAIL: </span>{{$personal->email}}</div>
		</div>

		<div id="project2" >
			<div><span>CCT: </span> {{$personal->cct}}</div>
			<div><span>ESCUELA: </span>{{$personal->nombre_escuela}}</div>
			<div><span>REGION: </span>{{$personal->region}} {{$personal->sostenimiento}}</div>
			<div><span>LOCALIDAD:</span>{{$personal->nom_loc}}</div>
			<div><span>MUNICIPIO:</span>{{$personal->municipio}}</div>
			
			
		</div>
	</header>


<h2>DATOS DEL PAGO:</h2>

	<main>

		@if($sostenimiento == "FEDERAL")
		<div id="project"  >
			<div><span>UNIDAD</span> {{$nomina->unidad}}</div>
			<div><span>SUBUNIDAD:</span> {{$nomina->subunidad}}</div> 
			<div><span>CAT PUESTO:</span> {{$nomina->cat_puesto}}</div>
			<div><span>HORAS:</span>{{$nomina->horas}}</div>
			<div><span>CONSPLAZA:</span> {{$nomina->cons_plaza}}</div>
		</div>

		<div id="project2" >
			<div><span>ADSCRIPCION:</span>{{$nomina->ent_fed}}{{$nomina->ct_clasif}}{{$nomina->ct_id}}{{$nomina->ct_sec}}{{$nomina->ct_digito_ver}}</div>
			<div><span>QNA INICIO:</span> {{$nomina->qna_ini_01}}</div>
			<div><span>QNA FINAL:</span>{{$nomina->qna_fin_01}}</div>
			<div><span>QNA PAGO:</span>{{$nomina->qna_pago}} </div>
			<div><span>CHEQUE:</span>{{$nomina->num_cheque}}</div>
			<div><span>CICLO:</span>{{$nomina->ciclo_escolar}}</div>

		</div>
		<br><br><br><br><br><br><br><br>

		<table name="table_producto" id="table_producto" border="0" cellspacing="0" cellpadding="0">
			<thead>
				<tr>	
					<th class="desc">REGION</th>	
					<th class="desc">COD PAGO</th>
					<th class="desc">NUM CHEQUE:</th>
					<th class="desc">CONSPLAZA</th>
					<th class="desc">PERCEPCION</th>	
					<th class="desc">DEDUCCION</th>
					<th class="unit">NETO</th>

				</tr>
			</thead>
			<tbody>
				<tr>
					<td class="no">{{$nomina->region}}</td>  
					<td class="no">{{$nomina->cod_pago}}</td>  
					<td class="no">$ <?php echo  number_format($nomina->perc,2) ?></td> 
					<td class="no">$ <?php echo  number_format($nomina->ded,2) ?></td> 
					<td class="no">$ <?php echo  number_format($nomina->neto,2) ?></td>
				</tr>	
				<tr>
					<td class="no" colspan="3">MONTO NETO CON LETRA: ({{$metodo->numtoletras($nomina->neto)}})</td> 

				</tr>		

			</tbody> 
			<tfoot>

			</tfoot>
		</table>

		@else

		<div id="project" >
			<div><span>BANCO</span> {{$nomina->bco}}</div>
			<div><span>NUM CHEQUE: </span> {{$nomina->num_cheque}}</div> 
			<div><span>NUM EMPLEADO: </span> {{$nomina->num_empleado}}</div>
			<div><span>CLAVE: </span> {{$nomina->cve}}</div>
			<div><span>PLAZA: </span>{{$nomina->plaza}}</div>
			<div><span>CONTRATO: </span>{{$nomina->contrato}} </div>
	
		</div>

		<div id="project2"  >		
			<div><span>ADSCRIPCION:</span>{{$nomina->cct}}</div>
			<div><span>QNA INICIO: </span> {{$nomina->qna_ini}}</div>
			<div><span>QNA FINAL: </span>{{$nomina->qna_fin}}</div>
			<div><span>QNA PAGO: </span>{{$nomina->qna_pago}} </div>
			<div><span>CICLO:</span>{{$nomina->ciclo_escolar}}</div>
			<div><span>REGION:</span>{{$nomina->region}}</div>

		</div>

<br><br><br><br><br><br><br><br>
		<table name="table_producto" id="table_producto" border="0" cellspacing="0" cellpadding="0">
			<thead>
				<tr>	
					<th class="desc">REGION</th>	
					<th class="desc">BANCO</th>
					<th class="desc">NUM CHEQUE</th>
					<th class="desc">CONTRATO</th>
					<th class="desc">NUM EMPLEADO</th>
					<th class="desc">PERCEPCION</th>	
					<th class="desc">DEDUCCION</th>
					<th class="unit">NETO</th>

				</tr>
			</thead>
			<tbody>
				<tr>
					<td class="no">{{$nomina->region}}</td>  
					<td class="no">{{$nomina->bco}}</td>  
					<td class="no">{{$nomina->num_cheque}}</td>  
					<td class="no">{{$nomina->contrato}}</td>  
					<td class="no">{{$nomina->num_empleado}}</td>  
					<td class="no">$ <?php echo  number_format($nomina->perc,2) ?></td> 
					<td class="no">$ <?php echo  number_format($nomina->ded,2) ?></td> 
					<td class="no">$ <?php echo  number_format($nomina->neto,2) ?></td>				

				</tr>			
					<tr>
					<td class="no" colspan="3"><b>MONTO NETO CON LETRA: ({{$metodo->numtoletras($nomina->neto)}})</b></td> 

				</tr>

			</tbody>
			<tfoot>

			</tfoot>
		</table>


		@endif







		<br> </br>


		<div><?php echo DNS2D::getBarcodeHTML('{$personal->rfc}-{$nomina->ciclo}-{$nomina->qna_pago}-{$personal->sostenimiento}', "QRCODE",3,3);?></div>
		<br><br>
		     <div> <?php echo DNS1D::getBarcodeHTML('{$personal->rfc}-{$nomina->ciclo}-{$nomina->qna_pago}-{$personal->sostenimiento}', "C128",0.50,50);?></div>
		<br/>
	</body>
	</html>