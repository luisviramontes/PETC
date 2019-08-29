<!DOCTYPE html>
<html lang="es">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <title>Listas de Asistencias</title>
  <link rel="stylesheet" href="css/plantilla.css" media="all" />
  <style media="screen">
  </style>
</head>
<body>
  <header class="clearfix">
    <div id="logo">
      <img src="img/logopetc2.jpg"  width="700"  height="70"/>



    </div>



    <h1>Listas de Asistencias: </h1>
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
          <th>CCT</th>
          <th>Nombre de la Escuela</th>
          <th>Region</th>
          <th>Mes</th>
          <th>Observaciones</th>
          <th>Estado</th>

        </tr>
      </thead>
      <tbody>
        @foreach($listas as $lista)
        <tr>
          <td>{{$lista->cct}}</td>
          <td>{{$lista->nombre_escuela}}</td>
          <td>{{$lista->region}} </td>
          <td>{{$lista->mes}}</td>
          <td>{{$lista->observaciones}}</td>
          <td>{{$lista->estado}}</td>


        </tr>
        @endforeach
      </tbody>
      <tfoot>

      </tfoot>
    </table>
        <div><?php echo DNS2D::getBarcodeHTML('{$entrada->listas}', "QRCODE",3,3);?></div>
<br/>
        <div><?php echo DNS1D::getBarcodeHTML('{$entrada->listas}', "C128",1,40);?></div>
  </body>
  </html>
