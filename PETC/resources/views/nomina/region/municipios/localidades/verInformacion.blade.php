@extends('layouts.principal')
@section('contenido')
<div class="pull-left breadcrumb_admin clear_both">
	<div class="pull-left page_title theme_color">
		<h1>Inicio</h1>
		<h2 class="">Lista de Localidades </h2>
	</div>
	<div class="pull-right">
		<ol class="breadcrumb">
			<li ><a style="color: #808080" href="{{url('/localidades')}}">Inicio</a></li>
			<li class="active">Lista de Localidades</a></li>
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
							@if($dato2==null)

							@else
							<h4 class="content-header " style="margin-top: -5px;">&nbsp;&nbsp;<strong>Localidades del Municipio : {{$dato2->municipio}}</strong></h4>
							@endif
						</div>
						<div class="btn-group pull-right">
							<b>
								<div class="btn-group" style="margin-right: 10px;">
									<a class="btn btn-sm btn-success tooltips" href="{{URL::action('LocalidadesController@create',[])}}" style="margin-right: 10px;" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Registrar Nueva Localidad"> <i class="fa fa-plus"></i> Registrar </a>



									<a class="btn btn-sm btn-danger tooltips" href="{{URL::action('LocalidadesController@index')}}" style="margin-right: 10px;" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Cancelar"> <i class="fa fa-times"></i> Salir</a>

								</div>

							</a>
						</b>
					</div>

				</div>
			</div>
			<div class="porlets-content container clear_both padding_fix">
				@if($dato==null)
				<div class="alert alert-danger"> <strong>No</strong> se encuentran Localidades registradas  a este Municipio. <a class="alert-link" href="{{URL::action('LocalidadesController@create')}}">Click Para registrar</a></div>

			</b>
		</div>
		@else
		@foreach($dato as $datos)
		<div class="col-lg-6"> 
			<section class="panel default blue_title h4">
				<div class="panel-heading"><span class="semi-bold">{{$datos->nom_loc}}</span> 
				</div>
				<div class="panel-body">

					<table class="table table-striped">

						<tbody>
							<tr>
								<th>Municipio: </th>
								<td>{{$datos->municipio}}</td>
							</tr>
							<tr>
								<th>Localidad:</th>
								<td>{{$datos->nom_loc}}</td>
							</tr>
							<tr>
								<th>Longitud: </th>
								<td>{{$datos->longitud}} KM</td>
							</tr>
							<tr>
								<th>Latitud: </th>
								<td>{{$datos->latitud}}</td>
							</tr>
							<tr>
								<th>Altitud: </th>
								<td> {{$datos->altitud}}</td>
							</tr>
							<tr>
								<th>Población Total: </th>
								<td> {{$datos->pobtot}} Hab.</td>
							</tr>
							<tr>
								<th>Población Masculina: </th>
								<td> {{$datos->pobmas}} Hab.</td>
							</tr>
							<tr>
								<th>Población Femenina: </th>
								<td> {{$datos->pobfem}} Hab.</td>
							</tr>
							<tr>
								<th>Capturo: </th>
								<td> {{$datos->captura}}</td>
							</tr>
							<tr>
								<th>Modificado </th>
								<td> {{$datos->updated_at}}</td>
							</tr>
							<tr>
								<th>Editar: </th>
								<td>      
									<center>
										<a href="{{URL::action('LocalidadesController@edit',$datos->id)}}" class="btn btn-primary btn-sm" role="button"><i class="fa fa-edit"></i></a>  
									</center>
								</td>
							</tr>

						</tbody>
					</table>
				</div>
			</section>
		</div>
		@endforeach
		@endif
	</div><!--/porlets-content-->
</div><!--/block-web-->
</div><!--/col-md-12-->
</div><!--/row-->
</div>
@endsection
