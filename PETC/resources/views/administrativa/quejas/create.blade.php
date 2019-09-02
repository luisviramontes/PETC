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
		<h1>Quejas y Denuncias</h1>
		<h2 class="active"></h2>
	</div>
	<div class="pull-right">
		<ol class="breadcrumb">
			<li><a href="?c=Inicio">Inicio</a></li>
			<li><a href="?c=">Quejas y Denuncias</a></li>
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
						<form class="" id="myForm" action="{{route('quejas.store')}}" method="post" role="form" enctype="multipart/form-data" parsley-validate novalidate data-toggle="validator">
							{{csrf_field()}}
							<div id="smartwizard">
								<ul>
									<li><a href="#step-1">Quejas y Denuncias</a></li>
									<li><a href="#step-2">Información de la Queja ó Denuncias</a></li>
								</ul>
								<div>
									<div id="step-1" class="">
										<div class="user-profile-content">

											<div id="form-step-0" role="form" data-toggle="validator">
												<h3 class="h3titulo">Quejas y Denuncias</h3>

												<div id="inicio">
													<div align="center">

														<p class="textogral" align="justify"><font color="#666666" size="2">Las quejas y denuncias pueden ser hechas por cualquier ciudadano mayor de edad debido a una inconformidad sobre una conducta o procedimiento de un servidor público de manera injustificada.<br>
															<br>
															Es un deber ciudadano reportar una irregularidad denunciando los hechos de manera responsable y presentando pruebas comprobables, dicha denuncia puede ser en contra de cualquier servidor público entendiéndose por éste cualquier  funcionario y empleado del Estado y los municipios que desempeñen un cargo o comisión en la Administración Pública, Estatal o Municipal. <br>
															<br>
															La función del ciudadano que reporta no es ser parte del proceso de seguimiento de la denuncia, únicamente es de aportar los elementos necesarios para la investigación de irregularidades cometidas por los servidores públicos.<br>
															<br>
															Las quejas y denuncias recibidas a través de éste medio serán recibidas y atendidas por la Contraloría Interna de la Secretaría de Educación y Cultura y se limitarán a asuntos de tipo laboral, quedando excluídos los asuntos particulares o de orden privado, tampoco tienen competencia asuntos que involucren a Servidores Públicos de otras dependencias ajenas a la Secretaría de Educación y Cultura del Estado de Zacatecas.</font></p>
														</div></div><br>

														<h3 class="h3titulo">&iquest;Cu&aacute;ndo es queja y cu&aacute;ndo denuncia?</h3>
														<div id="inicio">
															<div align="center">
																<p class="textogral" align="justify"><font color="#666666" size="2">Una <strong>queja</strong> se puede realizar cuando un servidor p&uacute;blico causa una molestia personal directa por motivo de sus funciones de manera injustificada.<br>
																	<br>
																	Una <strong>denuncia</strong> es exponer hechos de alguna irregularidad en la administraci&oacute;n p&uacute;blica estatal a&uacute;n y cuando no se cause molestia directa.</font><br>
																</p>
															</div>
														</div><br>

														<table width="527">
															<tr>
																<td height="20" background="imagenes/rollover.gif" class="textobarra">Cu&aacute;ndo denunciar</td>
															</tr>
														</table>
														<div id="inicio">
															<p class="textogral"><font color="#666666" size="2"><u>Al ser objeto de:</u></font> <br>
																<br>
															</p>
															<table width="300" border="0" align="center" cellpadding="0" cellspacing="0">
																<tr>
																	<td><div align="left"><font color="#666666" size="2" >* Abuso de autoridad</font></div></td>
																</tr>
																<tr>
																	<td><div align="left"><font color="#666666" size="2" >* Mal trato</font></div></td>
																</tr>
																<tr>
																	<td><div align="left"><font color="#666666" size="2" >* Mala prestaci&oacute;n del servicio</font></div></td>
																</tr>
																<tr>
																	<td><div align="left"><font color="#666666" size="2" >* Condicionamiento del mismo</font></div></td>
																</tr>
																<tr>
																	<td><div align="left"><font color="#666666" size="2" >* Lentitud injustificada en los tr&aacute;mites</font></div></td>
																</tr>
																<tr>
																	<td><div align="left"><font color="#666666" size="2" >* Mal empleo de recursos p&uacute;blicos</font></div></td>
																</tr>
																<tr>
																	<td><div align="left"><font color="#666666" size="2" >* Negativa injustificada de un servicio p&uacute;blico</font></div></td>
																</tr>
																<tr>
																	<td><div align="left"><font color="#666666" size="2" >* Corrupci&oacute;n</font></div></td>
																</tr>
																<tr>
																	<td><div align="left"><font color="#666666" size="2" > * Negligencia</font></div></td>
																</tr>
																<tr>
																	<td><div align="left"><font color="#666666" size="2" > * Obstrucci&oacute;n de la justicia</font></div></td>
																</tr>
															</table>
															<p class="textogral"><font color="#666666" size="2" >        <br>
																O cualquier acto irregular o violaci&oacute;n al Art. 5 de la de Responsabilidades de los Servidores P&uacute;blicos del Estado </font></p></div><br>
																<table width="527">
																	
																</table>
																<br>
																<div id="inicio"> <p class="textogral"><font color="#666666" size="2"><u>Entiendo que:</u></font><br>


																	<table width="520" border="1" align="center" cellpadding="0" cellspacing="0">
																		<tr>
																			<td><div align="left"><font color="#666666" size="2" >El denunciar a un servidor público puede traer como consecuencia sanciones administrativas en su contra.</font></div></td>
																		</tr>
																		<tr>
																			<td><div align="left"><font color="#666666" size="2" >No me está permitido ser parte del procedimiento de responsabilidad administrativa.</font></div></td>
																		</tr>
																		<tr>
																			<td><div align="left"><font color="#666666" size="2" >El procedimiento administrativo derivado de mi queja y/o denuncia presentada no me garantiza una compensación del Estado.</font></div></td>
																		</tr>
																		<tr>
																			<td><div align="left"><font color="#666666" size="2" >La presente queja y/o denuncia es únicamente para notificar actividades de los servidores públicos que constituyan una probable violación a las leyes y reglamentos administrativos del Estado de Zacatecas.</font></div></td>
																		</tr>
																		<tr>
																			<td><div align="left"><font color="#666666" size="2" >He leído y comprendido los artículos 5, 6, 27, 28, 29 y 30 de la <a href="documentos/lrsp.pdf" target="_blank" class="ligasruta1"><font size="2">Ley de Responsabilidades de los Servidores P&uacute;blicos del Estado.</font></a></font></div></td>
																		</tr>
																		<tr>
																			<td><div align="left"><font color="#666666" size="2" >Debo proporcionar mis datos personales sin falsificar informaci&oacute;n. </font></div></td>
																		</tr>
																	</table>
																</p>
															</div>
															<div align="center">
																<input type="checkbox" id="checa" name="checa" >
																<font color="#666666" size="2" >Declaro haber le&iacute;do y comprendido lo anterior.<br>

																</font>
															</div>

															<br>



														</div><!--validator-->
													</div><!--user-profile-content-->
												</div><!--step-1-->

												<div id="step-2" class="">
													<div class="user-profile-content">
														<div id="form-step-1" role="form" data-toggle="validator">
															<h3 class="h3titulo">Datos de Identificación del Denunciante</h3>


															<div class="form-group">
																<label class="col-sm-3 control-label">Nombre: <strog class="theme_color"></strog></label>
																<div class="col-sm-6">
																	<input name="nombre" id="nombre" type="text" onkeypress="return soloLetras(event)"  class="form-control"  value="{{Input::old('nombre')}}"   onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()" />
																</div>
															</div>

															<div class="form-group">
																<label class="col-sm-3 control-label">Teléfono: <strog class="theme_color"></strog></label>
																<div class="col-sm-6">
																	<input name="telefono" id="telefono" type="text"   onkeypress="soloNumeros(event)" class="form-control"  value="{{Input::old('telefono')}}" />
																</div>
															</div>

															<div class="form-group">
																<label class="col-sm-3 control-label">Ocupación: <strog class="theme_color"></strog></label>
																<div class="col-sm-6">
																	<input name="ocupacion" id="ocupacion" type="text" onkeypress="return soloLetras(event)"  class="form-control"  value="{{Input::old('ocupacion')}}"   onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()" />
																</div>
															</div>
															<br>
															<h3 class="h3titulo">Servidor Publico Contra Quien se Presenta la Queja ó Denuncia</h3>
															<div class="form-group">
																<label class="col-sm-3 control-label">Nombre: <strog class="theme_color"></strog></label>
																<div class="col-sm-6">
																	<input name="nombres" id="nombres" type="text" onkeypress="return soloLetras(event)"  class="form-control"  value="{{Input::old('nombres')}}"   onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()" />
																</div>
															</div>

															<div class="form-group">
																<label class="col-sm-3 control-label">Puesto: <strog class="theme_color"></strog></label>
																<div class="col-sm-6">
																	<input name="puesto" id="puesto" type="text" onkeypress="return soloLetras(event)"  class="form-control"  value="{{Input::old('puesto')}}"   onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()" />
																</div>
															</div>

															<div class="form-group">
																<label class="col-sm-3 control-label">CCT <strog class="theme_color">*</strog></label>
																<div class="col-sm-8">
																	<select name="cct" id="cct" class="form-control select2"   value="{{Input::old('cct')}}" required>
																		<option selected>
																			Selecciona una opción
																		</option>
																		@foreach($cct as $ct)
																		<option value="{{$ct->id}}">
																		{{$ct->cct}}-{{$ct->nombre_escuela}}
																		</option>
																		@endforeach
																	</select>																
																</div>
															</div><!--/form-group-->

																<div class="form-group">
													<label class="col-sm-3 control-label">Fecha del Inicidente: <strog class="theme_color">*</strog></label>
													<div class="col-sm-6">

														<input type="date" name="fecha" id="fecha" class="form-control mask"  onchange="verifica_fecha()" required>
													</div>
												</div>


<table width="520" border="1" align="center" cellpadding="0" cellspacing="0">
                  <tr bgcolor="#00FFCC">
                    <td colspan="2"><div align="center">MOTIVO DE LA QUEJA &Oacute; DENUNCIA</div></td>
                  </tr>
                  <tr>
                    <td width="184"><div align="left">
                      <label>
                        <input type="radio" name="motivo" value="Abuso de autoridad">
            Abuso de autoridad</label>
                    </div></td>
                    <td width="217"><div align="left">
                <input name="motivo" type="radio" class="forma" value="Incumplimiento laboral">
            Incumplimiento laboral</div></td>
                  </tr>
                  <tr>
                    <td><div align="left">
                      <label>
                        <input type="radio" name="motivo" value="Mal servicio">
            Mal servicio</label>
                    </div></td>
                    <td><div align="left">
                <input type="radio" name="motivo" value="Maltrato">
            Maltrato</div></td>
                  </tr>
                  <tr>
                    <td><div align="left">
                <input type="radio" name="motivo" value="Soborno">
            Soborno</div></td>
                    <td><div align="left">
                <input type="radio" name="motivo" value="Acoso">
            Acoso </div></td>
                  </tr>
                  <tr>
                    <td><div align="left">
      <input type="radio" name="motivo" value="7">
      Desv&iacute;o de recursos</div></td>
                    <td><div align="left">
                <input type="radio" name="motivo" value="8">
            Otros
              <input name="otros" type="text" class="forma" id="otros" value="";>
                    </div></td>
                  </tr>
                </table>

	<h3 class="h3titulo">Descripción de los Hechos</h3>
<table width="520" border="1" align="center" cellpadding="0" cellspacing="0">
                <tr>
                	
                    <td><textarea onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()"  name="descripcion" cols="70" rows="10" class="forma" id="textarea"></textarea></td>
              
                  </tr>
                  </table>


<br>
<div class="form-group">
													<label class="col-sm-3 control-label">Anexar Imagen: <strog class="theme_color"></strog></label>
													<div class="col-sm-6">
														<input name="archivo" id="archivo" type="file"  accept=".jpg, .jpeg, .png" />
													</div>
												</div>

	<div class="form-group">
													<div class="col-sm-offset-7 col-sm-5">
														<button id="submit"  class="btn btn-primary">Guardar</button>
														<a href="{{url('/quejas')}}" class="btn btn-default"> Cancelar</a>
													</div>
												</div><!--/form-group-->





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
          		var r = document.getElementById("checa").checked;
          		if(r==false){
          			return false;
          		}

          	}else if (stepNumber == 1){
          		var z = document.getElementById('error_movimiento').value;
          		var c = document.getElementById('error_fecha').value;
          		var x = document.getElementById('error_clave').value;

          		if (z == 1 || c == 1 || x == 1){
          			return false;
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
