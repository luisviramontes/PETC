@extends('layouts.principal')
@section('contenido')
<div class="pull-left breadcrumb_admin clear_both">
	<div class="pull-left page_title theme_color">
		<h1>Categorias Puesto </h1>
		<h2 class="">Categorias Puesto</h2>
	</div>
	<div class="pull-right">
		<ol class="breadcrumb">
			<li ><a style="color: #808080" href="{{url('/cat_puesto')}}">Inicio</a></li>
			<li class="active">Tabla de Categorias Puesto</a></li>
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
							<h2 class="content-header" style="margin-top: -5px;">&nbsp;&nbsp;<strong>Categorias Puesto</strong></h2>
							@include('nomina.cat_puesto.search')
            </div>
						<div class="col-md-5">
							<div class="btn-group pull-right">
								<b>

									<div class="btn-group" style="margin-right: 10px;">
											<a class="btn btn-sm btn-success tooltips" href="{{ route('cat_puesto.create')}}" style="margin-right: 10px;" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Registrar Nueva Lista"> <i class="fa fa-plus"></i> Registrar </a>
											<a class="btn btn-sm btn-warning tooltips" href="{{ route('nomina.cat_puesto.excel')}}" style="margin-right: 10px;" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Descargar"> <i class="fa fa-download"></i> Descargar </a>
                  		<a class="btn btn-primary btn-sm" href="{{URL::action('CatPuestoController@invoice','2018-2019')}}" style="margin-right: 10px;" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Descargar"> <i class="fa fa-print"></i> Generar PDF</a>

									</div>

								</a>
							</b>
						</div>
					</div>
				</div>
			</div>

			<div class="porlets-content">
				<div class="table-responsive">
					<table cellpadding="0" cellpadding="0" border="0"  class="display table table-bordered" id="hidden-table-info_cat_puesto">
						<thead>
							<tr>
								<th>CV_UR </th>
								<th>ENTIDAD </th>
								<th style="display:none;" >CCP </th>
								<th>NOM_PROG </th>
								<th>CATEGORIA PUESTO</th>
								<th>DESCRIPCION PUESTO</th>
                <th>CATEGORIA</th>
                <th>TIPO PUESTO</th>
                <th style="display:none;">CAPTURA</th>





								<td><center><b>Editar</b></center></td>
								<td><center><b>Borrar</b></center></td>
							</tr>
						</thead>
						<tbody>
						@foreach($categorias  as $categoria)
							<tr class="gradeX">
								<td>{{$categoria->cv_ur}} </td>
								<td>{{$categoria->entidad}} </td>
								<td style="display:none;">{{$categoria->ccp}}</td>
								<td>{{$categoria->nom_prog}}</td>
								<td>{{$categoria->cat_puesto}} </td>
								<td>{{$categoria->des_puesto}} </td>
								<td>{{$categoria->categoria}} </td>
                <th>{{$categoria->tipo_puesto}}</th>
                <th style="display:none;">{{$categoria->captura}}</th>





								<td>
									<center>
										<a href="{{URL::action('CatPuestoController@edit',$categoria->id)}}" title="Editar" class="btn btn-primary btn-sm" role="button"><i class="fa fa-edit"></i></a>

									</center>
								</td>
								<td>
									<center>
										<a class="btn btn-danger btn-sm" data-target="#modal-delete-{{$categoria->id}}" data-toggle="modal" style="margin-right: 10px;"  role="button"><i class="fa fa-eraser"></i></a></center>
									</center>
									</td>
								</td>
							</tr>
							@include('nomina.cat_puesto.modal')
							@endforeach
						</tbody>
						<!--<tfoot>
							<tr>
                <th></th>
								<th>Quincena </th>
								<th>Dias Trabajados</th>
								<th>Pago por Director </th>
								<th>Pago por Docente </th>
								<th>Pago por Intendente </th>
								<th>Ciclo </th>>
								<th>Capturo </th>
								<th>Modificado</th>


								<td><center><b>Editar</b></center></td>
								<td><center><b>Borrar</b></center></td>
							</tr>
						</tfoot> -->
					</table>
					{!! $categorias->render() !!}
				</div><!--/table-responsive-->
			</div><!--/porlets-content-->
		</div><!--/block-web-->
	</div><!--/col-md-12-->
</div><!--/row-->
</div>
@endsection
