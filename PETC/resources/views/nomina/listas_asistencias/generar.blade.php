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
<div class="container clear_both padding_fix">
	<div class="row">
		<div class="col-md-12">
			<div class="block-web">
				<div class="header">
					<div class="row" style="margin-top: 15px; margin-bottom: 12px;">
						<div class="col-sm-8">
							<div class="actions"> </div>
							<h2 class="content-header" style="margin-top: -5px;"><strong>Generar Listas de Asistencia</strong></h2>
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
					<div  class="form-horizontal row-border" > <!--acomodo-->
						<form class="" id="myForm" action="{{route('nomina.inasistencias.generar_pdf_listas')}}" method="post" role="form" enctype="multipart/form-data" parsley-validate novalidate data-toggle="validator">
							{{csrf_field()}}

							<div class="form-group">
								<label class="col-sm-3 control-label">Ciclo Escolar: <strog class="theme_color">*</strog></label>
								<div class="col-sm-6">
									<select name="ciclo_escolar" id="ciclo_escolar"  class="form-control select2" ">
										@foreach($ciclos as $ciclo) 
										@if($ciclo->id == 2)
										<option value='{{$ciclo->ciclo}}' selected>
											{{$ciclo->ciclo}}
										</option>
										@else
										<option value='{{$ciclo->ciclo}}' >
											{{$ciclo->ciclo}}
										</option>
										@endif
										@endforeach
									</select>

								</div>
							</div>


							<div class="form-group">
								<label class="col-sm-3 control-label">Seleccione Una Opción <strog class="theme_color">*</strog></label>
								<div class="col-sm-6">

									<input type="radio" name="option1" id="option1"  onclick="cambia_valor(1)" value="1"> Todas las Regiónes<br>
									<input type="radio" name="option1" id="option1" value="2" onclick="cambia_valor(2)" > Seleccionar Región<br>
								</div>
							</div>

							<div class="form-group" id="div_region" style='display:none;'>

							<div class="form-group">
						<label class="col-sm-3 control-label">Región <strog class="theme_color">*</strog></label>
						<div class="col-sm-6">
							<select name="region" id="region" class="form-control select" onchange="busca_escuelasr(2)"  >
								@foreach($region as $region)
								<option value="{{$region->id}}">
									{{$region->region}} {{$region->sostenimiento}}

								</option>
								@endforeach
							</select>
							<div class="help-block with-errors"></div>
							<!--	<div class="text-danger" id='error_ciclo'>{{$errors->formulario->first('cct')}}</div>
						--></div>
					</div>


								<div class="form-group">
									<label class="col-sm-3 control-label">Seleccione Una Opción <strog class="theme_color">*</strog></label>
									<div class="col-sm-6">

										<input type="radio" name="option2" id="option2"  onchange="busca_escuelasr(1)" value="1"> Todas los CTE<br>
										<input type="radio" name="option2" id="option2" onchange="busca_escuelasr(2)" value="2"> Seleccionar CTE<br>
										<div class="help-block with-errors"></div>
							<!--	<div class="text-danger" id='error_ciclo'>{{$errors->formulario->first('cct')}}</div>
						--></div>
					</div>

					
					



				</div>


				<div class="form-group" id="div_cct" style='display:none;'>
					<div class="form-group">
						<label class="col-sm-3 control-label">Centro de Trabajo <strog class="theme_color">*</strog></label>
						<div class="col-sm-6">
							<select name="cct" id="cct" class="form-control select" >								
							</select>
							<div class="help-block with-errors"></div>
							<!--	<div class="text-danger" id='error_ciclo'>{{$errors->formulario->first('cct')}}</div>
						--></div>
					</div>

					
				</div>




						<div class="form-group">
							<label class="col-sm-3 control-label">Mes <strog class="theme_color">*</strog></label>
							<div class="col-sm-6">
								<select  name="mes" id="mes" class="form-control select" >
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
							<label class="col-sm-3 control-label">Observaciones: <strog class="theme_color">*</strog></label>
							<div class="col-sm-6">
								<input name="observaciones" type="text"   class="form-control" required value="{{Input::old('observaciones')}}" />
							</div>
						</div>


 
					<div class="form-group">
						<div class="col-sm-offset-7 col-sm-5">
							<button id="submit3" target="_blank" class="btn btn-primary">Generar</button>
							<a href="{{url('/listas_asistencias')}}" class="btn btn-default"> Cancelar</a>
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
						






					</form>
				</div><!--/porlets-content-->
			</div><!--/block-web-->
		</div><!--/col-md-12-->
	</div><!--/row-->
</div><!--/container clear_both padding_fix-->
<script type="text/javascript">
	function cambia_valor(aux){	

		if(aux == 1){
			document.getElementById('div_region').style.display = 'none';

		}else{

			document.getElementById('div_region').style.display = 'block';
		}
	}

	function busca_escuelasr(value){
		limpiar_input_cct();
		var region = document.getElementById('region').value;
		var route = "http://localhost:8000/busca_escuelas_region/"+region+"/";

		if(value == 1){
			document.getElementById('div_cct').style.display = 'none';

		}else{
			document.getElementById('div_cct').style.display = 'block';
			$.get(route,function(res){
				if(res.length > 0){
					for (var i = 0; i < res.length; i++) {
						var x = document.getElementById("cct");
						var option = document.createElement("option");						      
						option.text = res[i].cct +"-"+res[i].nombre_escuela;
						option.value = res[i].id;
						x.add(option, x[i])					
					}
				}
			});

		}
	}



	function limpiar_input_cct(){
		var x = document.getElementById('cct');
		if (x.length > 0){
			for (var i = 0; i < x.length; i++) {
				x.remove(i);
			}}
		}
	</script>

	@endsection
