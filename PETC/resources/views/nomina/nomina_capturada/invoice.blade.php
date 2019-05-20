<!DOCTYPE html>
<html lang="es">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <title>Nominas Capturadas</title>
  <link rel="stylesheet" href="css/plantilla.css" media="all" />
  <style media="screen">
  </style>
</head>
<body>
  <header class="clearfix">
    <div id="logo">
      <img src="img/logopetc2.jpg"  width="700"  height="70"/>



    </div>



    <h1>Nominas Capturadas: </h1>
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
          <th>Quincena </th>
          <th>Sostenimiento</th>
          <th>Tipo</th>
          <th>Fecha de Captura</th>
          <th>Captura</th>

        </tr>
      </thead>
      <tbody>
        @foreach($nomina as $nomina)
        <tr>
          <td>{{$nomina->qna}} </td>
          <td>{{$nomina->sostenimiento}} </td>
          <td>{{$nomina->tipo}}</td>
          <td>{{$nomina->created_at}}</td>
          <td>{{$nomina->captura}}</td>



        </tr>
        @endforeach
      </tbody>
      <tfoot>

      </tfoot>
    </table>
        <div><?php echo DNS2D::getBarcodeHTML('{$entrada->nomina_capturada}', "QRCODE",3,3);?></div>
<br/>
        <div><?php echo DNS1D::getBarcodeHTML('{$entrada->nomina_capturada', "C128",1,40);?></div>
  </body>
  </html>
