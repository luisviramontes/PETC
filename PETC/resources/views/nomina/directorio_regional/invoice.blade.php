<!DOCTYPE html>
<html lang="es">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <title>Directorio Regional</title>
  <link rel="stylesheet" href="css/plantillapdf2.css" media="all" />
  <style media="screen">
     @page { size: 20cm 40cm landscape; }
  </style>
</head>
<body>
  <header class="clearfix">
    <div id="logo">
      <img src="img/logopetc2.jpg"  width="1400"  height="70"/>



    </div>



    <h1>Directorio Regional: </h1>
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
          <th>Region</th>
          <th>Sostenimiento</th>
          <th>Nombre Enlace</th>
          <th>Telefono</th>
          <th>Extencion Enlace 1</th>
          <th>Extencion Enlace 2</th>
          <th>Correo Enlace</th>
          <th>Director Regional</th>
          <th>Telefono Director</th>
          <th>Financiero Regional</th>
          <th>Telefono Regional</th>
          <th>Extencion Regional 1</th>
          <th>Extencion Regional 2</th>
        </tr>
      </thead>
      <tbody>
        @foreach($directorio_regional as $datos)
        <tr>
          <td class="no">{{$datos->region}}</td>
          <td class="unit">{{$datos->sostenimiento}}</td>
          <td class="total">{{$datos->nombre_enlace}} </td>
          <td class="unit">{{$datos->telefono}}</td>
          <td class="unit">{{$datos->ext1_enlace}}</td>
          <td class="unit">{{$datos->ext2_enlace}}</td>
          <td class="unit">{{$datos->correo_enlace}}</td>
          <td class="unit">{{$datos->director_regional}}</td>
          <td class="unit">{{$datos->telefono_director}}</td>
          <td class="unit">{{$datos->financiero_regional}}</td>
          <td class="unit">{{$datos->telefono_regional}}</td>
          <td class="unit">{{$datos->ext_reg_1}}</td>
          <td class="unit">{{$datos->ext_reg_2}}</td>

        </tr>
        @endforeach
      </tbody>
      <tfoot>

      </tfoot>
    </table>
        <div><?php echo DNS2D::getBarcodeHTML('{$entrada->region}', "QRCODE",3,3);?></div>
<br/>
        <div><?php echo DNS1D::getBarcodeHTML('{$entrada->region}', "C128",1,40);?></div>
  </body>
  </html>
