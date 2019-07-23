


///////////Reintegros////////////////////7

function fnFormatDetails_rein ( oTable, nTr )
{
    var aData = oTable.fnGetData( nTr );
    var sOut = '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">';

    sOut += '<tr><td><strong>nombre:</strong></td><td>'+aData[1]+' </td></tr>';
    sOut += '<tr><td><strong>CCT:</strong></td><td>'+aData[2]+' </td></tr>';
    sOut += '<tr><td><strong>Escuela:</strong></td><td>'+aData[3]+' </td></tr>';
    sOut += '<tr><td><strong>Director Regional:</strong></td><td>'+aData[4]+' </td></tr>';
    sOut += '<tr><td><strong>Sostenimiento Director Regional:</strong></td><td>'+aData[5]+' </td></tr>';
    sOut += '<tr><td><strong>Número de días:</strong></td><td>'+aData[6]+' </td></tr>';
    sOut += '<tr><td><strong>Categoría:</strong></td><td>'+aData[7]+' </td></tr>';
    sOut += '<tr><td><strong>Total Reintegro:</strong></td><td>'+aData[8]+' </td></tr>';
    sOut += '<tr><td><strong>Número de oficio:</strong></td><td>'+aData[9]+' </td></tr>';
    sOut += '<tr><td><strong>Motivo:</strong></td><td>'+aData[10]+' </td></tr>';
    sOut += '<tr><td><strong>Capturo:</strong></td><td>'+aData[11]+' </td></tr>';
    sOut += '<tr><td><strong>Estado:</strong></td><td>'+aData[12]+' </td></tr>';
    sOut += '<tr><td><strong>Fecha de Registro:</strong></td><td>'+aData[13]+' </td></tr>';





    sOut += '</table>';

    return sOut;
}

$(document).ready(function() {

    $('#dynamic-table11').dataTable( {
        "aaSorting": [[ 4, "desc" ]]
    } );

    /*
     * Insert a 'details' column to the table
     */
     var nCloneTh = document.createElement( 'th' );
     var nCloneTd = document.createElement( 'td' );
     nCloneTd.innerHTML = '<img src="plugins/advanced-datatable/images/details_open.png">';
     nCloneTd.className = "center";

     $('#hidden-table-info_rein thead tr').each( function () {
        this.insertBefore( nCloneTh, this.childNodes[0] );
    } );

     $('#hidden-table-info_rein tbody tr').each( function () {
        this.insertBefore(  nCloneTd.cloneNode( true ), this.childNodes[0] );
    } );

    /*
     * Initialse DataTables, with no sorting on the 'details' column
     */
     var oTable = $('#hidden-table-info_rein').dataTable( {
        "aoColumnDefs": [
        { "bSortable": false, "aTargets": [ 0 ] }
        ],
        "aaSorting": [[1, 'asc']]
    });

    /* Add event listener for opening and closing details
     * Note that the indicator for showing which row is open is not controlled by DataTables,
     * rather it is done here
     */
     $('#hidden-table-info_rein tbody td img').click(function () {
        var nTr = $(this).parents('tr')[0];
        if ( oTable.fnIsOpen(nTr) )
        {
            /* This row is already open - close it */
            this.src = "plugins/advanced-datatable/images/details_open.png";
            oTable.fnClose( nTr );
        }
        else
        {
            /* Open this row */
            this.src = "plugins/advanced-datatable/images/details_close.png";
            oTable.fnOpen( nTr, fnFormatDetails_rein(oTable, nTr), 'details' );
        }
    } );
 } );

//////////////////////////////////////////////7

////////////////nomina_federal////////////////////
function fnFormatDetails_nofe ( oTable, nTr )
{
    var aData = oTable.fnGetData( nTr );
    var sOut = '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">';

    sOut += '<tr><td><strong>Region:</strong></td><td>'+aData[1]+' </td></tr>';
    sOut += '<tr><td><strong>RFC:</strong></td><td>'+aData[2]+' </td></tr>';
    sOut += '<tr><td><strong>Nom Empleado:</strong></td><td>'+aData[3]+' </td></tr>';
    sOut += '<tr><td><strong>Ent Federal:</strong></td><td>'+aData[4]+' </td></tr>';
    sOut += '<tr><td><strong>CT Clasif:</strong></td><td>'+aData[5]+' </td></tr>';
    sOut += '<tr><td><strong>CT ID:</strong></td><td>'+aData[6]+' </td></tr>';
    sOut += '<tr><td><strong>CT Sec:</strong></td><td>'+aData[7]+' </td></tr>';
    sOut += '<tr><td><strong>CT Digito Ver:</strong></td><td>'+aData[8]+' </td></tr>';
    sOut += '<tr><td><strong>Cod Pago:</strong></td><td>'+aData[9]+' </td></tr>';
    sOut += '<tr><td><strong>Unidad:</strong></td><td>'+aData[10]+' </td></tr>';
    sOut += '<tr><td><strong>Subunidad:</strong></td><td>'+aData[11]+' </td></tr>';
    sOut += '<tr><td><strong>Cat Puesto:</strong></td><td>'+aData[12]+' </td></tr>';
    sOut += '<tr><td><strong>Horas:</strong></td><td>'+aData[13]+' </td></tr>';
    sOut += '<tr><td><strong>Cons Plaza:</strong></td><td>'+aData[14]+' </td></tr>';
    sOut += '<tr><td><strong>Qna Ini:</strong></td><td>'+aData[15]+' </td></tr>';
    sOut += '<tr><td><strong>Qna Fin:</strong></td><td>'+aData[16]+' </td></tr>';
    sOut += '<tr><td><strong>Qna Pago:</strong></td><td>'+aData[17]+' </td></tr>';
    sOut += '<tr><td><strong>Num Cheque:</strong></td><td>'+aData[18]+' </td></tr>';
    sOut += '<tr><td><strong>PERC:</strong></td><td>'+aData[19]+' </td></tr>';
    sOut += '<tr><td><strong>DED:</strong></td><td>'+aData[20]+' </td></tr>';
    sOut += '<tr><td><strong>Neto:</strong></td><td>'+aData[21]+' </td></tr>';
    sOut += '<tr><td><strong>Ciclo Escolar:</strong></td><td>'+aData[22]+' </td></tr>';
    sOut += '<tr><td><strong>Captura:</strong></td><td>'+aData[23]+' </td></tr>';




    sOut += '</table>';

    return sOut;
}

$(document).ready(function() {

    $('#dynamic-table9').dataTable( {
        "aaSorting": [[ 4, "desc" ]]
    } );

    /*
     * Insert a 'details' column to the table
     */
     var nCloneTh = document.createElement( 'th' );
     var nCloneTd = document.createElement( 'td' );
     nCloneTd.innerHTML = '<img src="plugins/advanced-datatable/images/details_open.png">';
     nCloneTd.className = "center";

     $('#hidden-table-info_nofe thead tr').each( function () {
        this.insertBefore( nCloneTh, this.childNodes[0] );
    } );

     $('#hidden-table-info_nofe tbody tr').each( function () {
        this.insertBefore(  nCloneTd.cloneNode( true ), this.childNodes[0] );
    } );

    /*
     * Initialse DataTables, with no sorting on the 'details' column
     */
     var oTable = $('#hidden-table-info_nofe').dataTable( {
        "aoColumnDefs": [
        { "bSortable": false, "aTargets": [ 0 ] }
        ],
        "aaSorting": [[1, 'asc']]
    });

    /* Add event listener for opening and closing details
     * Note that the indicator for showing which row is open is not controlled by DataTables,
     * rather it is done here
     */
     $('#hidden-table-info_nofe tbody td img').click(function () {
        var nTr = $(this).parents('tr')[0];
        if ( oTable.fnIsOpen(nTr) )
        {
            /* This row is already open - close it */
            this.src = "plugins/advanced-datatable/images/details_open.png";
            oTable.fnClose( nTr );
        }
        else
        {
            /* Open this row */
            this.src = "plugins/advanced-datatable/images/details_close.png";
            oTable.fnOpen( nTr, fnFormatDetails_nofe(oTable, nTr), 'details' );
        }
    } );
 } );

//////////////////////////////////////////////


////////////////nomina_estatal////////////////////
function fnFormatDetails_noes ( oTable, nTr )
{
    var aData = oTable.fnGetData( nTr );
    var sOut = '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">';

    sOut += '<tr><td><strong>BCO:</strong></td><td>'+aData[1]+' </td></tr>';
    sOut += '<tr><td><strong>Num Cheque:</strong></td><td>'+aData[2]+' </td></tr>';
    sOut += '<tr><td><strong>Num Empleado:</strong></td><td>'+aData[3]+' </td></tr>';
    sOut += '<tr><td><strong>RFC:</strong></td><td>'+aData[4]+' </td></tr>';
    sOut += '<tr><td><strong>Nombre:</strong></td><td>'+aData[5]+' </td></tr>';
    sOut += '<tr><td><strong>CVE:</strong></td><td>'+aData[6]+' </td></tr>';
    sOut += '<tr><td><strong>Plaza:</strong></td><td>'+aData[7]+' </td></tr>';
    sOut += '<tr><td><strong>Contrato:</strong></td><td>'+aData[8]+' </td></tr>';
    sOut += '<tr><td><strong>CCT:</strong></td><td>'+aData[9]+' </td></tr>';
    sOut += '<tr><td><strong>Region:</strong></td><td>'+aData[10]+' </td></tr>';
    sOut += '<tr><td><strong>PERC:</strong></td><td>'+aData[11]+' </td></tr>';
    sOut += '<tr><td><strong>DED:</strong></td><td>'+aData[12]+' </td></tr>';
    sOut += '<tr><td><strong>Neto:</strong></td><td>'+aData[13]+' </td></tr>';
    sOut += '<tr><td><strong>Qna ini:</strong></td><td>'+aData[14]+' </td></tr>';
    sOut += '<tr><td><strong>Qna Fin:</strong></td><td>'+aData[15]+' </td></tr>';
    sOut += '<tr><td><strong>Qna Pago:</strong></td><td>'+aData[16]+' </td></tr>';
    sOut += '<tr><td><strong>Ciclo Escolar:</strong></td><td>'+aData[17]+' </td></tr>';
    sOut += '<tr><td><strong>Captura:</strong></td><td>'+aData[18]+' </td></tr>';



    sOut += '</table>';

    return sOut;
}

$(document).ready(function() {

    $('#dynamic-table8').dataTable( {
        "aaSorting": [[ 4, "desc" ]]
    } );

    /*
     * Insert a 'details' column to the table
     */
     var nCloneTh = document.createElement( 'th' );
     var nCloneTd = document.createElement( 'td' );
     nCloneTd.innerHTML = '<img src="plugins/advanced-datatable/images/details_open.png">';
     nCloneTd.className = "center";

     $('#hidden-table-info_noes thead tr').each( function () {
        this.insertBefore( nCloneTh, this.childNodes[0] );
    } );

     $('#hidden-table-info_noes tbody tr').each( function () {
        this.insertBefore(  nCloneTd.cloneNode( true ), this.childNodes[0] );
    } );

    /*
     * Initialse DataTables, with no sorting on the 'details' column
     */
     var oTable = $('#hidden-table-info_noes').dataTable( {
        "aoColumnDefs": [
        { "bSortable": false, "aTargets": [ 0 ] }
        ],
        "aaSorting": [[1, 'asc']]
    });

    /* Add event listener for opening and closing details
     * Note that the indicator for showing which row is open is not controlled by DataTables,
     * rather it is done here
     */
     $('#hidden-table-info_noes tbody td img').click(function () {
        var nTr = $(this).parents('tr')[0];
        if ( oTable.fnIsOpen(nTr) )
        {
            /* This row is already open - close it */
            this.src = "plugins/advanced-datatable/images/details_open.png";
            oTable.fnClose( nTr );
        }
        else
        {
            /* Open this row */
            this.src = "plugins/advanced-datatable/images/details_close.png";
            oTable.fnOpen( nTr, fnFormatDetails_noes(oTable, nTr), 'details' );
        }
    } );
 } );

//////////////////////////////////////////////

////////////////Solicitudes////////////////////
function fnFormatDetails_soli ( oTable, nTr )
{
    var aData = oTable.fnGetData( nTr );
    var sOut = '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">';

    sOut += '<tr><td><strong>Entrego Acta:</strong></td><td>'+aData[1]+' </td></tr>';
    sOut += '<tr><td><strong>Solicitud Incorporacion:</strong></td><td>'+aData[2]+' </td></tr>';
    sOut += '<tr><td><strong>CCT:</strong></td><td>'+aData[3]+' </td></tr>';
    sOut += '<tr><td><strong>Nombre Escuela:</strong></td><td>'+aData[4]+' </td></tr>';
    sOut += '<tr><td><strong>Municipio:</strong></td><td>'+aData[5]+' </td></tr>';
    sOut += '<tr><td><strong>Localidad:</strong></td><td>'+aData[6]+' </td></tr>';
    sOut += '<tr><td><strong>Domicilio:</strong></td><td>'+aData[7]+' </td></tr>';
    sOut += '<tr><td><strong>Nivel:</strong></td><td>'+aData[8]+' </td></tr>';
    sOut += '<tr><td><strong>PNPSVD:</strong></td><td>'+aData[9]+' </td></tr>';
    sOut += '<tr><td><strong>CNH:</strong></td><td>'+aData[10]+' </td></tr>';
    sOut += '<tr><td><strong>Carta Compromiso:</strong></td><td>'+aData[11]+' </td></tr>';
    sOut += '<tr><td><strong>Acta Constitutiva:</strong></td><td>'+aData[12]+' </td></tr>';
    sOut += '<tr><td><strong>Acta CPS:</strong></td><td>'+aData[13]+' </td></tr>';
    sOut += '<tr><td><strong>Acta CTCS:</strong></td><td>'+aData[14]+' </td></tr>';
    sOut += '<tr><td><strong>Tramite Estado:</strong></td><td>'+aData[15]+' </td></tr>';
    sOut += '<tr><td><strong>Fecha de Recepcion:</strong></td><td>'+aData[16]+' </td></tr>';
    sOut += '<tr><td><strong>Capturo:</strong></td><td>'+aData[17]+' </td></tr>';



    sOut += '</table>';

    return sOut;
}

$(document).ready(function() {

    $('#dynamic-table7').dataTable( {
        "aaSorting": [[ 4, "desc" ]]
    } );

    /*
     * Insert a 'details' column to the table
     */
     var nCloneTh = document.createElement( 'th' );
     var nCloneTd = document.createElement( 'td' );
     nCloneTd.innerHTML = '<img src="plugins/advanced-datatable/images/details_open.png">';
     nCloneTd.className = "center";

     $('#hidden-table-info_solicitudes thead tr').each( function () {
        this.insertBefore( nCloneTh, this.childNodes[0] );
    } );

     $('#hidden-table-info_solicitudes tbody tr').each( function () {
        this.insertBefore(  nCloneTd.cloneNode( true ), this.childNodes[0] );
    } );

    /*
     * Initialse DataTables, with no sorting on the 'details' column
     */
     var oTable = $('#hidden-table-info_solicitudes').dataTable( {
        "aoColumnDefs": [
        { "bSortable": false, "aTargets": [ 0 ] }
        ],
        "aaSorting": [[1, 'asc']]
    });

    /* Add event listener for opening and closing details
     * Note that the indicator for showing which row is open is not controlled by DataTables,
     * rather it is done here
     */
     $('#hidden-table-info_solicitudes tbody td img').click(function () {
        var nTr = $(this).parents('tr')[0];
        if ( oTable.fnIsOpen(nTr) )
        {
            /* This row is already open - close it */
            this.src = "plugins/advanced-datatable/images/details_open.png";
            oTable.fnClose( nTr );
        }
        else
        {
            /* Open this row */
            this.src = "plugins/advanced-datatable/images/details_close.png";
            oTable.fnOpen( nTr, fnFormatDetails_soli(oTable, nTr), 'details' );
        }
    } );
 } );

//////////////////////////////////////////////


////////////////cat_puesto////////////////////
function fnFormatDetails_cat ( oTable, nTr )
{
    var aData = oTable.fnGetData( nTr );
    var sOut = '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">';

    sOut += '<tr><td><strong>CV_UR:</strong></td><td>'+aData[1]+' </td></tr>';
    sOut += '<tr><td><strong>ENTIDAD:</strong></td><td>'+aData[2]+' </td></tr>';
    sOut += '<tr><td><strong>CCP:</strong></td><td>'+aData[3]+' </td></tr>';
    sOut += '<tr><td><strong>NOM_PROG:</strong></td><td>'+aData[4]+' </td></tr>';
    sOut += '<tr><td><strong>CATEGORIA PUESTO:</strong></td><td>'+aData[5]+' </td></tr>';
    sOut += '<tr><td><strong>DESCRIPCION PUESTO:</strong></td><td>'+aData[6]+' </td></tr>';
    sOut += '<tr><td><strong>CATEGORIA:</strong></td><td>'+aData[7]+' </td></tr>';
    sOut += '<tr><td><strong>TIPO PUESTO:</strong></td><td>'+aData[8]+' </td></tr>';
    sOut += '<tr><td><strong>CAPTURA:</strong></td><td>'+aData[9]+' </td></tr>';
    sOut += '</table>';

    return sOut;
}

$(document).ready(function() {

    $('#dynamic-table1').dataTable( {
        "aaSorting": [[ 4, "desc" ]]
    } );

    /*
     * Insert a 'details' column to the table
     */
     var nCloneTh = document.createElement( 'th' );
     var nCloneTd = document.createElement( 'td' );
     nCloneTd.innerHTML = '<img src="plugins/advanced-datatable/images/details_open.png">';
     nCloneTd.className = "center";

     $('#hidden-table-info_cat_puesto thead tr').each( function () {
        this.insertBefore( nCloneTh, this.childNodes[0] );
    } );

     $('#hidden-table-info_cat_puesto tbody tr').each( function () {
        this.insertBefore(  nCloneTd.cloneNode( true ), this.childNodes[0] );
    } );

    /*
     * Initialse DataTables, with no sorting on the 'details' column
     */
     var oTable = $('#hidden-table-info_cat_puesto').dataTable( {
        "aoColumnDefs": [
        { "bSortable": false, "aTargets": [ 0 ] }
        ],
        "aaSorting": [[1, 'asc']]
    });

    /* Add event listener for opening and closing details
     * Note that the indicator for showing which row is open is not controlled by DataTables,
     * rather it is done here
     */
     $('#hidden-table-info_cat_puesto tbody td img').click(function () {
        var nTr = $(this).parents('tr')[0];
        if ( oTable.fnIsOpen(nTr) )
        {
            /* This row is already open - close it */
            this.src = "plugins/advanced-datatable/images/details_open.png";
            oTable.fnClose( nTr );
        }
        else
        {
            /* Open this row */
            this.src = "plugins/advanced-datatable/images/details_close.png";
            oTable.fnOpen( nTr, fnFormatDetails_cat(oTable, nTr), 'details' );
        }
    } );
 } );

//////////////////////////////////////////////

//////////////////Directorio regional/////////////////////77
function fnFormatDetails_dir ( oTable, nTr )
{
  var aData = oTable.fnGetData( nTr );
  var sOut = '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">';
  sOut += '<tr><td><strong>Region:</strong></td><td>'+aData[1]+' </td></tr>';
  sOut += '<tr><td><strong>Sostenimiento:</strong></td><td>'+aData[2]+' </td></tr>';
  sOut += '<tr><td><strong>Nombre de Enlace:</strong></td><td>'+aData[2]+' </td></tr>';
  sOut += '<tr><td><strong>Teléfono:</strong></td><td>'+aData[4]+' </td></tr>';
  sOut += '<tr><td><strong>Extencion 1:</strong></td><td>'+aData[5]+' </td></tr>';
  sOut += '<tr><td><strong>Extencion 2:</strong></td><td>'+aData[6]+' </td></tr>';
  sOut += '<tr><td><strong>Correo Enlace:</strong></td><td>'+aData[7]+' </td></tr>';
  sOut += '<tr><td><strong>Director Regional:</strong></td><td>'+aData[8]+' </td></tr>';
  sOut += '<tr><td><strong>Telefono Director:</strong></td><td>'+aData[9]+' </td></tr>';
  sOut += '<tr><td><strong>Financiero Regional:</strong></td><td>'+aData[10]+' </td></tr>';
  sOut += '<tr><td><strong>Teléfono Financiero:</strong></td><td>'+aData[11]+' </td></tr>';
  sOut += '<tr><td><strong>Extencion Regional 1:</strong></td><td>'+aData[12]+' </td></tr>';
  sOut += '<tr><td><strong>Extencion Regional 2:</strong></td><td>'+aData[13]+' </td></tr>';
  sOut += '<tr><td><strong>Estado:</strong></td><td>'+aData[14]+' </td></tr>';
  sOut += '<tr><td><strong>Captura:</strong></td><td>'+aData[15]+' </td></tr>';

  return sOut;
}

$(document).ready(function() {

    $('#dynamic-table_dir').dataTable( {
        "aaSorting": [[ 4, "desc" ]]
    } );

    /*
     * Insert a 'details' column to the table
     */
     var nCloneTh = document.createElement( 'th' );
     var nCloneTd = document.createElement( 'td' );
     nCloneTd.innerHTML = '<img src="plugins/advanced-datatable/images/details_open.png">';
     nCloneTd.className = "center";

     $('#hidden-table-info_dir thead tr').each( function () {
        this.insertBefore( nCloneTh, this.childNodes[0] );
    } );

     $('#hidden-table-info_dir tbody tr').each( function () {
        this.insertBefore(  nCloneTd.cloneNode( true ), this.childNodes[0] );
    } );

    /*
     * Initialse DataTables, with no sorting on the 'details' column
     */
     var oTable = $('#hidden-table-info_dir').dataTable( {
        "aoColumnDefs": [
        { "bSortable": false, "aTargets": [ 0 ] }
        ],
        "aaSorting": [[1, 'asc']]
    });

    /* Add event listener for opening and closing details
     * Note that the indicator for showing which row is open is not controlled by DataTables,
     * rather it is done here
     */
     $('#hidden-table-info_dir tbody td img').click(function () {
        var nTr = $(this).parents('tr')[0];
        if ( oTable.fnIsOpen(nTr) )
        {
            /* This row is already open - close it */
            this.src = "plugins/advanced-datatable/images/details_open.png";
            oTable.fnClose( nTr );
        }
        else
        {
            /* Open this row */
            this.src = "plugins/advanced-datatable/images/details_close.png";
            oTable.fnOpen( nTr, fnFormatDetails_dir(oTable, nTr), 'details' );
        }
    } );
 } );
////////////////////////////////////////////////


function fnFormatDetails1 ( oTable, nTr )
{
    var aData = oTable.fnGetData( nTr );
    var sOut = '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">';

    sOut += '<tr><td><strong>Nombre:</strong></td><td>'+aData[1]+' </td></tr>';
    sOut += '<tr><td><strong>RFC:</strong></td><td>'+aData[2]+' </td></tr>';
    sOut += '<tr><td><strong>Regimen Fiscal:</strong></td><td>'+aData[6]+' </td></tr>';
    sOut += '<tr><td><strong>Telefono:</strong></td><td>'+aData[4]+' </td></tr>';
    sOut += '<tr><td><strong>Direccion:</strong></td><td>'+aData[3]+' </td></tr>';
    sOut += '<tr><td><strong>Correo:</strong></td><td>'+aData[5]+' </td></tr>';
    sOut += '<tr><td><strong>Proveedor:</strong></td><td>'+aData[7]+' </td></tr>';
    sOut += '</table>';

    return sOut;
}

$(document).ready(function() {

    $('#dynamic-table1').dataTable( {
        "aaSorting": [[ 4, "desc" ]]
    } );

    /*
     * Insert a 'details' column to the table
     */
     var nCloneTh = document.createElement( 'th' );
     var nCloneTd = document.createElement( 'td' );
     nCloneTd.innerHTML = '<img src="plugins/advanced-datatable/images/details_open.png">';
     nCloneTd.className = "center";

     $('#hidden-table-info1 thead tr').each( function () {
        this.insertBefore( nCloneTh, this.childNodes[0] );
    } );

     $('#hidden-table-info1 tbody tr').each( function () {
        this.insertBefore(  nCloneTd.cloneNode( true ), this.childNodes[0] );
    } );

    /*
     * Initialse DataTables, with no sorting on the 'details' column
     */
     var oTable = $('#hidden-table-info1').dataTable( {
        "aoColumnDefs": [
        { "bSortable": false, "aTargets": [ 0 ] }
        ],
        "aaSorting": [[1, 'asc']]
    });

    /* Add event listener for opening and closing details
     * Note that the indicator for showing which row is open is not controlled by DataTables,
     * rather it is done here
     */
     $('#hidden-table-info1 tbody td img').click(function () {
        var nTr = $(this).parents('tr')[0];
        if ( oTable.fnIsOpen(nTr) )
        {
            /* This row is already open - close it */
            this.src = "plugins/advanced-datatable/images/details_open.png";
            oTable.fnClose( nTr );
        }
        else
        {
            /* Open this row */
            this.src = "plugins/advanced-datatable/images/details_close.png";
            oTable.fnOpen( nTr, fnFormatDetails1(oTable, nTr), 'details' );
        }
    } );
 } );

function fnFormatDetails2 ( oTable, nTr )
{
    var aData = oTable.fnGetData( nTr );
    var sOut = '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">';

    sOut += '<tr><td><strong>CCT:</strong></td><td>'+aData[1]+' </td></tr>';
    sOut += '<tr><td><strong>Nombre de la Escuela:</strong></td><td>'+aData[2]+' </td></tr>';
    sOut += '<tr><td><strong>Municipio:</strong></td><td>'+aData[3]+' </td></tr>';
    sOut += '<tr><td><strong>Localidad:</strong></td><td>'+aData[4]+' </td></tr>';
    sOut += '<tr><td><strong>Domicilio:</strong></td><td>'+aData[5]+' </td></tr>';
    sOut += '<tr><td><strong>Región:</strong></td><td>'+aData[6]+' </td></tr>';
    sOut += '<tr><td><strong>Sostenimiento:</strong></td><td>'+aData[7]+' </td></tr>';
    sOut += '<tr><td><strong>Teléfono:</strong></td><td>'+aData[8]+' </td></tr>';
    sOut += '<tr><td><strong>Email:</strong></td><td>'+aData[9]+' </td></tr>';
    sOut += '<tr><td><strong>Capturo:</strong></td><td>'+aData[10]+' </td></tr>';
    sOut += '<tr><td><strong>Ciclo Escolar:</strong></td><td>'+aData[11]+' </td></tr>';
    sOut += '<tr><td><strong>Entrego Carta Compromiso:</strong></td><td>'+aData[12]+' </td></tr>';
    sOut += '<tr><td><strong>Alimentacion:</strong></td><td>'+aData[13]+' </td></tr>';
    sOut += '<tr><td><strong>Modificado:</strong></td><td>'+aData[14]+' </td></tr>';
    sOut += '<tr><td><strong>Total de Alumnos:</strong></td><td>'+aData[15]+' </td></tr>';
    sOut += '<tr><td><strong>Total Niñas:</strong></td><td>'+aData[16]+' </td></tr>';
    sOut += '<tr><td><strong>Total Niños:</strong></td><td>'+aData[17]+' </td></tr>';
    sOut += '<tr><td><strong>Total Grupos:</strong></td><td>'+aData[18]+' </td></tr>';
    sOut += '<tr><td><strong>Total Grados:</strong></td><td>'+aData[19]+' </td></tr>';
    sOut += '<tr><td><strong>Total Directores:</strong></td><td>'+aData[20]+' </td></tr>';
    sOut += '<tr><td><strong>Total Docentes:</strong></td><td>'+aData[21]+' </td></tr>';
    sOut += '<tr><td><strong>Total E.Fisica:</strong></td><td>'+aData[22]+' </td></tr>';
    sOut += '<tr><td><strong>Total USAER:</strong></td><td>'+aData[23]+' </td></tr>';
    sOut += '<tr><td><strong>Total Artistica :</strong></td><td>'+aData[24]+' </td></tr>';
    sOut += '<tr><td><strong>Total Intendentes:</strong></td><td>'+aData[25]+' </td></tr>';
    sOut += '<tr><td><strong>Fecha Ingreso PETC:</strong></td><td>'+aData[26]+' </td></tr>';
    sOut += '<tr><td><strong>Fecha Baja PETC:</strong></td><td>'+aData[27]+' </td></tr>';
    sOut += '</table>';

    return sOut;
}

$(document).ready(function() {

    $('#dynamic-table2').dataTable( {
        "aaSorting": [[ 4, "desc" ]]
    } );

    /*
     * Insert a 'details' column to the table
     */
     var nCloneTh = document.createElement( 'th' );
     var nCloneTd = document.createElement( 'td' );
     nCloneTd.innerHTML = '<img src="plugins/advanced-datatable/images/details_open.png">';
     nCloneTd.className = "center";

     $('#hidden-table-info2 thead tr').each( function () {
        this.insertBefore( nCloneTh, this.childNodes[0] );
    } );

     $('#hidden-table-info2 tbody tr').each( function () {
        this.insertBefore(  nCloneTd.cloneNode( true ), this.childNodes[0] );
    } );

    /*
     * Initialse DataTables, with no sorting on the 'details' column
     */
     var oTable = $('#hidden-table-info2').dataTable( {
        "aoColumnDefs": [
        { "bSortable": false, "aTargets": [ 0 ] }
        ],
        "aaSorting": [[1, 'asc']]
    });

    /* Add event listener for opening and closing details
     * Note that the indicator for showing which row is open is not controlled by DataTables,
     * rather it is done here
     */
     $('#hidden-table-info2 tbody td img').click(function () {
        var nTr = $(this).parents('tr')[0];
        if ( oTable.fnIsOpen(nTr) )
        {
            /* This row is already open - close it */
            this.src = "plugins/advanced-datatable/images/details_open.png";
            oTable.fnClose( nTr );
        }
        else
        {
            /* Open this row */
            this.src = "plugins/advanced-datatable/images/details_close.png";
            oTable.fnOpen( nTr, fnFormatDetails2(oTable, nTr), 'details' );
        }
    } );
 } );




function fnFormatDetails3 ( oTable, nTr )
{
    var aData = oTable.fnGetData( nTr );
    var sOut = '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">';
    sOut += '<tr><td><strong>Nombre Vehiculo:</strong></td><td>'+aData[1]+' </td></tr>';
    sOut += '<tr><td><strong>Numero de serie:</strong></td><td>'+aData[2]+' </td></tr>';
    sOut += '<tr><td><strong>Placas:</strong></td><td>'+aData[3]+' </td></tr>';
    sOut += '<tr><td><strong>Poliza Seguro:</strong></td><td>'+aData[4]+' </td></tr>';
    sOut += '<tr><td><strong>Vigencia Seguro:</strong></td><td>'+aData[5]+' </td></tr>';
    sOut += '<tr><td><strong>Aseguradora:</strong></td><td>'+aData[6]+' </td></tr>';
    sOut += '<tr><td><strong>Capacidad cubica:</strong></td><td>'+aData[7]+' </td></tr>';
    sOut += '<tr><td><strong>Capacidad cubica:</strong></td><td>'+aData[8]+' </td></tr>';
    sOut += '<tr><td><strong>Chofer:</strong></td><td>'+aData[9]+' </td></tr>';
    sOut += '</table>';

    return sOut;
}

$(document).ready(function() {

    $('#dynamic-table3').dataTable( {
        "aaSorting": [[ 4, "desc" ]]
    } );

    /*
     * Insert a 'details' column to the table
     */
     var nCloneTh = document.createElement( 'th' );
     var nCloneTd = document.createElement( 'td' );
     nCloneTd.innerHTML = '<img src="plugins/advanced-datatable/images/details_open.png">';
     nCloneTd.className = "center";

     $('#hidden-table-info3 thead tr').each( function () {
        this.insertBefore( nCloneTh, this.childNodes[0] );
    } );

     $('#hidden-table-info3 tbody tr').each( function () {
        this.insertBefore(  nCloneTd.cloneNode( true ), this.childNodes[0] );
    } );

    /*
     * Initialse DataTables, with no sorting on the 'details' column
     */
     var oTable = $('#hidden-table-info3').dataTable( {
        "aoColumnDefs": [
        { "bSortable": false, "aTargets": [ 0 ] }
        ],
        "aaSorting": [[1, 'asc']]
    });

    /* Add event listener for opening and closing details
     * Note that the indicator for showing which row is open is not controlled by DataTables,
     * rather it is done here
     */
     $('#hidden-table-info3 tbody td img').click(function () {
        var nTr = $(this).parents('tr')[0];
        if ( oTable.fnIsOpen(nTr) )
        {
            /* This row is already open - close it */
            this.src = "plugins/advanced-datatable/images/details_open.png";
            oTable.fnClose( nTr );
        }
        else
        {
            /* Open this row */
            this.src = "plugins/advanced-datatable/images/details_close.png";
            oTable.fnOpen( nTr, fnFormatDetails3(oTable, nTr), 'details' );
        }
    } );
 } );

function fnFormatDetails4 ( oTable, nTr )
{
    var aData = oTable.fnGetData( nTr );
    var sOut = '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">';
    sOut += '<tr><td>&nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  &nbsp;<strong>Informacion Personal</strong></td><td> </td></tr>';
    sOut += '<tr><td><strong>Nombre:</strong></td><td>'+aData[1]+' </td></tr>';
    sOut += '<tr><td><strong>CURP:</strong></td><td>'+aData[6]+' </td></tr>';
    sOut += '<tr><td><strong>Fecha Nacimiento:</strong></td><td>'+aData[5]+' </td></tr>';
    sOut += '<tr><td><strong>Sexo:</strong></td><td>'+aData[10]+' </td></tr>';
    sOut += '<tr><td><strong>Telefono:</strong></td><td>'+aData[8]+' </td></tr>';
    sOut += '<tr><td><strong>Correo:</strong></td><td>'+aData[7]+' </td></tr>';
    sOut += '<tr><td>&nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  &nbsp;<strong>Informacion Laboral</strong></td><td> </td></tr>';
    sOut += '<tr><td><strong>Fecha de Ingreso a la empresa:</strong></td><td>'+aData[2]+' </td></tr>';
    sOut += '<tr><td><strong>Fecha de alta en Seguro Social:</strong></td><td>'+aData[3]+' </td></tr>';
    sOut += '<tr><td><strong>Numero de Seguro Social:</strong></td><td>'+aData[4]+' </td></tr>';
    sOut += '<tr><td><strong>Sueldo:</strong></td><td>'+aData[9]+' </td></tr>';
    sOut += '<tr><td>&nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  &nbsp;<strong>Datos de Contrato</strong></td><td> </td></tr>';
    sOut += '<tr><td><strong>Fecha Inicio Contrato:</strong></td><td>'+aData[2]+' </td></tr>';
    sOut += '<tr><td><strong>Fecha Fin Contrato:</strong></td><td>'+aData[3]+' </td></tr>';
    sOut += '<tr><td><strong>Duracion Contrato:</strong></td><td>'+aData[4]+' </td></tr>';
    sOut += '</table>';

    return sOut;
}

$(document).ready(function() {

    $('#dynamic-table4').dataTable( {
        "aaSorting": [[ 4, "desc" ]]
    } );

    /*
     * Insert a 'details' column to the table
     */
     var nCloneTh = document.createElement( 'th' );
     var nCloneTd = document.createElement( 'td' );
     nCloneTd.innerHTML = '<img src="plugins/advanced-datatable/images/details_open.png">';
     nCloneTd.className = "center";

     $('#hidden-table-info4 thead tr').each( function () {
        this.insertBefore( nCloneTh, this.childNodes[0] );
    } );

     $('#hidden-table-info4 tbody tr').each( function () {
        this.insertBefore(  nCloneTd.cloneNode( true ), this.childNodes[0] );
    } );

    /*
     * Initialse DataTables, with no sorting on the 'details' column
     */
     var oTable = $('#hidden-table-info4').dataTable( {
        "aoColumnDefs": [
        { "bSortable": false, "aTargets": [ 0 ] }
        ],
        "aaSorting": [[1, 'asc']]
    });

    /* Add event listener for opening and closing details
     * Note that the indicator for showing which row is open is not controlled by DataTables,
     * rather it is done here
     */
     $('#hidden-table-info4 tbody td img').click(function () {
        var nTr = $(this).parents('tr')[0];
        if ( oTable.fnIsOpen(nTr) )
        {
            /* This row is already open - close it */
            this.src = "plugins/advanced-datatable/images/details_open.png";
            oTable.fnClose( nTr );
        }
        else
        {
            /* Open this row */
            this.src = "plugins/advanced-datatable/images/details_close.png";
            oTable.fnOpen( nTr, fnFormatDetails4(oTable, nTr), 'details' );
        }
    } );
 } );


function fnFormatDetails5 ( oTable, nTr )
{
    var aData = oTable.fnGetData( nTr );
    var sOut = '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">';

    sOut += '<tr><td><strong>Nombre:</strong></td><td>'+aData[1]+' </td></tr>';
    sOut += '<tr><td><strong>Representante Legal:</strong></td><td>'+aData[2]+' </td></tr>';
    sOut += '<tr><td><strong>RFC:</strong></td><td>'+aData[3]+' </td></tr>';
    sOut += '<tr><td><strong>Regimen Fiscal:</strong></td><td>'+aData[8]+' </td></tr>';
    sOut += '<tr><td><strong>Telefono:</strong></td><td>'+aData[6]+' </td></tr>';
    sOut += '<tr><td><strong>Direccion Fisica:</strong></td><td>'+aData[5]+' </td></tr>';
    sOut += '<tr><td><strong>Direccion de Facturación:</strong></td><td>'+aData[4]+' </td></tr>';
    sOut += '<tr><td><strong>Correo:</strong></td><td>'+aData[7]+' </td></tr>';


    sOut += '</table>';

    return sOut;
}

$(document).ready(function() {

    $('#dynamic-table5').dataTable( {
        "aaSorting": [[ 4, "desc" ]]
    } );

    /*
     * Insert a 'details' column to the table
     */
     var nCloneTh = document.createElement( 'th' );
     var nCloneTd = document.createElement( 'td' );
     nCloneTd.innerHTML = '<img src="plugins/advanced-datatable/images/details_open.png">';
     nCloneTd.className = "center";

     $('#hidden-table-info5 thead tr').each( function () {
        this.insertBefore( nCloneTh, this.childNodes[0] );
    } );

     $('#hidden-table-info5 tbody tr').each( function () {
        this.insertBefore(  nCloneTd.cloneNode( true ), this.childNodes[0] );
    } );

    /*
     * Initialse DataTables, with no sorting on the 'details' column
     */
     var oTable = $('#hidden-table-info5').dataTable( {
        "aoColumnDefs": [
        { "bSortable": false, "aTargets": [ 0 ] }
        ],
        "aaSorting": [[1, 'asc']]
    });

    /* Add event listener for opening and closing details
     * Note that the indicator for showing which row is open is not controlled by DataTables,
     * rather it is done here
     */
     $('#hidden-table-info5 tbody td img').click(function () {
        var nTr = $(this).parents('tr')[0];
        if ( oTable.fnIsOpen(nTr) )
        {
            /* This row is already open - close it */
            this.src = "plugins/advanced-datatable/images/details_open.png";
            oTable.fnClose( nTr );
        }
        else
        {
            /* Open this row */
            this.src = "plugins/advanced-datatable/images/details_close.png";
            oTable.fnOpen( nTr, fnFormatDetails5(oTable, nTr), 'details' );
        }
    } );
 } );

function fnFormatDetails6 ( oTable, nTr )
{
    var aData = oTable.fnGetData( nTr );
    var sOut = '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">';

    sOut += '<tr><td><strong>Nombre:</strong></td><td>'+aData[1]+' </td></tr>';
    sOut += '<tr><td><strong>Capacidad:</strong></td><td>'+aData[2]+' </td></tr>';
    sOut += '<tr><td><strong>Descripción:</strong></td><td>'+aData[3]+' </td></tr>';
    sOut += '<tr><td><strong>Ubicación:</strong></td><td>'+aData[4]+' </td></tr>';
    sOut += '<tr><td><strong>Total de Espacio Ocupado:</strong></td><td>'+aData[5]+' </td></tr>';
    sOut += '<tr><td><strong>Total de Espacio Libre:</strong></td><td>'+aData[6]+' </td></tr>';
    sOut += '<tr><td><strong>Espacios Ocupados Asignados:</strong></td><td>'+aData[7]+' </td></tr>';
    sOut += '<tr><td><strong>Espacios Libres Asignados:</strong></td><td>'+aData[8]+' </td></tr>';
    sOut += '<tr><td><strong>Estado:</strong></td><td>'+aData[9]+' </td></tr>';
    sOut += '<tr><td><strong>Almacén N°:</strong></td><td>'+aData[10]+' </td></tr>';


    sOut += '</table>';

    return sOut;
}

$(document).ready(function() {

    $('#dynamic-table6').dataTable( {
        "aaSorting": [[ 4, "desc" ]]
    } );

    /*
     * Insert a 'details' column to the table
     */
     var nCloneTh = document.createElement( 'th' );
     var nCloneTd = document.createElement( 'td' );
     nCloneTd.innerHTML = '<img src="/plugins/advanced-datatable/images/details_open.png">';
     nCloneTd.className = "center";

     $('#hidden-table-info6 thead tr').each( function () {
        this.insertBefore( nCloneTh, this.childNodes[0] );
    } );

     $('#hidden-table-info6 tbody tr').each( function () {
        this.insertBefore(  nCloneTd.cloneNode( true ), this.childNodes[0] );
    } );

    /*
     * Initialse DataTables, with no sorting on the 'details' column
     */
     var oTable = $('#hidden-table-info6').dataTable( {
        "aoColumnDefs": [
        { "bSortable": false, "aTargets": [ 0 ] }
        ],
        "aaSorting": [[1, 'asc']]
    });

    /* Add event listener for opening and closing details
     * Note that the indicator for showing which row is open is not controlled by DataTables,
     * rather it is done here
     */
     $('#hidden-table-info6 tbody td img').click(function () {
        var nTr = $(this).parents('tr')[0];
        if ( oTable.fnIsOpen(nTr) )
        {
            /* This row is already open - close it */
            this.src = "/plugins/advanced-datatable/images/details_open.png";
            oTable.fnClose( nTr );
        }
        else
        {
            /* Open this row */
            this.src = "/plugins/advanced-datatable/images/details_close.png";
            oTable.fnOpen( nTr, fnFormatDetails6(oTable, nTr), 'details' );
        }
    } );
 } );



function fnFormatDetails7 ( oTable, nTr )
{
    var aData = oTable.fnGetData( nTr );
    var sOut = '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">';
    sOut += '<tr><td>&nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  &nbsp;<strong>Informacion de Compra</strong></td><td> </td></tr>';
    sOut += '<tr><td><strong>N° Recepción:</strong></td><td>'+aData[1]+' </td></tr>';
    sOut += '<tr><td><strong>Nombre de Recepción:</strong></td><td>'+aData[2]+' </td></tr>';
    sOut += '<tr><td><strong>Fecha de Compra:</strong></td><td>'+aData[3]+' </td></tr>';
    sOut += '<tr><td><strong>Provedor:</strong></td><td>'+aData[4]+' </td></tr>';
    sOut += '<tr><td><strong>Transporte:</strong></td><td>'+aData[5]+' </td></tr>';
    sOut += '<tr><td><strong>N°Transportes:</strong></td><td>'+aData[6]+' </td></tr>';
    sOut += '<tr><td><strong>Empresa:</strong></td><td>'+aData[7]+' </td></tr>';
    sOut += '<tr><td><strong>Recibio Compra:</strong></td><td>'+aData[8]+' </td></tr>';
    sOut += '<tr><td><strong>Observaciones de Compra:</strong></td><td>'+aData[9]+' </td></tr>';
    sOut += '<tr><td><strong>Total de Compra:</strong></td><td>'+aData[10]+' </td></tr>';
    sOut += '<tr><td>&nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  &nbsp;<strong>Informacion de Muestreo de Materia Prima</strong></td><td> </td></tr>';
    sOut += '<tr><td><strong>Producto:</strong></td><td>'+aData[11]+' </td></tr>';
    sOut += '<tr><td><strong>Calidad:</strong></td><td>'+aData[12]+' </td></tr>';
    sOut += '<tr><td><strong>Empaque:</strong></td><td>'+aData[13]+' </td></tr>';
    sOut += '<tr><td><strong>Humedad:</strong></td><td>'+aData[14]+' </td></tr>';
    sOut += '<tr><td><strong>Pacas:</strong></td><td>'+aData[15]+' </td></tr>';
    sOut += '<tr><td><strong>Pacas a Revisar:</strong></td><td>'+aData[16]+' </td></tr>';
    sOut += '<tr><td><strong>Observaciones de Muestreo:</strong></td><td>'+aData[17]+' </td></tr>';
    sOut += '<tr><td>&nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  &nbsp;<strong>Informacion de Pesaje</strong></td><td> </td></tr>';
    sOut += '<tr><td><strong>Bascula:</strong></td><td>'+aData[18]+' </td></tr>';
    sOut += '<tr><td><strong>Ticket:</strong></td><td>'+aData[19]+' </td></tr>';
    sOut += '<tr><td><strong>Realizo Pesaje:</strong></td><td>'+aData[20]+' </td></tr>';

    sOut += '<tr><td><strong>KG Recibidos:</strong></td><td>'+aData[21]+' </td></tr>';
    sOut += '<tr><td><strong>KG Enviados:</strong></td><td>'+aData[22]+' </td></tr>';
    sOut += '<tr><td><strong>Diferencia:</strong></td><td>'+aData[23]+' </td></tr>';
    sOut += '<tr><td><strong>Observaciones Pesaje:</strong></td><td>'+aData[24]+' </td></tr>';
    sOut += '<tr><td>&nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  &nbsp;<strong>Informacion de Ubicación</strong></td><td> </td></tr>';
    sOut += '<tr><td><strong>Enviado a Ubicación:</strong></td><td>'+aData[25]+' </td></tr>';
    sOut += '<tr><td><strong>Espacio Asignado:</strong></td><td>'+aData[26]+' </td></tr>';
    sOut += '<tr><td><strong>Observaciónes de Ubicación:</strong></td><td>'+aData[27]+' </td></tr>';
    sOut += '<tr><td>&nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  &nbsp;<strong>Informacion de Fumigación</strong></td><td> </td></tr>';
    sOut += '<tr><td><strong>Fumigación N°:</strong></td><td>'+aData[28]+' </td></tr>';

    sOut += '</table>';

    return sOut;
}

$(document).ready(function() {

    $('#dynamic-table7').dataTable( {
        "aaSorting": [[ 4, "desc" ]]
    } );

    /*
     * Insert a 'details' column to the table
     */
     var nCloneTh = document.createElement( 'th' );
     var nCloneTd = document.createElement( 'td' );
     nCloneTd.innerHTML = '<img src="plugins/advanced-datatable/images/details_open.png">';
     nCloneTd.className = "center";

     $('#hidden-table-info7 thead tr').each( function () {
        this.insertBefore( nCloneTh, this.childNodes[0] );
    } );

     $('#hidden-table-info7 tbody tr').each( function () {
        this.insertBefore(  nCloneTd.cloneNode( true ), this.childNodes[0] );
    } );

    /*
     * Initialse DataTables, with no sorting on the 'details' column
     */
     var oTable = $('#hidden-table-info7').dataTable( {
        "aoColumnDefs": [
        { "bSortable": false, "aTargets": [ 0 ] }
        ],
        "aaSorting": [[1, 'asc']]
    });

    /* Add event listener for opening and closing details
     * Note that the indicator for showing which row is open is not controlled by DataTables,
     * rather it is done here
     */
     $('#hidden-table-info7 tbody td img').click(function () {
        var nTr = $(this).parents('tr')[0];
        if ( oTable.fnIsOpen(nTr) )
        {
            /* This row is already open - close it */
            this.src = "plugins/advanced-datatable/images/details_open.png";
            oTable.fnClose( nTr );
        }
        else
        {
            /* Open this row */
            this.src = "plugins/advanced-datatable/images/details_close.png";
            oTable.fnOpen( nTr, fnFormatDetails7(oTable, nTr), 'details' );
        }
    } );
 } );


function fnFormatDetails8 ( oTable, nTr )
{
 var aData = oTable.fnGetData( nTr );
 var sOut = '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">';
 sOut += '<tr><td>&nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  &nbsp;<strong>Informacion de la Fumigación</strong></td><td> </td></tr>';

 sOut += '<tr><td><strong>N° Fumigación:</strong></td><td>'+aData[1]+' </td></tr>';
 sOut += '<tr><td><strong>Fecha de Inicio:</strong></td><td>'+aData[2]+' </td></tr>';
 sOut += '<tr><td><strong>Hora Inicial:</strong></td><td>'+aData[3]+' </td></tr>';
 sOut += '<tr><td><strong>Fecha de Termino:</strong></td><td>'+aData[4]+' </td></tr>';
 sOut += '<tr><td><strong>Hora de Termino:</strong></td><td>'+aData[5]+' </td></tr>';
 sOut += '<tr><td><strong>Agroquimicos Aplicados:</strong></td><td>'+aData[6]+' </td></tr>';
 sOut += '<tr><td><strong>Cantidad Aplicada:</strong></td><td>'+aData[7]+' </td></tr>';
 sOut += '<tr><td><strong>Destino:</strong></td><td>'+aData[8]+' </td></tr>';
 sOut += '<tr><td><strong>Almacén :</strong></td><td>'+aData[9]+' </td></tr>';
 sOut += '<tr><td><strong>Producto :</strong></td><td>'+aData[10]+' </td></tr>';
 sOut += '<tr><td><strong>Fumigador :</strong></td><td>'+aData[11]+' </td></tr>';
 sOut += '<tr><td><strong>Estado :</strong></td><td>'+aData[12]+' </td></tr>';
 sOut += '<tr><td><strong>Plaga que Combate :</strong></td><td>'+aData[13]+' </td></tr>';
 sOut += '<tr><td><strong>Observaciones :</strong></td><td>'+aData[14]+' </td></tr>';


 sOut += '</table>';

 return sOut;
}

$(document).ready(function() {

    $('#dynamic-table8').dataTable( {
        "aaSorting": [[ 4, "desc" ]]
    } );

    /*
     * Insert a 'details' column to the table
     */
     var nCloneTh = document.createElement( 'th' );
     var nCloneTd = document.createElement( 'td' );
     nCloneTd.innerHTML = '<img src="plugins/advanced-datatable/images/details_open.png">';
     nCloneTd.className = "center";

     $('#hidden-table-info8 thead tr').each( function () {
        this.insertBefore( nCloneTh, this.childNodes[0] );
    } );

     $('#hidden-table-info8 tbody tr').each( function () {
        this.insertBefore(  nCloneTd.cloneNode( true ), this.childNodes[0] );
    } );

    /*
     * Initialse DataTables, with no sorting on the 'details' column
     */
     var oTable = $('#hidden-table-info8').dataTable( {
        "aoColumnDefs": [
        { "bSortable": false, "aTargets": [ 0 ] }
        ],
        "aaSorting": [[1, 'asc']]
    });

    /* Add event listener for opening and closing details
     * Note that the indicator for showing which row is open is not controlled by DataTables,
     * rather it is done here
     */
     $('#hidden-table-info8 tbody td img').click(function () {
        var nTr = $(this).parents('tr')[0];
        if ( oTable.fnIsOpen(nTr) )
        {
            /* This row is already open - close it */
            this.src = "plugins/advanced-datatable/images/details_open.png";
            oTable.fnClose( nTr );
        }
        else
        {
            /* Open this row */
            this.src = "plugins/advanced-datatable/images/details_close.png";
            oTable.fnOpen( nTr, fnFormatDetails8(oTable, nTr), 'details' );
        }
    } );
 } );

function fnFormatDetails9 ( oTable, nTr )
{
    var aData = oTable.fnGetData( nTr );
    var sOut = '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">';
    sOut += '<tr><td>&nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  &nbsp;<strong>Datos Personales</strong></td><td> </td></tr>';
    sOut += '<tr><td><strong>RFC:</strong></td><td>'+aData[2]+' </td></tr>';
    sOut += '<tr><td><strong>Nombre del Empleado:</strong></td><td>'+aData[3]+' </td></tr>';
    sOut += '<tr><td><strong>Teléfono:</strong></td><td>'+aData[4]+' </td></tr>';
    sOut += '<tr><td><strong>Email:</strong></td><td>'+aData[5]+' </td></tr>';

    sOut += '<tr><td>&nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  &nbsp;<strong>Datos de CTE</strong></td><td> </td></tr>';
    sOut += '<tr><td><strong>CCT:</strong></td><td>'+aData[6]+' </td></tr>';
    sOut += '<tr><td><strong>Nombre de la Escuela:</strong></td><td>'+aData[27]+' </td></tr>';
    sOut += '<tr><td><strong>Región:</strong></td><td>'+aData[1]+' </td></tr>';
    sOut += '<tr><td><strong>Sostenimiento Actual:</strong></td><td>'+aData[7]+' </td></tr>';
    sOut += '<tr><td><strong>Nombre de Localidad</strong></td><td>'+aData[20]+' </td></tr>';
    sOut += '<tr><td><strong>Municipio</strong></td><td>'+aData[21]+' </td></tr>';

    sOut += '<tr><td>&nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  &nbsp;<strong>Datos de la Ultima Modificación</strong></td><td> </td></tr>';
    sOut += '<tr><td><strong>Tipo de Movimiento</strong></td><td>'+aData[28]+' </td></tr>'; 
    sOut += '<tr><td><strong>Ciclo Escolar</strong></td><td>'+aData[19]+' </td></tr>';
    sOut += '<tr><td><strong>Llega a Cubrir A:</strong></td><td>'+aData[30]+' </td></tr>';
    sOut += '<tr><td><strong>RFC de a Quien Cubre:</strong></td><td>'+aData[31]+' </td></tr>';
    sOut += '<tr><td><strong>Clave:</strong></td><td>'+aData[8]+' </td></tr>';
    sOut += '<tr><td><strong>Categoria:</strong></td><td>'+aData[9]+' </td></tr>';
    sOut += '<tr><td><strong>Contrato Actual:</strong></td><td>'+aData[10]+' </td></tr>';
    sOut += '<tr><td><strong>Contrato Fin:</strong></td><td>'+aData[11]+' </td></tr>';
    sOut += '<tr><td><strong>Documentación Entregada:</strong></td><td>'+aData[12]+' </td></tr>';
    sOut += '<tr><td><strong>Observaciónes:</strong></td><td>'+aData[13]+' </td></tr>';
    sOut += '<tr><td><strong>CCT 2:</strong></td><td>'+aData[14]+' </td></tr>';
    sOut += '<tr><td><strong>Dias Trabajados</strong></td><td>'+aData[22]+' </td></tr>';


    sOut += '<tr><td>&nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  &nbsp;<strong>Informacion de Captura</strong></td><td> </td></tr>';
    sOut += '<tr><td><strong>Capturado Por:</strong></td><td>'+aData[15]+' </td></tr>';
    sOut += '<tr><td><strong>Fecha de Modificacion</strong></td><td>'+aData[24]+' </td></tr>';
    sOut += '<tr><td><strong>Estado:</strong></td><td>'+aData[16]+' </td></tr>';
    sOut += '<tr><td><strong>Pagos Registrados:</strong></td><td>'+aData[17]+' </td></tr>';
    sOut += '<tr><td><strong>Qna Actual:</strong></td><td>'+aData[18]+' </td></tr>';


    sOut += '<tr><td>&nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  &nbsp;<strong>Historial de Contatos</strong></td><td> </td></tr>';
    sOut += '<tr><td><strong>Ver Historial de Contratos</strong></td><td>'+aData[23]+' </td></tr>';
    sOut += '</table>';

    return sOut;
}

$(document).ready(function() {

    $('#dynamic-table9').dataTable( {
        "aaSorting": [[ 4, "desc" ]]
    } );

    /*
     * Insert a 'details' column to the table
     */
     var nCloneTh = document.createElement( 'th' );
     var nCloneTd = document.createElement( 'td' );
     nCloneTd.innerHTML = '<img src="plugins/advanced-datatable/images/details_open.png">';
     nCloneTd.className = "center";

     $('#hidden-table-info9 thead tr').each( function () {
        this.insertBefore( nCloneTh, this.childNodes[0] );
    } );

     $('#hidden-table-info9 tbody tr').each( function () {
        this.insertBefore(  nCloneTd.cloneNode( true ), this.childNodes[0] );
    } );

    /*
     * Initialse DataTables, with no sorting on the 'details' column
     */
     var oTable = $('#hidden-table-info9').dataTable( {
        "aoColumnDefs": [
        { "bSortable": false, "aTargets": [ 0 ] }
        ],
        "aaSorting": [[1, 'asc']]
    });

    /* Add event listener for opening and closing details
     * Note that the indicator for showing which row is open is not controlled by DataTables,
     * rather it is done here
     */
     $('#hidden-table-info9 tbody td img').click(function () {
        var nTr = $(this).parents('tr')[0];
        if ( oTable.fnIsOpen(nTr) )
        {
            /* This row is already open - close it */
            this.src = "plugins/advanced-datatable/images/details_open.png";
            oTable.fnClose( nTr );
        }
        else
        {
            /* Open this row */
            this.src = "plugins/advanced-datatable/images/details_close.png";
            oTable.fnOpen( nTr, fnFormatDetails9(oTable, nTr), 'details' );
        }
    } );
 } );


function fnFormatDetails10 ( oTable, nTr )
{
    var aData = oTable.fnGetData( nTr );
    var sOut = '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">';
    sOut += '<tr><td>&nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  &nbsp;<strong>Datos Personales</strong></td><td> </td></tr>';
    sOut += '<tr><td><strong>RFC:</strong></td><td>'+aData[2]+' </td></tr>';
    sOut += '<tr><td><strong>Nombre del Empleado:</strong></td><td>'+aData[3]+' </td></tr>';
    sOut += '<tr><td><strong>Teléfono:</strong></td><td>'+aData[4]+' </td></tr>';
    sOut += '<tr><td><strong>Email:</strong></td><td>'+aData[5]+' </td></tr>';

    sOut += '<tr><td>&nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  &nbsp;<strong>Datos de CTE</strong></td><td> </td></tr>';
    sOut += '<tr><td><strong>CCT:</strong></td><td>'+aData[6]+' </td></tr>';
    sOut += '<tr><td><strong>Nombre de la Escuela:</strong></td><td>'+aData[26]+' </td></tr>';
    sOut += '<tr><td><strong>Región:</strong></td><td>'+aData[1]+' </td></tr>';
    sOut += '<tr><td><strong>Sostenimiento Actual:</strong></td><td>'+aData[7]+' </td></tr>';
    sOut += '<tr><td><strong>Nombre de Localidad</strong></td><td>'+aData[19]+' </td></tr>';
    sOut += '<tr><td><strong>Municipio</strong></td><td>'+aData[20]+' </td></tr>';

    sOut += '<tr><td>&nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  &nbsp;<strong>Datos de la Ultima Modificación</strong></td><td> </td></tr>';
    sOut += '<tr><td><strong>Tipo de Movimiento</strong></td><td>'+aData[27]+' </td></tr>';
    sOut += '<tr><td><strong>Ciclo Escolar</strong></td><td>'+aData[18]+' </td></tr>';
    sOut += '<tr><td><strong>Nombre de quien lo Llega a Cubrir :</strong></td><td>'+aData[29]+' </td></tr>';
    sOut += '<tr><td><strong>RFC de Quien lo llega a Cubrir:</strong></td><td>'+aData[30]+' </td></tr>';
    sOut += '<tr><td><strong>Clave:</strong></td><td>'+aData[8]+' </td></tr>';
    sOut += '<tr><td><strong>Categoria:</strong></td><td>'+aData[9]+' </td></tr>';
    sOut += '<tr><td><strong>Fecha de Baja :</strong></td><td>'+aData[10]+' </td></tr>';
    sOut += '<tr><td><strong>Documentación Entregada:</strong></td><td>'+aData[11]+' </td></tr>';
    sOut += '<tr><td><strong>Observaciónes:</strong></td><td>'+aData[12]+' </td></tr>';
    sOut += '<tr><td><strong>CCT 2:</strong></td><td>'+aData[13]+' </td></tr>';
    sOut += '<tr><td><strong>Dias Trabajados</strong></td><td>'+aData[21]+' </td></tr>';
    
    sOut += '<tr><td>&nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  &nbsp;<strong>Informacion de Captura</strong></td><td> </td></tr>';
    sOut += '<tr><td><strong>Capturado Por:</strong></td><td>'+aData[14]+' </td></tr>';
    sOut += '<tr><td><strong>Fecha de Modificacion</strong></td><td>'+aData[23]+' </td></tr>';
    sOut += '<tr><td><strong>Estado:</strong></td><td>'+aData[15]+' </td></tr>';
    sOut += '<tr><td><strong>Pagos Registrados:</strong></td><td>'+aData[16]+' </td></tr>';
    sOut += '<tr><td><strong>Qna Actual:</strong></td><td>'+aData[17]+' </td></tr>';


    sOut += '<tr><td>&nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  &nbsp;<strong>Historial de Contatos</strong></td><td> </td></tr>';
    sOut += '<tr><td><strong>Ver Historial de Contratos</strong></td><td>'+aData[22]+' </td></tr>';
    sOut += '</table>';

    return sOut;
}

$(document).ready(function() {

    $('#dynamic-table10').dataTable( {
        "aaSorting": [[ 4, "desc" ]]
    } );

    /*
     * Insert a 'details' column to the table
     */
     var nCloneTh = document.createElement( 'th' );
     var nCloneTd = document.createElement( 'td' );
     nCloneTd.innerHTML = '<img src="plugins/advanced-datatable/images/details_open.png">';
     nCloneTd.className = "center";

     $('#hidden-table-info10 thead tr').each( function () {
        this.insertBefore( nCloneTh, this.childNodes[0] );
    } );

     $('#hidden-table-info10 tbody tr').each( function () {
        this.insertBefore(  nCloneTd.cloneNode( true ), this.childNodes[0] );
    } );

    /*
     * Initialse DataTables, with no sorting on the 'details' column
     */
     var oTable = $('#hidden-table-info10').dataTable( {
        "aoColumnDefs": [
        { "bSortable": false, "aTargets": [ 0 ] }
        ],
        "aaSorting": [[1, 'asc']]
    });

    /* Add event listener for opening and closing details
     * Note that the indicator for showing which row is open is not controlled by DataTables,
     * rather it is done here
     */
     $('#hidden-table-info10 tbody td img').click(function () {
        var nTr = $(this).parents('tr')[0];
        if ( oTable.fnIsOpen(nTr) )
        {
            /* This row is already open - close it */
            this.src = "plugins/advanced-datatable/images/details_open.png";
            oTable.fnClose( nTr );
        }
        else
        {
            /* Open this row */
            this.src = "plugins/advanced-datatable/images/details_close.png";
            oTable.fnOpen( nTr, fnFormatDetails10(oTable, nTr), 'details' );
        }
    } );
 } );


function fnFormatDetails11 ( oTable, nTr )
{
    var aData = oTable.fnGetData( nTr );
    var sOut = '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">';
    sOut += '<tr><td>&nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  &nbsp;<strong>Datos Personales</strong></td><td> </td></tr>';
    sOut += '<tr><td><strong>RFC:</strong></td><td>'+aData[2]+' </td></tr>';
    sOut += '<tr><td><strong>Nombre del Empleado:</strong></td><td>'+aData[3]+' </td></tr>';
    sOut += '<tr><td><strong>Teléfono:</strong></td><td>'+aData[4]+' </td></tr>';
    sOut += '<tr><td><strong>Email:</strong></td><td>'+aData[5]+' </td></tr>';

    sOut += '<tr><td>&nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  &nbsp;<strong>Datos de CTE Actual</strong></td><td> </td></tr>';
    sOut += '<tr><td><strong>CCT:</strong></td><td>'+aData[6]+' </td></tr>';
    sOut += '<tr><td><strong>Nombre de la Escuela:</strong></td><td>'+aData[7]+' </td></tr>';
    sOut += '<tr><td><strong>Región:</strong></td><td>'+aData[1]+' </td></tr>';
    sOut += '<tr><td><strong>Sostenimiento Actual:</strong></td><td>'+aData[8]+' </td></tr>';
    sOut += '<tr><td><strong>Nombre de Localidad</strong></td><td>'+aData[21]+' </td></tr>';
    sOut += '<tr><td><strong>Municipio</strong></td><td>'+aData[22]+' </td></tr>';

    sOut += '<tr><td>&nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  &nbsp;<strong>Datos de CTE Anterior</strong></td><td> </td></tr>';
    sOut += '<tr><td><strong>CCT:</strong></td><td>'+aData[24]+' </td></tr>';
    sOut += '<tr><td><strong>Nombre de la Escuela:</strong></td><td>'+aData[25]+' </td></tr>';
    sOut += '<tr><td><strong>Región:</strong></td><td>'+aData[23]+' </td></tr>';
    sOut += '<tr><td><strong>Sostenimiento Actual:</strong></td><td>'+aData[8]+' </td></tr>';
    sOut += '<tr><td><strong>Nombre de Localidad</strong></td><td>'+aData[26]+' </td></tr>';
    sOut += '<tr><td><strong>Municipio</strong></td><td>'+aData[27]+' </td></tr>';


    sOut += '<tr><td>&nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  &nbsp;<strong>Datos de la Ultima Modificación</strong></td><td> </td></tr>';
    sOut += '<tr><td><strong>Tipo de Movimiento</strong></td><td>'+aData[33]+' </td></tr>';
    sOut += '<tr><td><strong>Ciclo Escolar</strong></td><td>'+aData[20]+' </td></tr>';
    sOut += '<tr><td><strong>Clave:</strong></td><td>'+aData[9]+' </td></tr>';
    sOut += '<tr><td><strong>Categoria:</strong></td><td>'+aData[10]+' </td></tr>';
    sOut += '<tr><td><strong>Fecha de Inicio :</strong></td><td>'+aData[11]+' </td></tr>';
    sOut += '<tr><td><strong>Fecha de Baja :</strong></td><td>'+aData[12]+' </td></tr>';
    sOut += '<tr><td><strong>Documentación Entregada:</strong></td><td>'+aData[13]+' </td></tr>';
    sOut += '<tr><td><strong>Observaciónes:</strong></td><td>'+aData[14]+' </td></tr>';
    sOut += '<tr><td><strong>CCT 2:</strong></td><td>'+aData[15]+' </td></tr>';
    sOut += '<tr><td><strong>Dias Trabajados</strong></td><td>'+aData[28]+' </td></tr>';
    
    sOut += '<tr><td>&nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  &nbsp;<strong>Informacion de Captura</strong></td><td> </td></tr>';
    sOut += '<tr><td><strong>Capturado Por:</strong></td><td>'+aData[16]+' </td></tr>';
    sOut += '<tr><td><strong>Fecha de Modificacion</strong></td><td>'+aData[30]+' </td></tr>';
    sOut += '<tr><td><strong>Estado:</strong></td><td>'+aData[17]+' </td></tr>';
    sOut += '<tr><td><strong>Pagos Registrados:</strong></td><td>'+aData[18]+' </td></tr>';
    sOut += '<tr><td><strong>Qna Actual:</strong></td><td>'+aData[19]+' </td></tr>';


    sOut += '<tr><td>&nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  &nbsp;<strong>Historial de Contatos</strong></td><td> </td></tr>';
    sOut += '<tr><td><strong>Ver Historial de Contratos</strong></td><td>'+aData[29]+' </td></tr>';
    sOut += '</table>';

    return sOut;
}

$(document).ready(function() {

    $('#dynamic-table11').dataTable( {
        "aaSorting": [[ 4, "desc" ]]
    } );

    /*
     * Insert a 'details' column to the table
     */
     var nCloneTh = document.createElement( 'th' );
     var nCloneTd = document.createElement( 'td' );
     nCloneTd.innerHTML = '<img src="plugins/advanced-datatable/images/details_open.png">';
     nCloneTd.className = "center";

     $('#hidden-table-info11 thead tr').each( function () {
        this.insertBefore( nCloneTh, this.childNodes[0] );
    } );

     $('#hidden-table-info11 tbody tr').each( function () {
        this.insertBefore(  nCloneTd.cloneNode( true ), this.childNodes[0] );
    } );

    /*
     * Initialse DataTables, with no sorting on the 'details' column
     */
     var oTable = $('#hidden-table-info11').dataTable( {
        "aoColumnDefs": [
        { "bSortable": false, "aTargets": [ 0 ] }
        ],
        "aaSorting": [[1, 'asc']]
    });

    /* Add event listener for opening and closing details
     * Note that the indicator for showing which row is open is not controlled by DataTables,
     * rather it is done here
     */
     $('#hidden-table-info11 tbody td img').click(function () {
        var nTr = $(this).parents('tr')[0];
        if ( oTable.fnIsOpen(nTr) )
        {
            /* This row is already open - close it */
            this.src = "plugins/advanced-datatable/images/details_open.png";
            oTable.fnClose( nTr );
        }
        else
        {
            /* Open this row */
            this.src = "plugins/advanced-datatable/images/details_close.png";
            oTable.fnOpen( nTr, fnFormatDetails11(oTable, nTr), 'details' );
        }
    } );
 } );


function fnFormatDetails12 ( oTable, nTr )
{
    var aData = oTable.fnGetData( nTr );
    var sOut = '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">';
    sOut += '<tr><td>&nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  &nbsp;<strong>Datos Personales</strong></td><td> </td></tr>';
    sOut += '<tr><td><strong>RFC:</strong></td><td>'+aData[2]+' </td></tr>';
    sOut += '<tr><td><strong>Nombre del Empleado:</strong></td><td>'+aData[3]+' </td></tr>';
    sOut += '<tr><td><strong>Teléfono:</strong></td><td>'+aData[4]+' </td></tr>';
    sOut += '<tr><td><strong>Email:</strong></td><td>'+aData[5]+' </td></tr>';

    sOut += '<tr><td>&nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  &nbsp;<strong>Datos de CTE Actual</strong></td><td> </td></tr>';
    sOut += '<tr><td><strong>CCT:</strong></td><td>'+aData[6]+' </td></tr>';
    sOut += '<tr><td><strong>Nombre de la Escuela:</strong></td><td>'+aData[7]+' </td></tr>';
    sOut += '<tr><td><strong>Región:</strong></td><td>'+aData[1]+' </td></tr>';
    sOut += '<tr><td><strong>Sostenimiento Actual:</strong></td><td>'+aData[8]+' </td></tr>';
    sOut += '<tr><td><strong>Nombre de Localidad</strong></td><td>'+aData[21]+' </td></tr>';
    sOut += '<tr><td><strong>Municipio</strong></td><td>'+aData[22]+' </td></tr>';

    sOut += '<tr><td>&nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  &nbsp;<strong>Function Actual</strong></td><td> </td></tr>';
    sOut += '<tr><td><strong>Categoria:</strong></td><td>'+aData[10]+' </td></tr>';

    sOut += '<tr><td>&nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  &nbsp;<strong>Function Anterior</strong></td><td> </td></tr>';
    sOut += '<tr><td><strong>Categoria:</strong></td><td>'+aData[11]+' </td></tr>';


    sOut += '<tr><td>&nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  &nbsp;<strong>Datos de la Ultima Modificación</strong></td><td> </td></tr>';
    sOut += '<tr><td><strong>Tipo de Movimiento</strong></td><td>'+aData[28]+' </td></tr>';
    sOut += '<tr><td><strong>Ciclo Escolar</strong></td><td>'+aData[20]+' </td></tr>';
    sOut += '<tr><td><strong>Clave:</strong></td><td>'+aData[9]+' </td></tr>';
    sOut += '<tr><td><strong>Categoria:</strong></td><td>'+aData[10]+' </td></tr>';
    sOut += '<tr><td><strong>Fecha de Inicio :</strong></td><td>'+aData[12]+' </td></tr>';
    sOut += '<tr><td><strong>Fecha de Baja :</strong></td><td>'+aData[13]+' </td></tr>';
    sOut += '<tr><td><strong>Documentación Entregada:</strong></td><td>'+aData[14]+' </td></tr>';
    sOut += '<tr><td><strong>Observaciónes:</strong></td><td>'+aData[15]+' </td></tr>';
    sOut += '<tr><td><strong>CCT 2:</strong></td><td>'+aData[16]+' </td></tr>';
    sOut += '<tr><td><strong>Dias Trabajados</strong></td><td>'+aData[23]+' </td></tr>';
    
    sOut += '<tr><td>&nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  &nbsp;<strong>Informacion de Captura</strong></td><td> </td></tr>';
    sOut += '<tr><td><strong>Capturado Por:</strong></td><td>'+aData[16]+' </td></tr>';
    sOut += '<tr><td><strong>Fecha de Modificacion</strong></td><td>'+aData[25]+' </td></tr>';
    sOut += '<tr><td><strong>Estado:</strong></td><td>'+aData[17]+' </td></tr>';
    sOut += '<tr><td><strong>Pagos Registrados:</strong></td><td>'+aData[18]+' </td></tr>';
    sOut += '<tr><td><strong>Qna Actual:</strong></td><td>'+aData[19]+' </td></tr>';


    sOut += '<tr><td>&nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  &nbsp;<strong>Historial de Contatos</strong></td><td> </td></tr>';
    sOut += '<tr><td><strong>Ver Historial de Contratos</strong></td><td>'+aData[24]+' </td></tr>';
    sOut += '</table>';

    return sOut;
}

$(document).ready(function() {

    $('#dynamic-table12').dataTable( {
        "aaSorting": [[ 4, "desc" ]]
    } );

    /*
     * Insert a 'details' column to the table
     */
     var nCloneTh = document.createElement( 'th' );
     var nCloneTd = document.createElement( 'td' );
     nCloneTd.innerHTML = '<img src="plugins/advanced-datatable/images/details_open.png">';
     nCloneTd.className = "center";

     $('#hidden-table-info12 thead tr').each( function () {
        this.insertBefore( nCloneTh, this.childNodes[0] );
    } );

     $('#hidden-table-info12 tbody tr').each( function () {
        this.insertBefore(  nCloneTd.cloneNode( true ), this.childNodes[0] );
    } );

    /*
     * Initialse DataTables, with no sorting on the 'details' column
     */
     var oTable = $('#hidden-table-info12').dataTable( {
        "aoColumnDefs": [
        { "bSortable": false, "aTargets": [ 0 ] }
        ],
        "aaSorting": [[1, 'asc']]
    });

    /* Add event listener for opening and closing details
     * Note that the indicator for showing which row is open is not controlled by DataTables,
     * rather it is done here
     */
     $('#hidden-table-info12 tbody td img').click(function () {
        var nTr = $(this).parents('tr')[0];
        if ( oTable.fnIsOpen(nTr) )
        {
            /* This row is already open - close it */
            this.src = "plugins/advanced-datatable/images/details_open.png";
            oTable.fnClose( nTr );
        }
        else
        {
            /* Open this row */
            this.src = "plugins/advanced-datatable/images/details_close.png";
            oTable.fnOpen( nTr, fnFormatDetails12(oTable, nTr), 'details' );
        }
    } );
 } );



function fnFormatDetails13 ( oTable, nTr )
{
    var aData = oTable.fnGetData( nTr );
    var sOut = '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">';
    sOut += '<tr><td>&nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  &nbsp;<strong>Datos Personales</strong></td><td> </td></tr>';
    sOut += '<tr><td><strong>RFC:</strong></td><td>'+aData[2]+' </td></tr>';
    sOut += '<tr><td><strong>Nombre del Empleado:</strong></td><td>'+aData[3]+' </td></tr>';
    sOut += '<tr><td><strong>Teléfono:</strong></td><td>'+aData[4]+' </td></tr>';
    sOut += '<tr><td><strong>Email:</strong></td><td>'+aData[5]+' </td></tr>';
    sOut += '<tr><td><strong>Categoria:</strong></td><td>'+aData[9]+' </td></tr>';

    sOut += '<tr><td>&nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  &nbsp;<strong>Datos de La Inasistencia</strong></td><td> </td></tr>';
    sOut += '<tr><td><strong>Fecha:</strong></td><td>'+aData[12]+' </td></tr>';
    sOut += '<tr><td><strong>Ciclo Escolar:</strong></td><td>'+aData[13]+' </td></tr>';
    sOut += '<tr><td><strong>Observaciónes:</strong></td><td>'+aData[14]+' </td></tr>';
    sOut += '<tr><td><strong>Ver Historial de Inasistencias</strong></td><td>'+aData[33]+' </td></tr>';

    sOut += '<tr><td>&nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  &nbsp;<strong>Datos de CTE Actual</strong></td><td> </td></tr>';
    sOut += '<tr><td><strong>CCT:</strong></td><td>'+aData[6]+' </td></tr>';
    sOut += '<tr><td><strong>Nombre de la Escuela:</strong></td><td>'+aData[30]+' </td></tr>';
    sOut += '<tr><td><strong>Región:</strong></td><td>'+aData[1]+' </td></tr>';
    sOut += '<tr><td><strong>Sostenimiento Actual:</strong></td><td>'+aData[7]+' </td></tr>';
    sOut += '<tr><td><strong>Nombre de Localidad</strong></td><td>'+aData[23]+' </td></tr>';
    sOut += '<tr><td><strong>Municipio</strong></td><td>'+aData[24]+' </td></tr>';


    sOut += '<tr><td>&nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  &nbsp;<strong>Datos de la Ultima Modificación</strong></td><td> </td></tr>';
    sOut += '<tr><td><strong>Tipo de Movimiento</strong></td><td>'+aData[31]+' </td></tr>';
    sOut += '<tr><td><strong>Ciclo Escolar</strong></td><td>'+aData[22]+' </td></tr>';
    sOut += '<tr><td><strong>Clave:</strong></td><td>'+aData[8]+' </td></tr>';
    sOut += '<tr><td><strong>Categoria:</strong></td><td>'+aData[9]+' </td></tr>';
    sOut += '<tr><td><strong>Fecha de Inicio :</strong></td><td>'+aData[10]+' </td></tr>';
    sOut += '<tr><td><strong>Fecha de Baja :</strong></td><td>'+aData[11]+' </td></tr>';
    sOut += '<tr><td><strong>Documentación Entregada:</strong></td><td>'+aData[15]+' </td></tr>';
    sOut += '<tr><td><strong>Observaciónes:</strong></td><td>'+aData[16]+' </td></tr>';
    sOut += '<tr><td><strong>CCT 2:</strong></td><td>'+aData[17]+' </td></tr>';
    sOut += '<tr><td><strong>Dias Trabajados</strong></td><td>'+aData[25]+' </td></tr>';
    
    sOut += '<tr><td>&nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  &nbsp;<strong>Informacion de Captura</strong></td><td> </td></tr>';
    sOut += '<tr><td><strong>Capturado Por:</strong></td><td>'+aData[18]+' </td></tr>';
    sOut += '<tr><td><strong>Fecha de Modificacion</strong></td><td>'+aData[27]+' </td></tr>';
    sOut += '<tr><td><strong>Estado:</strong></td><td>'+aData[19]+' </td></tr>';
    sOut += '<tr><td><strong>Pagos Registrados:</strong></td><td>'+aData[20]+' </td></tr>';
    sOut += '<tr><td><strong>Qna Actual:</strong></td><td>'+aData[21]+' </td></tr>';


    sOut += '<tr><td>&nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  &nbsp;<strong>Historial de Contatos</strong></td><td> </td></tr>';
    sOut += '<tr><td><strong>Ver Historial de Contratos</strong></td><td>'+aData[26]+' </td></tr>';
    sOut += '</table>';

    return sOut;
}

$(document).ready(function() {

    $('#dynamic-table13').dataTable( {
        "aaSorting": [[ 4, "desc" ]]
    } );

    /*
     * Insert a 'details' column to the table
     */
     var nCloneTh = document.createElement( 'th' );
     var nCloneTd = document.createElement( 'td' );
     nCloneTd.innerHTML = '<img src="plugins/advanced-datatable/images/details_open.png">';
     nCloneTd.className = "center";

     $('#hidden-table-info13 thead tr').each( function () {
        this.insertBefore( nCloneTh, this.childNodes[0] );
    } );

     $('#hidden-table-info13 tbody tr').each( function () {
        this.insertBefore(  nCloneTd.cloneNode( true ), this.childNodes[0] );
    } );

    /*
     * Initialse DataTables, with no sorting on the 'details' column
     */
     var oTable = $('#hidden-table-info13').dataTable( {
        "aoColumnDefs": [
        { "bSortable": false, "aTargets": [ 0 ] }
        ],
        "aaSorting": [[1, 'asc']]
    });

    /* Add event listener for opening and closing details
     * Note that the indicator for showing which row is open is not controlled by DataTables,
     * rather it is done here
     */
     $('#hidden-table-info13 tbody td img').click(function () {
        var nTr = $(this).parents('tr')[0];
        if ( oTable.fnIsOpen(nTr) )
        {
            /* This row is already open - close it */
            this.src = "plugins/advanced-datatable/images/details_open.png";
            oTable.fnClose( nTr );
        }
        else
        {
            /* Open this row */
            this.src = "plugins/advanced-datatable/images/details_close.png";
            oTable.fnOpen( nTr, fnFormatDetails13(oTable, nTr), 'details' );
        }
    } );
 } );


function fnFormatDetails14 ( oTable, nTr )
{
    var aData = oTable.fnGetData( nTr );
    var sOut = '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">';
    sOut += '<tr><td>&nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  &nbsp;<strong>Datos Personales</strong></td><td> </td></tr>';
    sOut += '<tr><td><strong>RFC:</strong></td><td>'+aData[1]+' </td></tr>';
    sOut += '<tr><td><strong>Nombre del Empleado:</strong></td><td>'+aData[2]+' </td></tr>';
    sOut += '<tr><td><strong>Teléfono:</strong></td><td>'+aData[5]+' </td></tr>';
    sOut += '<tr><td><strong>Email:</strong></td><td>'+aData[6]+' </td></tr>';
    sOut += '<tr><td><strong>Categoria:</strong></td><td>'+aData[11]+' </td></tr>';

    sOut += '<tr><td>&nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  &nbsp;<strong>Datos del Reclamo</strong></td><td> </td></tr>';
    sOut += '<tr><td><strong>Motivo:</strong></td><td>'+aData[9]+' </td></tr>';
    sOut += '<tr><td><strong>Periodo Reclamo Inicial:</strong></td><td>'+aData[12]+' </td></tr>';
    sOut += '<tr><td><strong>Periodo Reclamo Inicial:</strong></td><td>'+aData[13]+' </td></tr>';
    sOut += '<tr><td><strong>Total de Dias Habiles:</strong></td><td>'+aData[14]+' </td></tr>';
    sOut += '<tr><td><strong>Monto Total:</strong></td><td>'+aData[15]+' </td></tr>';
    sOut += '<tr><td><strong>Observaciónes:</strong></td><td>'+aData[16]+' </td></tr>';
    sOut += '<tr><td><strong>Num. de Oficio:</strong></td><td>'+aData[17]+' </td></tr>';
    sOut += '<tr><td><strong>Estado del Reclamo:</strong></td><td>'+aData[19]+' </td></tr>';

    sOut += '<tr><td>&nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  &nbsp;<strong>Datos de CTE Actual</strong></td><td> </td></tr>';
    sOut += '<tr><td><strong>CCT:</strong></td><td>'+aData[3]+' </td></tr>';
    sOut += '<tr><td><strong>Nombre de la Escuela:</strong></td><td>'+aData[4]+' </td></tr>';
    sOut += '<tr><td><strong>Región:</strong></td><td>'+aData[7]+' </td></tr>';
    sOut += '<tr><td><strong>Sostenimiento Actual:</strong></td><td>'+aData[8]+' </td></tr>';
    sOut += '<tr><td><strong>Nombre de Localidad</strong></td><td>'+aData[21]+' </td></tr>';
    sOut += '<tr><td><strong>Municipio</strong></td><td>'+aData[22]+' </td></tr>';


    sOut += '<tr><td>&nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  &nbsp;<strong>Datos de la Captura</strong></td><td> </td></tr>';
    sOut += '<tr><td><strong>Tipo de Movimiento</strong></td><td>'+aData[28]+' </td></tr>';
    sOut += '<tr><td><strong>Ciclo Escolar</strong></td><td>'+aData[20]+' </td></tr>';
    sOut += '<tr><td><strong>Clave:</strong></td><td>'+aData[10]+' </td></tr>';
    sOut += '<tr><td><strong>Categoria:</strong></td><td>'+aData[11]+' </td></tr>';
    sOut += '<tr><td><strong>Fecha de Inicio :</strong></td><td>'+aData[32]+' </td></tr>';
    sOut += '<tr><td><strong>Fecha de Baja :</strong></td><td>'+aData[33]+' </td></tr>';
    sOut += '<tr><td><strong>Observaciónes:</strong></td><td>'+aData[34]+' </td></tr>';
    sOut += '<tr><td><strong>Dias Trabajados</strong></td><td>'+aData[23]+' </td></tr>';
    
    sOut += '<tr><td>&nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  &nbsp;<strong>Informacion de Captura</strong></td><td> </td></tr>';
    sOut += '<tr><td><strong>Capturado Por:</strong></td><td>'+aData[18]+' </td></tr>';
    sOut += '<tr><td><strong>Fecha de Modificacion</strong></td><td>'+aData[25]+' </td></tr>';
    sOut += '<tr><td><strong>Estado:</strong></td><td>'+aData[19]+' </td></tr>';


    sOut += '<tr><td>&nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  &nbsp;<strong>Historial de Contatos</strong></td><td> </td></tr>';
    sOut += '<tr><td><strong>Ver Historial de Contratos</strong></td><td>'+aData[24]+' </td></tr>';
    sOut += '</table>';

    return sOut;
}

$(document).ready(function() {

    $('#dynamic-table14').dataTable( {
        "aaSorting": [[ 4, "desc" ]]
    } );

    /*
     * Insert a 'details' column to the table
     */
     var nCloneTh = document.createElement( 'th' );
     var nCloneTd = document.createElement( 'td' );
     nCloneTd.innerHTML = '<img src="plugins/advanced-datatable/images/details_open.png">';
     nCloneTd.className = "center";

     $('#hidden-table-info14 thead tr').each( function () {
        this.insertBefore( nCloneTh, this.childNodes[0] );
    } );

     $('#hidden-table-info14 tbody tr').each( function () {
        this.insertBefore(  nCloneTd.cloneNode( true ), this.childNodes[0] );
    } );

    /*
     * Initialse DataTables, with no sorting on the 'details' column
     */
     var oTable = $('#hidden-table-info14').dataTable( {
        "aoColumnDefs": [
        { "bSortable": false, "aTargets": [ 0 ] }
        ],
        "aaSorting": [[1, 'asc']]
    });

    /* Add event listener for opening and closing details
     * Note that the indicator for showing which row is open is not controlled by DataTables,
     * rather it is done here
     */
     $('#hidden-table-info14 tbody td img').click(function () {
        var nTr = $(this).parents('tr')[0];
        if ( oTable.fnIsOpen(nTr) )
        {
            /* This row is already open - close it */
            this.src = "plugins/advanced-datatable/images/details_open.png";
            oTable.fnClose( nTr );
        }
        else
        {
            /* Open this row */
            this.src = "plugins/advanced-datatable/images/details_close.png";
            oTable.fnOpen( nTr, fnFormatDetails14(oTable, nTr), 'details' );
        }
    } );
 } );


function fnFormatDetails15 ( oTable, nTr )
{
    var aData = oTable.fnGetData( nTr );
    var sOut = '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">';
    sOut += '<tr><td>&nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  &nbsp;<strong>Datos Personales</strong></td><td> </td></tr>';
    sOut += '<tr><td><strong>Lic:</strong></td><td>'+aData[1]+' </td></tr>';
    sOut += '<tr><td><strong>Nombre Completo :</strong></td><td>'+aData[2]+' </td></tr>';
    sOut += '<tr><td><strong>Nombre:</strong></td><td>'+aData[4]+' </td></tr>';
    sOut += '<tr><td><strong>Apellido Paterno:</strong></td><td>'+aData[5]+' </td></tr>';
    sOut += '<tr><td><strong>Apellido Materno:</strong></td><td>'+aData[6]+' </td></tr>';
    sOut += '<tr><td><strong>A_N:</strong></td><td>'+aData[7]+' </td></tr>';

    sOut += '<tr><td>&nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  &nbsp;<strong>Datos del Puesto</strong></td><td> </td></tr>';
    sOut += '<tr><td><strong>Puesto:</strong></td><td>'+aData[3]+' </td></tr>';
    sOut += '<tr><td><strong>Dirección:</strong></td><td>'+aData[8]+' </td></tr>';
    sOut += '<tr><td><strong>A_D:</strong></td><td>'+aData[9]+' </td></tr>';
    sOut += '<tr><td><strong>Correo:</strong></td><td>'+aData[10]+' </td></tr>';
    sOut += '<tr><td><strong>Ext:</strong></td><td>'+aData[11]+' </td></tr>';

    sOut += '<tr><td>&nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  &nbsp;<strong>Datos de Captura</strong></td><td> </td></tr>';
    sOut += '<tr><td><strong>Capturo:</strong></td><td>'+aData[12]+' </td></tr>';
    sOut += '<tr><td><strong>Modifico:</strong></td><td>'+aData[13]+' </td></tr>';
    sOut += '<tr><td><strong>Creo:</strong></td><td>'+aData[14]+' </td></tr>';



    sOut += '</table>';

    return sOut;
}

$(document).ready(function() {

    $('#dynamic-table15').dataTable( {
        "aaSorting": [[ 4, "desc" ]]
    } );

    /*
     * Insert a 'details' column to the table
     */
     var nCloneTh = document.createElement( 'th' );
     var nCloneTd = document.createElement( 'td' );
     nCloneTd.innerHTML = '<img src="plugins/advanced-datatable/images/details_open.png">';
     nCloneTd.className = "center";

     $('#hidden-table-info15 thead tr').each( function () {
        this.insertBefore( nCloneTh, this.childNodes[0] );
    } );

     $('#hidden-table-info15 tbody tr').each( function () {
        this.insertBefore(  nCloneTd.cloneNode( true ), this.childNodes[0] );
    } );

    /*
     * Initialse DataTables, with no sorting on the 'details' column
     */
     var oTable = $('#hidden-table-info15').dataTable( {
        "aoColumnDefs": [
        { "bSortable": false, "aTargets": [ 0 ] }
        ],
        "aaSorting": [[1, 'asc']]
    });

    /* Add event listener for opening and closing details
     * Note that the indicator for showing which row is open is not controlled by DataTables,
     * rather it is done here
     */
     $('#hidden-table-info15 tbody td img').click(function () {
        var nTr = $(this).parents('tr')[0];
        if ( oTable.fnIsOpen(nTr) )
        {
            /* This row is already open - close it */
            this.src = "plugins/advanced-datatable/images/details_open.png";
            oTable.fnClose( nTr );
        }
        else
        {
            /* Open this row */
            this.src = "plugins/advanced-datatable/images/details_close.png";
            oTable.fnOpen( nTr, fnFormatDetails15(oTable, nTr), 'details' );
        }
    } );
 } );


function fnFormatDetails16 ( oTable, nTr )
{
    var aData = oTable.fnGetData( nTr );
    var sOut = '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">';
    sOut += '<tr><td>&nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  &nbsp;<strong>Datos Personales</strong></td><td> </td></tr>';
    sOut += '<tr><td><strong>Lic:</strong></td><td>'+aData[1]+' </td></tr>';
    sOut += '<tr><td><strong>Nombre :</strong></td><td>'+aData[2]+' </td></tr>';
    sOut += '<tr><td><strong>RFC:</strong></td><td>'+aData[3]+' </td></tr>';
    sOut += '<tr><td><strong>CURP:</strong></td><td>'+aData[7]+' </td></tr>';
    sOut += '<tr><td><strong>Fecha Nacimiento:</strong></td><td>'+aData[8]+' </td></tr>';
    sOut += '<tr><td><strong>Télefono:</strong></td><td>'+aData[4]+' </td></tr>';
    sOut += '<tr><td><strong>Email:</strong></td><td>'+aData[5]+' </td></tr>';
    sOut += '<tr><td><strong>Domicilio:</strong></td><td>'+aData[9]+' </td></tr>';
    sOut += '<tr><td><strong>Num de Seguro:</strong></td><td>'+aData[10]+' </td></tr>';
    sOut += '<tr><td><strong>Abrebiatura para Oficios:</strong></td><td>'+aData[6]+' </td></tr>';

    sOut += '<tr><td>&nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  &nbsp;<strong>Datos del Puesto</strong></td><td> </td></tr>';
    sOut += '<tr><td><strong>Licenciatura:</strong></td><td>'+aData[11]+' </td></tr>';
    sOut += '<tr><td><strong>Puesto:</strong></td><td>'+aData[15]+' </td></tr>';
    sOut += '<tr><td><strong>Área:</strong></td><td>'+aData[16]+' </td></tr>';
    sOut += '<tr><td><strong>Tipo:</strong></td><td>'+aData[17]+' </td></tr>';
    sOut += '<tr><td><strong>Fecha de Ingreso al PETC:</strong></td><td>'+aData[12]+' </td></tr>';
    sOut += '<tr><td><strong>Fecha de Salida del PETC:</strong></td><td>'+aData[13]+' </td></tr>';

    sOut += '<tr><td>&nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  &nbsp;<strong>Datos de Captura</strong></td><td> </td></tr>';
    sOut += '<tr><td><strong>Sueldo:</strong></td><td>'+aData[18]+' </td></tr>';
    sOut += '<tr><td><strong>Deducciones:</strong></td><td>'+aData[19]+' </td></tr>';
    sOut += '<tr><td><strong>Neto:</strong></td><td>'+aData[20]+' </td></tr>';

    sOut += '<tr><td>&nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  &nbsp;<strong>Datos de Captura</strong></td><td> </td></tr>';
    sOut += '<tr><td><strong>Imagen:</strong></td><td>'+aData[14]+' </td></tr>';
    sOut += '<tr><td><strong>Capturo:</strong></td><td>'+aData[21]+' </td></tr>';
    sOut += '<tr><td><strong>Actualización:</strong></td><td>'+aData[23]+' </td></tr>';


    sOut += '</table>';

    return sOut;
}

$(document).ready(function() {

    $('#dynamic-table16').dataTable( {
        "aaSorting": [[ 4, "desc" ]]
    } );

    /*
     * Insert a 'details' column to the table
     */
     var nCloneTh = document.createElement( 'th' );
     var nCloneTd = document.createElement( 'td' );
     nCloneTd.innerHTML = '<img src="plugins/advanced-datatable/images/details_open.png">';
     nCloneTd.className = "center";

     $('#hidden-table-info16 thead tr').each( function () {
        this.insertBefore( nCloneTh, this.childNodes[0] );
    } );

     $('#hidden-table-info16 tbody tr').each( function () {
        this.insertBefore(  nCloneTd.cloneNode( true ), this.childNodes[0] );
    } );

    /*
     * Initialse DataTables, with no sorting on the 'details' column
     */
     var oTable = $('#hidden-table-info16').dataTable( {
        "aoColumnDefs": [
        { "bSortable": false, "aTargets": [ 0 ] }
        ],
        "aaSorting": [[1, 'asc']]
    });

    /* Add event listener for opening and closing details
     * Note that the indicator for showing which row is open is not controlled by DataTables,
     * rather it is done here
     */
     $('#hidden-table-info16 tbody td img').click(function () {
        var nTr = $(this).parents('tr')[0];
        if ( oTable.fnIsOpen(nTr) )
        {
            /* This row is already open - close it */
            this.src = "plugins/advanced-datatable/images/details_open.png";
            oTable.fnClose( nTr );
        }
        else
        {
            /* Open this row */
            this.src = "plugins/advanced-datatable/images/details_close.png";
            oTable.fnOpen( nTr, fnFormatDetails16(oTable, nTr), 'details' );
        }
    } );
 } );


function fnFormatDetails17 ( oTable, nTr )
{
    var aData = oTable.fnGetData( nTr );
    var sOut = '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">';
    sOut += '<tr><td>&nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  &nbsp;<strong>Datos Personales</strong></td><td> </td></tr>';
    sOut += '<tr><td><strong>Nombre :</strong></td><td>'+aData[2]+' </td></tr>';
    sOut += '<tr><td><strong>RFC:</strong></td><td>'+aData[3]+' </td></tr>';
    sOut += '<tr><td><strong>Región:</strong></td><td>'+aData[1]+' </td></tr>';
    sOut += '<tr><td><strong>Ciclo Escolar:</strong></td><td>'+aData[12]+' </td></tr>';

    sOut += '<tr><td>&nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  &nbsp;<strong>Datos del Pago</strong></td><td> </td></tr>';
    sOut += '<tr><td><strong>Qna Inicial:</strong></td><td>'+aData[4]+' </td></tr>';
    sOut += '<tr><td><strong>Qna final:</strong></td><td>'+aData[5]+' </td></tr>';
    sOut += '<tr><td><strong>Qna Pago:</strong></td><td>'+aData[6]+' </td></tr>';
    sOut += '<tr><td><strong>Percepciòn:</strong></td><td>'+aData[8]+' </td></tr>';
    sOut += '<tr><td><strong>Deducciòn:</strong></td><td>'+aData[9]+' </td></tr>';
    sOut += '<tr><td><strong>Neto:</strong></td><td>'+aData[10]+' </td></tr>';
    sOut += '<tr><td><strong>Numèro de Cheque:</strong></td><td>'+aData[7]+' </td></tr>';

    sOut += '<tr><td>&nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  &nbsp;<strong>Observaciónes</strong></td><td> </td></tr>';
    sOut += '<tr><td><strong>Observaciónes:</strong></td><td>'+aData[11]+' </td></tr>';
    sOut += '<tr><td><strong>Estado:</strong></td><td>'+aData[13]+' </td></tr>';

    sOut += '<tr><td>&nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  &nbsp;<strong>Datos de Captura</strong></td><td> </td></tr>';
    sOut += '<tr><td><strong>Capturo:</strong></td><td>'+aData[14]+' </td></tr>';
    sOut += '<tr><td><strong>Actualización:</strong></td><td>'+aData[15]+' </td></tr>';


    sOut += '</table>';

    return sOut;
}

$(document).ready(function() {

    $('#dynamic-table17').dataTable( {
        "aaSorting": [[ 4, "desc" ]]
    } );

    /*
     * Insert a 'details' column to the table
     */
     var nCloneTh = document.createElement( 'th' );
     var nCloneTd = document.createElement( 'td' );
     nCloneTd.innerHTML = '<img src="plugins/advanced-datatable/images/details_open.png">';
     nCloneTd.className = "center";

     $('#hidden-table-info17 thead tr').each( function () {
        this.insertBefore( nCloneTh, this.childNodes[0] );
    } );

     $('#hidden-table-info17 tbody tr').each( function () {
        this.insertBefore(  nCloneTd.cloneNode( true ), this.childNodes[0] );
    } );

    /*
     * Initialse DataTables, with no sorting on the 'details' column
     */
     var oTable = $('#hidden-table-info17').dataTable( {
        "aoColumnDefs": [
        { "bSortable": false, "aTargets": [ 0 ] }
        ],
        "aaSorting": [[1, 'asc']]
    });

    /* Add event listener for opening and closing details
     * Note that the indicator for showing which row is open is not controlled by DataTables,
     * rather it is done here
     */
     $('#hidden-table-info17 tbody td img').click(function () {
        var nTr = $(this).parents('tr')[0];
        if ( oTable.fnIsOpen(nTr) )
        {
            /* This row is already open - close it */
            this.src = "plugins/advanced-datatable/images/details_open.png";
            oTable.fnClose( nTr );
        }
        else
        {
            /* Open this row */
            this.src = "plugins/advanced-datatable/images/details_close.png";
            oTable.fnOpen( nTr, fnFormatDetails17(oTable, nTr), 'details' );
        }
    } );
 } );


function fnFormatDetails18 ( oTable, nTr )
{
    var aData = oTable.fnGetData( nTr );
    var sOut = '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">';
    sOut += '<tr><td>&nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  &nbsp;<strong>Datos de la Escuela</strong></td><td> </td></tr>';
    sOut += '<tr><td><strong>CCT :</strong></td><td>'+aData[1]+' </td></tr>';
    sOut += '<tr><td><strong>Nombre de la Escuela:</strong></td><td>'+aData[2]+' </td></tr>';
    sOut += '<tr><td><strong>Región:</strong></td><td>'+aData[3]+' </td></tr>';
    sOut += '<tr><td><strong>Sostenimiento:</strong></td><td>'+aData[4]+' </td></tr>';
    sOut += '<tr><td><strong>Domicilio:</strong></td><td>'+aData[5]+' </td></tr>';
    sOut += '<tr><td><strong>Telefono:</strong></td><td>'+aData[6]+' </td></tr>';
    sOut += '<tr><td><strong>Email:</strong></td><td>'+aData[7]+' </td></tr>';

    sOut += '<tr><td>&nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  &nbsp;<strong>Datos del Recurso de Fortalecimiento</strong></td><td> </td></tr>';
    sOut += '<tr><td><strong>Monto:</strong></td><td>'+aData[8]+' </td></tr>';
    sOut += '<tr><td><strong>Observaciónes:</strong></td><td>'+aData[9]+' </td></tr>';
    sOut += '<tr><td><strong>Capturo:</strong></td><td>'+aData[10]+' </td></tr>';
        sOut += '<tr><td><strong>Ciclo Escolar:</strong></td><td>'+aData[17]+' </td></tr>';

    sOut += '<tr><td>&nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  &nbsp;<strong>Datos de la Tarjeta</strong></td><td> </td></tr>';
    sOut += '<tr><td><strong>N° de Tarjeta:</strong></td><td>'+aData[11]+' </td></tr>';
    sOut += '<tr><td><strong>TSL:</strong></td><td>'+aData[12]+' </td></tr>';
    sOut += '<tr><td><strong>Producto:</strong></td><td>'+aData[13]+' </td></tr>';
    sOut += '<tr><td><strong>Empresa:</strong></td><td>'+aData[14]+' </td></tr>';
    sOut += '<tr><td><strong>Observaciónes:</strong></td><td>'+aData[15]+' </td></tr>';
    sOut += '<tr><td><strong>Captura:</strong></td><td>'+aData[16]+' </td></tr>';

    sOut += '<tr><td>&nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  &nbsp;<strong>Datos de Captura</strong></td><td> </td></tr>';
    sOut += '<tr><td><strong>Actualización:</strong></td><td>'+aData[18]+' </td></tr>';


    sOut += '</table>';

    return sOut;
}

$(document).ready(function() {

    $('#dynamic-table18').dataTable( {
        "aaSorting": [[ 4, "desc" ]]
    } );

    /*
     * Insert a 'details' column to the table
     */
     var nCloneTh = document.createElement( 'th' );
     var nCloneTd = document.createElement( 'td' );
     nCloneTd.innerHTML = '<img src="plugins/advanced-datatable/images/details_open.png">';
     nCloneTd.className = "center";

     $('#hidden-table-info18 thead tr').each( function () {
        this.insertBefore( nCloneTh, this.childNodes[0] );
    } );

     $('#hidden-table-info18 tbody tr').each( function () {
        this.insertBefore(  nCloneTd.cloneNode( true ), this.childNodes[0] );
    } );

    /*
     * Initialse DataTables, with no sorting on the 'details' column
     */
     var oTable = $('#hidden-table-info18').dataTable( {
        "aoColumnDefs": [
        { "bSortable": false, "aTargets": [ 0 ] }
        ],
        "aaSorting": [[1, 'asc']]
    });

    /* Add event listener for opening and closing details
     * Note that the indicator for showing which row is open is not controlled by DataTables,
     * rather it is done here
     */
     $('#hidden-table-info18 tbody td img').click(function () {
        var nTr = $(this).parents('tr')[0];
        if ( oTable.fnIsOpen(nTr) )
        {
            /* This row is already open - close it */
            this.src = "plugins/advanced-datatable/images/details_open.png";
            oTable.fnClose( nTr );
        }
        else
        {
            /* Open this row */
            this.src = "plugins/advanced-datatable/images/details_close.png";
            oTable.fnOpen( nTr, fnFormatDetails18(oTable, nTr), 'details' );
        }
    } );
 } );
