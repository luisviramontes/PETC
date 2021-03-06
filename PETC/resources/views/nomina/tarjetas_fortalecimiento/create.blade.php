@extends('layouts.principal')
@section('contenido')
<div class="pull-left breadcrumb_admin clear_both">
	<div class="pull-left page_title theme_color">
		<h1>Inicio</h1>
		<h2 class="">Fortalecimiento</h2>
	</div>
	<div class="pull-right">
		<ol class="breadcrumb">
			<li><a style="color: #808080" href="{{url('tarjetas_fortalecimiento')}}">Inicio</a></li>
			<li><a style="color: #808080" href="{{url('tarjetas_fortalecimiento')}}">Fortalecimiento</a></li>
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
							<h2 class="content-header" style="margin-top: -5px;"><strong>Agregar Tarjeta de Fortalecimiento</strong></h2>
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
					<form action="{{route('tarjetas_fortalecimiento.store')}}" method="post" class="form-horizontal row-border" parsley-validate novalidate  files="true" enctype="multipart/form-data" accept-charset="UTF-8">
						{{csrf_field()}}



	                       <div class="form-group">
							<label class="col-sm-3 control-label">Ciclo Escolar <strog class="theme_color">*</strog></label>
							<div class="col-sm-6">
								<select name="ciclo_escolar" id="ciclo_escolar" onchange="traer_escuelasforta()" class="form-control"  value="{{Input::old('ciclo_escolar')}}"  required>									
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
							<label class="col-sm-3 control-label">CCT <strog class="theme_color">*</strog></label>
							<div class="col-sm-6">
								<select name="cct" id="cct" onchange="traer_montos_forta();" class="form-control select2" required>
														
								</select>
								<div class="help-block with-errors"></div>
								<div class="text-danger" id='error_cct'>{{$errors->formulario->first('cct')}}</div>
							</div>
						</div><!--/form-group-->

						<div class="form-group">
							<label class="col-sm-3 control-label">Monto Fortalecimiento: <strog class="theme_color">*</strog></label>
							<div class="col-sm-6">
								<input name="monto_forta"  id="monto_forta" type="number" onkeypress="soloNumeros(event)"   class="form-control" required value="{{Input::old('monto_forta')}}" />
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-3 control-label">N° de Tarjeta: <strog class="theme_color">*</strog></label>
							<div class="col-sm-6">
								<input name="num_tarjeta"  id="num_tarjeta" type="number" onkeypress="soloNumeros(event)"   class="form-control" required  />
							</div>
						</div>


						<div class="form-group">
							<label class="col-sm-3 control-label">TSL: <strog class="theme_color">*</strog></label>
							<div class="col-sm-6">
								<input name="tsl"  id="tsl" type="number" onkeypress="soloNumeros(event)"   class="form-control" required value="{{Input::old('monto_forta')}}" />
							</div>
						</div>

							
							<div class="form-group">
							<label class="col-sm-3 control-label">Producto: <strog class="theme_color">*</strog></label>
							<div class="col-sm-6">
								<input name="producto"  id="producto" type="text"   class="form-control" required value="LICITACION TOKA CHIP" />
							</div>
						</div>

							<div class="form-group">
							<label class="col-sm-3 control-label">Empresa: <strog class="theme_color">*</strog></label>
							<div class="col-sm-6">
								<input name="empresa"  id="empresa" type="text"    class="form-control" required value="Toka Internacional SAPI de C.V." />
							</div>
						</div>

					

						<div class="form-group">
							<label class="col-sm-3 control-label">Observaciones: <strog class="theme_color">*</strog></label>
							<div class="col-sm-6">
								<input name="observaciones"  id="observaciones" type="text"    class="form-control"  value="{{Input::old('observaciones')}}" />
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
								<a href="{{url('/tarjetas_fortalecimiento')}}" class="btn btn-default"> Cancelar</a>
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
		traer_escuelasforta();
	}


</script>
@endsection
