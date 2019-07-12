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
		<h1>Registro de Reclamos</h1>
		<h2 class="active"></h2>
	</div>
	<div class="pull-right">
		<ol class="breadcrumb">
			<li><a style="color: #808080" href="{{url('reclamos')}}">Inicio</a></li>
			<li><a style="color: #808080" href="{{url('reclamos')}}">reclamos</a></li>
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
						<form class="" id="myForm" action="{{route('reclamos.store')}}" method="post" role="form" enctype="multipart/form-data" parsley-validate novalidate data-toggle="validator">
							{{csrf_field()}}
							<div id="smartwizard">
								<ul>
									<li><a href="#step-1">Datos de los Reclamos</a></li>
									<li><a href="#step-2">Información del Oficio</a></li>
									<li><a href="#step-3">Información del Oficio 2</a></li>
								</ul>
								<div>



									<div id="step-1" class="">
										<div class="user-profile-content">

											<div id="form-step-0" role="form" data-toggle="validator">
												<h3 class="h3titulo">Informacion de los Reclamos</h3>


												<div class="form-group">
													<label class="col-sm-3 control-label">Empleado <strog class="theme_color">*</strog></label>
													<div class="col-sm-6">
														<select name="personal" id="personal" class="form-control select2" onchange="cambia_reclamos();"  required>
															@foreach($captura as $personal)
															<option value="{{$personal->id}}_{{$personal->rfc}}_{{$personal->nombre}}_{{$personal->categoria}}_{{$personal->cct}}_{{$personal->nombre_escuela}}_{{$personal->fecha_inicio}}_{{$personal->fecha_termino}}">
																{{$personal->nombre}}
															</option>
															@endforeach
														</select>
														<input name="rfc" id="rfc" disabled type="text"   class="form-control" required value="" />
														<div class="help-block with-errors"></div>
							<!--	<div class="text-danger" id='error_ciclo'>{{$errors->formulario->first('cct')}}</div>
						--></div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label">Escuela: <strog class="theme_color">*</strog></label>
						<div class="col-sm-6">
							<input name="escuela" id="escuela" disabled type="text"   class="form-control" required value="{{Input::old('escuelas')}}" />
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label">CCT: <strog class="theme_color">*</strog></label>
						<div class="col-sm-6">
							<input name="cct" id="cct" disabled type="text"   class="form-control" required value="{{Input::old('cct')}}" />
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label">Categoria: <strog class="theme_color">*</strog></label>
						<div class="col-sm-6">
							<input name="categoria" id="categoria" disabled type="text"   class="form-control" required value="{{Input::old('escuelas')}}" />
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label">Fecha de Inicio de Labores: <strog class="theme_color">*</strog></label>
						<div class="col-sm-6">

							<input type="date" name="fechai" id="fechai" value="" class="form-control mask"  onchange="verifica_fecha()" required>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label">Fecha de Termino de Labores: <strog class="theme_color">*</strog></label>
						<div class="col-sm-6">

							<input type="date" name="fechaf" id="fechaf" value="" class="form-control mask"  onchange="verifica_fecha()" required >
						</div>
						<div class="text-danger" id='error_fecha'>{{$errors->formulario->first('error_fecha')}}</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label">Total de Dias Habiles: <strog class="theme_color">*</strog></label>
						<div class="col-sm-6">
							<input name="dias" id="dias" onchange="calcula_monto();" type="text"   class="form-control" required value="{{Input::old('dias')}}" />
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label">Total de Reclamo: <strog class="theme_color">*</strog></label>
						<div class="col-sm-6">
							<input name="total" id="total"  type="text"   class="form-control" required value="{{Input::old('dias')}}" />
						</div>
						<span id="errorUnidad" style="color:#FF0000;"></span>
					</div>




					<div class="form-group">
						<label class="col-sm-3 control-label">Ciclo Escolar: <strog class="theme_color">*</strog></label>
						<div class="col-sm-6">
							<select name="ciclo_escolar" id="ciclo_escolar" onchange="buscar_qnas();" class="form-control select2" >
								@foreach($ciclos as $ciclo)
								<option value='{{$ciclo->ciclo}}'>
									{{$ciclo->ciclo}}
								</option>
								@endforeach
							</select>

						</div>
					</div>




					<div class="col-sm-3">
						<div class="form-group">
							<button type="button" id="btn_add" onclick="llenado();" class="btn btn-primary">Agregar</button>
						</div>
					</div>


					<div class="form-group"  class="table-responsive">
						<table id="detalles" name="detalles[]" value="" class="table table-responsive-xl table-bordered">
							<thead style="background-color:#A9D0F5">
								<th>Opciones</th>
								<th>N°</th>
								<th>Nombre</th>
								<th>R.F.C </th>
								<th>Categoria</th>
								<th>C.C.T</th>
								<th>Total de Dias</th>
								<th>Fecha Inicio</th>
								<th>Fecha Final</th>
								<th>Total Reclamo</th>
							</thead>
							<tfoot>
								<td style="display:none;"></td>
								<td style="display:none;"></td>
								<td style="display:none;"></td>
								<td style="display:none;"></td>
								<td style="display:none;"></td>
								<td style="display:none;"></td>
								<td style="display:none;"></td>
								<td style="display:none;"></td>
								<td style="display:none;"></td>
							</tfoot>
						</table>


						<div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
							<div class="form-group">
								<label  for="subtotal">Total </label>
								<input name="subtotal" id="subtotal" type="number" value="0"  maxlength="5" class="form-control"  readonly/>
							</div>
						</div>

						<div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
							<div class="form-group">
								<label for="total">Total de Elementos </label>
								<input name="totale" id="totale" type="number"  class="form-control"  readonly/>
							</div>
						</div>



						<div class="form-group">
							<div class="col-sm-6">
								<input  id="codigo2" value="" name="codigo2[]" type="hidden"   class="form-control"  />
							</div>
						</div>

						<div class="form-group">
							<div class="col-sm-6">
								<input  id="visto_bueno" value="" name="visto_bueno[]" type="hidden"   class="form-control"  />
							</div>
						</div>

						<div class="form-group">
							<div class="col-sm-6">
								<input  id="c_copia" value="" name="c_copia[]" type="hidden"   class="form-control"  />
							</div>
						</div>


					</div>



					<div class="form-group">
						<div class="col-sm-6">
							<input  id="inasistencias" value="" name="inasistencias[]" type="hidden"  class="form-control"/>
						</div>
					</div>




				</div><!--validator-->
			</div><!--user-profile-content-->
		</div><!--step-1-->

		<div id="step-2" class="">
			<div class="user-profile-content">
				<div id="form-step-1" role="form" data-toggle="validator">
					<h3 class="h3titulo">Información del Oficio</h3>

					<div class="form-group">
						<label class="col-sm-3 control-label">Dirigido Para: <strog class="theme_color">*</strog></label>
						<div class="col-sm-6">
							<select name="dirigido_a" id="dirigido_a"  class="form-control select2">
								@foreach($dirigido as $dirigido2)
								@if($dirigido2->id == 63)
								<option value='{{$dirigido2->puesto}}_{{$dirigido2->nombre_c}}_{{$dirigido2->id}}_{{$dirigido2->lic}}_{{$dirigido2->a_n}}' selected>
									{{$dirigido2->lic}}. {{$dirigido2->nombre_c}}.-{{$dirigido2->puesto}}
								</option>
								@else
								<option value='{{$dirigido2->puesto}}_{{$dirigido2->nombre_c}}_{{$dirigido2->id}}_{{$dirigido2->lic}}_{{$dirigido2->lic}}_{{$dirigido2->a_n}}'>
									{{$dirigido2->lic}}. {{$dirigido2->nombre_c}}.-{{$dirigido2->puesto}}
								</option>
								@endif
								@endforeach
							</select>

						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label">Con Vo.Bo: <strog class="theme_color">*</strog></label>
						<div class="col-sm-6">
							<select name="vo" id="vo"  class="form-control select" ">
								@foreach($dirigido as $dirigido3)
								@if($dirigido3->id == 19)
								<option value='{{$dirigido3->puesto}}_{{$dirigido3->nombre_c}}_{{$dirigido3->id}}_{{$dirigido3->lic}}' selected>
									{{$dirigido3->lic}}. {{$dirigido3->nombre_c}}.-{{$dirigido3->puesto}}
								</option>
								@else
								<option value='{{$dirigido3->puesto}}_{{$dirigido3->nombre_c}}_{{$dirigido3->id}}_{{$dirigido3->lic}}'>
									{{$dirigido3->lic}}. {{$dirigido3->nombre_c}}.-{{$dirigido3->puesto}}
								</option>
								@endif
								@endforeach
							</select>

						</div>
					</div>


					<div class="col-sm-3">
						<div class="form-group">
							<button type="button" id="btn_add" onclick="agregar2();" class="btn btn-primary">Agregar</button>
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-6">
							<div class="form-group"  class="table-responsive">
								<table id="detalles2" name="detalles2[]" value="" class="table table-responsive-xl table-bordered">
									<thead style="background-color:#A9D0F5">
										<th>Opciones</th>
										<th>N°</th>
										<th>Lic</th>
										<th>Nombre</th>
										<th>Puesto </th>

									</thead>
									<tfoot>
										<td style="display:none;"></td>
										<td style="display:none;"></td>
										<td style="display:none;"></td>
										<td style="display:none;"></td>
										<td style="display:none;"></td>

									</tfoot>
								</table>
							</div>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label">C.c.p: <strog class="theme_color">*</strog></label>
						<div class="col-sm-6">
							<select name="ccp" id="ccp"  class="form-control select" ">
								@foreach($dirigido as $dirigido4)
								@if($dirigido4->id == 63)
								<option value='{{$dirigido4->puesto}}_{{$dirigido4->nombre_c}}_{{$dirigido4->id}}_{{$dirigido4->lic}}_{{$dirigido4->a_n}}' selected>
									{{$dirigido4->lic}}. {{$dirigido4->nombre_c}}.-{{$dirigido4->puesto}}
								</option>
								@else
								<option value='{{$dirigido4->puesto}}_{{$dirigido4->nombre_c}}_{{$dirigido4->id}}_{{$dirigido4->lic}}_{{$dirigido4->a_n}}'>
									{{$dirigido4->lic}}. {{$dirigido4->nombre_c}}.-{{$dirigido4->puesto}}
								</option>
								@endif
								@endforeach
							</select>

						</div>
					</div>

					<div class="col-sm-3">
						<div class="form-group">
							<button type="button" id="btn_add" onclick="agregar3();" class="btn btn-primary">Agregar</button>
						</div>
					</div>

					<div class="form-group">
						<div class="col-sm-6">
							<div class="form-group"  class="table-responsive">
								<table id="detalles3" name="detalles3[]" value="" class="table table-responsive-xl table-bordered">
									<thead style="background-color:#A9D0F5">
										<th>Opciones</th>
										<th>N°</th>
										<th>Lic</th>
										<th>Nombre</th>
										<th>Puesto </th>
										<th>A_N</th>

									</thead>
									<tfoot>
										<td style="display:none;"></td>
										<td style="display:none;"></td>
										<td style="display:none;"></td>
										<td style="display:none;"></td>
										<td style="display:none;"></td>
									</tfoot>
								</table>
							</div>
						</div>
					</div>




					<</div><!--validator-->
				</div><!--user-profile-content-->
			</div><!--step-2-->

			<div id="step-3" class="">
				<div class="user-profile-content">
					<div id="form-step-1" role="form" data-toggle="validator">
						<h3 class="h3titulo">Información del Oficio 2</h3>


						<div class="form-group">
							<label class="col-sm-3 control-label">N° Oficio: <strog class="theme_color">*</strog></label>
							<div class="col-sm-6">
								<input onchange="num_oficio();" maxlength="3" minlength="3" name="oficio_aux"  id="oficio_aux" class="form-control" required />
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-3 control-label">N° Oficio: <strog class="theme_color">*</strog></label>
							<div class="col-sm-6">
								<input name="oficio" type="text" id="oficio"  value="SA/DFE/DHA/ETC.-/2019" class="form-control" required onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()"  />
							</div>
						</div>
						<br> <br>

						<div class="form-group">
							<label class="col-sm-3 control-label">Motivo: <strog class="theme_color">*</strog></label>
							<div class="col-sm-6">
								<textarea  name="motivo" type="text" id="motivo" class="form-control" required vonKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()" rows="10" cols="30"> debido a una diferencia de pago en varias quincenas, ya que por distintas situaciones no se encontraron activos en el sistema de nómina de la Secretaria de Educación (SIPETC)</textarea>
							</div>
						</div>



						<br> <br>

						<div class="form-group">
							<label class="col-sm-3 control-label">Observaciones: <strog class="theme_color">*</strog></label>
							<div class="col-sm-6">
								<input name="observaciones" type="text" id="observaciones"   class="form-control" required value="{{Input::old('observaciones')}}" onKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()" />
							</div>
						</div>

						<br> <br>
						<div class="form-group">
							<label class="col-sm-3 control-label">Genero Oficio: <strog class="theme_color">*</strog></label>
							<div class="col-sm-6">
								<select name="genero" id="genero"  class="form-control select2" >
									@foreach($genero as $genero)
									<option value='{{$genero->abrebiatura}}_{{$genero->id}}'>
										{{$genero->nombre}}
									</option>
									@endforeach
								</select>

							</div>
						</div>

						<br> <br>
						<div class="form-group">
							<label class="col-sm-3 control-label">Se Solicita Pago para Qna: <strog class="theme_color">*</strog></label>
							<div class="col-sm-6">
								<select name="pagos" id="pagos"  class="form-control select2">

								</select>

							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-3 control-label">Fecha del Oficio: <strog class="theme_color">*</strog></label>
							<div class="col-sm-6">
								<input name="fecha" type="date" id="fecha"   class="form-control" required />
							</div>
						</div>


						<div class="form-group">
							<div class="col-sm-offset-7 col-sm-5">
								<button type="submit"  id="submit8"  onclick="return guardar_reclamo();" class="btn btn-primary">Guardar</button>
								<a href="{{url('/inasistencias2')}}" class="btn btn-default"> Cancelar</a>
							</div>
						</div><!--/form-group-->

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
		cambia_reclamos();
		buscar_qnas();
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
          		var r = document.getElementById("totale").value;
          		if(r < 1){
          			return false;
          		}

          	}else if (stepNumber == 1){
          		var vo =document.getElementById("detalles2").rows
          		var cp =document.getElementById("detalles3").rows

          		if(vo.length < 3){
          			swal("Alerta!", "No hay Elementos Agregados, Como Vo.Bo!", "error");
          			return false;
          		}

          		if(cp.length < 3){
          			swal("Alerta!", "No hay Elementos Agregados, Como C.c.p!", "error");
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
