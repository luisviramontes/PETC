@extends('layouts.principal')
@section('contenido')
<div class="pull-left breadcrumb_admin clear_both">
	<div class="pull-left page_title theme_color">
		<h1>Inicio</h1>
		<h2 class="">omina Plan Contraste</h2>
	</div>
	<div class="pull-right">
		<ol class="breadcrumb">
			<li><a style="color: #808080" href="{{url('plan_contraste')}}">Inicio</a></li>
			<li><a style="color: #808080" href="{{url('plan_contraste')}}">Nomina Plan Contraste</a></li>
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
							<h2 class="content-header" style="margin-top: -5px;"><strong>Editar Nomina Plan Contraste CCT: {{$plan->cct}}</strong></h2>
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
          <form action="{{url('/plan_contraste', [$plan->id])}}" method="post" class="form-horizontal row-border" parsley-validate novalidate files="true" enctype="multipart/form-data" accept-charset="UTF-8">
						{{csrf_field()}}
						<input type="hidden" name="_method" value="PUT">


	                       <div class="form-group">
							<label class="col-sm-3 control-label">Ciclo Escolar <strog class="theme_color">*</strog></label>
							<div class="col-sm-6">
								<select name="ciclo_escolar" id="ciclo_escolar"  class="form-control"  value="{{Input::old('ciclo_escolar')}}"  required>									
									@foreach($ciclos as $ciclo)
									@if($plan->id_ciclo == $ciclo->id)
									<option value="{{$ciclo->id}}" selected>
										{{$ciclo->ciclo}}
									</option>
									@else
									<option value="{{$ciclo->id}}">
										{{$ciclo->ciclo}}
									</option>
									@endif
									@endforeach
								</select>
								<div class="help-block with-errors"></div>
								<div class="text-danger" id='error_ciclo_escolar'>{{$errors->formulario->first('ciclo_escolar')}}</div>
							</div>
						</div><!--/form-group-->



						<div class="form-group">
							<label class="col-sm-3 control-label">CCT <strog class="theme_color">*</strog></label>
							<div class="col-sm-6">
								<select name="cct" id="cct" class="form-control select2" disabled="true" value="{{Input::old('id_cct')}}"  required>
								<option value="" selected>
										{{$plan->cct}} - {{$plan->nombre_escuela}}
									</option>
														
								</select>
								<div class="help-block with-errors"></div>
								<div class="text-danger" id='error_cct'>{{$errors->formulario->first('cct')}}</div>
							</div>
						</div><!--/form-group-->

						<div class="form-group">
							<label class="col-sm-3 control-label">Total Directores: <strog class="theme_color">*</strog></label>
							<div class="col-sm-6">
								<input name="total_dire"  id="total_dire" type="number" onkeypress="soloNumeros(event)"   class="form-control" required value="{{$plan->total_directores}}" />
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-3 control-label">Percepciones Directores: <strog class="theme_color">*</strog></label>
							<div class="col-sm-6">
								<input name="perce_dire"  id="perce_dire" type="number" onkeypress="soloNumeros(event)"   class="form-control" required value="{{$plan->monto_directores}}" />
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-3 control-label">Deducciones Directores: <strog class="theme_color">*</strog></label>
							<div class="col-sm-6">
								<input name="dedu_dire"  id="dedu_dire" type="number" onkeypress="soloNumeros(event)"   class="form-control" required value="{{$plan->deducciones_directores}}" />
							</div>
						</div>

										<div class="form-group">
							<label class="col-sm-3 control-label">Total Docentes: <strog class="theme_color">*</strog></label>
							<div class="col-sm-6">
								<input name="total_doce"  id="total_doce" type="number" onkeypress="soloNumeros(event)"   class="form-control" required value="{{$plan->total_docentes}}" />
							</div>
						</div>
							<div class="form-group">
							<label class="col-sm-3 control-label">Percepciones Docentes: <strog class="theme_color">*</strog></label>
							<div class="col-sm-6">
								<input name="perce_doce"  id="perce_doce" type="number" onkeypress="soloNumeros(event)"   class="form-control" required value="{{$plan->monto_docentes}}" />
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-3 control-label">Deducciones Docentes: <strog class="theme_color">*</strog></label>
							<div class="col-sm-6">
								<input name="dedu_doce"  id="dedu_doce" type="number" onkeypress="soloNumeros(event)"   class="form-control" required value="{{$plan->deducciones_docentes}}" />
							</div>
						</div>

										<div class="form-group">
							<label class="col-sm-3 control-label">Total Intendentes: <strog class="theme_color">*</strog></label>
							<div class="col-sm-6">
								<input name="total_inte"  id="total_inte" type="number" onkeypress="soloNumeros(event)"   class="form-control" required value="{{$plan->total_intendentes}}" />
							</div>
						</div>
							<div class="form-group">
							<label class="col-sm-3 control-label">Percepciones Intendentes: <strog class="theme_color">*</strog></label>
							<div class="col-sm-6">
								<input name="perce_inte"  id="perce_inte" type="number" onkeypress="soloNumeros(event)"   class="form-control" required value="{{$plan->monto_intendentes}}" />
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-3 control-label">Deducciones Intendentes: <strog class="theme_color">*</strog></label>
							<div class="col-sm-6">
								<input name="dedu_inte"  id="dedu_inte" type="number" onkeypress="soloNumeros(event)"   class="form-control" required value="{{$plan->deducciones_intendentes}}" />
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
								<a href="{{url('/plan_contraste')}}" class="btn btn-default"> Cancelar</a>
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
	}


</script>
@endsection
