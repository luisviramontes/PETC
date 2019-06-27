<!DOCTYPE html>
<html lang="es">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <title>Rechazos Federales</title>
  <link rel="stylesheet" href="css/plantillacat_puesto.css" media="all" />
  <style media="screen">
     @page { size: 30cm 31cm landscape; }
  </style>
</head>
<body>
  <header class="clearfix">
    <div id="logo">
      <img src="img/logopetc2.jpg"  width="1100"  height="70"/>



    </div>



    <h1>Rechazos Federales: </h1>
    <div id="project" >
      <div><span> Programa</span> PROGRAMA ESCUELAS DE TIEMPO COMPLETO</div>
      <div><span>Área: </span> Nomina y Sistemas</div>
      <div><span>Email: </span> NOMINA.ETC@GMAIL.COM</div>
      <div><span>Tel: </span>9220666 EXT: 5403-5405</div>
    </div>

    <div id="project2" align="right" >

    </div>
  </header>

  <main>

    <table name="table_producto" id="table_producto" border="0" cellspacing="0" cellpadding="0">
      <thead>
        <tr>
          <th>Número de cheque</th>
          <th>UDC</th>
          <th>RFC</th>
          <th>CURP</th>
          <th>Nombre</th>
          <th>CT</th>
          <th>Importe</th>
          <th>Quincena Pago</th>
          <th>Fecha de Registro</th>

        </tr>
      </thead>
      <tbody>
        @foreach($rechazo as $rechazo)
        <tr>
          <td>{{$rechazo->num_cheque}} </td>
          <td>{{$rechazo->udc}}</td>
          <td>{{$rechazo->rfc}}</td>
          <td>{{$rechazo->curp}}</td>
          <td>{{$rechazo->nombre}}</td>
          <td>{{$rechazo->ct}}</td>
          <td>{{$rechazo->importe}}</td>
          <td>{{$rechazo->qna_pago}}</td>
          <td>{{$rechazo->created_at}}</td>



        </tr>
        @endforeach
      </tbody>
      <tfoot>

      </tfoot>
    </table>
        <div><?php echo DNS2D::getBarcodeHTML('{$entrada->bancos}', "QRCODE",3,3);?></div>
<br/>
        <div><?php echo DNS1D::getBarcodeHTML('{$entrada->bancos', "C128",1,40);?></div>
  </body>
  </html>
