@extends('layouts.principal')
@section('contenido')
<div class="pull-left breadcrumb_admin clear_both">
	<div class="pull-left page_title theme_color">
		<h1>Lista de Secretarios,Directores,Jefes,etc.. Registrados en SEDUZAC </h1>
		<h2 class="">Empleados PETC</h2>
	</div>
	<div class="pull-right">
		<ol class="breadcrumb">
			<li ><a style="color: #808080" href="{{url('/directorio_externo')}}">Inicio</a></li>
			<li class="active">Empleados SEDUZAC</a></li>
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
							<h2 class="content-header" style="margin-top: -5px;">&nbsp;&nbsp;<strong>Directorio SEDUZAC </strong></h2>
							@include('nomina.directorio_externo.search')
						</div>
						<div class="col-md-5">
							<div class="btn-group pull-right">
								<b>

									<div class="btn-group" style="margin-right: 10px;">
										<a class="btn btn-sm btn-success tooltips" href="{{ route('directorio_externo.create')}}" style="margin-right: 10px;" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Registrar Nuevo Empleado"> <i class="fa fa-plus"></i> Registrar </a>


										<a class="btn btn-sm btn-warning tooltips" href="{{ route('nomina.directorio_externo.excel')}}" style="margin-right: 10px;" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Descargar"> <i class="fa fa-download"></i> Descargar </a>  		

										<a class="btn btn-primary btn-sm" href="{{URL::action('DirectorioExternoController@invoice')}}" style="margin-right: 10px;" data-toggle="tooltip" data-placement="bottom" title="" target="_blank" data-original-title="Descargar"> <i class="fa fa-print"></i> Generar PDF</a>								


									</div>								
								</b>
							</div>
						</div>
					</div>
				</div>

				<div class="porlets-content" >
					<div class="table-responsive">
						<table cellpadding="0" cellspacing="0" border="0"  class="display table table-bordered " id="hidden-table-info15" >
							<thead>   
								<tr>
									<th>Lic.</th>
									<th>Nombre </th>
									<th>Puesto</th>
									<th style="display:none;" >nombre </th>
									<th style="display:none;" >apellido1 </th>
									<th style="display:none;" >apellido2 </th>
									<th style="display:none;" >a_n </th>
									<th>Dirección</th>
									<th style="display:none;" >a_d </th>
									<th style="display:none;" >Correo</th>
									<th>Ext</th>
									<th>Capturo</th>
									<th>Estado</th>									
									<th style="display:none;" >Modificado </th>
									<th style="display:none;" >Creado </th>	
									<th>Modificar</th>
									<th>Desactivar</th>															
								</tr>
							</thead>
							<tbody>
								@foreach($personal  as $datos)
								@if ($datos->estado == "ACTIVO")     
								<tr class="gradeX">
									<td style="background-color: #DBFFC2;">{{$datos->lic}} </td>
									<td style="background-color: #DBFFC2;">{{$datos->nombre_c}} </td>
									<td style="background-color: #DBFFC2;">{{$datos->puesto}}</td>
									<td style="display:none;" >{{$datos->nombre}} </td>
									<td style="display:none;" >{{$datos->apellido1}} </td>	
									<td style="display:none;" >{{$datos->apellido2}} </td>	
									<td style="display:none;" >{{$datos->a_n}} </td>	
									<td style="background-color: #DBFFC2;" >{{$datos->direccion}} </td>	
									<td style="display:none;" >{{$datos->a_d}} </td>

									<td style="display:none;" >{{$datos->correo}} </td>	
									<td style="background-color: #DBFFC2;" >{{$datos->ext}} </td>	
									<td style="background-color: #DBFFC2;" >{{$datos->captura}} </td>	
									<td style="background-color: #DBFFC2;" >{{$datos->estado}} </td>	
									<td style="display:none;" >{{$datos->updated_at}} </td>
									<td style="display:none;" >{{$datos->created_at}} </td>						
									<td style="background-color: #DBFFC2;"> 
										<a href="{{URL::action('DirectorioExternoController@edit',$datos->id)}}" class="btn btn-primary btn -sm" role="button"><i class="fa fa-edit"></i></a>  
									</td>
									<td style="background-color: #DBFFC2;">
										<a class="btn btn-danger btn-sm" data-target="#modal-delete-{{$datos->id}}" data-toggle="modal" style="margin-right: 10px;"  role="button"><i class="fa fa-eraser"></i></a></
									</td>
									@else
									<tr class="gradeX">
									<td style="background-color: #FFE4E1;">{{$datos->lic}} </td>
										<td style="background-color: #FFE4E1;">{{$datos->nombre_c}} </td>
										<td style="background-color: #FFE4E1;">{{$datos->puesto}}</td>
										<td style="display:none;" >{{$datos->nombre}} </td>
										<td style="display:none;" >{{$datos->apellido1}} </td>	
										<td style="display:none;" >{{$datos->apellido2}} </td>	
										<td style="display:none;" >{{$datos->a_n}} </td>	
										<td style="background-color: #FFE4E1;" >{{$datos->direccion}} </td>	
										<td style="display:none;" >{{$datos->a_d}} </td>

										<td style="display:none;" >{{$datos->correo}} </td>	
										<td style="background-color: #FFE4E1;" >{{$datos->ext}} </td>	
										<td style="background-color: #FFE4E1;" >{{$datos->captura}} </td>	
										<td style="background-color: #FFE4E1;" >{{$datos->estado}} </td>	
										<td style="display:none;" >{{$datos->updated_at}} </td>
										<td style="display:none;" >{{$datos->created_at}} </td>						
										<td style="background-color: #FFE4E1;"> 
											<a href="{{URL::action('DirectorioExternoController@edit',$datos->id)}}" class="btn btn-primary btn -sm" role="button"><i class="fa fa-edit"></i></a>  
										</td>
										<td style="background-color: #FFE4E1;">
											<a class="btn btn-danger btn-sm" data-target="#modal-delete-{{$datos->id}}" data-toggle="modal" style="margin-right: 10px;"  role="button"><i class="fa fa-eraser"></i></a></
										</td>

										@endif
										@include('nomina.directorio_externo.modal')

									</tr>														

									@endforeach
								</tbody>
								<tfoot>
									<tr>
										<th></th> 
										<th>Lic.</th>
									<th>Nombre </th>
									<th>Puesto</th>
									<th style="display:none;" >nombre </th>
									<th style="display:none;" >apellido1 </th>
									<th style="display:none;" >apellido2 </th>
									<th style="display:none;" >a_n </th>
									<th>Dirección</th>
									<th style="display:none;" >a_d </th>
									<th style="display:none;" >Correo</th>
									<th>Ext</th>
									<th>Capturo</th>
									<th>Estado</th>									
									<th style="display:none;" >Modificado </th>
									<th style="display:none;" >Creado </th>	
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
