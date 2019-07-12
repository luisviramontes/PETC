<!DOCTYPE html>
<html lang="es">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <title>Directorio SEDUZAC</title>
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



    <h1>Directorio SEDUZAC: </h1>
    <div id="project" >
      <div><span> Programa</span> PROGRAMA ESCUELAS DE TIEMPO COMPLETO</div>
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
          <th>LIC </th>
          <th>NOMBRE </th>
          <th>PUESTO </th>
          <th>DIRECCION</th>
          <th>CORREO</th>
          <th>EXTENCION</th>

        </tr>
      </thead>
      <tbody>
        @foreach($personal as $personal)
        <tr>
          <td>{{$personal->lic}} </td>
          <td>{{$personal->nombre_c}} </td>
          <td>{{$personal->puesto}}</td>
          <td>{{$personal->direccion}} </td>
          <td>{{$personal->correo}} </td>
          <td>{{$personal->ext}} </td>
        </tr>
        @endforeach
      </tbody>
      <tfoot>

      </tfoot>
    </table>
  </body>
  </html>
