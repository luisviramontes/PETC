@extends('layouts.principal')
@section('contenido')
<div class="pull-left breadcrumb_admin clear_both">
	<div class="pull-left page_title theme_color">
		<h1>Inicio</h1>
		<h2 class="">Personal SEDUZAC</h2>
	</div>
	<div class="pull-right">
		<ol class="breadcrumb">
			<li><a style="color: #808080" href="{{url('personal')}}">Inicio</a></li>
			<li><a style="color: #808080" href="{{url('personal')}}">Personal</a></li>
		</ol>
	</div>
</div>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<div class="container clear_both padding_fix">
	<div class="row">
		<div class="col-md-12">
			<div class="block-web">
				<div class="header">
					<div class="row" style="margin-top: 15px; margin-bottom: 12px;">
						<div class="col-sm-8">
							<div class="actions"> </div>
							<h2 class="content-header" style="margin-top: -5px;"><strong>Agregar Empleado</strong></h2>
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
					<form action="{{route('personal.store')}}" method="post" class="form-horizontal row-border" parsley-validate novalidate  files="true" enctype="multipart/form-data" accept-charset="UTF-8">
						{{csrf_field()}}




						<div class="form-group">
							<label class="col-sm-3 control-label">Nombre del Empleado: <strog class="theme_color">*</strog></label>
							<div class="col-sm-6">
								<input name="nombre" id="nombre" type="text" onkeypress="return soloLetras(event)"  class="form-control" required value="{{Input::old('nombre')}}"   onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()" />
							</div>
						</div>

      <input name="rfcOculto" id="oculto"  hidden  />
						<div class="form-group">
							<label class="col-sm-3 control-label">RFC: <strog class="theme_color">*</strog></label>
							<div class="col-sm-6">
								<input name="rfc_input" id="rfc_input" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()" type="text"   class="form-control" required value="{{Input::old('rfc_input')}}"   oninput="validarInput(this);validarRFC();"   />
								<div class="text-danger" id='error_rfc'>{{$errors->formulario->first('rfc_input')}}</div>
							</div>
							<pre id="resultado"></pre>						
						</div>

						<div class="form-group">
							<label class="col-sm-3 control-label">Teléfono: <strog class="theme_color"></strog></label>
							<div class="col-sm-6">
								<input name="telefono" type="text"   onkeypress="soloNumeros(event)" class="form-control"  value="{{Input::old('telefono')}}" />
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-3 control-label">Email: <strog class="theme_color"></strog></label>
							<div class="col-sm-6">
								<input name="email" type="text"   class="form-control"  value="{{Input::old('email')}}" />
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-3 control-label">Claves <strog class="theme_color">*</strog></label>
							<div class="col-sm-6">
								<select name="clave" id="clave"  class="form-control select2" required>
									@foreach($claves as $clave)
									<option value="{{$clave->id}}">
										{{$clave->cat_puesto}}: {{$clave->des_puesto}}-{{$clave->tipo_puesto}}
									</option>
									@endforeach
								</select>
								<div class="help-block with-errors"></div>
							</div>
						</div><!--/form-group-->			

						<div class="form-group">
							<div class="col-sm-6">
								<input  id="rfc_val" name="rfc_val" type="hidden"   class="form-control"  />
							</div>
						</div>



						<div class="form-group">
							<div class="col-sm-offset-7 col-sm-5">
								<button id="submit3" type="submit" onclick="return personal_verifica();"  class="btn btn-primary">Guardar</button>
								<a href="{{url('/personal')}}" class="btn btn-default"> Cancelar</a>
							</div>
						</div><!--/form-group-->


					</form>
				</div><!--/porlets-content-->
			</div><!--/block-web-->
		</div><!--/col-md-12-->
	</div><!--/row-->
</div><!--/container clear_both padding_fix-->
@include('nomina.personal.modalreactivar')
<script type="text/javascript">
window.onload=function() {
 document.getElementById('nombre').focus();

}
</script>
@endsection
 