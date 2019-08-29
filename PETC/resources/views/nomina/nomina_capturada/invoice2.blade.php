<!DOCTYPE html>
<html lang="es">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <title>Reporte de Pagos Qna: {{$qna}}</title>
  <link rel="stylesheet" href="css/plantilla.css" media="all" />
</head>
<body>
  <header class="clearfix">
    <div id="logo">
      <img src="img/logopetc2.jpg"  width="750" height="80"/>
    </div>
    <h1>Reporte de Pagos Qna: {{$qna}}</h1>
    <div id="project"  align="left-">
      <div><span> Total de Pagos</span> {{$cuadros_cifra_totales->total_resgistros}}</div>
      <div><span>Total Percepciones: </span>  <?php echo  number_format($cuadros_cifra_perce->total_percepciones,2) ?></div> 
      <div><span>Total Deducciones: </span> <?php echo  number_format($cuadros_cifra_dedu->total_deducciones,2) ?></div>
      <div><span>Total Liquido: </span><?php echo  number_format($cuadros_cifra_neto->total_liquido,2) ?></div>
    </div>
 
    <div id="project2" align="right" >
      <div><span>Qna: </span> {{$tabla_pagos->qna}}</div>
      <div><span>Dias Habiles: </span>{{$tabla_pagos->dias}}</div>
      <div><span>Pago por Director : </span><?php echo  number_format($tabla_pagos->pago_director,2) ?></div>
      <div><span>Pago por Docente:</span><?php echo  number_format($tabla_pagos->pago_docente,2)?></div>
       <div><span>Pago Por Intendente:</span><?php echo  number_format($tabla_pagos->pago_intendente,2) ?></div>
    </div>
  </header>

  <main>

    <table name="table_producto" id="table_producto" border="0" cellspacing="0" cellpadding="0">
      <thead>
        <tr>
          <th class="no">Total Registros</th>
          <th class="no">Sostenimiento</th>
          <th class="no">Categoria</th>
          <th class="no">Percepciónes</th>
          <th class="no">Deducciónes</th>
          <th class="no">Liquido</th>
        </tr>
      </thead>
      <tbody>
        @foreach($cuadros_cifra as $cuadros_cifra)
        <tr>
          <td class="no">{{$cuadros_cifra->total_reclamos}}</td>           
          <td class="no">{{$cuadros_cifra->sostenimiento}}</td>
          <td class="no">{{$cuadros_cifra->categoria}} </td>
          <td class="no">$ <?php echo  number_format($cuadros_cifra->total_percepciones,2) ?></td>
          <td class="no">$ <?php echo  number_format($cuadros_cifra->total_deducciones,2) ?></td>
          <td class="no">$ <?php echo  number_format( $cuadros_cifra->total_liquido,2) ?></td>      
        </tr>
        @endforeach
      </tbody>
      <tfoot>

      </tfoot>
    </table>
  </body>
  </html>