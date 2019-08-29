@extends('layouts.principal')
@section('contenido')
<div class="pull-left breadcrumb_admin clear_both">
	<div class="pull-left page_title theme_color">
		<h1>Inicio</h1>
		<h2 class="">Localidades</h2>
	</div>
	<div class="pull-right">
		<ol class="breadcrumb">
			<li><a style="color: #808080" href="{{url('localidades')}}">Inicio</a></li>
			<li><a style="color: #808080" href="{{url('localidades')}}">Localidades</a></li>
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
							<h2 class="content-header" style="margin-top: -5px;"><strong>Agregar Localidad</strong></h2>
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
					<form action="{{route('localidades.store')}}" method="post" class="form-horizontal row-border" parsley-validate novalidate  files="true" enctype="multipart/form-data" accept-charset="UTF-8">
						{{csrf_field()}}

						<div class="form-group">
							<label class="col-sm-3 control-label">Municipio <strog class="theme_color">*</strog></label>
							<div class="col-sm-6">
								<select name="municipio" id="municipio" onchange="loc_mun()" class="form-control select2" required>
									<option selected>
										Seleccione una opción
									</option>
									@foreach($municipios as $municipio)
									<option value="{{$municipio->id}}">
										{{$municipio->municipio}}
									</option>
									@endforeach
								</select>
								<div class="help-block with-errors"></div>
								<div class="text-danger" id='error_municipio'>{{$errors->formulario->first('municipio')}}</div>
							</div>
						</div><!--/form-group-->



						<div class="form-group">
							<label class="col-sm-3 control-label">Nombre de la Localidad: <strog class="theme_color">*</strog></label>
							<div class="col-sm-6">
								<input name="localidad" id="localidad" placeholder="Escribe el nombre de la Localidad." type="text" onkeypress="return soloLetras(event)" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()" class="form-control" required value="" />
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-3 control-label">Longitud: <strog class="theme_color">*</strog></label>
							<div class="col-sm-6">
								<input name="longitud" id="longitud" placeholder="Escribe la longitud de la Localidad." type="text" onkeypress="return soloNumeros(event)"  class="form-control" required  max="100000" min="1" />
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-3 control-label">Latitud: <strog class="theme_color">*</strog></label>
							<div class="col-sm-6">
								<input name="latitud" id="latitud" placeholder="Escribe la latitud de la Localidad." type="text" onkeypress="return soloNumeros(event)"  class="form-control" required  max="100000" min="1" />
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-3 control-label">Altitud: <strog class="theme_color">*</strog></label>
							<div class="col-sm-6">
								<input name="altitud" id="altitud" placeholder="Escribe la altitud de la Localidad." type="text" onkeypress="return soloNumeros(event)"  class="form-control" required  max="100000" min="1" />
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-3 control-label">Poblacion Total: <strog class="theme_color">*</strog></label>
							<div class="col-sm-6">
								<input name="pobtot" id="pobtot" placeholder="Escribe la poblacion total de la Localidad." type="text" onkeypress="return soloNumeros(event)"  class="form-control" required  max="100000" min="1" />
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-3 control-label">Poblacion Masculina: <strog class="theme_color">*</strog></label>
							<div class="col-sm-6">
								<input name="pobmas" type="text" id="pobmas" placeholder="Escribe la poblacion masculina de la Localidad." onkeypress="return soloNumeros(event)"  class="form-control" required  max="100000" min="1" />
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-3 control-label">Poblacion Femenina: <strog class="theme_color">*</strog></label>
							<div class="col-sm-6">
								<input name="pobfem" id="pobfem" placeholder="Escribe la poblacion femenina de la Localidad." type="text" onkeypress="return soloNumeros(event)"  class="form-control" required  max="100000" min="1" />
							</div>
						</div>







						<div class="form-group">
							<div class="col-sm-offset-7 col-sm-5">
								<button type="submit" id="submit" class="btn btn-primary">Guardar</button>
								<a href="{{url('/localidades')}}" class="btn btn-default"> Cancelar</a>
							</div>
						</div><!--/form-group-->


					</form>
				</div><!--/porlets-content-->
			</div><!--/block-web-->
		</div><!--/col-md-12-->
	</div><!--/row-->
</div><!--/container clear_both padding_fix-->
<script type="text/javascript">
window.onload=function(){
	loc_mun();
	}

	function loc_mun() {
	 if( document.getElementById('municipio').value == "Seleccione una opción"){

		 document.getElementById('submit').disabled=true;

					//  swal("ERROR!","Selecciona tipo se puesto","error");
					document.getElementById("error_municipio").innerHTML = "Seleccione una opción.";
					return false
				}else{
				 document.getElementById('submit').disabled=false;
				 document.getElementById("error_municipio").innerHTML = "";
			 }
	 }

</script>
@endsection
