<!DOCTYPE html>
<html lang="es">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <title>Solicitudes</title>
  <link rel="stylesheet" href="css/plantilla_solicitudes.css" media="all" />
  <style media="screen">
		@page { size: 30cm 29.7cm landscape; }
	</style>
</head>
<body>
  <header class="clearfix">
    <div id="logo">
      <img src="img/logopetc3.jpg"  width="1200"  height="80"/>



    </div>



    <h1>Solicitudes: </h1>
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
          <th>Ciclo Escolar</th>
          <th>Municipio</th>
          <th>Localidad</th>
          <th>Domicilio</th>
          <th>Nivel</th>
          <th>Estado de Tramite</th>
          <th>Fecha Recepcion</th>



        </tr>
      </thead>
      <tbody>
        @foreach($solicitudes as $solicitud)
        <tr>
          <td>{{$solicitud->cct}} </td>
          <td>{{$solicitud->nombre_escuela}}</td>
          <td>{{$solicitud->ciclo}}</td>
          <td>{{$solicitud->municipio}}</td>
          <td>{{$solicitud->nom_loc}}</td>
          <td>{{$solicitud->domicilio}}</td>
          <td>{{$solicitud->nivel}}</td>
          <td>{{$solicitud->tramite_estado}}</td>
          <td>{{$solicitud->fecha_recepcion}}</td>




        </tr>
        @endforeach
      </tbody>
      <tfoot>

      </tfoot>
    </table>
        <div><?php echo DNS2D::getBarcodeHTML('{$entrada->solicitudes}', "QRCODE",3,3);?></div>
<br/>
        <div><?php echo DNS1D::getBarcodeHTML('{$entrada->solicitudes', "C128",1,40);?></div>
  </body>
  </html>
