@extends('layouts.principal')
@section('contenido')
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<div class="pull-left breadcrumb_admin clear_both">
	<div class="pull-left page_title theme_color">
		<h1>Inicio</h1>
		<h2 class="">Editar Nominas Capturada</h2>
	</div>
	<div class="pull-right">
		<ol class="breadcrumb">
			<li><a style="color: #808080" href="{{url('nomina_capturada')}}">Inicio</a></li>
			<li><a style="color: #808080" href="{{url('nomina_capturada')}}">Editar Nomina Capturada</a></li>
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
							<h2 class="content-header" style="margin-top: -5px;"><strong>Editar Nomina</strong></h2>
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
          <form action="{{url('/nomina_capturada', [$nomina_capturada->id])}}" method="post" class="form-horizontal row-border" parsley-validate novalidate files="true" enctype="multipart/form-data" accept-charset="UTF-8">
						{{csrf_field()}}
						<input type="hidden" name="_method" value="PUT">


						<div class="form-group">
							<label class="col-sm-3 control-label">Quincena <strog class="theme_color">*</strog></label>
							<div class="col-sm-6">
								<select name="qna" id="qna" class="form-control select2" value="{{Input::old('qna')}}"  onchange="valida_qna();valida_nomina()" required>
									<option selected>
										Selecciona una opción
									</option>
									@foreach($quincena as $quincena)
									<option value="{{$quincena->qna}}">
										{{$quincena->qna}}
									</option>
									@endforeach
								</select>
								<div class="help-block with-errors"></div>
							<div class="text-danger" id='error_qna'>{{$errors->formulario->first('qna')}}</div>
							</div>
						</div><!--/form-group-->

						<div class="form-group">
              <label class="col-sm-3 control-label">Sostenimiento <strog class="theme_color">*</strog></label>
              <div class="col-sm-6">
                <select name="sostenimiento" id="sostenimiento" class="form-control" value="{{Input::old('sostenimiento')}}"  onchange="valida_sos();valida_nomina()"required>
									<option selected>
                    {{$nomina_capturada->sostenimiento}}
                  </option>
									<option value="FEDERAL">
                    FEDERAL
                  </option>
                  <option value="ESTATAL">
                    ESTATAL
                  </option>


                </select>
                <div class="help-block with-errors"></div>
									<div class="text-danger" id='error_sos'>{{$errors->formulario->first('sos')}}</div>
              </div>
            </div><!--/form-group-->



					<!--	<div class="form-group">
							<label class="col-sm-3 control-label">Estado <strog class="theme_color">*</strog></label>
							<div class="col-sm-6">
								<select name="estado" class="form-control" value="{{Input::old('estado')}}" required>
									<option value="ACTIVO">
										ACTIVO
									</option>
									<option value="INACTIVO">
										INACTIVO
									</option>


								</select>
								<div class="help-block with-errors"></div>
							</div>
						</div> -->

            <div class="form-group">
							<label class="col-sm-3 control-label">Tipo <strog class="theme_color">*</strog></label>
							<div class="col-sm-6">
								<select name="tipo" id="tipo" class="form-control" onchange="valida_tipo();valida_nomina()" value="{{Input::old('tipo')}}" required>
									<option value="ORDINARIO">
										{{$nomina_capturada->tipo}}
									</option>
									<option value="ORDINARIO">
										ORDINARIO
									</option>
									<option value="EXTRAORDINARIO">
										EXTRAORDINARIO
									</option>


								</select>
								<div class="help-block with-errors"></div>
								<div class="text-danger" id='error_tipo'>{{$errors->formulario->first('tipo')}}</div>
							</div>
						</div><!--/form-group-->



												<div class="form-group">
												  <label class="col-sm-3 control-label">Subir Nomina: <strog class="theme_color">*</strog></label>
												  <div class="col-sm-6">

															<input type="file" id="file" name="file" onchange="valida_file_cargar();valida_nomina()" <br> </br>
														<div class="text-danger" id='error_file'>{{$errors->formulario->first('file')}}</div>

													</div>
												  </div>





																			<div class="form-group">
																				<div class="col-sm-offset-7 col-sm-5">

																					<button type="submit" id="submit" onclick="valida_nomina()" class="btn btn-primary">Guardar</button>
																					<a href="{{url('/nomina_capturada')}" class="btn btn-default"> Cancelar</a>
																				</div>
																			</div><!--/form-group-->


					</form>
				</div><!--/porlets-content-->
			</div><!--/block-web-->
		</div><!--/col-md-12-->
	</div><!--/row-->
</div><!--/container clear_both padding_fix-->
<script type="text/javascript">

window.onload = function() {
		valida_qna();
		valida_sos();
		valida_tipo();
		valida_file_cargar();
	}

function valida_qna() {
			if( document.getElementById('qna').value == "Selecciona una opción"){
			//	swal("ERROR!","Selecciona tipo se puesto","error");


				document.getElementById('file').disabled=true;
				document.getElementById('submit').disabled=true;
				document.getElementById("error_qna").innerHTML = "Seleccione una opción.";
				return false
			}else if(document.getElementById('qna').value != "Selecciona una opción"){
				document.getElementById('sostenimiento').disabled=false;
				document.getElementById('file').disabled=false;
				document.getElementById("error_qna").innerHTML = "";
			}
		}



function valida_sos() {
				if( document.getElementById('sostenimiento').value == "Selecciona una opción"){
				//	swal("ERROR!","Selecciona tipo se puesto","error");
					document.getElementById('tipo').disabled=true;
					document.getElementById("error_sos").innerHTML = "No se ha seleccionado ninguna opción.";
					return false
				}else if(document.getElementById('sostenimiento').value != "Selecciona una opción"){
							document.getElementById('tipo').disabled=false;
							document.getElementById("error_sos").innerHTML = "";
				}
			}


function valida_tipo() {
					if( document.getElementById('tipo').value == "Selecciona una opción"){
					//	swal("ERROR!","Selecciona tipo se puesto","error");
						document.getElementById('file').disabled=true;
						document.getElementById("error_tipo").innerHTML = "No se ha seleccionado ninguna opción.";
						return false
					}else if(document.getElementById('tipo').value != "Selecciona una opción"){
								document.getElementById('file').disabled=false;
								document.getElementById("error_tipo").innerHTML = "";
					}
				}



function valida_file_cargar(){
					var fileInput = document.getElementById('file');
					var filePath = fileInput.value;
					var allowedExtensions = /(.xls|.xlsx)$/i;

					if( document.getElementById("file").files.length == 0 ){

						//swal("ERROR!","No se ha seleccionado ninguna Nomina.","error");
						document.getElementById("error_file").innerHTML = "Carga tu nomina.";
						document.getElementById('submit').disabled=true;
						return false
					}else{

						if(!allowedExtensions.exec(filePath)){
				 swal("WARNING!",'Solo es permitido subir archivos con extención ".xls y .xlsx" o de tipo Excel verifique sus datos',"warning");
				 fileInput.value = '';
				 return false;
					}
						document.getElementById('submit').disabled=false;

					}

}


	 function validar_quincenaExis(){

	     var qna= document.getElementById("qna").value;
	     var sostenimiento= document.getElementById("sostenimiento").value;
	     var tipo= document.getElementById("tipo").value;
	     var route = "http://localhost:8000/validar_quincenaExis/"+qna+"/"+sostenimiento+"/"+tipo;



	      $.get(route,function(res){

	    		  if(res.length > 0 ){

	    				  for (var i=0; i < res.length; i++){
	    				    if(res[i].estado=="ACTIVO"){
	    				 		   document.getElementById('file').disabled=true;

	    				 			  swal("WARNING!","La nomina correspondiente a la quincena <<"+qna+">> <<"+sostenimiento+">> ya han sido registrados anteriormente.","warning");
	    				 			             //  document.getElementById("error_nominacapturada").innerHTML = "La Quincena que intenta registrar ya ha sido insertada anteriormente";
	                               return false;
	    				    }

	    				  }

	    			 }else{
	    			    document.getElementById('file').disabled=false;
	    			 }
	     });
	     }


</script>
@endsection
