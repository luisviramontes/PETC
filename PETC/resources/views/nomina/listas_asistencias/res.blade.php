
<!DOCTYPE html>
@foreach($centros as $centros)
@for($y=1;$y < 3; $y++)
<html lang="es">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<title>Listas de Asistencias {{$captura_n}}</title>
	<link rel="stylesheet" href="css/plantilla_genera.css" media="all" /> 
	<style media="screen">
		@page { size: 21cm 29.7cm landscape; }
	</style>
</head>
<body>
	<header class="clearfix">
		<div id="logo">
			<img src="img/logopetc3.jpg"  width="1200"  height="70"/></div>



			<h1>PROGRAMA ESCUELAS DE TIEMPO COMPLETO <br>REGISTRO DE ASISTENCIA " MES {{$mes_aux}} " <br> CICLO ESCOLAR {{$ciclo_aux}}</h1>
		</header>
		<div>
			<h2> MES: <u>    {{$mes_aux}}    </u>&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;    NOMBRE DE LA ESCUELA:  <u> {{$centros->nombre_escuela}}</u> &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;  C.C.T:  <u> {{$centros->cct}} </u></h2> 
		</div>
		<main>
			<table class="table table-bordered" >
				<thead>
					<tr>
						<th class="desc" >N°</th>
						<th  class="desc" >NOMBRE DEL DOCENTE</th>
						<th  class="desc" >&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;R.F.C &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;</th>
						<th  class="desc" >&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;PUESTO&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;</th>
						<th class="desc"  >&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;FIRMA&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;</th>
						@for($i=0;$i < $cuenta_dias; $i++)
						<th  class="desc" >{{$dias[$i]->l_semana}} <br> <br> {{$dias[$i]->dia}} </th>
						@endfor
					</tr>
				</thead>
				<tbody>
					@if($y == 1)
					@for($x=0;$x < 14; $x++)				
					<tr>
						@if($x >= $captura_n)
						<td class="no"> {{$x+1}} </td>
						<td class="no"> </td>
						<td class="no"> </td>
						<td class="no"> </td>
						<td class="no"> </td>
						@for($i=0;$i < $cuenta_dias; $i++)
						<td class="no"> </td>
						@endfor
						@else
						<td class="no"> {{$x+1}} </td>
						@if($captura[$x]->id_cct_etc == $centros->id)
						<td class="no"> {{$captura[$x]->nombre}}</td>
						<td class="no"> {{$captura[$x]->rfc}}</td>
						<td class="no"> {{$captura[$x]->categoria}}</td>
						@else
						<td class="no"> </td>
						<td class="no"> </td>
						<td class="no"> </td>
						@endif					
						<td class="no"> </td>
						@for($i=0;$i < $cuenta_dias; $i++)
						<td class="no"> </td>
						@endfor				
						@endif							
						@endfor
					</tr>
					@else
					@for($x=15;$x < 29; $x++)
					<tr>
						@if($x >= $captura_n)
						<td class="no"> {{$x}} </td>
						<td class="no"> </td>
						<td class="no"> </td>
						<td class="no"> </td>
						<td class="no"> </td>
						@for($i=0;$i < $cuenta_dias; $i++)
						<td class="no"> </td>
						@endfor
						@else
						<td class="no"> {{$x+1}} </td>
						<td class="no"> {{$captura[$x]->nombre}}</td>
						<td class="no"> {{$captura[$x]->rfc}}</td>
						<td class="no"> {{$captura[$x]->categoria}}</td>
						<td class="no"> </td>
						@for($i=0;$i < $cuenta_dias; $i++)
						<td class="no"> </td>
						@endfor				
						@endif							
						@endfor
					</tr>

					@endif



				</tbody>
			</table>
			<br> <br>
			<h2> &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;DIRECTOR    &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;    PRESIDENTE A.P.F   &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; SUPERVISOR   &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; COORDINADOR ETC &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; DIRECTOR REGIONAL  </h2>
			<br> <br>


			<h2>______________________ &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;    ______________________ &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; ______________________ &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; ______________________&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ______________________  </h2>

			<h3> &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;{{$centros->nombre}} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;    ______________________ &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; ______________________   &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; {{$centros->nombre_enlace}}&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; {{$centros->director_regional}}  </h3>


			<div><?php echo DNS1D::getBarcodeHTML("$centros->cct"."-LA-"."$mes_aux", "C128",1,40);?>  </div>

			<h4><u>NOTA:</u> Asistencia se marcara °, Inasistencia /, Permiso Economico P, Incapacidad I.</h4>
			<h4> &nbsp;&nbsp; En la Columna de Puesto Especificar Director,Docente Frente a Grupo, USAER,Eduación Fisica e Intendente</h4>

			<h4>HOJA {{$y}} DE 2 </h4>
		</body>
		@endfor
		@endforeach
		</html>

