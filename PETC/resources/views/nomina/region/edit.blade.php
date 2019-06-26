@extends('layouts.principal')
@section('contenido')
<div class="pull-left breadcrumb_admin clear_both">
	<div class="pull-left page_title theme_color">
		<h1>Inicio</h1>
		<h2 class="">Editar Region
	</div>
	<div class="pull-right">
		<ol class="breadcrumb">
			<li><a style="color: #808080" href="{{url('categorias')}}">Inicio</a></li>
			<li><a style="color: #808080" href="{{url('categorias')}}">EditarRegion</a></li>
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
							<h2 class="content-header" style="margin-top: -5px;"><strong>EditarRegion</strong></h2>
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
          <form action="{{url('/region', [$regiones->id])}}" method="post" class="form-horizontal row-border" parsley-validate novalidate files="true" enctype="multipart/form-data" accept-charset="UTF-8">
						{{csrf_field()}}
						<input type="hidden" name="_method" value="PUT">

						<div class="form-group">
							<label class="col-sm-3 control-label">Region <strog class="theme_color">*</strog></label>
							<div class="col-sm-6">
								<select name="region" class="form-control" required>
  								<option selected value="	{{$regiones->region}}">
											{{$regiones->region}}
									</option>
                  <option  value="1">
										1
									</option>
									<option value="2">
										2
									</option>
									<option value="3">
										3
									</option>
									<option value="4">
										4
									</option>
									<option value="5">
										5
									</option>
									<option value="6">
										6
									</option>
									<option value="7">
										7
									</option>
									<option value="8">
										8
									</option>
									<option value="9">
										9
									</option>
									<option value="10">
										10
									</option>
									<option value="11">
										11
									</option>
									<option value="12">
										12
									</option>
									<option value="13">
										13
									</option>

								</select>
								<div class="help-block with-errors"></div>
							</div>
						</div><!--/form-group-->

						<div class="form-group">
							<label class="col-sm-3 control-label">Sostenimiento: <strog class="theme_color">*</strog></label>
							<div class="col-sm-6">
								<select name="sostenimiento" onchange="valida_sostenimiento();"  id="sostenimiento" class="form-control" required>
									<option selected value="	{{$regiones->sostenimiento}}">
												{{$regiones->sostenimiento}}
									</option>
									<option value="ESTATAL">
										ESTATAL
									</option>
									<option value="FEDERAL">
										FEDERAL
									</option>

								</select>
								<div class="help-block with-errors"></div>
								<div class="text-danger" id='error_sostenimiento'>{{$errors->formulario->first('sostenimiento')}}</div>
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
								<button type="submit" id="submit"disabled="true" onkeypress="valida_sostenimiento()"  class="btn btn-primary">Guardar</button>
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
	valida_sostenimiento();
};
</script>
@endsection
