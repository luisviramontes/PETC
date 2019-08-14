<!DOCTYPE html>
<html lang="es">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <title>Informe de Reintegros</title>
  <link rel="stylesheet" href="css/plantilla_reintegros.css" media="all" />
  <style media="screen">
   @page { size: 30cm 40cm landscape; }
 </style>
</head>
<body>
  <header class="clearfix">
    <div id="logo">
      <img src="img/logopetc2.jpg"  width="1300"  height="70"/>



    </div>



    <h1>Informe de Reintegos: </h1>
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
<h2>Reintegros  Totales </h2>
    <table name="table_producto" id="table_producto" border="0" cellspacing="0" cellpadding="0">
      <thead>
        <tr>
          <th>CCT</th>
          <th>Nombre </th>
          <th>Categoría </th>
          <th>Número de días</th>
          <th>Directo Regional</th>
          <th>No. Oficio</th>
          <th>Motivo</th>
          <th>Total Reintegro</th>
          <th>Capturo</th>
          <th>Estado</th>
          <th>Fecha de Registro</th>

        </tr>
      </thead>
      <tbody>
        @foreach($reintegro as $reintegro)
        <tr>
          <td>{{$reintegro->cct}}</td>
          <td>{{$reintegro->nombre}}</td>
          <td>{{$reintegro->categoria}}</td>
          <td>{{$reintegro->num_dias}}</td>
          <td>{{$reintegro->director_regional}}</td>
          <td>{{$reintegro->oficio}}</td>
          <td>{{$reintegro->motivo}}</td>
          <td>{{$reintegro->total}}</td>
          <td>{{$reintegro->captura}}</td>
          <td>{{$reintegro->estado}}</td>
          <td>{{$reintegro->created_at}}</td>



        </tr>
        @endforeach
      </tbody>
      <tfoot>

      </tfoot>
    </table>
  </body>
  </html>
