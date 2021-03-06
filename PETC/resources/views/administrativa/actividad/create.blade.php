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
		<h1>Registrar Actividad</h1>
		<h2 class="active"></h2>
	</div>
	<div class="pull-right">
		<ol class="breadcrumb">
			<li><a href="?c=Inicio">Inicio</a></li>
			<li><a href="?c=">Registrar Actividad</a></li>
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

 
				<	<div class="porlets-content">
					<div  class="form-horizontal row-border" > <!--acomodo-->
						<form class="" id="myForm" action="{{route('actividad.store')}}" method="post" role="form" enctype="multipart/form-data" parsley-validate novalidate data-toggle="validator">
							{{csrf_field()}}
							<div id="smartwizard">
								<ul>
									<li><a href="#step-1">Registrar Actividad</a></li>
									<li><a href="#step-2">Registrar Actividad</a></li>
								</ul>
								<div>
									<div id="step-1" class="">
										<div class="user-profile-content">

											<div id="form-step-0" role="form" data-toggle="validator">
												<h3 class="h3titulo">Actividad</h3>

												<div class="form-group">
													<label class="col-sm-3 control-label">Nombre de la Actividad: <strog class="theme_color">*</strog></label>
													<div class="col-sm-6">
														<input name="nombre" id="nombre" type="text"   class="form-control" required value="{{Input::old('nombre')}}"   onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()" />
													</div>
												</div>

												<div class="form-group">
													<label class="col-sm-3 control-label">Lugar: <strog class="theme_color">*</strog></label>
													<div class="col-sm-6">
														<input name="lugar" id="lugar" type="text"   class="form-control" required value="{{Input::old('lugar')}}"   onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()" />
													</div>
												</div>



												<div class="form-group">
													<label class="col-sm-3 control-label">Fecha: <strog class="theme_color">*</strog></label>
													<div class="col-sm-6">

														<input type="date" name="fecha" id="fecha" value="2019-08-26" class="form-control mask"   required>
													</div>
												</div>


 
												<div class="form-group">
													<label class="col-sm-3 control-label">Seleccione Ciclo Escolar : <strog class="theme_color"></strog></label>
													<div class="col-sm-6">
														<select name="ciclo_escolar" id="ciclo_escolar" class="form-control select2" >
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





											</div><!--validator-->
										</div><!--user-profile-content-->
									</div><!--step-1-->

									<div id="step-2" class="">
										<div class="user-profile-content">
											<div id="form-step-1" role="form" data-toggle="validator">
												<h3 class="h3titulo">Datos del Aviso</h3>




												<div class="form-group">
													<label class="col-sm-3 control-label">Área;<strog class="theme_color">*</strog></label>
													<div class="col-sm-6">
														<select name="area" id="area"  class="form-control select" required>
															<option selected>
																Seleccione una opción
															</option>
															<option value="ALIMENTACION" >ALIMENTACION</option>
															<option value="NOMINA Y SISTEMAS">NOMINA Y SISTEMAS</option>
															<option value="ACADEMICA">ACADEMICA</option>				
															<option value="RECEPCION">RECEPCION</option>
															<option value="FINANCIERA">FINANCIERA</option>
															<option value="MATERIALES">MATERIALES</option>
															<option value="JURIDICA">JURIDICA</option>
															<option value="ADMINISTRATIVA">ADMINISTRATIVA</option>

														</select>															
													</div>
												</div>




												<div class="form-group">
													<label class="col-sm-3 control-label">Motivo: <strog class="theme_color"></strog></label>
													<div class="col-sm-6">
														<input name="motivo" id="motivo" type="text"  class="form-control"  value="{{Input::old('motivo')}}"   onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()" />
													</div>
												</div>
												
												<div class="form-group">
													<label class="col-sm-3 control-label">Descripción: <strog class="theme_color"></strog></label>
													<div class="col-sm-6">
														<input name="descripcion" id="descripcion" type="text"  class="form-control"  value="{{Input::old('descripcion')}}"   onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()" />
													</div>
												</div>
												
							


									

												<div class="form-group">
													<label class="col-sm-3 control-label">Anexar Imagen: <strog class="theme_color"></strog></label>
													<div class="col-sm-6">
														<input name="archivo" id="archivo" type="file"  accept=".jpg, .jpeg, .png" />
													</div>
												</div>


												<div class="form-group">
													<div class="col-sm-offset-7 col-sm-5">
														<button id="submit"  class="btn btn-primary">Guardar</button>
														<a href="{{url('/actividad')}}" class="btn btn-default"> Cancelar</a>
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


          	}else if (stepNumber == 1){


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
