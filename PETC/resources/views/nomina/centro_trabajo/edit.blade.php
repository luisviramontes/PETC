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
		<h1>Editar Centro de Trabajo: {{$centros->nombre_escuela}}  {{$centros->cct}}</h1>
		<h2 class="active"></h2>
	</div>
	<div class="pull-right">
		<ol class="breadcrumb">
			<li><a href="?c=Inicio">Inicio</a></li>
			<li><a href="?c=">Centro de Trabajo</a></li>
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


				<form action="{{url('centro_trabajo', [$centros->id])}}" method="post" class="form-horizontal row-border" parsley-validate novalidate files="true" enctype="multipart/form-data" accept-charset="UTF-8">
					{{csrf_field()}}
					<input type="hidden" name="_method" value="PUT">
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
												<input name="cct" id="cct" type="text" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()"  class="form-control" required placeholder="Ingrese La Clave de Centro de Trabajo" maxlength="10" value="{{$centros->cct}}" /> 
											</div>
											<div class="text-danger" id='error_cct'>{{$errors->formulario->first('cct')}}</div>													
										</div>

										<div class="form-group">
											<label class="col-sm-3 control-label">Nombre de la Escuela: <strog class="theme_color">*</strog></label>
											<div class="col-sm-6">
												<input name="nombre" id="nombre" type="text"   class="form-control" required placeholder="Ingrese el Nombre de la Escuela" maxlength="40" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()" value="{{$centros->nombre_escuela}}"  />
												<div class="text-danger" id='error_nombre'>{{$errors->formulario->first('nombre')}}</div>
											</div>

										</div>

										<div class="form-group">
											<label class="col-sm-3 control-label">Región <strog class="theme_color">*</strog></label>
											<div class="col-sm-6">
												<select name="region" class="form-control"  required>
													@foreach($region as $region)
													@if($centros->id_region == $region->id )
													<option value="{{$region->id}}" selected>
														{{$region->region}} {{$region->sostenimiento}}
													</option>
													@else
													<option value="{{$region->id}}">
														{{$region->region}} {{$region->sostenimiento}}
													</option>

													@endif
													@endforeach
												</select>

												<div class="help-block with-errors"></div>
											</div>
										</div><!--/form-group-->


										<div class="form-group">
											<label class="col-sm-3 control-label">Ciclo Escolar <strog class="theme_color">*</strog></label>
											<div class="col-sm-6">
												<select name="ciclo" class="form-control"  value="{{Input::old('ciclo')}}"  required>
													@foreach($ciclos as $ciclo)
													@if($centros->ciclo_escolar == $ciclo->ciclo)
													<option value="{{$ciclo->ciclo}}" selected>
														{{$ciclo->ciclo}}
													</option>
													@else
													<option value="{{$ciclo->ciclo}}">
														{{$ciclo->ciclo}}
													</option>
													@endif
													@endforeach
												</select>
												<div class="help-block with-errors"></div>
												<div class="text-danger" id='error_ciclo'>{{$errors->formulario->first('ciclo')}}</div>
											</div>
										</div><!--/form-group-->


										<div class="form-group">
											<label class="col-sm-3 control-label">Entrego Carta Compromiso: <strog class="theme_color">*</strog></label>
											<div class="col-sm-6">
												<select name="carta_compromiso" class="form-control" required>  
													@if($centros->entrego_carta == "SI")
													<option value="SI" selected>
														SI                
													</option>
													<option value="NO">
														NO                 
													</option> 
													@else
													<option value="SI" >
														SI                
													</option>
													<option value="NO" selected>
														NO                 
													</option> 
													@endif                        
												</select>
												<div class="help-block with-errors"></div>
											</div>
										</div><!--/form-group-->

										<div class="form-group">
											<label class="col-sm-3 control-label">Alimentación: <strog class="theme_color">*</strog></label>
											<div class="col-sm-6">
												<select name="alimentacion" class="form-control" required>  
													@if($centros->alimentacion == "SI")
													<option value="SI" selected>
														SI                
													</option>
													<option value="NO">
														NO                 
													</option> 
													@else
													<option value="SI" >
														SI                
													</option>
													<option value="NO" selected>
														NO                 
													</option> 

													@endif                              
												</select>
												<div class="help-block with-errors"></div>
											</div>
										</div><!--/form-group-->

										<div class="form-group">
											<label class="col-sm-3 control-label">Fecha de Ingreso al PETC: <strog class="theme_color">*</strog></label>
											<div class="col-sm-6">
												<input name="ingreso" id="ingreso" value="{{$centros->fecha_ingreso}}" type="date"  required  />
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
												<select name="municipio" class="form-control select2"   value="{{Input::old('municipio')}}"  required>
													@foreach($municipios as $municipio)
													@if($centros->id_municipios == $municipio->id)
													<option value="{{$municipio->id}}" selected>
														{{$municipio->municipio}}
													</option>
													@else
													<option value="{{$municipio->id}}">
														{{$municipio->municipio}}
													</option>
													@endif
													@endforeach
												</select>
												<div class="help-block with-errors"></div>
												<div class="text-danger" id='error_ciclo'>{{$errors->formulario->first('municipio')}}</div>
											</div>
										</div><!--/form-group-->

										<div class="form-group">
											<label class="col-sm-3 control-label">Localidad <strog class="theme_color">*</strog></label>
											<div class="col-sm-8">
												<select name="localidad" class="form-control select2"   value="{{Input::old('localidad')}}"  required>
													@foreach($localidades as $localidad)
													@if($centros->id_localidades == $localidad->id)
													<option value="{{$localidad->id}}" selected>
														{{$localidad->nom_loc}}
													</option>
													@else
													<option value="{{$localidad->id}}" >
														{{$localidad->nom_loc}}
													</option>
													@endif
													@endforeach
												</select>
												<div class="help-block with-errors"></div>
												<div class="text-danger" id='error_ciclo'>{{$errors->formulario->first('localidad')}}</div>
											</div>
										</div><!--/form-group-->

										<div class="form-group">
											<label class="col-sm-3 control-label">CALLE Y NUMERO: <strog class="theme_color">*</strog></label>
											<div class="col-sm-6">
												<input name="domicilio" id="domicilio" value="{{$centros->domicilio}}" type="text"   class="form-control" required placeholder="Ingrese la Calle y Numero" maxlength="40" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()"  />
											</div>
										</div>


										<div class="form-group">
											<label class="col-sm-3 control-label">Teléfono: <strog class="theme_color"></strog></label>
											<div class="col-sm-6">
												<input name="telefono" id="telefono" type="number" maxlength="10"   class="form-control" value="{{$centros->telefono}}" placeholder="(492)-000-0000"	/>
											</div>
										</div>

										<div class="form-group">
											<label class="col-sm-3 control-label">Email: <strog class="theme_color"></strog></label>
											<div class="col-sm-6">
												<input name="email" id="email" type="email"   placeholder="Ingrese el Nombre de la Escuela" value="{{$centros->email}}" class="form-control" size="30"  />
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
												<input name="alumnos" id="alumnos" type="number"   class="form-control"  value="{{$centros->total_alumnos}}" required placeholder="Ingrese el Total de Alumnos" maxlength="3" min="1" max ="999" />
											</div>
										</div>

										<div class="form-group">
											<label class="col-sm-3 control-label">Total de Niñas: <strog class="theme_color">*</strog></label>
											<div class="col-sm-6">
												<input name="ninas" id="ninas" value="{{$centros->total_ninas}}" type="number"   class="form-control" required placeholder="Ingrese el Total de Niñas" maxlength="3" min="1" max ="999" />
											</div>
										</div>

										<div class="form-group">
											<label class="col-sm-3 control-label">Total de Niños: <strog class="theme_color">*</strog></label>
											<div class="col-sm-6">
												<input name="ninos" id="ninos" value="{{$centros->total_ninos}}" type="number"   class="form-control"  required placeholder="Ingrese el Total de Niños" maxlength="3" min="1" max ="999" />
											</div>
										</div>

										<div class="form-group">
											<label class="col-sm-3 control-label">Total de Grupos: <strog class="theme_color">*</strog></label>
											<div class="col-sm-6">
												<input name="grupos"  value="{{$centros->total_grupos}}" placeholder="Ingrese el Total de Grupos" id="grupos" type="number"   class="form-control" required maxlength="3" min="1" max ="999" />
											</div>
										</div>

										<div class="form-group">
											<label class="col-sm-3 control-label">Total de Grados: <strog class="theme_color">*</strog></label>
											<div class="col-sm-6">
												<input name="grados" id="grados" type="number"  value="{{$centros->total_grados}}"  class="form-control" required placeholder="Ingrese el Total de Grados"  maxlength="3" min="1" max ="999" />
											</div>
										</div>

										<div class="form-group">
											<label class="col-sm-3 control-label">Total Director: <strog class="theme_color">*</strog></label>
											<div class="col-sm-6">
												<input name="director" value="{{$centros->total_directores}}"  placeholder="Ingrese el Total de Director" id="director" type="number"   class="form-control" required  maxlength="3" min="1" max ="999" />
											</div>
										</div>

										<div class="form-group">
											<label class="col-sm-3 control-label">Total Docentes: <strog class="theme_color">*</strog></label>
											<div class="col-sm-6">
												<input name="docente" value="{{$centros->total_docentes}}" id="docente" type="number"   class="form-control" required placeholder="Ingrese el Total de Docentes"  maxlength="3" min="1" max ="999" />
											</div>
										</div>

										<div class="form-group">
											<label class="col-sm-3 control-label">Total Educación Fisica: <strog class="theme_color">*</strog></label>
											<div class="col-sm-6">
												<input name="e_fisica" value="{{$centros->total_fisica}}" id="e_fisica" type="number"   class="form-control" required placeholder="Ingrese el Total de Docentes de Educación Fisica"  maxlength="3" min="0" max ="999" />
											</div>
										</div>

										<div class="form-group">
											<label class="col-sm-3 control-label">Total USAER: <strog class="theme_color">*</strog></label>
											<div class="col-sm-6">
												<input name="usaer" id="usaer" value="{{$centros->total_usaer}}" type="number"   class="form-control" required  placeholder="Ingrese el Total de USAER" maxlength="3" min="0" max ="999" />
											</div>
										</div>

										<div class="form-group">
											<label class="col-sm-3 control-label">Total Educación Artistica: <strog class="theme_color">*</strog></label>
											<div class="col-sm-6">
												<input name="artistica" id="artistica" value="{{$centros->total_artistica}}" type="number"   class="form-control" required placeholder="Ingrese el Total de Docentes de Educación Artistica"  maxlength="3" min="0" max ="999" />
											</div>
										</div>

										<div class="form-group">
											<label class="col-sm-3 control-label">Total Intendentes: <strog class="theme_color">*</strog></label>
											<div class="col-sm-6">
												<input name="intendente" id="intendente" value="{{$centros->total_intendentes}}" type="number"   class="form-control" required placeholder="Ingrese el Total de Intendentes"  maxlength="3" min="0" max ="999" />
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
