@extends('layouts.principal')
@section('contenido')
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
							<h2 class="content-header" style="margin-top: -5px;">&nbsp;&nbsp;<strong></strong></h2>

						</div>
						<div class="col-md-5">
							<div class="btn-group pull-right">
								<b>

									<div class="btn-group" style="margin-right: 10px;">
										<a class="btn btn-sm btn-success tooltips" href="https://calendar.google.com/calendar/r?cid=tiberio@seduzac.gob.mx"  target="_blank"  style="margin-right: 10px;" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Registrar Nuevo Empleado"> <i class="fa fa-plus"></i> Registrar Nuevo Evento</a>


										<a class="btn btn-sm btn-warning tooltips" href="https://calendar.google.com/calendar/exporticalzip?cexp=dGliZXJpb0BzZWR1emFjLmdvYi5teA" style="margin-right: 10px;" data-toggle="tooltip" data-placement="bottom" id="excel" title="" data-original-title="Descargar"> <i class="fa fa-download"></i> Descargar </a>  									
										


									</div>								
								</b>
							</div>
						</div>
					</div>
				</div> 

				<iframe src="https://calendar.google.com/calendar/embed?src=tiberio%40seduzac.gob.mx&ctz=America%2FMexico_City" style="border: 0" width="800" height="600" frameborder="0" scrolling="no"></iframe>


					</div><!--/block-web-->
				</div><!--/col-md-12-->
			</div><!--/row-->
		</div>



		@endsection


@endsection