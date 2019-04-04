@extends('layouts.principal')
@section('contenido')
<div class="pull-left breadcrumb_admin clear_both">
	<div class="pull-left page_title theme_color">
		<h1>Inicio</h1>
		<h2 class="">Municipios</h2>
	</div>
	<div class="pull-right">
		<ol class="breadcrumb">
			<li><a style="color: #808080" href="{{url('municipios')}}">Inicio</a></li>
			<li><a style="color: #808080" href="{{url('municipios')}}">Municipios</a></li>
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
							<h2 class="content-header" style="margin-top: -5px;"><strong>Agregar Municipio</strong></h2>
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
					<form action="{{route('municipios.store')}}" method="post" class="form-horizontal row-border" parsley-validate novalidate  files="true" enctype="multipart/form-data" accept-charset="UTF-8">
						{{csrf_field()}}

						<div class="form-group">
							<label class="col-sm-3 control-label">Región <strog class="theme_color">*</strog></label>
							<div class="col-sm-6">
								<select name="region" class="form-control" required>
									@foreach($region as $regiones)
									<option value="{{$regiones->id}}">
										{{$regiones->region}}-{{$regiones->sostenimiento}}
									</option>
									@endforeach
								</select>
								<div class="help-block with-errors"></div>
							</div>
						</div><!--/form-group-->



						<div class="form-group">
							<label class="col-sm-3 control-label">Nombre del Municipio: <strog class="theme_color">*</strog></label>
							<div class="col-sm-6">
								<input name="municipio" type="text" onkeypress="return soloLetras(event)"  class="form-control" required value="" onchange="mayus(this)" />
							</div>
						</div>

												<div class="form-group">
							<label class="col-sm-3 control-label">Cabecera Municipal: <strog class="theme_color">*</strog></label>
							<div class="col-sm-6">
								<input name="cabecera" type="text" onkeypress="return soloLetras(event)"  class="form-control" required value="" onchange="mayus(this)" />
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-3 control-label">Fecha de Creación: <strog class="theme_color">*</strog></label>
							<div class="col-sm-6">
								<input name="fecha" type="date"   class="form-control" required value="" />
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-3 control-label">Población: <strog class="theme_color">*</strog></label>
							<div class="col-sm-6">
								<input name="poblacion" type="number" onkeypress="soloNumeros(event)"   class="form-control" required value="" />
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-3 control-label">Área en KM: <strog class="theme_color">*</strog></label>
							<div class="col-sm-6">
								<input name="area" type="number"  onkeypress="soloNumeros(event)"  class="form-control" required value="" />
							</div>
						</div>						





						<div class="form-group">
							<div class="col-sm-offset-7 col-sm-5">
								<button type="submit" class="btn btn-primary">Guardar</button>
								<a href="{{url('/municipios')}}" class="btn btn-default"> Cancelar</a>
							</div>
						</div><!--/form-group-->


					</form>
				</div><!--/porlets-content-->
			</div><!--/block-web-->
		</div><!--/col-md-12-->
	</div><!--/row-->
</div><!--/container clear_both padding_fix-->
@endsection
