@extends('layouts.principal')
@section('contenido')
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<div class="pull-left breadcrumb_admin clear_both">
	<div class="pull-left page_title theme_color">
		<h1>Inicio</h1>
		<h2 class="">Tabla de Pagos Por Empleado</h2>
	</div>
	<div class="pull-right">
		<ol class="breadcrumb">
			<li><a style="color: #808080" href="{{url('tabulador_pagos')}}">Inicio</a></li>
			<li><a style="color: #808080" href="{{url('tabulador_pagos')}}">Tabla de Pagos Por Empleado</a></li>
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
							<h2 class="content-header" style="margin-top: -5px;"><strong>Agregar Pago Por Empleado Por Dia Laborado</strong></h2> 
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
					<form action="{{route('tabulador_pagos.store')}}" method="post" class="form-horizontal row-border" parsley-validate novalidate  files="true" enctype="multipart/form-data" accept-charset="UTF-8">
						{{csrf_field()}}
						

						<div class="form-group">
							<label class="col-sm-3 control-label">Pago por Director: <strog class="theme_color">*</strog></label>
							<div class="col-sm-6">
								<input name="pago_director" id="pago_director" type="number"   class="form-control" required value="230" maxlength="3" min="1" max ="999" />
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-3 control-label">Pago por Docente: <strog class="theme_color">*</strog></label>
							<div class="col-sm-6">
								<input name="pago_docente" id="pago_docente" type="number"   class="form-control" required value="200" maxlength="3" min="1" max ="999" />
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-3 control-label">Pago por Intendete: <strog class="theme_color">*</strog></label>
							<div class="col-sm-6">
								<input name="pago_intendente" id="pago_intendente" type="number"   class="form-control" required value="50" maxlength="3" min="1" max ="999" />
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-3 control-label">Ciclo Escolar <strog class="theme_color">*</strog></label>
							<div class="col-sm-6">
								<select name="ciclo" class="form-control"  value="{{Input::old('ciclo')}}"  required>
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
							<div class="col-sm-offset-7 col-sm-5">
								<button type="submit" onclick="return valida_montos();"  id="submit" class="btn btn-primary">Guardar</button>
								<a href="{{url('/tabulador_pagos')}}" class="btn btn-default"> Cancelar</a>
							</div>
						</div><!--/form-group-->


					</form>
				</div><!--/porlets-content-->
			</div><!--/block-web-->
		</div><!--/col-md-12-->
	</div><!--/row-->
</div><!--/container clear_both padding_fix-->
@endsection 
