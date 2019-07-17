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

						<div id="smartwizard">
							<ul>
								<li><a href="#step-1">Datos de los Reintegros</a></li>
								<li><a href="#step-2">Información del Oficio</a></li>
								<li><a href="#step-3">Información del Oficio 2</a></li>
							</ul>
							<div>



			<div id="step-1" class="">
				<div class="user-profile-content">

					<div id="form-step-0" role="form" data-toggle="validator">
						<h3 class="h3titulo">Informacion de los Rintegros</h3>


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
								<input name="categoria" id="categoria" readonly type="text"   class="form-control" required value="{{Input::old('categoria')}}" />
							</div>
						</div>





						<div class="form-group">
							<label class="col-sm-3 control-label">Director Regional <strog class="theme_color">*</strog></label>
							<div class="col-sm-6">
								<select  name="id_directorio_regional" readonly id="id_directorio_regional" onchange="valida_dire();" class="form-control select2" required>



								</select>
								<div class="help-block with-errors"></div>
								<div class="text-danger" id='error_director_regional'>{{$errors->formulario->first('director_regional')}}</div>
							</div>
						</div>

						<div class="form-group" style="display: none">
							<label class="col-sm-3 control-label">Sostenimiento: <strog class="theme_color">*</strog></label>
							<div class="col-sm-6">
								<input name="id_reg" id="id_reg" disabled type="text"  class="form-control" required value="{{Input::old('id_reg')}}" />
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-3 control-label">Ciclo Escolar: <strog class="theme_color">*</strog></label>
							<div class="col-sm-6">
								<select name="ciclo_escolar" id="ciclo_escolar" onchange="valida_ciclore();" class="form-control select2" >
									<option selected>
										Selecciona una opción
									</option>

									@foreach($ciclos as $ciclo)
									<option value='{{$ciclo->ciclo}}'>
										{{$ciclo->ciclo}}
									</option>
									@endforeach
								</select>
								<div class="help-block with-errors"></div>
								<div class="text-danger" id='error_ciclo_escolar'>{{$errors->formulario->first('ciclo_escolar')}}</div>
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-3 control-label">Total de Dias: <strog class="theme_color">*</strog></label>
							<div class="col-sm-6">
								<input name="num_dias" id="num_dias" onchange="calcula();" onkeypress="return soloNumeros(event);" onkeyup="" type="text"   class="form-control" required value="{{Input::old('num_dias')}}" />
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-3 control-label">Total de Reclamo: <strog class="theme_color">*</strog></label>
							<div class="col-sm-6">
								<input name="total" id="total" type="text" readonly class="form-control" required value="{{Input::old('total')}}" />

							</div>
							<span id="errorUnidad" style="color:#FF0000;"></span>
						</div>

						<div class="form-group">
							<label class="col-sm-3 control-label">Total texto: <strog class="theme_color">*</strog></label>
							<div class="col-sm-6">
								<input name="total_text" id="total_text"  type="text" readonly  class="form-control" required value="{{Input::old('total_text')}}" />

							</div>

						</div>








					</div><!--validator-->
				</div><!--user-profile-content-->
			</div><!--step-1-->

			<div id="step-2" class="">
				<div class="user-profile-content">
					<div id="form-step-1" role="form" data-toggle="validator">
						<h3 class="h3titulo">Información del Oficio</h3>

					<!--	<div class="form-group">
							<label class="col-sm-3 control-label">Correo enlace <strog class="theme_color">*</strog></label>
							<div class="col-sm-6">
								<select name="ciclo" class="form-control" required>

								</select>
								<div class="help-block with-errors"></div>
							</div>
						</div>--><!--/form-group-->


						<div class="form-group">
							<label class="col-sm-3 control-label">Dirigido Para: <strog class="theme_color">*</strog></label>
							<div class="col-sm-6">
								<input name="dirigido_a" id="dirigido_a" readonly type="text"  class="form-control" required value="{{Input::old('dirigido_a')}}" />


							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-3 control-label">Nombre de la Cuenta: <strog class="theme_color">*</strog></label>
							<div class="col-sm-6">
								<select name="id_cuenta" id="id_cuenta" onchange="cuenta();cuentabanco();" class="form-control" select2 >
									<option selected>
										Selecciona una opción
									</option>

									@foreach($cuentas as $cuenta)
									<option value='{{$cuenta->id}}_{{$cuenta->nombre}}_{{$cuenta->num_cuenta}}_{{$cuenta->clave_in}}_{{$cuenta->secretaria}}'>
										{{$cuenta->nombre}}
									</option>
									@endforeach
								</select>
								<div class="help-block with-errors"></div>
								<div class="text-danger" id='error_cuenta'>{{$errors->formulario->first('cuenta')}}</div>
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-3 control-label">Num Cuenta: <strog class="theme_color">*</strog></label>
							<div class="col-sm-6">
								<input name="num_cuenta" id="num_cuenta" readonly type="text"  class="form-control" required value="{{Input::old('num_cuenta')}}" />
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-3 control-label">Clave Interbancaria: <strog class="theme_color">*</strog></label>
							<div class="col-sm-6">
								<input name="clave_in" id="clave_in" readonly type="text"  class="form-control" required value="{{Input::old('clave_in')}}" />
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-3 control-label">Secretaria: <strog class="theme_color">*</strog></label>
							<div class="col-sm-6">
								<input name="secretaria" id="secretaria" readonly type="text"  class="form-control" required value="{{Input::old('secretaria')}}" />
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-3 control-label">Banco: <strog class="theme_color">*</strog></label>
							<div class="col-sm-6">
								<select name="id_banco" id="id_banco" readonly class="form-control" >



								</select>
							</div>
						</div>


						<div class="form-group">
							<label class="col-sm-3 control-label">C.c.p: <strog class="theme_color">*</strog></label>
							<div class="col-sm-6">
								<select name="ccp" id="ccp"  class="form-control select">
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
				<div id="form-step-2" role="form" data-toggle="validator">
						<h3 class="h3titulo">Información del Oficio 2</h3>


							<div class="form-group">
								<label class="col-sm-3 control-label">N° Oficio: <strog class="theme_color">*</strog></label>
								<div class="col-sm-6">
									<input onchange="num_ofi();" maxlength="3" minlength="3" name="oficio_aux" onkeypress="return soloNumeros(event)" id="oficio_aux" class="form-control" required />
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
									<textarea  name="motivo" type="text" id="motivo" class="form-control" required vonKeyUp="document.getElementById(this.id).value=document.getElementById(this.id).value.toUpperCase()" rows="10" cols="30">debido a que... Escriba el motivo del reintegro.</textarea>
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
									<select name="genero" id="genero" onchange="valida_gen();" class="form-control select">
										<option selected>
											Selecciona una opción
										</option>

										@foreach($genero as $genero)
										<option value='{{$genero->abrebiatura}}_{{$genero->id}}'>
											{{$genero->nombre}}
										</option>
										@endforeach
									</select>
									<div class="help-block with-errors"></div>
									<div class="text-danger" id='error_genero'>{{$errors->formulario->first('genero')}}</div>
								</div>
							</div>

							<br> <br>

								<div class="form-group">
								<label class="col-sm-3 control-label">Fecha del Oficio: <strog class="theme_color">*</strog></label>
								<div class="col-sm-6">
									<input name="fecha" type="date" id="fecha"   class="form-control" required />
								</div>
							</div>




							<div class="form-group">
								<div class="col-sm-offset-7 col-sm-5">
									<button type="submit" id="submit" disabled="true" class="btn btn-primary">Guardar</button>
									<a href="{{url('/reintegros')}}" class="btn btn-default"> Cancelar</a>
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
				valida_cctre();
				valida_nom();
				valida_ciclore();
				valida_gen();




}

/////////NUMEROS A LETRAS////////////////////////////////////
function numero() {
	// Obtener valor que hay en el input
	let valor = document.getElementById('total').value;
	var texto = document.getElementById('total_text');
	// Simple validación


	// Obtener la representación
	let letras = numeroALetras(valor, {
		plural: "PESOS",
		singular: "PESO",
		centPlural: "CENTAVOS",
		centSingular: "CENTAVO"
	});

	// Y a la salida ponerle el resultado
	document.getElementById('total_text').value=letras;
	console.log(document.getElementById('total_text').value);
	console.log(document.getElementById('total').value);
}


var numeroALetras = (function() {

// Código basado en https://gist.github.com/alfchee/e563340276f89b22042a
    function Unidades(num){

        switch(num)
        {
            case 1: return 'UN';
            case 2: return 'DOS';
            case 3: return 'TRES';
            case 4: return 'CUATRO';
            case 5: return 'CINCO';
            case 6: return 'SEIS';
            case 7: return 'SIETE';
            case 8: return 'OCHO';
            case 9: return 'NUEVE';
        }

        return '';
    }//Unidades()

    function Decenas(num){

        let decena = Math.floor(num/10);
        let unidad = num - (decena * 10);

        switch(decena)
        {
            case 1:
                switch(unidad)
                {
                    case 0: return 'DIEZ';
                    case 1: return 'ONCE';
                    case 2: return 'DOCE';
                    case 3: return 'TRECE';
                    case 4: return 'CATORCE';
                    case 5: return 'QUINCE';
                    default: return 'DIECI' + Unidades(unidad);
                }
            case 2:
                switch(unidad)
                {
                    case 0: return 'VEINTE';
                    default: return 'VEINTI' + Unidades(unidad);
                }
            case 3: return DecenasY('TREINTA', unidad);
            case 4: return DecenasY('CUARENTA', unidad);
            case 5: return DecenasY('CINCUENTA', unidad);
            case 6: return DecenasY('SESENTA', unidad);
            case 7: return DecenasY('SETENTA', unidad);
            case 8: return DecenasY('OCHENTA', unidad);
            case 9: return DecenasY('NOVENTA', unidad);
            case 0: return Unidades(unidad);
        }
    }//Unidades()

    function DecenasY(strSin, numUnidades) {
        if (numUnidades > 0)
            return strSin + ' Y ' + Unidades(numUnidades)

        return strSin;
    }//DecenasY()

    function Centenas(num) {
        let centenas = Math.floor(num / 100);
        let decenas = num - (centenas * 100);

        switch(centenas)
        {
            case 1:
                if (decenas > 0)
                    return 'CIENTO ' + Decenas(decenas);
                return 'CIEN';
            case 2: return 'DOSCIENTOS ' + Decenas(decenas);
            case 3: return 'TRESCIENTOS ' + Decenas(decenas);
            case 4: return 'CUATROCIENTOS ' + Decenas(decenas);
            case 5: return 'QUINIENTOS ' + Decenas(decenas);
            case 6: return 'SEISCIENTOS ' + Decenas(decenas);
            case 7: return 'SETECIENTOS ' + Decenas(decenas);
            case 8: return 'OCHOCIENTOS ' + Decenas(decenas);
            case 9: return 'NOVECIENTOS ' + Decenas(decenas);
        }

        return Decenas(decenas);
    }//Centenas()

    function Seccion(num, divisor, strSingular, strPlural) {
        let cientos = Math.floor(num / divisor)
        let resto = num - (cientos * divisor)

        let letras = '';

        if (cientos > 0)
            if (cientos > 1)
                letras = Centenas(cientos) + ' ' + strPlural;
            else
                letras = strSingular;

        if (resto > 0)
            letras += '';

        return letras;
    }//Seccion()

    function Miles(num) {
        let divisor = 1000;
        let cientos = Math.floor(num / divisor)
        let resto = num - (cientos * divisor)

        let strMiles = Seccion(num, divisor, 'UN MIL', 'MIL');
        let strCentenas = Centenas(resto);

        if(strMiles == '')
            return strCentenas;

        return strMiles + ' ' + strCentenas;
    }//Miles()

    function Millones(num) {
        let divisor = 1000000;
        let cientos = Math.floor(num / divisor)
        let resto = num - (cientos * divisor)

        let strMillones = Seccion(num, divisor, 'UN MILLON DE', 'MILLONES DE');
        let strMiles = Miles(resto);

        if(strMillones == '')
            return strMiles;

        return strMillones + ' ' + strMiles;
    }//Millones()

    return function NumeroALetras(num, currency) {
        currency = currency || {};
        let data = {
            numero: num,
            enteros: Math.floor(num),
            centavos: (((Math.round(num * 100)) - (Math.floor(num) * 100))),
            letrasCentavos: '',
            letrasMonedaPlural: currency.plural || 'PESOS ',//'PESOS', 'Dólares', 'Bolívares', 'etcs'
            letrasMonedaSingular: currency.singular || 'PESO', //'PESO', 'Dólar', 'Bolivar', 'etc'
            letrasMonedaCentavoPlural: currency.centPlural || 'CENTAVOS',
            letrasMonedaCentavoSingular: currency.centSingular || 'CENTAVO'
        };

        if (data.centavos > 0) {
            data.letrasCentavos = 'CON ' + (function () {
                    if (data.centavos == 1)
                        return Millones(data.centavos) + ' ' + data.letrasMonedaCentavoSingular;
                    else
                        return Millones(data.centavos) + ' ' + data.letrasMonedaCentavoPlural;
                })();
        };

        if(data.enteros == 0)
            return 'CERO ' + data.letrasMonedaPlural + ' ' + data.letrasCentavos;
        if (data.enteros == 1)
            return Millones(data.enteros) + ' ' + data.letrasMonedaSingular + ' ' + data.letrasCentavos;
        else
            return Millones(data.enteros) + ' ' + data.letrasMonedaPlural + ' ' + data.letrasCentavos;
    };

})();

// Modo de uso: 500,34 USD
numeroALetras(200.58, {
  plural: 'Pesos',
  singular: 'Pesos',
  centPlural: 'centavos',
  centSingular: 'centavo'
});

///////////////////////////////////////////////////////////



function valida_cctre() {
		if( document.getElementById('id_centro_trabajo').value == "Selecciona una opción"){
		//	swal("ERROR!","Selecciona tipo se puesto","error");
			document.getElementById('id_captura').disabled=true;

			document.getElementById('ciclo_escolar').disabled=true;
			document.getElementById('num_dias').disabled=true;
			document.getElementById('genero').disabled=true;

			document.getElementById("error_cct").innerHTML = "Seleccione una opción para habilitar los otros campos.";
			return false
		}else if(document.getElementById('id_centro_trabajo').value != "Selecciona una opción"){
			document.getElementById('id_captura').disabled=false;

		}
}

function valida_nom() {
			if( document.getElementById('id_captura').value == "Selecciona una opción"){
			//	swal("ERROR!","Selecciona tipo se puesto","error");

				document.getElementById("error_nombre").innerHTML = "Seleccione una opción.";
				return false
			}else if(document.getElementById('id_captura').value != "Selecciona una opción"){
				document.getElementById('ciclo_escolar').disabled=false;

			}
}




function valida_dire() {
			if( document.getElementById('id_directorio_regional').value == "Selecciona una opción"){
			//	swal("ERROR!","Selecciona tipo se puesto","error");

				document.getElementById("error_director_regional").innerHTML = "Seleccione una opción.";
				return false
			}else if(document.getElementById('id_directorio_regional').value != "Selecciona una opción"){



			}
}

function valida_ciclore() {
			if( document.getElementById('ciclo_escolar').value == "Selecciona una opción"){
			//	swal("ERROR!","Selecciona tipo se puesto","error");

				document.getElementById("error_ciclo_escolar").innerHTML = "Seleccione una opción.";
				return false
			}else if(document.getElementById('ciclo_escolar').value != "Selecciona una opción"){
				document.getElementById('num_dias').disabled=false;
					document.getElementById('genero').disabled=false;


			}

}

function valida_gen() {
			if( document.getElementById('genero').value == "Selecciona una opción"){
			//	swal("ERROR!","Selecciona tipo se puesto","error");

				document.getElementById("error_genero").innerHTML = "Seleccione una opción.";
				return false
			}else if(document.getElementById('genero').value != "Selecciona una opción"){

					document.getElementById('submit').disabled=false;

			}

}



function calcula(){
  var dias = document.getElementById('num_dias').value;
  var categoria = document.getElementById('categoria').value;
  var monto = document.getElementById('total').value;
  var ciclo = document.getElementById('ciclo_escolar').value;

  var route = "http://localhost:8000/calcular_reclamo/"+dias+"/"+categoria+"/"+ciclo;
  $.get(route,function(res){
    document.getElementById('total').value = res;
		numero();
	});

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

function cuenta() {
      var select2 = document.getElementById("id_cuenta");
      var selectedOption2 = select2.selectedIndex;
     	var cantidadtotal = select2.value;
     	limite = "9",
      separador = "_",
      arregloDeSubCadenas = cantidadtotal.split(separador, limite);
     	cct=arregloDeSubCadenas[0];
     	num_cuenta=arregloDeSubCadenas[2];
			clave_in=arregloDeSubCadenas[3];
			secretaria=arregloDeSubCadenas[4];
		//	id_banco=arregloDeSubCadenas[5];
     	document.getElementById('num_cuenta').value=num_cuenta;
			document.getElementById('clave_in').value=clave_in;
			document.getElementById('secretaria').value=secretaria;
		//	document.getElementById('id_banco').value=id_banco;
}


function cuentabanco(){


	var select2 = document.getElementById("id_cuenta");
	var selectedOption2 = select2.selectedIndex;
	var cantidadtotal = select2.value;
	limite = "9",
	separador = "_",
	arregloDeSubCadenas = cantidadtotal.split(separador, limite);
	banco=arregloDeSubCadenas[0];

var route = "http://localhost:8000/banco/"+banco;

$.get(route,function(res){
  if(res.length > 0){

    for (var i = 0; i < res.length; i++) {
      if(res[i].estado =="ACTIVO"){
        var x = document.getElementById("id_banco");
        var option = document.createElement("option");
        option.text = res[i].nombre_banco;
        option.value = res[i].nombre_banco +"_"+res[i].id;
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
			document.getElementById('dirigido_a').value=cct;
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

function num_ofi(){
	var ciclo = document.getElementById('ciclo_escolar').value;
	var x= document.getElementById('oficio_aux').value;
	var route = "http://localhost:8000/buscar_oficio/"+x+"/"+ciclo;

	$.get(route,function(res){
		if(res.length > 0){
		 swal("Alerta!", "Este Oficio Ya se ha Registrado Anteriormente!", "error");
		 document.getElementById('submit').disabled= true;
		 return false;
	 }else{
		var fecha = new Date();
		var ano = fecha.getFullYear();
		document.getElementById('oficio').value = "SA/DFE/DHA/ETC.-"+x+"/"+ano;
		document.getElementById('submit').disabled= false;

	}
});
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
          		var r = document.getElementById("total").value;
          		if(r < 1){
          			return false;
          		}

          	}else if (stepNumber == 1){



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
