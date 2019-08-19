@extends('layouts.principal')
@section('contenido')
<div class="pull-left breadcrumb_admin clear_both">
	<div class="pull-left page_title theme_color">
		<h1>OFICIOS PENDIENTES </h1>
		<h2 class="">OFICIOS PENDIENTES PETC</h2>
	</div>
	<div class="pull-right">
		<ol class="breadcrumb">
			<li ><a style="color: #808080" href="{{url('/oficiosemitidos2/2')}}">Inicio</a></li>
			<li class="active">OFICIOS PENDIENTES PETC</a></li>
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
							<h2 class="content-header" style="margin-top: -5px;">&nbsp;&nbsp;<strong>OFICIOS PENDIENTES: {{$contador}}</strong></h2>
							@include('administrativa.oficios_emitidos.search')

						</div>
						<div class="col-md-5">
							<div class="btn-group pull-right">
								<b>

									<div class="btn-group" style="margin-right: 10px;">
										<a class="btn btn-sm btn-success tooltips" href="{{ route('oficiosemitidos.create')}}" style="margin-right: 10px;" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Registrar Nuevo Empleado"> <i class="fa fa-plus"></i> Registrar </a>


										<a class="btn btn-sm btn-warning tooltips" href="{{ route('administrativa.oficios-emitidos.excel',$ciclo_escolar)}}" style="margin-right: 10px;" data-toggle="tooltip" data-placement="bottom" id="excel" title="" data-original-title="Descargar"> <i class="fa fa-download"></i> Descargar </a>  

										<a class="btn btn-primary btn-sm"  href="{{URL::action('ReclamosController@ver_reclamos')}}" style="margin-right: 10px;" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Cancelar"> <i class="fa fa-eye"></i> Ver Oficios</a>
										


									</div>								
								</b>
							</div>
						</div>
					</div>
				</div> 

				<div class="porlets-content" >
					<div class="table-responsive">
						<table cellpadding="0" cellspacing="0" border="0"  class="display table table-bordered " id="hidden-table-info20" >
							<thead>    
								<tr>
									<th>N° Oficio</th>
									<th style="display:none;" >Nom Oficio</th>
									<th>Dirigido Para </th>
									<th>Dirección</th>
									<th>Puesto Dirigido</th>
									<th style="display:none;" >Lic Dirigido</th>
									<th style="display:none;" >Ext </th>
									<th style="display:none;" >Correo </th>	
									<th>Asunto</th>
									<th style="display:none;" >Referencia </th>
									<th>Fecha de Salida </th>
									<th style="display:none;" >Observaciónes </th>
									<th>*PDF</th>
									<th>Estado</th>
									<th style="display:none;" >Ciclo Escolar</th>
									<th>Elaboro Oficio</th>						
									<th style="display:none;" >Lic elaboro </th>
									<th style="display:none;" >Puesto </th>						
									<th>Área</th>	
									<th>Modificar</th>
									<th>Resuelto</th>
									<th style="display:none;" >Capturo </th>	
									<th style="display:none;" >Fecha </th>	
								</tr>
							</thead>
							<tbody>
								@foreach($oficios  as $oficios)
								@if ($oficios->estado == "RESUELTO")     
								<tr class="gradeX">
									<td style="background-color: #DBFFC2;">{{$oficios->num_oficio}} </td>
									<td style="display:none;" >{{$oficios->nombre_oficio}} </td>
									<td style="background-color: #DBFFC2;" >{{$oficios->licext}} {{$oficios->nombre_c}} </td>
									<td style="background-color: #DBFFC2;" >{{$oficios->direccion}}</td>
									<td style="background-color: #DBFFC2;" >{{$oficios->puestoext}}</td>
									<td style="display:none;" >{{$oficios->licext}} </td>			
									<td style="display:none;" >{{$oficios->ext}} </td>
									<td style="display:none;" >{{$oficios->correo}} </td>	
									<td style="background-color: #DBFFC2;" >{{$oficios->asunto}} </td>
									<td style="display:none;" >{{$oficios->referencia}} </td>				
									<td style="background-color: #DBFFC2;" >{{$oficios->salida}} </td>
									<td style="display:none;" >{{$oficios->observaciones}} </td>
									<td style="background-color: #DBFFC2;">
									@if(($oficios->archivo)!="")
									<a href="/img/oficiosemitidos/{{$oficios->archivo}}"  target="_blank" class="btn btn-info btn-lg">
									<span class="glyphicon glyphicon-picture"> </span>Ver
									</a>
									@else									

									<a class="btn btn-info btn-lg" data-target="#modal-delete3-{{$oficios->id}}" data-toggle="modal" style="margin-right: 10px;"  role="button"><i class="glyphicon glyphicon-picture"></i>Subir</a>

									@endif
									</td>
									<td style="background-color: #DBFFC2;">{{$oficios->estado}} </td>
									<td style="display:none;" >{{$oficios->ciclo}} </td>
									<td style="background-color: #DBFFC2;"> {{$oficios->lic}} {{$oficios->nombre}} </td>
									<td style="display:none;" >{{$oficios->lic}} </td>
									<td style="display:none;" >{{$oficios->puesto}} </td>
									<td style="background-color: #DBFFC2;">{{$oficios->area}} </td>

									<td style="background-color: #DBFFC2;"> 
										<a href="{{URL::action('OficiosEmitidosController@edit',$oficios->id)}}" class="btn btn-primary btn -sm" role="button"><i class="fa fa-edit"></i></a>  
									</td>
									<td style="background-color: #DBFFC2;">
										</td>
										<td style="display:none;" >{{$oficios->captura}} </td>	
										<td style="display:none;" >{{$oficios->updated_at}} </td>


									</tr>
									@else
									<tr class="gradeX">		

										<td style="background-color: #FFE4E1;">{{$oficios->num_oficio}} </td>
										<td style="display:none;" >{{$oficios->nombre_oficio}} </td>
										<td style="background-color: #FFE4E1;" >{{$oficios->licext}} {{$oficios->nombre_c}} </td>
										<td style="background-color: #FFE4E1;" >{{$oficios->direccion}}</td>
										<td style="background-color: #FFE4E1;" >{{$oficios->puestoext}}</td>
										<td style="display:none;" >{{$oficios->licext}} </td>			
										<td style="display:none;" >{{$oficios->ext}} </td>
										<td style="display:none;" >{{$oficios->correo}} </td>	
										<td style="background-color: #FFE4E1;" >{{$oficios->asunto}} </td>
										<td style="display:none;" >{{$oficios->referencia}} </td>				
										<td style="background-color: #FFE4E1;" >{{$oficios->salida}} </td>
										<td style="display:none;" >{{$oficios->observaciones}} </td>
										<td style="background-color: #FFE4E1;">
									@if(($oficios->archivo)!="")
									<a href="/img/oficiosemitidos/{{$oficios->archivo}}"  target="_blank" class="btn btn-info btn-lg">
									<span class="glyphicon glyphicon-picture"> </span>Ver
									</a>
									@else									

									<a class="btn btn-info btn-lg" data-target="#modal-delete3-{{$oficios->id}}" data-toggle="modal" style="margin-right: 10px;"  role="button"><i class="glyphicon glyphicon-picture"></i>Subir</a>

									@endif
									</td>
										<td style="background-color: #FFE4E1;">{{$oficios->estado}} </td>
										<td style="display:none;" >{{$oficios->ciclo}} </td>
										<td style="background-color: #FFE4E1;">{{$oficios->lic}}  {{$oficios->nombre}} </td>
										<td style="display:none;" >{{$oficios->lic}} </td>
										<td style="display:none;" >{{$oficios->puesto}} </td>
										<td style="background-color: #FFE4E1;">{{$oficios->area}} </td>

										<td style="background-color: #FFE4E1;"> 
											<a href="{{URL::action('OficiosEmitidosController@edit',$oficios->id)}}" class="btn btn-primary btn -sm" role="button"><i class="fa fa-edit"></i></a>  
										</td>
										<td style="background-color: #FFE4E1;">
											<a class="btn btn-sm btn-success tooltips" data-target="#modal-delete-{{$oficios->id}}" data-toggle="modal" style="margin-right: 10px;"  role="button"><i class="glyphicon glyphicon-ok"></i></a></</td>
											<td style="display:none;" >{{$oficios->captura}} </td>	
											<td style="display:none;" >{{$oficios->updated_at}} </td>
										</tr>
										@endif															

										
										@include('administrativa.oficios_emitidos.modal')
										@include('administrativa.oficios_emitidos.subir')
										@endforeach

									</tbody>
									<tfoot>
										<tr>
											<th></th>
											<th>N° Oficio</th>
											<th style="display:none;" >Nom Oficio</th>
											<th>Dirigido Para </th>
											<th>Dirección</th>
											<th>Puesto Dirigido</th>
											<th style="display:none;" >Lic Dirigido</th>
											<th style="display:none;" >Ext </th>
											<th style="display:none;" >Correo </th>	
											<th>Asunto</th>
											<th style="display:none;" >Referencia </th>
											<th>Fecha de Salida </th>
											<th style="display:none;" >Observaciónes </th>
											<th>*PDF</th>
											<th>Estado</th>
											<th style="display:none;" >Ciclo Escolar</th>
											<th>Elaboro Oficio</th>						
											<th style="display:none;" >Lic elaboro </th>
											<th style="display:none;" >Puesto </th>						
											<th>Área</th>	
											<th>Modificar</th>
											<th>Resuelto</th>
											<th style="display:none;" >Capturo </th>	
											<th style="display:none;" >Fecha </th>	
										</tr>
									</tfoot>

								</table>

							</div><!--/table-responsive-->
						</div><!--/porlets-content-->
					</div><!--/block-web-->
				</div><!--/col-md-12-->
			</div><!--/row-->
		</div>


<script type="text/javascript">
	window.onload=function(){
		  var x =document.getElementById('ciclo_escolar').value;
           document.getElementById('excel').href="/descargar-oficios-emitidos/"+x; 
      //document.getElementById('invoice').href="/pdf-cuadros-cifras/"+x; 
    
	}

	function cambia_ruta_oe(){
		 var x =document.getElementById('ciclo_escolar').value;
           document.getElementById('excel').href="/descargar-oficios-emitidos/"+x; 
          // document.getElementById('invoice').href="/pdf-cuadros-cifras/"+x; 
	}


</script>
		@endsection
