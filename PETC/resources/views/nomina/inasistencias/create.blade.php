@extends('layouts.principal')
@section('contenido')
<div class="pull-left breadcrumb_admin clear_both">
	<div class="pull-left page_title theme_color">
		<h1>Inicio</h1>
		<h2 class="">Lista de Asistencia</h2>
	</div>
	<div class="pull-right">
		<ol class="breadcrumb">
			<li><a style="color: #808080" href="{{url('listas_asistencias')}}">Inicio</a></li>
			<li><a style="color: #808080" href="{{url('listas_asistencias')}}">Listas de Asistencias</a></li>
		</ol>
	</div>
</div>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<div class="container clear_both padding_fix">
	<div class="row">
		<div class="col-md-12">
			<div class="block-web">
				<div class="header">
					<div class="row" style="margin-top: 15px; margin-bottom: 12px;">
						<div class="col-sm-8">
							<div class="actions"> </div>
							<h2 class="content-header" style="margin-top: -5px;"><strong>Agregar Lista de Asistencia</strong></h2>
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
					<form action="{{route('inasistencias.store')}}" method="post" class="form-horizontal row-border" parsley-validate novalidate  files="true" enctype="multipart/form-data" accept-charset="UTF-8">
						{{csrf_field()}}

						<div class="form-group">
							<label class="col-sm-3 control-label">Clave Centro de Trabajo <strog class="theme_color">*</strog></label>
							<div class="col-sm-6">
								<select name="cct" id="cct" class="form-control select2" onchange="claves(this);busca_personal();"  required>
									@foreach($cct as $cct) 
									<option value="{{$cct->cct}}_{{$cct->nombre_escuela}}_{{$cct->id}}">
										{{$cct->cct}}
									</option>
									@endforeach
								</select>
								<div class="help-block with-errors"></div>
							<!--	<div class="text-danger" id='error_ciclo'>{{$errors->formulario->first('cct')}}</div>
						--></div>
					</div> 

					<div class="form-group">
						<label class="col-sm-3 control-label">Escuela: <strog class="theme_color">*</strog></label>
						<div class="col-sm-6">
							<input name="escuela" id="escuela" disabled type="text"   class="form-control" required value="{{Input::old('escuelas')}}" />
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label">Ciclo Escolar: <strog class="theme_color">*</strog></label>
						<div class="col-sm-6">
							<select name="ciclo_escolar" id="ciclo_escolar" onchange="busca_personal();"  class="form-control select2" ">
								@foreach($ciclos as $ciclo) 
								@if($ciclo->id == 2)		
								<option value='{{$ciclo->ciclo}}' selected>
									{{$ciclo->ciclo}}
								</option>
								@else
								<option value='{{$ciclo->ciclo}}'>
									{{$ciclo->ciclo}}
								</option>
								@endif
								@endforeach
							</select>

						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label">Mes <strog class="theme_color">*</strog></label>
						<div class="col-sm-6">
							<select  name="mes" id="mes" class="form-control select2" onchange="busca_personal();" required>
								<option value="ENERO">
									ENERO
								</option>
								<option value="FEBRERO">
									FEBRERO
								</option>
								<option value="MARZO">
									MARZO
								</option>
								<option value="ABRIL">
									ABRIL
								</option>
								<option value="MAYO">
									MAYO
								</option>
								<option value="JUNIO">
									JUNIO
								</option>
								<option value="JULIO">
									JULIO
								</option>
								<option value="AGOSTO">
									AGOSTO
								</option>
								<option value="SEPTIEMBRE">
									SEPTIEMBRE
								</option>
								<option value="OCTUBRE">
									OCTUBRE
								</option>
								<option value="NOVIEMBRE">
									NOVIEMBRE
								</option>
								<option value="DICIEMBRE">
									DICIEMBRE
								</option>
							</select>
							<div class="help-block with-errors"></div>
						</div>
					</div><!--/form-group-->


					
					<div class="form-group">
						<label class="col-sm-3 control-label">Observaciones: <strog class="theme_color"></strog></label>
						<div class="col-sm-6">
							<input name="observaciones" type="text" id="observaciones"   class="form-control"  value="{{Input::old('observaciones')}}" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()" />
						</div>
					</div>

					<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
						<div class="form-group"> 
							<table id="detalles" name="detalles[]" value="" class="table table-striped table-bordered table-condensed table-hover">
								<thead style="background-color:#A9D0F5">



								</thead>
								<tfoot>

								</tfoot>
								<tbody>

								</tbody>

							</table>

							<div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
								<div class="form-group"> 
									<label for="total">Total de Inasistencias </label>
									<input name="total" id="total" type="number"  class="form-control"  readonly/>
								</div>    
							</div>  
						</div>
					</div>


					<div class="form-group">
						<div class="col-sm-6">
							<input  id="inasistencias" value="" name="inasistencias[]" type="hidden"  class="form-control"/>
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
								<button type="submit"  id="submit8" class="btn btn-primary">Guardar</button>
								<a href="{{url('/inasistencias2')}}" class="btn btn-default"> Cancelar</a>
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
		document.getElementById('cct').focus();
				document.getElementById('cct').click();
		busca_personal();
		claves();
	}



</script>

@endsection
