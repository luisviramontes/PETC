@extends('layouts.principal')
@section('contenido')
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

<div class="pull-left breadcrumb_admin clear_both">
	<div class="pull-left page_title theme_color">
		<h1>Inicio</h1>
		<h2 class="">Capturar Nomina</h2>
	</div>
	<div class="pull-right">
		<ol class="breadcrumb">
			<li><a style="color: #808080" href="{{url('estadistica911')}}">Inicio</a></li>
			<li><a style="color: #808080" href="{{url('estadistica911')}}">Capturar Estadistica 911</a></li>
		</ol>
	</div>
</div>
<div class="container clear_both padding_fix">
	<div class="row">
		<div class="col-md-12">
			<div class="block-web">
				<div class="header">
					<div class="row" style="margin-top: 15px; margin-bottom: 12px;">
						<div class="col-sm-8">
							<div class="actions"> </div>
							<h2 class="content-header" style="margin-top: -5px;"><strong>Agregar Estadistica 911</strong></h2>


						</div>
						<div class="col-md-4">
							<div class="btn-group pull-right">
								<div class="actions">
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="porlets-content">
					<form action="{{route('estadistica911.store')}}" method="post" class="form-horizontal row-border" parsley-validate novalidate  files="true" enctype="multipart/form-data" accept-charset="UTF-8">
						{{csrf_field()}}

						<div class="form-group">
							<label class="col-sm-3 control-label">Seleccione Ciclo Escolar: <strog class="theme_color"></strog></label>
							<div class="col-sm-6">
								<select name="ciclo_escolar" id="ciclo_escolar"  onchange="buscar_estadistica();" class="form-control select2">
									@foreach($ciclos as $ciclo)
									@if($ciclo->id == 2)
									<option value='{{$ciclo->id}}' selected>
										{{$ciclo->ciclo}}
									</option>
									@else
									<option value='{{$ciclo->id}}' >
										{{$ciclo->ciclo}}
									</option>
									@endif
									@endforeach
								</select>

							</div>
						</div>



						<div class="form-group">
							<label class="col-sm-3 control-label">Subir Archivo: <strog class="theme_color">*</strog></label>
							<div class="col-sm-6">

								<input type="file" id="file" name="file" required=""  accept=".csv, .xlsx" >
								<div class="text-danger" id='error_file'>{{$errors->formulario->first('file')}}</div>

							</div>
						</div>




						<div align="center">
							<h4 class="content-header " style="margin-top: -5px;">&nbsp;&nbsp;<strong> Nota: <u> <b> El archivo excel Tiene que Llevar los encabezados de la Siguiente Forma </b> </u> </strong></h4>
							<img src="{{asset('img/ejemplos/e911.png')}}" id="src"  alt="correcto" height="1000px" width="1000px" class="img-thumbnail">

						</div>



					<!--	<div class="form-group">
							<label class="col-sm-3 control-label">Correo enlace <strog class="theme_color">*</strog></label>
							<div class="col-sm-6">
								<select name="ciclo" class="form-control" required>

								</select>
								<div class="help-block with-errors"></div>
							</div>
						</div>--><!--/form-group-->


						@include('nomina.estadistica911.modale')



						<div class="form-group">
							<div class="col-sm-offset-7 col-sm-5">

								<button type="submit" id="submit"   onclick="modal_loading();" class="btn btn-primary">Guardar</button>
								<a href="{{url('/estadistica911')}" class="btn btn-default"> Cancelar</a>
							</div>
						</div><!--/form-group-->


					</form>
				</div><!--/porlets-content-->
			</div><!--/block-web-->
		</div><!--/col-md-12-->
	</div><!--/row-->
</div><!--/container clear_both padding_fix-->

<script type="text/javascript">
	window.onload = function() {
	}

	function verifica(){
		
	}
</script>

@endsection
