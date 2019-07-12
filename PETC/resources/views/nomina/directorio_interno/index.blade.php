@extends('layouts.principal')
@section('contenido')
<div class="pull-left breadcrumb_admin clear_both">
	<div class="pull-left page_title theme_color">
		<h1>Lista de Empleados PETC </h1>
		<h2 class="">Empleados PETC</h2>
	</div>
	<div class="pull-right">
		<ol class="breadcrumb">
			<li ><a style="color: #808080" href="{{url('/directorio_externo')}}">Inicio</a></li>
			<li class="active">Empleados PETC</a></li>
		</ol>
	</div>
</div>
<div class="container clear_both padding_fix">
	<div class="row">
		<div class="col-md-12">
			<div class="block-web"> 
				<div class="header">
					<div class="row" style="margin-top: 15px; margin-bottom: 12px;">
						<div class="col-sm-7">
							<div class="actions"> </div>
							<h2 class="content-header" style="margin-top: -5px;">&nbsp;&nbsp;<strong>Directorio Interno PETC </strong></h2>
							@include('nomina.directorio_interno.search')
						</div>
						<div class="col-md-5">
							<div class="btn-group pull-right">
								<b>

									<div class="btn-group" style="margin-right: 10px;">
										<a class="btn btn-sm btn-success tooltips" href="{{ route('directorio_interno.create')}}" style="margin-right: 10px;" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Registrar Nuevo Empleado"> <i class="fa fa-plus"></i> Registrar </a>


										<a class="btn btn-sm btn-warning tooltips" href="{{ route('nomina.directorio_interno.excel')}}" style="margin-right: 10px;" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Descargar"> <i class="fa fa-download"></i> Descargar </a>  		

										<a class="btn btn-primary btn-sm" href="{{URL::action('DirectorioInternoController@invoice')}}" style="margin-right: 10px;" data-toggle="tooltip" data-placement="bottom" title="" target="_blank" data-original-title="Descargar"> <i class="fa fa-print"></i> Generar PDF</a>								


									</div>								
								</b>
							</div>
						</div>
					</div>
				</div>

				<div class="porlets-content" >
					<div class="table-responsive">
						<table cellpadding="0" cellspacing="0" border="0"  class="display table table-bordered " id="hidden-table-info16" >
							<thead>   
								<tr>
									<th>Lic.</th>
									<th>Nombre </th>
									<th>R.F.C</th>
									<th>Teléfono</th>
									<th>Email</th>
									<th style="display:none;" >ab </th>
									<th style="display:none;" >curp </th>
									<th style="display:none;" >fecha_nacimiento </th>
									<th style="display:none;" >domicilio </th>
									<th style="display:none;" >num_seguro </th>
									<th style="display:none;" >licenciatura </th>
									<th style="display:none;" >fecha_ingreso </th>
									<th style="display:none;" >fecha_salida </th>
									<th>Imagen</th>
									<th>Puesto</th>
									<th>Área</th>
									<th>Tipo</th>									
									<th style="display:none;" >Sueldo Mensual </th>
									<th style="display:none;" >deducciónes </th>
									<th style="display:none;" >Neto </th>
									<th style="display:none;" >Capturo </th>							
									<th>Estado</th>
									<th style="display:none;" >Modificacion </th>
									<th>Modificar</th>
									<th>Desactivar</th>															
								</tr>
							</thead>
							<tbody>
								@foreach($personal  as $datos)
								@if ($datos->estado == "ACTIVO")     
								<tr class="gradeX">
									<td style="background-color: #DBFFC2;">{{$datos->lic}} </td>
									<td style="background-color: #DBFFC2;">{{$datos->nombre}} </td>
									<td style="background-color: #DBFFC2;">{{$datos->rfc}}</td>
									<td style="background-color: #DBFFC2;">{{$datos->telefono}} </td>
									<td style="background-color: #DBFFC2;">{{$datos->email}} </td>	
									<td style="display:none;" >{{$datos->abrebiatura}} </td>	
									<td style="display:none;" >{{$datos->curp}} </td>	
									<td style="display:none;" >{{$datos->fecha_nacimiento}} </td>	
									<td style="display:none;" >{{$datos->domicilio}} </td>

									<td style="display:none;" >{{$datos->num_seguro}} </td>	
									<td style="display:none;" >{{$datos->licenciatura}} </td>	
									<td style="display:none;" >{{$datos->fecha_ingreso}} </td>	
									<td style="display:none;" >{{$datos->fecha_salida}} </td>	

									<td style="background-color: #DBFFC2;" >									@if(($datos->imagen)!="")
										<img src="{{asset('img/personal_etc/'.$datos->imagen)}}" alt="{{$datos->nombre}}" height="100px" width="100px" class="img-thumbnail">
										@else
										No Hay Imagen Disponible
										@endif
									</td>
									<td style="background-color: #DBFFC2;" >{{$datos->puesto}} </td>	
									<td style="background-color: #DBFFC2;" >{{$datos->area}} </td>	
									<td style="background-color: #DBFFC2;" >{{$datos->tipo}} </td>	
									<td style="display:none;" >{{$datos->sueldo_mensual}} </td>	
									<td style="display:none;" >{{$datos->deducciones}} </td>	
									<td style="display:none;" >{{$datos->neto}} </td>	
									<td style="display:none;" >{{$datos->capturo}} </td>	
									<td style="background-color: #DBFFC2;" >{{$datos->estado}} </td>	
									<td style="display:none;" >{{$datos->created_at}} </td>						
									<td style="background-color: #DBFFC2;"> 
										<a href="{{URL::action('DirectorioInternoController@edit',$datos->id)}}" class="btn btn-primary btn -sm" role="button"><i class="fa fa-edit"></i></a>  
									</td>
									<td style="background-color: #DBFFC2;">
										<a class="btn btn-danger btn-sm" data-target="#modal-delete-{{$datos->id}}" data-toggle="modal" style="margin-right: 10px;"  role="button"><i class="fa fa-eraser"></i></a>
									</td>
									@else
									<tr class="gradeX">
										<td style="background-color: #FFE4E1;">{{$datos->lic}} </td>
										<td style="background-color: #FFE4E1;">{{$datos->nombre}} </td>
										<td style="background-color: #FFE4E1;">{{$datos->rfc}}</td>
										<td style="background-color: #FFE4E1;">{{$datos->telefono}} </td>
										<td style="background-color: #FFE4E1;">{{$datos->email}} </td>	
										<td style="display:none;" >{{$datos->abrebiatura}} </td>	
										<td style="display:none;" >{{$datos->curp}} </td>	
										<td style="display:none;" >{{$datos->fecha_nacimiento}} </td>	
										<td style="display:none;" >{{$datos->domicilio}} </td>

										<td style="display:none;" >{{$datos->num_seguro}} </td>	
										<td style="display:none;" >{{$datos->licenciatura}} </td>	
										<td style="display:none;" >{{$datos->fecha_ingreso}} </td>	
										<td style="display:none;" >{{$datos->fecha_salida}} </td>	

										<td style="background-color: #FFE4E1;" >									@if(($datos->imagen)!="")
											<img src="{{asset('img/personal_etc/'.$datos->imagen)}}" alt="{{$datos->nombre}}" height="100px" width="100px" class="img-thumbnail">
											@else
											No Hay Imagen Disponible
											@endif
										</td>
										<td style="background-color: #FFE4E1;" >{{$datos->puesto}} </td>	
										<td style="background-color: #FFE4E1;" >{{$datos->area}} </td>	
										<td style="background-color: #FFE4E1;" >{{$datos->tipo}} </td>	
										<td style="display:none;" >{{$datos->sueldo_mensual}} </td>	
										<td style="display:none;" >{{$datos->deducciones}} </td>	
										<td style="display:none;" >{{$datos->neto}} </td>	
										<td style="display:none;" >{{$datos->capturo}} </td>	
										<td style="background-color: #FFE4E1;" >{{$datos->estado}} </td>	
										<td style="display:none;" >{{$datos->created_at}} </td>						
										<td style="background-color: #FFE4E1;"> 
											<a href="{{URL::action('DirectorioInternoController@edit',$datos->id)}}" class="btn btn-primary btn -sm" role="button"><i class="fa fa-edit"></i></a>  
										</td>
										<td style="background-color: #FFE4E1;">
											<a class="btn btn-danger btn-sm" data-target="#modal-delete-{{$datos->id}}" data-toggle="modal" style="margin-right: 10px;"  role="button"><i class="fa fa-eraser"></i></a>
										</td>

										@endif
										@include('nomina.directorio_interno.modal')

									</tr>														

									@endforeach
								</tbody>
								<tfoot>
									<tr>
										<th></th> 
										<th>Lic.</th>
										<th>Nombre </th>
										<th>R.F.C</th>
										<th>Teléfono</th>
										<th>Email</th>
										<th style="display:none;" >ab </th>
										<th style="display:none;" >curp </th>
										<th style="display:none;" >fecha_nacimiento </th>
										<th style="display:none;" >domicilio </th>
										<th style="display:none;" >num_seguro </th>
										<th style="display:none;" >licenciatura </th>
										<th style="display:none;" >fecha_ingreso </th>
										<th style="display:none;" >fecha_salida </th>
										<th>Imagen</th>
										<th>Puesto</th>
										<th>Área</th>
										<th>Tipo</th>									
										<th style="display:none;" >Sueldo Mensual </th>
										<th style="display:none;" >deducciónes </th>
										<th style="display:none;" >Neto </th>
										<th style="display:none;" >Capturo </th>							
										<th>Estado</th>
										<th style="display:none;" >Modificacion </th>
										<th>Modificar</th>
										<th>Desactivar</th>						
									</tr>
								</tr>
							</tfoot>
							{!! $personal->render() !!}
						</table>

					</div><!--/table-responsive-->
				</div><!--/porlets-content-->
			</div><!--/block-web-->
		</div><!--/col-md-12-->
	</div><!--/row-->
</div>
<script type="text/javascript">
	window.onload=function() {
		document.getElementById('searchText').focus();

	}

</script>
@endsection
