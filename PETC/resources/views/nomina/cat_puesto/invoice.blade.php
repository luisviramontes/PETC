<!DOCTYPE html>
<html lang="es">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <title>Directorio Regional</title>
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



    <h1>Categoria Puesto: </h1>
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
          <th>CV_UR </th>
          <th>ENTIDAD </th>
          <th>NOM_PROG </th>
          <th>CATEGORIA PUESTO</th>
          <th>DESCRIPCION PUESTO</th>
          <th>CATEGORIA</th>
          <th>TIPO PUESTO</th>

        </tr>
      </thead>
      <tbody>
        @foreach($categorias as $categoria)
        <tr>
          <td>{{$categoria->cv_ur}} </td>
          <td>{{$categoria->entidad}} </td>
          <td>{{$categoria->nom_prog}}</td>
          <td>{{$categoria->cat_puesto}} </td>
          <td>{{$categoria->des_puesto}} </td>
          <td>{{$categoria->categoria}} </td>
          <th>{{$categoria->tipo_puesto}}</th>
        </tr>
        @endforeach
      </tbody>
      <tfoot>

      </tfoot>
    </table>
        <div><?php echo DNS2D::getBarcodeHTML('{$entrada->ciclo}', "QRCODE",3,3);?></div>
<br/>
        <div><?php echo DNS1D::getBarcodeHTML('{$entrada->ciclo}', "C128",1,40);?></div>
  </body>
  </html>
