@extends('layouts.principal')
@section('contenido')
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<div class="pull-left breadcrumb_admin clear_both">
	<div class="pull-left page_title theme_color">
		<h1>Inicio</h1>
		<h2 class="">Directorio Externo SEDUZAC</h2>
	</div>
	<div class="pull-right">
		<ol class="breadcrumb">
			<li><a style="color: #808080" href="{{url('directorio_externo')}}">Inicio</a></li>
			<li><a style="color: #808080" href="{{url('directorio_externo')}}">Directorio Externo SEDUZAC</a></li>
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
							<h2 class="content-header" style="margin-top: -5px;"><strong>Agregar Nuevo Registro</strong></h2>
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
					<form action="{{route('directorio_externo.store')}}" method="post" class="form-horizontal row-border" parsley-validate novalidate  files="true" enctype="multipart/form-data" accept-charset="UTF-8">
						{{csrf_field()}}



						<div class="form-group">
							<label class="col-sm-3 control-label">LIC;<strog class="theme_color">*</strog></label>
							<div class="col-sm-6">
								<select name="lic" id="lic" class="form-control select2" required> 
									<option value="Mtro" >Mtro</option>
									<option value="Mtra" selected>Mtra </option>
									<option value="Dra">Dra</option>
									<option value="Dr">Dr</option>
									<option value="Ing">Ing</option>	
									<option value="Lic">Lic</option>
									<option value="Prof">Prof</option>
									<option value="Profa">Profa</option>				
								</select>
								
							</div> 
						</div>

						<div class="form-group">
							<label class="col-sm-3 control-label">Nombre: <strog class="theme_color">*</strog></label>
							<div class="col-sm-6">
								<input name="nombre" id="nombre" type="text" onchange="cambia_nombre();" onkeypress="return soloLetras(event)"  class="form-control" required value="{{Input::old('nombre')}}"   onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()" />
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-3 control-label">Apellido Paterno: <strog class="theme_color">*</strog></label>
							<div class="col-sm-6">
								<input name="paterno" id="paterno" type="text" onchange="cambia_nombre();" onkeypress="return soloLetras(event)"  class="form-control" required value="{{Input::old('nombre')}}"   onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()" />
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-3 control-label">Apellido Materno: <strog class="theme_color">*</strog></label>
							<div class="col-sm-6">
								<input name="materno" id="materno" type="text" onchange="cambia_nombre();" onkeypress="return soloLetras(event)"  class="form-control" required value="{{Input::old('nombre')}}"   onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()" />
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-3 control-label">A_N: <strog class="theme_color">*</strog></label>
							<div class="col-sm-6">
								<input name="a_n" id="a_n" type="text"  onkeypress="return soloLetras(event)"  class="form-control" required value="{{Input::old('nombre')}}"   onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()" />
							</div>
						</div>



						<div class="form-group">
							<label class="col-sm-3 control-label">Puesto: <strog class="theme_color">*</strog></label>
							<div class="col-sm-6">
								<input name="puesto" id="puesto" type="text" onkeypress="return soloLetras(event)"  class="form-control" required value="{{Input::old('nombre')}}"   onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()" />
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-3 control-label">Dirección: <strog class="theme_color">*</strog></label>
							<div class="col-sm-6">
								<input name="direccion" id="direccion" type="text" onchange="cambia_direccion();" onkeypress="return soloLetras(event)"  class="form-control" required value="{{Input::old('nombre')}}"   onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()" />
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-3 control-label">A_D: <strog class="theme_color">*</strog></label>
							<div class="col-sm-6">
								<input name="a_d" id="a_d" type="text" onkeypress="return soloLetras(event)"  class="form-control" required value="{{Input::old('nombre')}}"   onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()" />
							</div>
						</div>




						<div class="form-group">
							<label class="col-sm-3 control-label">Extención: <strog class="theme_color"></strog></label>
							<div class="col-sm-6">
								<input name="ext" id="ext" type="text"   onkeypress="soloNumeros(event)" class="form-control"  value="{{Input::old('ext')}}" />
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-3 control-label">Email: <strog class="theme_color"></strog></label>
							<div class="col-sm-6">
								<input name="email" id="email" type="text"   class="form-control"  value="{{Input::old('email')}}" />
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
								<button type="submit" id="submit"  class="btn btn-primary">Guardar</button>
								<a href="{{url('/directorio_externo')}}" class="btn btn-default"> Cancelar</a>
							</div>
						</div><!--/form-group-->


					</form>
				</div><!--/porlets-content-->
			</div><!--/block-web-->
		</div><!--/col-md-12-->
	</div><!--/row-->
</div><!--/container clear_both padding_fix-->
<script type="text/javascript">

	function cambia_nombre(){
		var nombre = document.getElementById('nombre').value;
		var materno = document.getElementById('materno').value;
		var mat_aux= materno.substr(0,1);
		var paterno = document.getElementById('paterno').value;
		var pat_aux=paterno.substr(0,1);
		var a_n = "" ;

		limite = "2",
		separador = " ",
		arregloDeSubCadenas = nombre.split(separador, limite);
		for (var i =0; i < arregloDeSubCadenas.length; i++) {
			var aux=arregloDeSubCadenas[i].substr(0,1);
			a_n=a_n+aux;
		}

		a_n=a_n+pat_aux+mat_aux;
		document.getElementById('a_n').value=a_n;

	}

	function cambia_direccion(){
		var nombre = document.getElementById('direccion').value;
		var a_d = "" ;

		limite = "5",
		separador = " ",
		arregloDeSubCadenas = nombre.split(separador, limite);
		for (var i =0; i < arregloDeSubCadenas.length; i++) {
			var aux=arregloDeSubCadenas[i].substr(0,1);
			a_d=a_d+aux;
		}
		document.getElementById('a_d').value=a_d;
	}

	window.onload = function() {
		//valida_puesto();
	};




</script>
@endsection
