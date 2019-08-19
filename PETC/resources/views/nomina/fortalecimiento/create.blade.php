@extends('layouts.principal')
@section('contenido')
<div class="pull-left breadcrumb_admin clear_both">
	<div class="pull-left page_title theme_color">
		<h1>Inicio</h1>
		<h2 class="">Fortalecimiento</h2>
	</div>
	<div class="pull-right">
		<ol class="breadcrumb">
			<li><a style="color: #808080" href="{{url('fortalecimiento')}}">Inicio</a></li>
			<li><a style="color: #808080" href="{{url('fortalecimiento')}}">Fortalecimiento</a></li>
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
							<h2 class="content-header" style="margin-top: -5px;"><strong>Agregar Fortalecimiento</strong></h2>
						</div>
						<div class="col-md-4">
							<div class="btn-group pull-right">
								<div class="actions">
										<span class="badge badge-info">Subir Fortalecimientos</span>
										<a class="btn btn-sm btn-success tooltips" data-original-title="Subir Fortalecimientos Excel" data-target="#modal-delete" data-toggle="modal" style="margin-right: 10px;"  role="button"><i class="fa fa-plus"></i></a>

										@include('nomina.fortalecimiento.modale')
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="porlets-content">
					<form action="{{route('fortalecimiento.store')}}" method="post" class="form-horizontal row-border" parsley-validate novalidate  files="true" enctype="multipart/form-data" accept-charset="UTF-8">
						{{csrf_field()}}



						<div class="form-group">
							<label class="col-sm-3 control-label">CCT <strog class="theme_color">*</strog></label>
							<div class="col-sm-6">
								<select name="id_cct" id="cct" onchange="validar_cct()" class="form-control select2"  value="{{Input::old('id_cct')}}"  required>
									<option selected>
										Selecciona una opción
									</option>
									@foreach($cct as $cct)
									<option value="{{$cct->id}}">
										{{$cct->cct}}
									</option>
									@endforeach
								</select>
								<div class="help-block with-errors"></div>
								<div class="text-danger" id='error_cct'>{{$errors->formulario->first('cct')}}</div>
							</div>
						</div><!--/form-group-->

						<div class="form-group">
							<label class="col-sm-3 control-label">Monto Fortalecimiento: <strog class="theme_color">*</strog></label>
							<div class="col-sm-6">
								<input name="monto_forta"  id="monto_forta" type="text" onkeypress="return soloNumeros(event)"   class="form-control" required value="{{Input::old('monto_forta')}}" />
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-3 control-label">Ciclo Escolar <strog class="theme_color">*</strog></label>
							<div class="col-sm-6">
								<select name="id_ciclo" id="id_ciclo" onchange="validar_ciclo()" class="form-control"  value="{{Input::old('id_ciclo')}}"  required>
									<option selected>
										Selecciona una opción
									</option>
									@foreach($ciclos as $ciclo)
									<option value="{{$ciclo->id}}">
										{{$ciclo->ciclo}}
									</option>
									@endforeach
								</select>
								<div class="help-block with-errors"></div>
								<div class="text-danger" id='error_ciclo_escolar'>{{$errors->formulario->first('ciclo_escolar')}}</div>
							</div>
						</div><!--/form-group-->



						<div class="form-group">
							<label class="col-sm-3 control-label">Observaciones: <strog class="theme_color">*</strog></label>
							<div class="col-sm-6">
								<input name="observaciones"  id="observaciones" type="text"    class="form-control" required value="{{Input::old('observaciones')}}" />
							</div>
						</div>





					<!--	<div class="form-group">
							<label class="col-sm-3 control-label">Correo enlace <strog class="theme_color">*</strog></label>
							<div class="col-sm-6">
								<select name="ciclo" class="form-control" required>

								</select>
								<div class="help-block with-errors"></div>
							</div>
						</div>--><!--/form-group-->





						<div class="form-group">
							<div class="col-sm-offset-7 col-sm-5">
								<button type="submit" id="submit" class="btn btn-primary">Guardar</button>
								<a href="{{url('/fortalecimiento')}}" class="btn btn-default"> Cancelar</a>
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
		validar_cct();
		validar_ciclo();
	}

function validar_cct() {
		 if( document.getElementById('cct').value == "Selecciona una opción" ){
				document.getElementById('submit').disabled=true;
				document.getElementById('id_ciclo').disabled=true;
		 //	swal("ERROR!","Selecciona tipo se puesto","error");
			 document.getElementById("error_cct").innerHTML = "No se ha seleccionado ninguna opción.";
			 return false

		 }else if(document.getElementById('cct').value != "Selecciona una opción"){
			 			document.getElementById('id_ciclo').disabled=false;
						document.getElementById("error_cct").innerHTML = "";

		 }
	 }

function validar_ciclo() {
	 		 if( document.getElementById('id_ciclo').value == "Selecciona una opción" ){

	 		 //	swal("ERROR!","Selecciona tipo se puesto","error");
	 			 document.getElementById("error_ciclo_escolar").innerHTML = "No se ha seleccionado ninguna opción.";
	 			 return false

	 		 }else if(document.getElementById('id_ciclo').value != "Selecciona una opción"){
	 					document.getElementById('submit').disabled=false;
						document.getElementById("error_ciclo_escolar").innerHTML = "";

	 		 }
}



</script>
@endsection
