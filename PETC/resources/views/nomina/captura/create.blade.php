@extends('layouts.principal')
@section('contenido')
<style type="text/css">
	.lbldetalle{
		color:#2196F3;
	}
	.h3titulo{
		margin-left: 30px;
		color:#2196F3;
		margin-top: 30px;
	}
</style>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<div class="pull-left breadcrumb_admin clear_both">
	<div class="pull-left page_title theme_color">
		<h1>Registro de Empleados</h1>
		<h2 class="active"></h2>
	</div>
	<div class="pull-right">
		<ol class="breadcrumb">
			<li><a href="?c=Inicio">Inicio</a></li>
			<li><a href="?c=">Registrar Empleado</a></li>
			<li class="active"></li>
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
							<h2 class="content-header theme_color" style="margin-top: -5px;"></h2>
						</div>
						<div class="col-md-4">
							<div class="btn-group pull-right">
								<div class="actions">
								</div>
							</div>
						</div>
					</div>
				</div><!--header-->


				<div class="porlets-content">
					<div  class="form-horizontal row-border" > <!--acomodo-->
						<form class="" id="myForm" action="{{route('captura.store')}}" method="post" role="form" enctype="multipart/form-data" parsley-validate novalidate data-toggle="validator">
							{{csrf_field()}}
							<div id="smartwizard">
								<ul>
									<li><a href="#step-1">Datos del Trabajador</a></li>
									<li><a href="#step-2">Información del Contrato</a></li>
								</ul>
								<div>
									<div id="step-1" class="">
										<div class="user-profile-content">

											<div id="form-step-0" role="form" data-toggle="validator">
												<h3 class="h3titulo">Informacion del Trabajador</h3>

												<div class="form-group">
													<label class="col-sm-3 control-label">Nombre del Empleado: <strog class="theme_color">*</strog></label>
													<div class="col-sm-6">
														<input name="nombre" id="nombre" type="text" onkeypress="return soloLetras(event)"  class="form-control" required value="{{Input::old('nombre')}}"   onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()" />
													</div>
												</div>

												<input name="rfcOculto" id="oculto"  hidden  />
												<div class="form-group">
													<label class="col-sm-3 control-label">RFC: <strog class="theme_color">*</strog></label>
													<div class="col-sm-6">
														<input name="rfc_input" id="rfc_input" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()" type="text"   class="form-control" required value="{{Input::old('rfc_input')}}"   oninput="validarInput(this);"  onchange="validarRFC();"  />
														<div class="text-danger" id='error_rfc' name="error_rfc" ></div>
													</div>
													<pre id="resultado"></pre>
												</div>

												<div class="form-group">
													<label class="col-sm-3 control-label">Teléfono: <strog class="theme_color"></strog></label>
													<div class="col-sm-6">
														<input name="telefono" id="telefono" type="text"   onkeypress="soloNumeros(event)" class="form-control"  value="{{Input::old('telefono')}}" />
													</div>
												</div>

												<div class="form-group">
													<label class="col-sm-3 control-label">Email: <strog class="theme_color"></strog></label>
													<div class="col-sm-6">
														<input name="email" id="email" type="text"   class="form-control"  value="{{Input::old('email')}}" />
													</div>
												</div>



												<div class="form-group">
													<div class="col-sm-6">
														<input  id="rfc_val" name="rfc_val" type="hidden"   class="form-control"  />
													</div>
												</div>





											</div><!--validator-->
										</div><!--user-profile-content-->
									</div><!--step-1-->

									<div id="step-2" class="">
										<div class="user-profile-content">
											<div id="form-step-1" role="form" data-toggle="validator">
												<h3 class="h3titulo">Información del Contrato</h3>



												<div class="form-group">
													<label class="col-sm-3 control-label">Tipo de Movimiento;<strog class="theme_color">*</strog></label>
													<div class="col-sm-6">
														<select name="movimiento" id="movimiento" class="form-control select" onchange="captura_personal(this.value)" required>
															<option value="INICIO" >DESDE INICIO DE CICLO</option>
															<option value="NUEVO" selected>NUEVO RECURSO </option>
															<option value="ALTA">ALTA</option>
														</select>
														<div class="text-danger" id='error_movimiento'>{{$errors->formulario->first('error_movimiento')}}</div>
													</div>
												</div>

												<div class="form-group">
													<label class="col-sm-3 control-label">Clave <strog class="theme_color">*</strog></label>
													<div class="col-sm-6">
														<select name="clave" id="clave"  onchange="verifica_clave()" class="form-control select" required>
															@foreach($claves as $clave)
															<option value="{{$clave->id}}_{{$clave->tipo_puesto}}">
																{{$clave->cat_puesto}}: {{$clave->des_puesto}} - {{$clave->tipo_puesto}}
															</option>
															@endforeach
														</select>
														<div class="text-danger" id='error_clave'>{{$errors->formulario->first('error_clave')}}</div>
														<div class="help-block with-errors"></div>
													</div>
												</div><!--/form-group-->

												<div class="form-group">
													<label class="col-sm-3 control-label">Categoria;<strog class="theme_color">*</strog></label>
													<div class="col-sm-6">
														<select name="puesto" id="puesto" class="form-control select" onchange="cambia(this.value);captura_personal()" required>

															<option value="DIRECTOR" >DIRECTOR</option>
															<option value="DOCENTE" selected>DOCENTE </option>
															<option value="INTENDENTE">INTENDENTE</option>
															<option value="USAER">USAER</option>
															<option value="EDUCACION FISICA">EDUCACION FISICA</option>

														</select>

													</div>
												</div>


												<div class="form-group">
													<label class="col-sm-3 control-label">CCT <strog class="theme_color">*</strog></label>
													<div class="col-sm-8">
														<select name="cct" id="cct" class="form-control select2"   value="{{Input::old('cct')}}"  onchange="captura_personal()" required>
															@foreach($cct as $ct)
															<option value="{{$ct->id}}">
																{{$ct->cct}}
															</option>
															@endforeach
														</select>
														<div class="help-block with-errors"></div>
														<div class="text-danger" id='error_ciclo'>{{$errors->formulario->first('cct')}}</div>
													</div>
												</div><!--/form-group-->

												<div class="form-group" id="cct_nuevo_div" style='display:none;'>
													<div class="form-group">
														<label class="col-sm-3 control-label">CCT NUEVO <strog class="theme_color">*</strog></label>
														<div class="col-sm-8">
															<select name="cct_nuevo" id="cct_nuevo" class="form-control select2"   value="{{Input::old('cct')}}"  onchange="captura_personal()" >
																@foreach($cct as $ct)

																<option value="{{$ct->id}}" >
																	{{$ct->cct}}
																</option>


																@endforeach
															</select>
															<div class="help-block with-errors"></div>
															<div class="text-danger" id='error_ciclo'>{{$errors->formulario->first('cct')}}</div>
														</div>
													</div><!--/form-group-->
												</div>


												<div class="form-group">
													<label class="col-sm-3 control-label">Sostenimiento;<strog class="theme_color">*</strog></label>
													<div class="col-sm-6">
														<select name="sostenimiento" id="sostenimiento" class="form-control select" required>

															<option value="FEDERAL" selected>FEDERAL</option>
															<option value="ESTATAL" >ESTATAL </option>

														</select>

													</div>
												</div>


												<div class="form-group">
													<label class="col-sm-3 control-label">Ciclo Escolar: <strog class="theme_color">*</strog></label>
													<div class="col-sm-6">
														<select name="ciclo_escolar" id="ciclo_escolar" class="form-control select2">
															@foreach($ciclos as $ciclo)
															@if($ciclo->id == 2)
															<option value='{{$ciclo->id}}' selected>
																{{$ciclo->ciclo}}
															</option>
															@else
															<option value='{{$ciclo->id}}'>
																{{$ciclo->ciclo}}
															</option>
															@endif

															@endforeach
														</select>

													</div>
												</div>

												<div class="form-group">
													<label class="col-sm-3 control-label">Documentación Entregada: <strog class="theme_color">*</strog></label>
													<div class="col-sm-3">
														<input type="checkbox" name="doc1" id="doc1" onchange="cambia5(this.id)" value="ORDEN">Orden de Presentación<br>
														<input type="checkbox" name="doc2" id="doc2" onchange="cambia5(this.id)" value="OFICIO">Ofició<br>
														<input type="checkbox" name="doc3" id="doc3" onchange="cambia5(this.id)" value="TALON">Talón de Cheque<br>
													</div>
												</div><!--/form-group-->
												<div class="form-group" id="diasdiv" style='display:none;'>
													<div class="form-group">
														<label class="col-sm-3 control-label">Dias Trabajados en este CT: <strog class="theme_color">*</strog></label>
														<div class="col-sm-3">
															<input type="checkbox" name="Lunes" id="Lunes" onchange="cambia4(this.value)" value="LUNES">Lunes<br>
															<input type="checkbox" name="Martes" id="Martes" onchange="cambia4(this.value)" value="MARTES">Martes<br>
															<input type="checkbox" name="Miercoles" id="Miercoles" onchange="cambia4(this.value)" value="MIERCOLES">Miercoles<br>
															<input type="checkbox" name="Jueves" id="Jueves" onchange="cambia4(this.value)" value="JUEVES">Jueves<br>
															<input type="checkbox" name="Viernes" id="Viernes" onchange="cambia4(this.value)" value="VIERNES">Viernes<br>
														</div>

													</div><!--/form-group-->
												</div>



												<div class="form-group" id="num_esc" style='display:none;'>
													<div class="form-group">
														<label class="col-sm-3 control-label">Número de Escuelas ETC: <strog class="theme_color">*</strog></label>
														<div class="col-sm-2">

															<input name="num_escuelas" type="number" class="form-control" onchange="cambiacct(this.value)" required value="1" >
														</div>
													</div>
												</div>


												<div class="form-group" id="cct2div" style='display:none;'>
													<div class="form-group">
														<label class="col-sm-3 control-label">CCT Tiempo Completo 2: <strog class="theme_color">*</strog></label>
														<div class="col-sm-6">
															<input name="cct_etc2" id="cct_etc2" type="text"  onchange="mayus(this);"  class="form-control" onkeypress=" return soloLetras(event);" value="" placeholder="Ingrese el CCT de Tiempo Completo" />
														</div>
													</div>
												</div>


												<div class="form-group" class="col-sm-8" id="docente_cu" style='display:none;'>
													<div class="form-group">
														<label class="col-sm-3 control-label">Nombre del Docente a Cubrir: <strog class="theme_color">*</strog></label>
														<div class="col-sm-8">
															<select name="docente_cubrir" class="form-control select" id="docente_cubrir">

															</select>
															<div class="help-block with-errors"></div>
														</div>
													</div>
												</div>

												<div class="form-group">
													<label class="col-sm-3 control-label">Fecha de Inicio de Labores: <strog class="theme_color">*</strog></label>
													<div class="col-sm-6">

														<input type="date" name="fechai" id="fechai" value="2019-08-26" class="form-control mask"  onchange="verifica_fecha()" required>
													</div>
												</div>

												<div class="form-group">
													<label class="col-sm-3 control-label">Fecha de Termino de Labores: <strog class="theme_color">*</strog></label>
													<div class="col-sm-6">

														<input type="date" name="fechaf" id="fechaf" class="form-control mask" value="2020-07-06"  onchange="verifica_fecha()" required >
													</div>
													<div class="text-danger" id='error_fecha'>{{$errors->formulario->first('error_fecha')}}</div>
												</div>

												<div class="form-group">
													<label class="col-sm-3 control-label">Observaciónes: <strog class="theme_color"></strog></label>
													<div class="col-sm-6">
														<input name="observaciones" id="observaciones" type="text" onkeypress="return soloLetras(event)"  class="form-control"  value="{{Input::old('observaciones')}}"   onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()" />
													</div>
												</div>

												<div class="form-group">
													<div class="col-sm-offset-7 col-sm-5">
														<button id="submit3"  onclick="return save();" class="btn btn-primary">Guardar</button>
														<a href="{{url('/captura')}}" class="btn btn-default"> Cancelar</a>
													</div>
												</div><!--/form-group-->


												<div class="form-group">
													<div class="col-sm-6">
														<input  id="diassemana" value="" name="diassemana" type="hidden"  class="form-control""/>
													</div>
												</div>

												<div class="form-group">
													<div class="col-sm-6">
														<input  id="doc" value="" name="doc" type="hidden"  class="form-control""/>
													</div>
												</div>

											</div><!--validator-->
										</div><!--user-profile-content-->
									</div><!--step-2-->



								</div><!--validator-->
							</div><!--user-profile-content-->
						</div><!--step-2-->

					</div>
				</div>  <!--smartwizard-->
			</form>
		</div><!--/form-horizontal-->
	</div><!--/porlets-content-->
</div><!--/block-web-->
</div><!--/col-md-12-->
</div><!--/row-->
</div><!--/container clear_both padding_fix-->
@include('nomina.captura.modalreactivar')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
        // Toolbar extra buttons
        var btnFinish = $('<button></button>').text('Finish')
        .addClass('btn btn-info')
        .on('click', function(){
        	if( !$(this).hasClass('disabled')){
        		var elmForm = $("#myForm");
        		if(elmForm){
        			elmForm.validator('validate');
        			var elmErr = elmForm.find('.has-error');
        			if(elmErr && elmErr.length > 0){
        				alert('Oops we still have error in the form');
        				return false;
        			}else{
        				alert('Great! we are ready to submit form');
        				elmForm.submit();
        				return false;
        			}
        		}
        	}
        });
        var btnCancel = $('<button style="margin-left:-200px;"></button>').text('Cancel')
        .addClass('btn btn-danger')
        .on('click', function(){
        	$('#smartwizard').smartWizard("reset");
        	$('#myForm').find("input, textarea").val("");
        });


        // Smart Wizard
        $('#smartwizard').smartWizard({
        	selected: 0,
        	theme: 'arrows',
        	transitionEffect:'fade',
        	toolbarSettings: {toolbarPosition: 'bottom'},
        	anchorSettings: {
            markDoneStep: true, // add done css
            markAllPreviousStepsAsDone: true, // When a step selected by url hash, all previous steps are marked done
            removeDoneStepOnNavigateBack: true, // While navigate back done step after active step will be cleared
            enableAnchorOnDoneStep: true // Enable/Disable the done steps navigation
        }
    });

        $("#smartwizard").on("leaveStep", function(e, anchorObject, stepNumber, stepDirection) {
        	var elmForm = $("#form-step-" + stepNumber);
          // stepDirection === 'forward' :- this condition allows to do the form validation
          // only on forward navigation, that makes easy navigation on backwards still do the validation when going next
          if(stepDirection === 'forward' && elmForm){
          	if(stepNumber == 0){
          		var r = document.getElementById("error_rfc").value;
          		if(r==1){
          			return false;
          		}

          	}else if (stepNumber == 1){
          		var z = document.getElementById('error_movimiento').value;
          		var c = document.getElementById('error_fecha').value;
          		var x = document.getElementById('error_clave').value;

          		if (z == 1 || c == 1 || x == 1){
          			return false;
          		}

          	}else if (stepNumber == 2){

          	}

          	var elmErr = elmForm.children('.has-error');
          	if(elmErr && elmErr.length > 0){
              // Form validation failed
              return false;
          }
      }
      return true;
  });

        $("#smartwizard").on("showStep", function(e, anchorObject, stepNumber, stepDirection) {
          // Enable finish button only on last step
          if(stepNumber == 1){
          	$('.btn-finish').removeClass('disabled');
          }else{
          	$('.btn-finish').addClass('disabled');
          }
      });

    });

	function sortTable() {
		var table, rows, switching, i, x, y, shouldSwitch;
		table = document.getElementById("myTable");
		switching = true;
  /*Make a loop that will continue until
  no switching has been done:*/
  while (switching) {
    //start by saying: no switching is done:
    switching = false;
    rows = table.getElementsByTagName("TR");
    /*Loop through all table rows (except the
    first, which contains table headers):*/
    for (i = 0; i < (rows.length - 1); i++) {
      //start by saying there should be no switching:
      shouldSwitch = false;
      /*Get the two elements you want to compare,
      one from current row and one from the next:*/
      x = rows[i].getElementsByTagName("TD")[0];
      y = rows[i + 1].getElementsByTagName("TD")[0];
      //check if the two rows should switch place:
      if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
        //if so, mark as a switch and break the loop:
        shouldSwitch = true;
        break;
    }
}
if (shouldSwitch) {
      /*If a switch has been marked, make the switch
      and mark that a switch has been done:*/
      rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
      switching = true;
  }
}
}



function save(){
	var z = document.getElementById('error_movimiento').value;
	var c = document.getElementById('error_fecha').value;
	var x = document.getElementById('error_clave').value;
	var r = document.getElementById("error_rfc").value;


	if (z== 1 || c==1 || x==1 || r==1){
		return false;

	}

}



window.onload = function() {
	document.getElementById('nombre').focus();
  //funciones a ejecutar
};




function cambia(value) {
	if (value == "USAER" || value == "EDUCACION FISICA"){
		document.getElementById('diasdiv').style.display = 'block';
		document.getElementById('num_esc').style.display = 'block';
		document.getElementById('num_esc').style.required = true;
	}else{
		document.getElementById('diasdiv').style.display = 'none';
		document.getElementById('num_esc').style.display = 'none';
		document.getElementById('num_esc').style.required = false;
		document.getElementById('diasdiv').style.required = false;

	}
  // body...
}

var aux = [];
function cambia4(x){
	var z = document.getElementById(x).checked;
	if (z == true){
		aux.push(x);

	}else{
		var pos = aux.indexOf(x);
		var elementoEliminado = aux.splice(pos, 1);

	}
	document.getElementById('diassemana').value = aux;
	var y = document.getElementById('diassemana').value;
}

var aux = [];
function cambia5(x){
	var z = document.getElementById(x).checked;
	var j =document.getElementById(x).value;
	if (z == true){
		aux.push(j);

	}else{
		var pos = aux.indexOf(j);
		var elementoEliminado = aux.splice(pos, 1);

	}
	document.getElementById('doc').value = aux;
	var y = document.getElementById('doc').value;

}

function cambiacct(value) {
	if (value == 2){
		document.getElementById('cct2div').style.display = 'block';
		document.getElementById('cct_etc2').style.required = true;
		document.getElementById('cct3div').style.display = 'none';
		document.getElementById('cct_etc3').style.required = false;
  // body...
}else if (value >= 3){
	document.getElementById('cct2div').style.display = 'block';
	document.getElementById('cct_etc2').style.required = true;
	document.getElementById('cct3div').style.display = 'block';
	document.getElementById('cct_etc3').style.required = true;

} else if (value == 1){
	document.getElementById('cct2div').style.display = 'none';
	document.getElementById('cct_etc2').style.required = false;
	document.getElementById('cct3div').style.display = 'none';
	document.getElementById('cct_etc3').style.required = false;

}
}


</script>
@endsection
