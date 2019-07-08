@extends('layouts.principal')
@section('contenido')
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<div class="pull-left breadcrumb_admin clear_both">
	<div class="pull-left page_title theme_color">
		<h1>Inicio</h1>
		<h2 class="">Reintegros</h2>
	</div>
	<div class="pull-right">
		<ol class="breadcrumb">
			<li><a style="color: #808080" href="{{url('reintegros')}}">Inicio</a></li>
			<li><a style="color: #808080" href="{{url('reintegros')}}">Reintegros</a></li>
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
							<h2 class="content-header" style="margin-top: -5px;"><strong>Agregar Reintegro</strong></h2>
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
					<form action="{{route('reintegros.store')}}" method="post" class="form-horizontal row-border" parsley-validate novalidate  files="true" enctype="multipart/form-data" accept-charset="UTF-8">
						{{csrf_field()}}

						<div class="form-group">
							<label class="col-sm-3 control-label">CCT <strog class="theme_color">*</strog></label>
							<div class="col-sm-6">
								<select  name="id_centro_trabajo" id="id_centro_trabajo" onchange="cctescuela();valida_cctre()" class="form-control select2" required>
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
								<div class="text-danger" id='error_cct'>{{$errors->formulario->first('cct')}}</div>
							</div>
						</div><!--/form-group-->


						<div class="form-group">
							<label class="col-sm-3 control-label">Nombre <strog class="theme_color">*</strog></label>
							<div class="col-sm-6">
								<select  name="id_captura" id="id_captura"  onchange="nombre_clave();valida_nom();nombre_sos();direc()" class="form-control select2" required>
									<option selected>
										Selecciona una opción
									</option>

								</select>
								<div class="help-block with-errors"></div>
								<div class="text-danger" id='error_nombre'>{{$errors->formulario->first('nombre')}}</div>
							</div>
						</div><!--/form-group-->

						<div class="form-group">
							<label class="col-sm-3 control-label">Categoría: <strog class="theme_color">*</strog></label>
							<div class="col-sm-6">
								<input name="categoria" id="categoria" disabled type="text"   class="form-control" required value="{{Input::old('categoria')}}" />
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-3 control-label">Ciclo Escolar <strog class="theme_color">*</strog></label>
							<div class="col-sm-6">
								<select  name="id_ciclo_escolar" id="id_ciclo_escolar" onchange="valida_ciclore();" class="form-control select2" required>
									<option selected>
										Selecciona una opción
									</option>
									@foreach($tabla as $ciclo)
									<option value="{{$ciclo->ciclo}}_{{$ciclo->pago_director}}_{{$ciclo->pago_docente}}_{{$ciclo->pago_intendente}}_{{$ciclo->id}}">
										{{$ciclo->ciclo}}
									</option>
								@endforeach
								</select>
								<div class="help-block with-errors"></div>
								<div class="text-danger" id='error_ciclo_escolar'>{{$errors->formulario->first('ciclo_escolar')}}</div>
							</div>
						</div><!--/form-group-->

						<div class="form-group">
							<label class="col-sm-3 control-label">Número de días: <strog class="theme_color">*</strog></label>
							<div class="col-sm-6">
								<input name="num_dias" id="num_dias" type="number" onchange="calculadoradire(this);"   class="form-control" required value="{{Input::old('num_dias')}}" />
							</div>
						</div>


						<div class="form-group">
							<label class="col-sm-3 control-label">Director Regional <strog class="theme_color">*</strog></label>
							<div class="col-sm-6">
								<select  name="id_directorio_regional" id="id_directorio_regional" onchange="valida_dire();" class="form-control select2" required>
									<option selected>
										Selecciona una opción
									</option>


								</select>
								<div class="help-block with-errors"></div>
								<div class="text-danger" id='error_director_regional'>{{$errors->formulario->first('director_regional')}}</div>
							</div>
						</div><!--/form-group-->

						<div class="form-group">
							<label class="col-sm-3 control-label">Sostenimiento: <strog class="theme_color">*</strog></label>
							<div class="col-sm-6">
								<input name="id_reg" id="id_reg" disabled type="text"  class="form-control" required value="{{Input::old('id_reg')}}" />
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-3 control-label">Pago Por Dia: <strog class="theme_color">*</strog></label>
							<div class="col-sm-6">
								<input name="dias" disabled onkeypress="soloNumeros(this);" id="dias" type="number"  class="form-control" required maxlength="3" min="1" max ="199" />
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-3 control-label">Número de Oficio: <strog class="theme_color">*</strog></label>
							<div class="col-sm-6">
								<input name="n_oficio" type="text"   class="form-control" required value="{{Input::old('n_oficio')}}" />
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-3 control-label">Motivo: <strog class="theme_color">*</strog></label>
							<div class="col-sm-6">
								<input name="motivo" type="text"   class="form-control" required value="{{Input::old('motivo')}}" />
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-3 control-label">Total: <strog class="theme_color">*</strog></label>
							<div class="col-sm-6">
								<input name="total"  disabled="true" id="total" type="number" value="{{Input::old('total')}}"  class="form-control" required min="1" max ="199" />
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
								<button type="submit" id="submit" disabled="true" class="btn btn-primary">Guardar</button>
								<a href="{{url('/reintegros')}}" class="btn btn-default"> Cancelar</a>
							</div>
						</div><!--/form-group-->


					</form>
				</div><!--/porlets-content-->
			</div><!--/block-web-->
		</div><!--/col-md-12-->
	</div><!--/row-->
</div><!--/container clear_both padding_fix-->
<script type="text/javascript">
			window.onload=function(){
				valida_cctre();
				valida_nom();
				valida_ciclore();

}

function valida_cctre() {
		if( document.getElementById('id_centro_trabajo').value == "Selecciona una opción"){
		//	swal("ERROR!","Selecciona tipo se puesto","error");
			document.getElementById('id_captura').disabled=true;
			document.getElementById('id_ciclo_escolar').disabled=true;
			document.getElementById('num_dias').disabled=true;
			document.getElementById('id_directorio_regional').disabled=true;
			document.getElementById("error_cct").innerHTML = "Seleccione una opción para habilitar los otros campos.";
			return false
		}else if(document.getElementById('id_centro_trabajo').value != "Selecciona una opción"){
			document.getElementById('id_captura').disabled=false;
			document.getElementById("error_cct").innerHTML = "Proceda con la captura. 😀";
		}
}

function valida_nom() {
			if( document.getElementById('id_captura').value == "Selecciona una opción"){
			//	swal("ERROR!","Selecciona tipo se puesto","error");

				document.getElementById("error_nombre").innerHTML = "Seleccione una opción.";
				return false
			}else if(document.getElementById('id_captura').value != "Selecciona una opción"){
				document.getElementById('id_ciclo_escolar').disabled=false;
				document.getElementById("error_nombre").innerHTML = "Proceda con la captura. 😀";
			}
}

function valida_ciclore() {
			if( document.getElementById('id_ciclo_escolar').value == "Selecciona una opción"){
			//	swal("ERROR!","Selecciona tipo se puesto","error");

				document.getElementById("error_ciclo_escolar").innerHTML = "Seleccione una opción.";
				return false
			}else if(document.getElementById('id_ciclo_escolar').value != "Selecciona una opción"){
				document.getElementById('num_dias').disabled=false;
				document.getElementById('id_directorio_regional').disabled=false;
				document.getElementById("error_ciclo_escolar").innerHTML = "Proceda con la captura. 😀";
			}
}

function valida_dire() {
			if( document.getElementById('id_directorio_regional').value == "Selecciona una opción"){
			//	swal("ERROR!","Selecciona tipo se puesto","error");

				document.getElementById("error_director_regional").innerHTML = "Seleccione una opción.";
				return false
			}else if(document.getElementById('id_directorio_regional').value != "Selecciona una opción"){

				document.getElementById('submit').disabled=false;
				document.getElementById("error_director_regional").innerHTML = "Proceda con la captura. 😀";
			}
}



function calculadoradire() {
 var i= 0;
 var x = String(document.getElementById("categoria").value);
 var y = parseInt(document.getElementById("num_dias").value);

 var select2 = document.getElementById("id_ciclo_escolar");
 var selectedOption2 = select2.selectedIndex;
 var cantidadtotal = select2.value;
 limite = "9",
 separador = "_",
 arregloDeSubCadenas = cantidadtotal.split(separador, limite);
 ciclo=arregloDeSubCadenas[0];
 pago_director=arregloDeSubCadenas[1];
 pago_docente=arregloDeSubCadenas[2];
 pago_intendente=arregloDeSubCadenas[3];

 if(x == "DIRECTOR"){
  document.getElementById("dias").value=pago_director;
  document.getElementById("total").value=pago_director * y

}else if (x == "DOCENTE") {
  document.getElementById("dias").value=pago_docente;
  document.getElementById("total").value=pago_docente * y
}else{
  document.getElementById("dias").value=pago_intendente;
  document.getElementById("total").value=pago_intendente * y
}

}



function cctescuela(){
var cct = document.getElementById("id_centro_trabajo").value;

var route = "http://localhost:8000/traerpersonal/"+cct;

$.get(route,function(res){
  if(res.length > 0){
    for (var i = 0; i < res.length; i++) {
      if(res[i].estado =="ACTIVO"){
        var x = document.getElementById("id_captura");
        var option = document.createElement("option");
        option.text = res[i].nombre;
        option.value = res[i].nombre +"_"+res[i].categoria +"_"+res[i].sostenimiento +"_"+res[i].id;

				x.add(option, x[i]);

      }
    }
  }

});
}


function direc(){

var dire = document.getElementById("id_reg").value;

var route = "http://localhost:8000/traerdire/"+dire;

$.get(route,function(res){
  if(res.length > 0){
alert('entro');
    for (var i = 0; i < res.length; i++) {
      if(res[i].estado =="ACTIVO"){
        var x = document.getElementById("id_directorio_regional");
        var option = document.createElement("option");
        option.text = res[i].director_regional;
        option.value = res[i].director_regional +"_"+res[i].id;

				x.add(option, x[i]);

      }
    }
  }

});

}





function nombre_clave() {
      var select2 = document.getElementById("id_captura");
      var selectedOption2 = select2.selectedIndex;
     	var cantidadtotal = select2.value;
     	limite = "9",
      separador = "_",
      arregloDeSubCadenas = cantidadtotal.split(separador, limite);
     	cct=arregloDeSubCadenas[0];
     	categoria=arregloDeSubCadenas[1];
     	document.getElementById('categoria').value=categoria;

}

function nombre_sos() {
      var select2 = document.getElementById("id_captura");
      var selectedOption2 = select2.selectedIndex;
     	var cantidadtotal = select2.value;
     	limite = "9",
      separador = "_",
      arregloDeSubCadenas = cantidadtotal.split(separador, limite);
     	cct=arregloDeSubCadenas[0];
			sostenimiento=arregloDeSubCadenas[2];
     	id_reg=arregloDeSubCadenas[3];
     	document.getElementById('id_reg').value=id_reg;
			
}


</script>

@endsection
