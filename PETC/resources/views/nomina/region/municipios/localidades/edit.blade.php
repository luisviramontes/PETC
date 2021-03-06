@extends('layouts.principal')
@section('contenido')
<div class="pull-left breadcrumb_admin clear_both">
	<div class="pull-left page_title theme_color">
		<h1>Inicio</h1>
		<h2 class="">Localidades</h2>
	</div>
	<div class="pull-right">
		<ol class="breadcrumb">
			<li><a style="color: #808080" href="{{url('municipios')}}">Inicio</a></li>
			<li><a style="color: #808080" href="{{url('municipios')}}">Localidades</a></li>
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
							<h2 class="content-header" style="margin-top: -5px;"><strong>Editar Localidad : {{$dato2->nom_loc}}</strong></h2>
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
					<form action="{{url('/localidades', [$localidad->id])}}" method="post" class="form-horizontal row-border" parsley-validate novalidate files="true" enctype="multipart/form-data" accept-charset="UTF-8">
						{{csrf_field()}}
						<input type="hidden" name="_method" value="PUT">

						<div class="form-group">
							<label class="col-sm-3 control-label">Municipio <strog class="theme_color">*</strog></label>
							<div class="col-sm-6">
								<select name="municipio" id="municipio" class="form-control select2" required>
									@foreach($municipios as $municipio)
									@if($localidad->id_municipio == $municipio->id)
									<option value="{{$municipio->id}}" selected>
										{{$municipio->municipio}}
									</option>
									@else
									<option value="{{$municipio->id}}">
										{{$municipio->municipio}}
									</option>
									@endif
									@endforeach
								</select>
								<div class="help-block with-errors"></div>
							</div>
						</div><!--/form-group-->



						<div class="form-group">
							<label class="col-sm-3 control-label">Nombre de la Localidad: <strog class="theme_color">*</strog></label>
							<div class="col-sm-6">
								<input name="localidad" id="localidad" type="text" onkeypress="return soloLetras(event)"  class="form-control" required value="{{$localidad->nom_loc}}" onchange="mayus(this)" />
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-3 control-label">Longitud: <strog class="theme_color">*</strog></label>
							<div class="col-sm-6">
								<input name="longitud" id="longitud" type="text" onkeypress="return soloNumeros(event)"  class="form-control" required value="{{$localidad->longitud}}"  max="100000" min="1" />
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-3 control-label">Latitud: <strog class="theme_color">*</strog></label>
							<div class="col-sm-6">
								<input name="latitud" id="latitud" type="text" onkeypress="return soloNumeros(event)"  class="form-control" required value="{{$localidad->latitud}}"  max="100000" min="1" />
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-3 control-label">Altitud: <strog class="theme_color">*</strog></label>
							<div class="col-sm-6">
								<input name="altitud" id="altitud" type="text" onkeypress="return soloNumeros(event)"  class="form-control" required value="{{$localidad->altitud}}" max="100000" min="1" />
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-3 control-label">Poblacion Total: <strog class="theme_color">*</strog></label>
							<div class="col-sm-6">
								<input name="pobtot" id="pobtot" type="text" onkeypress="return soloNumeros(event)"  class="form-control" required value="{{$localidad->pobtot}}" max="100000" min="1" />
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-3 control-label">Poblacion Masculina: <strog class="theme_color">*</strog></label>
							<div class="col-sm-6">
								<input name="pobmas" id="pobmas" type="text" onkeypress="return soloNumeros(event)"  class="form-control" required  value="{{$localidad->pobmas}}" max="100000" min="1" />
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-3 control-label">Poblacion Femenina: <strog class="theme_color">*</strog></label>
							<div class="col-sm-6">
								<input name="pobfem" id="pobfem" type="text" onkeypress="return soloNumeros(event)"  class="form-control" required value="{{$localidad->pobfem}}"  max="100000" min="1" />
							</div>
						</div>







						<div class="form-group">
							<div class="col-sm-offset-7 col-sm-5">
								<button type="submit" class="btn btn-primary">Guardar</button>
								<a href="{{url('/localidades')}}" class="btn btn-default"> Cancelar</a>
							</div>
						</div><!--/form-group-->


					</form>
				</div><!--/porlets-content-->
			</div><!--/block-web-->
		</div><!--/col-md-12-->
	</div><!--/row-->
</div><!--/container clear_both padding_fix-->
@endsection
