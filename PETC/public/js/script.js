
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






function Carga($id){

  var tablaDatos = $('#myTable');
  var route = "http://localhost:8000/rolesEspecificos/"+$id;

  $.get(route,function(res){
    $(res).each(function(key,value){
      tablaDatos.append("<tr><td colspan=\"2\">"+value.rol_Empleado+ "</td><td>"+""+
        "<button type=\"button\" id=\"btn\" onclick=\"myDeleteFunction1(this);myDeleteFunction(this);\" value="+ value.idERT+" class=\"btn btn-danger btn-icon\">"
        +"Quitar<i class=\"fa fa-times\"></i> </button><td></tr>");
    });
  });



}



function Carga1(){
  var tablaDatos = $('#myTable');
  var route = "http://localhost:8000/ultimo";

  $.get(route,function(res){
    $(res).each(function(key,value){
      tablaDatos.append("<tr><td colspan=\"2\">"+value.rol_Empleado+ "</td><td>"+""+
        "<button type=\"button\" id=\"btn\" onclick=\"myDeleteFunction1(this);myDeleteFunction(this);\" value="+ value.idERT+" class=\"btn btn-danger btn-icon\">"
        +"Quitar<i class=\"fa fa-times\"></i> </button><td></tr>");
      validarRoles();
    });
  });


}



function myCreateFunction1() {

 var select = document.getElementById("rol");
 var options=document.getElementsByTagName("option");
 var idRol= select.value;

 var x = select.options[select.selectedIndex].text;



 if(!validarRolesDuplicados(x)){
  document.getElementById("errorRoles").innerHTML = "";

  var dato1 = select.value;
  var dato2 = $("#idEmpleado").val();
  var route = "/empleadoRoles";
  var token = $("#token").val();

  $.ajax({
    url: route,
    headers: {'X-CSRF-TOKEN': token},
    type: 'POST',
    dataType: 'json',
    data:{idRol: dato1,idEmpleado: dato2},

    success:function(){
      $("#msj-success").fadeIn();
    }
  });
  Carga1();
}
else {

  document.getElementById("errorRoles").innerHTML = "El rol que intentas ingresar ya existe";
}

}




function validarFecha1(){
  var fecha1 =document.getElementById('fechaInicio').value;


  if (!moment(fecha1).isValid()) {
    document.getElementById("errorFechaInicio").innerHTML = "Fecha Invalida";
  } else {
    document.getElementById("errorFechaInicio").innerHTML = "";
  }

}



function validarFecha2(){

  var fecha2= document.getElementById('fechaFin').value;

  if (!moment(fecha2).isValid()) {
    document.getElementById("errorFechaFin").innerHTML = "Fecha Invalida";
  } else {
   document.getElementById("errorFechaFin").innerHTML = "";
 }

}

function validarFechas(){



  var fecha1 =document.getElementById('fechaInicio').value;
  var fecha2= document.getElementById('fechaFin').value;
  var FechaIngreso= document.getElementById('FechaIngreso').value;

  if (moment(fecha2).isBefore(moment(fecha1))    || moment(fecha2).isSame(moment(fecha1))  ){
    document.getElementById("errorFechas").innerHTML="La fecha  de  Inicio  es mayor o igual que la fecha de Fin";

  } else {
    document.getElementById("errorFechas").innerHTML="";

  }

 // alert(moment('2013-02-03', 'YYYY-MM-DD').diff(moment('2013-02-06', 'YYYY-MM-DD'), 'days'));


 var fechaF =   moment(fecha1).format('YYYY-DD-MM');
 var fechaF2 =   moment(fecha2).format('YYYY-DD-MM');



  //alert(fecha22.diff(fecha11, 'days'));

   var diff =moment( fechaF2).diff(moment(fechaF), "days"); // Diff in days



   document.getElementById("duracionContrato").value = diff;


 }

 function validarFechaIngreso(){

  var fecha1 =document.getElementById('fechaInicio').value;
  var fecha2= document.getElementById('fechaFin').value;
  var FechaIngreso= document.getElementById('FechaIngreso').value;

  if (moment(fecha2).isBefore(moment(fecha1))    || moment(fecha2).isSame(moment(fecha1))  ){
    document.getElementById("errorFechas").innerHTML="La fecha  de  Inicio  es mayor o igual que la fecha de Fin";

  } else {
    document.getElementById("errorFechas").innerHTML="";
  }

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













    function  validarProvedor(){

     var nombre =document.getElementById('nombre').value;
     var apellidos =document.getElementById('apellidos').value;
     var ocultoNombre =document.getElementById('ocultoNombre').value;
     var ocultoApellidos = document.getElementById('ocultoApellidos').value;
     var oculto = ocultoNombre +ocultoApellidos;



     nombre = nombre.replace(/([\ \t]+(?=[\ \t])|^\s+|\s+$)/g, '');




     apellidos = apellidos.replace(/([\ \t]+(?=[\ \t])|^\s+|\s+$)/g, '');





     var route = "http://localhost:8000/validarProvedor/"+nombre + "/" +apellidos;



     $.get(route,function(res){
      if(res.length > 0  &&  res[0].estado =="Inactivo"){
       document.getElementById('submit').disabled=true;
       var idProvedor = res[0].id;
       document.getElementById("idProvedor").value= idProvedor;
       $("#modal-reactivar").modal();

     }
     else if (res.length > 0  &&  res[0].estado =="Activo"  && (res[0].nombre +" " +res[0].apellidos) != oculto )  {



      document.getElementById("errorNombre").innerHTML = "El proveedor intenta registrar ya existe en el sistema";
      document.getElementById('submit').disabled=true;

    }
    else {

    //  alert("entre en else");
    document.getElementById("errorNombre").innerHTML = "";
    document.getElementById('submit').disabled=false;

  }
});

   }



   function  validarFormularioProvedor(){

    var nombre =document.getElementById('nombre').value;

    var route = "http://localhost:8000/validarProvedor/"+nombre;

    $.get(route,function(res){
      if(res.length > 0  &&  res[0].estado =="Inactivo"){
        var idProvedor = res[0].id;
        document.getElementById("idProvedor").value= idProvedor;
        $("#modal-reactivar").modal();

      }
      else if (res.length > 0  &&  res[0].estado =="Activo"  && res[0].nombre != oculto )  {


        document.getElementById("errorNombre").innerHTML = "El proveedor intenta registrar ya existe en el sistema";
        document.getElementById('submit').disabled=false;
      }
      else {
        document.getElementById("errorNombre").innerHTML = "";

        return true;
      }
    });

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



function regiones (){
  

  }
}

}
