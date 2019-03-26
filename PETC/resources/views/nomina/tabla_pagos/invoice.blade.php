<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <title>Tabla de Pagos Ciclo: {{$entrada->factura}}</title>
  <link rel="stylesheet" href="css/plantilla.css" media="all" />
</head>
<body>
  <header class="clearfix">
    <div id="logo">
      <img src="images/logoCeprozac.png"  width="100" height="100"/>
    </div>
    <h1>Tabla de Pagos Ciclo: {{$entrada->factura}}</h1>
    <div id="project" >
      <div><span>EMPRESA: </span> CEPROZAC</div>
      <div><span>COMPRADOR: </span> {{$entrada->empresaNombre}}</div> 
      <div><span>PROVEEDOR: </span> {{$entrada->ProvedorNombre}}</div> 
      <div><span>DOMICILIO: </span>{{$entrada->ProvedorDireccion}}</div> 
      <div><span>EMAIL: </span> <a href="{{$entrada->ProvedorEmail}}">{{$entrada->ProvedorEmail}}</a></div>
      <div><span>TEL: </span>{{$entrada->ProvedorTelefono}}</div>
    </div>
 
    <div id="project2" align="right" >
      <div><span>FACTURA: </span> {{$entrada->factura}}</div>
      <div><span>FECHA: </span> {{$entrada->fecha}}</div>
      <div><span>MONEDA: </span>{{$entrada->moneda}}</div>
      <div><span>RECIBIO COMPRA: </span>{{$entrada->nombre1}} {{$entrada->apellido1}}</div>
      <div><span>RECIBIO EN ALMACÉN:</span>{{$entrada->nombre2}} {{$entrada->apellido2}}</div>
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
        @foreach($data2 as $datos)
        <tr>
          <td class="no">{{$datos->qna}}</td>           
          <td class="unit">${{$datos->dias}}</td>
          <td class="total">${{$datos->pago_director}} </td>
          <td class="unit">${{$datos->pago_docente}}</td>
          <td class="unit">${{$datos->pago_intendente}}</td>
          <td class="unit">${{$datos->ciclo}}</td>      
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