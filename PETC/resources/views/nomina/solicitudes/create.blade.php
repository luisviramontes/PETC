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

<div class="pull-left breadcrumb_admin clear_both">
	<div class="pull-left page_title theme_color">
		<h1>Inicio</h1>
		<h2 class="">Solicitudes de Ingreso</h2>
	</div>
	<div class="pull-right">
		<ol class="breadcrumb">
			<li><a style="color: #808080" href="{{url('solicitudes')}}">Inicio</a></li>
			<li><a style="color: #808080" href="{{url('solicitudes')}}">Solicitudes</a></li>
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
							<h2 class="content-header" style="margin-top: -5px;"><strong>Agregar Solicitudes</strong></h2>
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
					<form action="{{route('solicitudes.store')}}" method="post" class="form-horizontal row-border" parsley-validate novalidate  files="true" enctype="multipart/form-data" accept-charset="UTF-8">
						{{csrf_field()}}

						<div id="smartwizard">
							<ul>
								<li><a href="#step-1">Datos Escuela</a></li>
								<li><a href="#step-2">Entregas</a></li>
							</ul>
							<div>
								<div id="step-1" class="">
									<div class="user-profile-content">

										<div id="form-step-0" role="form" data-toggle="validator">
											<h3 class="h3titulo">Datos Escuela</h3>

											<div class="form-group">
												<label class="col-sm-3 control-label">Nombre Escuela: <strog class="theme_color">*</strog></label>
												<div class="col-sm-6">
													<input name="nombre_escuela" id="nombre_escuela" type="text" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()"   class="form-control valid" required value="{{Input::old('nombre_escuela')}}" />
													<div class="help-block with-errors"></div>
												</div>
											</div>

											<div class="form-group">
												<label class="col-sm-3 control-label">Nivel: <strog class="theme_color">*</strog></label>
												<div class="col-sm-6">
													<select name="nivel" id="nivel" onchange="soli_nivel();" class="form-control" required>
														<option selected>
																	Selecciona una opción
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
												<label class="col-sm-3 control-label">CCT: <strog class="theme_color">*</strog></label>
												<div class="col-sm-6">
													<select name="cct" id="cct" class="form-control select2" onchange="soli_cct()" value="{{Input::old('cct')}}"  required>
														<option selected>
															Selecciona una opción
														</option>
														@foreach($cct as $cct)
														<option value="{{$cct->id}}">
															{{$cct->cct}}
														</option>
														@endforeach
													</select>
													<div class="help-block with-errors"></div>
												</div>
											</div> <!--/form-group-->

											<div class="form-group">
												<label class="col-sm-3 control-label">Ciclo Escolar: <strog class="theme_color">*</strog></label>
												<div class="col-sm-6">
													<select name="ciclo" id="ciclo" class="form-control select2" onchange="soli_ciclo()" value="{{Input::old('ciclo')}}"  required>
														<option selected>
														Selecciona una opción
														</option>
														@foreach($ciclo as $ciclo)
														<option value="{{$ciclo->id}}">
															{{$ciclo->ciclo}}
														</option>
														@endforeach
													</select>
													<div class="help-block with-errors"></div>
												</div>
											</div> <!--/form-group-->

											<div class="form-group">
												<label class="col-sm-3 control-label">Municipio: <strog class="theme_color">*</strog></label>
												<div class="col-sm-6">
													<select name="municipio" id="municipio" class="form-control select2" onchange="soli_mun()" value="{{Input::old('municipio')}}"  required>
														<option selected>
																	Selecciona una opción
														</option>
														@foreach($municipios as $municipio)
														<option value="{{$municipio->id}}">
															{{$municipio->municipio}}
														</option>
														@endforeach
													</select>
													<div class="help-block with-errors"></div>
												</div>
											</div> <!--/form-group-->

												<div class="form-group">
													<label class="col-sm-3 control-label">Localidad <strog class="theme_color">*</strog></label>
													<div class="col-sm-6">
														<select name="localidad" id="localidad" class="form-control select2" onchange="soli_loc()" value="{{Input::old('localidad')}}"  required>
															<option selected>
																		Selecciona una opción
															</option>
															@foreach($localidades as $localidad )
															<option value="{{$localidad->id}}">
																{{$localidad->nom_loc}}
															</option>
															@endforeach
														</select>
														<div class="help-block with-errors"></div>
													</div>
												</div> <!--/form-group-->

												<div class="form-group">
													<label class="col-sm-3 control-label">Domicilio: <strog class="theme_color">*</strog></label>
													<div class="col-sm-6">
														<input name="domicilio" id="domicilio" type="text" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()"   class="form-control valid" required value="{{Input::old('domicilio')}}" />
														<div class="help-block with-errors"></div>
													</div>
												</div>

										</div><!--validator-->
									</div><!--user-profile-content-->
								</div><!--step-1-->

								<div id="step-2" class="">
									<div class="user-profile-content">
										<div id="form-step-1" role="form" data-toggle="validator">
											<h3 class="h3titulo">Entregas</h3>

						<div class="form-group">
							<label class="col-sm-3 control-label">Entrego Acta <strog class="theme_color">*</strog></label>
							<div class="col-sm-6">
								<select name="entrego_acta" id="acta" onchange="soli_acta()" class="form-control" required>
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
							</div>
						</div><!--/form-group-->



						<div class="form-group">
							<label class="col-sm-3 control-label">Solicitud Incorporacion <strog class="theme_color">*</strog></label>
							<div class="col-sm-6">
								<select name="solicitud_inco" id="inco" onchange="soli_inco()" class="form-control" required>
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
							</div>
						</div><!--/form-group-->

							</div>

							<div class="form-group">
								<label class="col-sm-3 control-label">PNPSVD <strog class="theme_color">*</strog></label>
								<div class="col-sm-6">
									<select name="pnpsvd" id="psv" class="form-control" onchange="soli_psv()" value="{{Input::old('pnpsvd')}}" required>
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
								</div>
							</div><!--/form-group-->

							<div class="form-group">
								<label class="col-sm-3 control-label">CNH <strog class="theme_color">*</strog></label>
								<div class="col-sm-6">
									<select name="cnh" id="cnh" onchange="soli_cnh()" class="form-control" value="{{Input::old('cnh')}}" required>
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
								</div>
							</div><!--/form-group-->

							<div class="form-group">
								<label class="col-sm-3 control-label">Carta Compromiso <strog class="theme_color">*</strog></label>
								<div class="col-sm-6">
									<select name="carta_compromiso" id="carta" onchange="soli_carta()" class="form-control" value="{{Input::old('carta_compromiso')}}" required>
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
								</div>
							</div><!--/form-group-->

							<div class="form-group">
								<label class="col-sm-3 control-label">Acta Constitutiva <strog class="theme_color">*</strog></label>
								<div class="col-sm-6">
									<select name="acta_constitutiva_cte" id="acta_cons" onchange="soli_acta_cons()" class="form-control" value="{{Input::old('acta_constitutiva_cte')}}" required>
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
								</div>
							</div><!--/form-group-->

							<div class="form-group">
								<label class="col-sm-3 control-label">Acta CPS <strog class="theme_color">*</strog></label>
								<div class="col-sm-6">
									<select name="acta_cps" id="cps" onchange="soli_cps()" class="form-control" value="{{Input::old('acta_cps')}}" required>
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
								</div>
							</div><!--/form-group-->

							<div class="form-group">
								<label class="col-sm-3 control-label">Acta CTCS <strog class="theme_color">*</strog></label>
								<div class="col-sm-6">
									<select name="acta_ctcs" id="ctcs" onchange="soli_ctcs()" class="form-control" value="{{Input::old('acta_ctcs')}}" required>
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
								</div>
							</div><!--/form-group-->

							<div class="form-group">
								<label class="col-sm-3 control-label">Tramite Estado <strog class="theme_color">*</strog></label>
								<div class="col-sm-6">
									<select name="tramite_estado" id="tramite" onchange="soli_tramite()" class="form-control" value="{{Input::old('tramite_estado')}}" required>
										<option selected>
													Seleccione una opción
										</option>
										<option value="En Tramite">
											En Tramite
										</option>
										<option value="Resuelto">
											Resuelto
										</option>


									</select>
									<div class="help-block with-errors"></div>
								</div>
							</div><!--/form-group-->



							<div class="form-group">
								<label class="col-sm-3 control-label">Fecha de Recepción: <strog class="theme_color">*</strog></label>
								<div class="col-sm-6">
									<input name="fecha_recepcion"  type="date"    class="form-control valid" required value="{{Input::old('fecha_recepcion')}}" />
									<div class="help-block with-errors"></div>
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
								<a href="{{url('/solicitudes')}}" class="btn btn-default"> Cancelar</a>
							</div>
						</div><!--/form-group-->

												</div><!--validator-->
											</div><!--user-profile-content-->
										</div><!--step-2-->
									</div>
								</div>


					</form>
				</div><!--/porlets-content-->
			</div><!--/block-web-->
		</div><!--/col-md-12-->
	</div><!--/row-->
</div><!--/container clear_both padding_fix-->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

<script type="text/javascript">
window.onload=function(){
	soli_nivel();

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
