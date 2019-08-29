@extends('layouts.principal')
@section('contenido')
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<div class="pull-left breadcrumb_admin clear_both">
	<div class="pull-left page_title theme_color">
		<h1>Inicio</h1>
		<h2 class="">Calculadora de Pagos</h2>
	</div>
	<div class="pull-right">
		<ol class="breadcrumb">
			<li><a style="color: #808080" href="{{url('tabulador_pagos')}}">Inicio</a></li>
			<li><a style="color: #808080" href="{{url('tabulador_pagos')}}">Calculadora de Pagos</a></li>
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
							<h2 class="content-header" style="margin-top: -5px;"><strong>Calculadora de Pagos</strong></h2> 
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
							<label class="col-sm-3 control-label">Ciclo Escolar <strog class="theme_color">*</strog></label>
							<div class="col-sm-6">
								<select name="ciclo" id="ciclo" class="form-control" required>
									@foreach($tabla as $ciclo)
									<option value="{{$ciclo->ciclo}}_{{$ciclo->pago_director}}_{{$ciclo->pago_docente}}_{{$ciclo->pago_intendente}}">
										{{$ciclo->ciclo}}
									</option>
									@endforeach
								</select>
								<div class="help-block with-errors"></div>
								<div class="text-danger" id='error_ciclo'>{{$errors->formulario->first('ciclo')}}</div>
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-3 control-label">Categoria <strog class="theme_color">*</strog></label>
							<div class="col-sm-6">
								<select name="cat2" id="cat2" class="form-control" onchange="calculadora(this);" required>  
									<option value="Director">
										Director                
									</option>
									<option value="Docente">
										Docente                 
									</option>
									<option value="Intendente">
										Intendente                 
									</option>       
								</select>
								<div class="help-block with-errors"></div>
							</div>
						</div><!--/form-group-->

						<div class="form-group">
							<label class="col-sm-3 control-label">Pago Por Dia: <strog class="theme_color">*</strog></label>
							<div class="col-sm-6">
								<input name="dias" disabled onkeypress="soloNumeros(this);" id="dias" type="number"  class="form-control" required maxlength="3" min="1" max ="199" />
							</div>
						</div>

												<div class="form-group">
							<label class="col-sm-3 control-label">Dias Trabajados: <strog class="theme_color">*</strog></label>
							<div class="col-sm-6">
								<input name="diast"  id="diast" type="number" value="1" class="form-control"  onchange="calculadora(this);" required maxlength="3" min="1" max ="199" />
							</div>
						</div>

																		<div class="form-group">
							<label class="col-sm-3 control-label">Total: <strog class="theme_color">*</strog></label>
							<div class="col-sm-6">
								<input name="total"  disabled id="total" type="number"  class="form-control" required maxlength="3" min="1" max ="199" />
							</div>
						</div>







						<div class="form-group">
							<div class="col-sm-offset-7 col-sm-5">
						<button type="button" class="btn btn-info">Calcular</button>							
								<a href="{{url('/tabulador_pagos')}}" class="btn btn-default"> Cancelar</a>
							</div>
						</div><!--/form-group-->


					</form>
				</div><!--/porlets-content-->
			</div><!--/block-web-->
		</div><!--/col-md-12-->
	</div><!--/row-->
</div><!--/container clear_both padding_fix-->
<script type="text/javascript">
window.onload=function() {
	calculadora();

}
</script>

@endsection 
