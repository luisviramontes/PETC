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
		<h1>Editar  Empleado</h1>
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
						<form action="{{url('/directorio_interno', [$personal->id])}}" method="post" class="form-horizontal row-border" parsley-validate novalidate files="true" enctype="multipart/form-data" accept-charset="UTF-8">
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
													<label class="col-sm-3 control-label">Licenciatura: <strog class="theme_color">*</strog></label>
													<div class="col-sm-6">
														<input name="licenciatura" id="licenciatura" type="text" onchange="cambia_nombre();" onkeypress="return soloLetras(event)"  class="form-control" required value="{{$personal->licenciatura}}"   onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()" />
													</div>
												</div>

												<div class="form-group">
													<label class="col-sm-3 control-label">LIC ABREV: <strog class="theme_color">*</strog></label>
													<div class="col-sm-6">
														<input name="lic" id="lic" maxlength="3" minlength="3" type="text" onchange="cambia_nombre();" onkeypress="return soloLetras(event)"  class="form-control" required value="{{$personal->lic}}"  onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()" />
													</div>
												</div>

												<div class="form-group">
													<label class="col-sm-3 control-label">Nombre: <strog class="theme_color">*</strog></label>
													<div class="col-sm-6">
														<input name="nombre" id="nombre" type="text" onchange="cambia_nombre();" onkeypress="return soloLetras(event)"  class="form-control" required value="{{$personal->nombre}}"     onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()" />
													</div>
												</div>

												<div class="form-group">
													<label class="col-sm-3 control-label">A_N: <strog class="theme_color">*</strog></label>
													<div class="col-sm-6">
														<input name="a_n" id="a_n" type="text" class="form-control" required value="{{$personal->abrebiatura}}"    onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()" />
													</div>
												</div>

												<input name="rfcOculto" id="oculto"  hidden  />
												<div class="form-group">
													<label class="col-sm-3 control-label">RFC: <strog class="theme_color">*</strog></label>
													<div class="col-sm-6">
														<input name="rfc_input" id="rfc_input" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()" type="text"   class="form-control" required value="{{$personal->rfc}}"     oninput="validarInput(this);"  onchange="validarRFC();"  />
														<div class="text-danger" id='error_rfc' name="error_rfc" ></div>
													</div>
													<pre id="resultado"></pre>						
												</div>							


												<div class="form-group">
													<label class="col-sm-3 control-label">CURP: <strog class="theme_color">*</strog></label>
													<div class="col-sm-6">
														<input name="curp" id="curp" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()" type="text"   class="form-control" required value="{{$personal->curp}}"     />
														
													</div>
													<pre id="resultado"></pre>						
												</div>

												<div class="form-group">
													<label class="col-sm-3 control-label">Fecha de Nacimiento: <strog class="theme_color">*</strog></label>
													<div class="col-sm-6">

														<input type="date" name="fecha_nacimiento" id="fecha_nacimiento" value="{{$personal->fecha_nacimiento}}"  class="form-control mask" required>
													</div>
												</div>

												<div class="form-group">
													<label class="col-sm-3 control-label">Teléfono: <strog class="theme_color"></strog></label>
													<div class="col-sm-6">
														<input name="telefono" id="telefono" type="text"   onkeypress="soloNumeros(event)" class="form-control"  value="{{$personal->telefono}}"  />
													</div>
												</div>

												<div class="form-group">
													<label class="col-sm-3 control-label">Email: <strog class="theme_color"></strog></label>
													<div class="col-sm-6">
														<input name="email" id="email" type="text"   class="form-control"  value="{{$personal->email}}"  />
													</div>
												</div>



												<div class="form-group">
													<label class="col-sm-3 control-label">Domicilio: <strog class="theme_color">*</strog></label>
													<div class="col-sm-6">
														<input name="domicilio" id="domicilio" type="text" onch onkeypress="return soloLetras(event)"  class="form-control" required value="{{$personal->domicilio}}"    onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()" />
													</div>
												</div>

												<div class="form-group">
													<label class="col-sm-3 control-label">N° Seguro: <strog class="theme_color"></strog></label>
													<div class="col-sm-6">
														<input name="seguro" id="seguro" type="text"   onkeypress="soloNumeros(event)" class="form-control"  value="{{$personal->seguro}}"  />
													</div>
												</div>

												<div class="form-group">
													<label class="col-sm-3 control-label">Imagen: <strog class="theme_color"></strog></label>
													<div class="col-sm-6">
														<input name="imagen" id="imagen" value="{{$personal->imagen}}"  type="file"  accept=".jpg, .jpeg, .png" />
														@if (($personal->imagen)!="")
														<img src="{{asset('img/personal_etc/'.$personal->imagen)}}" alt="{{$personal->nombre}}" height="100px" width="100px" class="img-thumbnail">
														@endif
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
													<label class="col-sm-3 control-label">Área en la que se Incorpora;<strog class="theme_color">*</strog></label>
													<div class="col-sm-6">
														<select name="area" id="area" class="form-control select" required> 
														@if($personal->area == "ALIMENTACION")
															<option value="ALIMENTACION" selected>ALIMENTACION</option>
															<option value="NOMINA Y SISTEMAS">NOMINA Y SISTEMAS</option>
															<option value="ACADEMICA">ACADEMICA</option>
															<option value="RECEPCION">RECEPCION</option>	
															<option value="FINANCIERA">FINANCIERA</option>	
															<option value="MATERIALES">MATERIALES</option>	
															@elseif($personal->area == "NOMINA Y SISTEMAS")	
															<option value="ALIMENTACION" >ALIMENTACION</option>
															<option value="NOMINA Y SISTEMAS" selected>NOMINA Y SISTEMAS</option>
															<option value="ACADEMICA">ACADEMICA</option>
															<option value="RECEPCION">RECEPCION</option>	
															<option value="FINANCIERA">FINANCIERA</option>	
															<option value="MATERIALES">MATERIALES</option>	
															@elseif($personal->area == "ACADEMICA")	
															<option value="ALIMENTACION" >ALIMENTACION</option>
															<option value="NOMINA Y SISTEMAS">NOMINA Y SISTEMAS</option>
															<option value="ACADEMICA" selected>ACADEMICA</option>
															<option value="RECEPCION">RECEPCION</option>	
															<option value="FINANCIERA">FINANCIERA</option>	
															<option value="MATERIALES">MATERIALES</option>	@elseif($personal->area == "RECEPCION")	
															<option value="ALIMENTACION" >ALIMENTACION</option>
															<option value="NOMINA Y SISTEMAS">NOMINA Y SISTEMAS</option>
															<option value="ACADEMICA">ACADEMICA</option>
															<option value="RECEPCION" selected>RECEPCION</option>	
															<option value="FINANCIERA">FINANCIERA</option>	
															<option value="MATERIALES">MATERIALES</option>	@elseif($personal->area == "FINANCIERA")	
															<option value="ALIMENTACION" >ALIMENTACION</option>
															<option value="NOMINA Y SISTEMAS">NOMINA Y SISTEMAS</option>
															<option value="ACADEMICA">ACADEMICA</option>
															<option value="RECEPCION">RECEPCION</option>	
															<option value="FINANCIERA" selected>FINANCIERA</option>	
															<option value="MATERIALES">MATERIALES</option>
															@else
															<option value="ALIMENTACION" >ALIMENTACION</option>
															<option value="NOMINA Y SISTEMAS">NOMINA Y SISTEMAS</option>
															<option value="ACADEMICA">ACADEMICA</option>
															<option value="RECEPCION">RECEPCION</option>	
															<option value="FINANCIERA">FINANCIERA</option>	
															<option value="MATERIALES" selected>MATERIALES</option>

															@endif	
														</select>
													</div> 
												</div>

												<div class="form-group">
													<label class="col-sm-3 control-label">Puesto: <strog class="theme_color">*</strog></label>
													<div class="col-sm-6">
														<input name="puesto" id="puesto" type="text" onkeypress="return soloLetras(event)"  class="form-control" required value="{{$personal->puesto}}"   onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()" />
													</div>
												</div>

												<div class="form-group">
													<label class="col-sm-3 control-label">Tipo;<strog class="theme_color">*</strog></label>
													<div class="col-sm-6">
														<select name="tipo" id="tipo" class="form-control select" required> 
															@if($personal->tipo == "ASESORES-E")
															<option value="ASESORES-E" selected>ASESORES-E</option>
															<option value="SEDUZAC">SEDUZAC</option>
															@else
															<option value="ASESORES-E" >ASESORES-E</option>
															<option value="SEDUZAC" selected>SEDUZAC</option>
															@endif															
														</select>
													</div> 
												</div>

												<div class="form-group">
													<label class="col-sm-3 control-label">Fecha de Ingreso: <strog class="theme_color">*</strog></label>
													<div class="col-sm-6">

														<input type="date" name="fecha_ingreso" id="fecha_ingreso" value="{{$personal->fecha_ingreso}}"  class="form-control mask" required>
													</div>
												</div>
												<div class="form-group">
													<label class="col-sm-3 control-label">Sueldo Mensual: <strog class="theme_color"></strog></label>
													<div class="col-sm-6">
														<input name="sueldo_mensual" id="sueldo_mensual" type="text"   onkeypress="soloNumeros(event)" class="form-control" value="{{$personal->sueldo_mensual}}"  />
													</div>
												</div>

												<div class="form-group">
													<label class="col-sm-3 control-label">Deducciones: <strog class="theme_color"></strog></label>
													<div class="col-sm-6">
														<input name="deducciones" id="deducciones" type="text"   onkeypress="soloNumeros(event)" class="form-control"  value="{{$personal->deducciones}}" />
													</div>
												</div>

												<div class="form-group">
													<label class="col-sm-3 control-label">Neto: <strog class="theme_color"></strog></label>
													<div class="col-sm-6">
														<input name="neto" id="neto" type="text"   onkeypress="soloNumeros(event)" class="form-control"  value="{{$personal->neto}}" />
													</div>
												</div>


												
												






												
												
												<div class="form-group">
													<div class="col-sm-offset-7 col-sm-5">
														<button id="submit3"  onclick="return save();" class="btn btn-primary">Guardar</button>
														<a href="{{url('/captura')}}" class="btn btn-default"> Cancelar</a>
													</div>
												</div><!--/form-group--> 


												
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

	function cambia_nombre(){
		var nombre = document.getElementById('nombre').value;
		var a_n = "" ;

		limite = "4",
		separador = " ",
		arregloDeSubCadenas = nombre.split(separador, limite);
		for (var i =0; i < arregloDeSubCadenas.length; i++) {
			var aux=arregloDeSubCadenas[i].substr(0,1);
			a_n=a_n+aux;
		}
		document.getElementById('a_n').value=a_n;

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






</script>
@endsection
