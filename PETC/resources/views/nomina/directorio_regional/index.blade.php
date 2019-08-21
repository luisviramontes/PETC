@extends('layouts.principal')
@section('contenido')
<div class="pull-left breadcrumb_admin clear_both">
	<div class="pull-left page_title theme_color">
		<h1>Directorio Regional </h1>
		<h2 class="">Directorios</h2>
	</div>
	<div class="pull-right">
		<ol class="breadcrumb">
			<li ><a style="color: #808080" href="{{url('/')}}">Inicio</a></li>
			<li class="active">Directorio Regional</a></li>
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
							<h2 class="content-header" style="margin-top: -5px;">&nbsp;&nbsp;<strong>Tabla de Directorios</strong></h2>
								@include('nomina.directorio_regional.search')
						</div>
						<div class="col-md-5">
							<div class="btn-group pull-right">
								<b>

									<div class="btn-group" style="margin-right: 10px;">
										<a class="btn btn-sm btn-success tooltips" href="{{ route('directorio_regional.create')}}" style="margin-right: 10px;" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Registrar Nuevo Directorio"> <i class="fa fa-plus"></i> Registrar </a>
										<a class="btn btn-sm btn-warning tooltips" href="{{ route('nomina.directorio_regional.excel')}}" style="margin-right: 10px;" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Descargar"> <i class="fa fa-download"></i> Descargar </a>
										<a class="btn btn-primary btn-sm" href="{{URL::action('DirectorioRegionalController@invoice','2018-2019')}}" style="margin-right: 10px;" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Descargar"> <i class="fa fa-print"></i> Generar PDF</a>


									</div>

								</a>
							</b>
						</div>
					</div>
				</div>
			</div>

			<div class="porlets-content">
				<div class="table-responsive">
					<table cellpadding="0" cellpadding="0" border="0"  class="display table table-bordered" id="hidden-table-info_dir">
						<thead>
							<tr>
								<th>Region </th>
								<th>Sostenimiento</th>
								<th>Nombre Enlace </th>
								<th>Telefono </th>
								<th style="display:none;">Ext1 Enlace </th>
								<th style="display:none;">Ext2 Enlace </th>
								<th style="display:none;">Correo Enlace </th>
								<th>Director Regional </th>
                <th>Telefono Director </th>
                <th>Financiero Regional </th>
                <th style="display:none;">Telefono Regional </th>
                <th style="display:none;">Extencion Regional 1 </th>
                <th style="display:none;">Extencion Regional 2 </th>
								<th>Estado </th>
								<th style="display:none;">Captura </th>


								<td><center><b>Editar</b></center></td>
								<td><center><b>Borrar</b></center></td>
							</tr>
						</thead>
						<tbody>
						@foreach($directorio_regional  as $directorio_regional)
						@if ($directorio_regional->estado == "ACTIVO")
							<tr class="gradeX">
								<td style="background-color:#DBFFC2;">{{$directorio_regional->region}} </td>
								<td style="background-color:#DBFFC2;">{{$directorio_regional->sostenimiento}} </td>
								<td style="background-color:#DBFFC2;">{{$directorio_regional->nombre_enlace}} </td>
								<td style="background-color:#DBFFC2;">{{$directorio_regional->telefono}} </td>
								<td style="display:none;">{{$directorio_regional->ext1_enlace}} </td>
								<td style="display:none;">{{$directorio_regional->ext2_enlace}} </td>
								<td style="display:none;">{{$directorio_regional->correo_enlace}} </td>
                <td style="background-color:#DBFFC2;">{{$directorio_regional->director_regional}} </td>
                <td style="background-color:#DBFFC2;">{{$directorio_regional->telefono_director}} </td>
                <td style="background-color:#DBFFC2;">{{$directorio_regional->financiero_regional}} </td>
								<td style="display:none;">{{$directorio_regional->telefono_regional}}</td>
                <td style="display:none;">{{$directorio_regional->ext_reg_1}} </td>
                <td style="display:none;">{{$directorio_regional->ext_reg_2}} </td>
								<td style="background-color:#DBFFC2;">{{$directorio_regional->estado}}</td>
                <td style="display:none">{{$directorio_regional->captura}} </td>

								<!-- //////////////////////////////////////////////////////////////////// -->





							<td style="background-color:#DBFFC2;">
								<center>
									<a href="{{URL::action('DirectorioRegionalController@edit',$directorio_regional->id)}}" id="edit" onchange="" title="Editar" class="btn btn-primary btn-sm" role="button"><i class="fa fa-edit"></i></a>

								</center>
							</td>


							<td style="background-color:#DBFFC2;">
								<center>
									<a class="btn btn-danger btn-sm" data-target="#modal-delete-{{$directorio_regional->id}}" data-toggle="modal" style="margin-right: 10px;"  role="button"><i class="fa fa-eraser"></i></a></center>

								</center>
								</td>
							</td>


							</tr>
							@else

							<tr class="gradeX">
								<td style="background-color:#FFE4E1;">{{$directorio_regional->region}} </td>
								<td style="background-color:#FFE4E1;">{{$directorio_regional->sostenimiento}} </td>
								<td style="background-color:#FFE4E1;">{{$directorio_regional->nombre_enlace}} </td>
								<td style="background-color:#FFE4E1;">{{$directorio_regional->telefono}} </td>
								<td style="display:none;">{{$directorio_regional->ext1_enlace}} </td>
								<td style="display:none;">{{$directorio_regional->ext2_enlace}} </td>
								<td style="display:none;">{{$directorio_regional->correo_enlace}} </td>
                <td style="background-color:#FFE4E1;">{{$directorio_regional->director_regional}} </td>
                <td style="background-color:#FFE4E1;">{{$directorio_regional->telefono_director}} </td>
                <td style="background-color:#FFE4E1;">{{$directorio_regional->financiero_regional}} </td>
								<td style="display:none;">{{$directorio_regional->telefono_regional}}</td>
                <td style="display:none;">{{$directorio_regional->ext_reg_1}} </td>
                <td style="display:none;">{{$directorio_regional->ext_reg_2}} </td>
								<td style="background-color:#FFE4E1;">{{$directorio_regional->estado}}</td>
                <td style="display:none">{{$directorio_regional->captura}} </td>


								<td style="background-color:#FFE4E1;">
									<center>
										<a href="{{URL::action('DirectorioRegionalController@edit',$directorio_regional->id)}}" title="Editar" class="btn btn-primary btn-sm" role="button"><i class="fa fa-edit"></i></a>
									</center>
								</td>
								<td style="background-color:#FFE4E1;">
									<center>
										<a class="btn btn-danger btn-sm" data-target="#modal-delete-{{$directorio_regional->id}}" data-toggle="modal" style="margin-right: 10px;"  role="button"><i class="fa fa-eraser"></i></a></center>
									</center>
									</td>
								</td>
							</tr>

							@endif

							@include('nomina.directorio_regional.modal')
							@endforeach
						</tbody>
						<tfoot>
							<tr>
								<th></th>
								<th>Region </th>
								<th>Sostenimiento</th>
								<th>Nombre Enlace </th>
								<th>Telefono </th>
								<th style="display:none;">Ext1 Enlace </th>
								<th style="display:none;">Ext2 Enlace </th>
								<th style="display:none;">Correo Enlace </th>
								<th>Director Regional </th>
								<th>Telefono Director </th>
								<th>Financiero Regional </th>
								<th style="display:none;">Telefono Regional </th>
								<th style="display:none;">Extencion Regional 1 </th>
								<th style="display:none;">Extencion Regional 2 </th>
								<th>Estado </th>
								<th style="display:none;">Captura </th>


								<td><center><b>Editar</b></center></td>
								<td><center><b>Borrar</b></center></td>
							</tr>
						</tfoot>
					</table>
				</div><!--/table-responsive-->
			</div><!--/porlets-content-->
		</div><!--/block-web-->
	</div><!--/col-md-12-->
</div><!--/row-->
</div>
@endsection
