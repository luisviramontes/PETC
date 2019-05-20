@extends('layouts.principal')
@section('contenido')
<div class="pull-left breadcrumb_admin clear_both">
	<div class="pull-left page_title theme_color">
		<h1>Inicio</h1>
		<h2 class="">Editar Fortalecimiento</h2>
	</div>
	<div class="pull-right">
		<ol class="breadcrumb">
			<li><a style="color: #808080" href="{{url('fortalecimiento')}}">Inicio</a></li>
			<li><a style="color: #808080" href="{{url('fortalecimiento')}}">Editar Ciclo Escolar</a></li>
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
							<h2 class="content-header" style="margin-top: -5px;"><strong>Editar Fortalecimiento</strong></h2>
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
          <form action="{{url('/fortalecimiento', [$fortalecimientos->id])}}" method="post" class="form-horizontal row-border" parsley-validate novalidate files="true" enctype="multipart/form-data" accept-charset="UTF-8">
						{{csrf_field()}}
						<input type="hidden" name="_method" value="PUT">




						<div class="form-group">
							<label class="col-sm-3 control-label">CCT <strog class="theme_color">*</strog></label>
							<div class="col-sm-6">
								<select name="id_cct" class="form-control"  value="{{Input::old('id_cct')}}"  required>
									@foreach($cct as $cct)
									<option value="{{$cct->id}}">
										{{$cct->cct}}
									</option>
									@endforeach
								</select>
								<div class="help-block with-errors"></div>


							</div>
						</div><!--/form-group-->

						<div class="form-group">
							<label class="col-sm-3 control-label">Monto Fortalecimiento: <strog class="theme_color">*</strog></label>
							<div class="col-sm-6">
								<input name="monto_forta"  id="monto_forta" type="number" onkeypress="soloNumeros(event)"   class="form-control" required value="{{$fortalecimientos->monto_forta}}" />
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-3 control-label">Ciclo Escolar <strog class="theme_color">*</strog></label>
							<div class="col-sm-6">
								<select name="ciclo_escolar" class="form-control"  value="{{Input::old('ciclo_escolar')}}"  required>
									@foreach($ciclos as $ciclo)
									<option value="{{$ciclo->ciclo}}">
										{{$ciclo->ciclo}}
									</option>
									@endforeach
								</select>
								<div class="help-block with-errors"></div>
								<div class="text-danger" id='error_ciclo'>{{$errors->formulario->first('ciclo')}}</div>
							</div>
						</div><!--/form-group-->

						<div class="form-group">
							<label class="col-sm-3 control-label">Estado <strog class="theme_color">*</strog></label>
							<div class="col-sm-6">
								<select name="estado" class="form-control" value="{{Input::old('estado')}}" required>
									<option value="ACTIVO">
										ACTIVO
									</option>
									<option value="INACTIVO">
										INACTIVO
									</option>


								</select>
								<div class="help-block with-errors"></div>
							</div>
						</div><!--/form-group-->

						<div class="form-group">
							<label class="col-sm-3 control-label">Observaciones: <strog class="theme_color">*</strog></label>
							<div class="col-sm-6">
								<input name="observaciones"  id="observaciones" type="text"    class="form-control" required value="{{$fortalecimientos->observaciones}}" />
							</div>
						</div>




						<div class="form-group">
							<div class="col-sm-offset-7 col-sm-5">
								<button type="submit" class="btn btn-primary">Guardar</button>
								<a href="{{url('/fortalecimiento')}}" class="btn btn-default"> Cancelar</a>
							</div>
						</div><!--/form-group-->


					</form>
				</div><!--/porlets-content-->
			</div><!--/block-web-->
		</div><!--/col-md-12-->
	</div><!--/row-->
</div><!--/container clear_both padding_fix-->
@endsection
