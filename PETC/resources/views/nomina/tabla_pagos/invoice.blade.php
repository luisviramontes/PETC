<!DOCTYPE html>
<html lang="es">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <title>Tabla de Pagos Ciclo: {{$tabla_2->ciclo}}</title>
  <link rel="stylesheet" href="css/plantilla.css" media="all" />
</head>
<body>
  <header class="clearfix">
    <div id="logo">
      <img src="img/logopetc2.jpg"  width="750" height="80"/>
    </div>
    <h1>Tabla de Pagos Ciclo: {{$tabla_2->ciclo}}</h1>
    <div id="project" >
      <div><span> Programa</span> PROGRAMA ESCUELAS DE TIEMPO COMPLETO</div>
      <div><span>Área: </span> Nomina y Sistemas</div> 
      <div><span>Email: </span> NOMINA.ETC@GMAIL.COM</div>
      <div><span>Tel: </span>9220666 EXT: 5403-5405</div>
    </div>
 
    <div id="project2" align="right" >
      <div><span>Fecha: </span> {{$date}}</div>
      <div><span>Pago Por Dia Director: </span>${{$pago->pago_director}}</div>
      <div><span>Pago Por Dia Docente: </span>${{$pago->pago_docente}}</div>
      <div><span>Pago Por Dia Director:</span>${{$pago->pago_intendente}}</div>
    </div>
  </header>

  <main>

    <table name="table_producto" id="table_producto" border="0" cellspacing="0" cellpadding="0">
      <thead>
        <tr>
          <th class="no">Quincena</th>
          <th class="desc">Dias</th>
          <th class="unit">Pago Por Director</th>
          <th class="unit">Pago Por Docente</th>
          <th class="unit">Pago Por Intendete</th>
          <th class="total">Ciclo Escolar</th>
        </tr>
      </thead>
      <tbody>
        @foreach($tabla as $datos)
        <tr>
          <td class="no">{{$datos->qna}}</td>           
          <td class="unit">{{$datos->dias}}</td>
          <td class="total">${{$datos->pago_director}} </td>
          <td class="unit">${{$datos->pago_docente}}</td>
          <td class="unit">${{$datos->pago_intendente}}</td>
          <td class="unit">{{$datos->ciclo}}</td>      
        </tr>
        @endforeach
      </tbody>
      <tfoot>

      </tfoot>
    </table>
        <div><?php echo DNS2D::getBarcodeHTML('{$entrada->qna}', "QRCODE",3,3);?></div>
<br/>
        <div><?php echo DNS1D::getBarcodeHTML('{$entrada->qna}', "C128",1,40);?></div>
  </body>
  </html>