@extends('layouts.principal')
@section('contenido')
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<div class="pull-left breadcrumb_admin clear_both">
	<div class="pull-left page_title theme_color">
		<h1>Inicio</h1>
		<h2 class="">Categoria Puesto</h2>
	</div>
	<div class="pull-right">
		<ol class="breadcrumb">
			<li><a style="color: #808080" href="{{url('cat_puesto')}}">Inicio</a></li>
			<li><a style="color: #808080" href="{{url('cat_puesto')}}">Categoria Puesto</a></li>
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
							<h2 class="content-header" style="margin-top: -5px;"><strong>Agregar Categoria</strong></h2>
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
					<form action="{{route('cat_puesto.store')}}" method="post" class="form-horizontal row-border" parsley-validate novalidate  files="true" enctype="multipart/form-data" accept-charset="UTF-8">
						{{csrf_field()}}



						<div class="form-group">
							<label class="col-sm-3 control-label">Cv_ur: <strog class="theme_color">*</strog></label>
							<div class="col-sm-6">
								<input name="cv_ur" type="text" id="cv_ur" onkeypress="return soloNumeros(event)" maxlength="2" class="form-control" required value="{{Input::old('cv_ur')}}" />
								<div class="help-block with-errors"></div>
							<!--	<div class="text-danger" id='error_ciclo'>{{$errors->formulario->first('ciclo')}}</div>
							--></div>
						</div>

						<div class="form-group">
							<label class="col-sm-3 control-label">Entidad: <strog class="theme_color">*</strog></label>
							<div class="col-sm-6">
								<input name="entidad" id="entidad" type="text" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()" onkeypress="return soloLetras(event)" class="form-control" required value="{{Input::old('entidad')}}" />
								<div class="help-block with-errors"></div>
							<!--	<div class="text-danger" id='error_ciclo'>{{$errors->formulario->first('ciclo')}}</div>
							--></div>
						</div>

						<div class="form-group">
							<label class="col-sm-3 control-label">CCP: <strog class="theme_color">*</strog></label>
							<div class="col-sm-6">
								<input name="ccp" type="text" id="ccp" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()"  class="form-control" required value="{{Input::old('ccp')}}" />
								<div class="help-block with-errors"></div>
							<!--	<div class="text-danger" id='error_ciclo'>{{$errors->formulario->first('ciclo')}}</div>
							--></div>
						</div>

						<div class="form-group">
							<label class="col-sm-3 control-label">NOM_PROG: <strog class="theme_color">*</strog></label>
							<div class="col-sm-6">
								<input name="nom_prog" id="nom_prog" type="text" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()" class="form-control" required value="{{Input::old('nom_prog')}}" />
								<div class="help-block with-errors"></div>
							<!--	<div class="text-danger" id='error_ciclo'>{{$errors->formulario->first('ciclo')}}</div>
							--></div>
						</div>

						<div class="form-group">
							<label class="col-sm-3 control-label">Categoria Puesto: <strog class="theme_color">*</strog></label>
							<div class="col-sm-6">
								<input name="cat_puesto" id="cat_puesto" type="text" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()" class="form-control" required value="{{Input::old('cat_puesto')}}" />
								<div class="help-block with-errors"></div>
							<!--	<div class="text-danger" id='error_ciclo'>{{$errors->formulario->first('ciclo')}}</div>
							--></div>
						</div>

						<div class="form-group">
							<label class="col-sm-3 control-label">Descripcion Puesto: <strog class="theme_color">*</strog></label>
							<div class="col-sm-6">
								<input name="des_puesto" id="des_puesto" type="text" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()" class="form-control" required value="{{Input::old('des_puesto')}}" />
								<div class="help-block with-errors"></div>
							<!--	<div class="text-danger" id='error_ciclo'>{{$errors->formulario->first('ciclo')}}</div>
							--></div>
						</div>

						<div class="form-group">
							<label class="col-sm-3 control-label">Categoria: <strog class="theme_color">*</strog></label>
							<div class="col-sm-6">
								<input id="categoria" name="categoria" type="text" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()"  class="form-control" required value="{{Input::old('categoria')}}" />
								<div class="help-block with-errors"></div>
							<!--	<div class="text-danger" id='error_ciclo'>{{$errors->formulario->first('ciclo')}}</div>
							--></div>
						</div>

						<div class="form-group">
							<label class="col-sm-3 control-label">Tipo Puesto: <strog class="theme_color">*</strog></label>
							<div class="col-sm-6">
								<select name="tipo_puesto" onchange="valida_puesto()"  id="tipo_puesto" class="form-control" required>
									<option selected>
										Selecciona una opción
									</option>
									<option value="DOECENTE">
										DOCENTE
									</option>
									<option value="DIRECTOR">
										DIRECTOR
									</option>
									<option value="INTENDENTE">
										INTENDENTE
									</option>
								</select>
								<div class="help-block with-errors"></div>
								<div class="text-danger" id='error_tipo_puesto'>{{$errors->formulario->first('tipo_puesto')}}</div>
							</div>
						</div><!--/form-group-->


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
								<button type="submit" id="submit" disabled="true" onkeypress="valida_puesto()"  class="btn btn-primary">Guardar</button>
								<a href="{{url('/cat_puesto')}}" class="btn btn-default"> Cancelar</a>
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
  valida_puesto();
};




</script>
@endsection
