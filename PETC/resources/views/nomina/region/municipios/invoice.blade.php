<!DOCTYPE html>
<html lang="es">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <title>Tabla de Municipios</title>
  <link rel="stylesheet" href="css/plantilla.css" media="all" />
</head>
<body>
  <header class="clearfix">
    <div id="logo">
      <img src="img/logopetc2.jpg"  width="750" height="80"/>
    </div>
    <h1>Tabla de Municipios</h1>
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
          <th class="no">Región</th>
          <th class="desc">Municipio</th>
          <th class="unit">Cabecera Municipal</th>
          <th class="unit">Población Total</th>
          <th class="unit">Área en KM</th>
        </tr>
      </thead>
      <tbody>
        @foreach($tabla as $datos)
        <tr>
          <td class="no">{{$datos->region}}</td>           
          <td class="unit">{{$datos->municipio}}</td>
          <td class="total">{{$datos->cabecera}} </td>
          <td class="unit">{{$datos->poblacion}} Hab.</td>
          <td class="unit">{{$datos->area_km}} KM</td>
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