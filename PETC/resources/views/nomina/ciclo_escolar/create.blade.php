@extends('layouts.principal')
@section('contenido')
<div class="pull-left breadcrumb_admin clear_both">
	<div class="pull-left page_title theme_color">
		<h1>Inicio</h1>
		<h2 class="">Ciclo Escolar</h2>
	</div>
	<div class="pull-right">
		<ol class="breadcrumb">
			<li><a style="color: #808080" href="{{url('ciclo_escolar')}}">Inicio</a></li>
			<li><a style="color: #808080" href="{{url('ciclo_escolar')}}">Ciclo Escolar</a></li>
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
							<h2 class="content-header" style="margin-top: -5px;"><strong>Agregar Ciclo Escolar</strong></h2>
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
					<form action="{{route('ciclo_escolar.store')}}" method="post" class="form-horizontal row-border" parsley-validate novalidate  files="true" enctype="multipart/form-data" accept-charset="UTF-8">
						{{csrf_field()}}



						<div class="form-group">
							<label class="col-sm-3 control-label">Ciclo Escolar: <strog class="theme_color">*</strog></label>
							<div class="col-sm-6">
								<input name="ciclo" type="text"  class="form-control" required value="" />
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-3 control-label">Días Hablies: <strog class="theme_color">*</strog></label>
							<div class="col-sm-6">
								<input name="dias_habiles" type="number" onkeypress="soloNumeros(event)"   class="form-control" required value="" />
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-3 control-label">Inicio Ciclo: <strog class="theme_color">*</strog></label>
							<div class="col-sm-6">
								<input name="inicio_ciclo" type="date"   class="form-control" required value="" />
							</div>
						</div>

            <div class="form-group">
							<label class="col-sm-3 control-label">Fin Ciclo: <strog class="theme_color">*</strog></label>
							<div class="col-sm-6">
								<input name="fin_ciclo" type="date"  class="form-control" required value="" />
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
								<button type="submit" class="btn btn-primary">Guardar</button>
								<a href="{{url('/ciclo_escolar')}}" class="btn btn-default"> Cancelar</a>
							</div>
						</div><!--/form-group-->


					</form>
				</div><!--/porlets-content-->
			</div><!--/block-web-->
		</div><!--/col-md-12-->
	</div><!--/row-->
</div><!--/container clear_both padding_fix-->
@endsection
