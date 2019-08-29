
function mayus(e) {

  var tecla=e.value;
  var tecla2=tecla.toUpperCase();
}


function soloLetras(e){
  key = e.keyCode || e.which;
  tecla = String.fromCharCode(key).toLowerCase();
  letras = " áéíóúabcdefghijklmnñopqrstuvwxyz.";
  especiales = "8-37-39-46";

  tecla_especial = false
  for(var i in especiales){
    if(key == especiales[i]){
      tecla_especial = true;
      break;
    }
  }

  if(letras.indexOf(tecla)==-1 && !tecla_especial){
    return false;
  }
}


function soloNumeros(e){
  key = e.keyCode || e.which;
  tecla = String.fromCharCode(key);
  letras = " 1,2,3,4,5,6,7,8,9,0,.";
  especiales = "8-37-39-46";

  tecla_especial = false
  for(var i in especiales){
    if(key == especiales[i]){
      tecla_especial = true;
      break;
    }
  }

  if(letras.indexOf(tecla)==-1 && !tecla_especial){
    return false;
  }
}


function curp2date() {
  var miCurp =document.getElementById('curp').value;
  var m = miCurp.match( /^\w{4}(\w{2})(\w{2})(\w{2})/
    );


  var anyo = parseInt(m[1],10)+1900;
  if( anyo < 1950 ) anyo += 100;
  var mes = parseInt(m[2], 10)-1;
  var dia = parseInt(m[3], 10);

  var fech = new Date( anyo, mes, dia );

  document.getElementById("fechaNacimiento").value = fech;

}


Date.prototype.toString = function() {
  var anyo = this.getFullYear();
  var mes = this.getMonth()+1;
  if( mes<=9 ) mes = "0"+mes;
  var dia = this.getDate();
  if( dia<=9 ) dia = "0"+dia;
  return dia+"/"+mes+"/"+anyo;
}


function myCreateFunction() {

  var select = document.getElementById("rol");
  var options=document.getElementsByTagName("option");
  var idRol= select.value;

  var x = select.options[select.selectedIndex].text;


  if(!validarRolesDuplicadosCrear(x)){
    document.getElementById("errorRoles").innerHTML = "";
    var fila="<tr><td style=\"display:none;\"><input name=\"idRol[]\" value=\""+idRol+"\">"
    +"</td><td colspan=\"2\">"+x+"</td>"
    +""+
    "<td>"+
    " <button type=\"button\"  onclick=\"myDeleteFunction(this)\" class=\"btn btn-danger btn-icon\"> Quitar<i class=\"fa fa-times\"></i> </button>"
    +"</td>";
    var btn = document.createElement("TR");
    btn.innerHTML=fila;
    document.getElementById("myTable").appendChild(btn);
    validarRolesCrear();
  } else {
    document.getElementById("errorRoles").innerHTML = "Rol que intentas ingresar ya pertenece a el empleado";
  }

}

function myDeleteFunction(t) {
  var td = t.parentNode;
  var tr = td.parentNode;
  var table = tr.parentNode;
  table.removeChild(tr);

}

function myDeleteFunction1(btn) {

  var route = "http://localhost:8000/eliminarRolEmpleado/"+btn.value+"";
  var token = $("#token").val();

  $.ajax({
    url: route,
    headers: {'X-CSRF-TOKEN': token},
    type: 'get',
    dataType: 'json',
    success: function(){
      $("#msj-success").fadeIn();
    }
  });

}









function doSearch()
{
  var tableReg = document.getElementById('datos');
  var searchText = document.getElementById('searchTerm').value.toLowerCase();
  var cellsOfRow="";
  var found=false;
  var compareWith="";

      // Recorremos todas las filas con contenido de la tabla
      for (var i = 1; i < tableReg.rows.length; i++)
      {
        cellsOfRow = tableReg.rows[i].getElementsByTagName('td');
        found = false;
        // Recorremos todas las celdas
        for (var j = 0; j < cellsOfRow.length && !found; j++)
        {
          compareWith = cellsOfRow[j].innerHTML.toLowerCase();
          // Buscamos el texto en el contenido de la celda
          if (searchText.length == 0 || (compareWith.indexOf(searchText) > -1))
          {
            found = true;
          }
        }
        if(found)
        {
          tableReg.rows[i].style.display = '';
        } else {
          // si no ha encontrado ninguna coincidencia, esconde la
          // fila de la tabla
          tableReg.rows[i].style.display = 'none';
        }
      }
    }









//Validacion empresas de  proveedores

   //Aqui termina validacion de  empresas de proveedor

   ///////////////////
   //Aqui comienza la  validacion de bancos
   /////
   function  validarBanco(){

     var nombre =document.getElementById('nombre').value;
     var oculto =document.getElementById('oculto').value;

     var route = "http://localhost:8000/validarBanco/"+nombre;

     $.get(route,function(res){
      if(res.length > 0  &&  res[0].estado =="Inactivo"){
       document.getElementById('submit').disabled=true;
       var idBanco = res[0].id;
       document.getElementById("idBanco").value= idBanco;
       $("#modal-reactivar").modal();

     }
     else if (res.length > 0  &&  res[0].estado =="Activo"  && res[0].nombre != oculto )  {

      document.getElementById("errorNombre").innerHTML = "El banco que  intenta registrar ya existe en el sistema";
      document.getElementById('submit').disabled=true;

    }
    else {
      document.getElementById("errorNombre").innerHTML = "";
      document.getElementById('submit').disabled=false;

    }
  });

   }


/////////////////////////////
//Comienza la  validacion de Transportes
/////////////////
//Validacion de Placas
////////////////

function  validarPlacas(){

  var placa =document.getElementById('placas').value;
  var ocultoPlaca =document.getElementById('ocultoPlaca').value;
  var route = "http://localhost:8000/validarPlacas/"+placa;



  $.get(route,function(res){

    if(res.length > 0  &&  res[0].estado =="Inactivo"){
     document.getElementById('submit').disabled=true;
     var idVehiculo = res[0].id;
     document.getElementById("idVehiculo").value= idVehiculo;

     $("#modal-reactivar").modal();

   }
   else if (res.length > 0  &&  res[0].estado =="Activo"  && res[0].placas != ocultoPlaca )  {


    document.getElementById("errorPlaca").innerHTML = "El vehiculo que  intenta registrar ya existe en el sistema";
    document.getElementById('submit').disabled=true;

  }
  else {
    console.log(res.length);
    console.log("ERROR NULO");
    document.getElementById("errorPlaca").innerHTML = "";
    document.getElementById('submit').disabled=false;

  }
});

}
////////////////////////
///Validacion de Numero de  Serie
///////////////////////

function  validarNumeroSerie(){

  var serie =document.getElementById('no_serie').value;
  var ocultoSerie =document.getElementById('ocultoSerie').value;
  var route = "http://localhost:8000/validarPlacas/"+serie;



  $.get(route,function(res){

    if(res.length > 0  &&  res[0].estado =="Inactivo"){
     document.getElementById('submit').disabled=true;
     var idVehiculo = res[0].id;
     document.getElementById("idVehiculo").value= idVehiculo;

     $("#modal-reactivar").modal();

   }
   else if (res.length > 0  &&  res[0].estado =="Activo"  && res[0].no_Serie != ocultoSerie )  {


    document.getElementById("errorSerie").innerHTML = "El vehiculo que  intenta registrar ya existe en el sistema";
    document.getElementById('submit').disabled=true;

  }
  else {

    document.getElementById("errorSerie").innerHTML = "";
    document.getElementById('submit').disabled=false;

  }
});

}



function  validarCURP(){

  var curp =document.getElementById('curp').value;
  var curpOculta =document.getElementById('curpOculta').value;
  var route = "http://localhost:8000/validarCURP/"+curp;

  $.get(route,function(res){


    if(res.length > 0  &&  res[0].estado =="Inactivo"){
     document.getElementById('submit').disabled=true;
     var idEmpleado= res[0].id;


     document.getElementById("idEmpleadoModal").value= idEmpleado;

     $("#modal-reactivar").modal();

   }
   else if (res.length > 0  &&  res[0].estado =="Activo"  && res[0].curp != curpOculta )  {

     var tipo = res[0].tipo;
     if(tipo ==  "NORMAL"){
       document.getElementById("errorCURP").innerHTML = "El empleado que  intenta registrar ya existe en el sistema  y es un empleado de tipo  \"CONFIANZA\"";

     } else {
      document.getElementById("errorCURP").innerHTML = "El empleado que  intenta registrar ya existe en el sistema  y es un empleado de tipo  \"CONTRATADO\"";
    }
    document.getElementById('submit').disabled=true;
  }
  else {

    document.getElementById("errorCURP").innerHTML = "";
    document.getElementById('submit').disabled=false;

  }
});


}

//////////////////////////////////////////////////////////////////
//Validar  empelado por numero de seguro social
/////////////////////////////////


function  validarSSN(){

  var numero_Seguro_Social =document.getElementById('numero_Seguro_Social').value;
  var ssnOculta =document.getElementById('SSNOculto').value;
  var route = "http://localhost:8000/validarCURP/"+numero_Seguro_Social;

  $.get(route,function(res){


    if(res.length > 0  &&  res[0].estado =="Inactivo"){
     document.getElementById('submit').disabled=true;
     var idEmpleado= res[0].id;


     document.getElementById("idEmpleadoModal").value= idEmpleado;

     $("#modal-reactivar").modal();

   }
   else if (res.length > 0  &&  res[0].estado =="Activo"  && res[0].curp != ssnOculta )  {

     var tipo = res[0].tipo;
     if(tipo ==  "NORMAL"){
       document.getElementById("errorSSN").innerHTML = "El empleado que  intenta registrar ya existe en el sistema  y es un empleado de tipo  \"CONFIANZA\"";

     } else {
      document.getElementById("errorSSN").innerHTML = "El empleado que  intenta registrar ya existe en el sistema  y es un empleado de tipo  \"CONTRATADO\"";
    }
    document.getElementById('submit').disabled=true;
  }
  else {

    document.getElementById("errorCURP").innerHTML = "";
    document.getElementById('submit').disabled=false;

  }
});


}








function quitarEspacios(e) {
  e.value = e.value.replace(/([\ \t]+(?=[\ \t])|^\s+|\s+$)/g, '');
}






function valida_montos() {

  var x= document.getElementById("pago_director").value;
  var y= document.getElementById("pago_docente").value;
  var z= document.getElementById("pago_intendente").value;

  if(parseInt(z) >= parseInt(y)){
    swal("Error!", "El Intendente No puede Ganar más o Igual que el Docente ", "error");
    return false;
  }else if(parseInt(z) >= parseInt(x)){
    swal("Error!", "El Intendente No puede Ganar más o Igual que el Director ", "error");
    return false;
  }else if(parseInt(y) >= parseInt(x)){
   swal("Error!", "El Docente No puede Ganar más o Igual que el Director ", "error");
   return false;
 }
}

function calculadora() {
 var i= 0;
 var x = String(document.getElementById("cat2").value);
 var y = parseInt(document.getElementById("diast").value);

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

 if(x == "Director"){
  document.getElementById("dias").value=pago_director;
  document.getElementById("total").value=pago_director * y

}else if (x == "Docente") {
  document.getElementById("dias").value=pago_docente;
  document.getElementById("total").value=pago_docente * y
}else{
  document.getElementById("dias").value=pago_intendente;
  document.getElementById("total").value=pago_intendente * y
}

}


function claves() {
 var select2 = document.getElementById("cct");
 var selectedOption2 = select2.selectedIndex;
 var cantidadtotal = select2.value;
 limite = "9",
 separador = "_",
 arregloDeSubCadenas = cantidadtotal.split(separador, limite);
 cct=arregloDeSubCadenas[0];
 escuela=arregloDeSubCadenas[1];
 document.getElementById('escuela').value=escuela;
}



function centros_verifica(){
  var x = parseInt(document.getElementById('alumnos').value);
  var y = parseInt(document.getElementById('ninos').value);
  var z = parseInt(document.getElementById('ninas').value);

  var nivel = String(document.getElementById('nivel').value);
  var grupo = parseInt(document.getElementById('grupos').value);
  var total_int_prees = Math.ceil(grupo / 3);
  var total_int_prima = Math.ceil(grupo / 6);
  var suma = y +z;

  var int = parseInt(document.getElementById('intendente').value);
  if(x > suma || x < suma){
   swal("Error!", "La Suma Total de Alumnos, debe ser Igual que la Suma de Niños y Niñas ", "error");
   document.getElementById('alumnos').focus();
   return false
 }

 if (nivel == "PREESCOLAR" &&  int > total_int_prees){
  swal("Error!", "El Número Maximo de Intendentes Permitidos En PREESCOLARES es de 1 por Cada 3 Grupos", "error");
  return false
  document.getElementById("intendente").focus();
}
else if(nivel == "PRIMARIA" && int > total_int_prima ){
  swal("Error!", "El Número Maximo de Intendentes Permitidos En PRIMARIAS es de 1 por Cada 6 Grupos", "error");
  return false
  document.getElementById("intendente").focus();
}
else if (nivel == "TELESECUNDARIA" &&  int > total_int_prees){
  swal("Error!", "El Número Maximo de Intendentes Permitidos En TELESECUNDARIAS es de 1 por Cada 3 Grupos", "error");
  return false
  document.getElementById("intendente").focus();
}

if(grupo == 1){
  document.getElementById('organizacion').value = "UNITARIA";
}else if(grupo == 2){
  document.getElementById('organizacion').value = "BIDOCENTE";
}else if(grupo == 3){
  document.getElementById('organizacion').value = "TRIDOCENTE";
}else if(grupo == 4){
  document.getElementById('organizacion').value = "TETRADOCENTE";
}else if(grupo == 5){
  document.getElementById('organizacion').value = "PENTADOCENTE";
}else if(grupo >= 6 ){
  document.getElementById('organizacion').value = "COMPLETA";
}
}


//////////////////////////////////////////////////7/*Validaciones Nomina capturada*/////////////////////////////////////////7

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

//Función para validar un RFC
// Devuelve el RFC sin espacios ni guiones si es correcto
// Devuelve false si es inválido
// (debe estar en mayúsculas, guiones y espacios intermedios opcionales)
function rfcValido(rfc, aceptarGenerico = true) {
  const re       = /^([A-ZÑ&]{3,4}) ?(?:- ?)?(\d{2}(?:0[1-9]|1[0-2])(?:0[1-9]|[12]\d|3[01])) ?(?:- ?)?([A-Z\d]{2})([A\d])$/;
  var   validado = rfc.match(re);

    if (!validado)  //Coincide con el formato general del regex?
      return false;

    //Separar el dígito verificador del resto del RFC
    const digitoVerificador = validado.pop(),
    rfcSinDigito      = validado.slice(1).join(''),
    len               = rfcSinDigito.length,

    //Obtener el digito esperado
    diccionario       = "0123456789ABCDEFGHIJKLMN&OPQRSTUVWXYZ Ñ",
    indice            = len + 1;
    var   suma,
    digitoEsperado;

    if (len == 12) suma = 0
    else suma = 481; //Ajuste para persona moral

  for(var i=0; i<len; i++)
    suma += diccionario.indexOf(rfcSinDigito.charAt(i)) * (indice - i);
  digitoEsperado = 11 - suma % 11;
  if (digitoEsperado == 11) digitoEsperado = 0;
  else if (digitoEsperado == 10) digitoEsperado = "A";

    //El dígito verificador coincide con el esperado?
    // o es un RFC Genérico (ventas a público general)?
    if ((digitoVerificador != digitoEsperado)
     && (!aceptarGenerico || rfcSinDigito + digitoVerificador != "XAXX010101000"))
      return false;
    else if (!aceptarGenerico && rfcSinDigito + digitoVerificador == "XEXX010101000")
      return false;
    return rfcSinDigito + digitoVerificador;
  }


//Handler para el evento cuando cambia el input
// -Lleva la RFC a mayúsculas para validarlo
// -Elimina los espacios que pueda tener antes o después
function validarInput(input) {
  var rfc         = input.value.trim().toUpperCase(),
  resultado   = document.getElementById("resultado"),
  valido;

    var rfcCorrecto = rfcValido(rfc);   // ⬅️ Acá se comprueba

    if (rfcCorrecto) {
      document.getElementById("error_rfc").innerHTML = "";
      document.getElementById("error_rfc").value = "0";
      document.getElementById('submit3').disabled=false;
      valido = "Válido";
      resultado.classList.add("ok");
    } else {
      document.getElementById("error_rfc").innerHTML = "RFC Incorrecto";
      document.getElementById("error_rfc").value = "1";
      document.getElementById('submit3').disabled=true;
      valido = "No válido-Compruebe el RFC";
      resultado.classList.remove("ok");

    }

    resultado.innerText = "RFC: " + rfc
    + "\nResultado: " + rfcCorrecto
    + "\nFormato: " + valido;
  }

  function personal_verifica(){
    var x = document.getElementById('error_rfc').value;
    if (x == 1 ){

      swal("Error!", "Verifique el RFC", "error");
      return false;
    }
  }

  function  validarRFC(){
    var rfc =document.getElementById('rfc_input').value;
    var oculto =document.getElementById('oculto').value;
    var route = "http://localhost:8000/validarpersonal/"+rfc;

    $.get(route,function(res){
      if(res.length > 0  &&  res[0].estado =="INACTIVO"){
       document.getElementById('submit3').disabled=true;
       var idCliente = res[0].id;
       document.getElementById("idCliente").value= idCliente;
       $("#modal-reactivar").modal();

     }
     else if (res.length > 0  &&  res[0].estado =="ACTIVO"  && res[0].rfc != oculto )  {

      document.getElementById("error_rfc").innerHTML = "EL RFC QUE INTENTA REGISTRAR YA SE ENCUENTRA ACTIVO EN EL SISTEMA";
      document.getElementById("error_rfc").value = "1";
      document.getElementById('submit3').disabled=true;

    }
    else {
      document.getElementById("error_rfc").innerHTML = "";
      document.getElementById('submit3').disabled=false;
    //  document.getElementById("error_rfc").value = "0";

  }
});

  }

  function captura_personal(){

    var aux =document.getElementById('movimiento').value;
    var cct =document.getElementById('cct').value;
    var categoria=document.getElementById('puesto').value;

    if(aux == "ALTA"){
      document.getElementById('docente_cu').style.display = 'block';
      document.getElementById('docente_cubrir').required = true
 //   document.getElementById('docente_cubrir').style.display = 'none';
 var route = "http://localhost:8000/validarcaptura/"+cct+"/"+categoria;

 limpiar_input();
 verifica_clave();

 $.get(route,function(res){
  if(res.length > 0){
    for (var i = 0; i < res.length; i++) {
      if(res[i].estado =="ACTIVO"){
        var x = document.getElementById("docente_cubrir");
        var option = document.createElement("option");
        option.text = res[i].nombre +"-"+res[i].rfc;
        option.value = res[i].id;
        x.add(option, x[i])
        document.getElementById('error_movimiento').innerHTML= "";
        document.getElementById('error_movimiento').value= "0";
      }
    }
  }else{
    limpiar_input();
    document.getElementById('error_movimiento').innerHTML= "NO SE ENCUENTRA REGISTRADO NINGUN EMPLEADO EN ESTA CATEGORIA, NECESITA AGREGARLO COMO NUEVO RECURSO PARA PODER CONTINUAR";
    document.getElementById('error_movimiento').value= "1";
  }
});
}else if(aux == "NUEVO"){
  document.getElementById('docente_cu').style.display = 'none';
  document.getElementById('docente_cubrir').required = false;
  var route2 = "http://localhost:8000/validarnuevor/"+cct+"/"+categoria;
  verifica_clave();

  $.get(route2,function(res){
    var total = res.length;
    if(res.length > 0){

      if(categoria == "DIRECTOR"){
        document.getElementById('error_movimiento').innerHTML= "SE ENCUENTRA REGISTRADO UN DIRECTOR ACTUALMENTE EN ESTE CTE, NECESITA AGREGARLO COMO ALTA PARA PODER CONTINUAR";
        swal("Error!", "SE ENCUENTRA REGISTRADO UN DIRECTOR ACTUALMENTE EN ESTE CTE ( "+res[0].nombre+" ), NECESITA AGREGARLO COMO ALTA PARA PODER CONTINUAR", "error");
        document.getElementById('error_movimiento').value= "1";
      }
      else if(categoria == "INTENDENTE"){
        var nivel = res[0].nivel;
        var tot_gru = res[0].total_grupos;
       // var suma_tot = tot_gru *
       var total_int_prees = Math.ceil(tot_gru / 3);
       var total_int_prima = Math.ceil(tot_gru / 6);
       //alert(total_int_prees);

       if (nivel == "PREESCOLAR"){
        if (res.length > total_int_prees){
          swal("Error!", "El Número Maximo de Intendentes Permitidos En PREESCOLARES es de 1 por Cada 3 Grupos, Se Detecto que se Encuentran "+res.length+" Intendentes Ya Registrados en este CTE", "error");
          document.getElementById('error_movimiento').innerHTML= "El Número Maximo de Intendentes Permitidos En PREESCOLARES es de 1 por Cada 3 Grupos, NECESITA AGREGARLO COMO ALTA PARA PODER CONTINUAR";
          document.getElementById('error_movimiento').value= "1";
        }}
        else if(nivel == "PRIMARIA" ){
          if (res.length > total_int_prima ){
            swal("Error!", "El Número Maximo de Intendentes Permitidos En PRIMARIAS es de 1 por Cada 6 Grupos Se Detecto que se Encuentran "+res.length+" Intendentes Ya Registrados en este CTE", "error");
            document.getElementById('error_movimiento').innerHTML= "El Número Maximo de Intendentes Permitidos En PRIMARIAS es de 1 por Cada 6 Grupos, NECESITA AGREGARLO COMO ALTA PARA PODER CONTINUAR";
            document.getElementById('error_movimiento').value= "1";
          }}
          else if (nivel == "TELESECUNDARIA" ){
           if ( res.length > total_int_prees){
            swal("Error!", "El Número Maximo de Intendentes Permitidos En TELESECUNDARIAS es de 1 por Cada 3 Grupos Se Detecto que se Encuentran "+res.length+" Intendentes Ya Registrados en este CTE", "error");
            document.getElementById('error_movimiento').innerHTML= "El Número Maximo de Intendentes Permitidos En TELESECUNDARIAS es de 1 por Cada 3 Grupos, NECESITA AGREGARLO COMO ALTA PARA PODER CONTINUAR";
            document.getElementById('error_movimiento').value= "1";
          }
        }
      }
    }else{
      document.getElementById('error_movimiento').innerHTML= "";
      document.getElementById('error_movimiento').value= "0";

    }
  });
}else if(aux == "INICIO"){
  document.getElementById('docente_cu').style.display = 'none';
  document.getElementById('docente_cubrir').required = false;
  verifica_clave();
  document.getElementById('error_movimiento').innerHTML= "";
  document.getElementById('error_movimiento').value= "0";
}else if(aux == "EXTENCION"){
  verifica_clave();
  //document.getElementById('docente_cu').style.display = 'none';
  document.getElementById('docente_cubrir').required = false;
  document.getElementById('error_movimiento').innerHTML= "";
  document.getElementById('error_movimiento').value= "0";
  document.getElementById("docente_cubrir").required = false;

}else if(aux == "REINCORPORACION"){
  document.getElementById('docente_cu').style.display = 'none';
  document.getElementById('docente_cubrir').required = false;
  var route2 = "http://localhost:8000/validarnuevor/"+cct+"/"+categoria;
  verifica_clave();

  $.get(route2,function(res){
    var total = res.length;
    if(res.length > 0){

      if(categoria == "DIRECTOR"){
        document.getElementById('error_movimiento').innerHTML= "SE ENCUENTRA REGISTRADO UN DIRECTOR ACTUALMENTE EN ESTE CTE, NECESITA AGREGARLO COMO ALTA PARA PODER CONTINUAR";
        swal("Error!", "SE ENCUENTRA REGISTRADO UN DIRECTOR ACTUALMENTE EN ESTE CTE ( "+res[0].nombre+" ), NECESITA AGREGARLO COMO ALTA PARA PODER CONTINUAR", "error");
        document.getElementById('error_movimiento').value= "1";
      }
      else if(categoria == "INTENDENTE"){
        var nivel = res[0].nivel;
        var tot_gru = res[0].total_grupos;
       // var suma_tot = tot_gru *
       var total_int_prees = Math.ceil(tot_gru / 3);
       var total_int_prima = Math.ceil(tot_gru / 6);
       //alert(total_int_prees);

       if (nivel == "PREESCOLAR"){
        if (res.length > total_int_prees){
          swal("Error!", "El Número Maximo de Intendentes Permitidos En PREESCOLARES es de 1 por Cada 3 Grupos, Se Detecto que se Encuentran "+res.length+" Intendentes Ya Registrados en este CTE", "error");
          document.getElementById('error_movimiento').innerHTML= "El Número Maximo de Intendentes Permitidos En PREESCOLARES es de 1 por Cada 3 Grupos, NECESITA AGREGARLO COMO ALTA PARA PODER CONTINUAR";
          document.getElementById('error_movimiento').value= "1";
        }}
        else if(nivel == "PRIMARIA" ){
          if (res.length > total_int_prima ){
            swal("Error!", "El Número Maximo de Intendentes Permitidos En PRIMARIAS es de 1 por Cada 6 Grupos Se Detecto que se Encuentran "+res.length+" Intendentes Ya Registrados en este CTE", "error");
            document.getElementById('error_movimiento').innerHTML= "El Número Maximo de Intendentes Permitidos En PRIMARIAS es de 1 por Cada 6 Grupos, NECESITA AGREGARLO COMO ALTA PARA PODER CONTINUAR";
            document.getElementById('error_movimiento').value= "1";
          }}
          else if (nivel == "TELESECUNDARIA" ){
           if ( res.length > total_int_prees){
            swal("Error!", "El Número Maximo de Intendentes Permitidos En TELESECUNDARIAS es de 1 por Cada 3 Grupos Se Detecto que se Encuentran "+res.length+" Intendentes Ya Registrados en este CTE", "error");
            document.getElementById('error_movimiento').innerHTML= "El Número Maximo de Intendentes Permitidos En TELESECUNDARIAS es de 1 por Cada 3 Grupos, NECESITA AGREGARLO COMO ALTA PARA PODER CONTINUAR";
            document.getElementById('error_movimiento').value= "1";
          }
        }
      }
    }else{
      document.getElementById('error_movimiento').innerHTML= "";
      document.getElementById('error_movimiento').value= "0";

    }
  });
}
}




// Inside Document Ready


function valida_nomina(){
  var x = document.getElementById('file').value;
  var qna= document.getElementById("qna").value;
  var sostenimiento= document.getElementById("sostenimiento").value;
  var tipo= document.getElementById("tipo").value;
  var route = "http://localhost:8000/validar_nomina/"+qna+"/"+sostenimiento+"/"+tipo;
  var fileInput = document.getElementById('file');
   var filePath = fileInput.value;
  var aux=0;


  $.get(route,function(res){

    if(res.length > 0 ){
      for (var i=0; i < res.length; i++){
        if(res[i].estado=="ACTIVO" && x == "" || res[i].estado=="ACTIVO" && x != "" ){


          document.getElementById('submit').disabled=true;

         swal("WARNING!","La nomina correspondiente a la quincena <<"+qna+">> <<"+sostenimiento+">> ya han sido registrados anteriormente.","warning");
          //  document.getElementById("error_nominacapturada").innerHTML = "La Quincena que intenta registrar ya ha sido insertada anteriormente";
          fileInput.value = '';
          return false
        }

      }
    }else if(x != ""){

      document.getElementById('submit').disabled=false;
  //valida_file();
}

});
//  valida_file();
}

function limpiar_input(){
  var x = document.getElementById('docente_cubrir');
  if (x.length > 0){
    for (var i = 0; i < x.length; i++) {
      x.remove(i);
    }}
  }

  function verifica_fecha(){
    var x =document.getElementById('fechai').value;
    var z = document.getElementById('fechaf').value;

    if (z <= x){
      document.getElementById('error_fecha').innerHTML= "LA FECHA DE TERMINO DE LABORES, NO PUEDE SER MAYOR O IGUAL QUE LA FECHA INICIAL";
      document.getElementById('error_fecha').value= "1";
    }else{
      document.getElementById('error_fecha').innerHTML= "";
      document.getElementById('error_fecha').value= "0";
    }
  }

  function verifica_clave(){
    var categoria=document.getElementById('puesto').value;
    var select=document.getElementById('clave');
    var cantidadtotal = select.value;
    limite = "2",
    separador = "_",
    clave = cantidadtotal.split(separador, limite);
    if (categoria ==  "INTENDENTE"  && clave[1] != "INTENDENTE"){
     document.getElementById('error_clave').innerHTML= "UN INTENDENTE NO PUEDE TENER CLAVE DE "+clave[1];
     document.getElementById('error_clave').value= "1";

   }else if(categoria == "DOCENTE" && clave[1] ==  "INTENDENTE"){
     document.getElementById('error_clave').innerHTML= "UN "+categoria+ " NO PUEDE TENER CLAVE DE " +clave[1];
     document.getElementById('error_clave').value= "1";
   }else if(categoria == "DIRECTOR" && clave[1] ==  "INTENDENTE"){
     document.getElementById('error_clave').innerHTML= "UN "+categoria+ " NO PUEDE TENER CLAVE DE " +clave[1];
     document.getElementById('error_clave').value= "1";
   }else if(categoria == "USAER" && clave[1] ==  "INTENDENTE"){
     document.getElementById('error_clave').innerHTML= "UN "+categoria+ " NO PUEDE TENER CLAVE DE " +clave[1];
     document.getElementById('error_clave').value= "1";
   }else if(categoria == "EDUCACION FISICA" && clave[1] ==  "INTENDENTE"){
     document.getElementById('error_clave').innerHTML= "UN "+categoria+ " NO PUEDE TENER CLAVE DE " +clave[1];
     document.getElementById('error_clave').value= "1";
   }else{
     document.getElementById('error_clave').innerHTML= "";
     document.getElementById('error_clave').value= "0";
   }

 }

 function enviar_ciclo(){
  var x =document.getElementById('ciclo_escolar').value;
  var y =document.getElementById('id_personal').value;

  location.href="http://localhost:8000/ver_datoscaptura/"+y+"/"+x;
}

///dir regional//
function maxlengthtelefonos() {
	if( document.getElementById("telefono").value.length > 9 ){

    swal("ERROR!","Un numero telefonico se compone de 10 numeros, revisa tus datos","error");
    //document.getElementById("error_nominacapturada").innerHTML = "No se ha seleccionado ninguna Nomina.";
    return false
  }
}

function maxlengthtelefonosdir() {
	if( document.getElementById("telefono_director").value.length > 9 ){

    swal("ERROR!","Un numero telefonico se compone de 10 numeros, revisa tus datos","error");
    //document.getElementById("error_nominacapturada").innerHTML = "No se ha seleccionado ninguna Nomina.";
    return false
  }
}

function maxlengthtelefonoreg() {
	if( document.getElementById("telefono_regional").value.length > 9 ){

    swal("ERROR!","Un numero telefonico se compone de 10 numeros, revisa tus datos","error");
    //document.getElementById("error_nominacapturada").innerHTML = "No se ha seleccionado ninguna Nomina.";
    return false
  }
}

  ///dir regional//
function extencionmin() {
  	if( document.getElementById("ext1_enlace").value.length < 4  ){

      swal("ERROR!","Una EXTENCION se compone de 4 numeros, revisa tus datos","error");
      //document.getElementById("error_nominacapturada").innerHTML = "No se ha seleccionado ninguna Nomina.";
      return false
    }
  }

  function extencion2min() {
    	if( document.getElementById("ext2_enlace").value.length < 4  ){

        swal("ERROR!","Una EXTENCION se compone de 4 numeros, revisa tus datos","error");
        //document.getElementById("error_nominacapturada").innerHTML = "No se ha seleccionado ninguna Nomina.";
        return false
      }
    }

  function extencionregmin() {
    	if( document.getElementById("ext_reg_1").value.length < 4  ){

        swal("ERROR!","Una EXTENCION se compone de 4 numeros, revisa tus datos","error");
        //document.getElementById("error_nominacapturada").innerHTML = "No se ha seleccionado ninguna Nomina.";
        return false
      }
    }

    function extencionreg2min() {
        if( document.getElementById("ext_reg_2").value.length < 4  ){

          swal("ERROR!","Una EXTENCION se compone de 4 numeros, revisa tus datos","error");
          //document.getElementById("error_nominacapturada").innerHTML = "No se ha seleccionado ninguna Nomina.";
          return false
        }
      }


/////////////////

function valida_puesto() {
		if( document.getElementById("tipo_puesto").value == "Selecciona una opción"  ){
			 document.getElementById('submit').disabled=true;
		//	swal("ERROR!","Selecciona tipo se puesto","error");
			document.getElementById("error_tipo_puesto").innerHTML = "No se ha seleccionado ninguna opción.";
			return false
		}else{
				 document.getElementById('submit').disabled=false;
				 	document.getElementById("error_tipo_puesto").innerHTML = "Proceda con la captura. 😀";
		}
	}


	  function valida_sostenimiento() {
	  		if( document.getElementById('sostenimiento').value == "Selecciona una opción"  ){
	  			 document.getElementById('submit').disabled=true;
	  		//	swal("ERROR!","Selecciona tipo se puesto","error");
	  			document.getElementById("error_sostenimiento").innerHTML = "No se ha seleccionado ninguna opción.";
	  			return false
	  		}else{
	  				 document.getElementById('submit').disabled=false;
	  				 	document.getElementById("error_sostenimiento").innerHTML = "Proceda con la captura. 😀";
	  		}
	  	}

     function valida_region() {
  	  		if( document.getElementById('region').value == "Selecciona una opción" && document.getElementById('sostenimiento').value == "Selecciona una opción" ){
  	  			 document.getElementById('submit').disabled=true;
  	  		//	swal("ERROR!","Selecciona tipo se puesto","error");
  	  			document.getElementById("error_region").innerHTML = "No se ha seleccionado ninguna opción.";
            document.getElementById("error_sostenimiento").innerHTML = "No se ha seleccionado ninguna opción.";
  	  			return false

        	}else if(document.getElementById('region').value != "Selecciona una opción" && document.getElementById('sostenimiento').value != "Selecciona una opción"){
  	  				 document.getElementById('submit').disabled=false;
  	  				 	document.getElementById("error_region").innerHTML = "Proceda con la captura. 😀";
                document.getElementById("error_sostenimiento").innerHTML = "Proceda con la captura. 😀";

        	}else if (document.getElementById('region').value != "Selecciona una opción" && document.getElementById('sostenimiento').value == "Selecciona una opción") {
            document.getElementById('submit').disabled=true;
             document.getElementById("error_region").innerHTML = "Proceda con la captura. 😀";
             document.getElementById("error_sostenimiento").innerHTML = "No se ha seleccionado ninguna opción.";
          }else if (document.getElementById('region').value == "Selecciona una opción" && document.getElementById('sostenimiento').value != "Selecciona una opción") {
            document.getElementById('submit').disabled=true;
             document.getElementById("error_region").innerHTML = "No se ha seleccionado ninguna opción.";
             document.getElementById("error_sostenimiento").innerHTML = "Proceda con la captura. 😀";
          }
  	  	}

        function valida_cct() {
             if( document.getElementById('cct').value == "Selecciona una opción" && document.getElementById('mes').value == "Selecciona una opción" ){
                document.getElementById('submit').disabled=true;
             //	swal("ERROR!","Selecciona tipo se puesto","error");
               document.getElementById("error_cct").innerHTML = "No se ha seleccionado ninguna opción.";
               document.getElementById("error_mes").innerHTML = "No se ha seleccionado ninguna opción.";
               return false

             }else if(document.getElementById('cct').value != "Selecciona una opción" && document.getElementById('mes').value != "Selecciona una opción"){
                  document.getElementById('submit').disabled=false;
                   document.getElementById("error_cct").innerHTML = "Proceda con la captura. 😀";
                   document.getElementById("error_mes").innerHTML = "Proceda con la captura. 😀";

             }else if (document.getElementById('cct').value != "Selecciona una opción" && document.getElementById('mes').value == "Selecciona una opción") {
               document.getElementById('submit').disabled=true;
                document.getElementById("error_cct").innerHTML = "Proceda con la captura. 😀";
                document.getElementById("error_mes").innerHTML = "No se ha seleccionado ninguna opción.";
             }else if (document.getElementById('cct').value == "Selecciona una opción" && document.getElementById('mes').value != "Selecciona una opción") {
               document.getElementById('submit').disabled=true;
                document.getElementById("error_cct").innerHTML = "No se ha seleccionado ninguna opción.";
                document.getElementById("error_mes").innerHTML = "Proceda con la captura. 😀";
             }
           }


function rechazorfc() {
    var select2 = document.getElementById("rfc");
    var selectedOption2 = select2.selectedIndex;
    var cantidadtotal = select2.value;
    limite = "9",
    separador = "_",
    arregloDeSubCadenas = cantidadtotal.split(separador, limite);
    cct=arregloDeSubCadenas[0];
    escuela=arregloDeSubCadenas[1];
    document.getElementById('nombre').value=escuela;
   }


function validar_quincena(){
     var qna= document.getElementById("qna").value;
     var sostenimiento= document.getElementById("sostenimiento").value;
     var tipo= document.getElementById("tipo").value;
     var route = "http://localhost:8000/validar_quincena/"+qna+"/"+sostenimiento+"/"+tipo;



     $.get(route,function(res){

       if(res.length > 0 ){

         for (var i=0; i < res.length; i++){
           if(res[i].estado=="INACTIVO"){
             document.getElementById('file').disabled=true;

             swal("ERROR!","La Quincena << "+qna+" >> <<"+sostenimiento+">> que intenta registrar está en un estado <<INACTIVO>>, <<ACTIVAR>> y seguir con el registro.","error");
             //  document.getElementById("error_nominacapturada").innerHTML = "La Quincena que intenta registrar ya ha sido insertada anteriormente";
             return false;
           }

         }

       }

   });
   //  valida_file();
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

   				 			  swal("WARNING!","Los rechazos correspondientes a la quincena <<"+qna+">> <<"+sostenimiento+">> ya han sido registrados anteriormente.","warning");
   				 			             //  document.getElementById("error_nominacapturada").innerHTML = "La Quincena que intenta registrar ya ha sido insertada anteriormente";
                              return false;
   				    }

   				  }

   			 }else{
   			    document.getElementById('file').disabled=false;
   			 }
    });
    }
