
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
    var rfc=document.getElementById('rfc_input').value;

    if(aux == "ALTA"){
     desabilita_cct_nuevo();
     document.getElementById('docente_cu').style.display = 'block';
     document.getElementById('docente_cubrir').required = true
 //   document.getElementById('docente_cubrir').style.display = 'none';
 //SE AGREGO EL RFC PARA EVITAR QUE TRAIGA EL MISMO DOCENTE QUE SE DA DE ALTA 01/09/2019
 var route = "http://localhost:8000/validarcaptura/"+cct+"/"+categoria+"/"+rfc;

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
 desabilita_cct_nuevo();
 document.getElementById('docente_cu').style.display = 'none';
 document.getElementById('docente_cubrir').required = false;
 verifica_clave();
 verifica_personal(categoria,cct);
}else if(aux == "INICIO"){
  desabilita_docente();
  verifica_clave();
  desabilita_cct_nuevo();
  verifica_personal(categoria,cct);

}else if(aux == "EXTENCION"){
  verifica_clave();
  desabilita_docente();
  desabilita_cct_nuevo();

}else if(aux == "REINCORPORACION"){
 desabilita_cct_nuevo();
 document.getElementById('docente_cu').style.display = 'none';
 document.getElementById('docente_cubrir').required = false;
 var route2 = "http://localhost:8000/validarnuevor/"+cct+"/"+categoria;
 verifica_personal(categoria,cct);

}else if(aux == "CAMBIOCCT"){
  //document.getElementById('cct').disabled= true;
  document.getElementById('cct_nuevo_div').style.display = 'block';
  document.getElementById('cct_nuevo').required = true;

  verifica_clave();
  desabilita_docente();
  combrueba_estado();
  var cct2 = document.getElementById('cct_nuevo').value ;
  verifica_personal(categoria,cct2);


}else if(aux == "CAMBIOFUNCION"){
  verifica_clave();
  desabilita_docente();
  combrueba_estado();
  desabilita_cct_nuevo();
  verifica_personal(categoria,cct);

}else if(aux == "BAJA"){
  desabilita_docente();
  verifica_clave();
  desabilita_cct_nuevo();
  verifica_personal(categoria,cct);


}

}



function combrueba_estado() {
  var x = document.getElementById('estado').value;
  if (x == "INACTIVO" || x == ""){
    document.getElementById('error_movimiento').innerHTML= "NO PUEDE AGREGAR UN DOCENTE INACTIVO COMO CAMBIO DE CTE Ó CAMBIO DE FUNCIÓN, PARA REACTIVARLO SELECCIONE: -ALTA -REINCORPORACION -NUEVO RECURSO";
    document.getElementById('error_movimiento').value= "1";
  }else{
    document.getElementById('error_movimiento').innerHTML= "";
    document.getElementById('error_movimiento').value= "0";
  }
}

function desabilita_cct_nuevo(){
  var s = document.getElementById('cct').value;
  document.getElementById('cct').disabled= false;
  document.getElementById('cct_nuevo_div').style.display = 'none';
  document.getElementById('cct_nuevo').required = false;
  document.getElementById('cct_nuevo').value = s;

}

function desabilita_docente(){
 document.getElementById('docente_cu').style.display = 'none';
 document.getElementById('docente_cubrir').required = false;
 document.getElementById('error_movimiento').innerHTML= "";
 document.getElementById('error_movimiento').value= "0";
 document.getElementById("docente_cubrir").required = false;
}

function verifica_personal(categoria,cct){
 //desabilita_cct_nuevo();
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
       //             (total_int_prees);

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



  if (sostenimiento =="Selecciona una opción"){

  }else if(sostenimiento =="FEDERAL"){
    document.getElementById('src').src="/img/ejemplos/nf.png";
  }else{
    document.getElementById('src').src="/img/ejemplos/ne.png";

  }

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

function modal_loading(){
  $("#modal-delete-2").modal();
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

function enviar_ciclo2(){
  var x =document.getElementById('ciclo_escolar').value;
  var z =document.getElementById('searchText').value;

  location.href="/inasistencias2/"+x+"?searchText="+z;
}

function enviar_ciclo3(){
  var x =document.getElementById('ciclo_escolar').value;
  var z =document.getElementById('id_personal').value;
  location.href="http://localhost:8000/ver_inasistencias/"+z+"/"+x;
}

function enviar_ciclo4(){
  var x =document.getElementById('ciclo_escolar').value;
  var z =document.getElementById('id_centro').value;
  location.href="http://localhost:8000/verInformacionCentro/"+z+"/"+x;
}

function enviar_ciclo5(){
  var x =document.getElementById('ciclo_escolar').value;
  var z =document.getElementById('searchText').value;

  location.href="/reclamos2/"+x+"?searchText="+z;
}

function enviar_ciclo6(){
  var x =document.getElementById('ciclo_escolar').value;
  location.href="/nomina_federal/"+x;
}

function enviar_ciclo7(){
  var x =document.getElementById('ciclo_escolar2').value;
  document.getElementById('excel').href="descargar-cuadros-cifras/"+x;
  location.href="/cuadros_cifras/?ciclo_escolar2="+x;
}

function enviar_ciclo8(){
  var x =document.getElementById('ciclo_escolar2').value;
  var y =document.getElementById('searchText').value;
  document.getElementById('excel').href="/descargar-pagos-improcedentes/"+x;
  document.getElementById('invoice').href="/pdf-pagos-improcedentes/"+x;
  location.href="/pagos_improcedentes?searchText="+y+"&ciclo_escolar2="+x;
}

function enviar_ciclo9(){
  var x =document.getElementById('ciclo_escolar2').value;
  var y =document.getElementById('searchText').value;
  document.getElementById('excel').href="/descargar-tarjetas_fortalecimiento/"+x;
  document.getElementById('invoice').href="/pdf-tarjetas_fortalecimiento/"+x;
  location.href="/tarjetas_fortalecimiento?searchText="+y+"&ciclo_escolar2="+x;
}

function enviar_ciclo10(){
  var x =document.getElementById('ciclo_escolar').value;
  var y =document.getElementById('searchText').value;
 // document.getElementById('excel').href="nomina.nomina_capturada.excel";
 document.getElementById('invoice').href="/pdf_nomina_capturada/"+x;
 location.href="/nomina_capturada?searchText="+y+"&ciclo_escolar="+x;
}


function enviar_ciclo_centro_trabajo(){ //funciona
  var x =document.getElementById('ciclo_escolar').value;
  var y =document.getElementById('searchText').value;
 // document.getElementById('excel').href="nomina.nomina_capturada.excel";
 document.getElementById('invoice').href="/pdf_centros_trabajo/"+x;
 location.href="/centro_trabajo?searchText="+y+"&ciclo_escolar="+x;
}

function enviar_ciclo_director_centro(){
  var x =document.getElementById('ciclo_escolar').value;
  var y =document.getElementById('searchText').value;
  document.getElementById('excel').href="nomina.directores-cte.excel";
 document.getElementById('invoice').href="/pdf_directores/"+x;
 location.href="/director_centro_trabajo?ciclo_escolar="+x+"&searchText="+y;
 console.log(x.value);
}

function enviar_ciclo_listas(){ //funcina
  var x =document.getElementById('ciclo_escolar').value;
  var y =document.getElementById('searchText').value;
  //document.getElementById('excel').href="/descargar-tarjetas_fortalecimiento/"+x;
  document.getElementById('invoice').href="/pdf_listasasistencias/"+x;
  location.href="/listas_asistencias?searchText="+y+"&ciclo_escolar="+x;
}

function enviar_ciclo_cap(){ //funciona
  var x =document.getElementById('ciclo_escolar').value;
  var y =document.getElementById('searchText').value;
  //document.getElementById('excel').href="/descargar-tarjetas_fortalecimiento/"+x;
  document.getElementById('invoice').href="/pdf_captura/"+x;
  location.href="/captura?searchText="+y+"&ciclo_escolar="+x;
}

function enviar_ciclo_reintegros(){ //funciona
  var x =document.getElementById('ciclo_escolar').value;
  var y =document.getElementById('searchText').value;
  //document.getElementById('excel').href="/descargar-tarjetas_fortalecimiento/"+x;
  document.getElementById('invoice').href="/pdf_reintegros/"+x;
  location.href="/reintegros?searchText="+y+"&ciclo_escolar="+x;
}

function enviar_ciclo_fortas(){ //funciona
  var x =document.getElementById('ciclo_escolar').value;
  var y =document.getElementById('searchText').value;
  document.getElementById('pdf_fortalecimiento').href="/pdf_fortalecimiento/"+x;
  location.href="/fortalecimiento?searchText="+y+"&ciclo_escolar="+x;
}

function enviar_ciclo_solis(){ //funcion
  var x =document.getElementById('ciclo_escolar').value;
  var y =document.getElementById('searchText').value;
  document.getElementById('pdf_solicitudes').href="/pdf_solicitudes/"+x;
  location.href="/solicitudes?ciclo_escolar="+x+"&searchText="+y;
}

function enviar_ciclo11(){
  var x =document.getElementById('ciclo_escolar').value;
  var y =document.getElementById('searchText').value;
  document.getElementById('excel').href="/descargar-oficios-emitidos/"+x;

  location.href="/oficiosemitidos?searchText="+y+"&ciclo_escolar="+x;
}

function enviar_ciclo12(){
  var x =document.getElementById('ciclo_escolar').value;
  var y =document.getElementById('searchText').value;
  document.getElementById('excel').href="/descargar-oficios-recibidos/"+x;

  location.href="/oficiosrecibidos?searchText="+y+"&ciclo_escolar="+x;
}

function enviar_ciclo13(){
  var x =document.getElementById('ciclo_escolar').value;
  var y =document.getElementById('searchText').value;

  location.href="/nomina_federal?searchText="+y+"&ciclo_escolar="+x;
}

function enviar_ciclo14(){
  var x =document.getElementById('ciclo_escolar').value;
  var y =document.getElementById('searchText').value;

  location.href="/nomina_estatal?searchText="+y+"&ciclo_escolar="+x;
}

function enviar_ciclo15(){
  var x =document.getElementById('ciclo_escolar').value;
  var y =document.getElementById('searchText').value;
  document.getElementById('excel').href="/descargar-estadistica911/"+x;

  location.href="/quejas?searchText="+y+"&ciclo_escolar="+x;
}

function enviar_ciclo16(){
  var x =document.getElementById('ciclo_escolar').value;
  var y =document.getElementById('searchText').value;
  document.getElementById('excel').href="/descargar-quejas/"+x;

  location.href="/quejas?searchText="+y+"&ciclo_escolar="+x;
}



///dir regional//
function maxlengthtelefonos() {
	if( document.getElementById("telefono").value.length > 9 ){
    swal("ERROR!","Un numero telefonico se compone de 10 numeros, revisa tus datos","error");
    //document.getElementById("error_nominacapturada").innerHTML = "No se ha seleccionado ninguna Nomina.";
    return false
  }
}



function busca_personal(){
  var Table = document.getElementById("detalles");
  Table.innerHTML = "";

  var select2 = document.getElementById("cct");
  var selectedOption2 = select2.selectedIndex;
  var cantidadtotal = select2.value;
  limite = "3",
  separador = "_",
  arregloDeSubCadenas = cantidadtotal.split(separador, limite);
  id_cct=arregloDeSubCadenas[2];
  var mes= document.getElementById("mes").value;
  var ciclo= document.getElementById("ciclo_escolar").value;
  var route = "http://localhost:8000/validar_lista/"+id_cct+"/"+mes+"/"+ciclo;
  var route2 = "http://localhost:8000/busca_personal/"+id_cct+"/";
  var route3 = "http://localhost:8000/busca_dias/"+mes+"/"+ciclo+"/";
  var dias;
  var arreglo= [] ;

  $.get(route,function(res){

    if(res.length <= 0 ){


      document.getElementById('submit8').disabled=true;
      swal("ERROR!","La Lista de Asistencia que Intenta Registrar No Se Encuentra Generada","error");
          //  document.getElementById("error_nominacapturada").innerHTML = "La Quincena que intenta registrar ya ha sido insertada anteriormente";
          document.getElementById('submit8').disabled=false;
          return false
        }else{

          $.get(route3,function(res){
            dias = parseInt(res.length);
            if(res.length > 0 ){
              var tabla = document.getElementById("detalles");
    //tabla.setAttribute("id", id2);
    var row = tabla.insertRow(0);
    var cell1 = row.insertCell(0);
    var cell2 = row.insertCell(1);
    var cell3 = row.insertCell(2);
    var cell4 = row.insertCell(3);
    cell1.innerHTML =  "N°";
    cell2.innerHTML = "Nombre del Empleado";
    cell3.innerHTML = "R.F.C" ;
    cell4.innerHTML = "Categoria" ;
    for (var i=0; i < res.length; i++){
      var aux = 4 + i;
      var cellx = row.insertCell(aux);
      cellx.innerHTML = res[i].l_semana+"-"+res[i].dia ;
    }

    $.get(route2,function(res){
      if(res.length > 0 ){
        for (var i=0; i < res.length; i++){
          if(res[i].estado=="ACTIVO"){
            var tabla = document.getElementById("detalles");
    //tabla.setAttribute("id", id2);
    var row = tabla.insertRow(1);
    var cell1 = row.insertCell(0);
    var cell2 = row.insertCell(1);
    var cell3 = row.insertCell(2);
    var cell4 = row.insertCell(3);


    cell1.innerHTML =  res[i].id;
    cell2.innerHTML = res[i].nombre;
    cell3.innerHTML = res[i].rfc;
    cell4.innerHTML = res[i].categoria;
    for (var p = 0 ; p < dias; p++) {
      var aux = 4 + p;
      var z = tabla.rows[0].cells[aux].innerHTML;
      var agregaHTML = "<input type=button value=O class=agrega id="+(res[i].id)+"-"+(z)+">";
      var cellx = row.insertCell(aux);
      cellx.innerHTML = agregaHTML ;
      //document.getElementById(""+res[i].id+z).style.color = "#00ff00";

      cellx.addEventListener("click", function(event) {
        var currentId = event.target.id;
        var aux = event.target.id;
        var calcula = document.getElementById(""+aux).value;
        var arr = document.getElementById(""+aux).id;
        if (calcula == "O"){
          document.getElementById(""+aux).value = "/";
          document.getElementById(""+aux).style.color = "#ff0000";
          arreglo.push(aux);
          document.getElementById('inasistencias').value=arreglo;
        }else{
          for (var i = 0; i < arreglo.length; i++) {
            if (arr == arreglo[i]) {
              arreglo.splice(i, 1);
              document.getElementById('inasistencias').value=arreglo;
            }
          }
          document.getElementById(""+aux).value = "O";
          document.getElementById(""+aux).style.color = "#000000";

        }
        cuenta_arreglo(arreglo);
      })
    }
    cuenta_arreglo(arreglo);
          //  document.getElementById('submit8').disabled=true;

          //  document.getElementById("error_nominacapturada").innerHTML = "La Quincena que intenta registrar ya ha sido insertada anteriormente";
          //return false
        }

      }




    }

  });

  }else{
    swal("ERROR!","No Se Encuentran Dias Habilen en este Mes, Dentro de este Ciclo Escolar","error");
    document.getElementById('submit8').disabled=false;
          //  document.getElementById("error_nominacapturada").innerHTML = "La Quincena que intenta registrar ya ha sido insertada anteriormente";
          return false

        }

      });

          document.getElementById('submit8').disabled=false;
  //valida_file();
}

});
//  valida_file();
}



function busca_personal2(){
  var Table = document.getElementById("detalles");
  Table.innerHTML = "";

  var dia = document.getElementById("dia").value;
  var mes = document.getElementById("mes").value;
  var mesaux = document.getElementById("mesaux").value;
  var ciclo = document.getElementById("ciclo_escolar").value;
  var nombre = document.getElementById("nombre").value;
  var rfc = document.getElementById("rfc").value;
  var categoria = document.getElementById("categoria").value;
  var id = document.getElementById("personal").value;
  var route3 = "http://localhost:8000/busca_dias/"+mes+"/"+ciclo+"/";
  var dias;
  var arreglo= [] ;

  $.get(route3,function(res){
    dias = parseInt(res.length);
    if(res.length > 0 ){


      var tabla = document.getElementById("detalles");
    //tabla.setAttribute("id", id2);
    var row = tabla.insertRow(0);
    var cell1 = row.insertCell(0);
    var cell2 = row.insertCell(1);
    var cell3 = row.insertCell(2);
    var cell4 = row.insertCell(3);
    cell1.innerHTML =  "N°";
    cell2.innerHTML = "Nombre del Empleado";
    cell3.innerHTML = "R.F.C" ;
    cell4.innerHTML = "Categoria" ;

    var tabla2 = document.getElementById("detalles");
    //tabla.setAttribute("id", id2);
    var row2 = tabla2.insertRow(1);
    var cell11 = row2.insertCell(0);
    var cell22 = row2.insertCell(1);
    var cell33 = row2.insertCell(2);
    var cell44 = row2.insertCell(3);


    cell11.innerHTML =  id;
    cell22.innerHTML = nombre;
    cell33.innerHTML = rfc;
    cell44.innerHTML = categoria;



    for (var i=0; i < res.length; i++){
      var aux = 4 + i;
      var cellx = row.insertCell(aux);
      cellx.innerHTML = res[i].l_semana+"-"+res[i].dia ;

      var z = tabla2.rows[0].cells[aux].innerHTML;
    //  var arr = document.getElementById(""+aux).id;
    if(res[i].dia == dia && mes == mesaux ){
      var agregaHTML = "<input type=button value=/ class=agrega id="+(id)+"-"+(z)+">";
      var va=""+id+"-"+z
      var cellx = row2.insertCell(aux);
      cellx.innerHTML = agregaHTML ;
      document.getElementById(""+va).style.color = "#ff0000";
      arreglo.push(va);
      document.getElementById('inasistencias').value=arreglo;

    }else{
      var agregaHTML = "<input type=button value=O class=agrega id="+(id)+"-"+(z)+">";
      var cellx = row2.insertCell(aux);
      cellx.innerHTML = agregaHTML ;
    }



    cellx.addEventListener("click", function(event) {
      var currentId = event.target.id;
      var aux = event.target.id;
      var calcula = document.getElementById(""+aux).value;
      var arr = document.getElementById(""+aux).id;
      if (calcula == "O"){
        document.getElementById(""+aux).value = "/";
        document.getElementById(""+aux).style.color = "#ff0000";
        arreglo.push(aux);
        document.getElementById('inasistencias').value=arreglo;

      }else{
        for (var i = 0; i < arreglo.length; i++) {
          if (arr == arreglo[i]) {
            arreglo.splice(i, 1);
            document.getElementById('inasistencias').value=arreglo;

          }
        }
        document.getElementById(""+aux).value = "O";
        document.getElementById(""+aux).style.color = "#000000";

      }
      cuenta_arreglo(arreglo);
    })

  }
  cuenta_arreglo(arreglo);
}

});
}

function cuenta_arreglo(arreglo){
  document.getElementById('total').value=arreglo.length;
}



function busca_personal3(callback){
  var Table = document.getElementById("detalles");
  Table.innerHTML = "";

  var mes= document.getElementById("mes").value;
  var ciclo= document.getElementById("nombre_ciclo").value;
  var id_cct= document.getElementById("id_centro").value;

  var route = "http://localhost:8000/validar_lista/"+id_cct+"/"+mes+"/"+ciclo;
  var route2 = "http://localhost:8000/busca_personal/"+id_cct+"/";
  var route3 = "http://localhost:8000/busca_dias/"+mes+"/"+ciclo+"/";
  var dias;
  var arreglo= [] ;

  $.get(route,function(res){
    if(res.length <= 0 ){
      for (var i=0; i < res.length; i++){
         // document.getElementById('submit8').disabled=true;
         swal("ERROR!","El Mes seleccionado No se Ha capturado en las Listas de Asistencia","error");
          //  document.getElementById("error_nominacapturada").innerHTML = "La Quincena que intenta registrar ya ha sido insertada anteriormente";
          //document.getElementById('submit8').disabled=false;
          //return false

        }
      }else{

        $.get(route3,function(res){
          dias = parseInt(res.length);
          if(res.length > 0 ){
            var tabla = document.getElementById("detalles");
    //tabla.setAttribute("id", id2);
    var row = tabla.insertRow(0);
    var cell1 = row.insertCell(0);
    var cell2 = row.insertCell(1);
    var cell3 = row.insertCell(2);
    var cell4 = row.insertCell(3);
    cell1.innerHTML =  "N°";
    cell2.innerHTML = "Nombre del Empleado";
    cell3.innerHTML = "R.F.C" ;
    cell4.innerHTML = "Categoria" ;
    for (var i=0; i < res.length; i++){
      var aux = 4 + i;
      var cellx = row.insertCell(aux);
      cellx.innerHTML = res[i].l_semana+"-"+res[i].dia ;
    }

    $.get(route2,function(res){
      if(res.length > 0 ){
        for (var i=0; i < res.length; i++){
          if(res[i].estado=="ACTIVO"){
            var tabla = document.getElementById("detalles");
    //tabla.setAttribute("id", id2);
    var row2 = tabla.insertRow(1);
    var cell1 = row2.insertCell(0);
    var cell2 = row2.insertCell(1);
    var cell3 = row2.insertCell(2);
    var cell4 = row2.insertCell(3);



    cell1.innerHTML =  res[i].id;
    cell2.innerHTML = res[i].nombre;
    cell3.innerHTML = res[i].rfc;
    cell4.innerHTML = res[i].categoria;

    for (var p = 0 ; p < dias; p++) {
      var aux = 4 + p;
      var z = tabla.rows[0].cells[aux].innerHTML;
      var agregaHTML = "<input type=button value=O class=agrega id="+(res[i].id)+"-"+(z)+">";
      var cellx = row2.insertCell(aux);
      cellx.innerHTML = agregaHTML ;
    }

    cuenta_arreglo(arreglo);
  }

}



}

});
  }else{
    swal("ERROR!","No Se Encuentran Dias Habilen en este Mes, Dentro de este Ciclo Escolar","error");
    //document.getElementById('submit8').disabled=false;
          //  document.getElementById("error_nominacapturada").innerHTML = "La Quincena que intenta registrar ya ha sido insertada anteriormente";
          //return false

        }

      });
  //    document.getElementById('submit8').disabled=false;
  //valida_file();
}
});
    //setTimeout(callback(dias),9000);
    setTimeout(function(){callback(dias)},5000);

  }

  function  callback(dias){
    var tabla = document.getElementById("detalles");
    var rw= tabla.rows.length;
    var mes= document.getElementById("mes").value;
    var ciclo= document.getElementById("nombre_ciclo").value;
    var id_cct= document.getElementById("id_centro").value;
    var arreglo= [] ;


    var route4 = "http://localhost:8000/busca_inasistencias/"+id_cct+"/"+ciclo+"/"+mes;

    $.get(route4,function(res){
      for (var i = 1; i <= rw-1; i++) {
        for(var f=0; f<= res.length-1;f++ ){
         for (var p = 0 ; p < dias; p++) {
          var aux=p+4;
          var z = tabla.rows[0].cells[aux].innerHTML;
          var id = tabla.rows[i].cells[0].innerHTML;
          var z = tabla.rows[0].cells[aux].innerHTML;
          limite = "2",
          separador = "-",
          arregloDeSubCadenas = z.split(separador, limite);
          dia=arregloDeSubCadenas[1];
          if(res.length > 0){
           // alert('ID '+res[f].id_captura+"-"+id+" DIA "+res[f].dia+"-"+dia+" "+res[f].mes+"-"+mes);
           if(res[f].id_captura == id && dia==res[f].dia && mes==res[f].mes){
             var agregaHTML = "<input type=button value=/ class=agrega id="+id+"-"+(z)+">";
             var va=""+id+"-"+z
             tabla.rows[i].cells[aux].innerHTML= agregaHTML;
             document.getElementById(""+va).style.color = "#ff0000";
             arreglo.push(va);
             document.getElementById('inasistencias').value=arreglo;
           }

         }
       }
     }
   }
   cuenta_arreglo(arreglo);
 });
  }


//  valida_file();;


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
   document.getElementById("error_tipo_puesto").innerHTML = "";
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
        document.getElementById("error_sostenimiento").innerHTML = "";
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
          document.getElementById("error_region").innerHTML = "";
          document.getElementById("error_sostenimiento").innerHTML = "";

        }else if (document.getElementById('region').value != "Selecciona una opción" && document.getElementById('sostenimiento').value == "Selecciona una opción") {
          document.getElementById('submit').disabled=true;
          document.getElementById("error_region").innerHTML = "";
          document.getElementById("error_sostenimiento").innerHTML = "No se ha seleccionado ninguna opción.";
        }else if (document.getElementById('region').value == "Selecciona una opción" && document.getElementById('sostenimiento').value != "Selecciona una opción") {
          document.getElementById('submit').disabled=true;
          document.getElementById("error_region").innerHTML = "No se ha seleccionado ninguna opción.";
          document.getElementById("error_sostenimiento").innerHTML = "";
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
            document.getElementById("error_cct").innerHTML = "";
            document.getElementById("error_mes").innerHTML = "";

          }else if (document.getElementById('cct').value != "Selecciona una opción" && document.getElementById('mes').value == "Selecciona una opción") {
           document.getElementById('submit').disabled=true;
           document.getElementById("error_cct").innerHTML = "";
           document.getElementById("error_mes").innerHTML = "No se ha seleccionado ninguna opción.";

           document.getElementById("error_mes").innerHTML = "No se ha seleccionado ninguna opción.";
         }else if (document.getElementById('cct').value == "Selecciona una opción" && document.getElementById('mes').value != "Selecciona una opción") {
           document.getElementById('submit').disabled=true;
           document.getElementById("error_cct").innerHTML = "No se ha seleccionado ninguna opción.";

           document.getElementById("error_mes").innerHTML = "";



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

function cambia_reclamos(){
  var select2 = document.getElementById("personal");
  var selectedOption2 = select2.selectedIndex;
  var cantidadtotal = select2.value;
  limite = "8",
  separador = "_",
  arregloDeSubCadenas = cantidadtotal.split(separador, limite);
  id=arregloDeSubCadenas[0];
  rfc=arregloDeSubCadenas[1];
  nombre=arregloDeSubCadenas[2];
  categoria=arregloDeSubCadenas[3];
  cct=arregloDeSubCadenas[4];
  nombre_escuela=arregloDeSubCadenas[5];
  fecha_inicio=arregloDeSubCadenas[6];
  fecha_termino=arregloDeSubCadenas[7];

  document.getElementById('cct').value = cct;
  document.getElementById('escuela').value = nombre_escuela;
  document.getElementById('categoria').value = categoria;
  document.getElementById('fechai').value = fecha_inicio;
  document.getElementById('fechaf').value = fecha_termino;
  document.getElementById('rfc').value = rfc;
  document.getElementById('total').value = " ";
  document.getElementById('dias').value = " " ;




}

function llenado_modale(){
 x = document.getElementById('motivo').value;
 var y =document.getElementById('total').value;
 var dias =document.getElementById('dias').value;

 if(x == " " || y == " " || dias == " "){
   document.getElementById("errorUnidad").innerHTML = "Faltan Campos por LLenar";
   return false;
 }else{
   $("#modal-delete-2").modal();
   return false;

 }
}


function llenado(){
  var x = document.getElementById('motivo').value;
  var y =document.getElementById('total').value;
  var dias =document.getElementById('dias').value;

  if(x == " " || y == " " || dias == " "){
   document.getElementById("errorUnidad").innerHTML = "Faltan Campos por LLenar";
   return false;
 }else{
  document.getElementById("errorUnidad").innerHTML = "";
  var select2 = document.getElementById("personal");
  var selectedOption2 = select2.selectedIndex;
  var cantidadtotal = select2.value;
  limite = "8",
  separador = "_",
  arregloDeSubCadenas = cantidadtotal.split(separador, limite);
  id=arregloDeSubCadenas[0];
  nombre=arregloDeSubCadenas[2];
  var rfc = document.getElementById('rfc').value;
  var cct = document.getElementById('cct').value ;
  var nombre_escuela = document.getElementById('escuela').value ;
  var categoria = document.getElementById('categoria').value ;
  var fecha_inicio = document.getElementById('fechai').value ;
  var fecha_termino = document.getElementById('fechaf').value ;

  var comprueba = recorre2(id)
  if (comprueba == 1){
    swal("Alerta!", "Este Empleado Ya se ha Insertado en la Tabla!", "error");
    return false;
  }


  var tabla = document.getElementById("detalles");
    //tabla.setAttribute("id", id2);
    var row = tabla.insertRow(1);
    var cell1 = row.insertCell(0);
    var cell2 = row.insertCell(1);
    var cell3 = row.insertCell(2);
    var cell4 = row.insertCell(3);
    var cell5 = row.insertCell(4);
    var cell6 = row.insertCell(5);
    var cell7 = row.insertCell(6);
    var cell8 = row.insertCell(7);
    var cell9 = row.insertCell(8);
    var cell10 = row.insertCell(9);
    cell1.innerHTML =  '<input type="button" value="Eliminar"  onClick="eliminarFila(this.parentNode.parentNode.rowIndex);">';
    cell2.innerHTML = id;
    cell3.innerHTML = nombre;
    cell4.innerHTML =  rfc;
    cell5.innerHTML = categoria;
    cell6.innerHTML = cct;
    cell7.innerHTML = dias;
    cell8.innerHTML = fecha_inicio  ;
    cell9.innerHTML = fecha_termino ;
    cell10.innerHTML = y ;

    var menos =document.getElementById("detalles").rows
    var r = menos.length;
    document.getElementById("totale").value= r - 2;

    var sub = y  ;
    var auxsuma= document.getElementById("subtotal").value;
    var sumatodo = parseFloat(sub) + parseFloat(auxsuma);
    document.getElementById("subtotal").value=sumatodo;




  }
}

function calcula_monto(){
  var dias = document.getElementById('dias').value;
  var categoria = document.getElementById('categoria').value;
  var monto = document.getElementById('total').value;
  var ciclo = document.getElementById('ciclo_escolar').value;

  var route = "http://localhost:8000/calcular_reclamo/"+dias+"/"+categoria+"/"+ciclo;
  $.get(route,function(res){
    document.getElementById('total').value = res;
  });

}

function recorre2(valor) {
 var z = 1
 var arreglo = [];
 var table = document.getElementById('detalles');
 for (var r = 1, n = table.rows.length-1; r < n; r++) {
  for (var c = 1, m = table.rows[r].cells.length; c < m; c++) {
   if (z == 1){
    var j = table.rows[r].cells[c].innerHTML;

    if (valor == j ){
      var r = 1;
      return(r);
    }else{
     z ++;
   }
 }
 else if(z == 2){
   z ++;
 }else if(z == 3){
  z ++;
}else if(z == 4){
 z ++;
} else if (z == 5){
  z ++;
}else if (z == 6){
 z ++;

}else if(z == 7){
 z ++;

}else if(z == 8){
 z ++;

}else{
 z = 1;

}

}
}
}


function eliminarFila(value) {

  var cantidadanueva=document.getElementById("detalles").rows[value].cells[9].innerHTML;
  document.getElementById("detalles").deleteRow(value);
  var menos =document.getElementById("detalles").rows
  var r = menos.length;
  document.getElementById("totale").value= r - 2;
  var sub= document.getElementById("subtotal").value;
  document.getElementById("subtotal").value= sub - cantidadanueva;
 // limpiar();
}

function guardar_reclamo() {
  if (document.getElementById('total').value > 0){
   var z = 1
   var arreglo = [];
   var table = document.getElementById('detalles');
   for (var r = 1, n = table.rows.length-1; r < n; r++) {
    for (var c = 1, m = table.rows[r].cells.length; c < m; c++) {
     if (z == 1){
      arreglo.push(table.rows[r].cells[c].innerHTML);
      z ++;
    }

    else if(z == 2){
     //arreglo.push(table.rows[r].cells[c].innerHTML);
     z ++;
   }else if(z == 3){
     //arreglo.push(table.rows[r].cells[c].innerHTML);
     z ++;
   }else if(z == 4){
     //arreglo.push(table.rows[r].cells[c].innerHTML);
     z ++;
   } else if (z == 5){
     //arreglo.push(table.rows[r].cells[c].innerHTML);
     z ++;
   }else if (z == 6){
     arreglo.push(table.rows[r].cells[c].innerHTML);
     z ++;

   }else if (z == 7){
     arreglo.push(table.rows[r].cells[c].innerHTML);
     z ++;

   }else if (z == 8){
     arreglo.push(table.rows[r].cells[c].innerHTML);
     z ++;

   }else{
    arreglo.push(table.rows[r].cells[c].innerHTML);
    document.getElementById("codigo2").value=arreglo;
    z = 1;

  }

}
}
}else{
  //alert('No hay Elementos Agregados, Para Poder Guardar');
  swal("Alerta!", "No hay Elementos Agregados, Para Poder Guardar!", "error");
  return false;

}

///tabla2
var arreglo_v = [];
var table = document.getElementById('detalles2');
for (var r = 1, n = table.rows.length-1; r < n; r++) {
  for (var c = 1, m = table.rows[r].cells.length; c < m; c++) {
   if (z == 1){
    arreglo_v.push(table.rows[r].cells[c].innerHTML);
    z ++;
  }

  else if(z == 2){
   arreglo_v.push(table.rows[r].cells[c].innerHTML);
   z ++;
 }else if(z == 3){
   arreglo_v.push(table.rows[r].cells[c].innerHTML);
   z ++;
 }else{
  arreglo_v.push(table.rows[r].cells[c].innerHTML);
  document.getElementById("visto_bueno").value=arreglo_v;
  z = 1;

}

}
}

//tabla3
var arreglo_c = [];
var table = document.getElementById('detalles3');
for (var r = 1, n = table.rows.length-1; r < n; r++) {
  for (var c = 1, m = table.rows[r].cells.length; c < m; c++) {
   if (z == 1){
    arreglo_c.push(table.rows[r].cells[c].innerHTML);
    z ++;
  }

  else if(z == 2){
   arreglo_c.push(table.rows[r].cells[c].innerHTML);
   z ++;
 }else if(z == 3){
   arreglo_c.push(table.rows[r].cells[c].innerHTML);
   z ++;
 }else if(z == 4){
   arreglo_c.push(table.rows[r].cells[c].innerHTML);
   z ++;
 }else{
  arreglo_c.push(table.rows[r].cells[c].innerHTML);
  document.getElementById("c_copia").value=arreglo_c;
  z = 1;

}

}
}

}

function agregar2() {
 var table_count = document.getElementById('detalles2').rows.length-2;

 if(table_count >= 2){
   swal("Alerta!", "Solo se Puede Ingresar comó Maximo 2 Vo.Bo!", "error");
   return false;

 }
 var select2 = document.getElementById("vo");
 var selectedOption2 = select2.selectedIndex;
 var cantidadtotal = select2.value;
 limite = "5",
 separador = "_",
 arregloDeSubCadenas = cantidadtotal.split(separador, limite);
 puesto=arregloDeSubCadenas[0];
 nombre_c=arregloDeSubCadenas[1];
 id=arregloDeSubCadenas[2];
 lic=arregloDeSubCadenas[3];

 var comprueba = recorre3(id)
 if (comprueba == 1){
  swal("Alerta!", "Este Empleado Ya se ha Insertado en la Tabla!", "error");
  return false;
}

var tabla = document.getElementById("detalles2");
    //tabla.setAttribute("id", id2);
    var row = tabla.insertRow(1);
    var cell1 = row.insertCell(0);
    var cell2 = row.insertCell(1);
    var cell3 = row.insertCell(2);
    var cell4 = row.insertCell(3);
    var cell5 = row.insertCell(4);
    cell1.innerHTML =  '<input type="button" value="Eliminar"  onClick="eliminarFila2(this.parentNode.parentNode.rowIndex);">';
    cell2.innerHTML = id;
    cell3.innerHTML = lic;
    cell4.innerHTML = nombre_c;
    cell5.innerHTML = puesto;
  }

  function recorre3(valor) {
   var z = 1
   var arreglo = [];
   var table = document.getElementById('detalles2');
   for (var r = 1, n = table.rows.length-1; r < n; r++) {
    for (var c = 1, m = table.rows[r].cells.length; c < m; c++) {
      var j = table.rows[r].cells[1].innerHTML;
      if (valor == j ){
        var r = 1;
        return(r);
      }

    }
  }}

  function eliminarFila2(value) {

    document.getElementById("detalles2").deleteRow(value);
 // limpiar();
}

function agregar3() {
 var table_count = document.getElementById('detalles3').rows.length-2;

 if(table_count >= 6){
   swal("Alerta!", "Solo se Puede Ingresar comó Maximo 5 Vo.Bo!", "error");
   return false;

 }
 var select2 = document.getElementById("ccp");
 var selectedOption2 = select2.selectedIndex;
 var cantidadtotal = select2.value;
 limite = "6",
 separador = "_",
 arregloDeSubCadenas = cantidadtotal.split(separador, limite);
 puesto=arregloDeSubCadenas[0];
 nombre_c=arregloDeSubCadenas[1];
 id=arregloDeSubCadenas[2];
 lic=arregloDeSubCadenas[3];
 a_n=arregloDeSubCadenas[4];

 var comprueba = recorre4(id)
 if (comprueba == 1){
  swal("Alerta!", "Este Empleado Ya se ha Insertado en la Tabla!", "error");
  return false;
}

var tabla = document.getElementById("detalles3");
    //tabla.setAttribute("id", id2);
    var row = tabla.insertRow(1);
    var cell1 = row.insertCell(0);
    var cell2 = row.insertCell(1);
    var cell3 = row.insertCell(2);
    var cell4 = row.insertCell(3);
    var cell5 = row.insertCell(4);
    var cell6 = row.insertCell(4);
    cell1.innerHTML =  '<input type="button" value="Eliminar"  onClick="eliminarFila3(this.parentNode.parentNode.rowIndex);">';
    cell2.innerHTML = id;
    cell3.innerHTML = lic;
    cell4.innerHTML = nombre_c;
    cell5.innerHTML = a_n;
    cell6.innerHTML = puesto;
  }

  function recorre4(valor) {
   var z = 1
   var arreglo = [];
   var table = document.getElementById('detalles3');
   for (var r = 1, n = table.rows.length-1; r < n; r++) {
    for (var c = 1, m = table.rows[r].cells.length; c < m; c++) {
      var j = table.rows[r].cells[1].innerHTML;
      if (valor == j ){
        var r = 1;
        return(r);
      }

    }
  }}

  function eliminarFila3(value) {

    document.getElementById("detalles3").deleteRow(value);
 // limpiar();
}

function buscar_qnas(){
  var x = document.getElementById('pagos');
  if (x.length > 0){
    for (var i = 0; i < x.length; i++) {
      x.remove(i);
    }}
    var ciclo = document.getElementById('ciclo_escolar').value;

    var route = "http://localhost:8000/buscar_qnas/"+ciclo;

    $.get(route,function(res){
      for (var p = 0 ; p < res.length; p++) {
        var x = document.getElementById("pagos");
        var option = document.createElement("option");
        option.text = res[p].qna ;
        option.value = res[p].qna;
        x.add(option, x[p])

      }
    });

  }

  function num_oficio(){
    var ciclo = document.getElementById('ciclo_escolar').value;
    var x= document.getElementById('oficio_aux').value;
    var route = "http://localhost:8000/buscar_oficio/"+x+"/"+ciclo;
    $.get(route,function(res){
      if(res.length > 0){
       swal("Alerta!", "Este Oficio Ya se ha Registrado Anteriormente!", "error");
       document.getElementById('submit8').disabled= true;
       return false;
     }else{
      var fecha = new Date();
      var ano = fecha.getFullYear();
      document.getElementById('oficio').value = "SA/DFE/DHA/ETC.-"+x+"/"+ano;
      document.getElementById('submit8').disabled= false;
    }
  });
  }

  function num_oficio_id(){
    var ciclo = document.getElementById('ciclo_escolar').value;
    var x= document.getElementById('oficio_aux').value;
    var route = "http://localhost:8000/buscar_oficio2/"+x+"/"+ciclo;
    $.get(route,function(res){
      if(res.length > 0){
       swal("Alerta!", "Este Oficio Ya se ha Registrado Anteriormente!", "error");
       document.getElementById("error-nofici").innerHTML = "Este Oficio Ya se ha Registrado Anteriormente!";
       document.getElementById("error-nofici").value = "1";
       document.getElementById("correcto_oficio").innerHTML = "";
       document.getElementById("correcto_oficio").value = "0";
       document.getElementById('submit8').disabled= true;
       return false;
     }else{
      var fecha = new Date();
      var ano = fecha.getFullYear();
      document.getElementById('oficio').value = "SA/DFE/DHA/ETC.-"+x+"/"+ano;
      document.getElementById('submit8').disabled= false;
      document.getElementById("error-nofici").innerHTML = "";
      document.getElementById("error-nofici").value = "0";
      document.getElementById("correcto_oficio").innerHTML = "Número De Oficio Disponible!";
      document.getElementById("correcto_oficio").value = "1";

    }
  });
  }





  function busca_dias_reclamo(){
    document.getElementById("detalles").deleteRow(1);

    var ciclo = document.getElementById('ciclo_escolar').value;
    document.getElementById('generar').href="http://localhost:8000/pdf_reclamos/"+ciclo;
    var route = "http://localhost:8000/busca_dias_reclamo/"+ciclo;

    document.getElementById('excel_reclamos').href="http://localhost:8000/descargar-reclamos/"+ciclo;
    var director= 0;
    var docente = 0;
    var intendente = 0;
    var dias = 0;
    var total = 0;
    var pendiente = 0;
    var resuelto = 0 ;

    $.get(route,function(res){
      if(res.length > 0){
        for (var i =0; res.length > i; i++) {
          if(res[i].estado == "PENDIENTE"){
            pendiente = pendiente +1;

          }else{
            resuelto = resuelto +1;
          }
          dias = dias + res[i].total_dias;
          total= parseInt(total) + parseInt(res[i].total_reclamo);


          if(res[i].categoria == "DIRECTOR"){
            director=director+1;
          }else if(res[i].categoria == "DOCENTE" || res[i].categoria == "USAER" || res[i].categoria == "EDUCACION FISICA"){
            docente=docente+1;
          }else{
            intendente= intendente+1;
          }
        }
      }
      var tabla = document.getElementById("detalles");
      var row = tabla.insertRow(1);
      row.style.backgroundColor = "white";
      var cell1 = row.insertCell(0);
      var cell2 = row.insertCell(1);
      var cell3 = row.insertCell(2);
      var cell4 = row.insertCell(3);
      var cell5 = row.insertCell(4);
      var cell6 = row.insertCell(5);
      var cell7 = row.insertCell(6);
      var cell8 = row.insertCell(7);
      cell1.innerHTML = res.length;
      cell2.innerHTML = director;
      cell3.innerHTML = docente;
      cell4.innerHTML =  intendente;
      cell5.innerHTML = dias;
      cell6.innerHTML = currencyFormat(total);
      cell7.innerHTML = resuelto;
      cell8.innerHTML = pendiente  ;
    });

  }


  function busca_dias_reclamo_region(){
   document.getElementById("detalles2").deleteRow(1);

   var ciclo = document.getElementById('ciclo_escolar').value;
   var region = document.getElementById('region').value;

   var route = "http://localhost:8000/busca_dias_reclamo_region/"+region+"/"+ciclo;
   var director= 0;
   var docente = 0;
   var intendente = 0;
   var dias = 0;
   var total = 0;
   var pendiente = 0;
   var resuelto = 0 ;

   $.get(route,function(res){
    if(res.length > 0){
      for (var i =0; res.length > i; i++) {
        if(res[i].estado == "PENDIENTE"){
          pendiente = pendiente +1;

        }else{
          resuelto = resuelto +1;
        }
        dias = dias + res[i].total_dias;
        total= parseInt(total) + parseInt(res[i].total_reclamo);


        if(res[i].categoria == "DIRECTOR"){
          director=director+1;
        }else if(res[i].categoria == "DOCENTE" || res[i].categoria == "USAER" || res[i].categoria == "EDUCACION FISICA"){
          docente=docente+1;
        }else{
          intendente= intendente+1;
        }
      }
    }
    var tabla = document.getElementById("detalles2");
    var row = tabla.insertRow(1);
    row.style.backgroundColor = "white";
    var cell1 = row.insertCell(0);
    var cell2 = row.insertCell(1);
    var cell3 = row.insertCell(2);
    var cell4 = row.insertCell(3);
    var cell5 = row.insertCell(4);
    var cell6 = row.insertCell(5);
    var cell7 = row.insertCell(6);
    var cell8 = row.insertCell(7);
    cell1.innerHTML = res.length;
    cell2.innerHTML = director;
    cell3.innerHTML = docente;
    cell4.innerHTML =  intendente;
    cell5.innerHTML = dias;
    cell6.innerHTML = currencyFormat(total);
    cell7.innerHTML = resuelto;
    cell8.innerHTML = pendiente  ;
  });

 }

 function busca_listas_ciclo(){
  document.getElementById("detalles").deleteRow(1);

  var ciclo = document.getElementById('ciclo_escolar').value;

  document.getElementById('invoice').href="http://localhost:8000/pdf_listasasistencias/"+ciclo;


  var route = "http://localhost:8000/busca_listas/"+ciclo;
  document.getElementById('excel_reclamos').href="http://localhost:8000/descargar-listas-ciclo/"+ciclo;

  var pendiente = 0;
  var resuelto = 0 ;

  $.get(route,function(res){
    if(res.length > 0){
      for (var i =0; res.length > i; i++) {
        if(res[i].estado == "PENDIENTE"){
          pendiente = pendiente +1;

        }else{
          resuelto = resuelto +1;
        }



      }
    }
    var tabla = document.getElementById("detalles");
    var row = tabla.insertRow(1);
    row.style.backgroundColor = "white";
    var cell1 = row.insertCell(0);
    var cell2 = row.insertCell(1);
    var cell3 = row.insertCell(2);
    cell1.innerHTML = res.length;
    cell2.innerHTML = resuelto;
    cell3.innerHTML = pendiente;

  });

}

function busca_listas_region(){
  document.getElementById("detalles2").deleteRow(1);

  var ciclo = document.getElementById('ciclo_escolar').value;
  var region = document.getElementById('region').value;

  var route = "http://localhost:8000/busca_listas_region/"+ciclo+"/"+region;
  var pendiente = 0;
  var resuelto = 0 ;

  $.get(route,function(res){
    if(res.length > 0){
      for (var i =0; res.length > i; i++) {
        if(res[i].estado == "PENDIENTE"){
          pendiente = pendiente +1;

        }else{
          resuelto = resuelto +1;
        }

      }
    }
    var tabla = document.getElementById("detalles2");
    var row = tabla.insertRow(1);
    row.style.backgroundColor = "white";
    var cell1 = row.insertCell(0);
    var cell2 = row.insertCell(1);
    var cell3 = row.insertCell(2);

    cell1.innerHTML = res.length;
    cell2.innerHTML = resuelto;
    cell3.innerHTML = pendiente;

  });

}


function busca_listas_mes(){
  document.getElementById("detalles4").deleteRow(1);

  var ciclo = document.getElementById('ciclo_escolar').value;
  var region = document.getElementById('region').value;
  var mes = document.getElementById('mes').value;

  var route = "http://localhost:8000/busca_listas_mes/"+ciclo+"/"+region+"/"+mes;
  var pendiente = 0;
  var resuelto = 0 ;

  $.get(route,function(res){
    if(res.length > 0){
      for (var i =0; res.length > i; i++) {
        if(res[i].estado == "PENDIENTE"){
          pendiente = pendiente +1;

        }else{
          resuelto = resuelto +1;
        }

      }
    }
    var tabla = document.getElementById("detalles4");
    var row = tabla.insertRow(1);
    row.style.backgroundColor = "white";
    var cell1 = row.insertCell(0);
    var cell2 = row.insertCell(1);
    var cell3 = row.insertCell(2);

    cell1.innerHTML = res.length;
    cell2.innerHTML = resuelto;
    cell3.innerHTML = pendiente;

  });

}

function busca_listas_esc(){
  document.getElementById("detalles3").deleteRow(1);

  var region = document.getElementById('region').value;
  var cct = document.getElementById('escuela').value;

  var route = "http://localhost:8000/busca_listas_esc/"+region+"/"+cct;
  var activo = 0;
  var recibidos = 0;
  var pendientes = 0;


  $.get(route,function(res){
   console.log(route);
   console.log(res);
   if(res.length > 0){
     for (var i =0; res.length > i; i++) {
       if(res[i].estado == "ACTIVO"){
         activo = activo +1;

       }

       if(res[i].estado = "PENDIENTE"){
         pendientes=pendientes+1;
       }else if (res[i].estado = "ACTIVO") {
        recibidos=recibidos+1;
      }


    }
  }
  var tabla = document.getElementById("detalles3");
  var row = tabla.insertRow(1);
  row.style.backgroundColor = "white";
  var cell1 = row.insertCell(0);
  var cell2 = row.insertCell(1);
  var cell3 = row.insertCell(2);


  cell1.innerHTML = res.length;
  cell2.innerHTML = recibidos;
  cell3.innerHTML = pendientes;


});


}

function buscar_qnas_pagos(){
  var x = document.getElementById('qna');
  if (x.length > 0){
    for (var i = 0; i < x.length; i++) {
      x.remove(i);
    }}


    var x= document.getElementById('ciclo_escolar').value;
    var route = "http://localhost:8000/buscar_qnas_pagos/"+x+"/";

    $.get(route,function(res){
      if(res.length > 0){
        for (var i =0; res.length > i; i++) {

         var x = document.getElementById("qna");
         var option = document.createElement("option");
         option.text = res[i].qna ;
         option.value = res[i].qna;
         x.add(option, x[i])
       }
     }

   });}

    function valida_cuadrocifras(){
      var ded= document.getElementById('deducciones').value;
      var liq= document.getElementById('liquido').value;
      var perc=document.getElementById('percepc').value;

      var aux = perc-ded;
      if(aux != liq){

       swal("Alerta!", "Montos Incorrectos, el Liquido Tiene que Ser Igual que la Percepción menos la Deducción!", "error");
       return false;

     }

   }

   function traer_escuelasforta(){

    var x = document.getElementById('cct');
    if (x.length > 0){
      for (var i = 0; i < x.length; i++) {
        x.remove(i);
      }}


      var x = document.getElementById('ciclo_escolar').value;

      var route = "http://localhost:8000/traer_escuelasforta/"+x+"/";
      $.get(route,function(res){
        if(res.length > 0){
          for (var i =0; res.length > i; i++) {
           var x = document.getElementById("cct");
           var option = document.createElement("option");
           option.text = res[i].cct +" - "+ res[i].nombre_escuela +" "+res[i].id_centro ;
           option.value = res[i].id_centro;
           x.add(option, x[i])
         }
       }

     });
    }

    //tabla.setAttribute("id", id2);

////////NUMEROS A LETRAS////////////////////////////////////
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

function guardar_reintegro(){
  var z = 1
  var arreglo_c = [];
  var table = document.getElementById('detalles3');
  for (var r = 1, n = table.rows.length-1; r < n; r++) {
    for (var c = 1, m = table.rows[r].cells.length; c < m; c++) {
     if (z == 1){
      arreglo_c.push(table.rows[r].cells[c].innerHTML);
      z ++;
    }

    else if(z == 2){
     arreglo_c.push(table.rows[r].cells[c].innerHTML);
     z ++;
   }else if(z == 3){
     arreglo_c.push(table.rows[r].cells[c].innerHTML);
     z ++;
   }else if(z == 4){
     arreglo_c.push(table.rows[r].cells[c].innerHTML);
     z ++;
   }else{
    arreglo_c.push(table.rows[r].cells[c].innerHTML);
    document.getElementById("c_copia").value=arreglo_c;
    z = 1;

  }
}
}
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
          console.log("entro a directorio si");
        }
      }
    }

    console.log(res);
  });


  ;

  console.log(dire);

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
/*
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
*/
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

function traercct(){
  var cct = document.getElementById("id_centro_trabajo").value;

  var route = "http://localhost:8000/traercct/"+cct;

  $.get(route,function(res){
      console.log(res);
    if(res.length > 0){
      for (var i = 0; i < res.length; i++) {
        if(res[i].estado =="ACTIVO"){
          var x = document.getElementById("id_reg");
          var option = document.createElement("option");
          option.text = res[i].id+"_"+res[i].id_region;
          option.value = res[i].id_region;

          x.add(option, x[i]);
          console.log(option.value);

        }

      }
    }
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
          option.value = res[i].nombre +"_"+res[i].categoria +"_"+res[i].sostenimiento +"_"+res[i].id_cct_etc;

          x.add(option, x[i]);

        }
        console.log(x.value);
      }
    }

  });
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


function validar_quincenaIna(){
  var qna= document.getElementById("qna").value;
  var sostenimiento= document.getElementById("sostenimiento").value;
  var tipo= document.getElementById("tipo").value;
  var route = "http://localhost:8000/validar_quincenaIna/"+qna+"/"+sostenimiento+"/"+tipo;
  var fileInput = document.getElementById('file');
  var filePath = fileInput.value;


  $.get(route,function(res){

    if(res.length > 0 ){

      for (var i=0; i < res.length; i++){
        if(res[i].estado=="INACTIVO"){

          document.getElementById('submit').disabled=true;
          swal("ERROR!","La Quincena << "+qna+" >> <<"+sostenimiento+">> que intenta registrar está en un estado <<INACTIVO>>, <<ACTIVAR>> y seguir con el registro.","error");
             //  document.getElementById("error_nominacapturada").innerHTML = "La Quincena que intenta registrar ya ha sido insertada anteriormente";
             fileInput.value = '';
             return false;
           }

         }

       }

     });
   //
 }

 function valida_file_cargar(){
  var fileInput = document.getElementById('file');
  var filePath = fileInput.value;
  var allowedExtensions = /(.csv|.csv)$/i;

  if( document.getElementById("file").files.length == 0 ){

      //swal("ERROR!","No se ha seleccionado ninguna Nomina.","error");
      document.getElementById("error_file").innerHTML = "Carga tu nomina.";
      return false
    }else{

      if(!allowedExtensions.exec(filePath)){
        swal("WARNING!",'Solo es permitido subir archivos con extención ".csv y .xlsx" o de tipo Excel verifique sus datos',"warning");
        fileInput.value = '';
        return false;
      }
      document.getElementById('submit').disabled=false;

    }

  }


  function busca_dias_captura(){
    document.getElementById("detalles").deleteRow(1);

    var ciclo = document.getElementById('ciclo_escolar').value;
    document.getElementById('generar').href="http://localhost:8000/pdf_captura1/"+ciclo;
    var route = "http://localhost:8000/busca_dias_captura/"+ciclo;

    document.getElementById('excel_capturas').href="http://localhost:8000/descargar-listas-capturas/"+ciclo;
    var director= 0;
    var docente = 0;
    var intendente = 0;
    var activo = 0;
    var estatal = 0;
    var federal = 0;
    var recibidos = 0;
    var pendientes = 0;

    $.get(route,function(res){

      if(res.length > 0){
        for (var i =0; res.length > i; i++) {
          if(res[i].estado == "ACTIVO"){
            activo = activo +1;

          }


          if(res[i].categoria == "DIRECTOR"){
            director=director+1;
          }else if(res[i].categoria == "DOCENTE" || res[i].categoria == "USAER" || res[i].categoria == "EDUCACION FISICA"){
            docente=docente+1;
          }else{
            intendente= intendente+1;
          }

          if(res[i].sostenimiento == "ESTATAL"){
            estatal=estatal+1;
          }else if(res[i].sostenimiento == "FEDERAL"){
            federal=federal+1;
          }

          if(res[i].qna_actual != 0){
            recibidos=recibidos+1;
          }else if(res[i].qna_actual == 0){
            pendientes=pendientes+1;
          }

        }
      }
      var tabla = document.getElementById("detalles");
      var row = tabla.insertRow(1);
      row.style.backgroundColor = "white";
      var cell1 = row.insertCell(0);
      var cell2 = row.insertCell(1);
      var cell3 = row.insertCell(2);
      var cell4 = row.insertCell(3);
      var cell5 = row.insertCell(4);
      var cell6 = row.insertCell(5);
      var cell7 = row.insertCell(6);
      var cell8 = row.insertCell(7);

      cell1.innerHTML = res.length;
      cell2.innerHTML = director;
      cell3.innerHTML = docente;
      cell4.innerHTML =  intendente;
      cell5.innerHTML =  estatal;
      cell6.innerHTML =  federal;
      cell7.innerHTML = recibidos;
      cell8.innerHTML =  pendientes;


    });


  }

  function busca_dias_captura_region(){
    document.getElementById("detalles2").deleteRow(1);

    var ciclo = document.getElementById('ciclo_escolar').value;
    var region = document.getElementById('region').value;

    var route = "http://localhost:8000/busca_dias_captura_region/"+region+"/"+ciclo;
    var director= 0;
    var docente = 0;
    var intendente = 0;
    var activo = 0;
    var recibidos = 0;
    var pendientes = 0;


    $.get(route,function(res){

     if(res.length > 0){
       for (var i =0; res.length > i; i++) {
         if(res[i].estado == "ACTIVO"){
           activo = activo +1;
         }


         if(res[i].categoria == "DIRECTOR"){
           director=director+1;
         }else if(res[i].categoria == "DOCENTE" || res[i].categoria == "USAER" || res[i].categoria == "EDUCACION FISICA"){
           docente=docente+1;
         }else{
           intendente= intendente+1;
         }

         if(res[i].qna_actual != 0){
           recibidos=recibidos+1;
         }else if(res[i].qna_actual == 0){
           pendientes=pendientes+1;
         }


       }
     }
     var tabla = document.getElementById("detalles2");
     var row = tabla.insertRow(1);
     row.style.backgroundColor = "white";
     var cell1 = row.insertCell(0);
     var cell2 = row.insertCell(1);
     var cell3 = row.insertCell(2);
     var cell4 = row.insertCell(3);
     var cell5 = row.insertCell(4);
     var cell6 = row.insertCell(5);

     cell1.innerHTML = res.length;
     cell2.innerHTML = director;
     cell3.innerHTML = docente;
     cell4.innerHTML =  intendente;
     cell5.innerHTML = recibidos;
     cell6.innerHTML =  pendientes;

   });


  }



  function escs(){

    var esc = document.getElementById("region").value;

    var route = "http://localhost:8000/traerescuelas/"+esc;


    $.get(route,function(res){
      if(res.length > 0){

        for (var i = 0; i < res.length; i++) {
          if(res[i].estado =="ACTIVO"){
            var x = document.getElementById("escuela");
            var option = document.createElement("option");
            option.text = res[i].nombre_escuela +" "+res[i].cct;
            option.value = res[i].id;

            x.add(option, x[i]);

          }
        }
      }

    });

  }


  function busca_captura_esc(){
    console.log(route);
    document.getElementById("detalles3").deleteRow(1);

    var region = document.getElementById('region').value;
    var cct = document.getElementById('escuela').value;

    var route = "http://localhost:8000/busca_captura_esc/"+region+"/"+cct;
    var director= 0;
    var docente = 0;
    var intendente = 0;
    var activo = 0;
    var recibidos = 0;
    var pendientes = 0;


    $.get(route,function(res){
     console.log(route);
     console.log(res);
     if(res.length > 0){
       for (var i =0; res.length > i; i++) {
         if(res[i].estado == "ACTIVO"){
           activo = activo +1;
         }


         if(res[i].categoria == "DIRECTOR"){
           director=director+1;
         }else if(res[i].categoria == "DOCENTE" || res[i].categoria == "USAER" || res[i].categoria == "EDUCACION FISICA"){
           docente=docente+1;
         }else{
           intendente= intendente+1;
         }

         if(res[i].qna_actual != 0){
           recibidos=recibidos+1;
         }else if(res[i].qna_actual == 0){
           pendientes=pendientes+1;
         }


       }
     }
     var tabla = document.getElementById("detalles3");
     var row = tabla.insertRow(1);
     row.style.backgroundColor = "white";
     var cell1 = row.insertCell(0);
     var cell2 = row.insertCell(1);
     var cell3 = row.insertCell(2);
     var cell4 = row.insertCell(3);
     var cell5 = row.insertCell(4);
     var cell6 = row.insertCell(5);

     cell1.innerHTML = res.length;
     cell2.innerHTML = director;
     cell3.innerHTML = docente;
     cell4.innerHTML =  intendente;
     cell5.innerHTML = recibidos;
     cell6.innerHTML =  pendientes;

   });


  }

  function busca_captura_ciclo(){


   var ciclo = document.getElementById('ciclo_escolar').value;

   document.getElementById('invoice').href="http://localhost:8000/pdf_captura/"+ciclo;


 var route = "http://localhost:8000/busca_captura_ciclo/"+ciclo; //hacer ruta

 document.getElementById('excel_capturas').href="http://localhost:8000/descargar-listas-captura/"+ciclo; //cheacr ruta


}




function traer_montos_forta(){
  var route = "http://localhost:8000/traer_montos_forta/"+x+"/";
  $.get(route,function(res){
    if(res.length > 0){
      for (var i =0; res.length > i; i++) {
       document.getElementById("monto_forta").value = res[i].monto_forta;
     }
   }

 });
}

function currencyFormat(num) {
  return '$' + num.toFixed(2).replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
}

function busca_fortas(){
  document.getElementById("detalles").deleteRow(1);

  var ciclo = document.getElementById('ciclo_escolar').value;

  document.getElementById('pdf_fortalecimiento').href="http://localhost:8000/pdf_fortalecimiento/"+ciclo;

  var route = "http://localhost:8000/busca_forta/"+ciclo;

  document.getElementById('descargar-fortalecimiento').href="http://localhost:8000/descargar-fortalecimiento/"+ciclo;

  var activo = 0;
  var total= 0;
  var estatal = 0;
  var federal = 0;
  var totest = 0;
  var totfed = 0;

  $.get(route,function(res){

    if(res.length > 0){
      for (var i =0; res.length > i; i++) {
        if(res[i].estado == "ACTIVO"){
          activo = activo +1;

        }

        if(res[i].sostenimiento == "ESTATAL" || res[i].sostenimiento == " ESTATAL" ){
          estatal=estatal+1;
          totest= res[i].monto_forta * estatal;

        }else if(res[i].sostenimiento == "FEDERAL" || res[i].sostenimiento == " FEDERAL" ){
          federal=federal+1;
          totfed= res[i].monto_forta * federal;
        }

        if(res[i].monto_forta != 0){
          total= totest + totfed;
        }

      /*  if(res[i].qna_actual != 0){
          recibidos=recibidos+1;
        }else if(res[i].qna_actual == 0){
          pendientes=pendientes+1;
        }
        */
      }
    }
    var tabla = document.getElementById("detalles");
    var row = tabla.insertRow(1);
    row.style.backgroundColor = "white";
    var cell1 = row.insertCell(0);
    var cell2 = row.insertCell(1);
    var cell3 = row.insertCell(2);
    var cell4 = row.insertCell(3);
    var cell5 = row.insertCell(4);
    var cell6 = row.insertCell(5);


    cell1.innerHTML = res.length;
    cell2.innerHTML = currencyFormat(total);
    cell3.innerHTML =  estatal;
    cell4.innerHTML =  currencyFormat(totest);
    cell5.innerHTML =  federal;
    cell6.innerHTML =  currencyFormat(totfed);


  });


}


function busca_forta_region(){
  document.getElementById("detalles2").deleteRow(1);

  var ciclo = document.getElementById('ciclo_escolar').value;
  var region = document.getElementById('region').value;

  var route = "http://localhost:8000/busca_forta_region/"+region+"/"+ciclo;

  var activo = 0;
  var total= 0;
  var estatal = 0;
  var federal = 0;
  var totest = 0;
  var totfed = 0;



  $.get(route,function(res){
   console.log(res);
   if(res.length > 0){
     for (var i =0; res.length > i; i++) {
       if(res[i].estado == "ACTIVO"){
         activo = activo +1;
       }


       if(res[i].sostenimiento == "ESTATAL" || res[i].sostenimiento == " ESTATAL" ){
        estatal=estatal+1;
        totest= res[i].monto_forta * estatal;

      }else if(res[i].sostenimiento == "FEDERAL" || res[i].sostenimiento == " FEDERAL" ){
        federal=federal+1;
        totfed= res[i].monto_forta * federal;
      }

      if(res[i].monto_forta != 0){
        total= totest + totfed;
      }


    }
  }



  var tabla = document.getElementById("detalles2");
  var row = tabla.insertRow(1);
  row.style.backgroundColor = "white";
  var cell1 = row.insertCell(0);
  var cell2 = row.insertCell(1);
  var cell3 = row.insertCell(2);
  var cell4 = row.insertCell(3);



  cell1.innerHTML = res.length;
  cell2.innerHTML = currencyFormat(total);
  // cell3.innerHTML =  totest.toFixed(2);
  // cell4.innerHTML =  totfed.toFixed(2);
  cell3.innerHTML =  currencyFormat(totest);
  cell4.innerHTML =  currencyFormat(totfed);

});

}



function busca_solis(){
  document.getElementById("detalles").deleteRow(1);

  var ciclo = document.getElementById('ciclo_escolar').value;

  document.getElementById('pdf_solicitudes').href="http://localhost:8000/pdf_solicitudes/"+ciclo;

  var route = "http://localhost:8000/busca_solis/"+ciclo;

  document.getElementById('descargar-solicitudes').href="http://localhost:8000/descargar-solicitudes/"+ciclo;

  var activo = 0;
  var estatal = 0;
  var federal = 0;
  var resest = 0;
  var tramest = 0;
  var resfed = 0;
  var tramfed = 0;

  $.get(route,function(res){

    if(res.length > 0){
      for (var i =0; res.length > i; i++) {
        if(res[i].estado == "ACTIVO"){
          activo = activo +1;

        }

        if(res[i].sostenimiento == "ESTATAL"){
          estatal=estatal+1;

          if (res[i].tramite_estado == "Resuelto") {
            resest = resest + 1;
          }else if (res[i].tramite_estado == "En Tramite") {
            tramest = tramest + 1;
          }

        }else if(res[i].sostenimiento == "FEDERAL"){
          federal=federal+1;

          if (res[i].tramite_estado == "Resuelto") {
            resfed = resfed + 1;
          }else if (res[i].tramite_estado == "En Tramite") {
            tramfed = tramfed + 1;
          }

        }


      /*  if(res[i].qna_actual != 0){
          recibidos=recibidos+1;
        }else if(res[i].qna_actual == 0){
          pendientes=pendientes+1;
        }
        */
      }
    }
    var tabla = document.getElementById("detalles");
    var row = tabla.insertRow(1);
    row.style.backgroundColor = "white";
    var cell1 = row.insertCell(0);
    var cell2 = row.insertCell(1);
    var cell3 = row.insertCell(2);
    var cell4 = row.insertCell(3);

    cell1.innerHTML = res[0].dias;
    cell2.innerHTML = "INTENDENTE";
    cell3.innerHTML = new Intl.NumberFormat().format(inte);
    cell4.innerHTML = "$"+ new Intl.NumberFormat().format(total_inte);


    var cell5 = row.insertCell(4);
    var cell6 = row.insertCell(5);
    var cell7 = row.insertCell(6);


    cell1.innerHTML = res.length;
    cell2.innerHTML =  estatal;
    cell3.innerHTML =  resest;
    cell4.innerHTML =  tramest;
    cell5.innerHTML =  federal;
    cell6.innerHTML =  resfed;
    cell7.innerHTML =  tramfed;

  });
}


function busca_solis_region(){
  document.getElementById("detalles2").deleteRow(1);

  var ciclo = document.getElementById('ciclo_escolar').value;
  var region = document.getElementById('region').value;

  var route = "http://localhost:8000/busca_solis_region/"+region+"/"+ciclo;

  var activo = 0;
  var estatal = 0;
  var federal = 0;
  var resest = 0;
  var tramest = 0;
  var resfed = 0;
  var tramfed = 0;


  $.get(route,function(res){
   console.log(res);
   if(res.length > 0){
     for (var i =0; res.length > i; i++) {
       if(res[i].estado == "ACTIVO"){
         activo = activo +1;
       }


       if(res[i].sostenimiento == "ESTATAL"){
        estatal=estatal+1;

        if (res[i].tramite_estado == "Resuelto") {
          resest = resest + 1;
        }else if (res[i].tramite_estado == "En Tramite") {
          tramest = tramest + 1;
        }

      }else if(res[i].sostenimiento == "FEDERAL"){
        federal=federal+1;

        if (res[i].tramite_estado == "Resuelto") {
          resfed = resfed + 1;
        }else if (res[i].tramite_estado == "En Tramite") {
          tramfed = tramfed + 1;
        }

      }


    }
  }

  var tabla = document.getElementById("detalles2");
  var row = tabla.insertRow(1);
  row.style.backgroundColor = "white";
  var cell1 = row.insertCell(0);
  var cell2 = row.insertCell(1);
  var cell3 = row.insertCell(2);
  var cell4 = row.insertCell(3);
  var cell5 = row.insertCell(4);
  var cell6 = row.insertCell(5);
  var cell7 = row.insertCell(6);


  cell1.innerHTML = res.length;
  cell2.innerHTML =  estatal;
  cell3.innerHTML =  resest;
  cell4.innerHTML =  tramest;
  cell5.innerHTML =  federal;
  cell6.innerHTML =  resfed;
  cell7.innerHTML =  tramfed;

});


}


function soli_nivel() {
 if( document.getElementById('nivel').value == "Selecciona una opción"){

   document.getElementById('cct').disabled=true;
   document.getElementById('ciclo').disabled=true;
   document.getElementById('municipio').disabled=true;
   document.getElementById('localidad').disabled=true;
   document.getElementById('acta').disabled=true;
   document.getElementById('inco').disabled=true;
   document.getElementById('psv').disabled=true;
   document.getElementById('cnh').disabled=true;
   document.getElementById('carta').disabled=true;
   document.getElementById('acta_cons').disabled=true;
   document.getElementById('cps').disabled=true;
   document.getElementById('ctcs').disabled=true;
   document.getElementById('tramite').disabled=true;
   document.getElementById('submit').disabled=true;

        //  swal("ERROR!","Selecciona tipo se puesto","error");
        document.getElementById("error_nivel").innerHTML = "Seleccione una opción para desabilitar los campos.";
        return false
      }else{
       document.getElementById('cct').disabled=false;
       document.getElementById("error_nivel").innerHTML = "";
     }
   }

   function soli_cct() {
     if( document.getElementById('cct').value == "Selecciona una opción"){

       document.getElementById('ciclo').disabled=true;
        //  swal("ERROR!","Selecciona tipo se puesto","error");

      }else{
       document.getElementById('ciclo').disabled=false;

     }
   }

   function soli_ciclo() {
     if( document.getElementById('ciclo').value == "Selecciona una opción"){

       document.getElementById('municipio').disabled=true;
        //  swal("ERROR!","Selecciona tipo se puesto","error");

      }else{
       document.getElementById('municipio').disabled=false;

     }
   }

   function soli_mun() {
     if( document.getElementById('municipio').value == "Selecciona una opción"){

       document.getElementById('localidad').disabled=true;
        //  swal("ERROR!","Selecciona tipo se puesto","error");

      }else{
       document.getElementById('localidad').disabled=false;

     }
   }

   function soli_loc() {
     if( document.getElementById('localidad').value == "Selecciona una opción"){

       document.getElementById('acta').disabled=true;
        //  swal("ERROR!","Selecciona tipo se puesto","error");

      }else{
       document.getElementById('acta').disabled=false;

     }
   }

   function soli_acta() {
     if( document.getElementById('acta').value == "Selecciona una opción"){

       document.getElementById('inco').disabled=true;
        //  swal("ERROR!","Selecciona tipo se puesto","error");

      }else{
       document.getElementById('inco').disabled=false;

     }
   }

   function soli_inco() {
     if( document.getElementById('inco').value == "Selecciona una opción"){

       document.getElementById('psv').disabled=true;
        //  swal("ERROR!","Selecciona tipo se puesto","error");

      }else{
       document.getElementById('psv').disabled=false;

     }
   }

   function soli_psv() {
     if( document.getElementById('psv').value == "Selecciona una opción"){

       document.getElementById('cnh').disabled=true;
        //  swal("ERROR!","Selecciona tipo se puesto","error");

      }else{
       document.getElementById('cnh').disabled=false;

     }
   }

   function soli_cnh() {
     if( document.getElementById('cnh').value == "Selecciona una opción"){

       document.getElementById('carta').disabled=true;
        //  swal("ERROR!","Selecciona tipo se puesto","error");

      }else{
       document.getElementById('carta').disabled=false;

     }
   }

   function soli_carta() {
     if( document.getElementById('carta').value == "Selecciona una opción"){

       document.getElementById('acta_cons').disabled=true;
        //  swal("ERROR!","Selecciona tipo se puesto","error");

      }else{
       document.getElementById('acta_cons').disabled=false;

     }
   }

   function soli_acta_cons() {
     if( document.getElementById('acta_cons').value == "Selecciona una opción"){

       document.getElementById('cps').disabled=true;
        //  swal("ERROR!","Selecciona tipo se puesto","error");

      }else{
       document.getElementById('cps').disabled=false;

     }
   }

   function soli_cps() {
     if( document.getElementById('cps').value == "Selecciona una opción"){

       document.getElementById('ctcs').disabled=true;
        //  swal("ERROR!","Selecciona tipo se puesto","error");

      }else{
       document.getElementById('ctcs').disabled=false;

     }
   }

   function soli_ctcs() {
     if( document.getElementById('ctcs').value == "Selecciona una opción"){

       document.getElementById('tramite').disabled=true;
        //  swal("ERROR!","Selecciona tipo se puesto","error");

      }else{
       document.getElementById('tramite').disabled=false;

     }

   }

   function soli_tramite() {
     if( document.getElementById('tramite').value == "Selecciona una opción"){

       document.getElementById('submit').disabled=true;
        //  swal("ERROR!","Selecciona tipo se puesto","error");

      }else{
       document.getElementById('submit').disabled=false;

     }

   }





   function ver_plan_region(ciclo){

    var c = document.getElementById('detalles2').rows;
    if (c.length == 6){
      for (var i = 1; i < 5; i++) {
        document.getElementById("detalles2").deleteRow(1);
      }
    }


    var x = document.getElementById('region').value;
    var route = "http://localhost:8000/ver_plan_region/"+ciclo+"/"+x+"/";
    $.get(route,function(res){


      var tabla = document.getElementById("detalles2");


      var row = tabla.insertRow(1);
      row.style.backgroundColor = "rgb(219, 255, 194)";
      var cell1 = row.insertCell(0);
      var cell2 = row.insertCell(1);
      var cell3 = row.insertCell(2);
      var cell4 = row.insertCell(3);
      var cell5 = row.insertCell(4);

      cell1.innerHTML = "Total";
      cell2.innerHTML = res[3];
      cell3.innerHTML = "$"+ new Intl.NumberFormat().format(res[7]);
      cell4.innerHTML = "$"+ new Intl.NumberFormat().format(res[11]);
      cell5.innerHTML = "$"+ new Intl.NumberFormat().format(res[15]);

      var row = tabla.insertRow(1);
      row.style.backgroundColor = "rgb(219, 255, 194)";
      var cell1 = row.insertCell(0);
      var cell2 = row.insertCell(1);
      var cell3 = row.insertCell(2);
      var cell4 = row.insertCell(3);
      var cell5 = row.insertCell(4);

      cell1.innerHTML = "Intendentes";
      cell2.innerHTML = new Intl.NumberFormat().format(res[2].total_intendente);
      cell3.innerHTML = "$"+ new Intl.NumberFormat().format(res[6].total_perce_inte);
      cell4.innerHTML = "$"+ new Intl.NumberFormat().format(res[10].total_dedu_inte);
      cell5.innerHTML = "$"+ new Intl.NumberFormat().format(res[14]);


      var row = tabla.insertRow(1);
      row.style.backgroundColor = "rgb(219, 255, 194)";
      var cell1 = row.insertCell(0);
      var cell2 = row.insertCell(1);
      var cell3 = row.insertCell(2);
      var cell4 = row.insertCell(3);
      var cell5 = row.insertCell(4);

      cell1.innerHTML = "Docentes";
      cell2.innerHTML = res[1].total_docente;
      cell3.innerHTML = "$"+ new Intl.NumberFormat().format(res[5].total_perce_doce);
      cell4.innerHTML = "$"+new Intl.NumberFormat().format(res[9].total_dedu_doce);
      cell5.innerHTML = "$"+new Intl.NumberFormat().format(res[13]);


      var row = tabla.insertRow(1);
      row.parentNode.style.backgroundColor = "rgb(219, 255, 194)";
    //row.style.backgroundColor = "#DBFFC";
    var cell1 = row.insertCell(0);
    var cell2 = row.insertCell(1);
    var cell3 = row.insertCell(2);
    var cell4 = row.insertCell(3);
    var cell5 = row.insertCell(4);

    cell1.innerHTML = "Directores";
    cell2.innerHTML = res[0].total_director;
    cell3.innerHTML = "$"+ new Intl.NumberFormat().format(res[4].total_perce_dire);
    cell4.innerHTML = "$"+ new Intl.NumberFormat().format(res[8].total_dedu_dire);
    cell5.innerHTML = "$"+ new Intl.NumberFormat().format(res[12]);





  });
  }





  function calculo_nomina(callback){

    limpiar_input_select('qna');

    var ciclo = document.getElementById('ciclo_escolar2').value;


    var route = "http://localhost:8000/buscar_qnas_activas/"+ciclo;

    var route = "http://localhost:8000/buscar_qnas_activas/"+ciclo;


    $.get(route,function(res){
      for (var p = 0 ; p < res.length; p++) {
        var x = document.getElementById("qna");
        var option = document.createElement("option");
        option.text = res[p].qna ;
        option.value = res[p].id;
        x.add(option, x[p])
      }
    });

    setTimeout(function(){calculo_qna_nominas()},500);
  }

  function limpiar_input_select(id){
    document.getElementById(id).innerHTML = "";

  }



  function calculo_qna_nominas(callback){
    var c = document.getElementById("dynamic-table").rows.length;
    for (var i = 1; i < c; i++) {
      document.getElementById("dynamic-table").deleteRow(1);
    }
  }
  function calculo_qna_nominas(callback){
    var c = document.getElementById("dynamic-table").rows.length;
    for (var i = 1; i < c; i++) {
      document.getElementById("dynamic-table").deleteRow(1);
    }


    var qna = document.getElementById('qna');

    var route = "http://localhost:8000/montos_qnas/"+qna.value;
    $.get(route,function(res){

      pago_dire=res[0].pago_director;
      pago_doce=res[0].pago_docente;
      pago_inte=res[0].pago_intendente;

      dire=res[1].total_registros;
      doce=res[2].total_registros;
      inte=res[3].total_registros;
      total= dire+doce+inte;



      total_dire=dire * pago_dire;
      total_doce=doce * pago_doce;
      total_inte=inte * pago_inte;
      total_monto=total_dire+total_doce+total_inte;


      var tabla = document.getElementById("dynamic-table");
      var row = tabla.insertRow(1);

      var tabla = document.getElementById("dynamic-table");
      var row = tabla.insertRow(1);

    //row.style.backgroundColor = "rgb(219, 255, 194)";
    var cell1 = row.insertCell(0);
    var cell2 = row.insertCell(1);
    var cell3 = row.insertCell(2);
    var cell4 = row.insertCell(3);
    cell1.innerHTML = "Total Dias: "+res[0].dias;
    cell2.innerHTML = "Total Personal";
    cell3.innerHTML = new Intl.NumberFormat().format(total);
    cell4.innerHTML = "$"+ new Intl.NumberFormat().format(total_monto);


    var tabla = document.getElementById("dynamic-table");
    var row = tabla.insertRow(1);
    row.style.backgroundColor = "rgb(219, 255, 194)";
    var cell1 = row.insertCell(0);
    var cell2 = row.insertCell(1);
    var cell3 = row.insertCell(2);
    var cell4 = row.insertCell(3);


    cell1.innerHTML = res[0].dias;
    cell2.innerHTML = "DIRECTOR";
    cell3.innerHTML = new Intl.NumberFormat().format(dire);
    cell4.innerHTML = "$"+ new Intl.NumberFormat().format(total_dire);

    var tabla = document.getElementById("dynamic-table");
    var row = tabla.insertRow(1);
    row.style.backgroundColor = "rgb(219, 255, 194)";
    var cell1 = row.insertCell(0);
    var cell2 = row.insertCell(1);
    var cell3 = row.insertCell(2);
    var cell4 = row.insertCell(3);
    cell1.innerHTML = res[0].dias;
    cell2.innerHTML = "DOCENTE";
    cell3.innerHTML = new Intl.NumberFormat().format(doce);
    cell4.innerHTML = "$"+ new Intl.NumberFormat().format(total_doce);

    var tabla = document.getElementById("dynamic-table");
    var row = tabla.insertRow(1);
    row.style.backgroundColor = "rgb(219, 255, 194)";
    var cell1 = row.insertCell(0);
    var cell2 = row.insertCell(1);
    var cell3 = row.insertCell(2);
    var cell4 = row.insertCell(3);
    cell1.innerHTML = res[0].dias;
    cell2.innerHTML = "INTENDENTE";
    cell3.innerHTML = new Intl.NumberFormat().format(inte);
    cell4.innerHTML = "$"+ new Intl.NumberFormat().format(total_inte);





  });
    setTimeout(function(){calculo_nomina_region()},500);

  }






  function calculo_nomina_region(){
    var c = document.getElementById("detalles2").rows.length;
    for (var i = 1; i < c; i++) {
      document.getElementById("detalles2").deleteRow(1);
    }

    var qna = document.getElementById('qna');
    var region = document.getElementById('region').value;
    var ciclo = document.getElementById('ciclo_escolar2').value;

    var route = "http://localhost:8000/montos_qnas_region/"+qna.value+"/"+region+"/"+ciclo;
    $.get(route,function(res){

      pago_dire=res[0].pago_director;
      pago_doce=res[0].pago_docente;
      pago_inte=res[0].pago_intendente;

      dire=res[1].total_registros;
      doce=res[2].total_registros;
      inte=res[3].total_registros;
      total= dire+doce+inte;



      total_dire=dire * pago_dire;
      total_doce=doce * pago_doce;
      total_inte=inte * pago_inte;
      total_monto=total_dire+total_doce+total_inte;


      var tabla = document.getElementById("detalles2");
      var row = tabla.insertRow(1);

      var tabla = document.getElementById("detalles2");
      var row = tabla.insertRow(1);

    //row.style.backgroundColor = "rgb(219, 255, 194)";
    var cell1 = row.insertCell(0);
    var cell2 = row.insertCell(1);
    var cell3 = row.insertCell(2);
    var cell4 = row.insertCell(3);
    cell1.innerHTML = "Total Dias: "+res[0].dias;
    cell2.innerHTML = "Total Personal";
    cell3.innerHTML = new Intl.NumberFormat().format(total);
    cell4.innerHTML = "$"+ new Intl.NumberFormat().format(total_monto);


    var tabla = document.getElementById("detalles2");
    var row = tabla.insertRow(1);
    row.style.backgroundColor = "rgb(219, 255, 194)";
    var cell1 = row.insertCell(0);
    var cell2 = row.insertCell(1);
    var cell3 = row.insertCell(2);
    var cell4 = row.insertCell(3);


    cell1.innerHTML = res[0].dias;
    cell2.innerHTML = "DIRECTOR";
    cell3.innerHTML = new Intl.NumberFormat().format(dire);
    cell4.innerHTML = "$"+ new Intl.NumberFormat().format(total_dire);

    var tabla = document.getElementById("detalles2");
    var row = tabla.insertRow(1);
    row.style.backgroundColor = "rgb(219, 255, 194)";
    var cell1 = row.insertCell(0);
    var cell2 = row.insertCell(1);
    var cell3 = row.insertCell(2);
    var cell4 = row.insertCell(3);
    cell1.innerHTML = res[0].dias;
    cell2.innerHTML = "DOCENTE";
    cell3.innerHTML = new Intl.NumberFormat().format(doce);
    cell4.innerHTML = "$"+ new Intl.NumberFormat().format(total_doce);

    var tabla = document.getElementById("detalles2");
    var row = tabla.insertRow(1);
    row.style.backgroundColor = "rgb(219, 255, 194)";
    var cell1 = row.insertCell(0);
    var cell2 = row.insertCell(1);
    var cell3 = row.insertCell(2);
    var cell4 = row.insertCell(3);
    cell1.innerHTML = res[0].dias;
    cell2.innerHTML = "INTENDENTE";
    cell3.innerHTML = new Intl.NumberFormat().format(inte);
    cell4.innerHTML = "$"+ new Intl.NumberFormat().format(total_inte);





  });

  }






  function filtro_centros(callback){
    limpiar_input_select('option2');
    var x = document.getElementById('option1').value;
    var route = "http://localhost:8000/ver_opciones/"+x+"/";
    $.get(route,function(res){
      var z = res[1];
      for (var p = 0 ; p < res[0].length; p++) {
        var x = document.getElementById("option2");
        var option = document.createElement("option");
        if (z == 2){
          option.text = res[0][p].region + " "+ res[0][p].sostenimiento ;
          option.value = res[0][p].id;

        }else if(z == 3){
          option.text = res[0][p].municipio ;
          option.value = res[0][p].id;

        }else if (z == 4){
          option.text = res[0][p].nom_loc +" - "+res[0][p].municipio;
          option.value = res[0][p].id;

        }else if (z == 5){
          option.text = res[0][p].fecha_ingreso;
          option.value = res[0][p].fecha_ingreso;

        }
        x.add(option, x[p])
      }


    });
    setTimeout(function(){ver_centros_filtro()},4000);

  }








  function ver_centros_filtro(){
   var z = document.getElementById("dynamic-table2").rows.length;
   var x = document.getElementById('option1').value;
   var y = document.getElementById('option2').value;
   var route = "http://localhost:8000/ver_centros_filtro/"+x+"/"+y;

   for (var i = 1; i < z; i++) {
    document.getElementById("dynamic-table2").deleteRow(1);
  }


  var c = document.getElementById("dynamic-table3").rows.length;
  for (var i = 1; i < c; i++) {
    document.getElementById("dynamic-table3").deleteRow(1);
  }



  var x = document.getElementById('option1').value;
  var y = document.getElementById('option2').value;
  var route = "http://localhost:8000/ver_centros_filtro/"+x+"/"+y;
  $.get(route,function(res){
    if (res.length > 0){
      var tabla = document.getElementById("dynamic-table2");
      var row = tabla.insertRow(1);
      row.style.backgroundColor = "rgb(219, 255, 194)";
      var cell1 = row.insertCell(0);
      var cell2 = row.insertCell(1);
      var cell3 = row.insertCell(2);
      var cell4 = row.insertCell(3);
      var cell5 = row.insertCell(4);
      var cell6 = row.insertCell(5);
      var cell7 = row.insertCell(6);

      cell1.innerHTML = res[0].total_registros;
      cell2.innerHTML = res[3].total_registros;
      cell3.innerHTML = new Intl.NumberFormat().format(res[4].total_registros);
      cell4.innerHTML =  new Intl.NumberFormat().format(res[1].total_registros);
      cell5.innerHTML =  new Intl.NumberFormat().format(res[2].total_registros);
      cell6.innerHTML =  new Intl.NumberFormat().format(res[5].total_registros);
      cell7.innerHTML =  new Intl.NumberFormat().format(res[6].total_registros);

      for (var p = 0 ; p < res[7].length; p++) {
        var tabla = document.getElementById("dynamic-table3");
        var row = tabla.insertRow(1);
        row.style.backgroundColor = "rgb(219, 255, 194)";
        var cell1 = row.insertCell(0);
        var cell2 = row.insertCell(1);
        var cell3 = row.insertCell(2);
        var cell4 = row.insertCell(3);
        var cell5 = row.insertCell(4);
        var cell6 = row.insertCell(5);
        var cell7 = row.insertCell(6);
        var cell8 = row.insertCell(7);


        cell1.innerHTML = res[7][p].cct;
        cell2.innerHTML = res[7][p].nombre_escuela;
        cell3.innerHTML = res[7][p].nivel;
        cell4.innerHTML = res[7][p].alimentacion;
        cell5.innerHTML = res[7][p].telefono;
        cell6.innerHTML = res[7][p].domicilio;
        cell7.innerHTML = res[7][p].nom_loc;
        cell8.innerHTML = res[7][p].municipio;
      }
    }

  });
}




function traer_num_oficio(callback){
  var x = document.getElementById('ciclo_escolar').value;
  var route = "http://localhost:8000/ultimo_oficio/"+x+"/";
  $.get(route,function(res){
    var z= res;
    if (z >= 1 || z < 9){
      var w="00"+z;

    }else if(z < 99  || z >= 10){
     var w="0".z;

   }else if(z >= 100 || z < 999){
     var w=z;

   }
   document.getElementById('oficio_aux').value=w;

 });
  setTimeout(function(){num_oficio_id()},2000);
}



function oficios_emitidos(){
  var c = document.getElementById("detalles").rows.length;
  for (var i = 1; i < c; i++) {
    document.getElementById("detalles").deleteRow(1);
  }

  var x = document.getElementById('ciclo_escolar').value;
  var w = document.getElementById('area').value;
  var z = 0;
  var y= 0;
  var total= 0;

  document.getElementById('excel').href="/descargar-oficios-emitidos/"+x;
  document.getElementById('excel2').href="/descargar-oficios-emitidos-area/"+x+"/"+w;

  var route = "http://localhost:8000/ver_oficios_ciclo/"+x+"/";
  $.get(route,function(res){
   total= res.length;
   for (var p = 0 ; p < res.length; p++) {
     if(res[p].estado == "RESUELTO"){
      z= z+1;
    }else{
      y = y+1;
    }
  }


  var tabla = document.getElementById("detalles");
  var row = tabla.insertRow(1);
  row.style.backgroundColor = "rgb(219, 255, 194)";
  var cell1 = row.insertCell(0);
  var cell2 = row.insertCell(1);
  var cell3 = row.insertCell(2);
  cell1.innerHTML = total;
  cell2.innerHTML = z;
  cell3.innerHTML = y;

});

}

function oficios_emitidos_area(){
  var c = document.getElementById("detalles2").rows.length;
  for (var i = 1; i < c; i++) {
    document.getElementById("detalles2").deleteRow(1);
  }
  var c = document.getElementById("detalles3").rows.length;
  for (var i = 1; i < c; i++) {
    document.getElementById("detalles3").deleteRow(1);
  }

  var x = document.getElementById('ciclo_escolar').value;
  var w = document.getElementById('area').value;

  var z = 0;
  var y= 0;
  var total= 0;

  var route = "http://localhost:8000/ver_oficios_area/"+x+"/"+w;
  document.getElementById('excel2').href="/descargar-oficios-emitidos-area/"+x+"/"+w;
  $.get(route,function(res){
   total= res.length;
   for (var p = 0 ; p < res.length; p++) {
    var tabla = document.getElementById("detalles3");
    var row = tabla.insertRow(1);
    row.style.backgroundColor = "rgb(219, 255, 194)";
    var cell1 = row.insertCell(0);
    var cell2 = row.insertCell(1);
    var cell3 = row.insertCell(2);
    var cell4 = row.insertCell(3);
    var cell5 = row.insertCell(4);
    var cell6 = row.insertCell(5);
    cell1.innerHTML = res[p].num_oficio;
    cell2.innerHTML = res[p].lic + " "+ res[p].nombre_c;
    cell3.innerHTML = res[p].asunto;
    cell4.innerHTML = res[p].salida;
    cell5.innerHTML = res[p].estado;
    cell6.innerHTML = res[p].nombre;


    if(res[p].estado == "RESUELTO"){
      z= z+1;
    }else{
      y = y+1;
    }
  }
  var tabla = document.getElementById("detalles2");
  var row = tabla.insertRow(1);
  row.style.backgroundColor = "rgb(219, 255, 194)";
  var cell1 = row.insertCell(0);
  var cell2 = row.insertCell(1);
  var cell3 = row.insertCell(2);
  cell1.innerHTML = total;
  cell2.innerHTML = z;
  cell3.innerHTML = y;

});

}


function oficios_recibidos(){
  var c = document.getElementById("detalles").rows.length;
  for (var i = 1; i < c; i++) {
    document.getElementById("detalles").deleteRow(1);
  }

  var x = document.getElementById('ciclo_escolar').value;
  var w = document.getElementById('area').value;
  var z = 0;
  var y= 0;
  var total= 0;

  document.getElementById('excel').href="/descargar-oficios-recibidos/"+x;
  document.getElementById('excel2').href="/descargar-oficios-recibidos-area/"+x+"/"+w;

  var route = "http://localhost:8000/ver_oficiosr_ciclo/"+x+"/";
  $.get(route,function(res){
   total= res.length;
   for (var p = 0 ; p < res.length; p++) {
     if(res[p].estado == "RESUELTO"){
      z= z+1;
    }else{
      y = y+1;
    }
  }


  var tabla = document.getElementById("detalles");
  var row = tabla.insertRow(1);
  row.style.backgroundColor = "rgb(219, 255, 194)";
  var cell1 = row.insertCell(0);
  var cell2 = row.insertCell(1);
  var cell3 = row.insertCell(2);
  cell1.innerHTML = total;
  cell2.innerHTML = z;
  cell3.innerHTML = y;

});

}

function oficios_recibidos_area(){
  var c = document.getElementById("detalles2").rows.length;
  for (var i = 1; i < c; i++) {
    document.getElementById("detalles2").deleteRow(1);
  }
  var c = document.getElementById("detalles3").rows.length;
  for (var i = 1; i < c; i++) {
    document.getElementById("detalles3").deleteRow(1);
  }

  var x = document.getElementById('ciclo_escolar').value;
  var w = document.getElementById('area').value;

  var z = 0;
  var y= 0;
  var total= 0;

  var route = "http://localhost:8000/ver_oficios_arear/"+x+"/"+w;
  document.getElementById('excel2').href="/descargar-oficios-recibidos-area/"+x+"/"+w;
  $.get(route,function(res){
   total= res.length;
   for (var p = 0 ; p < res.length; p++) {
    var tabla = document.getElementById("detalles3");
    var row = tabla.insertRow(1);
    row.style.backgroundColor = "rgb(219, 255, 194)";
    var cell1 = row.insertCell(0);
    var cell2 = row.insertCell(1);
    var cell3 = row.insertCell(2);
    var cell4 = row.insertCell(3);
    var cell5 = row.insertCell(4);
    var cell6 = row.insertCell(5);
    cell1.innerHTML = res[p].num_oficio;
    cell2.innerHTML = res[p].remitente;
    cell3.innerHTML = res[p].asunto;
    cell4.innerHTML = res[p].fecha_entrada;
    cell5.innerHTML = res[p].estado;
    cell6.innerHTML = res[p].nombre;


    if(res[p].estado == "RESUELTO"){
      z= z+1;
    }else{
      y = y+1;
    }
  }
  var tabla = document.getElementById("detalles2");
  var row = tabla.insertRow(1);
  row.style.backgroundColor = "rgb(219, 255, 194)";
  var cell1 = row.insertCell(0);
  var cell2 = row.insertCell(1);
  var cell3 = row.insertCell(2);
  cell1.innerHTML = total;
  cell2.innerHTML = z;
  cell3.innerHTML = y;

});

}

function teclas(event) {
  tecla=(document.all) ? event.keyCode : event.which;

  var cuenta = document.getElementById('buscar');
  var x = cuenta.value;
  var z = x.length
  if (tecla == 13  ) {
    var e = document.getElementById("buscar").value;
    limite = "3",
    separador = "-",
    arregloDeSubCadenas = e.split(separador, limite);
    var cct=arregloDeSubCadenas[0];
    var mes=arregloDeSubCadenas[1];
    var ciclo=arregloDeSubCadenas[2];



    var route = "http://localhost:8000/busca_listas_codigo/"+cct+"/"+mes+"/"+ciclo;
    $.get(route,function(res){

      if(res.length > 0){

        for (var p = 0 ; p < res.length; p++) {
          var comprueba = verifica_codigo(res[p].id)
          if (comprueba == 1){
            swal("Alerta!", "Esta Lista Ya se ha Insertado en la Tabla!", "error");
            document.getElementById('buscar').value="";
            document.getElementById('buscar').focus();
            return false;

          }else{
           var tabla = document.getElementById("detalles");
           var row = tabla.insertRow(1);
           row.style.backgroundColor = "rgb(219, 255, 194)";
           var cell1 = row.insertCell(0);
           var cell2 = row.insertCell(1);
           var cell3 = row.insertCell(2);
           var cell4 = row.insertCell(3);
           var cell5 = row.insertCell(4);
           var cell6 = row.insertCell(5);
           var cell7 = row.insertCell(6);
           cell1.innerHTML =  '<input type="button" value="Eliminar"  onClick="eliminarFilaLista(this.parentNode.parentNode.rowIndex);">';
           cell2.innerHTML = res[p].id;
           cell3.innerHTML = res[p].cct;
           cell4.innerHTML = res[p].nombre_escuela;
           cell5.innerHTML = res[p].mes;
           cell6.innerHTML = res[p].ciclo;
           cell7.innerHTML = "ENTREGADA";
           document.getElementById('cct').value=cct;
           document.getElementById('nombre_escuela').value=res[p].nombre_escuela;
           document.getElementById('mes').value=res[p].mes;
           document.getElementById('ciclo').value=res[p].ciclo;
           document.getElementById('buscar').value="";

           var menos =document.getElementById("detalles").rows
           var r = menos.length;
           document.getElementById("total").value= r - 2;

           document.getElementById('buscar').focus();


         }
       }

     }else{
      swal("Lista de Asistencia No Encontrada!", "Verifique el Codigo de Barras!", "error");
      document.getElementById('buscar').value="";
      document.getElementById('buscar').focus();

     // break;

   }
 });

    return false;
  }
}

function verifica_codigo(valor) {
 var z = 1
 var arreglo = [];
 var table = document.getElementById('detalles');
 for (var r = 1, n = table.rows.length-1; r < n; r++) {
  for (var c = 1, m = table.rows[r].cells.length; c < m; c++) {
    var j = table.rows[r].cells[1].innerHTML;
    if (valor == j ){

      var r = 1;
      return(r);
    }

  }
}}

function eliminarFilaLista(value) {

  document.getElementById("detalles").deleteRow(value);
  var menos =document.getElementById("detalles").rows
  var r = menos.length;
  document.getElementById("total").value= r - 2;
 // limpiar();
}
