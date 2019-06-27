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
								<select  name="cct" id="cct" onchange="cctescuela();" class="form-control select2" required>
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
								<select  name="nombre" id="nombre"  onchange="nombre_clave()" class="form-control select2" required>
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
								<select  name="ciclo_escolar" id="ciclo" onchange="" class="form-control select2" required>
									<option selected>
										Selecciona una opción
									</option>
									@foreach($tabla as $ciclo)
									<option value="{{$ciclo->ciclo}}_{{$ciclo->pago_director}}_{{$ciclo->pago_docente}}_{{$ciclo->pago_intendente}}">
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
								<select  name="director_regional" id="director_regional" onchange="dire_clave()" class="form-control select2" required>
									<option selected>
										Selecciona una opción
									</option>
									@foreach($directorio_regional as $director)
									<option value="{{$director->director_regional}}_{{$director->sostenimiento}}_{{$director->id}}">
										{{$director->director_regional}}
									</option>
										@endforeach
								</select>
								<div class="help-block with-errors"></div>
								<div class="text-danger" id='error_director_regional'>{{$errors->formulario->first('director_regional')}}</div>
							</div>
						</div><!--/form-group-->

						<div class="form-group">
							<label class="col-sm-3 control-label">Sostenimiento: <strog class="theme_color">*</strog></label>
							<div class="col-sm-6">
								<input name="sostenimiento" id="sostenimiento" disabled type="text"   class="form-control" required value="{{Input::old('sostenimiento')}}" />
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
								<input name="total"  disabled id="total" type="number"  class="form-control" required maxlength="3" min="1" max ="199" />
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
								<a href="{{url('/listas_asistencias')}}" class="btn btn-default"> Cancelar</a>
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


}

function nombre_clave() {
      var select2 = document.getElementById("nombre");
      var selectedOption2 = select2.selectedIndex;
     	var cantidadtotal = select2.value;
     	limite = "9",
      separador = "_",
      arregloDeSubCadenas = cantidadtotal.split(separador, limite);
     	cct=arregloDeSubCadenas[0];
     	categoria=arregloDeSubCadenas[1];
     	document.getElementById('categoria').value=categoria;
			alert(cantidadtotal);
}

function dire_clave() {
      var select2 = document.getElementById("director_regional");
      var selectedOption2 = select2.selectedIndex;
     	var cantidadtotal = select2.value;
     	limite = "9",
      separador = "_",
      arregloDeSubCadenas = cantidadtotal.split(separador, limite);
     	cct=arregloDeSubCadenas[0];
     	sostenimiento=arregloDeSubCadenas[1];
     	document.getElementById('sostenimiento').value=sostenimiento;
}

function calculadoradire() {
 var i= 0;
 var x = String(document.getElementById("categoria").value);
 var y = parseInt(document.getElementById("num_dias").value);

 var select2 = document.getElementById("ciclo");
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
var cct = document.getElementById("cct").value;
var route = "http://localhost:8000/traerpersonal/"+cct;

$.get(route,function(res){
  if(res.length > 0){
    for (var i = 0; i < res.length; i++) {
      if(res[i].estado =="ACTIVO"){
        var x = document.getElementById("nombre");
        var option = document.createElement("option");
        option.text = res[i].nombre +"-"+res[i].categoria;
        option.value = res[i].nombre;
				alert(route);
				x.add(option, x[i]);

      }
    }
  }

});
}


</script>

@endsection
