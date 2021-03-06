@extends('layouts.principal')
@section('contenido')
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

<div class="pull-left breadcrumb_admin clear_both">
	<div class="pull-left page_title theme_color">
		<h1>Inicio</h1>
		<h2 class="">Capturar Rechazo</h2>
	</div>
	<div class="pull-right">
		<ol class="breadcrumb">
			<li><a style="color: #808080" href="{{url('nomina_capturada')}}">Inicio</a></li>
			<li><a style="color: #808080" href="{{url('nomina_capturada')}}">Capturar Rechazo</a></li>
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
							<h2 class="content-header" style="margin-top: -5px;"><strong>Agregar Rechazo</strong></h2>


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
					<form action="{{route('cap_rechazo.store')}}" method="post" class="form-horizontal row-border" parsley-validate novalidate  files="true" enctype="multipart/form-data" accept-charset="UTF-8">
						{{csrf_field()}}

						<div class="form-group">
							<label class="col-sm-3 control-label">Quincena <strog class="theme_color">*</strog></label>
							<div class="col-sm-6">
								<select name="qna" id="qna" class="form-control select2" value="{{Input::old('qna')}}"  onchange="validar_quincena();validar_quincenaExis();valida_qna()" required>
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
                <select name="sostenimiento" id="sostenimiento" class="form-control" value="{{Input::old('sostenimiento')}}"  onchange="valida_sos();validar_quincenaExis();validar_quincena();cambia_img()" required>
									<option>
											Selecciona una opción
									</option>
									<option value="FEDERAL">
                    FEDERAL
                  </option>
                  <option value="ESTATAL">
                    ESTATAL
                  </option>


                </select>
								<div class="help-block with-errors"></div>
							<div class="text-danger" id='error_sos'>{{$errors->formulario->first('sostenimiento')}}</div>
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
						</div>
					-->

            <div class="form-group">
							<label class="col-sm-3 control-label">Tipo <strog class="theme_color">*</strog></label>
							<div class="col-sm-6">
								<select name="tipo" id="tipo" disabled="disabled" class="form-control" onchange="valida_tipo();validar_quincena();validar_quincenaExis()" value="{{Input::old('tipo')}}" required>
									<option selected>
										Selecciona una opción
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

									<input type="file" id="file" name="file" onchange="valida_file_cargar();validar_quincena();validar_quincenaExisTipo()">
								<div class="text-danger" id='error_file'>{{$errors->formulario->first('file')}}</div>

							</div>
						  </div>



						<div align="center">
					<h4 class="content-header " style="margin-top: -5px;">&nbsp;&nbsp;<strong> Nota: <u> <b> El archivo excel Tiene que Llevar los encabezados de la Siguiente Forma </b> </u> </strong></h4>
				<img  id="src" height="1000px" width="1000px" class="img-thumbnail">

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

								<button type="submit" id="submit"  onclick="validar_quincena();validar_quincenaExis();" class="btn btn-primary">Guardar</button>
								<a href="{{url('/cap_rechazo')}" class="btn btn-default"> Cancelar</a>
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

			document.getElementById('sostenimiento').disabled=true;
			document.getElementById('tipo').disabled=true;
			document.getElementById('file').disabled=true;
			document.getElementById('submit').disabled=true;
			document.getElementById("error_qna").innerHTML = "Seleccione una opción para habilitar los otros campos.";
			return false
		}else if(document.getElementById('qna').value != "Selecciona una opción"){
			document.getElementById('sostenimiento').disabled=false;
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

		function cambia_img(){

			if (document.getElementById('sostenimiento').value =="Selecciona una opción"){

			}else if(document.getElementById('sostenimiento').value =="FEDERAL"){
				document.getElementById('src').src="/img/ejemplos/rechfed.png";
			}else{
				document.getElementById('src').src="/img/ejemplos/rechest.png";

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
					return false
				}else{

					if(!allowedExtensions.exec(filePath)){
			 swal("WARNING!",'Solo es permitido subir archivos con extención ".xls y .xlsx" o de tipo Excel verifique sus datos',"warning");
			 fileInput.value = '';
			 return false;
				}
					document.getElementById('submit').disabled=false;
					document.getElementById("error_file").innerHTML = "";
				}

			}

function validar_quincenaExisdasdas(){

			     var qna= document.getElementById("qna").value;
			     var sostenimiento= document.getElementById("sostenimiento").value;
			     var tipo= document.getElementById("tipo").value;
			     var route = "http://localhost:8000/validar_quincenaExis/"+qna+"/"+sostenimiento+"/"+tipo;



			     $.get(route,function(res){

			       if(res.length > 0 ){

			         for (var i=0; i < res.length; i++){
			           if(res[i].estado=="ACTIVO"){
			             document.getElementById('file').disabled=true;

			             swal("WARNING!","Los rechazos correspondientes a la quincena <<"+qna+">> ya han sido registrados anteriormente.","warning");
			             //  document.getElementById("error_nominacapturada").innerHTML = "La Quincena que intenta registrar ya ha sido insertada anteriormente";
									 document.getElementById("qna").value = 'Selecciona una opción';
			           }

			         }

			       }

			   });
			   //  valida_file();
			   }




/*
function activar_button(){
	var x = document.getElementById('file').value;
	if (x != ""){
		document.getElementById('submit8').disabled=false;
	}else{
		document.getElementById('submit8').disabled=true;
	}
}

function valida_file(){
	if( document.getElementById("file").files.length == 0 ){

		swal("ERROR!","No se ha seleccionado ninguna Nomina.","error");
		//document.getElementById("error_nominacapturada").innerHTML = "No se ha seleccionado ninguna Nomina.";
		return false
	}else{

	}

}
// Inside Document Ready
function valida_nomina(){
		var x = document.getElementById('file').value;
	var qna= document.getElementById("qna").value;
	var sostenimiento= document.getElementById("sostenimiento").value;
	var tipo= document.getElementById("tipo").value;
	var route = "http://localhost:8000/validar_nomina/"+qna+"/"+sostenimiento+"/"+tipo;
	var aux=0;


	$.get(route,function(res){

			if(res.length > 0 ){
				for (var i=0; i < res.length; i++){
					if(res[i].estado=="ACTIVO" && x == "" || res[i].estado=="ACTIVO" && x != "" ){


	document.getElementById('submit8').disabled=true;
						swal("ERROR!","La Quincena que intenta registrar ya ha sido insertada anteriormente","error");
					//	document.getElementById("error_nominacapturada").innerHTML = "La Quincena que intenta registrar ya ha sido insertada anteriormente";
						return false
					}

				}
			}else if(x != ""){

					document.getElementById('submit8').disabled=false;
	//valida_file();
			}

	});
//	valida_file();
}
*/
</script>

@endsection
