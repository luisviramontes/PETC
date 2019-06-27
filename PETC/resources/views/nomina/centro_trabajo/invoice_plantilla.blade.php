<!DOCTYPE html>
<html lang="es">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<title>PLANTILLA CTE: {{$nombre->cct}}</title>
	<link rel="stylesheet" href="css/plantilla_personal.css" media="all" />
	<body>
		<header class="clearfix">
			<div id="logo">
				<img src="img/logopetc2.jpg"  width="750" height="80"/>
			</div>
			<h1>Plantilla de Personal CCT: {{$nombre->cct}}</h1>
			<div id="project" >
				<div><span> Programa</span> PROGRAMA ESCUELAS DE TIEMPO COMPLETO</div>
				<div><span>CCT: </span> {{$nombre->cct}}</div> 
				<div><span>Escuela: </span> {{$nombre->nombre_escuela}}</div> 
				<div><span>Email: </span> {{$nombre->email}}</div>
				<div><span>Tel: </span>{{$nombre->telefono}}</div>
			</div>

			<div id="project2" align="right" >
				<div><span>Fecha: </span> {{$date}}</div>
				<div><span>Director: </span>{{$nombre->email}}</div>
				<div><span>Region: </span>{{$nombre->region}} {{$nombre->sostenimiento}}</div>
				<div><span>Domicilio:</span>{{$nombre->domicilio}}</div>
				<div><span>Localidad:</span>{{$nombre->nom_loc}}</div>
				<div><span>Municipio:</span>{{$nombre->municipio}}</div>
			</div>
		</header>

		<main>


			<h2>PLANTILLA DE PERSONAL PETC:</h2>
			<table name="table_producto" id="table_producto" border="0" cellspacing="0" cellpadding="0">
				<thead>
					<tr>
						<th class="unit">Nombrel del Empleado</th>
						<th class="unit">R.F.C</th>
						<th class="total">Categoria</th>
						<th class="total">Clave</th>
						<th class="total">Fecha Inicial</th>
						<th class="total">Fecha Final</th>					
					</tr>
				</thead>
				<tbody>
					<tr>
						@foreach($personal  as $personal)
						<td class="total">{{$personal->nombre}} </td>
						<td class="unit">{{$personal->rfc}}</td>
						<td class="unit">{{$personal->categoria}} </td> 
						<td class="total">{{$personal->cat_puesto}} </td>
						<td class="unit">{{$personal->fecha_inicio}}</td>
						<td class="unit">{{$personal->fecha_termino}}</td>	
											
					</tr>
					@endforeach	
				</tbody>
				<tfoot>

				</tfoot>
			</table>


			<div><?php echo DNS2D::getBarcodeHTML('{$centro->cct}PP', "QRCODE",3,3);?></div>
			<br/>
		</body>
		</html>