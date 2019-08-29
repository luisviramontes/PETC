@extends('layouts.principal')
@section('contenido')
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
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
					<form action="{{route('listas_asistencias.store')}}" method="post" class="form-horizontal row-border" parsley-validate novalidate  files="true" enctype="multipart/form-data" accept-charset="UTF-8">
						{{csrf_field()}}


						<div class="form-group">
							<label class="col-sm-3 control-label">Seleccione Ciclo Escolar: <strog class="theme_color"></strog></label>
							<div class="col-sm-6">
								<select name="ciclo_escolar" id="ciclo_escolar" onchange="busca_dias_reclamo();busca_dias_reclamo_region();" class="form-control select2">
									@foreach($ciclos as $ciclo)
									@if($ciclo->id == 2)
                                    <option value='{{$ciclo->id}}' selected>
										{{$ciclo->ciclo}}
									</option>
									@else
									<option value='{{$ciclo->id}}' >
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
								<select  name="mes" id="mes" onchange="valida_cct()" class="form-control select2" required>
									<option selected>
										Selecciona una opción
									</option>
									<option value="Enero">
										Enero
									</option>
									<option value="Febrero">
										Febrero
									</option>
									<option value="Marzo">
										Marzo
									</option>
									<option value="Abril">
										Abril
									</option>
									<option value="Mayo">
										Mayo
									</option>
									<option value="Junio">
										Junio
									</option>
									<option value="Julio">
										Julio
									</option>
									<option value="Agosto">
										Agosto
									</option>
									<option value="Septiempre">
										Septiempre
									</option>
									<option value="Octubre">
										Octubre
									</option>
									<option value="Noviembre">
										Noviembre
									</option>
									<option value="Diciembre">
										Diciembre
									</option>
								</select>
								<div class="help-block with-errors"></div>
								<div class="text-danger" id='error_mes'>{{$errors->formulario->first('mes')}}</div>
							</div>
						</div><!--/form-group-->

						<div class="form-group">
							<label class="col-sm-3 control-label">Seleccione Región: <strog class="theme_color"></strog></label>
							<div class="col-sm-6">
								<select name="region" id="region" onchange="escuelas();" class="form-control">
									<option selected>
										Selecciona una opción
									</option>
									@foreach($regiones as $region)
									<option value='{{$region->id}}' >
										{{$region->region}} {{$region->sostenimiento}}
									</option>
									@endforeach
								</select>

							</div>
						</div>


						<div class="form-group">
							<label class="col-sm-3 control-label">Clave Centro de Trabajo <strog class="theme_color">*</strog></label>
							<div class="col-sm-6">
								<select name="cct" id="cct" class="form-control select2" onchange="claves(this);valida_cct()"  required>
									<option selected>
										Selecciona una opción
									</option>

								</select>
								<div class="help-block with-errors"></div>
								<div class="text-danger" id='error_cct'>{{$errors->formulario->first('cct')}}</div>
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-3 control-label">Escuela: <strog class="theme_color">*</strog></label>
							<div class="col-sm-6">
								<input name="escuela" id="escuela" disabled type="text"   class="form-control" required value="{{Input::old('escuelas')}}" />
							</div>
						</div>




						<div class="form-group">
							<label class="col-sm-3 control-label">Observaciones: <strog class="theme_color">*</strog></label>
							<div class="col-sm-6">
								<input name="observaciones" type="text"   class="form-control"  value="{{Input::old('observaciones')}}" />
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
								<button type="submit" id="submit" disabled="true" class="btn btn-primary">Guardar</button>
								<a href="{{url('/listas_asistencias')}}" class="btn btn-default"> Cancelar</a>
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
		claves();
		valida_cct();
	}

function escuelas(){

	var esc = document.getElementById("region").value;

	var route = "http://localhost:8000/escuelas/"+esc;


	$.get(route,function(res){
	  if(res.length > 0){

	    for (var i = 0; i < res.length; i++) {
	      if(res[i].estado =="ACTIVO"){
	        var x = document.getElementById("cct");
	        var option = document.createElement("option");
	        option.text = res[i].cct +" "+ res[i].nombre_escuela;
	        option.value = res[i].cct +"_"+ res[i].nombre_escuela +"_"+ res[i].id;

					x.add(option, x[i]);

	      }
	    }
	  }

	 });

	}


</script>

@endsection
