@extends('layouts.principal')
@section('contenido')
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

<div class="pull-left breadcrumb_admin clear_both">
	<div class="pull-left page_title theme_color">
		<h1>Inicio</h1>
		<h2 class="">Capturar Nueva Cuenta</h2>
	</div>
	<div class="pull-right">
		<ol class="breadcrumb">
			<li><a style="color: #808080" href="{{url('bancos')}}">Inicio</a></li>
			<li><a style="color: #808080" href="{{url('bancos')}}">Capturar Nueva Cuenta</a></li>
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
							<h2 class="content-header" style="margin-top: -5px;"><strong>Agregar Nueva Cuenta</strong></h2>


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
					<form action="{{route('cuentas.store')}}" method="post" class="form-horizontal row-border" parsley-validate novalidate  files="true" enctype="multipart/form-data" accept-charset="UTF-8">
						{{csrf_field()}}


						<div class="form-group">
							<label class="col-sm-3 control-label">Nombre: <strog class="theme_color">*</strog></label>
							<div class="col-sm-6">
								<input name="nombre" id="nombre" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()" type="text" maxlength=""  class="form-control valid" required value="{{Input::old('nombre_banco')}}" />
								<div class="help-block with-errors"></div>
								<div class="text-danger" id='error_nombre'>{{$errors->formulario->first('nombre')}}</div>
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-3 control-label">Cuenta: <strog class="theme_color">*</strog></label>
							<div class="col-sm-6">
								<input name="num_cuenta" id="num_cuenta" type="text" onkeypress="return soloNumeros(event)" maxlength="16" class="form-control valid" required value="{{Input::old('cuenta')}}" />
								<div class="help-block with-errors"></div>
								<div class="text-danger" id='error_cuenta'>{{$errors->formulario->first('cuenta')}}</div>
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-3 control-label">Clave Interbancaria: <strog class="theme_color">*</strog></label>
							<div class="col-sm-6">
								<input name="clave_in" id="clave_in" type="text" onkeypress="return soloNumeros(event)" maxlength="18" class="form-control valid" required value="{{Input::old('cuenta')}}" />
								<div class="help-block with-errors"></div>
								<div class="text-danger" id='error_clave_in'>{{$errors->formulario->first('clave_in')}}</div>
							</div>
						</div>


						<div class="form-group">
							<label class="col-sm-3 control-label">Secretaria: <strog class="theme_color">*</strog></label>
							<div class="col-sm-6">
								<input name="secretaria" id="secretaria" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()" type="text" maxlength=""  class="form-control valid" required value="{{Input::old('nombre_banco')}}" />
								<div class="help-block with-errors"></div>
								<div class="text-danger" id='error_secretaria'>{{$errors->formulario->first('secretaria')}}</div>
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-3 control-label">Banco: <strog class="theme_color">*</strog></label>
							<div class="col-sm-6">
								<select name="id_banco" id="id_banco" onchange="validar_banco();" class="form-control" value="{{Input::old('nombre_banco')}}" required>
									<option selected>
										Selecciona una opción
									</option>
									@foreach($bancos as $banco)
									<option value="{{$banco->id}}">
										{{$banco->nombre_banco}}
									</option>
									@endforeach


								</select>
								<div class="help-block with-errors"></div>
									<div class="text-danger" id='error_id_banco'>{{$errors->formulario->first('id_banco')}}</div>
							</div>
						</div>



						<div class="form-group">
							<div class="col-sm-offset-7 col-sm-5">

								<button type="submit" id="submit"   onclick="" class="btn btn-primary">Guardar</button>
								<a href="{{url('/cuentas')}" class="btn btn-default"> Cancelar</a>
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
	validar_banco();
}

function validar_banco() {
	 		 if( document.getElementById('id_banco').value == "Selecciona una opción" ){

	 		 //	swal("ERROR!","Selecciona tipo se puesto","error");
	 			 document.getElementById("error_id_banco").innerHTML = "No se ha seleccionado ninguna opción.";
	 			 	document.getElementById('submit').disabled=true;

	 		 }else if(document.getElementById('id_banco').value != "Selecciona una opción"){
	 					document.getElementById('submit').disabled=false;
	 					

	 		 }
}

</script>

@endsection
