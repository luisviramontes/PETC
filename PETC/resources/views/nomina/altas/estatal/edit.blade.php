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
		<h1>Modificar Registro de Alta</h1>
		<h2 class="active"></h2>
	</div>
	<div class="pull-right">
		<ol class="breadcrumb">
			<li><a href="?c=Inicio">Inicio</a></li>
			<li><a href="?c=">Altas</a></li>
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
						<form action="{{url('/altasest', [$personal->id])}}" method="post" class="form-horizontal row-border" parsley-validate novalidate files="true" enctype="multipart/form-data" accept-charset="UTF-8">
							{{csrf_field()}}
							<input type="hidden" name="_method" value="PUT">


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
														<input name="nombre" id="nombre" type="text" onkeypress="return soloLetras(event)"  class="form-control" required value="{{$personal->nombre}}"  disabled="true"  onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()" />
													</div>
												</div>

												<input name="rfcOculto" id="oculto"  hidden  />
												<div class="form-group">
													<label class="col-sm-3 control-label">RFC: <strog class="theme_color">*</strog></label>
													<div class="col-sm-6">
														<input name="rfc_input" id="rfc_input" disabled="true" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()" type="text"   class="form-control" required value="{{$personal->rfc}}"   oninput="validarInput(this);"  onchange="validarRFC();"  />
														<div class="text-danger" id='error_rfc'>{{$errors->formulario->first('rfc_input')}}</div>
													</div>
													<pre id="resultado"></pre>						
												</div>

												<div class="form-group">
													<label class="col-sm-3 control-label">Teléfono: <strog class="theme_color"></strog></label>
													<div class="col-sm-6">
														<input name="telefono" id="telefono" disabled="true" type="text"   onkeypress="soloNumeros(event)" class="form-control" value="{{$personal->telefono}}" />
													</div>
												</div>

												<div class="form-group">
													<label class="col-sm-3 control-label">Email: <strog class="theme_color"></strog></label>
													<div class="col-sm-6">
														<input name="email" disabled="true" id="email" type="text"   class="form-control"  value="{{$personal->email}}" />
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
														<select name="movimiento" id="movimiento" class="form-control select" onchange="captura_personal(this.value)" required >
															@if($personal->tipo_movimiento == "NUEVO") 
															<option value="INICIO" >DESDE INICIO DE CICLO</option>
															<option value="NUEVO" selected>NUEVO RECURSO </option>
															<option value="ALTA">ALTA</option>
															<option value="REINCORPORACION" >REINCORPORACION</option>
																		
															@elseif ($personal->tipo_movimiento == "INICIO")
															<option value="INICIO" selected>DESDE INICIO DE CICLO</option>
															<option value="NUEVO" >NUEVO RECURSO </option>
															<option value="ALTA">ALTA</option>
															<option value="REINCORPORACION" >REINCORPORACION</option>
															
															@elseif ($personal->tipo_movimiento == "REINCORPORACION")
															<option value="INICIO" >DESDE INICIO DE CICLO</option>
															<option value="NUEVO" >NUEVO RECURSO </option>
															<option value="ALTA">ALTA</option>
															
															<option value="REINCORPORACION" selected>REINCORPORACION</option>
															
															@else
															<option value="INICIO" >DESDE INICIO DE CICLO</option>
															<option value="NUEVO" >NUEVO RECURSO </option>
															<option value="ALTA" selected>ALTA</option>
															<option value="REINCORPORACION" >REINCORPORACION</option>							
															@endif																	
														</select>
														<div class="text-danger" id='error_movimiento'>{{$errors->formulario->first('error_movimiento')}}</div>
													</div> 
												</div>

												<div class="form-group">
													<label class="col-sm-3 control-label">Clave <strog class="theme_color">*</strog></label>
													<div class="col-sm-6">
														<select name="clave" id="clave"  onchange="verifica_clave()" class="form-control select" required>
															@foreach($claves as $clave)
															@if($clave->id == $personal->clave)
															<option value="{{$clave->id}}_{{$clave->tipo_puesto}}" selected>
																{{$clave->cat_puesto}}: {{$clave->des_puesto}} - {{$clave->tipo_puesto}}
															</option>
															@else
															<option value="{{$clave->id}}_{{$clave->tipo_puesto}}">
																{{$clave->cat_puesto}}: {{$clave->des_puesto}} - {{$clave->tipo_puesto}}
															</option>
															@endif
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
															@if($personal->categoria == "DOCENTE")
															<option value="DIRECTOR" >DIRECTOR</option>
															<option value="DOCENTE" selected>DOCENTE </option>
															<option value="INTENDENTE">INTENDENTE</option>
															<option value="USAER">USAER</option>
															<option value="EDUCACION FISICA">EDUCACION FISICA</option>
															@elseif($personal->categoria == "DIRECTOR")
															<option value="DIRECTOR" selected>DIRECTOR</option>
															<option value="DOCENTE" >DOCENTE </option>
															<option value="INTENDENTE">INTENDENTE</option>
															<option value="USAER">USAER</option>
															<option value="EDUCACION FISICA">EDUCACION FISICA</option>
															@elseif($personal->categoria == "INTENDENTE")
															<option value="DIRECTOR" >DIRECTOR</option>
															<option value="DOCENTE" >DOCENTE </option>
															<option value="INTENDENTE" selected>INTENDENTE</option>
															<option value="USAER">USAER</option>
															<option value="EDUCACION FISICA">EDUCACION FISICA</option>
															@elseif($personal->categoria == "USAER")
															<option value="DIRECTOR" >DIRECTOR</option>
															<option value="DOCENTE" >DOCENTE </option>
															<option value="INTENDENTE">INTENDENTE</option>
															<option value="USAER" selected>USAER</option>
															<option value="EDUCACION FISICA">EDUCACION FISICA</option>
															@else
															<option value="DIRECTOR" >DIRECTOR</option>
															<option value="DOCENTE" >DOCENTE </option>
															<option value="INTENDENTE">INTENDENTE</option>
															<option value="USAER">USAER</option>
															<option value="EDUCACION FISICA" selected>EDUCACION FISICA</option>
															@endif
														</select>
														
													</div> 
												</div>
												

												<div class="form-group">
													<label class="col-sm-3 control-label">CCT <strog class="theme_color">*</strog></label>
													<div class="col-sm-8">
														<select name="cct" id="cct" class="form-control select2"   value="{{Input::old('cct')}}"  onchange="captura_personal()" required>
															@foreach($cct as $ct)
															@if($personal->id_cct_etc == $ct->id)
															<option value="{{$ct->id}}" selected>
																{{$ct->cct}}
															</option>
															@else
															<option value="{{$ct->id}}" >
																{{$ct->cct}}
															</option>
															@endif
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
																@if($personal->id_cct_etc == $ct->id)
																<option value="{{$ct->id}}" selected>
																	{{$ct->cct}}
																</option>
																@else
																<option value="{{$ct->id}}" >
																	{{$ct->cct}}
																</option>
																@endif
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
															@if($personal->sostenimiento == "FEDERAL")
															<option value="FEDERAL" selected>FEDERAL</option>
															<option value="ESTATAL" >ESTATAL </option>
															@else
															<option value="FEDERAL" >FEDERAL</option>
															<option value="ESTATAL" selected>ESTATAL </option>
															@endif

														</select>
														
													</div> 
												</div>


												<div class="form-group">
													<label class="col-sm-3 control-label">Ciclo Escolar: <strog class="theme_color">*</strog></label>
													<div class="col-sm-6">
														<select name="ciclo_escolar" id="ciclo_escolar" class="form-control select2" ">
															@foreach($ciclos as $ciclo)
															@if($personal->id_ciclo == $ciclo->id)
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
															<input type="checkbox" name="LUNES" id="LUNES" onchange="cambia4(this.value)" value="LUNES">LUNES<br>
															<input type="checkbox" name="MARTES" id="MARTES" onchange="cambia4(this.value)" value="MARTES">MARTES<br>
															<input type="checkbox" name="MIERCOLES" id="MIERCOLES" onchange="cambia4(this.value)" value="MIERCOLES">MIERCOLES<br>
															<input type="checkbox" name="JUEVES" id="JUEVES" onchange="cambia4(this.value)" value="JUEVES">JUEVES<br>
															<input type="checkbox" name="VIERNES" id="VIERNES" onchange="cambia4(this.value)" value="VIERNES">VIERNES<br>
														</div>

													</div><!--/form-group-->
												</div>



												<div class="form-group" id="num_esc" style='display:none;'>
													<div class="form-group">
														<label class="col-sm-3 control-label">Número de Escuelas ETC: <strog class="theme_color">*</strog></label>
														<div class="col-sm-2">

															<input name="num_escuelas" type="number" class="form-control" value="{{$personal->num_escuelas}}" onchange="cambiacct(this.value)" required value="1" >
														</div>
													</div>
												</div>


												<div class="form-group" id="cct2div" style='display:none;'>
													<div class="form-group">
														<label class="col-sm-3 control-label">CCT Tiempo Completo 2: <strog class="theme_color">*</strog></label>
														<div class="col-sm-6">
															<input name="cct_etc2" id="cct_etc2" type="text"  onchange="mayus(this);"  class="form-control" onkeypress=" return soloLetras(event);"  value="{{$personal->cct_2}}"   placeholder="Ingrese el CCT de Tiempo Completo" />
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

														<input type="date" name="fechai" id="fechai" value="{{$personal->fecha_inicio}}" onchange="verifica_fecha()" class="form-control mask" required>
													</div>
												</div>

												<div class="form-group">
													<label class="col-sm-3 control-label">Fecha de Termino de Labores: <strog class="theme_color">*</strog></label>
													<div class="col-sm-6">

														<input type="date" name="fechaf" id="fechaf" value="{{$personal->fecha_termino}}" class="form-control mask"  onchange="verifica_fecha()" required >
													</div>
													<div class="text-danger" id='error_fecha'>{{$errors->formulario->first('error_fecha')}}</div>
												</div>

												<div class="form-group">
													<label class="col-sm-3 control-label">Observaciónes: <strog class="theme_color"></strog></label>
													<div class="col-sm-6">
														<input name="observaciones" id="observaciones" type="text" onkeypress="return soloLetras(event)"  class="form-control"  value="{{$personal->observaciones}}"   onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()" />
													</div> 
												</div>

												<div class="form-group">
													<div class="col-sm-offset-7 col-sm-5">
														<button id="submit3" class="btn btn-primary">Guardar</button>
														<a href="{{url('/altasest')}}" class="btn btn-default"> Cancelar</a>
													</div>
												</div><!--/form-group--> 


												<div class="form-group">
													<div class="col-sm-6">
														<input  id="diassemana"  name="diassemana" type="hidden"  class="form-control""/>
													</div>
												</div>

												<div class="form-group">
													<div class="col-sm-6">
														<input  id="doc"  name="doc" type="hidden"  class="form-control""/>
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

}



window.onload = function() {
	document.getElementById('nombre').focus();
	var x = "{{$personal->documentacion_entregada}}";
	var z = "{{$personal->tipo_movimiento}}";
	var y= "{{$personal->categoria}}";
	var w= "{{$personal->dias_trabajados}}";

	if(x.length > 0){
		var select=String(x);
		var cantidadtotal = select;
		limite = "3",
		separador = ",",
		arregloDeSubCadenas = cantidadtotal.split(separador, limite);
		if(arregloDeSubCadenas[0] || "ORDEN" || arregloDeSubCadenas[1] == "ORDEN" || arregloDeSubCadenas[2] == "ORDEN"){
			document.getElementById('doc1').checked = true;

		}
		if(arregloDeSubCadenas[0] == "OFICIO" || arregloDeSubCadenas[1] == "OFICIO" || arregloDeSubCadenas[2] == "OFICIO"){
			document.getElementById('doc2').checked = true;

		}
		if (arregloDeSubCadenas[0] == "TALON" || arregloDeSubCadenas[1] == "TALON" || arregloDeSubCadenas[2] == "TALON"){
			document.getElementById('doc3').checked = true;

		}

	}

	captura_personal(z);
	verifica_clave();
	cambia(y);
	if(y== "USAER" || y =="EDUCACION FISICA"){
		if(x.length > 0){
			var select=String(x);
			var cantidadtotal = select;
			limite = "5",
			separador = ",",
			arregloDeSubCadenas = cantidadtotal.split(separador, limite);
			var aux2 = [];

			if (arregloDeSubCadenas[0] == "LUNES" || arregloDeSubCadenas[1] == "LUNES" || arregloDeSubCadenas[2] == "LUNES" || arregloDeSubCadenas[3] == "LUNES"|| arregloDeSubCadenas[4] == "LUNES"){
				document.getElementById('LUNES').checked = true;
				aux2.push('LUNES');

			}

			if (arregloDeSubCadenas[0] == "MARTES" || arregloDeSubCadenas[1] == "MARTES" || arregloDeSubCadenas[2] == "MARTES" || arregloDeSubCadenas[3] == "MARTES"|| arregloDeSubCadenas[4] == "MARTES"){
				document.getElementById('MARTES').checked = true;
				aux2.push('MARTES');

			}
			if (arregloDeSubCadenas[0] == "MIERCOLES" || arregloDeSubCadenas[1] == "MIERCOLES" || arregloDeSubCadenas[2] == "MIERCOLES" || arregloDeSubCadenas[3] == "MIERCOLES"|| arregloDeSubCadenas[4] == "MIERCOLES"){
				document.getElementById('MIERCOLES').checked = true;
				aux2.push('MIERCOLES');

			}
			if (arregloDeSubCadenas[0] == "JUEVES" || arregloDeSubCadenas[1] == "JUEVES" || arregloDeSubCadenas[2] == "JUEVES" || arregloDeSubCadenas[3] == "JUEVES"|| arregloDeSubCadenas[4] == "JUEVES"){
				document.getElementById('JUEVES').checked = true;
				aux2.push('JUEVES');

			}
			if (arregloDeSubCadenas[0] == "VIERNES" || arregloDeSubCadenas[1] == "VIERNES" || arregloDeSubCadenas[2] == "VIERNES" || arregloDeSubCadenas[3] == "VIERNES"|| arregloDeSubCadenas[4] == "VIERNES"){
				document.getElementById('VIERNES').checked = true;
				aux2.push('VIERNES');

			}
			document.getElementById('doc').value = aux2;
			if(w.length > 0){
				var select2=String(w);
				//alert(select2);
				var cantidadtotal2 = select2;
				limite2 = "5",
				separador2 = ",",
				arregloDeSubCadenas2 = cantidadtotal2.split(separador2, limite2);
			//	alert(arregloDeSubCadenas2[0]);
			for (var i = 0; i <= 4; i++) {
				if (arregloDeSubCadenas2[i] != undefined ){
					cambia6(arregloDeSubCadenas2[i]);
				}
			}
		}

	}
}
}




  //funciones a ejecutar




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
		//alert(x);
		if (x > 0){
			var z = document.getElementById(x).checked;
			if (z == true){
				aux.push(x);

			}else{
				var pos = aux.indexOf(x);
				var elementoEliminado = aux.splice(pos, 1);

			}
			document.getElementById('diassemana').value = aux;
			var y = document.getElementById('diassemana').value;
		}}

		var aux2 = [];
		function cambia5(x){

			var z = document.getElementById(x).checked;
			var j =document.getElementById(x).value;
			if (z == true){
				aux2.push(j);

			}else{
				var pos = aux2.indexOf(j);
				var elementoEliminado = aux2.splice(pos, 1);

			}
			document.getElementById('doc').value = aux2;
			var y = document.getElementById('doc').value;

		}

		function cambia6(x){

			var z = document.getElementById(x).checked;
			document.getElementById(x).checked= true;
			var j =document.getElementById(x).value;

			aux.push(j);
			alert(aux);
			document.getElementById('diassemana').value = aux;
			var y = document.getElementById('diassemana').value;

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
