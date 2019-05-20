<!DOCTYPE html>
<html lang="es">
<head>
	
	<style media="screen">
		@page { size: 20cm 40cm landscape; }
	</style>
</head>
<body>
		<table >
			
				<tr>
					<th >CCT  </th>
					<th >Nombre Escuela  </th>
					<th >Región  </th>
					<th >Localidad  </th>
					<th >Municipio  </th>
					<th >Teléfono  </th>
					<th>Ciclo  </th>
					<th >Alimentacion  </th>
					<th >Total Alumnos  </th>
					<th >Total Niñas  </th>
					<th >Total Niños  </th>
					<th>Total Grupos  </th>
					<th ">Total Grados  </th>
					<th >Total Director  </th>
					<th >Total Docentes  </th>
					<th >Total E.Fisica  </th>
					<th >Total USAER  </th>
					<th >Total Artistica  </th>
				</tr>
	
			<tbody>
				@foreach($centros as $datos)
				<tr>
					<td >{{$datos->cct}} </td>
					<td >{{$datos->nombre_escuela}}</td>
					<td>{{$datos->region}}-{{$datos->sostenimiento}}</td>
					<td >{{$datos->nom_loc}} </td>
					<td >{{$datos->municipio}}</td>
					<td >{{$datos->telefono}}</td>
					<td >{{$datos->ciclo_escolar}} </td>
					<td >{{$datos->alimentacion}} </td>
					<td >{{$datos->total_alumnos}}</td>		
					<td >{{$datos->total_ninas}}</td>		
					<td >{{$datos->total_ninos}}</td>		
					<td >{{$datos->total_grupos}}</td>		
					<td >{{$datos->total_grados}}</td>		
					<td >{{$datos->total_directores}}</td>		
					<td >{{$datos->total_docentes}}</td>		
					<td >{{$datos->total_fisica}}</td>		
					<td >{{$datos->total_usaer}}</td>		
					<td >{{$datos->total_artistica}}</td>								
				</tr>
				@endforeach
			</tbody>

		</table>
		
	</body>
	</html>