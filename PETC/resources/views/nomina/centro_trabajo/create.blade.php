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
		<h1>Centro de Trabajo</h1>
		<h2 class="active"></h2>
	</div>
	<div class="pull-right">
		<ol class="breadcrumb">
			<li><a href="?c=Inicio">Inicio</a></li>
			<li><a href="?c=">Registrar Centro de Trabajo</a></li>
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
						<form class="" id="myForm" action="{{route('centro_trabajo.store')}}" method="post" role="form" enctype="multipart/form-data" parsley-validate novalidate data-toggle="validator">
							{{csrf_field()}}
							<div id="smartwizard">
								<ul>
									<li><a href="#step-1">Datos Centro de Trabajo</a></li>
									<li><a href="#step-2">Dirección</a></li>
									<li><a href="#step-3">Información del CT</a></li>
								</ul>
								<div>
									<div id="step-1" class="">
										<div class="user-profile-content">

											<div id="form-step-0" role="form" data-toggle="validator">
												<h3 class="h3titulo">Informacion del CT</h3>

												<div class="form-group">
													<label class="col-sm-3 control-label">CCT: <strog class="theme_color">*</strog></label>
													<div class="col-sm-6">
														<input name="cct" id="cct" type="text" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()"  class="form-control" required placeholder="Ingrese La Clave de Centro de Trabajo" maxlength="10" value="{{Input::old('cct')}}" />
													</div>
												</div>
												<div class="text-danger" id='error_cct'>{{$errors->formulario->first('cct')}}</div>

												<div class="form-group">
													<label class="col-sm-3 control-label">Nombre de la Escuela: <strog class="theme_color">*</strog></label>
													<div class="col-sm-6">
														<input name="nombre" id="nombre" type="text"   class="form-control" required placeholder="Ingrese el Nombre de la Escuela" maxlength="40" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()" value="{{Input::old('nombre')}}"  />
														<div class="text-danger" id='error_nombre'>{{$errors->formulario->first('nombre')}}</div>
													</div>

												</div>

												<div class="form-group">
													<label class="col-sm-3 control-label">Región <strog class="theme_color">*</strog></label>
													<div class="col-sm-6">
														<select name="region" id="region" class="form-control select2" onchange="cen_reg();"  value="{{Input::old('region')}}"  required>
															<option selected>
																Seleccione una opción
															</option>
															@foreach($region as $dato)
															<option value="{{$dato->id}}">
																{{$dato->region}}-{{$dato->sostenimiento}}
															</option>
															@endforeach
														</select>
														<div class="help-block with-errors"></div>
														<div class="text-danger" id='error_region'>{{$errors->formulario->first('region')}}</div>
													</div>
												</div><!--/form-group-->



												<div class="form-group">
													<label class="col-sm-3 control-label">Ciclo Escolar <strog class="theme_color">*</strog></label>
													<div class="col-sm-6">
														<select name="ciclo" id="ciclo" class="form-control"onchange="cen_ciclo()"  value="{{Input::old('ciclo')}}"  required>
															<option selected>
																Seleccione una opción
															</option>
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
													<label class="col-sm-3 control-label">Entrego Carta Compromiso: <strog class="theme_color">*</strog></label>
													<div class="col-sm-6">
														<select name="carta_compromiso" id="carta_compromiso" onchange="cen_car()" class="form-control" required>
															<option selected>
																Seleccione una opción
															</option>
															<option value="Si">
																Si
															</option>
															<option value="No">
																No
															</option>
														</select>
														<div class="help-block with-errors"></div>
														<div class="text-danger" id='error_carta_compromiso'>{{$errors->formulario->first('carta_compromiso')}}</div>
													</div>
												</div><!--/form-group-->

												<div class="form-group">
													<label class="col-sm-3 control-label">Alimentación: <strog class="theme_color">*</strog></label>
													<div class="col-sm-6">
														<select name="alimentacion" id="alimentacion" onchange="cen_ali()" class="form-control" required>
															<option selected>
																Seleccione una opción
															</option>
															<option value="SI">
																SI
															</option>
															<option value="NO">
																NO
															</option>
														</select>
														<div class="help-block with-errors"></div>
														<div class="text-danger" id='error_alimentacion'>{{$errors->formulario->first('alimentacion')}}</div>
													</div>
												</div><!--/form-group-->

												<div class="form-group">
													<label class="col-sm-3 control-label">Nivel: <strog class="theme_color">*</strog></label>
													<div class="col-sm-6">
														<select name="nivel" id="nivel" onchange="cen_niv()" class="form-control" required>
															<option selected>
																Seleccione una opción
															</option>
															<option value="PREESCOLAR">
																PREESCOLAR
															</option>
															<option value="PRIMARIA">
																PRIMARIA
															</option>
															<option value="TELESECUNDARIA">
																TELESECUNDARIA
															</option>
														</select>
														<div class="help-block with-errors"></div>
														<div class="text-danger" id='error_nivel'>{{$errors->formulario->first('nivel')}}</div>
													</div>
												</div><!--/form-group-->

												<div class="form-group">
													<label class="col-sm-3 control-label">Fecha de Ingreso al PETC: <strog class="theme_color">*</strog></label>
													<div class="col-sm-6">
														<input name="ingreso" id="ingreso"  type="date"  required  />
													</div>
												</div>





											</div><!--validator-->
										</div><!--user-profile-content-->
									</div><!--step-1-->

									<div id="step-2" class="">
										<div class="user-profile-content">
											<div id="form-step-1" role="form" data-toggle="validator">
												<h3 class="h3titulo">Dirección</h3>

												<div class="form-group">
													<label class="col-sm-3 control-label">Municipio <strog class="theme_color">*</strog></label>
													<div class="col-sm-8">
														<select name="municipio" id="municipio" onchange="cen_muni()" class="form-control select2"   value="{{Input::old('municipio')}}"  required>
															<option selected>
																Seleccione una opción
															</option>
															@foreach($municipios as $municipio)
															<option value="{{$municipio->id}}">
																{{$municipio->municipio}}
															</option>
															@endforeach
														</select>
														<div class="help-block with-errors"></div>
														<div class="text-danger" id='error_municipio'>{{$errors->formulario->first('municipio')}}</div>
													</div>
												</div><!--/form-group-->

												<div class="form-group">
													<label class="col-sm-3 control-label">Localidad <strog class="theme_color">*</strog></label>
													<div class="col-sm-8">
														<select name="localidad" id="localidad" onchange="cen_loc()" class="form-control select2"   value="{{Input::old('localidad')}}"  required>
															<option selected>
																Seleccione una opción
															</option>
															@foreach($localidades as $localidad)
															<option value="{{$localidad->id}}">
																{{$localidad->nom_loc}}
															</option>
															@endforeach
														</select>
														<div class="help-block with-errors"></div>
														<div class="text-danger" id='error_localidad'>{{$errors->formulario->first('localidad')}}</div>
													</div>
												</div><!--/form-group-->

												<div class="form-group">
													<label class="col-sm-3 control-label">CALLE Y NUMERO: <strog class="theme_color">*</strog></label>
													<div class="col-sm-6">
														<input name="domicilio" id="domicilio" type="text"   class="form-control" required placeholder="Ingrese la Calle y Numero" maxlength="40" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()"  />
													</div>
												</div>


												<div class="form-group">
													<label class="col-sm-3 control-label">Teléfono: <strog class="theme_color"></strog></label>
													<div class="col-sm-6">
														<input name="telefono" id="telefono" type="number" maxlength="10"   class="form-control" placeholder="(492)-000-0000"	/>
													</div>
												</div>

												<div class="form-group">
													<label class="col-sm-3 control-label">Email: <strog class="theme_color"></strog></label>
													<div class="col-sm-6">
														<input name="email" id="email" type="email"   placeholder="Ingrese el Nombre de la Escuela" class="form-control" size="30"  />
													</div>
												</div>





											</div><!--validator-->
										</div><!--user-profile-content-->
									</div><!--step-2-->

									<div id="step-3" class="">
										<div class="user-profile-content">
											<div id="form-step-2" role="form" data-toggle="validator">
												<h3 class="h3titulo">Información</h3>

												<div class="form-group">
													<label class="col-sm-3 control-label">Total de Alumnos: <strog class="theme_color">*</strog></label>
													<div class="col-sm-6">
														<input name="alumnos" id="alumnos" type="number"   class="form-control" required placeholder="Ingrese el Total de Alumnos" maxlength="3" min="1" max ="999" />
													</div>
												</div>

												<div class="form-group">
													<label class="col-sm-3 control-label">Total de Niñas: <strog class="theme_color">*</strog></label>
													<div class="col-sm-6">
														<input name="ninas" id="ninas" type="number"   class="form-control" required placeholder="Ingrese el Total de Niñas" maxlength="3" min="1" max ="999" />
													</div>
												</div>

												<div class="form-group">
													<label class="col-sm-3 control-label">Total de Niños: <strog class="theme_color">*</strog></label>
													<div class="col-sm-6">
														<input name="ninos" id="ninos" type="number"   class="form-control"  required placeholder="Ingrese el Total de Niños" maxlength="3" min="1" max ="999" />
													</div>
												</div>

												<div class="form-group">
													<label class="col-sm-3 control-label">Total de Grupos: <strog class="theme_color">*</strog></label>
													<div class="col-sm-6">
														<input name="grupos" id="grupos" placeholder="Ingrese el Total de Grupos"  type="number"   class="form-control" required maxlength="3" min="1" max ="999" />
													</div>
												</div>

												<div class="form-group">
													<label class="col-sm-3 control-label">Total de Grados: <strog class="theme_color">*</strog></label>
													<div class="col-sm-6">
														<input name="grados" id="grados" type="number"   class="form-control" required placeholder="Ingrese el Total de Grados"  maxlength="3" min="1" max ="999" />
													</div>
												</div>

												<div class="form-group">
													<label class="col-sm-3 control-label">Total Director: <strog class="theme_color">*</strog></label>
													<div class="col-sm-6">
														<input name="director"  placeholder="Ingrese el Total de Director" id="director" type="number"   class="form-control" required  maxlength="3" min="1" max ="999" />
													</div>
												</div>

												<div class="form-group">
													<label class="col-sm-3 control-label">Total Docentes: <strog class="theme_color">*</strog></label>
													<div class="col-sm-6">
														<input name="docente" id="docente" type="number"   class="form-control" required placeholder="Ingrese el Total de Docentes"  maxlength="3" min="1" max ="999" />
													</div>
												</div>

												<div class="form-group">
													<label class="col-sm-3 control-label">Total Educación Fisica: <strog class="theme_color">*</strog></label>
													<div class="col-sm-6">
														<input name="e_fisica" id="e_fisica" type="number"   class="form-control" required placeholder="Ingrese el Total de Docentes de Educación Fisica"  maxlength="3" min="0" max ="999" />
													</div>
												</div>

												<div class="form-group">
													<label class="col-sm-3 control-label">Total USAER: <strog class="theme_color">*</strog></label>
													<div class="col-sm-6">
														<input name="usaer" id="usaer" type="number"   class="form-control" required  placeholder="Ingrese el Total de USAER" maxlength="3" min="0" max ="999" />
													</div>
												</div>

												<div class="form-group">
													<label class="col-sm-3 control-label">Total Educación Artistica: <strog class="theme_color">*</strog></label>
													<div class="col-sm-6">
														<input name="artistica" id="artistica" type="number"   class="form-control" required placeholder="Ingrese el Total de Docentes de Educación Artistica"  maxlength="3" min="0" max ="999" />
													</div>
												</div>

												<div class="form-group">
													<label class="col-sm-3 control-label">Total Intendentes: <strog class="theme_color">*</strog></label>
													<div class="col-sm-6">
														<input name="intendente" id="intendente"   type="number"   class="form-control" required placeholder="Ingrese el Total de Intendentes"  maxlength="3" min="0" max ="999" />
													</div>
												</div>

												<div class="form-group">
													<div class="col-sm-6">
													<input  id="organizacion"  name="organizacion" type="hidden"  class="form-control" />
													</div>
												</div>

												<div class="form-group">
													<div class="col-sm-offset-7 col-sm-5">
														<button onclick="return centros_verifica();"  id="submit2" class="btn btn-primary">Guardar</button>
														<a href="{{url('/centro_trabajo')}}" class="btn btn-default"> Cancelar</a>
													</div>
												</div><!--/form-group-->



											</div><!--validator-->
										</div><!--user-profile-content-->
									</div><!--step-3-->




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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script type="text/javascript">
window.onload=function(){
	cen_reg();
	cen_ciclo();
	cen_car();
	cen_ali();
	cen_niv();
	cen_muni();
	cen_loc();
}
function cen_reg() {
 if( document.getElementById('region').value == "Seleccione una opción"){

   document.getElementById('ciclo').disabled=true;
   document.getElementById('carta_compromiso').disabled=true;
   document.getElementById('alimentacion').disabled=true;
   document.getElementById('nivel').disabled=true;
   document.getElementById('municipio').disabled=true;
   document.getElementById('localidad').disabled=true;

        //  swal("ERROR!","Selecciona tipo se puesto","error");
        document.getElementById("error_region").innerHTML = "Seleccione una opción para desabilitar los campos.";
        return false
      }else{
       document.getElementById('ciclo').disabled=false;
       document.getElementById("error_region").innerHTML = "";
     }
   }

	 function cen_ciclo() {
	  if( document.getElementById('ciclo').value == "Seleccione una opción"){

	    document.getElementById('carta_compromiso').disabled=true;

	         //  swal("ERROR!","Selecciona tipo se puesto","error");
	         document.getElementById("error_ciclo").innerHTML = "Seleccione una opción.";
	         return false
	       }else{
	        document.getElementById('carta_compromiso').disabled=false;
	        document.getElementById("error_ciclo").innerHTML = "";
	      }
	  }

		function cen_car() {
 	  if( document.getElementById('carta_compromiso').value == "Seleccione una opción"){

 	    document.getElementById('alimentacion').disabled=true;

 	         //  swal("ERROR!","Selecciona tipo se puesto","error");
 	         document.getElementById("error_carta_compromiso").innerHTML = "Seleccione una opción.";
 	         return false
 	       }else{
 	        document.getElementById('alimentacion').disabled=false;
 	        document.getElementById("error_carta_compromiso").innerHTML = "";
 	      }
 	   }

		 function cen_ali() {
			 if( document.getElementById('alimentacion').value == "Seleccione una opción"){

				 document.getElementById('nivel').disabled=true;

							//  swal("ERROR!","Selecciona tipo se puesto","error");
							document.getElementById("error_alimentacion").innerHTML = "Seleccione una opción.";
							return false
						}else{
						 document.getElementById('nivel').disabled=false;
						 document.getElementById("error_alimentacion").innerHTML = "";
					 }
			}

			function cen_niv() {
				if( document.getElementById('nivel').value == "Seleccione una opción"){

					document.getElementById('municipio').disabled=true;

							 //  swal("ERROR!","Selecciona tipo se puesto","error");
							 document.getElementById("error_nivel").innerHTML = "Seleccione una opción.";
							 return false
						 }else{
							document.getElementById('municipio').disabled=false;
							document.getElementById("error_nivel").innerHTML = "";
						}
			 }

			 function cen_muni() {
				 if( document.getElementById('municipio').value == "Seleccione una opción"){

					 document.getElementById('localidad').disabled=true;

								//  swal("ERROR!","Selecciona tipo se puesto","error");
								document.getElementById("error_municipio").innerHTML = "Seleccione una opción.";
								return false
							}else{
							 document.getElementById('localidad').disabled=false;
							 document.getElementById("error_municipio").innerHTML = "";
						 }
				}

				function cen_loc() {
					if( document.getElementById('localidad').value == "Seleccione una opción"){

						document.getElementById('submit2').disabled=true;

								 //  swal("ERROR!","Selecciona tipo se puesto","error");
								 document.getElementById("error_localidad").innerHTML = "Seleccione una opción.";
								 return false
							 }else{
								document.getElementById('submit2').disabled=false;
								document.getElementById("error_localidad").innerHTML = "";
							}
				 }

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
          	elmForm.validator('validate');
          //	var x= document.getElementById('transportes').rows[1].cells[1].innerHTML;
          var x= "";
          if(x !== ""){
          		//document.getElementById("errortransp").innerHTML = "";
          	}else{
              //alert('No se ha Ingresado Ningun Transporte en la Tabla de Transporte');
            //  document.getElementById("errortransp").innerHTML = "No se ha Ingresado Ningun Transporte en la Tabla de Transporte";
             // swal("Error!", "No se ha Ingresado Ningun Transporte en la Tabla de Transporte!", "error");
              //document.getElementById("transporte_num").style.border="1px solid #f00";
            //  return false;
        }
            /*
            if (document.getElementById('precio').value == ""){
              swal("Error!", "No se ha Ingresado el Precio Total de la Compra!", "error");
              //alert('No se ha Ingresado el Precio Total de la Compra');
              document.getElementById("precio").style.border="1px solid #f00";
              return false;
          }*/
          if(stepNumber == 0){
          	var a = document.getElementById('cct').value;
          	var c = a.length;
          	var nivel = String(document.getElementById('nivel').value);


          	if(c < 10 || c > 10){
          		swal("Error!", "La CCT Debe ser Igual a 10 Digitos ", "error");
          		document.getElementById("cct").focus();
          		return false
          	}else{
          		subCadena = a.substring(4,2);
          		if(subCadena == "DP" || subCadena == "EP" ){
          			if(nivel == "PREESCOLAR"){
          				swal("Error!", "Un PREESCOLAR NO PUEDE SER '32DP' Ó '32EP' ", "error");
          				return false
          			}else if(nivel == "TELESECUNDARIA") {
          				swal("Error!", "Una TELESECUNDARIA NO PUEDE SER '32ET' ", "error");
          				return false
          			}

          		}else if(subCadena == "ET" ){
          			if(nivel == "PREESCOLAR"){
          				swal("Error!", "Un PREESCOLAR NO PUEDE SER '32ET'", "error");
          				return false
          			}else if(nivel == "PRIMARIA"){
          				swal("Error!", "Una PRIMARIA NO PUEDE SER '32ET'", "error");
          				return false
          			}
          		}
          		else if(subCadena == "EJ" || subCadena == "DJ" ){
          			if(nivel == "TELESECUNDARIA"){
          				swal("Error!", "Una TELESECUNDARIA NO PUEDE SER '32EJ' Ó '32DJ' ", "error");
          				return false
          			}else if(nivel == "PRIMARIA"){
          				swal("Error!", "Una PRIMARIA NO PUEDE SER '32EJ' Ó '32DJ' ", "error");
          				return false
          			}
          		}
          	}}
          	if (stepNumber == 3){
          		if (document.getElementById('asignado').value == ""){
          			document.getElementById("error_asig").innerHTML = "Ingrese el Espacio , donde se Enviara la Materia Prima";
               // swal("Error!", "Ingrese el Espacio , donde se Enviara la Materia Prima!", "error");
                //alert('Ingrese el Espacio , donde se Enviara la Materia Prima');
                //document.getElementById("asignado").style.border="1px solid #f00";
                return false;
            }else{
            	document.getElementById("error_asig").innerHTML = "";
            }

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
          if(stepNumber == 3){
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


</script>
@endsection
