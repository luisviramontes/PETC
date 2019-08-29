<!DOCTYPE html>
<html lang="es">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <title>Informe de Reclamos {{$ciclo_aux->ciclo}}</title>
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



    <h1>Informe de Reclamos {{$ciclo_aux->ciclo}}: </h1>
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
<h2>Reclamos  Totales </h2>
    <table name="table_producto" id="table_producto" border="0" cellspacing="0" cellpadding="0">
      <thead>
        <tr>
          <th>N° Reclamos </th>
          <th>Directores </th>
          <th>Docentes </th>
          <th>Intendentes</th>
          <th>Total de Dias</th>
          <th>Monto Total</th>
          <th>Reclamos Resueltos</th>
          <th>Reclamos Pendientes</th>

        </tr>
      </thead>
      <tbody>
        <tr>
          <td>{{$reclamos->reclamos_count}} </td>
          <td>{{$reclamos_director->reclamos_director}} </td>
          <td>{{$reclamos_docente->reclamos_docente}}</td>
          <td>{{$reclamos_intendente->reclamos_intendente}} </td>
          <td>{{$reclamos->total_dias}} </td>
          <td>{{$reclamos->total_reclamo}} </td>
          <td>{{$reclamos_resueltos->reclamos_resueltos}} </td>
          <td>{{$reclamos_pendientes->reclamos_pendientes}}</td>
        </tr>
      </tbody>
      <tfoot>

      </tfoot>
    </table>

<h2>Reclamos por Región </h2>
    <table name="table_producto" id="table_producto" border="0" cellspacing="0" cellpadding="0">
      <thead>
        <tr>
          <th>Región </th>
          <th>Sostenimiento </th>
          <th>N° Reclamos </th>
          <th>Directores </th>
          <th>Docentes </th>
          <th>Intendentes</th>
          <th>Total de Dias</th>
          <th>Monto Total</th>
          <th>Reclamos Resueltos</th>
          <th>Reclamos Pendientes</th>

        </tr>
      </thead>
      <tbody>
        @for($z=1;$z <= 26; $z++)
        @if(${"reclamos_region".$z}->region == null)
        @else
        <tr>
          <td>{{${"reclamos_region".$z}->region}} </td>
          <td>{{${"reclamos_region".$z}->sostenimiento}} </td>
          <td>{{${"reclamos_region".$z}->reclamos_count}} </td>
          <td>{{${"reclamos_region_di".$z}->reclamos_director}} </td>
          <td>{{${"reclamos_region_do".$z}->reclamos_docente}}</td>
          <td>{{${"reclamos_region_in".$z}->reclamos_intendente}} </td>
          <td>{{${"reclamos_region".$z}->total_dias}} </td>
          <td>{{${"reclamos_region".$z}->total_reclamo}} </td>
          <td>{{${"reclamos_region_apli".$z}->reclamos_resueltos}} </td>
          <td>{{${"reclamos_region_pend".$z}->reclamos_pendientes}}</td>
        </tr>
        @endif
        @endfor
      </tbody>
      <tfoot>

      </tfoot>
    </table>
  </body>
  </html>
